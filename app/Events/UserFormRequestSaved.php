<?php

namespace App\Events;

use App\Enums\UserFormRequestLogActionsEnum;
use App\Models\UserFormRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserFormRequestSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userFormRequest;
    public UserFormRequestLogActionsEnum $action;

    /**
     * Create a new event instance.
     */
    public function __construct(UserFormRequest $userFormRequest, UserFormRequestLogActionsEnum $action = UserFormRequestLogActionsEnum::CREATE)
    {
        $this->userFormRequest = $userFormRequest;
        $this->action = $action;
    }
}
