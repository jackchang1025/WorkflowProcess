<?php

namespace App\Listeners;

use App\Events\ProcessInstanceCompletedEvent;
use App\Models\Request;
use Doctrine\DBAL\ArrayParameterType;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ProcessInstanceCompletedListener
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
     * @param  \App\Events\ProcessInstanceCompletedEvent  $event
     * @return void
     */
    public function handle(ProcessInstanceCompletedEvent $event)
    {
        /**
         * @var \App\Models\Request $request
         */
        $request = Request::find($event->id);

        $request->status = Request::STATUS_COMPLETED;

        $request->save();
    }
}
