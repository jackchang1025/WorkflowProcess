<?php

namespace App\Services\Tasks;

use App\Models\Request;
use App\Services\Expressions\FormalExpression;
use App\Services\Traits\ServiceTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\ActivityTrait;
use ProcessMaker\Nayra\Bpmn\Models\ServiceTask;
use ProcessMaker\Nayra\Contracts\Bpmn\ActivityInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;

class CreateBetCodeTask
{
    use ServiceTrait;

    public function __construct(protected FormalExpression $formalExpression)
    {

    }

    /**
     * 服务任务执行器，用于执行服务任务的实现。这里的实现仅用于测试目的。这个方法尝试调用服务任务的实现，如果调用成功返回 true，否则返回 false。
     * @param TokenInterface $token
     * @return bool
     * @throws \Throwable
     */
    private function __invoke(TokenInterface $token): bool
    {
        $requestId = $token->getInstance()->getDataStore()->getData('request_id');

        $request = $this->getRequest($requestId);

        $extensionProperties = $this->formalExpression->getExtensionProperties($token->getBpmnElement());

        $response = $this->formalExpression->evaluates($request, $extensionProperties);


        throw_if(empty($response), new Exception('获取投注号码失败'));

        $request->current_bet_code_rule = $response[1];

        $request->continuous_bet_count += 1;

        Log::info('current_bet_code_rule ===> ' . $request->current_bet_code_rule);

        return $request->save();
    }
}
