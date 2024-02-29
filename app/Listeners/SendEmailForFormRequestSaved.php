<?php

namespace App\Listeners;

use App\Enums\UserFormRequestLogActionsEnum;
use App\Events\UserFormRequestSaved;
use App\Jobs\NotifyUsersFormRequestSavedJob;
use App\Models\User;
use App\Notifications\NewRequestReceived;

class SendEmailForFormRequestSaved
{
    /**
     * Handle the event.
     */
    public function handle(UserFormRequestSaved $event): void
    {
        if ($event->action == UserFormRequestLogActionsEnum::CREATE) {
            NotifyUsersFormRequestSavedJob::dispatchAfterResponse();
        }
    }
}
