<?php

namespace App\Listeners;

use App\Events\ServiceTaskActivatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use ProcessMaker\Nayra\Bpmn\Models\ServiceTask;

class ServiceTaskActivatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ServiceTaskActivatedEvent $event
     * @return ServiceTask
     */
    public function handle(ServiceTaskActivatedEvent $event): ServiceTask
    {

        $event->activity->setImplementation($event->activity->getProperty('delegateExpression'));

        return $event->activity->run($event->token);
    }
}
