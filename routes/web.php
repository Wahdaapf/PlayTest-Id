<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\DuitkuController;
use Illuminate\Support\Facades\Route;
use App\Models\Paket;

Route::get('/', function (\Illuminate\Http\Request $request) {
    $supportedLocales = ['id', 'en'];
    $selectedLocale = config('app.fallback_locale');

    if (\Illuminate\Support\Facades\Session::has('app_locale')) {
        $selectedLocale = \Illuminate\Support\Facades\Session::get('app_locale');
    } elseif ($request->hasHeader('Accept-Language')) {
        $browserLanguage = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        if (in_array($browserLanguage, $supportedLocales)) {
            $selectedLocale = $browserLanguage;
        }
    }
    
    return redirect('/' . $selectedLocale);
});

Route::prefix('{locale}')->where(['locale' => 'id|en'])->middleware(\App\Http\Middleware\LanguageManagerMiddleware::class)->group(function () {
    Route::get('/', function () {
        $pakets = Paket::where('aktif', true)->orderBy('price', 'asc')->get();
        return view('welcome', compact('pakets'));
    })->name('welcome');
});

// ── Static Pages ───────────────────────────────────────────────────────────
Route::middleware(\App\Http\Middleware\LanguageManagerMiddleware::class)->group(function () {
    Route::get('/kebijakan-privasi', fn() => view('pages.kebijakan-privasi'))->name('kebijakan-privasi');
    Route::get('/syarat-ketentuan',  fn() => view('pages.syarat-ketentuan'))->name('syarat-ketentuan');
    Route::get('/faq',               fn() => view('pages.faq'))->name('faq');
    Route::get('/hubungi-kami',      fn() => view('pages.hubungi-kami'))->name('hubungi-kami');
});

Route::get('/language/switch/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        \Illuminate\Support\Facades\Session::put('app_locale', $locale);
    }
    return back();
})->name('language.switch');

Route::post('/payment', [DuitkuController::class, 'createTransaction']);
Route::post('/duitku/callback', [DuitkuController::class, 'callback']);
Route::get('/duitku/return', [DuitkuController::class, 'return']);
Route::post('/xendit/callback', [\App\Http\Controllers\XenditController::class, 'payoutCallback']);

// ── Admin Export Routes ──────────────────────────────────────────────────────
Route::prefix('admin/export')
    ->middleware(['web', 'auth'])
    ->group(function () {
        Route::get('/pengguna',  [\App\Http\Controllers\Admin\ExportController::class, 'exportPengguna'])->name('admin.export.pengguna');
        Route::get('/kampanye',  [\App\Http\Controllers\Admin\ExportController::class, 'exportKampanye'])->name('admin.export.kampanye');
        Route::get('/pendapatan',[\App\Http\Controllers\Admin\ExportController::class, 'exportPendapatan'])->name('admin.export.pendapatan');
        Route::get('/withdraw',  [\App\Http\Controllers\Admin\ExportController::class, 'exportWithdraw'])->name('admin.export.withdraw');
        Route::get('/pdf',       [\App\Http\Controllers\Admin\ExportController::class, 'exportPdf'])->name('admin.export.pdf');
    });

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

