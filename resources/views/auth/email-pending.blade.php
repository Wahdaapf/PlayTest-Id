<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - PlayTest ID</title>

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
            overflow: hidden;
            /* Mencegah scroll di level body */
        }

        /* ================================================================
           PAGE WRAPPER
           ================================================================ */
        .verify-page {
            display: flex;
            flex-direction: column;
            height: 100dvh;
            font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;
            background: linear-gradient(160deg, #3730a3 0%, #4F46E5 38%, #7c3aed 100%);
            overflow-y: auto;
            /* Scroll hanya muncul jika layar sangat-sangat kecil */
        }

        /* ================================================================
           MOBILE HEADER
           ================================================================ */
        .verify-mobile-header {
            position: relative;
            padding: calc(env(safe-area-inset-top, 0px) + 2rem) 1.75rem 0;
            text-align: center;
            animation: verifyFadeInDown 0.55s cubic-bezier(0.22, 1, 0.36, 1);
            z-index: 1;
        }

        .verify-mobile-header-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.625rem;
            margin-bottom: 1rem;
        }

        .verify-mobile-header-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .verify-mobile-header-icon .material-symbols-outlined {
            font-size: 1.5rem !important;
            color: #fff !important;
        }

        .verify-mobile-brand-name {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: #fff;
            margin: 0;
        }

        .verify-mobile-header-tagline {
            font-size: 0.8125rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.75);
            margin: 0;
            letter-spacing: 0.005em;
        }

        /* ================================================================
           HERO / LEFT PANEL (desktop only)
           ================================================================ */
        .verify-hero {
            position: relative;
            flex-shrink: 0;
            padding: 2.5rem 1.5rem 1.75rem;
            text-align: center;
            background: #f9fafb;
            overflow: hidden;
            animation: loginFadeInDown 0.6s ease-out;
            border-bottom: 1px solid #e5e7eb;
            /* Hidden on mobile — shown only ≥1024px */
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
            font-size: 0.9375rem;
            color: #6b7280;
            line-height: 1.65;
            margin: 0;
            font-weight: 500;
        }

        /* Desktop-only elements — hidden on mobile */
        .verify-hero-extended,
        .verify-hero-footer {
            display: none;
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
            padding: 0.4rem 0.875rem;
            border-radius: 9999px;
            border: 1.5px solid rgba(79, 70, 229, 0.3);
            background: rgba(79, 70, 229, 0.05);
            color: #4F46E5;
            font-size: 0.8125rem;
            font-weight: 700;
            white-space: nowrap;
            font-family: 'Manrope', sans-serif;
        }

        .verify-hero-footer {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        /* ================================================================
           CARD SECTION (RIGHT PANEL)
           ================================================================ */
        .verify-card-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-top: 1.5rem;
        }

        .verify-card {
            flex: 1;
            background: #ffffff;
            border-radius: 1.75rem 1.75rem 0 0;
            padding: 2.5rem 1.5rem 2rem;
            box-shadow: 0 -8px 40px rgba(55, 48, 163, 0.18);
            display: flex;
            flex-direction: column;
            animation: verifySlideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
        }

        .verify-card-inner {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }

        /* ================================================================
           ENVELOPE ANIMATION (Diperkecil untuk hemat ruang)
           ================================================================ */
        .verify-envelope-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .verify-envelope-badge {
            position: relative;
            width: 5rem;
            height: 5rem;
            background: linear-gradient(135deg, #4F46E5 0%, #7c3aed 100%);
            border-radius: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.3);
            animation: verifyPulse 2.5s ease-in-out infinite;
        }

        .verify-envelope-badge .material-symbols-outlined {
            font-size: 2.25rem;
            color: #ffffff;
        }

        .verify-envelope-dot {
            position: absolute;
            top: -3px;
            right: -3px;
            width: 1rem;
            height: 1rem;
            background: #10b981;
            border-radius: 50%;
            border: 2.5px solid #ffffff;
            animation: verifyBounce 1s ease-in-out infinite alternate;
        }

        /* ================================================================
           CARD HEADER TEXT
           ================================================================ */
        .verify-card-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .verify-card-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.03em;
            margin: 0 0 0.375rem;
            line-height: 1.2;
        }

        .verify-card-subtitle {
            font-size: 0.0.9375rem;
            color: #6b7280;
            font-weight: 500;
            margin: 0;
            line-height: 1.5;
        }

        /* ================================================================
           EMAIL CHIP
           ================================================================ */
        .verify-email-chip {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            background: linear-gradient(135deg, #eef2ff 0%, #f5f3ff 100%);
            border: 1.5px solid #c7d2fe;
            border-radius: 0.875rem;
            padding: 0.875rem 1.125rem;
            margin-bottom: 1.5rem;
        }

        .verify-email-chip-icon {
            font-size: 1.25rem !important;
            color: #4F46E5;
            flex-shrink: 0;
        }

        .verify-email-chip-text {
            font-size: 0.875rem;
            font-weight: 700;
            color: #4338ca;
            word-break: break-all;
        }

        /* ================================================================
           STEPS LIST (Sejajar sempurna)
           ================================================================ */
        .verify-steps {
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
            margin-bottom: 1.5rem;
        }

        .verify-step {
            display: flex;
            align-items: center;
            /* Memastikan teks dan angka sejajar */
            gap: 0.875rem;
        }

        .verify-step-num {
            flex-shrink: 0;
            width: 1.75rem;
            height: 1.75rem;
            background: linear-gradient(135deg, #4F46E5 0%, #7c3aed 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 800;
            color: #ffffff;
        }

        .verify-step-text {
            font-size: 0.875rem;
            color: #374151;
            line-height: 1.4;
            font-weight: 500;
            margin: 0;
            /* Penting untuk menjaga sejajar vertikal */
        }

        .verify-step-text strong {
            color: #111827;
            font-weight: 700;
        }

        /* ================================================================
           RESEND FORM
           ================================================================ */
        .verify-form-wrapper {
            margin-bottom: 1.25rem;
        }

        .verify-resend-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            cursor: pointer;
            border: none;
            outline: none;
            background: linear-gradient(135deg, #4F46E5 0%, #7c3aed 100%);
            color: #ffffff;
            border-radius: 0.75rem;
            padding: 0.875rem 1.5rem;
            min-height: 3.25rem;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Manrope', sans-serif;
            letter-spacing: 0.01em;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
            transition: all 0.2s ease;
        }

        .verify-resend-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.4);
        }

        .verify-resend-btn:active:not(:disabled) {
            transform: scale(0.98);
        }

        .verify-resend-btn:disabled {
            background: linear-gradient(135deg, #a5b4fc 0%, #c4b5fd 100%) !important;
            box-shadow: none !important;
            cursor: not-allowed;
        }

        .verify-resend-btn .material-symbols-outlined {
            font-size: 1.1rem !important;
        }

        /* Flash messages */
        .verify-flash {
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-align: center;
        }

        .verify-flash-success {
            background: #ecfdf5;
            border: 1px solid #6ee7b7;
            color: #065f46;
        }

        .verify-flash-error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        /* ================================================================
           SPAM NOTE
           ================================================================ */
        .verify-spam-note {
            display: flex;
            align-items: center;
            /* Sejajar vertikal */
            gap: 0.5rem;
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 0.625rem;
            padding: 0.875rem 1rem;
            margin-top: 1.25rem;
        }

        .verify-spam-note .material-symbols-outlined {
            font-size: 1rem !important;
            color: #d97706;
            flex-shrink: 0;
        }

        .verify-spam-note-text {
            font-size: 0.8125rem;
            color: #92400e;
            line-height: 1.45;
            font-weight: 600;
            margin: 0;
        }

        /* ================================================================
           BACK TO LOGIN LINK
           ================================================================ */
        .verify-back-link {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 1.5rem;
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
           MOBILE FEATURE PILLS
           ================================================================ */
        .verify-mobile-features {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding: 1rem 1.5rem calc(1rem + env(safe-area-inset-bottom, 0px));
            background: #ffffff;
            border-top: 1px solid #f3f4f6;
            animation: verifyFadeIn 0.5s ease-out 0.5s both;
        }

        .verify-mobile-pill {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.08) 0%, rgba(124, 58, 237, 0.08) 100%);
            color: #4F46E5;
            border-radius: 9999px;
            padding: 0.35rem 0.75rem;
            font-size: 0.7rem;
            font-weight: 700;
            font-family: 'Manrope', sans-serif;
            border: 1px solid rgba(79, 70, 229, 0.18);
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

        @keyframes verifyPulse {

            0%,
            100% {
                box-shadow: 0 8px 24px rgba(79, 70, 229, 0.3);
            }

            50% {
                box-shadow: 0 12px 32px rgba(79, 70, 229, 0.45);
                transform: scale(1.03);
            }
        }

        @keyframes verifyBounce {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.2);
            }
        }

        @keyframes verifySpin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* ================================================================
           TABLET (≥ 640px)
           ================================================================ */
        @media (min-width: 640px) {
            .verify-card {
                padding: 2rem 2.5rem;
            }

            .verify-card-section {
                margin-top: 2rem;
            }
        }

        /* ================================================================
           DESKTOP (≥ 1024px)
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

            .verify-hero-title {
                font-size: 2.875rem;
                margin: 2rem 0 1rem;
            }

            .verify-hero-desc {
                font-size: 1.0625rem;
                max-width: 400px;
            }

            /* Show desktop extras */
            .verify-hero-extended {
                display: block;
                margin-top: 0;
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

            .verify-card-section {
                margin-top: 0;
                width: 50%;
                flex: 0 0 50%;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .verify-card {
                border-radius: 0;
                box-shadow: none;
                padding: 2rem 3rem;
                /* Dikurangi agar tidak scroll */
                flex: none;
                background: #ffffff;
                animation: verifyFadeIn 0.5s ease-out;
            }

            .verify-resend-btn {
                background: #4F46E5 !important;
                border-radius: 0.5rem !important;
                box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
                letter-spacing: 0 !important;
            }

            .verify-resend-btn:hover:not(:disabled) {
                background: rgba(79, 70, 229, 0.9) !important;
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
                padding: 2rem 4rem;
            }

            /* Vertikal tetap kecil, horizontal tambah agar lega */
            .verify-card-section {
                max-width: 50%;
            }
        }
    </style>
</head>

<body>

    <div class="verify-page" id="verify-page">

        {{-- MOBILE HEADER --}}
        <div class="verify-mobile-header">
            <div class="verify-mobile-header-logo">
                <div class="verify-mobile-header-icon">
                    <span class="material-symbols-outlined">science</span>
                </div>
                <h1 class="verify-mobile-brand-name">PlayTest ID</h1>
            </div>
            <p class="verify-mobile-header-tagline">Pass Closed Testing Faster</p>
        </div>

        {{-- LEFT HERO PANEL (Desktop) --}}
        <div class="verify-hero">
            <div class="verify-hero-bg-img"></div>
            <div class="verify-hero-bg-overlay"></div>

            <div class="verify-hero-content">

                {{-- TOP: Logo --}}
                <div class="verify-logo">
                    <span class="material-symbols-outlined verify-logo-icon" style="font-size:1.875rem; color:#4F46E5;">science</span>
                    <h1 class="verify-brand-name">PlayTest ID</h1>
                </div>

                {{-- Desktop-only extended hero --}}
                <div class="verify-hero-extended">
                    <h2 class="verify-hero-title">
                        One Step Away<br>from Testing!
                    </h2>
                    <p class="verify-hero-desc">
                        We just sent a verification link to your email. Check your inbox and click the link to activate your account.
                    </p>
                </div>

                <div class="verify-hero-pills">
                    @foreach(['✓ 20+ Real Testers', '✓ Real Feedback', '✓ 14-Day Testing', '✓ Google Play Console', '✓ Instant Access'] as $feature)
                    <span class="verify-hero-pill">{{ $feature }}</span>
                    @endforeach
                </div>

                {{-- BOTTOM: Footer & Social Proof --}}
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
                        Trusted by <strong style="color:#111827; font-weight:700;">500+ Developers</strong>
                    </p>
                </div>
            </div>
        </div>

        {{-- RIGHT PANEL: Form Card --}}
        <div class="verify-card-section">
            <div class="verify-card">
                <div class="verify-card-inner">

                    {{-- Animated envelope icon --}}
                    <div class="verify-envelope-wrap">
                        <div class="verify-envelope-badge">
                            <span class="material-symbols-outlined">mark_email_unread</span>
                            <div class="verify-envelope-dot"></div>
                        </div>
                    </div>

                    {{-- Card header --}}
                    <div class="verify-card-header">
                        <h2 class="verify-card-title">Check Your Inbox!</h2>
                        <p class="verify-card-subtitle">
                            We've sent a verification link to your email.
                        </p>
                    </div>

                    {{-- Email chip --}}
                    @if(!empty($email))
                    <div class="verify-email-chip">
                        <span class="material-symbols-outlined verify-email-chip-icon">mail</span>
                        <span class="verify-email-chip-text">{{ $email }}</span>
                    </div>
                    @endif

                    {{-- Steps --}}
                    <div class="verify-steps">
                        <div class="verify-step">
                            <div class="verify-step-num">1</div>
                            <p class="verify-step-text">
                                <strong>Open your email</strong> — look for a message from <strong>PlayTest ID</strong>
                            </p>
                        </div>
                        <div class="verify-step">
                            <div class="verify-step-num">2</div>
                            <p class="verify-step-text">
                                <strong>Click "Verify My Email"</strong> inside the message
                            </p>
                        </div>
                        <div class="verify-step">
                            <div class="verify-step-num">3</div>
                            <p class="verify-step-text">
                                <strong>You're in!</strong> — start exploring missions and earning
                            </p>
                        </div>
                    </div>

                    {{-- Flash messages --}}
                    @if(session('resent'))
                    <div class="verify-flash verify-flash-success">
                        ✓ A new verification email has been sent. Check your inbox!
                    </div>
                    @endif

                    @if(session('resend_error'))
                    <div class="verify-flash verify-flash-error">
                        ⚠ {{ session('resend_error') }}
                    </div>
                    @endif

                    {{-- Resend button --}}
                    @if(!empty($token))
                    <div class="verify-form-wrapper">
                        <form action="{{ route('email.pending.resend') }}" method="POST" id="resend-form">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <button type="submit" class="verify-resend-btn" id="resend-btn">
                                <span class="material-symbols-outlined" id="resend-icon">refresh</span>
                                <span id="resend-label">Resend Verification Email</span>
                            </button>
                        </form>
                    </div>
                    @endif

                    {{-- Spam warning --}}
                    <div class="verify-spam-note">
                        <span class="material-symbols-outlined">info</span>
                        <p class="verify-spam-note-text">
                            Can't find the email? Check your <strong>Spam</strong> or <strong>Promotions</strong> folder.
                            The link expires in <strong>60 minutes</strong>.
                        </p>
                    </div>

                    {{-- Back to login --}}
                    <p class="verify-back-link">
                        Wrong account?
                        <a href="/{{ $panel ?? 'tester' }}/login">Log in with another account</a>
                    </p>

                </div>
            </div>

            {{-- Mobile-only feature pills --}}
            <div class="verify-mobile-features">
                @foreach(['✓ 20+ Testers', '✓ 14-Day Test', '✓ Instant Access'] as $feature)
                <span class="verify-mobile-pill">{{ $feature }}</span>
                @endforeach
            </div>
        </div>

    </div>

    <script>
        const form = document.getElementById('resend-form');
        const btn = document.getElementById('resend-btn');
        const icon = document.getElementById('resend-icon');
        const lbl = document.getElementById('resend-label');

        if (form) {
            @if(session('resent'))
            startCooldown(60);
            @endif

            form.addEventListener('submit', function() {
                if (btn.disabled) return;
                btn.disabled = true;
                icon.style.animation = 'verifySpin 0.8s linear infinite';
                lbl.textContent = 'Sending…';
            });
        }

        function startCooldown(seconds) {
            btn.disabled = true;
            icon.textContent = 'schedule';
            icon.style.animation = '';
            let s = Math.max(0, seconds);
            lbl.textContent = 'Resend available in ' + s + 's';
            const interval = setInterval(function() {
                s--;
                if (s <= 0) {
                    clearInterval(interval);
                    btn.disabled = false;
                    icon.textContent = 'refresh';
                    lbl.textContent = 'Resend Verification Email';
                } else {
                    lbl.textContent = 'Resend available in ' + s + 's';
                }
            }, 1000);
        }
    </script>

</body>

</html>