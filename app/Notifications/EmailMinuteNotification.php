<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailMinuteNotification extends Notification
{
    use Queueable;

    private $attachFilePath;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $attachFilePath)
    {
        $this->attachFilePath = $attachFilePath;
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
                    ->subject('Carta de aceptación de Permiso de salida')
                    ->line('Hay un permiso de salida!')
                    ->attach($this->attachFilePath);
    }
}
