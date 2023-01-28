<?php

namespace App\Listeners;

use App\Events\SyncDatabaseCommandStartedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SyncDatabaseCommandStartedEventListener
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
     * @param  \App\Events\SyncDatabaseCommandStartedEvent  $event
     * @return void
     */
    public function handle(SyncDatabaseCommandStartedEvent $event)
    {
        Log::info('SyncDatabaseCommandStartedEvent');
    }
}
