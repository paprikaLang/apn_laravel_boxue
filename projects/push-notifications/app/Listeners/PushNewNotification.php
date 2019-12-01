<?php

namespace App\Listeners;

use App\Events\NewNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class PushNewNotification implements ShouldQueue
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
     * @param  NewNotification  $event
     * @return void
     */
    public function handle(NewNotification $event)
    {
        Log::debug("Push new notification to APN.");
    }
}
