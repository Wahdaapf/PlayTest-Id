{{-- ============================================================ --}}
{{-- Custom Reset Password Page — Split-Screen Light Design      --}}
{{-- Matches: login.blade.php & request-reset-password design    --}}
{{-- ============================================================ --}}

@push('styles')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800,900&display=swap" rel="stylesheet" />
<style>
    /* ================================================================
       RESET PASSWORD PAGE — RESET FILAMENT LAYOUT
       ================================================================ */
    .fi-simple-layout:has(.rp-page) {
        background: transparent !important;
        min-height: 100dvh;
    }

    .fi-simple-main-ctn:has(.rp-page) {
        display: flex;
        align-items: stretch;
        min-height: 100dvh;
        padding: 0 !important;
    }

    .fi-simple-main:has(.rp-page) {
        max-width: 100% !important;
        width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .fi-simple-page:has(.rp-page) {
        padding: 0 !important;
        max-width: unset !important;
    }

    .fi-simple-page-content:has(.rp-page) {
        max-width: unset !important;
        width: 100%;
    }

    .fi-body:has(.rp-page) {
        overflow-x: hidden;
    }

    /* ================================================================
       PAGE CONTAINER
       ================================================================ */
    .rp-page {
        display: flex;
        flex-direction: column;
        min-height: 100dvh;
        font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif;
        background: linear-gradient(160deg, #3730a3 0%, #4F46E5 38%, #7c3aed 100%);
    }

    /* ================================================================
       MOBILE TOP HEADER
       ================================================================ */
    .rp-mobile-header {
        position: relative;
        padding: calc(env(safe-area-inset-top, 0px) + 2.5rem) 1.75rem 0;
        text-align: center;
        animation: rpFadeInDown 0.55s cubic-bezier(0.22, 1, 0.36, 1);
        z-index: 1;
    }

    .rp-mobile-header-logo {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.625rem;
        margin-bottom: 1.25rem;
    }

    .rp-mobile-header-icon {
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

    .rp-mobile-header-icon .material-symbols-outlined {
        font-size: 1.625rem !important;
        color: #fff !important;
    }

    .rp-mobile-brand-name {
        font-size: 1.375rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: #fff;
        margin: 0;
    }

    .rp-mobile-header-tagline {
        font-size: 0.875rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.75);
        margin: 0;
    }

    /* ================================================================
       LEFT PANEL — HERO (desktop only)
       ================================================================ */
    .rp-hero {
        position: relative;
        flex-shrink: 0;
        padding: 2.5rem 1.5rem 1.75rem;
        text-align: center;
        background: #f9fafb;
        overflow: hidden;
        animation: rpFadeInDown 0.6s ease-out;
        border-bottom: 1px solid #e5e7eb;
        display: none;
    }

    .rp-hero-bg-img {
        position: absolute;
        inset: 0;
        background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAI9gJnovj2fCx3g9q-dArBHoXKgL9Or-jNTVccMUrSSXS6h9V7VHA3JK9qxF2phWOHbwFoBk2PVClUCxM2SRGSgHx4TfLhfdcjL7IzZZyfXUVf-hDdASQ8EeYaWlpAqIZr9PB8-jjHhh9fvngXsdnywYFWJUELojKH0Fla6ekbnJZErBhOAWwOgO0JPbsDar5uUCF3xA2xUXMwI6oAsoLtnzCvXVldkYIVE14N4UbS3YnpfuKzIFODWYCtPWlLzai-tZcPuiaKTIQ');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        pointer-events: none;
    }

    .rp-hero-bg-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(249, 250, 251, 0.92) 0%, rgba(249, 250, 251, 0.55) 100%);
        pointer-events: none;
    }

    .rp-hero-content {
        position: relative;
        z-index: 10;
        display: flex;
        flex-direction: column;
        justify-content: center;
        flex: 1;
    }

    /* Password reveal button */
    .fi-input-wrp button {
        color: #9ca3af !important;
    }

    .fi-input-wrp button:hover {
        color: #4F46E5 !important;
    }

    .rp-logo {
        display: inline-flex;
        align-items: center;
        gap: 0.625rem;
        color: #4F46E5;
        margin-bottom: 0.5rem;
    }

    .rp-brand-name {
        font-size: 1.375rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: #111827;
        margin: 0;
    }

    .rp-hero-title {
        font-size: 2rem;
        font-weight: 900;
        line-height: 1.1;
        letter-spacing: -0.035em;
        color: #111827;
        margin: 1.25rem 0 0.875rem;
    }

    .rp-hero-desc {
        font-size: 0.9375rem;
        color: #6b7280;
        line-height: 1.65;
        margin: 0;
        font-weight: 500;
    }

    .rp-hero-extended,
    .rp-hero-footer {
        display: none;
    }

    .rp-hero-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.625rem;
        margin-top: 5rem;
    }

    .rp-hero-pill {
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
    }

    /* ================================================================
       RIGHT PANEL — FORM CARD
       ================================================================ */
    .rp-card-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        margin-top: 1.5rem;
    }

    .rp-card {
        flex: 1;
        background: #ffffff;
        border-radius: 1.75rem 1.75rem 0 0;
        padding: 2.25rem 1.5rem 2rem;
        box-shadow: 0 -8px 40px rgba(55, 48, 163, 0.18);
        animation: rpSlideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
    }

    .rp-icon-badge {
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

    .rp-icon-badge .material-symbols-outlined {
        font-size: 2rem !important;
        color: #4F46E5 !important;
    }

    .rp-card-header {
        text-align: center;
        margin-bottom: 1.75rem;
    }

    .rp-card-title {
        font-size: 1.625rem;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.03em;
        margin: 0 0 0.3rem;
    }

    .rp-card-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 500;
        margin: 0;
        line-height: 1.6;
    }

    /* ================================================================
       FILAMENT FORM OVERRIDES
       ================================================================ */
    .rp-form-wrapper {
        margin-top: 0;
    }

    .rp-form-wrapper .fi-fo-field-wrp {
        margin-bottom: 1rem !important;
    }

    .rp-form-wrapper .fi-fo-field-wrp-label label {
        font-size: 0.8125rem !important;
        font-weight: 600 !important;
        color: #111827 !important;
        font-family: 'Manrope', sans-serif !important;
    }

    .rp-form-wrapper .fi-fo-field-wrp-label sup,
    .rp-form-wrapper .fi-fo-field-wrp-label .text-danger-600 {
        color: #ef4444 !important;
    }

    .rp-form-wrapper .fi-input-wrp {
        border: 1.5px solid #e5e7eb !important;
        border-radius: 0.875rem !important;
        background: #f9fafb !important;
        overflow: hidden !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease !important;
    }

    .rp-form-wrapper .fi-input-wrp:focus-within {
        border-color: #4F46E5 !important;
        background: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12) !important;
    }

    .rp-form-wrapper .fi-input-wrp input {
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

    .rp-form-wrapper .fi-input-wrp input::placeholder {
        color: #9ca3af !important;
    }

    .rp-form-wrapper .fi-btn {
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

    .rp-form-wrapper .fi-btn:hover {
        background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%) !important;
        box-shadow: 0 8px 24px rgba(79, 70, 229, 0.45) !important;
    }

    .rp-form-wrapper .fi-btn:active {
        transform: scale(0.98) !important;
        box-shadow: 0 3px 10px rgba(79, 70, 229, 0.25) !important;
    }

    .rp-form-wrapper .fi-ac-actions {
        margin-top: 0.5rem !important;
    }

    .rp-form-wrapper .fi-fo-field-wrp-error-message {
        font-size: 0.75rem !important;
        color: #ef4444 !important;
        margin-top: 0.25rem !important;
        font-family: 'Manrope', sans-serif !important;
    }

    /* ================================================================
       BACK TO LOGIN LINK
       ================================================================ */
    .rp-back-link {
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
    .rp-form-wrapper .fi-link,
    .rp-form-wrapper .fi-link span,
    .rp-form-wrapper .fi-link a,
    .rp-form-wrapper a:not(.fi-btn) {
        color: #4F46E5 !important;
        font-weight: 600 !important;
        text-decoration: none !important;
    }

    .rp-back-link:hover {
        color: #4F46E5 !important;
    }

    .rp-back-link .material-symbols-outlined {
        font-size: 1.125rem !important;
        color: inherit !important;
        transition: transform 0.2s ease;
    }

    .rp-back-link:hover .material-symbols-outlined {
        transform: translateX(-3px);
    }

    /* ================================================================
       MOBILE FEATURE PILLS
       ================================================================ */
    .rp-mobile-features {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding: 1rem 1.5rem calc(1.5rem + env(safe-area-inset-bottom, 0px));
        background: #ffffff;
        animation: rpFadeIn 0.5s ease-out 0.5s both;
        border-top: 1px solid #f3f4f6;
    }

    .rp-mobile-pill {
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.08) 0%, rgba(124, 58, 237, 0.08) 100%);
        color: #4F46E5;
        border-radius: 9999px;
        padding: 0.4rem 0.875rem;
        font-size: 0.75rem;
        font-weight: 700;
        border: 1px solid rgba(79, 70, 229, 0.18);
    }

    /* ================================================================
       ANIMATIONS
       ================================================================ */
    @keyframes rpFadeInDown {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes rpSlideUp {
        from {
            opacity: 0;
            transform: translateY(32px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes rpFadeIn {
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
        .rp-card {
            padding: 2.5rem 2.5rem 2rem;
        }

        .rp-card-title {
            font-size: 1.875rem;
        }

        .rp-card-section {
            margin-top: 2rem;
        }
    }

    /* ================================================================
       DESKTOP (≥ 1024px)
       ================================================================ */
    @media (min-width: 1024px) {
        .rp-page {
            background: #ffffff;
            flex-direction: row;
        }

        .rp-mobile-header {
            display: none !important;
        }

        .rp-card-section {
            margin-top: 0;
            width: 50%;
            flex: 0 0 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .rp-card {
            border-radius: 0;
            box-shadow: none;
            padding: 3rem 4rem;
            flex: none;
            background: #ffffff;
            animation: rpFadeIn 0.5s ease-out;
        }

        .rp-card-header {
            text-align: center;
        }

        .rp-card-title {
            font-size: 2rem;
        }

        .rp-mobile-features {
            display: none;
        }

        .rp-form-wrapper .fi-input-wrp {
            border-radius: 0.5rem !important;
            background: #ffffff !important;
        }

        .rp-form-wrapper .fi-input-wrp input {
            padding: 0.75rem 1rem !important;
            font-size: 0.9375rem !important;
            min-height: 2.875rem !important;
        }

        .rp-form-wrapper .fi-btn {
            background: #4F46E5 !important;
            border-radius: 0.5rem !important;
            padding: 0.75rem 1.5rem !important;
            font-size: 0.9375rem !important;
            min-height: 3rem !important;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
        }

        .rp-form-wrapper .fi-btn:hover {
            background: rgba(79, 70, 229, 0.9) !important;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
        }

        .rp-card-inner {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        .rp-hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: left;
            padding: 3rem 3.5rem;
            border-bottom: none;
            border-right: 1px solid #e5e7eb;
            animation: rpFadeIn 0.6s ease-out;
            background: #f9fafb;
        }

        .rp-hero-title {
            font-size: 2.875rem;
            margin: 2rem 0 1rem;
        }

        .rp-hero-desc {
            font-size: 1.0625rem;
            max-width: 400px;
        }

        .rp-hero-extended {
            display: block;
        }

        .rp-hero-footer {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 2rem;
        }

        .rp-avatars {
            display: flex;
        }

        .rp-avatar-initials {
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

        .rp-avatar-initials:first-child {
            margin-left: 0;
        }

        .rp-social-proof {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
            font-weight: 500;
        }

        .rp-icon-badge {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 1rem;
        }

        .rp-icon-badge .material-symbols-outlined {
            font-size: 1.75rem !important;
        }
    }

    @media (min-width: 1280px) {
        .rp-hero {
            padding: 4rem 5rem;
        }

        .rp-hero-title {
            font-size: 3.25rem;
        }

        .rp-card {
            padding: 3.5rem 4.5rem;
        }

        .rp-card-section {
            max-width: 50%;
        }
    }
</style>
@endpush

<x-filament-panels::page.simple>
    <div class="rp-page" id="rp-page">

        {{-- MOBILE HEADER --}}
        <div class="rp-mobile-header">
            <div class="rp-mobile-header-logo">
                <div class="rp-mobile-header-icon">
                    <span class="material-symbols-outlined">science</span>
                </div>
                <h1 class="rp-mobile-brand-name">PlayTest ID</h1>
            </div>
            <p class="rp-mobile-header-tagline">Pass Closed Testing Faster</p>
        </div>

        {{-- LEFT PANEL — HERO (desktop only) --}}
        <div class="rp-hero">
            <div class="rp-hero-bg-img"></div>
            <div class="rp-hero-bg-overlay"></div>
            <div class="rp-hero-content">
                <div class="rp-logo">
                    <span class="material-symbols-outlined" style="font-size:1.875rem; color:#4F46E5;">science</span>
                    <h1 class="rp-brand-name">PlayTest ID</h1>
                </div>
                <div class="rp-hero-extended">
                    <h2 class="rp-hero-title">Create New Password.</h2>
                    <p class="rp-hero-desc">Choose a strong password to keep your account secure.</p>
                </div>
                <div class="rp-hero-pills">
                    @foreach(['✓ 20+ Real Testers', '✓ Real Feedback', '✓ 14-Day Testing', '✓ Google Play Console', '✓ Instant Access'] as $feature)
                    <span class="rp-hero-pill">{{ $feature }}</span>
                    @endforeach
                </div>
                <div class="rp-hero-footer">
                    <div class="rp-avatars">
                        @php $avatarColors = ['#6366f1','#8b5cf6','#ec4899','#f59e0b']; $avatarInitials = ['JD','AK','MR','ST']; @endphp
                        @foreach($avatarInitials as $i => $initials)
                        <div class="rp-avatar-initials" style="background: {{ $avatarColors[$i] }}">{{ $initials }}</div>
                        @endforeach
                    </div>
                    <p class="rp-social-proof">Used by <strong style="color:#111827; font-weight:700;">500+ Developers</strong></p>
                </div>
            </div>
        </div>

        {{-- RIGHT PANEL — FORM --}}
        <div class="rp-card-section">
            <div class="rp-card">
                <div class="rp-card-inner">
                    <div style="text-align: center;">
                        <div class="rp-icon-badge">
                            <span class="material-symbols-outlined">lock</span>
                        </div>
                    </div>
                    <div class="rp-card-header">
                        <h2 class="rp-card-title">Set New Password</h2>
                        <p class="rp-card-subtitle">
                            Enter your new password below.<br>
                            Make sure it's at least 8 characters.
                        </p>
                    </div>
                    <div class="rp-form-wrapper">
                        {{ $this->content }}
                    </div>
                    <a href="{{ filament()->getLoginUrl() }}" class="rp-back-link">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Back to Sign In
                    </a>
                </div>
            </div>
            <div class="rp-mobile-features">
                @foreach(['✓ 20+ Testers', '✓ 14-Day Test', '✓ Instant Access'] as $feature)
                <span class="rp-mobile-pill">{{ $feature }}</span>
                @endforeach
            </div>
        </div>

    </div>
</x-filament-panels::page.simple>

@push('scripts')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
<style>
    @media (min-width: 1024px) {
        .rp-mobile-header {
            display: none !important;
        }
    }
</style>
@endpush