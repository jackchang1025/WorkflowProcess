<?php

namespace App\Providers;

use App\Events\ProcessInstanceCompletedEvent;
use App\Events\ScriptTaskActivatedEvent;
use App\Events\ServiceTaskActivatedEvent;
use App\Listeners\ProcessInstanceCompletedListener;
use App\Listeners\ScriptTaskActivatedListener;
use App\Listeners\ServiceTaskActivatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class                    => [
            SendEmailVerificationNotification::class,
        ],
        ServiceTaskActivatedEvent::class     => [
            ServiceTaskActivatedListener::class,
        ],
        ProcessInstanceCompletedEvent::class => [
            ProcessInstanceCompletedListener::class,
        ],
        ScriptTaskActivatedEvent::class      => [
            ScriptTaskActivatedListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
