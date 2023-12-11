<?php

namespace App\Listeners;

use App\Events\UserFormRequestSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveLogUserFormRequest
{
    /**
     * Handle the event.
     */
    public function handle(UserFormRequestSaved $event): void
    {
        //
    }
}
