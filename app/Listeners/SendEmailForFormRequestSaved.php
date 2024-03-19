<?php

namespace App\Listeners;

use App\Enums\UserFormRequestLogActionsEnum;
use App\Events\UserFormRequestSaved;
use App\Jobs\NotifyCustomerRequestSavedJob;
use App\Jobs\NotifyUsersFormRequestSavedJob;

class SendEmailForFormRequestSaved
{
    /**
     * Handle the event.
     */
    public function handle(UserFormRequestSaved $event ): void
    {
        if ($event->action == UserFormRequestLogActionsEnum::CREATE) {
            NotifyUsersFormRequestSavedJob::dispatchAfterResponse();
            NotifyCustomerRequestSavedJob::dispatchAfterResponse($event->userFormRequest);
        }
    }
}
