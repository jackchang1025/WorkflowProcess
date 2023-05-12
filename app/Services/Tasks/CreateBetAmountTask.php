<?php

namespace App\Services\Tasks;

use App\Models\Request;
use App\Services\Expressions\FormalExpression;
use App\Services\Traits\ServiceTrait;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;

class CreateBetAmountTask
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
    public function __invoke(TokenInterface $token): bool
    {

        $requestId = $token->getInstance()->getDataStore()->getData('request_id');

        $request = Request::findOrStatusFail($requestId['request_id']);


        $element = $token->getOwner()->getOwner()->getBpmnElement()->getElementsByTagNameNS('*', 'extensionElements');

        $extensionProperties = $this->formalExpression->getExtensionProperties($token->getBpmnElement());

        //投注金额大于总金额
        throw_if($request->current_bet_amount_rule > $request->bet_total_amount_rules, new \Exception("投注金额大于总金额:{$request->current_bet_amount_rule} > {$request->bet_total_amount_rules}"));

        Log::info('current_bet_amount_rule ===>' . $request->current_bet_amount_rule);

        return $request->save();
    }


}
