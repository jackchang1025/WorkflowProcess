<?php

namespace App\Help;

class Common
{
    /**
     * @param $var
     * @param float|int $needs
     * @return bool
     */
    public static function greaterOrEqualTo($var, float|int $needs = 0): bool
    {
        return $var >= $needs;
    }

    /**
     * @param $var
     * @param float|int $needs
     * @return bool
     */
    public static function lessThanOrEqualTo($var, float|int $needs = 0): bool
    {
        return $var <= $needs;
    }
}
