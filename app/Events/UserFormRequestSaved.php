<?php

namespace App\Events;

use App\Models\UserFormRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserFormRequestSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userFormRequest;

    /**
     * Create a new event instance.
     */
    public function __construct(UserFormRequest $userFormRequest)
    {
        $this->userFormRequest = $userFormRequest;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
