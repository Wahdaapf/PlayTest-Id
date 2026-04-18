<?php

namespace App\Filament\Auth\Pages;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Filament\Auth\Pages\PasswordReset\RequestPasswordReset as BaseRequestPasswordReset;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Password;
use LogicException;

class RequestResetPassword extends BaseRequestPasswordReset
{
    /**
     * Override view dengan tampilan login kustom mobile-first.
     */
    protected string $view = 'vendor.filament-panels.auth.pages.request-reset-password';

    /**
     * Override request() agar menampilkan notifikasi gagal
     * ketika email tidak memiliki akses ke panel ini.
     */
    public function request(): void
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();
            return;
        }

        $data = $this->form->getState();

        // Track apakah email benar-benar terkirim
        $emailWasSent = false;

        $status = Password::broker(Filament::getAuthPasswordBroker())->sendResetLink(
            $this->getCredentialsFromFormData($data),
            function (CanResetPassword $user, string $token) use (&$emailWasSent): void {
                // Cek apakah user punya akses ke panel ini
                if (
                    ($user instanceof FilamentUser) &&
                    (! $user->canAccessPanel(Filament::getCurrentOrDefaultPanel()))
                ) {
                    // User ditemukan tapi tidak punya akses ke panel ini
                    return;
                }

                if (! method_exists($user, 'notify')) {
                    $userClass = $user::class;
                    throw new LogicException("Model [{$userClass}] does not have a [notify()] method.");
                }

                $notification = app(ResetPasswordNotification::class, ['token' => $token]);
                $notification->url = Filament::getResetPasswordUrl($token, $user);

                $user->notify($notification);
                $emailWasSent = true;
            },
        );

        // Jika email tidak ditemukan sama sekali di database
        if ($status !== Password::RESET_LINK_SENT) {
            $this->getFailureNotification($status)?->send();
            return;
        }

        // Jika email ditemukan tapi user tidak punya akses ke panel ini
        if (! $emailWasSent) {
            $this->getNoAccessNotification()->send();
            return;
        }

        // Email berhasil terkirim
        $this->getSentNotification($status)?->send();
        $this->form->fill();
    }

    /**
     * Notifikasi ketika email terdaftar tapi tidak punya akses ke panel ini.
     */
    protected function getNoAccessNotification(): Notification
    {
        return Notification::make()
            ->title('Email not found')
            ->body('This email is not registered. Please register your account.')
            ->danger();
    }

    /**
     * Sembunyikan logo default Filament karena kita render sendiri.
     */
    public function hasLogo(): bool
    {
        return false;
    }

    /**
     * Sembunyikan heading default karena kita render sendiri.
     */
    public function getHeading(): string|Htmlable|null
    {
        return null;
    }

    /**
     * Sembunyikan subheading default karena kita render sendiri.
     */
    public function getSubheading(): string|Htmlable|null
    {
        return null;
    }
}
