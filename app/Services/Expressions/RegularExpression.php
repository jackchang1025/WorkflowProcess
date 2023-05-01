<?php

namespace App\Services\Expressions;

class RegularExpression implements ExpressionInterface
{

    /**
     * @param string $expression
     * @param $dataStore
     * @return array|bool
     */
    public function evaluate(string $expression, $dataStore = null): bool|array
    {
        try {

            return preg_match($expression, (string)$dataStore, $matches) ? $matches : false;

        } catch (\Exception) {
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
            return preg_match($expression, '') !== false;

        } catch (\Exception) {

            return false;
        }
    }

}
