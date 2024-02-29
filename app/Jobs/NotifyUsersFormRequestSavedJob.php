<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\NewRequestReceived;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyUsersFormRequestSavedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $roles = [
            'administrator',
            'secreatary',
            'notary'
        ];

        $users  = User::rolesWithRoleNames($roles, 'email')->get();
        foreach ($users as $user) {
            $user->notify(new NewRequestReceived());
        }
    }
}
