<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class LanguageManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah ada parameter locale di URL (untuk Landing Page)
        $localeFromUrl = $request->segment(1);
        
        $supportedLocales = ['id', 'en'];
        $selectedLocale = config('app.fallback_locale'); // Default 'id'
        $isPrefixedUrl = false;

        if (in_array($localeFromUrl, $supportedLocales)) {
            $selectedLocale = $localeFromUrl;
            $isPrefixedUrl = true;
        } 
        // 2. Jika tidak ada di URL (misal Filament), cek di Session
        elseif (Session::has('app_locale')) {
            $selectedLocale = Session::get('app_locale');
        } 
        // 3. Jika tidak ada di Session, deteksi dari Browser Header
        elseif ($request->hasHeader('Accept-Language')) {
            $browserLanguage = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            if (in_array($browserLanguage, $supportedLocales)) {
                $selectedLocale = $browserLanguage;
            }
        }

        // Apply selected locale to Application
        App::setLocale($selectedLocale);

        // Selalu simpan ke Session agar sinkron dengan Filament
        Session::put('app_locale', $selectedLocale);

        // Jika ini adalah request ke Landing Page (punya prefix), set default URL untuk fungsi route()
        if ($isPrefixedUrl || $request->is('/')) {
            URL::defaults(['locale' => $selectedLocale]);
        }

        return $next($request);
    }
}
