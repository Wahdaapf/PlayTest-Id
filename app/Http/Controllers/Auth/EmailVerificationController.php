<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmailMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller
{
    /**
     * ─────────────────────────────────────────────────────────────
     * PENDING REGISTRATION VERIFICATION
     * ─────────────────────────────────────────────────────────────
     * Dipanggil saat user klik link di email setelah mendaftar.
     *
     * Alur:
     *  1. Validasi signed URL
     *  2. Ambil data pendaftaran dari Cache
     *  3. Buat user baru di database (pertama kali masuk DB)
     *  4. Tandai email sebagai verified sekaligus
     *  5. Login user ke session
     *  6. Redirect ke halaman sukses
     */
    public function pendingVerify(Request $request, string $token): RedirectResponse
    {
        // 1. Validasi signed URL — tolak jika sudah expired atau dimanipulasi
        if (! $request->hasValidSignature()) {
            return redirect()->route('email.expired', ['panel' => 'tester']);
        }

        // 2. Ambil data dari cache
        $cacheKey = 'pending_registration:' . $token;
        $data     = Cache::get($cacheKey);

        if (! $data) {
            return redirect()->route('email.expired', ['panel' => 'tester']);
        }

        // 3. Cegah duplikat — jika email sudah terdaftar & terverifikasi
        $existing = User::where('email', $data['email'])->first();
        if ($existing) {
            // Email sudah terdaftar, langsung login dan redirect ke panel
            Cache::forget($cacheKey);
            Auth::login($existing, remember: true);
            $panelPath = $this->panelPath($existing->role?->value);
            return redirect()->route('email.verified', ['panel' => $panelPath]);
        }

        // 4. Buat user di database — pertama kali masuk DB.
        //
        //    PENTING: password di cache sudah di-hash oleh Hash::make() di Register.php.
        //    Kita TIDAK bisa pakai User::create() langsung karena model punya cast
        //    'password' => 'hashed' yang akan meng-hash LAGI → double-hash → login gagal.
        //
        //    Solusi: setRawAttributes() menyimpan nilai as-is ke atribut model,
        //    melewati semua cast dan mutator, sehingga hash tidak diproses ulang.
        $user = new User();
        $user->setRawAttributes([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => $data['password'], // hash dari cache, simpan langsung
            'role'              => $data['role'],
            'email_verified_at' => now()->toDateTimeString(),
        ]);
        $user->save();

        // 5. Hapus cache setelah user berhasil dibuat
        Cache::forget($cacheKey);

        // 6. Dispatch events
        event(new Registered($user));
        event(new Verified($user));

        // 7. Login user ke session agar saat redirect ke panel, langsung masuk dashboard
        Auth::login($user, remember: true);

        // 8. Redirect ke halaman sukses
        $panelPath = $this->panelPath($data['role']);
        return redirect()->route('email.verified', ['panel' => $panelPath]);
    }

    /**
     * ─────────────────────────────────────────────────────────────
     * RESEND PENDING VERIFICATION (user belum ada di DB, masih di cache)
     * ─────────────────────────────────────────────────────────────
     * Dipanggil dari tombol "Resend Verification Email" di halaman
     * /email/pending. Membuat signed URL baru dengan token yang sama
     * dan mengirim ulang email verifikasi.
     */
    public function resendPending(Request $request): RedirectResponse
    {
        $request->validate(['token' => 'required|string|max:255']);

        $token    = $request->input('token');
        $cacheKey = 'pending_registration:' . $token;
        $data     = Cache::get($cacheKey);

        if (! $data) {
            return back()
                ->with('resend_error', 'Verification link has expired. Please register again.')
                ->withInput(['token' => $token]);
        }

        // Buat signed URL baru dengan token yang sama, perpanjang 60 menit dari sekarang
        $verifyUrl = URL::temporarySignedRoute(
            'email.pending.verify',
            now()->addMinutes(60),
            ['token' => $token]
        );

        // Perpanjang TTL cache sekalian
        Cache::put($cacheKey, $data, now()->addMinutes(60));

        Mail::to($data['email'])->send(new VerifyEmailMail($verifyUrl, $data['name']));

        return back()->with('resent', true);
    }

    /**
     * ─────────────────────────────────────────────────────────────
     * RESEND VERIFICATION (untuk user yang sudah ada di DB tapi belum verified)
     * ─────────────────────────────────────────────────────────────
     * Dipanggil dari route /email/verify/{id}/{hash}
     * (digunakan oleh VerifyEmailNotification → resend dari prompt page)
     */
    public function verify(Request $request, string $id, string $hash): RedirectResponse
    {
        // 1. Validasi signed URL
        if (! $request->hasValidSignature()) {
            return redirect()->route('email.expired', ['panel' => 'tester']);
        }

        // 2. Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // 3. Pastikan hash cocok dengan email user
        if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            return redirect()->route('email.expired', ['panel' => $user->role?->value ?? 'tester']);
        }

        // 4. Tandai sebagai verified jika belum
        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        // 5. Login user ke session
        Auth::login($user, remember: true);

        // 6. Redirect ke halaman sukses
        $panelPath = $this->panelPath($user->role?->value);
        return redirect()->route('email.verified', ['panel' => $panelPath]);
    }

    /**
     * Konversi role string ke URL path panel.
     */
    private function panelPath(?string $role): string
    {
        return match ($role) {
            'developer' => '/developer',
            'admin'     => '/admin',
            default     => '/tester',
        };
    }
}