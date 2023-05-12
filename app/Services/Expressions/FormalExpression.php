<?php

namespace App\Services\Expressions;

use App\Models\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\FormalExpressionTrait;
use ProcessMaker\Nayra\Contracts\Bpmn\FormalExpressionInterface;
use ProcessMaker\Nayra\Contracts\Storage\BpmnElementInterface;

/**
 * FormalExpression 类表示 BPMN 中的形式表达式。形式表达式用于表示条件表达式、脚本、规则等。
 * 在 ProcessMaker Nayra 中，可以使用形式表达式来定义条件网关、顺序流的条件等。
 */
class FormalExpression implements FormalExpressionInterface
{
    use FormalExpressionTrait;

    protected array $extensionProperties = [];

    protected array $conditionExpressions = [];

    /**
     * @param $data
     * @param string $expression
     * @return void
     */
    protected function registerConditionExpressions($data, string $expression): void
    {
        $this->conditionExpressions = [
            new DateExpression($expression),
            new CycleExpression($expression),
            new DurationExpression($expression),
            new RegularExpression($expression, $data),
            new Expression($expression, $data),
            new PhpScript($expression, $data),
        ];
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
     * @param BpmnElementInterface $bpmnElement
     * @return array
     */
    public function getExtensionProperties(BpmnElementInterface $bpmnElement): array
    {
        $this->extensionProperties = [];

        $extensionElements = $bpmnElement->getElementsByTagNameNS('*', 'extensionElements');

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
     * @return mixed
     */
    public function expressionEvaluate(): mixed
    {
        $matchingExpressions = array_values(array_filter($this->conditionExpressions, function (ExpressionInterface $conditionExpression) {
            return $conditionExpression->isExpression();
        }));

        return array_reduce($matchingExpressions, function ($carry, ExpressionInterface $matchingExpression) {

            Log::channel('ondemand')->debug(get_class($matchingExpression), ['expression' => $matchingExpression->expression, 'data' => $matchingExpression->data]);
            return $carry ?: $matchingExpression->evaluate();
        }, false);
    }

    /**
     * 返回特定的评估类型。
     * @return bool
     * @throws Exception
     */
    /**
     * Get the type that this Expression returns when evaluated.
     *
     * @return string
     */
    public function getEvaluatesToType()
    {
        return $this->getProperty(FormalExpressionInterface::BPMN_PROPERTY_EVALUATES_TO_TYPE_REF);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function evaluate($data = null): mixed
    {
        $this->registerConditionExpressions($data, $this->getBody());

        return $this->expressionEvaluate();
    }

    /**
     * @param $args
     * @return mixed
     * @throws Exception|\Throwable
     */
    public function __invoke($args): mixed
    {
        try {

            return $this->evaluate(Request::findOrStatusFail($args['request_id']));

        } catch (\Exception $e) {

            // Log the error or handle it as needed

            Log::channel('ondemand')->error($e->getMessage());

            return false;
        }
    }
}
