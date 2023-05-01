<?php

namespace App\Services\Tasks;

use App\Models\Request;
use App\Services\Expressions\FormalExpression;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\Models\ServiceTask;
use ProcessMaker\Nayra\Contracts\Bpmn\ActivityInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;

class CreateBetAmountTask extends ServiceTask
{
    const TAG_NAME = 'createBetAmountTask';

    protected FormalExpression $formalExpression;

    public function __construct(...$args)
    {
        parent::__construct($args);

        $this->formalExpression = app(FormalExpression::class);
    }

    protected function getBpmnEventClasses(): array
    {
        return [
//            ServiceTaskInterface::EVENT_SERVICE_TASK_ACTIVATED => ServiceTaskActivatedEvent::class,
        ];
    }

    /**
     * 执行服务任务。首先尝试执行服务任务实现（通过 executeService() 方法），如果执行成功，调用 complete() 方法完成任务；否则，将令牌设置为失败状态
     * @param TokenInterface $token
     * @return GetLotteryDataTask|$this
     */
    public function run(TokenInterface $token): GetLotteryDataTask|static
    {
        Log::channel()->info('createBetAmountTask run');

        if ($this->executeService($token)) {

            $this->complete($token);

        } else {
            // 如果请求失败，将令牌设置为失败状态
            $token->setStatus(ActivityInterface::TOKEN_STATE_FAILING);
        }
        return $this;
    }

    /**
     * 服务任务执行器，用于执行服务任务的实现。这里的实现仅用于测试目的。这个方法尝试调用服务任务的实现，如果调用成功返回 true，否则返回 false。
     * @param TokenInterface $token
     * @return bool
     */
    private function executeService(TokenInterface $token): bool
    {
        /**
         * @var Request $request
         */

        $request = $token->getInstance()->getDataStore()->getData('request');

        $extensionProperties = $this->formalExpression->getExtensionProperties($this->getBpmnElement());

        $request->current_bet_amount_rule = $this->formalExpression->evaluates($request,$extensionProperties);

        Log::info('current_bet_amount_rule ===>' . $request->current_bet_amount_rule);

        return true;
    }


}
