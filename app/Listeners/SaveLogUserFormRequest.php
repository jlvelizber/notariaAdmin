<?php

namespace App\Listeners;

use App\Enums\UserFormRequestLogActionsEnum;
use App\Events\UserFormRequestSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveLogUserFormRequest
{
    /**
     * Handle the event.
     */
    public UserFormRequestLogActionsEnum $action;


    public function handle(UserFormRequestSaved $event): void
    {
        $this->action = $event->action;
        $event->userFormRequest->logs()->create([
            'user_id' => auth()->user()->id,
            'action' => $this->action->value,
            'description' => $this->makeDescription()
        ]);
    }

    private function makeDescription() : string
    {
        switch ($this->action->value) {
            case 'create':
                return 'Se ha creado una solicitud';
            case 'update':
                return 'Se ha actualizado la solicitud';
                break;
            case 'delete':
                return 'Se ha eliminado';
                break;
            default:
                return 'Se ha actualizado de estado';
                break;
        }
    }
}
