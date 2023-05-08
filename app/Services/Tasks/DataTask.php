<?php

namespace App\Services\Tasks;

use App\Models\Request;
use App\Services\Expressions\ExpressionInterface;
use App\Services\Expressions\FormalExpression;
use App\Services\Traits\ServiceTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\ActivityTrait;
use ProcessMaker\Nayra\Bpmn\Models\ServiceTask;
use ProcessMaker\Nayra\Contracts\Bpmn\ActivityInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;

class DataTask
{
    use ServiceTrait;

    /**
     * 服务任务执行器，用于执行服务任务的实现。这里的实现仅用于测试目的。这个方法尝试调用服务任务的实现，如果调用成功返回 true，否则返回 false。
     * @param TokenInterface $token
     * @return bool
     * @throws \Throwable
     */
    private function __invoke(TokenInterface $token): bool
    {
        $dataStore = $token->getInstance()->getDataStore();

        $request = $this->getRequest($dataStore->getData('request_id'));

        $request->continuous_bet_count = 0;

        return $request->save();
    }
}
