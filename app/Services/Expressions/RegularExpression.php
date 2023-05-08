<?php

namespace App\Services\Expressions;

class RegularExpression implements ExpressionInterface
{

    public $data;

    public  string $expression;

    /**
     * @param $data
     * @param string $expression
     */
    public function __construct($data, string $expression)
    {
        $this->data = $data;
        $this->expression = $expression;
    }

    /**
     * @return array|bool
     */
    public function evaluate(): bool|array
    {
        try {

            return preg_match($this->expression, (string) $this->data, $matches) ? $matches : false;

        } catch (\Exception) {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function isExpression(): bool
    {
        try {
            return preg_match($this->expression, '') !== false;

        } catch (\Exception) {

            return false;
        }
    }

}
