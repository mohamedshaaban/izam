<?php

namespace Modules\Order\Listeners;

use Illuminate\Support\Facades\Mail;
use Modules\Order\app\Events\OrderPlaced;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Order\Emails\OrderMail;

class NotifyUsersOfNewOrder
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(\Modules\Order\Events\OrderPlaced $event): void
    {
        Mail::to($event->email)->send(new OrderMail($event->messageContent));
    }
}
