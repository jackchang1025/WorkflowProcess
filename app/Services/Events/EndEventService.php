<?php

namespace App\Services\Events;

use ProcessMaker\Nayra\Bpmn\Models\EndEvent;

class EndEventService extends EndEvent
{
    protected function getBpmnEventClasses()
    {
        return [];
    }
}
