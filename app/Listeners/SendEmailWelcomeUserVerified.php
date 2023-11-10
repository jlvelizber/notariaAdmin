<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;


class SendEmailWelcomeUserVerified
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
    public function handle(Verified $event): void
    {
        $event->user->sendEmailWelCome();
    }
}
