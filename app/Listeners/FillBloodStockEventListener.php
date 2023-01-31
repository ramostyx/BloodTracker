<?php

namespace App\Listeners;

use App\Events\FillBloodStockEvent;
use App\Notifications\LowBloodStockWarning;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class FillBloodStockEventListener
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
     * @param \App\Events\FillBloodStockEvent $event
     * @return void
     */
    public function handle(FillBloodStockEvent $event)
    {

        $notifications = $event->stock->bloodtransfercenter->user->notifications;
        $notification= $notifications->where('data->stock_id', $event->stock->id)->first() ;
        if(!$notification){
            Notification::send($event->stock->bloodtransfercenter->user,
                new LowBloodStockWarning($event->stock));
        }

    }
}
