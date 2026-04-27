{{-- ============================================================ --}}
{{-- Custom Login Page — Split-Screen Light Design               --}}
{{-- Target: Desktop (split) + Mobile (stacked, Android-polished)--}}
{{-- ============================================================ --}}

@push('styles')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800,900&display=swap" rel="stylesheet" />
<style>
    /* ================================================================
       LOGIN PAGE — RESET FILAMENT LAYOUT
       ================================================================ */

    .fi-simple-layout:has(.login-page) {
        background: transparent !important;
        min-height: 100dvh;
    }

    .fi-simple-main-ctn:has(.login-page) {
        display: flex;
        align-items: stretch;
        min-height: 100dvh;
        padding: 0 !important;
    }

    .fi-simple-main:has(.login-page) {
        max-width: 100% !important;
        width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .fi-simple-page:has(.login-page) {
        padding: 0 !important;
        max-width: unset !important;
    }

    .fi-simple-page-content:has(.login-page) {
        max-width: unset !important;
        width: 100%;
    }

    .fi-body:has(.login-page) {
        overflow-x: hidden;
    }

    /* ================================================================
       LOGIN PAGE CONTAINER
       ================================================================ */

    .login-page {
        display: flex;
        flex-direction: column;
        min-height: 100dvh;
        font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;
        /* MOBILE: rich gradient background */
        background: linear-gradient(160deg, #3730a3 0%, #4F46E5 38%, #7c3aed 100%);
    }

    /* ================================================================
       MOBILE TOP WAVE / BRAND HEADER
       ================================================================ */

    /* Decorative wave/header visible only on mobile */
    .login-mobile-header {
        position: relative;
        padding: calc(env(safe-area-inset-top, 0px) + 2.5rem) 1.75rem 0;
        text-align: center;
        animation: loginFadeInDown 0.55s cubic-bezier(0.22, 1, 0.36, 1);
        z-index: 1;
    }

    .login-mobile-header-logo {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.625rem;
        margin-bottom: 1.25rem;
    }

    .login-mobile-header-icon {
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

    .login-mobile-header-icon .material-symbols-outlined {
        font-size: 1.625rem !important;
        color: #fff !important;
    }

    .login-mobile-brand-name {
        font-size: 1.375rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: #fff;
        margin: 0;
    }

    .login-mobile-header-tagline {
        font-size: 0.875rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.75);
        margin: 0;
        letter-spacing: 0.005em;
    }

    /* ================================================================
       LEFT PANEL — HERO / BRANDING (desktop only)
       ================================================================ */

    .login-hero {
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

    /* Background image overlay */
    .login-hero-bg-img {
        position: absolute;
        inset: 0;
        background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAI9gJnovj2fCx3g9q-dArBHoXKgL9Or-jNTVccMUrSSXS6h9V7VHA3JK9qxF2phWOHbwFoBk2PVClUCxM2SRGSgHx4TfLhfdcjL7IzZZyfXUVf-hDdASQ8EeYaWlpAqIZr9PB8-jjHhh9fvngXsdnywYFWJUELojKH0Fla6ekbnJZErBhOAWwOgO0JPbsDar5uUCF3xA2xUXMwI6oAsoLtnzCvXVldkYIVE14N4UbS3YnpfuKzIFODWYCtPWlLzai-tZcPuiaKTIQ');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        pointer-events: none;
    }

    .login-hero-bg-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(249, 250, 251, 0.92) 0%, rgba(249, 250, 251, 0.55) 100%);
        pointer-events: none;
    }

    .login-hero-content {
        position: relative;
        z-index: 10;
        display: flex;
        flex-direction: column;
        justify-content: center;
        flex: 1;
    }

    /* Logo */
    .login-logo {
        display: inline-flex;
        align-items: center;
        gap: 0.625rem;
        color: #4F46E5;
        margin-bottom: 0.5rem;
    }

    .login-logo-icon {
        font-size: 2rem;
        line-height: 1;
    }

    .login-brand-name {
        font-size: 1.375rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: #111827;
        margin: 0;
    }

    .login-hero-title {
        font-size: 2rem;
        font-weight: 900;
        line-height: 1.1;
        letter-spacing: -0.035em;
        color: #111827;
        margin: 1.25rem 0 0.875rem;
    }

    .login-hero-desc {
        font-size: 0.9375rem;
        color: #6b7280;
        line-height: 1.65;
        margin: 0;
        font-weight: 500;
    }

    /* Desktop-only elements — hidden on mobile */
    .login-hero-extended,
    .login-hero-footer {
        display: none;
    }

    /* ================================================================
       HERO FEATURE PILLS (DESKTOP)
       ================================================================ */
    .login-hero-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.625rem;
        margin-top: 5rem;
    }

    .login-hero-pill {
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

    /* ================================================================
       RIGHT PANEL — FORM CARD
       ================================================================ */

    .login-card-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        /* MOBILE: push card up with gap from mobile header */
        margin-top: 1.5rem;
    }

    .login-card {
        flex: 1;
        /* MOBILE: white card with top rounded corners — feels native Android */
        background: #ffffff;
        border-radius: 1.75rem 1.75rem 0 0;
        padding: 2.25rem 1.5rem 2rem;
        box-shadow: 0 -8px 40px rgba(55, 48, 163, 0.18);
        animation: loginSlideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
    }

    /* Hide the old inline-styled mobile logo — replaced by .login-mobile-header */
    .lg-hidden-logo {
        display: none !important;
    }

    .login-card-header {
        text-align: center;
        margin-bottom: 1.75rem;
    }

    .login-card-title {
        font-size: 1.625rem;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.03em;
        margin: 0 0 0.3rem;
    }

    .login-card-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 500;
        margin: 0;
    }

    /* ================================================================
       GOOGLE SIGN-IN BUTTON (DISABLED)
       ================================================================ */

    .login-google-btn {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.875rem;
        background: #ffffff;
        font-size: 0.9375rem;
        font-weight: 600;
        color: #374151;
        font-family: 'Manrope', sans-serif;
        cursor: not-allowed;
        opacity: 0.6;
        transition: none;
        position: relative;
        min-height: 3.25rem;
    }

    .login-google-btn-badge {
        position: absolute;
        top: -8px;
        right: -6px;
        background: linear-gradient(135deg, #4F46E5 0%, #7c3aed 100%);
        color: white;
        font-size: 0.6rem;
        font-weight: 800;
        padding: 0.15rem 0.5rem;
        border-radius: 99px;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.4);
        z-index: 10;
    }

    /* Divider */
    .login-divider {
        position: relative;
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
    }

    .login-divider-line {
        flex: 1;
        border-top: 1px solid #e5e7eb;
    }

    .login-divider-text {
        padding: 0 1rem;
        font-size: 0.8125rem;
        color: #6b7280;
        background: #ffffff;
        white-space: nowrap;
    }

    /* ================================================================
       FILAMENT FORM OVERRIDES
       ================================================================ */

    .login-form-wrapper {
        margin-top: 0;
    }

    /* Field spacing */
    .login-form-wrapper .fi-fo-field-wrp {
        margin-bottom: 1rem !important;
    }

    /* Labels */
    .login-form-wrapper .fi-fo-field-wrp-label label {
        font-size: 0.8125rem !important;
        font-weight: 600 !important;
        color: #111827 !important;
        font-family: 'Manrope', sans-serif !important;
    }

    /* Required asterisk */
    .login-form-wrapper .fi-fo-field-wrp-label sup,
    .login-form-wrapper .fi-fo-field-wrp-label .text-danger-600 {
        color: #ef4444 !important;
    }

    /* Input wrapper */
    .login-form-wrapper .fi-input-wrp {
        border: 1.5px solid #e5e7eb !important;
        border-radius: 0.875rem !important;
        background: #f9fafb !important;
        overflow: hidden !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease !important;
    }

    .login-form-wrapper .fi-input-wrp:focus-within {
        border-color: #4F46E5 !important;
        background: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12) !important;
    }

    /* Input fields */
    .login-form-wrapper .fi-input-wrp input {
        background: transparent !important;
        color: #111827 !important;
        padding: 0.875rem 1rem !important;
        font-size: 1rem !important;
        font-family: 'Manrope', sans-serif !important;
        border: none !important;
        /* MOBILE: taller inputs for easier tapping */
        min-height: 3.25rem !important;
        -webkit-appearance: none !important;
        width: 100% !important;
    }

    .login-form-wrapper .fi-input-wrp input::placeholder {
        color: #9ca3af !important;
    }

    /* Password reveal button */
    .login-form-wrapper .fi-input-wrp button {
        color: #9ca3af !important;
    }

    .login-form-wrapper .fi-input-wrp button:hover {
        color: #4F46E5 !important;
    }

    /* Checkbox */
    .login-form-wrapper input[type="checkbox"] {
        width: 1.25rem !important;
        height: 1.25rem !important;
        border-radius: 0.375rem !important;
        accent-color: #4F46E5 !important;
    }

    /* Forgot password hint link & all links inside form */
    .login-form-wrapper .fi-link,
    .login-form-wrapper .fi-link span,
    .login-form-wrapper .fi-link a,
    .login-form-wrapper a:not(.fi-btn) {
        color: #4F46E5 !important;
        font-weight: 600 !important;
        text-decoration: none !important;
    }

    /* Submit button — MOBILE: gradient, pill-shaped, full-width, tall */
    .login-form-wrapper .fi-btn {
        background: linear-gradient(135deg, #4F46E5 0%, #7c3aed 100%) !important;
        border: none !important;
        border-radius: 0.875rem !important;
        padding: 0.875rem 1.5rem !important;
        font-size: 1rem !important;
        font-weight: 700 !important;
        font-family: 'Manrope', sans-serif !important;
        min-height: 3.25rem !important;
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.38) !important;
        transition: all 0.2s ease !important;
        color: white !important;
        letter-spacing: 0.01em !important;
    }

    .login-form-wrapper .fi-btn:hover {
        background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%) !important;
        box-shadow: 0 8px 24px rgba(79, 70, 229, 0.45) !important;
    }

    .login-form-wrapper .fi-btn:active {
        transform: scale(0.98) !important;
        box-shadow: 0 3px 10px rgba(79, 70, 229, 0.25) !important;
    }

    /* Actions wrapper */
    .login-form-wrapper .fi-ac-actions {
        margin-top: 0.5rem !important;
    }

    /* Error messages */
    .login-form-wrapper .fi-fo-field-wrp-error-message {
        font-size: 0.75rem !important;
        color: #ef4444 !important;
        margin-top: 0.25rem !important;
        font-family: 'Manrope', sans-serif !important;
    }

    /* ================================================================
       REGISTER LINK
       ================================================================ */

    .login-register-link {
        text-align: center;
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 1.5rem;
        font-weight: 500;
    }

    .login-register-link a {
        color: #4F46E5 !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        transition: color 0.2s ease !important;
    }

    .login-register-link a:hover {
        color: rgba(79, 70, 229, 0.8) !important;
    }

    /* ================================================================
       MOBILE FEATURE PILLS — redesigned
       ================================================================ */

    .login-mobile-features {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding: 1rem 1.5rem calc(1.5rem + env(safe-area-inset-bottom, 0px));
        background: #ffffff;
        animation: loginFadeIn 0.5s ease-out 0.5s both;
        border-top: 1px solid #f3f4f6;
    }

    .login-mobile-pill {
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.08) 0%, rgba(124, 58, 237, 0.08) 100%);
        color: #4F46E5;
        border-radius: 9999px;
        padding: 0.4rem 0.875rem;
        font-size: 0.75rem;
        font-weight: 700;
        font-family: 'Manrope', sans-serif;
        border: 1px solid rgba(79, 70, 229, 0.18);
        letter-spacing: 0.01em;
    }

    /* ================================================================
       ANIMATIONS
       ================================================================ */

    @keyframes loginFadeInDown {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes loginSlideUp {
        from {
            opacity: 0;
            transform: translateY(32px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes loginFadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* ================================================================
       TABLET (≥ 640px)
       ================================================================ */
    @media (min-width: 640px) {
        .login-card {
            padding: 2.5rem 2.5rem 2rem;
        }

        .login-card-title {
            font-size: 1.875rem;
        }

        .login-card-section {
            margin-top: 2rem;
        }
    }

    /* ================================================================
       DESKTOP (≥ 1024px) — Split-screen layout
       ================================================================ */
    @media (min-width: 1024px) {

        /* Restore original desktop background */
        .login-page {
            background: #ffffff;
            flex-direction: row;
        }

        /* Reset mobile-specific overrides */
        .login-mobile-header {
            display: none !important;
        }

        .login-card-section {
            margin-top: 0;
            width: 50%;
            flex: 0 0 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Restore original desktop card */
        .login-card {
            border-radius: 0;
            box-shadow: none;
            padding: 3rem 4rem;
            flex: none;
            background: #ffffff;
            animation: loginFadeIn 0.5s ease-out;
        }

        .login-card-header {
            text-align: center;
        }

        .login-card-title {
            font-size: 2rem;
        }

        .login-mobile-features {
            display: none;
        }

        /* Restore original input styles on desktop */
        .login-form-wrapper .fi-input-wrp {
            border-radius: 0.5rem !important;
            background: #ffffff !important;
        }

        .login-form-wrapper .fi-input-wrp input {
            padding: 0.75rem 1rem !important;
            font-size: 0.9375rem !important;
            min-height: 2.875rem !important;
        }

        .login-google-btn {
            min-height: unset;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
        }

        .login-form-wrapper .fi-btn {
            background: #4F46E5 !important;
            border-radius: 0.5rem !important;
            padding: 0.75rem 1.5rem !important;
            font-size: 0.9375rem !important;
            min-height: 3rem !important;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
            letter-spacing: 0 !important;
        }

        .login-form-wrapper .fi-btn:hover {
            background: rgba(79, 70, 229, 0.9) !important;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
        }

        .login-form-wrapper input[type="checkbox"] {
            width: 1.125rem !important;
            height: 1.125rem !important;
        }

        .login-card-inner {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        /* Left hero panel */
        .login-hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: left;
            padding: 3rem 3.5rem;
            border-bottom: none;
            border-right: 1px solid #e5e7eb;
            animation: loginFadeIn 0.6s ease-out;
            background: #f9fafb;
        }

        .login-hero-title {
            font-size: 2.875rem;
            margin: 2rem 0 1rem;
        }

        .login-hero-desc {
            font-size: 1.0625rem;
            max-width: 400px;
        }

        /* Show desktop extras */
        .login-hero-extended {
            display: block;
            margin-top: 0;
        }

        .login-hero-footer {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 2rem;
        }

        /* Social proof avatars */
        .login-avatars {
            display: flex;
        }

        .login-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            border: 2px solid #ffffff;
            overflow: hidden;
            margin-left: -0.5rem;
            background: #e5e7eb;
        }

        .login-avatar:first-child {
            margin-left: 0;
        }

        .login-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Initials fallback */
        .login-avatar-initials {
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

        .login-avatar-initials:first-child {
            margin-left: 0;
        }

        .login-social-proof {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
            font-weight: 500;
        }
    }

    /* ================================================================
       LARGE DESKTOP (≥ 1280px)
       ================================================================ */
    @media (min-width: 1280px) {
        .login-hero {
            padding: 4rem 5rem;
        }

        .login-hero-title {
            font-size: 3.25rem;
        }

        .login-card {
            padding: 3.5rem 4.5rem;
        }

        .login-card-section {
            max-width: 50%;
        }
    }
</style>
@endpush

{{-- ============================================================ --}}
{{-- Page content — rendered inside Filament's layout.simple      --}}
{{-- ============================================================ --}}
<x-filament-panels::page.simple>
    <div class="login-page" id="login-page">

        {{-- ======================================================= --}}
        {{-- MOBILE HEADER — branding shown only on mobile           --}}
        {{-- ======================================================= --}}
        <div class="login-mobile-header">
            <div class="login-mobile-header-logo">
                <div class="login-mobile-header-icon">
                    <span class="material-symbols-outlined">science</span>
                </div>
                <h1 class="login-mobile-brand-name">PlayTest ID</h1>
            </div>
            <p class="login-mobile-header-tagline">Pass Closed Testing Faster</p>
        </div>

        {{-- ======================================================= --}}
        {{-- LEFT PANEL — HERO / BRANDING (desktop only)             --}}
        {{-- ======================================================= --}}
        <div class="login-hero">
            {{-- Background image + overlay --}}
            <div class="login-hero-bg-img"></div>
            <div class="login-hero-bg-overlay"></div>

            <div class="login-hero-content">
                {{-- Logo --}}
                <div class="login-logo">
                    <span class="material-symbols-outlined login-logo-icon" style="font-size:1.875rem; color:#4F46E5;">science</span>
                    <h1 class="login-brand-name">PlayTest ID</h1>
                </div>

                {{-- Desktop-only extended hero --}}
                <div class="login-hero-extended">
                    <h2 class="login-hero-title">
                        Pass Closed Testing Faster.
                    </h2>
                    <p class="login-hero-desc">
                        Meet Google Play's 20-tester requirement for 14 days without the headache.
                    </p>
                </div>
                <div class="login-hero-pills">
                    @foreach(['✓ 20+ Real Testers', '✓ Real Feedback', '✓ 14-Day Testing', '✓ Google Play Console', '✓ Instant Access'] as $feature)
                    <span class="login-hero-pill">{{ $feature }}</span>
                    @endforeach
                </div>
                {{-- Desktop-only social proof footer --}}
                <div class="login-hero-footer">
                    <div class="login-avatars">
                        @php
                        $avatarColors = ['#6366f1', '#8b5cf6', '#ec4899', '#f59e0b'];
                        $avatarInitials = ['JD', 'AK', 'MR', 'ST'];
                        @endphp
                        @foreach($avatarInitials as $i => $initials)
                        <div class="login-avatar-initials" style="background: {{ $avatarColors[$i] }}">
                            {{ $initials }}
                        </div>
                        @endforeach
                    </div>
                    <p class="login-social-proof">
                        Used by <strong style="color:#111827; font-weight:700;">500+ Developers</strong>
                    </p>
                </div>
            </div>
        </div>

        {{-- ======================================================= --}}
        {{-- RIGHT PANEL — FORM                                       --}}
        {{-- ======================================================= --}}
        <div class="login-card-section">
            <div class="login-card">
                <div class="login-card-inner">

                    {{-- Mobile logo (kept in DOM but hidden via CSS — replaced by login-mobile-header) --}}
                    <div style="display:none !important;"
                        class="lg-hidden-logo">
                        <span class="material-symbols-outlined" style="font-size:1.75rem;">science</span>
                        <span style="font-size:1.25rem; font-weight:800; color:#111827; letter-spacing:-0.02em;">PlayTest ID</span>
                    </div>

                    {{-- Card header --}}
                    <div class="login-card-header">
                        <h2 class="login-card-title">Welcome Back {{ str(filament()->getCurrentPanel()->getId())->title() }}!</h2>
                        <p class="login-card-subtitle">Please enter your details to sign in.</p>
                    </div>

                    {{-- Google Sign-In Button (DISABLED — coming soon) --}}
                    <div style="margin-top: 1.75rem;">
                        <button
                            type="button"
                            class="login-google-btn"
                            disabled
                            title="Google Sign-In coming soon"
                            aria-disabled="true">
                            <span class="login-google-btn-badge">Coming Soon</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
                            </svg>
                            Sign in with Google
                        </button>
                    </div>

                    {{-- Divider --}}
                    <div class="login-divider">
                        <div class="login-divider-line"></div>
                        <span class="login-divider-text">or sign in with email</span>
                        <div class="login-divider-line"></div>
                    </div>

                    {{-- Filament form (email, password, remember, submit) --}}
                    <div class="login-form-wrapper">
                        {{ $this->content }}
                    </div>

                    {{-- Registration link --}}
                    @if (filament()->hasRegistration())
                    <p class="login-register-link">
                        Don't have an account?
                        <a href="{{ filament()->getRegistrationUrl() }}">Sign Up</a>
                    </p>
                    @endif

                </div>
            </div>

            {{-- Mobile-only feature pills --}}
            <div class="login-mobile-features">
                @foreach(['✓ 20+ Testers', '✓ 14-Day Test', '✓ Instant Access'] as $feature)
                <span class="login-mobile-pill">{{ $feature }}</span>
                @endforeach
            </div>
        </div>

    </div>
</x-filament-panels::page.simple>

{{-- Load Material Symbols for the science icon --}}
@push('scripts')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
<style>
    /* Hide mobile logo on desktop */
    @media (min-width: 1024px) {
        .lg-hidden-logo {
            display: none !important;
        }

        .login-mobile-header {
            display: none !important;
        }
    }
</style>
@endpush