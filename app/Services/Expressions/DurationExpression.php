<?php

namespace App\Services\Expressions;

use DateInterval;
use Exception;

class DurationExpression implements ExpressionInterface
{
    /**
     * @param string $expression
     * @param null $dataStore
     * @return DateInterval|bool
     */
    public function evaluate(string $expression, $dataStore = null): DateInterval|bool
    {
        try {
            return  new DateInterval($expression);
        } catch (Exception) {
            return false;
        }
    }

    /**
     * @param string $expression
     * @return bool
     */
    public function isExpression(string $expression): bool
    {
        try {
            return (bool)new DateInterval($expression);
        } catch (\Exception) {
            return false;
        }
    }
}
