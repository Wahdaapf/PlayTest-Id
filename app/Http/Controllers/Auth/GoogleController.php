<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        // Store the originating panel in session so we can redirect back on cancel
        $panel = $request->query('panel', 'tester');
        $allowedPanels = ['tester', 'developer', 'admin'];

        if (!in_array($panel, $allowedPanels, true)) {
            $panel = 'tester';
        }

        session(['google_auth_panel' => $panel]);

        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        // Retrieve the panel the user came from
        $panel = session('google_auth_panel', 'tester');
        $loginUrl = "/{$panel}/login";

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // ── Role-vs-Panel validation ──────────────────────────
                // Admin panel: only admin role allowed
                if ($panel === 'admin' && $user->role !== UserRole::admin) {
                    session()->forget('google_auth_panel');
                    return redirect($loginUrl)->with('error', 'Akun ini tidak memiliki akses admin.');
                }

                // Developer panel: only developer (and admin) allowed
                if ($panel === 'developer' && $user->role !== UserRole::developer && $user->role !== UserRole::admin) {
                    session()->forget('google_auth_panel');
                    return redirect($loginUrl)->with('error', 'Akun ini terdaftar sebagai tester. Silakan login melalui halaman tester.');
                }

                // Tester panel: only tester (and admin) allowed
                if ($panel === 'tester' && $user->role !== UserRole::tester && $user->role !== UserRole::admin) {
                    session()->forget('google_auth_panel');
                    return redirect($loginUrl)->with('error', 'Akun ini terdaftar sebagai developer. Silakan login melalui halaman developer.');
                }

                // Existing user — link Google ID if not already linked
                if (!$user->google_id) {
                    $user->google_id = $googleUser->getId();
                    $user->save();
                }
                Auth::login($user);
            } else {
                // Admin panel: do NOT allow creating new accounts via Google
                if ($panel === 'admin') {
                    session()->forget('google_auth_panel');
                    return redirect($loginUrl)->with('error', 'Akun admin tidak terdaftar. Hubungi administrator.');
                }

                // New user — create account with Google info (tester/developer only)
                $user = User::create([
                    'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Google User',
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(Str::random(32)),
                    'email_verified_at' => now(),
                    'role' => $panel,
                ]);
                Auth::login($user);
            }

            // Clean up session
            session()->forget('google_auth_panel');

            // Redirect based on the panel they logged in from
            return redirect()->intended("/{$panel}");
        } catch (\Exception $e) {
            Log::error('Google OAuth login failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Clean up session
            session()->forget('google_auth_panel');

            // Redirect back to the login page of the panel they came from
            return redirect($loginUrl)->with('error', 'Login with Google failed. Please try again.');
        }
    }
}
