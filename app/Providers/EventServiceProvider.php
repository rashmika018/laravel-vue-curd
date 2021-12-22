<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\PodcastProcessed;
use App\Listeners\SendPodcastNotification;
use App\Events\LoginHistory;
use App\Listeners\StoreUserLoginHistory;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        
        PodcastProcessed::class =>[
            SendPodcastNotification::class
        ],
        
        LoginHistory::class => [
            StoreUserLoginHistory::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
       
    }
}
