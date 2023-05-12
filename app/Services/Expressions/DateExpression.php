<?php

namespace App\Services\Expressions;

use DateTime;

class DateExpression extends BaseExpression
{

    /**
     * @return bool
     */
    public function evaluate(): bool
    {
        $regexpValidDate = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}[T ][0-9]{2}:[0-9]{2}(:[0-9]{2})?(?:[\+-][0-9]{2}:[0-9]{2}|Z)?/';

        return preg_match($regexpValidDate, $this->expression);
    }

    public function isExpression(): bool
    {
        try {
            return (bool)new DateTime($this->expression);
        } catch (\Exception) {
            return false;
        }
    }
}
