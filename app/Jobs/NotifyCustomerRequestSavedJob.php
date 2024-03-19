<?php

namespace App\Jobs;

use App\Models\UserFormRequest;
use App\Notifications\NewRequestSend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyCustomerRequestSavedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private  UserFormRequest $userFormRequest;
    /**
     * Create a new job instance.
     */
    public function __construct(UserFormRequest $userFormRequest)
    {
        $this->userFormRequest = $userFormRequest;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $customer = $this->userFormRequest->customer ? $this->userFormRequest->customer  : null;
        if($customer) $customer->notify(new NewRequestSend($this->userFormRequest));
    }
}
