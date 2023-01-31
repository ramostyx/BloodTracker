<?php

namespace App\Providers;

use App\Events\FillBloodStockEvent;
use App\Events\FullBloodStockEvent;
use App\Events\JoinCampaignEvent;
use App\Events\LeaveCampaignEvent;
use App\Events\SendPasswordEvent;
use App\Listeners\FillBloodStockEventListener;
use App\Listeners\FullBloodStockEventListener;
use App\Listeners\JoinCampaignEventListener;
use App\Listeners\LeaveCampaignEventListener;
use App\Listeners\SendPasswordEventListener;
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
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendPasswordEvent::class => [
            SendPasswordEventListener::class
        ],
        JoinCampaignEvent::class => [
            JoinCampaignEventListener::class
        ],
        LeaveCampaignEvent::class => [
            LeaveCampaignEventListener::class
        ],
        FillBloodStockEvent::class => [
            FillBloodStockEventListener::class
        ],
        FullBloodStockEvent::class => [
            FullBloodStockEventListener::class
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
