<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verified — PlayTest ID</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --indigo: #4F46E5;
            --violet: #7c3aed;
            --green: #10b981;
            --text-dark: #111827;
            --text-mid: #374151;
            --text-muted: #6b7280;
        }

        html,
        body {
            min-height: 100%;
            font-family: 'Manrope', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Background ── */
        body {
            background: #f0f4ff;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            /* Memastikan tinggi pas 1 layar */
            padding: 1rem;
            position: relative;
            overflow: hidden;
            /* Mencegah scroll */
        }

        /* Decorative blobs */
        body::before {
            content: '';
            position: fixed;
            top: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -250px;
            left: -200px;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Floating confetti particles */
        .confetti-wrap {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .confetti-piece {
            position: absolute;
            top: -20px;
            border-radius: 2px;
            animation: confettiFall linear infinite;
            opacity: 0;
        }

        @keyframes confettiFall {
            0% {
                transform: translateY(-20px) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(110vh) rotate(720deg);
                opacity: 0.3;
            }
        }

        /* ── Card ── */
        .card {
            position: relative;
            z-index: 1;
            background: #ffffff;
            border-radius: 1.5rem;
            box-shadow: 0 24px 80px rgba(79, 70, 229, 0.15), 0 4px 20px rgba(0, 0, 0, 0.06);
            padding: 2.25rem 2rem 2rem;
            width: 100%;
            max-width: 460px;
            text-align: center;
            animation: cardSlideUp 0.65s cubic-bezier(0.16, 1, 0.3, 1) both;
            display: flex;
            flex-direction: column;
            justify-content: center;

            /* Trik Flexbox: Otomatis menekan footer ke bawah dan menjaga card di tengah */
            margin: auto 0;
        }

        @keyframes cardSlideUp {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Top gradient bar */
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            /* Ditipiskan sedikit */
            background: linear-gradient(90deg, var(--indigo) 0%, var(--violet) 100%);
            border-radius: 1.5rem 1.5rem 0 0;
        }

        /* ── Brand logo ── */
        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1.375rem;
        }

        .brand-icon {
            width: 2rem;
            height: 2rem;
            background: linear-gradient(135deg, var(--indigo) 0%, var(--violet) 100%);
            border-radius: 0.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
        }

        .brand-icon .material-symbols-outlined {
            font-size: 1.125rem;
            color: #fff;
        }

        .brand-name {
            font-size: 1.0625rem;
            font-weight: 900;
            color: var(--text-dark);
            letter-spacing: -0.02em;
        }

        /* ── Success badge ── */
        .success-badge-wrap {
            position: relative;
            display: flex;
            justify-content: center;
            margin-bottom: 1.125rem;
        }

        .success-badge {
            width: 4.75rem;
            height: 4.75rem;
            background: linear-gradient(135deg, var(--indigo) 0%, var(--violet) 100%);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 24px rgba(79, 70, 229, 0.4);
            animation: badgePop 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) 0.35s both;
        }

        @keyframes badgePop {
            from {
                opacity: 0;
                transform: scale(0.5) rotate(-10deg);
            }

            to {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }

        .success-badge .material-symbols-outlined {
            font-size: 2.375rem;
            color: #fff;
        }

        /* Outer ring */
        .success-badge-ring {
            position: absolute;
            inset: -6px;
            border: 2px solid rgba(79, 70, 229, 0.2);
            border-radius: 1.5rem;
            animation: ringPulse 2s ease-in-out infinite;
        }

        @keyframes ringPulse {

            0%,
            100% {
                opacity: 0.6;
                transform: scale(1);
            }

            50% {
                opacity: 0;
                transform: scale(1.1);
            }
        }

        /* Green tick in corner */
        .success-tick {
            position: absolute;
            bottom: -3px;
            right: -3px;
            width: 1.5rem;
            height: 1.5rem;
            background: var(--green);
            border-radius: 50%;
            border: 2px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: tickBounce 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.8s both;
        }

        @keyframes tickBounce {
            from {
                opacity: 0;
                transform: scale(0);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .success-tick .material-symbols-outlined {
            font-size: 0.75rem;
            color: #fff;
            font-variation-settings: 'FILL' 1, 'wght' 700;
        }

        /* ── Headline ── */
        .headline-label {
            display: inline-block;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.08) 0%, rgba(124, 58, 237, 0.08) 100%);
            border: 1px solid rgba(79, 70, 229, 0.22);
            color: var(--indigo);
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border-radius: 9999px;
            padding: 0.3rem 0.75rem;
            margin-bottom: 0.5rem;
            animation: fadeInUp 0.5s ease 0.5s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 1.625rem;
            font-weight: 900;
            color: var(--text-dark);
            letter-spacing: -0.02em;
            line-height: 1.15;
            margin-bottom: 0.5rem;
            animation: fadeInUp 0.5s ease 0.6s both;
        }

        .subtitle {
            font-size: 0.8125rem;
            color: var(--text-muted);
            line-height: 1.55;
            font-weight: 500;
            margin-bottom: 1.25rem;
            animation: fadeInUp 0.5s ease 0.7s both;
        }

        /* ── Perks list ── */
        .perks {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
            text-align: left;
            animation: fadeInUp 0.5s ease 0.8s both;
        }

        .perk {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            background: linear-gradient(135deg, #eef2ff 0%, #f5f3ff 100%);
            border: 1px solid #c7d2fe;
            border-radius: 0.625rem;
            padding: 0.625rem 1rem;
        }

        .perk-icon {
            width: 1.875rem;
            height: 1.875rem;
            background: linear-gradient(135deg, var(--indigo) 0%, var(--violet) 100%);
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .perk-icon .material-symbols-outlined {
            font-size: 0.9rem;
            color: #fff;
            font-variation-settings: 'FILL' 1;
        }

        .perk-text {
            font-size: 0.775rem;
            font-weight: 700;
            color: var(--text-mid);
            line-height: 1.2;
        }

        .perk-text span {
            display: block;
            font-size: 0.675rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-top: 0.125rem;
        }

        /* ── CTA Button ── */
        .cta-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.375rem;
            width: 100%;
            padding: 0.8rem 1rem;
            background: linear-gradient(135deg, var(--indigo) 0%, var(--violet) 100%);
            color: #ffffff;
            font-size: 0.875rem;
            font-weight: 800;
            font-family: 'Manrope', sans-serif;
            text-decoration: none;
            border-radius: 0.625rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transition: all 0.2s ease;
            letter-spacing: 0.01em;
            margin-bottom: 0.75rem;
            animation: fadeInUp 0.5s ease 0.9s both;
        }

        .cta-btn .material-symbols-outlined {
            font-size: 0.875rem;
            font-variation-settings: 'FILL' 0, 'wght' 700;
        }

        .cta-btn:hover {
            background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
            transform: translateY(-1px);
        }

        .cta-btn:active {
            transform: scale(0.98) translateY(0);
        }

        /* ── Auto-redirect notice ── */
        .redirect-notice {
            font-size: 0.7rem;
            color: var(--text-muted);
            font-weight: 600;
            animation: fadeInUp 0.5s ease 1s both;
            margin: 0;
        }

        .redirect-notice strong {
            color: var(--indigo);
            font-weight: 800;
        }

        /* ── Countdown ring ── */
        .countdown-wrap {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        #countdown {
            font-weight: 900;
            color: var(--indigo);
        }

        /* ── Footer ── */
        .footer {
            width: 100%;
            text-align: center;
            padding-top: 0.5rem;
            font-size: 0.7rem;
            color: #9ca3af;
            font-weight: 500;
            z-index: 1;
            animation: fadeInUp 0.5s ease 1.1s both;
        }

        .footer p {
            margin: 0;
        }

        .footer-links {
            margin-top: 0.25rem;
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }

        .footer a {
            color: #9ca3af;
            text-decoration: none;
        }

        .footer a:hover {
            color: var(--indigo);
        }

        /* ── Responsive Desktop (Diperbesar sedikit tapi tetap compact) ── */
        @media (min-width: 640px) {
            .card {
                padding: 2.75rem 3rem 2.5rem;
            }

            h1 {
                font-size: 1.875rem;
            }

            .subtitle {
                font-size: 0.875rem;
                margin-bottom: 1.5rem;
            }

            .perks {
                gap: 0.625rem;
                margin-bottom: 1.5rem;
            }

            .perk {
                padding: 0.75rem 1.125rem;
            }

            .perk-text {
                font-size: 0.8125rem;
            }

            .perk-text span {
                font-size: 0.7rem;
            }

            .cta-btn {
                font-size: 0.9375rem;
                padding: 0.875rem 1rem;
                margin-bottom: 0.875rem;
            }
        }
    </style>
</head>

<body>

    <!-- Confetti -->
    <div class="confetti-wrap" id="confetti-wrap"></div>

    <!-- Card -->
    <div class="card">

        <!-- Brand -->
        <div class="brand">
            <div class="brand-icon">
                <span class="material-symbols-outlined">science</span>
            </div>
            <span class="brand-name">PlayTest ID</span>
        </div>

        <!-- Success badge -->
        <div class="success-badge-wrap">
            <div class="success-badge">
                <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1,'wght' 700;">verified</span>
                <div class="success-tick">
                    <span class="material-symbols-outlined">check</span>
                </div>
            </div>
            <div class="success-badge-ring"></div>
        </div>

        <!-- Headline -->
        <div>
            <span class="headline-label">&#10003; Verification Successful</span>
        </div>
        <h1>Email Verified!</h1>
        <p class="subtitle">
            Your PlayTest ID account is now fully activated.<br>
            You're ready to start testing apps and earning rewards!
        </p>

        <!-- Perks -->
        <div class="perks">
            <div class="perk">
                <div class="perk-icon">
                    <span class="material-symbols-outlined">assignment</span>
                </div>
                <div class="perk-text">
                    Browse Testing Missions
                    <span>Find apps that need your feedback</span>
                </div>
            </div>
            <div class="perk">
                <div class="perk-icon">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <div class="perk-text">
                    Earn Points &amp; Rewards
                    <span>Get paid for every completed test</span>
                </div>
            </div>
            <div class="perk">
                <div class="perk-icon">
                    <span class="material-symbols-outlined">workspace_premium</span>
                </div>
                <div class="perk-text">
                    Build Your Tester Badge
                    <span>Level up with each test you complete</span>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <a href="{{ $panel ?? '/tester' }}" class="cta-btn" id="dashboard-btn">
            <span class="material-symbols-outlined">rocket_launch</span>
            Go to Dashboard
        </a>

        <!-- Auto-redirect -->
        <p class="redirect-notice">
            Redirecting automatically in
            <span class="countdown-wrap">
                <strong id="countdown">5</strong>s
            </span>
        </p>

    </div>

    <!-- Footer (Sekarang dijamin persis di tengah bawah) -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} PlayTest ID. All rights reserved.</p>
        <div class="footer-links">
            <a href="{{ config('app.url') }}">Home</a>
            <a href="{{ config('app.url') }}/privacy">Privacy</a>
            <a href="{{ config('app.url') }}/terms">Terms</a>
        </div>
    </div>

    <script>
        /* ── Confetti generator ── */
        const confettiColors = ['#4F46E5', '#7c3aed', '#ec4899', '#f59e0b', '#10b981', '#3b82f6', '#f43f5e'];
        const wrap = document.getElementById('confetti-wrap');

        for (let i = 0; i < 50; i++) {
            const piece = document.createElement('div');
            piece.classList.add('confetti-piece');
            const size = Math.random() * 10 + 6;
            const left = Math.random() * 100;
            const delay = Math.random() * 5;
            const dur = Math.random() * 4 + 4;
            const color = confettiColors[Math.floor(Math.random() * confettiColors.length)];
            piece.style.cssText = `
                width:${size}px; height:${size}px;
                left:${left}%;
                background:${color};
                animation-duration:${dur}s;
                animation-delay:${delay}s;
                border-radius:${Math.random() > 0.5 ? '50%' : '2px'};
            `;
            wrap.appendChild(piece);
        }

        /* ── Countdown + auto-redirect ── */
        const panelPath = @json($panel ?? '/tester');
        const panelUrl = window.location.origin + panelPath;

        const dashBtn = document.getElementById('dashboard-btn');
        const countEl = document.getElementById('countdown');

        if (dashBtn) dashBtn.setAttribute('href', panelUrl);

        if (dashBtn) {
            dashBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.replace(panelUrl);
            });
        }

        let seconds = 10;

        const timer = setInterval(function() {
            seconds -= 1;
            if (countEl) countEl.textContent = Math.max(0, seconds);
            if (seconds <= 0) {
                clearInterval(timer);
                window.location.replace(panelUrl);
            }
        }, 1000);
    </script>

</body>

</html>