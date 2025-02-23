<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Log;

class TestAuthListener
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
    public function handle(Login $event): void
    {
        Log::info($event->user);
    }
}
