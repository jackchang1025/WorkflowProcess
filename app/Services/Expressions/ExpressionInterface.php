<?php

namespace App\Services\Expressions;

interface ExpressionInterface
{
    public function evaluate();

    public function isExpression(): bool;
}
