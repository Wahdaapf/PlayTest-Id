<?php

namespace App\Filament\Auth\Pages;

use Filament\Auth\Pages\PasswordReset\ResetPassword as BaseResetPassword;
use Illuminate\Contracts\Support\Htmlable;

class ResetPassword extends BaseResetPassword
{
    /**
     * Override view dengan tampilan reset password kustom mobile-first.
     * Matching design system dari login.blade.php & request-reset-password.blade.php
     */
    protected string $view = 'vendor.filament-panels.auth.pages.reset-password';

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
