<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\DuitkuController;
use Illuminate\Support\Facades\Route;
use App\Models\Paket;

Route::redirect('/', '/id');

Route::prefix('{locale}')->where(['locale' => 'id|en'])->group(function () {
    Route::get('/', function ($locale) {
        App::setLocale($locale);
        $pakets = Paket::where('aktif', true)->orderBy('price', 'asc')->get();
        return view('welcome', compact('pakets'));
    })->name('welcome');
});

Route::post('/payment', [DuitkuController::class, 'createTransaction']);
Route::post('/duitku/callback', [DuitkuController::class, 'callback']);
Route::get('/duitku/return', [DuitkuController::class, 'return']);
Route::post('/xendit/callback', [\App\Http\Controllers\XenditController::class, 'payoutCallback']);

Route::get('/auth/google', [\App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
|
| Dua alur verifikasi:
|
| A. PENDING REGISTRATION (user belum ada di DB)
|    GET /email/pending              → halaman "Cek inbox kamu" setelah signup
|    GET /email/pending-verify/{token} → buat user di DB, login, redirect ke /email/verified
|
| B. RESEND VERIFICATION (user sudah di DB, belum verified)
|    GET /email/verify/{id}/{hash}   → tandai verified, login, redirect ke /email/verified
|
| C. SUCCESS PAGE
|    GET /email/verified             → halaman sukses animasi, auto-redirect ke panel
|
*/

// ── A. Pending Registration ──────────────────────────────────────────────

// Halaman "Check your inbox" — standalone, tanpa auth
Route::get('/email/pending', function () {
    $email = request()->query('email', '');
    $panel = request()->query('panel', 'tester');
    $token = request()->query('token', '');
    return view('vendor.filament-panels.auth.pages.email-pending', compact('email', 'panel', 'token'));
})->name('email.pending');

// Resend email verifikasi untuk pending registration (user belum di DB)
Route::post('/email/pending/resend', [\App\Http\Controllers\Auth\EmailVerificationController::class, 'resendPending'])
    ->middleware('throttle:3,1')
    ->name('email.pending.resend');

// Handler klik link di email → buat user di DB
// CATATAN: middleware 'signed' sengaja TIDAK dipakai di sini agar controller
// bisa menangkap expired/invalid signature sendiri dan redirect ke halaman custom.
// Validasi tetap dilakukan di controller via $request->hasValidSignature().
Route::get('/email/pending-verify/{token}', [EmailVerificationController::class, 'pendingVerify'])
    ->middleware(['throttle:6,1'])
    ->name('email.pending.verify');

// ── B. Resend Verification (untuk akun existing yang belum verified) ─────

// Sama — validasi signature dilakukan manual di controller.
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['throttle:6,1'])
    ->name('email.verify');

// ── C. Link Expired Page ─────────────────────────────────────────────────

Route::get('/email/expired', function () {
    $panel = request()->query('panel', 'tester');
    $allowedPanels = ['tester', 'developer', 'admin'];
    if (!in_array($panel, $allowedPanels, true)) {
        $panel = 'tester';
    }
    return view('vendor.filament-panels.auth.pages.email-expired', compact('panel'));
})->name('email.expired');

// ── D. Success Page ──────────────────────────────────────────────────────

Route::get('/email/verified', function () {
    $panel = request()->query('panel', '/tester');

    // Whitelist panel paths — cegah open-redirect
    $allowedPanels = ['/tester', '/developer', '/admin'];
    if (!in_array($panel, $allowedPanels, true)) {
        $panel = '/tester';
    }

    return view('vendor.filament-panels.auth.pages.email-verified', compact('panel'));
})->name('email.verified');

