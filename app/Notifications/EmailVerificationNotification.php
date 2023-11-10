<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class EmailVerificationNotification extends VerifyEmail
{
    use Queueable;


    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $prefix = env('APP_CLIENT_URL') . '/verificar-cuenta';
        $verificationUrl = $this->verificationUrl($notifiable);

        $url = $prefix . '?id=' . $verificationUrl['id'] . '&hash=' . $verificationUrl['hash'] . '&expires=' . $verificationUrl['expires'];

        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->line(Lang::get('Please click the button below to verify your email address.'))
            ->action(Lang::get('Verify Email Address'), $url);
    }


    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {

        return [
            'id' => $notifiable->getKey(),
            'expires' => Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ];
    }
}
