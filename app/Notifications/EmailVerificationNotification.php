<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class EmailVerificationNotification extends VerifyEmail
{
    use Queueable;
    

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $prefix = env('APP_CLIENT_URL') . '/verificar-cuenta?url=';
        $verificationUrl = $this->verificationUrl($notifiable);

        $url = $prefix . urlencode($verificationUrl);

        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->line(Lang::get('Please click the button below to verify your email address.'))
            ->action(Lang::get('Verify Email Address'), $url);
    }
}
