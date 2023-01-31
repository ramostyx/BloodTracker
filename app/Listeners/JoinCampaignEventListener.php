<?php

namespace App\Listeners;

use App\Events\JoinCampaignEvent;
use App\Notifications\JoinOrLeaveCampaignNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class JoinCampaignEventListener
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
     * @param  \App\Events\JoinCampaignEvent  $event
     * @return void
     */
    public function handle(JoinCampaignEvent $event)
    {
        Notification::send($event->campaign->post->bloodtransfercenter->user,
            new JoinOrLeaveCampaignNotification($event->donor,$event->campaign,'joined'));
    }
}
