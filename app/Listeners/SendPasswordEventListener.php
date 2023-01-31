<?php

namespace App\Listeners;

use App\Events\SendPasswordEvent;
use App\Mail\SendPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordEventListener
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
     * @param  \App\Events\SendPasswordEvent  $event
     * @return void
     */
    public function handle(SendPasswordEvent $event)
    {
        Mail::to($event->email)->send(new SendPasswordMail($event->email,$event->password));
    }
}
