<?php

namespace App\Listeners;

use App\Events\FullBloodStockEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class FullBloodStockEventListener
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
     * @param  \App\Events\FullBloodStockEvent  $event
     * @return void
     */
    public function handle(FullBloodStockEvent $event)
    {
        $notifications = $event->stock->bloodtransfercenter->user->notifications;
        $notification= $notifications->where('data->stock_id', $event->stock->id)->first() ;
        $notification->delete();
    }
}
