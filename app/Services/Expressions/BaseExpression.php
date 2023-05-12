<?php

namespace App\Services\Expressions;

abstract class BaseExpression implements ExpressionInterface
{

    public function __construct(public string $expression,public mixed $data = null)
    {

    }
}
