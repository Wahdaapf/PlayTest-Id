{{-- ============================================================ --}}
{{-- Custom Forgot Password Page — Split-Screen Light Design     --}}
{{-- Target: Desktop (split) + Mobile (stacked, Android-polished)--}}
{{-- Matches: login.blade.php design system                      --}}
{{-- ============================================================ --}}

@push('styles')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800,900&display=swap" rel="stylesheet" />
<style>
    /* ================================================================
       FORGOT PASSWORD PAGE — RESET FILAMENT LAYOUT
       ================================================================ */

    .fi-simple-layout:has(.fp-page) {
        background: transparent !important;
        min-height: 100dvh;
    }

    .fi-simple-main-ctn:has(.fp-page) {
        display: flex;
        align-items: stretch;
        min-height: 100dvh;
        padding: 0 !important;
    }

    .fi-simple-main:has(.fp-page) {
        max-width: 100% !important;
        width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .fi-simple-page:has(.fp-page) {
        padding: 0 !important;
        max-width: unset !important;
    }

    .fi-simple-page-content:has(.fp-page) {
        max-width: unset !important;
        width: 100%;
    }

    .fi-body:has(.fp-page) {
        overflow-x: hidden;
    }

    /* ================================================================
       PAGE CONTAINER
       ================================================================ */

    .fp-page {
        display: flex;
        flex-direction: column;
        min-height: 100dvh;
        font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;
        /* MOBILE: rich gradient background */
        background: linear-gradient(160deg, #3730a3 0%, #4F46E5 38%, #7c3aed 100%);
    }

    /* ================================================================
       MOBILE TOP HEADER — BRAND
       ================================================================ */

    .fp-mobile-header {
        position: relative;
        padding: calc(env(safe-area-inset-top, 0px) + 2.5rem) 1.75rem 0;
        text-align: center;
        animation: fpFadeInDown 0.55s cubic-bezier(0.22, 1, 0.36, 1);
        z-index: 1;
    }

    .fp-mobile-header-logo {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.625rem;
        margin-bottom: 1.25rem;
    }

    .fp-mobile-header-icon {
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

    .fp-mobile-header-icon .material-symbols-outlined {
        font-size: 1.625rem !important;
        color: #fff !important;
    }

    .fp-mobile-brand-name {
        font-size: 1.375rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: #fff;
        margin: 0;
    }

    .fp-mobile-header-tagline {
        font-size: 0.875rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.75);
        margin: 0;
        letter-spacing: 0.005em;
    }

    /* ================================================================
       LEFT PANEL — HERO / BRANDING (desktop only)
       ================================================================ */

    .fp-hero {
        position: relative;
        flex-shrink: 0;
        padding: 2.5rem 1.5rem 1.75rem;
        text-align: center;
        background: #f9fafb;
        overflow: hidden;
        animation: fpFadeInDown 0.6s ease-out;
        border-bottom: 1px solid #e5e7eb;
        display: none; /* Hidden on mobile — shown only ≥1024px */
    }

    .fp-hero-bg-img {
        position: absolute;
        inset: 0;
        background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAI9gJnovj2fCx3g9q-dArBHoXKgL9Or-jNTVccMUrSSXS6h9V7VHA3JK9qxF2phWOHbwFoBk2PVClUCxM2SRGSgHx4TfLhfdcjL7IzZZyfXUVf-hDdASQ8EeYaWlpAqIZr9PB8-jjHhh9fvngXsdnywYFWJUELojKH0Fla6ekbnJZErBhOAWwOgO0JPbsDar5uUCF3xA2xUXMwI6oAsoLtnzCvXVldkYIVE14N4UbS3YnpfuKzIFODWYCtPWlLzai-tZcPuiaKTIQ');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        pointer-events: none;
    }

    .fp-hero-bg-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(249, 250, 251, 0.92) 0%, rgba(249, 250, 251, 0.55) 100%);
        pointer-events: none;
    }

    .fp-hero-content {
        position: relative;
        z-index: 10;
        display: flex;
        flex-direction: column;
        justify-content: center;
        flex: 1;
    }

    /* Logo */
    .fp-logo {
        display: inline-flex;
        align-items: center;
        gap: 0.625rem;
        color: #4F46E5;
        margin-bottom: 0.5rem;
    }

    .fp-brand-name {
        font-size: 1.375rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: #111827;
        margin: 0;
    }

    .fp-hero-title {
        font-size: 2rem;
        font-weight: 900;
        line-height: 1.1;
        letter-spacing: -0.035em;
        color: #111827;
        margin: 1.25rem 0 0.875rem;
    }

    .fp-hero-desc {
        font-size: 0.9375rem;
        color: #6b7280;
        line-height: 1.65;
        margin: 0;
        font-weight: 500;
    }

    .fp-hero-extended,
    .fp-hero-footer {
        display: none;
    }

    /* Feature pills */
    .fp-hero-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.625rem;
        margin-top: 5rem;
    }

    .fp-hero-pill {
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

    .fp-card-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        margin-top: 1.5rem;
    }

    .fp-card {
        flex: 1;
        background: #ffffff;
        border-radius: 1.75rem 1.75rem 0 0;
        padding: 2.25rem 1.5rem 2rem;
        box-shadow: 0 -8px 40px rgba(55, 48, 163, 0.18);
        animation: fpSlideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
    }

    /* ---- Card icon badge ---- */
    .fp-icon-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 4rem;
        height: 4rem;
        border-radius: 1.25rem;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
        border: 1.5px solid rgba(79, 70, 229, 0.2);
        margin: 0 auto 1.25rem;
    }

    .fp-icon-badge .material-symbols-outlined {
        font-size: 2rem !important;
        color: #4F46E5 !important;
    }

    /* Card header */
    .fp-card-header {
        text-align: center;
        margin-bottom: 1.75rem;
    }

    .fp-card-title {
        font-size: 1.625rem;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.03em;
        margin: 0 0 0.3rem;
    }

    .fp-card-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 500;
        margin: 0;
        line-height: 1.6;
    }

    /* ================================================================
       FILAMENT FORM OVERRIDES
       ================================================================ */

    .fp-form-wrapper {
        margin-top: 0;
    }

    .fp-form-wrapper .fi-fo-field-wrp {
        margin-bottom: 1rem !important;
    }

    .fp-form-wrapper .fi-fo-field-wrp-label label {
        font-size: 0.8125rem !important;
        font-weight: 600 !important;
        color: #111827 !important;
        font-family: 'Manrope', sans-serif !important;
    }

    .fp-form-wrapper .fi-fo-field-wrp-label sup,
    .fp-form-wrapper .fi-fo-field-wrp-label .text-danger-600 {
        color: #ef4444 !important;
    }

    .fp-form-wrapper .fi-input-wrp {
        border: 1.5px solid #e5e7eb !important;
        border-radius: 0.875rem !important;
        background: #f9fafb !important;
        overflow: hidden !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease !important;
    }

    .fp-form-wrapper .fi-input-wrp:focus-within {
        border-color: #4F46E5 !important;
        background: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12) !important;
    }

    .fp-form-wrapper .fi-input-wrp input {
        background: transparent !important;
        color: #111827 !important;
        padding: 0.875rem 1rem !important;
        font-size: 1rem !important;
        font-family: 'Manrope', sans-serif !important;
        border: none !important;
        min-height: 3.25rem !important;
        -webkit-appearance: none !important;
        width: 100% !important;
    }

    .fp-form-wrapper .fi-input-wrp input::placeholder {
        color: #9ca3af !important;
    }

    /* Submit button */
    .fp-form-wrapper .fi-btn {
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

    .fp-form-wrapper .fi-btn:hover {
        background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%) !important;
        box-shadow: 0 8px 24px rgba(79, 70, 229, 0.45) !important;
    }

    .fp-form-wrapper .fi-btn:active {
        transform: scale(0.98) !important;
        box-shadow: 0 3px 10px rgba(79, 70, 229, 0.25) !important;
    }

    .fp-form-wrapper .fi-ac-actions {
        margin-top: 0.5rem !important;
    }

    .fp-form-wrapper .fi-fo-field-wrp-error-message {
        font-size: 0.75rem !important;
        color: #ef4444 !important;
        margin-top: 0.25rem !important;
        font-family: 'Manrope', sans-serif !important;
    }

    /* ================================================================
       BACK TO LOGIN LINK
       ================================================================ */

    .fp-back-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        text-align: center;
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 1.5rem;
        font-weight: 500;
        text-decoration: none !important;
        transition: color 0.2s ease !important;
    }

    /* All links inside form */
    .fp-form-wrapper .fi-link,
    .fp-form-wrapper .fi-link span,
    .fp-form-wrapper .fi-link a,
    .fp-form-wrapper a:not(.fi-btn) {
        color: #4F46E5 !important;
        font-weight: 600 !important;
        text-decoration: none !important;
    }

    .fp-back-link:hover {
        color: #4F46E5 !important;
    }

    .fp-back-link .material-symbols-outlined {
        font-size: 1.125rem !important;
        color: inherit !important;
        transition: transform 0.2s ease;
    }

    .fp-back-link:hover .material-symbols-outlined {
        transform: translateX(-3px);
    }

    /* ================================================================
       SUCCESS STATE CARD
       ================================================================ */

    .fp-success-card {
        display: none;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 1.5rem 0 0.5rem;
        animation: fpFadeIn 0.45s ease-out;
    }

    .fp-success-icon-wrap {
        width: 5rem;
        height: 5rem;
        border-radius: 9999px;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
        border: 2px solid rgba(79, 70, 229, 0.22);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        animation: fpBounceIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .fp-success-icon-wrap .material-symbols-outlined {
        font-size: 2.5rem !important;
        color: #4F46E5 !important;
    }

    .fp-success-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.03em;
        margin: 0 0 0.5rem;
    }

    .fp-success-desc {
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 500;
        line-height: 1.65;
        margin: 0 0 0.5rem;
        max-width: 320px;
    }

    .fp-success-email-highlight {
        font-weight: 700;
        color: #4F46E5;
    }

    .fp-success-hint {
        font-size: 0.8125rem;
        color: #9ca3af;
        font-weight: 500;
        margin-top: 0.25rem;
    }

    .fp-success-divider {
        width: 100%;
        border: none;
        border-top: 1px solid #f3f4f6;
        margin: 1.5rem 0;
    }

    .fp-resend-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 500;
    }

    .fp-resend-link {
        color: #4F46E5;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .fp-resend-link:hover {
        color: rgba(79, 70, 229, 0.8);
    }

    /* ================================================================
       MOBILE FEATURE PILLS
       ================================================================ */

    .fp-mobile-features {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding: 1rem 1.5rem calc(1.5rem + env(safe-area-inset-bottom, 0px));
        background: #ffffff;
        animation: fpFadeIn 0.5s ease-out 0.5s both;
        border-top: 1px solid #f3f4f6;
    }

    .fp-mobile-pill {
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

    @keyframes fpFadeInDown {
        from { opacity: 0; transform: translateY(-15px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes fpSlideUp {
        from { opacity: 0; transform: translateY(32px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes fpFadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    @keyframes fpBounceIn {
        from { opacity: 0; transform: scale(0.6); }
        to   { opacity: 1; transform: scale(1); }
    }

    /* ================================================================
       TABLET (≥ 640px)
       ================================================================ */
    @media (min-width: 640px) {
        .fp-card {
            padding: 2.5rem 2.5rem 2rem;
        }

        .fp-card-title {
            font-size: 1.875rem;
        }

        .fp-card-section {
            margin-top: 2rem;
        }
    }

    /* ================================================================
       DESKTOP (≥ 1024px) — Split-screen layout
       ================================================================ */
    @media (min-width: 1024px) {

        /* Restore original desktop background */
        .fp-page {
            background: #ffffff;
            flex-direction: row;
        }

        .fp-mobile-header {
            display: none !important;
        }

        .fp-card-section {
            margin-top: 0;
            width: 50%;
            flex: 0 0 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .fp-card {
            border-radius: 0;
            box-shadow: none;
            padding: 3rem 4rem;
            flex: none;
            background: #ffffff;
            animation: fpFadeIn 0.5s ease-out;
        }

        .fp-card-header {
            text-align: center;
        }

        .fp-card-title {
            font-size: 2rem;
        }

        .fp-mobile-features {
            display: none;
        }

        /* Restore original input styles on desktop */
        .fp-form-wrapper .fi-input-wrp {
            border-radius: 0.5rem !important;
            background: #ffffff !important;
        }

        .fp-form-wrapper .fi-input-wrp input {
            padding: 0.75rem 1rem !important;
            font-size: 0.9375rem !important;
            min-height: 2.875rem !important;
        }

        .fp-form-wrapper .fi-btn {
            background: #4F46E5 !important;
            border-radius: 0.5rem !important;
            padding: 0.75rem 1.5rem !important;
            font-size: 0.9375rem !important;
            min-height: 3rem !important;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
            letter-spacing: 0 !important;
        }

        .fp-form-wrapper .fi-btn:hover {
            background: rgba(79, 70, 229, 0.9) !important;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
        }

        .fp-card-inner {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        /* Left hero panel */
        .fp-hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: left;
            padding: 3rem 3.5rem;
            border-bottom: none;
            border-right: 1px solid #e5e7eb;
            animation: fpFadeIn 0.6s ease-out;
            background: #f9fafb;
        }

        .fp-hero-title {
            font-size: 2.875rem;
            margin: 2rem 0 1rem;
        }

        .fp-hero-desc {
            font-size: 1.0625rem;
            max-width: 400px;
        }

        .fp-hero-extended {
            display: block;
            margin-top: 0;
        }

        .fp-hero-footer {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 2rem;
        }

        .fp-avatars {
            display: flex;
        }

        .fp-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            border: 2px solid #ffffff;
            overflow: hidden;
            margin-left: -0.5rem;
            background: #e5e7eb;
        }

        .fp-avatar:first-child {
            margin-left: 0;
        }

        .fp-avatar-initials {
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

        .fp-avatar-initials:first-child {
            margin-left: 0;
        }

        .fp-social-proof {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
            font-weight: 500;
        }

        .fp-icon-badge {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 1rem;
        }

        .fp-icon-badge .material-symbols-outlined {
            font-size: 1.75rem !important;
        }
    }

    /* ================================================================
       LARGE DESKTOP (≥ 1280px)
       ================================================================ */
    @media (min-width: 1280px) {
        .fp-hero {
            padding: 4rem 5rem;
        }

        .fp-hero-title {
            font-size: 3.25rem;
        }

        .fp-card {
            padding: 3.5rem 4.5rem;
        }

        .fp-card-section {
            max-width: 50%;
        }
    }
</style>
@endpush

{{-- ============================================================ --}}
{{-- Page content — rendered inside Filament's layout.simple      --}}
{{-- ============================================================ --}}
<x-filament-panels::page.simple>
    <div class="fp-page" id="fp-page">

        {{-- ======================================================= --}}
        {{-- MOBILE HEADER — branding shown only on mobile           --}}
        {{-- ======================================================= --}}
        <div class="fp-mobile-header">
            <div class="fp-mobile-header-logo">
                <div class="fp-mobile-header-icon">
                    <span class="material-symbols-outlined">science</span>
                </div>
                <h1 class="fp-mobile-brand-name">PlayTest ID</h1>
            </div>
            <p class="fp-mobile-header-tagline">Pass Closed Testing Faster</p>
        </div>

        {{-- ======================================================= --}}
        {{-- LEFT PANEL — HERO / BRANDING (desktop only)             --}}
        {{-- ======================================================= --}}
        <div class="fp-hero">
            <div class="fp-hero-bg-img"></div>
            <div class="fp-hero-bg-overlay"></div>

            <div class="fp-hero-content">
                {{-- Logo --}}
                <div class="fp-logo">
                    <span class="material-symbols-outlined" style="font-size:1.875rem; color:#4F46E5;">science</span>
                    <h1 class="fp-brand-name">PlayTest ID</h1>
                </div>

                {{-- Desktop-only extended hero --}}
                <div class="fp-hero-extended">
                    <h2 class="fp-hero-title">
                        Recover Your Account.
                    </h2>
                    <p class="fp-hero-desc">
                        No worries — it happens. 
                    </p>
                </div>

                <div class="fp-hero-pills">
                    @foreach(['✓ 20+ Real Testers', '✓ Real Feedback', '✓ 14-Day Testing', '✓ Google Play Console', '✓ Instant Access'] as $feature)
                    <span class="fp-hero-pill">{{ $feature }}</span>
                    @endforeach
                </div>

                {{-- Desktop-only social proof footer --}}
                <div class="fp-hero-footer">
                    <div class="fp-avatars">
                        @php
                        $avatarColors = ['#6366f1', '#8b5cf6', '#ec4899', '#f59e0b'];
                        $avatarInitials = ['JD', 'AK', 'MR', 'ST'];
                        @endphp
                        @foreach($avatarInitials as $i => $initials)
                        <div class="fp-avatar-initials" style="background: {{ $avatarColors[$i] }}">
                            {{ $initials }}
                        </div>
                        @endforeach
                    </div>
                    <p class="fp-social-proof">
                        Used by <strong style="color:#111827; font-weight:700;">500+ Developers</strong>
                    </p>
                </div>
            </div>
        </div>

        {{-- ======================================================= --}}
        {{-- RIGHT PANEL — FORM                                       --}}
        {{-- ======================================================= --}}
        <div class="fp-card-section">
            <div class="fp-card">
                <div class="fp-card-inner">

                    {{-- ---- DEFAULT: request form state ---- --}}
                    <div id="fp-form-state">

                        {{-- Icon badge --}}
                        <div style="text-align: center;">
                            <div class="fp-icon-badge">
                                <span class="material-symbols-outlined">lock_reset</span>
                            </div>
                        </div>

                        {{-- Card header --}}
                        <div class="fp-card-header">
                            <h2 class="fp-card-title">Forgot Password?</h2>
                            <p class="fp-card-subtitle">
                                Enter the email address linked to your account<br>
                                and we'll send you a reset link.
                            </p>
                        </div>

                        {{-- Filament form (email + submit) --}}
                        <div class="fp-form-wrapper">
                            {{ $this->content }}
                        </div>

                        {{-- Back to login --}}
                        <a href="{{ filament()->getLoginUrl() }}" class="fp-back-link">
                            <span class="material-symbols-outlined">arrow_back</span>
                            Back to Sign In
                        </a>

                    </div>

                    {{-- ---- SUCCESS: email sent state (shown via JS after submit) ---- --}}
                    {{-- NOTE: Filament handles the success notification automatically.   --}}
                    {{-- This block is a progressive-enhancement layer if you want to     --}}
                    {{-- show a custom in-card success view. Wire up via Livewire event.  --}}
                    <div id="fp-success-state" style="display: none;">
                        <div class="fp-success-card" style="display: flex;">

                            <div class="fp-success-icon-wrap">
                                <span class="material-symbols-outlined">mark_email_read</span>
                            </div>

                            <h2 class="fp-success-title">Check Your Inbox</h2>
                            <p class="fp-success-desc">
                                We've sent a password reset link to<br>
                                <span class="fp-success-email-highlight" id="fp-sent-email">your email address</span>.
                            </p>
                            <p class="fp-success-hint">
                                Didn't receive it? Check your spam folder.
                            </p>

                            <hr class="fp-success-divider">

                            <div class="fp-resend-row">
                                <span>Didn't get the email?</span>
                                <a class="fp-resend-link" id="fp-resend-btn" href="#">Resend</a>
                            </div>

                        </div>

                        <a href="{{ filament()->getLoginUrl() }}" class="fp-back-link" style="margin-top: 1.5rem;">
                            <span class="material-symbols-outlined">arrow_back</span>
                            Back to Sign In
                        </a>
                    </div>

                </div>
            </div>

            {{-- Mobile-only feature pills --}}
            <div class="fp-mobile-features">
                @foreach(['✓ 20+ Testers', '✓ 14-Day Test', '✓ Instant Access'] as $feature)
                <span class="fp-mobile-pill">{{ $feature }}</span>
                @endforeach
            </div>
        </div>

    </div>
</x-filament-panels::page.simple>

{{-- Load Material Symbols --}}
@push('scripts')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
<style>
    @media (min-width: 1024px) {
        .fp-mobile-header { display: none !important; }
    }
</style>
<script>
    /**
     * Optional: Listen for Livewire's "password reset link sent" event and
     * swap the card into the success state with the user's email.
     *
     * Filament dispatches `password-reset-link-sent` from the built-in action.
     * Adjust the event name if you customise the action.
     */
    document.addEventListener('DOMContentLoaded', function () {
        const formState    = document.getElementById('fp-form-state');
        const successState = document.getElementById('fp-success-state');
        const sentEmail    = document.getElementById('fp-sent-email');
        const resendBtn    = document.getElementById('fp-resend-btn');

        /**
         * Swap to success state.
         * @param {string} email - The address the reset was sent to.
         */
        function showSuccess(email) {
            if (sentEmail && email) sentEmail.textContent = email;
            if (formState)    formState.style.display    = 'none';
            if (successState) successState.style.display = 'block';
        }

        /* ---- Wire up to Livewire v3 events ---- */
        if (typeof window.Livewire !== 'undefined') {
            Livewire.on('password-reset-link-sent', (data) => {
                const email = data?.email
                    ?? document.querySelector('.fp-form-wrapper input[type="email"]')?.value
                    ?? '';
                showSuccess(email);
            });
        }

        /* ---- Resend: click sends user back to form state ---- */
        if (resendBtn) {
            resendBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (formState)    formState.style.display    = 'block';
                if (successState) successState.style.display = 'none';
            });
        }
    });
</script>
@endpush