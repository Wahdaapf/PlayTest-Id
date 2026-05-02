<?php

namespace App\Notifications;

use App\Mail\VerifyEmailMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

/**
 * Custom email verification notification.
 *
 * Generates a signed verification URL pointing to our custom
 * verification route, and sends a branded HTML email instead of
 * Laravel's default plain-text notification.
 */
class VerifyEmailNotification extends VerifyEmail
{
    /**
     * Build the mail representation of the notification.
     *
     * Returns a Mailable so the custom Blade view renders as
     * pure HTML without Laravel's default mail layout wrapper.
     */
    public function toMail($notifiable): VerifyEmailMail
    {
        $url = $this->verificationUrl($notifiable);

        return (new VerifyEmailMail($url, $notifiable->name ?? ''))
            ->to($notifiable->getEmailForVerification());
    }

    /**
     * Generate a custom signed verification URL that points to our
     * bespoke controller instead of the default Laravel route.
     */
    protected function verificationUrl($notifiable): string
    {
        return URL::temporarySignedRoute(
            'email.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id'   => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}