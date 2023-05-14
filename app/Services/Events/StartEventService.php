<?php

namespace App\Services\Events;


use App\Models\Request;
use App\Services\Traits\ServiceTrait;
use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\Models\StartEvent;
use ProcessMaker\Nayra\Bpmn\StartEventTrait;
use ProcessMaker\Nayra\Contracts\Bpmn\MessageListenerInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\StartEventInterface;
use ProcessMaker\Nayra\Contracts\Engine\ExecutionInstanceInterface;


class StartEventService extends StartEvent
{
    use ServiceTrait;

    /**
     * @param ExecutionInstanceInterface $instance
     * @return StartEventService
     * @throws \Throwable
     */
    public function start(ExecutionInstanceInterface $instance): static
    {
        parent::start($instance);

        Log::channel('ondemand')->info('StartEventService start');

        $requestId = $instance->getDataStore()->getData('request_id');

        $request = Request::findOrStatusFail($requestId);

        $request->status = Request::STATUS_RUNNING;
        $request->save();

        return $this;
    }
}
