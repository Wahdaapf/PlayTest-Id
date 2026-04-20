<?php

namespace App\Filament\Auth\Pages;

use Filament\Auth\Pages\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    /**
     * Override view dengan tampilan login kustom mobile-first.
     */
    protected string $view = 'vendor.filament-panels.auth.pages.login';

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
