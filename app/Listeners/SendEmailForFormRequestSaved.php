<?php

namespace App\Listeners;

use App\Enums\UserFormRequestLogActionsEnum;
use App\Events\UserFormRequestSaved;
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
            $roles = [
                'administrator',
                'secreatary',
                'notary'
            ];

            $users  = User::rolesWithRoleNames($roles, 'email')->get();
            
            foreach ($users as $user) {
                // if($user->hasVerifiedEmail()) {
                    $user->notify(new NewRequestReceived());
                // }
            }


        }
    }
}
