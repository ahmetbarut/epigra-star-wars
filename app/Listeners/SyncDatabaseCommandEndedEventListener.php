<?php

namespace App\Listeners;

use App\Events\SyncDatabaseCommandEndedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SyncDatabaseCommandEndedEventListener
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
     * @param  \App\Events\SyncDatabaseCommandEndedEvent  $event
     * @return void
     */
    public function handle(SyncDatabaseCommandEndedEvent $event)
    {
        Log::info('SyncDatabaseCommandEndedEvent');
    }
}
