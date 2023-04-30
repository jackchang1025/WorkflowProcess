<?php

namespace App\Services\Events;


use Illuminate\Support\Facades\Log;
use ProcessMaker\Nayra\Bpmn\StartEventTrait;
use ProcessMaker\Nayra\Contracts\Bpmn\MessageListenerInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\StartEventInterface;
use ProcessMaker\Nayra\Contracts\Engine\ExecutionInstanceInterface;


class StartEventService implements StartEventInterface, MessageListenerInterface
{
    use StartEventTrait;

    const TAG_NAME = 'startEvent';

    public function start(ExecutionInstanceInterface $instance): StartEventService|static
    {
        Log::channel()->info('StartEventService start');

        $this->triggerPlace[0]->addNewToken($instance);

        return $this;
    }

    protected function getBpmnEventClasses()
    {
        return [];
    }
}
