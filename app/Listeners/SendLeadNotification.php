<?php

namespace App\Listeners;

use App\Events\LeadCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendLeadNotification
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
    public function handle(LeadCreated $event): void
    {
	  Log::info('A new lead was created', [
        'lead_id' => $event->lead->id,
        'email' => $event->lead->email,
    ]);        //
    }
}
