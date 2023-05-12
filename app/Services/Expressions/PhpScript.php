<?php

namespace App\Services\Expressions;

use Illuminate\Support\Facades\Log;

class PhpScript extends BaseExpression
{

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
     * 执行表达式
     * @return false|mixed
     */
    public function evaluate(): mixed
    {
        try {
            $request = $this->data;

            // Check if the expression is a function definition
            if (preg_match('/^function\s*\((.*?)\)\s*\{(.*?)\}$/s', $this->removeComments($this->expression), $matches)) {
                $params = $matches[1];
                $code   = $matches[2];

                // Create an anonymous function with the code
                $function = eval("return function ({$params}) {{$code}};");

                if ($function instanceof \Closure) {
                    return $function($request);
                }
                return false;

            } else {
                // Evaluate the expression as a simple script
                $func = function ($code) use ($request) {
                    return eval($code);
                };

                // Call the function
                return $func($this->expression);
            }
        } catch (\Exception|\Throwable $e) {
            Log::channel('ondemand')->error($e->getMessage(), ['expression' => $this->expression, 'data' => $this->data->toArray()]);
            return false;
        }
    }

    /**
     * 移除代码注释
     * @param string $code
     * @return string
     */
    private function removeComments(string $code): string
    {
        return preg_replace(['!/\*.*?\*/!s', '!//.*?\n!', '!#.*?\n!'], '', $code);
    }

    /**
     * @return bool
     */
    public function isExpression(): bool
    {
        return !empty($this->expression);
    }
}
