<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Expired - PlayTest ID</title>
    <link rel="icon" href="{{ asset('logoheader.png') }}" type="image/png" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        /* ================================================================
           PAGE WRAPPER
           ================================================================ */
        .verify-page {
            display: flex;
            flex-direction: column;
            height: 100dvh;
            font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;
            /* MOBILE: rich gradient background replaced by auth-mobile-bg */
            background: transparent;
            position: relative;
            overflow-y: auto;
            /* Scroll hanya muncul jika layar sangat-sangat kecil */
        }

        /* ================================================================
           MOBILE HEADER
           ================================================================ */
        .verify-mobile-header {
            position: relative;
            padding: calc(env(safe-area-inset-top, 0px) + 2.5rem) 1.75rem 0;
            text-align: center;
            animation: verifyFadeInDown 0.55s cubic-bezier(0.22, 1, 0.36, 1);
            z-index: 1;
        }

        .verify-mobile-header-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.625rem;
            margin-bottom: 1.25rem;
        }

        .verify-mobile-header-icon {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 0.875rem;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .verify-mobile-header-icon .material-symbols-outlined {
            font-size: 1.625rem !important;
            color: #fff !important;
        }

        .verify-mobile-brand-name {
            font-size: 1.375rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: #fff;
            margin: 0;
        }

        .verify-mobile-header-tagline {
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.75);
            margin: 0;
            letter-spacing: 0.005em;
        }

        /* ================================================================
           HERO / LEFT PANEL (desktop only)
           ================================================================ */
        .verify-hero {
            display: none;
        }

        .verify-hero-bg-img {
            position: absolute;
            inset: 0;
            background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAI9gJnovj2fCx3g9q-dArBHoXKgL9Or-jNTVccMUrSSXS6h9V7VHA3JK9qxF2phWOHbwFoBk2PVClUCxM2SRGSgHx4TfLhfdcjL7IzZZyfXUVf-hDdASQ8EeYaWlpAqIZr9PB8-jjHhh9fvngXsdnywYFWJUELojKH0Fla6ekbnJZErBhOAWwOgO0JPbsDar5uUCF3xA2xUXMwI6oAsoLtnzCvXVldkYIVE14N4UbS3YnpfuKzIFODWYCtPWlLzai-tZcPuiaKTIQ');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            pointer-events: none;
        }

        .verify-hero-bg-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(249, 250, 251, 0.92) 0%, rgba(249, 250, 251, 0.55) 100%);
            pointer-events: none;
        }

        .verify-hero-content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
        }

        .verify-logo {
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            color: #4F46E5;
            margin-bottom: 0.5rem;
        }

        .verify-logo-icon {
            font-size: 2rem;
            line-height: 1;
        }

        .verify-brand-name {
            font-size: 1.375rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: #111827;
            margin: 0;
        }

        .verify-hero-title {
            font-size: 2rem;
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -0.035em;
            color: #111827;
            margin: 1.25rem 0 0.875rem;
        }

        .verify-hero-desc {
            font-size: 1.0625rem;
            color: #6b7280;
            line-height: 1.65;
            font-weight: 500;
            max-width: 400px;
            margin: 0;
        }

        .verify-hero-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.625rem;
            margin-top: 5rem;
        }

        .verify-hero-pill {
            display: inline-flex;
            align-items: center;
            background: rgba(79, 70, 229, 0.05);
            border: 1.5px solid rgba(79, 70, 229, 0.3);
            color: #4F46E5;
            border-radius: 9999px;
            padding: 0.4rem 0.875rem;
            font-size: 0.8125rem;
            font-weight: 700;
            white-space: nowrap;
            font-family: 'Manrope', sans-serif;
        }

        .verify-hero-footer {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 2rem;
        }

        .verify-avatars {
            display: flex;
        }

        .verify-avatar-initials {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: 700;
            color: white;
            border: 2px solid #ffffff;
            margin-left: -0.5rem;
        }

        .verify-avatar-initials:first-child {
            margin-left: 0;
        }

        .verify-social-proof {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
            font-weight: 500;
        }

        /* ================================================================
           CARD SECTION
           ================================================================ */
        .verify-card-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-top: 1.5rem;
        }

        .verify-card {
            flex: 1;
            padding: 2rem 1.5rem;
            background: #ffffff;
            border-radius: 1.5rem 1.5rem 0 0;
            display: flex;
            flex-direction: column;
            animation: verifySlideUp 0.5s ease-out 0.1s both;
            box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.08);
        }

        .verify-card-inner {
            width: 100%;
            max-width: 440px;
            margin: 0 auto;
            position: relative;
        }

        /* ================================================================
           EXPIRED ICON BADGE
           ================================================================ */
        .verify-envelope-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 1.25rem;
        }

        .verify-expired-badge {
            position: relative;
            width: 6rem;
            height: 6rem;
            background: linear-gradient(135deg, #ef4444 0%, #f97316 100%);
            border-radius: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 32px rgba(239, 68, 68, 0.35);
            animation: expiredPulse 2.5s ease-in-out infinite;
        }

        .verify-expired-badge .material-symbols-outlined {
            font-size: 2.75rem;
            color: #ffffff;
        }

        .verify-expired-dot {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 1.25rem;
            height: 1.25rem;
            background: #f59e0b;
            border-radius: 50%;
            border: 3px solid #ffffff;
            animation: verifyBounce 1s ease-in-out infinite alternate;
        }

        /* ================================================================
           CARD HEADER TEXT
           ================================================================ */
        .verify-card-header {
            text-align: center;
            margin-bottom: 1.25rem;
        }

        .verify-card-label {
            display: inline-block;
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.08) 0%, rgba(249, 115, 22, 0.08) 100%);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #ef4444;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border-radius: 9999px;
            padding: 0.3rem 0.875rem;
            margin-bottom: 1rem;
        }

        .verify-card-title {
            font-size: 1.625rem;
            font-weight: 900;
            color: #111827;
            margin: 0 0 0.625rem;
            letter-spacing: -0.03em;
            line-height: 1.2;
        }

        .verify-card-subtitle {
            font-size: 0.9375rem;
            color: #6b7280;
            margin: 0;
            line-height: 1.65;
            font-weight: 500;
        }

        /* ================================================================
           WHAT HAPPENED BOX
           ================================================================ */
        .verify-reason-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 0.875rem;
            padding: 1rem 1.125rem;
            margin-bottom: 1.25rem;
        }

        .verify-reason-title {
            font-size: 0.8125rem;
            font-weight: 800;
            color: #991b1b;
            margin: 0 0 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .verify-reason-title .material-symbols-outlined {
            font-size: 1rem !important;
        }

        .verify-reason-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
        }

        .verify-reason-list li {
            font-size: 0.8125rem;
            color: #b91c1c;
            font-weight: 600;
            display: flex;
            align-items: flex-start;
            gap: 0.375rem;
        }

        .verify-reason-list li::before {
            content: '•';
            flex-shrink: 0;
            margin-top: 0.05rem;
        }

        /* ================================================================
           ACTION BUTTONS
           ================================================================ */
        .verify-form-wrapper {
            margin-bottom: 1.25rem;
        }

        .verify-register-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            text-decoration: none;
            background: linear-gradient(135deg, #4F46E5 0%, #7c3aed 100%);
            color: #ffffff;
            border-radius: 0.875rem;
            padding: 0.875rem 1.5rem;
            min-height: 3.25rem;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Manrope', sans-serif;
            letter-spacing: 0.01em;
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.38);
            transition: all 0.2s ease;
        }

        .verify-register-btn:hover {
            background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.45);
            color: #ffffff;
        }

        .verify-register-btn:active {
            transform: scale(0.98);
        }

        .verify-register-btn .material-symbols-outlined {
            font-size: 1.1rem !important;
        }

        /* ================================================================
           BACK TO LOGIN LINK
           ================================================================ */
        .verify-back-link {
            text-align: center;
            font-size: 0.8125rem;
            color: #6b7280;
            margin-top: 0.75rem;
            font-weight: 500;
        }

        .verify-back-link a {
            color: #4F46E5 !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
        }

        .verify-back-link a:hover {
            color: rgba(79, 70, 229, 0.8) !important;
        }

        /* ================================================================
           SPAM NOTE — reused as info note
           ================================================================ */
        .verify-spam-note {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            margin-top: 1.25rem;
        }

        .verify-spam-note .material-symbols-outlined {
            font-size: 1.1rem !important;
            color: #d97706;
            flex-shrink: 0;
            margin-top: 0.125rem;
        }

        .verify-spam-note-text {
            font-size: 0.8rem;
            color: #92400e;
            line-height: 1.55;
            font-weight: 600;
            margin: 0;
        }

        /* ================================================================
           MOBILE FEATURE PILLS
           ================================================================ */
        .verify-mobile-features {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding: 1rem 1.5rem calc(1.5rem + env(safe-area-inset-bottom, 0px));
            background: #ffffff;
            border-top: 1px solid #f3f4f6;
            animation: verifyFadeIn 0.5s ease-out 0.5s both;
        }

        .verify-mobile-pill {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.08) 0%, rgba(124, 58, 237, 0.08) 100%);
            color: #4F46E5;
            border-radius: 9999px;
            padding: 0.4rem 0.875rem;
            font-size: 0.75rem;
            font-weight: 700;
            border: 1px solid rgba(79, 70, 229, 0.18);
            letter-spacing: 0.01em;
        }

        /* ================================================================
           ANIMATIONS
           ================================================================ */
        @keyframes verifyFadeInDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes verifySlideUp {
            from {
                opacity: 0;
                transform: translateY(32px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes verifyFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes expiredPulse {

            0%,
            100% {
                box-shadow: 0 12px 32px rgba(239, 68, 68, 0.35);
            }

            50% {
                box-shadow: 0 12px 48px rgba(239, 68, 68, 0.5);
                transform: scale(1.04);
            }
        }

        @keyframes verifyBounce {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.25);
            }
        }

        /* ================================================================
           TABLET (≥ 640px)
           ================================================================ */
        @media (min-width: 640px) {
            .verify-card {
                padding: 2.5rem 2.5rem 2rem;
            }

            .verify-card-title {
                font-size: 1.875rem;
            }
        }

        /* ================================================================
           DESKTOP (≥ 1024px) — Split-screen
           ================================================================ */
        @media (min-width: 1024px) {

            .verify-page {
                background: #ffffff;
                flex-direction: row;
            }

            .verify-mobile-header {
                display: none !important;
            }

            .verify-mobile-features {
                display: none;
            }

            .verify-hero {
                position: relative;
                overflow: hidden;
                display: flex;
                flex: 1;
                flex-direction: column;
                justify-content: space-between;
                text-align: left;
                padding: 3rem 3.5rem;
                border-bottom: none;
                border-right: 1px solid #e5e7eb;
                animation: verifyFadeIn 0.6s ease-out;
                background: #f9fafb;
            }

            .verify-card-section {
                margin-top: 0;
                width: 50%;
                flex: 0 0 50%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                overflow-y: auto;
            }

            .verify-card {
                border-radius: 0;
                box-shadow: none;
                padding: 2.5rem 3rem;
                flex: none;
                background: #ffffff;
                animation: verifyFadeIn 0.5s ease-out;
                height: 100dvh;
                overflow: hidden;
            }

            .verify-card-inner {
                max-width: 400px;
                margin: 0 auto;
            }

            .verify-card-header {
                text-align: center;
            }

            .verify-card-title {
                font-size: 2rem;
            }

            .verify-register-btn {
                border-radius: 0.5rem !important;
                padding: 0.75rem 1.5rem !important;
                font-size: 0.9375rem !important;
                min-height: 3rem !important;
                box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
                letter-spacing: 0 !important;
            }

            .verify-expired-badge {
                width: 4.5rem;
                height: 4.5rem;
                border-radius: 1.25rem;
            }

            .verify-expired-badge .material-symbols-outlined {
                font-size: 2rem;
            }
        }

        /* ================================================================
           LARGE DESKTOP (≥ 1280px)
           ================================================================ */
        @media (min-width: 1280px) {
            .verify-hero {
                padding: 4rem 5rem;
            }

            .verify-hero-title {
                font-size: 3.25rem;
            }

            .verify-card {
                padding: 3.5rem 4.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="verify-page" id="verify-page">
        <x-auth-mobile-bg />
        
        {{-- Language Switcher (Fixed top right) --}}
        <div style="position: fixed; top: 1.5rem; right: 1.5rem; z-index: 50; display: flex; gap: 0.375rem; background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(8px); padding: 0.25rem; border-radius: 0.5rem; border: 1px solid #e2e8f0; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);">
            <a href="{{ route('language.switch', 'en') }}" style="text-decoration: none; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center; border-radius: 0.375rem; font-size: 0.625rem; font-weight: 900; transition: all 0.2s; color: {{ App::getLocale() == 'en' ? '#ffffff' : '#94a3b8' }}; background-color: {{ App::getLocale() == 'en' ? '#4F46E5' : 'transparent' }};">EN</a>
            <a href="{{ route('language.switch', 'id') }}" style="text-decoration: none; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center; border-radius: 0.375rem; font-size: 0.625rem; font-weight: 900; transition: all 0.2s; color: {{ App::getLocale() == 'id' ? '#ffffff' : '#94a3b8' }}; background-color: {{ App::getLocale() == 'id' ? '#4F46E5' : 'transparent' }};">ID</a>
        </div>

        {{-- ======================================================= --}}
        {{-- MOBILE HEADER                                            --}}
        {{-- ======================================================= --}}
        <div class="verify-mobile-header">
            <div class="verify-mobile-header-logo">
                <img src="{{ asset('logo.png') }}" alt="PlayTest ID" style="height: 2.5rem; width: auto; object-fit: contain;" />
            </div>
            <p class="verify-mobile-header-tagline">{{ __('Lulus Pengujian Tertutup Lebih Cepat') }}</p>
        </div>

        {{-- ======================================================= --}}
        {{-- LEFT HERO PANEL (desktop only)                           --}}
        {{-- ======================================================= --}}
        <div class="verify-hero">
            {{-- Background image + overlay --}}
            <div class="verify-hero-bg-img"></div>
            <div class="verify-hero-bg-overlay"></div>

            <div class="verify-hero-content">
                <div class="verify-logo">
                    <img src="{{ asset('logo.png') }}" alt="PlayTest ID" style="height: 3rem; width: auto; object-fit: contain;" />
                </div>

                <h2 class="verify-hero-title">
                    {!! __('Jangan Khawatir,<br>Coba Lagi!') !!}
                </h2>
                <p class="verify-hero-desc">
                    {{ __('Tautan reset password kedaluwarsa setelah 60 menit untuk keamanan. Silakan minta tautan baru.') }}
                </p>

                <div class="verify-hero-pills">
                    @foreach([__('✓ 20+ Tester Asli'), __('✓ Ulasan Asli'), __('✓ 14 Hari Pengujian'), __('✓ Google Play Console'), __('✓ Akses Instan')] as $feature)
                    <span class="verify-hero-pill">{!! $feature !!}</span>
                    @endforeach
                </div>

                {{-- PINDAHKAN FOOTER KE DALAM SINI AGAR MIRIP LOGIN PAGE --}}
                <div class="verify-hero-footer">
                    <div class="verify-avatars">
                        @php
                        $avatarColors = ['#6366f1', '#8b5cf6', '#ec4899', '#f59e0b'];
                        $avatarInitials = ['JD', 'AK', 'MR', 'ST'];
                        @endphp
                        @foreach($avatarInitials as $i => $initials)
                        <div class="verify-avatar-initials" style="background:{{ $avatarColors[$i] }}">{{ $initials }}</div>
                        @endforeach
                    </div>
                    <p class="verify-social-proof">
                        {{ __('Dipercaya oleh') }} <strong style="color:#111827; font-weight:700;">{{ __('500+ Developer') }}</strong>
                    </p>
                </div>
            </div>
        </div>

        {{-- ======================================================= --}}
        {{-- RIGHT PANEL — CARD                                       --}}
        {{-- ======================================================= --}}
        <div class="verify-card-section">
            <div class="verify-card">
                <div class="verify-card-inner">

                    {{-- Expired icon badge --}}
                    <div class="verify-envelope-wrap">
                        <div class="verify-expired-badge">
                            <span class="material-symbols-outlined">link_off</span>
                            <div class="verify-expired-dot"></div>
                        </div>
                    </div>

                    {{-- Card header --}}
                    <div class="verify-card-header">
                        <span class="verify-card-label">{!! __('&#9888; Tautan Kedaluwarsa') !!}</span>
                        <h2 class="verify-card-title">{!! __('Tautan Reset Password<br>Telah Kedaluwarsa') !!}</h2>
                        <p class="verify-card-subtitle">
                            {{ __('Tautan reset password ini tidak lagi valid. Silakan minta tautan baru untuk mengatur ulang password Anda.') }}
                        </p>
                    </div>

                    {{-- Why did this happen --}}
                    <div class="verify-reason-box">
                        <p class="verify-reason-title">
                            <span class="material-symbols-outlined">help</span>
                            {{ __('Mengapa ini terjadi?') }}
                        </p>
                        <ul class="verify-reason-list">
                            <li>{!! __('Tautan kedaluwarsa setelah <strong>60 menit</strong>') !!}</li>
                            <li>{{ __('Tautan sudah digunakan untuk mengatur ulang password') }}</li>
                            <li>{{ __('Tautan dibuka di browser atau perangkat yang berbeda') }}</li>
                        </ul>
                    </div>

                    {{-- Register Again button --}}
                    <div class="verify-form-wrapper">
                        <a href="/{{ $panel ?? 'tester' }}/password-reset/request" class="verify-register-btn">
                            <span class="material-symbols-outlined">lock_reset</span>
                            {{ __('Minta Tautan Baru') }}
                        </a>
                    </div>

                    {{-- Info note --}}
                    <div class="verify-spam-note">
                        <span class="material-symbols-outlined">info</span>
                        <p class="verify-spam-note-text">
                            {{ __('Demi keamanan, tautan reset password hanya berlaku selama 60 menit dan hanya dapat digunakan satu kali.') }}
                        </p>
                    </div>

                    {{-- Back to login --}}
                    <p class="verify-back-link">
                        {{ __('Sudah punya akun?') }}
                        <a href="/{{ $panel ?? 'tester' }}/login">{{ __('Masuk di sini') }}</a>
                    </p>

                </div>
            </div>

            {{-- Mobile-only feature pills --}}
            <div class="verify-mobile-features">
                @foreach([__('✓ 20+ Tester'), __('✓ Uji 14 Hari'), __('✓ Akses Instan')] as $feature)
                <span class="verify-mobile-pill">{!! $feature !!}</span>
                @endforeach
            </div>
        </div>

    </div>

</body>

</html>