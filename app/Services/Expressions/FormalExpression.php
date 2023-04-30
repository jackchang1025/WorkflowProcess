<?php

namespace App\Services\Expressions;

use App\Models\Request;
use Exception;
use ProcessMaker\Nayra\Bpmn\FormalExpressionTrait;
use ProcessMaker\Nayra\Bpmn\Models\DatePeriod;
use ProcessMaker\Nayra\Contracts\Bpmn\FormalExpressionInterface;

/**
 * FormalExpression 类表示 BPMN 中的形式表达式。形式表达式用于表示条件表达式、脚本、规则等。
 * 在 ProcessMaker Nayra 中，可以使用形式表达式来定义条件网关、顺序流的条件等。
 */
class FormalExpression implements FormalExpressionInterface
{
    use FormalExpressionTrait;

    protected array $extensionProperties = [];

    protected array $conditionExpressions = [];

    public function __construct()
    {

        $this->registerConditionExpressions();
    }

    /**
     * @return void
     */
    protected function registerConditionExpressions(): void
    {
        if (empty($this->conditionExpressions)) {
            $this->conditionExpressions = [
                new DateExpression(),
                new CycleExpression(),
                new DurationExpression(),
                new RegularExpression(),
                new Expression(),
            ];
        }
    }


    /**
     * 获取表达式的语言
     * @return mixed|string
     */
    public function getLanguage(): mixed
    {
        return $this->getProperty(FormalExpressionInterface::BPMN_PROPERTY_LANGUAGE);
    }

    /**
     * 获取表达式的主体
     * @return mixed|string
     */
    public function getBody(): mixed
    {
        return $this->getProperty(FormalExpressionInterface::BPMN_PROPERTY_BODY);
    }


    /**
     * 获取表达式的属性
     * @return array
     */
    public function getExtensionProperties(): array
    {
        $extensionElements = $this->getBpmnElement()->parentNode->getElementsByTagNameNS('*', 'extensionElements');

        // 获取 extensionElements 的所有 properties
        foreach ($extensionElements as $extensionElement) {

            // 遍历所有 properties
            $properties = $extensionElement->getElementsByTagNameNS('*', 'property');

            // 遍历所有 properties
            foreach ($properties as $property) {

                // 获取 name 和 value 属性
                if (($name = $property->getAttribute('name')) && ($value = $property->getAttribute('value'))) {

                    $explodes = explode('-', $name);

                    $name  = $explodes[0] ?? '';
                    $title = $explodes[1] ?? '';

                    // 将属性添加到属性数组中
                    $this->extensionProperties[$name] = [
                        'title' => $title,
                        'value' => $value
                    ];
                }
            }
        }

        return $this->extensionProperties;
    }


    /**
     * 评估表达式
     * @param $dataStore
     * @return mixed
     */
    public function evaluates($dataStore): mixed
    {
        if (!empty($extensionProperties = $this->getExtensionProperties())) {

            foreach ($extensionProperties as $ruleName => $expression) {

                if (($data = $dataStore->getAttribute($ruleName)) !== null) {

                    $matchingExpressions = array_filter($this->conditionExpressions, function (ExpressionInterface $conditionExpression) use ($expression) {

                        return $conditionExpression->isExpression($expression['value']);
                    });

                    if ($result = $this->expressionEvaluate($matchingExpressions, $expression['value'], (string) $data)) {
                        return $result;
                    }
                }
            }
        }
        return false;
    }

    /**
     * @param array $matchingExpressions
     * @param string $expression
     * @param string $data
     * @return mixed
     */
    public function expressionEvaluate(array $matchingExpressions,string $expression ,string $data): mixed
    {
        return array_reduce($matchingExpressions, function ($carry, ExpressionInterface $matchingExpression) use ($expression, $data) {
            return $carry ?: $matchingExpression->evaluate($expression, $data);
        }, false);
    }

    /**
     * 返回特定的评估类型。
     * @return bool
     * @throws Exception
     */
    public function getEvaluatesToType(): bool
    {
        $string   = $this->getBody();

        if (empty($string)) {
            throw new Exception('body is empty');
        }

        $string = str_starts_with($string, '=') ? substr($string, 1) : $string;

        if ($string == 'true'){
            return true;
        }
        return false;
    }

    /**
     * @param $args
     * @return int|bool|DatePeriod|\DateTime|\DateInterval
     * @throws Exception
     */
    public function __invoke($args): int|bool|DatePeriod|\DateTime|\DateInterval
    {
        return $this->evaluates($args['request']);
    }
}