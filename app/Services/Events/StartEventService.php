<?php

namespace App\Services\Events;


use App\Models\Request;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\StartEventTrait;
use ProcessMaker\Nayra\Contracts\Bpmn\MessageListenerInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\StartEventInterface;
use ProcessMaker\Nayra\Contracts\Engine\ExecutionInstanceInterface;


class StartEventService implements StartEventInterface, MessageListenerInterface
{
    use StartEventTrait;

    const TAG_NAME = 'startEvent';

    public function start(ExecutionInstanceInterface $instance)
    {
        Log::channel()->info('StartEventService start');

        $requestId = $instance->getDataStore()->getData('request_id');

        $request = Request::find($requestId);

        throw_if(!$request , new \Exception('请求不存在'));
        throw_if($request->status == Request::STATUS_STOP , new \Exception('请求已取消'));


        $this->triggerPlace[0]->addNewToken($instance);

        $request->status = Request::STATUS_RUNNING;
        return $request->save();
    }

    protected function getBpmnEventClasses()
    {
        return [];
    }
}
