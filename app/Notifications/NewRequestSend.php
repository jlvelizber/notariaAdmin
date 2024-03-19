<?php

namespace App\Notifications;

use App\Models\UserFormRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRequestSend extends Notification
{
    use Queueable;
    private UserFormRequest $userFormRequest;
    /**
     * Create a new notification instance.
     */
    public function __construct(UserFormRequest $userFormRequest)
    {
        $this->userFormRequest = $userFormRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nueva Solicitud Realizada')
            ->line('Se ha recibido una nueva solicitud  de ' .  $this->userFormRequest->doc->name  . ' con identificador ' .   $this->userFormRequest->id  . ' ,puede ver el estado de su solicitud ingresando a sistema administrativo de ' . config('app.name'))
            ->action('Ingresar al sistema', url(env('APP_CLIENT_URL')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
