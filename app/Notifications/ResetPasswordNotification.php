<?php

namespace App\Notifications;

use App\Mail\ResetPasswordMail;
use Filament\Auth\Notifications\ResetPassword as FilamentResetPassword;

/**
 * Custom reset-password notification that replaces Filament's default.
 *
 * Extends Filament\Auth\Notifications\ResetPassword so the container
 * binding works correctly when Filament resolves the notification via app().
 */
class ResetPasswordNotification extends FilamentResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * Returns a Mailable (not MailMessage) so the custom Blade view
     * renders as pure HTML without Laravel's default mail layout wrapper.
     */
    public function toMail($notifiable): ResetPasswordMail
    {
        // $this->url is set by Filament in RequestPasswordReset::request()
        // Fallback to resetUrl() for non-Filament contexts (e.g. CLI/Tinker)
        $url = $this->url ?? $this->resetUrl($notifiable);

        return (new ResetPasswordMail($url))
            ->to($notifiable->getEmailForPasswordReset());
    }
}