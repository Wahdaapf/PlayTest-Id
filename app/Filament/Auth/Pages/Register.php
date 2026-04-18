<?php

namespace App\Filament\Auth\Pages;

use Filament\Auth\Pages\Register as BaseRegister;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Facades\Filament;

class Register extends BaseRegister
{
    /**
     * Override view dengan tampilan login kustom mobile-first.
     */
    protected string $view = 'vendor.filament-panels.auth.pages.register';

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

    protected function mutateFormDataBeforeRegister(array $data): array
    {
        // Mendapatkan ID panel yang sedang aktif (misal: 'tester' atau 'developer')
        $panelId = Filament::getCurrentPanel()?->getId();

        // Menyuntikkan ID panel sebagai role ke dalam database
        if ($panelId) {
            $data['role'] = $panelId;
        }

        return $data;
    }
}
