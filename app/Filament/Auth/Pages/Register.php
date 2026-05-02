<?php

namespace App\Filament\Auth\Pages;

use App\Mail\VerifyEmailMail;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Facades\Filament;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Register extends BaseRegister
{
    /**
     * Override view dengan tampilan register kustom mobile-first.
     */
    protected string $view = 'vendor.filament-panels.auth.pages.register';

    public function hasLogo(): bool
    {
        return false;
    }

    public function getHeading(): string|Htmlable|null
    {
        return null;
    }

    public function getSubheading(): string|Htmlable|null
    {
        return null;
    }

    /**
     * Override register() sepenuhnya agar user TIDAK langsung masuk database.
     *
     * Alur baru:
     *  1. Validasi form (unique email, password confirm, dll) via $this->form->getState()
     *  2. Simpan data pendaftaran ke Cache selama 60 menit
     *  3. Kirim email verifikasi berisi signed URL → /email/pending-verify/{token}
     *  4. Redirect ke halaman standalone /email/pending (tanpa perlu login)
     *
     * User baru dibuat di database HANYA setelah klik link verifikasi di email.
     *
     * Return type HARUS ?RegistrationResponse agar kompatibel dengan parent.
     * Redirect dilakukan via $this->redirect() (Livewire), bukan return redirect().
     */
    public function register(): ?RegistrationResponse
    {
        // 1. Ambil & validasi data form (validasi berjalan di sini, termasuk unique:users)
        //    $this->form->getState() mengembalikan nilai MENTAH — password BELUM di-hash.
        $data = $this->form->getState();

        // 2. Inject role dari panel aktif
        $panelId = Filament::getCurrentPanel()?->getId();
        if ($panelId) {
            $data['role'] = $panelId;
        }

        $name  = $data['name'];
        $email = $data['email'];
        $token = Str::uuid()->toString();

        // 3. Simpan ke cache.
        //    Password di-hash secara eksplisit di sini (tidak boleh menyimpan plain text).
        //    Di controller pendingVerify(), password yang sudah di-hash ini akan disimpan
        //    langsung ke DB via setRawAttributes() untuk menghindari double-hashing
        //    dari cast 'password' => 'hashed' milik model User.
        Cache::put('pending_registration:' . $token, [
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($data['password']), // hash eksplisit sebelum masuk cache
            'role'     => $data['role'] ?? 'tester',
        ], now()->addMinutes(60));

        // 4. Buat signed URL ke route verifikasi pending
        $verifyUrl = URL::temporarySignedRoute(
            'email.pending.verify',
            now()->addMinutes(60),
            ['token' => $token]
        );

        // 5. Kirim email verifikasi branded
        Mail::to($email)->send(new VerifyEmailMail($verifyUrl, $name));

        // 6. Redirect via $this->redirect() (cara Livewire) — BUKAN return redirect().
        //    Dengan ini return type tetap ?RegistrationResponse dan kita return null.
        $this->redirect(route('email.pending', [
            'email' => $email,
            'panel' => $panelId ?? 'tester',
            'token' => $token,
        ]));

        return null;
    }
}
