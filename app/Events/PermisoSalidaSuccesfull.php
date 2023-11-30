<?php

namespace App\Events;

use App\Models\UserFormRequest;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PermisoSalidaSuccesfull
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
}
