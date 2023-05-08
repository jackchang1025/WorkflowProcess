<?php

namespace App\Services\Expressions;

use DateInterval;
use Exception;

class DurationExpression implements ExpressionInterface
{

    public  string $expression;

    /**
     * @param string $expression
     */
    public function __construct(string $expression)
    {
        $this->expression = $expression;
    }

    /**
     * @return DateInterval|bool
     */
    public function evaluate(): DateInterval|bool
    {
        try {
            return  new DateInterval($this->expression);
        } catch (Exception) {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function isExpression(): bool
    {
        try {
            return (bool)new DateInterval($this->expression);
        } catch (\Exception) {
            return false;
        }
    }
}
