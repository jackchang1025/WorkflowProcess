<?php

namespace App\Services\Expressions;

use DateInterval;
use DateTime;
use ProcessMaker\Nayra\Bpmn\Models\DatePeriod;

class CycleExpression extends BaseExpression
{
    /**
     * @return false|DatePeriod
     */
    public function evaluate(): bool|DatePeriod
    {
        try {
            //Improve Repeating intervals (R/start/interval/end) configuration

            return preg_match('/^R\/([^\/]+)\/([^\/]+)\/([^\/]+)$/', $this->expression, $repeating)
                ? new DatePeriod(new DateTime($repeating[1]), new DateInterval($repeating[2]), new DateTime($repeating[3]))
                : new DatePeriod($this->expression);

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
            return (bool) new DatePeriod($this->expression);
        } catch (\Exception $e) {
            return false;
        }
    }
}
