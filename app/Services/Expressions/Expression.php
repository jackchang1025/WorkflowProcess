<?php

namespace App\Services\Expressions;

class Expression implements ExpressionInterface
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
     * @return mixed
     */
    public function evaluate(): mixed
    {
        // 使用正则表达式查找变量并替换为 $dataStore
        $replacedExpression = preg_replace('/\$[a-zA-Z_][a-zA-Z0-9_]*/', '$data', $this->expression);

        try {

            $data = $this->data;

            // 使用 eval() 执行替换后的表达式
            return eval("return $replacedExpression;");

        } catch (\Exception | \Throwable $e) {

            return false;
        }

    }

    /**
     * @return bool|false
     */
    public function isExpression(): bool
    {
        // 检查字符串是否包含不安全的字符或函数
        $blacklist = ['eval', 'exec', 'system', 'passthru', 'shell_exec'];
        foreach ($blacklist as $item) {
            if (str_contains($this->expression, $item)) {
                return false;
            }
        }

        // 检查字符串是否包含合法的 PHP 表达式
//        $pattern = '/^[\s\$a-zA-Z0-9_\(\)\{\}\[\]\-+*\/%.<>=!&|^@:,\x5C\x27\x22]*$/';
        $pattern = '/^[\s\$a-zA-Z0-9_\(\)\{\}\[\]\-+*\/%.<>=!&|^@:,]*$/';
        return (bool) preg_match($pattern, $this->expression);
    }
}
