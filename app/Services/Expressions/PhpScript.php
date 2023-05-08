<?php

namespace App\Services\Expressions;

class PhpScript implements ExpressionInterface
{

    public $data;

    public string $expression;

    /**
     * @param $data
     * @param string $expression
     */
    public function __construct($data, string $expression)
    {
        $this->data       = $data;
        $this->expression = $this->buildScript($expression);
    }

    /**
     * @param string $expression
     * @return string
     */
    protected function buildScript(string $expression): string
    {
        // Replace 'test' with '$test'
        $code = preg_replace('/\btest\b/', '$test', $expression);

        // Replace '.' with '->'
        return str_replace('.', '->', $code);
    }

    /**
     * Check if the data contains and item by name.
     *
     * @param string $name
     *
     * @return bool
     */
    public function contains(string $name): bool
    {
        return property_exists($this->data, $name);
    }

    /**
     * @return array|bool
     */
    public function evaluate(): bool|array
    {
        try {
            $request = $this->data;

            $eval = function ($code) use ($request): mixed {
                return eval($code);
            };

            return $eval(trim($this->expression, ''));

        } catch (\Exception|\Throwable $e) {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function isExpression(): bool
    {
        return !empty($this->expression);
    }

}
