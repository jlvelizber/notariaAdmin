<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class EmailPermisoSalidaSucessNotification extends Notification
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
            ->subject('Confirmación de Registro Exitoso - Siguientes Pasos')
            ->greeting("Estimado/a {$notifiable->getFullName()} ")
            ->line("Bienvenido a " . config('app.name'))
            ->line("Nos complace informarte que tu registro en nuestra plataforma se ha realizado exitosamente.")
            ->line("Para continuar con el proceso, adjuntamos un documento importante que deberás imprimir y presentar firmado, junto a las cédulas y certificado de votación de los representantes y la cédula del menor en la Notaría IV de Daule.")
            ->line(new HtmlString("Si requieres asistencia, no dudes en ponerte en contacto con nuestro equipo de soporte a <a href='mailto:info@notaria4daule.com'>info@notaria4daule.com</a> o a través de WhatsApp al <a href='tel:+593989818094'>+593 98 981 8094</a>"))
            ->line("Gracias por elegir a la " . config('app.name'))
            ->line("Saludos cordiales,")
            ->line(config('app.name'))
            ->line(
                new HtmlString("<a href='tel:+593989818094'>+593 98 981 8094</a><br/><a href='mailto:info@notaria4daule.com'>info@notaria4daule.com</a><br/> <span>Dirección Avenida León Febres Cordero Ribadeneyra, Edificio Platinium II, Daule 091910</span>"),
            )
            // envia el adjunto
            ->attach($this->attachFilePath);
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
