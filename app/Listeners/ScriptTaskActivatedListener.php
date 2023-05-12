<?php

namespace App\Listeners;

use App\Events\ScriptTaskActivatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ScriptTaskActivatedListener
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
     * @param \App\Events\ScriptTaskActivatedEvent $event
     * @return void
     */
    public function handle(ScriptTaskActivatedEvent $event)
    {
        $event->scriptTask->runScript($event->token);
    }
}
