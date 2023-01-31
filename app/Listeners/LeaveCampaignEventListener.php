<?php

namespace App\Listeners;

use App\Events\LeaveCampaignEvent;
use App\Notifications\JoinOrLeaveCampaignNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class LeaveCampaignEventListener
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
     * @param  \App\Events\LeaveCampaignEvent  $event
     * @return void
     */
    public function handle(LeaveCampaignEvent $event)
    {
        Notification::send($event->campaign->post->bloodtransfercenter->user,
            new JoinOrLeaveCampaignNotification($event->donor,$event->campaign,'left'));

    }
}
