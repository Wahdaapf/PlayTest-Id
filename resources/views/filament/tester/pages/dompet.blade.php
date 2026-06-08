{{--
    Dompet / Wallet — PlayTest ID
    Panel  : Tester (path /tester)
    Page   : Dompet.php
--}}

<x-filament-panels::page>

    @push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />

    <style>
        /* ====== Animations ====== */
        @keyframes prof-float       { 0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(20px,-15px) scale(1.08)} }
        @keyframes prof-float-rev   { 0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(-25px,20px) scale(0.92)} }
        @keyframes prof-gradient    { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
        @keyframes prof-shimmer     { 0%{transform:translateX(-100%)} 100%{transform:translateX(200%)} }
        @keyframes prof-pulse-ring  { 0%{box-shadow:0 0 0 0 rgba(52,211,153,.6)} 70%{box-shadow:0 0 0 10px rgba(52,211,153,0)} 100%{box-shadow:0 0 0 0 rgba(52,211,153,0)} }
        @keyframes prof-fade-up     { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        @keyframes prof-scale-in    { from{opacity:0;transform:scale(.95)} to{opacity:1;transform:scale(1)} }
        @keyframes prof-spin-slow   { from{transform:rotate(0)} to{transform:rotate(360deg)} }
        @keyframes prof-spin-rev    { from{transform:rotate(360deg)} to{transform:rotate(0)} }
        @keyframes prof-bounce-soft { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-4px)} }

        /* ====== Live background animations ====== */
        @keyframes prof-aurora {
          0%   { transform: translate(-10%,-10%) rotate(0deg)   scale(1.1); }
          33%  { transform: translate(8%,-6%)   rotate(120deg) scale(1.25); }
          66%  { transform: translate(-6%,10%)  rotate(240deg) scale(1.15); }
          100% { transform: translate(-10%,-10%) rotate(360deg) scale(1.1); }
        }
        @keyframes prof-conic { to { transform: rotate(360deg); } }
        @keyframes prof-grid-pan {
          0%   { background-position: 0 0, 0 0; }
          100% { background-position: 56px 56px, 56px 56px; }
        }
        @keyframes prof-particle {
          0%   { transform: translateY(0) translateX(0); opacity: 0; }
          10%  { opacity: .9; }
          90%  { opacity: .9; }
          100% { transform: translateY(-220px) translateX(var(--drift,20px)); opacity: 0; }
        }
        @keyframes prof-shoot {
          0%   { transform: translate3d(0,0,0) rotate(18deg); opacity: 0; }
          8%   { opacity: 1; }
          100% { transform: translate3d(620px,200px,0) rotate(18deg); opacity: 0; }
        }
        @keyframes prof-wave {
          0%   { transform: translateX(0); }
          100% { transform: translateX(-50%); }
        }
        @keyframes prof-scan {
          0%   { transform: translateY(-100%); opacity: 0; }
          20%  { opacity: .55; }
          80%  { opacity: .55; }
          100% { transform: translateY(420%); opacity: 0; }
        }
        @keyframes prof-twinkle {
          0%,100% { opacity: .2; transform: scale(1); }
          50%     { opacity: 1;  transform: scale(1.6); }
        }

        .prof-hero {
          background: linear-gradient(135deg,#0a1850 0%,#13297a 25%,#1d4ed8 55%,#2563eb 80%,#3b82f6 100%);
          background-size: 220% 220%;
          animation: prof-gradient 14s ease infinite;
          box-shadow: 0 20px 60px -15px rgba(37,99,235,.5), 0 0 0 1px rgba(255,255,255,.06) inset;
          isolation: isolate;
        }
        .prof-blob       { animation: prof-float 9s ease-in-out infinite; will-change: transform; filter: blur(2px); }
        .prof-blob-rev   { animation: prof-float-rev 11s ease-in-out infinite; will-change: transform; filter: blur(2px); }

        /* Aurora mesh */
        .prof-aurora {
          position:absolute; inset:-30%;
          background:
            radial-gradient(40% 35% at 20% 30%, rgba(96,165,250,.55), transparent 60%),
            radial-gradient(35% 30% at 80% 20%, rgba(167,139,250,.45), transparent 60%),
            radial-gradient(45% 40% at 60% 80%, rgba(34,211,238,.40), transparent 60%),
            radial-gradient(30% 25% at 15% 85%, rgba(244,114,182,.35), transparent 60%);
          filter: blur(40px);
          animation: prof-aurora 22s ease-in-out infinite;
          mix-blend-mode: screen;
          pointer-events:none;
        }
        /* Slow rotating conic glow */
        .prof-conic {
          position:absolute; width:520px; height:520px; left:-160px; bottom:-200px;
          background: conic-gradient(from 0deg, rgba(59,130,246,0), rgba(96,165,250,.35), rgba(167,139,250,.25), rgba(34,211,238,.30), rgba(59,130,246,0));
          border-radius:50%;
          filter: blur(30px);
          animation: prof-conic 28s linear infinite;
          opacity:.7; pointer-events:none;
        }
        .prof-conic-2 {
          position:absolute; width:380px; height:380px; right:-120px; top:-140px;
          background: conic-gradient(from 180deg, rgba(244,114,182,0), rgba(244,114,182,.30), rgba(96,165,250,.30), rgba(244,114,182,0));
          border-radius:50%;
          filter: blur(30px);
          animation: prof-spin-rev 34s linear infinite;
          opacity:.6; pointer-events:none;
        }

        .prof-grid-bg {
          background-image:
            linear-gradient(rgba(255,255,255,.07) 1px,transparent 1px),
            linear-gradient(90deg,rgba(255,255,255,.07) 1px,transparent 1px);
          background-size: 28px 28px;
          mask-image: radial-gradient(ellipse at top right, black 30%, transparent 70%);
          animation: prof-grid-pan 18s linear infinite;
        }

        /* Floating particles */
        .prof-particles { position:absolute; inset:0; overflow:hidden; pointer-events:none; }
        .prof-particles span {
          position:absolute; bottom:-10px;
          width:6px; height:6px; border-radius:50%;
          background: radial-gradient(circle, #fff 0%, rgba(255,255,255,.2) 60%, transparent 70%);
          box-shadow: 0 0 12px rgba(255,255,255,.7);
          animation: prof-particle linear infinite;
          opacity:0;
        }

        /* Twinkling stars */
        .prof-stars { position:absolute; inset:0; pointer-events:none; }
        .prof-stars span {
          position:absolute; width:2px; height:2px; border-radius:50%;
          background:#fff !important; box-shadow:0 0 6px #fff, 0 0 12px #fff !important;
          animation: prof-twinkle 3s ease-in-out infinite;
        }

        /* Shooting star */
        .prof-shoot {
          position:absolute; top:18%; left:-20%;
          width:120px; height:2px;
          background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,.9));
          filter: drop-shadow(0 0 6px rgba(147,197,253,.9));
          border-radius:2px;
          animation: prof-shoot 7s ease-in infinite;
          animation-delay: -2s;
          pointer-events:none;
          opacity: 0;
        }
        .prof-shoot.s2 { top:55%; animation-duration: 9s; animation-delay: -5s; opacity: 0; }

        /* Wave bottom */
        .prof-waves {
          position:absolute; left:0; right:0; bottom:0; height:80px;
          overflow:hidden; pointer-events:none; opacity:.35;
          mask-image: linear-gradient(180deg, transparent, #000 60%);
        }
        .prof-waves svg { width:200%; height:100%; display:block; animation: prof-wave 14s linear infinite; }
        .prof-waves.w2 svg { animation-duration: 22s; opacity:.6; }

        /* Scanline sweep */
        .prof-scan {
          position:absolute; left:0; right:0; top:0; height:25%;
          background: linear-gradient(180deg, transparent, rgba(147,197,253,.18), transparent);
          animation: prof-scan 9s ease-in-out infinite;
          pointer-events:none;
        }

        @media (prefers-reduced-motion: reduce) {
          .prof-hero, .prof-blob, .prof-blob-rev,
          .prof-aurora, .prof-conic, .prof-conic-2,
          .prof-grid-bg, .prof-particles span, .prof-shoot, .prof-waves svg, .prof-scan, .prof-stars span { animation: none !important; }
        }

        .prof-avatar {
          background: linear-gradient(135deg,#fbbf24,#f59e0b,#ef4444);
          box-shadow: 0 8px 24px rgba(0,0,0,.25), 0 0 0 4px rgba(255,255,255,.15);
        }
        .prof-status-dot { animation: prof-pulse-ring 2s infinite; }
        .prof-stat-pill {
          background: rgba(255,255,255,.08); backdrop-filter: blur(12px);
          border: 1px solid rgba(255,255,255,.15);
          transition: all .3s cubic-bezier(.4,0,.2,1);
          position: relative; overflow: hidden;
        }
        .prof-stat-pill:hover { background: rgba(255,255,255,.15); transform: translateY(-3px); border-color: rgba(255,255,255,.3); }
        .prof-stat-pill::after { content:''; position:absolute; top:0; left:0; width:40%; height:100%; background: linear-gradient(90deg,transparent,rgba(255,255,255,.2),transparent); transform: translateX(-100%); }
        .prof-stat-pill:hover::after { animation: prof-shimmer 1.2s ease forwards; }
        .prof-mini { transition: transform .25s ease; cursor: default; }
        .prof-mini:hover { transform: translateY(-2px); }
        .prof-mini:hover .prof-mini-dot { animation: prof-bounce-soft .6s ease; }
        .prof-fade-1 { animation: prof-fade-up .6s .05s ease both; }
        .prof-fade-2 { animation: prof-fade-up .6s .15s ease both; }
        .prof-fade-3 { animation: prof-fade-up .6s .25s ease both; }
        .prof-counter { display: inline-block; }

        /* ══ FONTS ══ */
        .wlt-page {
            font-family: 'Inter', sans-serif;
        }

        .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .font-mono-num {
            font-family: 'JetBrains Mono', monospace !important;
        }

        /* WAJIB: Mencegah font teks menimpa font ikon */
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined' !important;
            font-weight: normal;
            font-style: normal;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }

        /* ══ ANIMATIONS ══ */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .wlt-floating {
            animation: float 4s ease-in-out infinite;
        }

        .wlt-floating-delayed {
            animation: float 5s ease-in-out infinite 2s;
        }

        /* ══ SIDEBAR OVERRIDES — now centralized in filament-sidebar.css ══ */

        /* ══ TOPBAR & PAGE — now centralized in filament-sidebar.css ══ */

        [x-cloak] {
            display: none !important;
        }

        /* ══ SEGMENTED TABS (E-WALLET VS BANK) ══ */
        .wlt-tabs-container {
            display: flex;
            background: #f1f5f9;
            border-radius: 1rem;
            padding: 0.35rem;
            gap: 0.35rem;
            margin-bottom: 1.5rem;
        }

        .wlt-tab {
            flex: 1;
            text-align: center;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 0.75rem;
            cursor: pointer;
            color: #64748b;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .wlt-tab:hover:not(.active) {
            color: #334155;
        }

        .wlt-tab.active {
            background: #ffffff;
            color: #0ea5e9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        /* ══ METHOD CARD ══ */
        .wlt-method {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.25rem 1rem;
            border-radius: 1rem;
            cursor: pointer;
            border: 2px solid #e2e8f0;
            background: #ffffff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            gap: 10px;
        }

        .wlt-method:hover {
            border-color: rgba(14, 165, 233, 0.4);
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.05);
        }

        .wlt-method.active {
            border-color: #0ea5e9;
            background: #f0f9ff;
            box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.1);
            transform: translateY(-2px);
        }

        .wlt-method-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            padding: 4px;
        }

        .wlt-method:hover .wlt-method-icon {
            transform: scale(1.1);
        }

        .wlt-method-icon span {
            font-size: 1.8rem;
        }

        .wlt-method-check {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #0ea5e9;
            font-size: 1.2rem;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
        }

        .wlt-method.active .wlt-method-check {
            opacity: 1;
            transform: scale(1) rotate(360deg);
        }

        /* ══ DENOM CARD ══ */
        .wlt-denom {
            padding: 1.25rem;
            border-radius: 1rem;
            cursor: pointer;
            border: 2px solid #e2e8f0;
            background: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
        }

        .wlt-denom:hover {
            border-color: rgba(14, 165, 233, 0.4);
            transform: translateY(-2px);
        }

        .wlt-denom.active {
            border-color: #0ea5e9;
            background: #f0f9ff;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
            transform: translateY(-2px);
        }

        .wlt-denom-check {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #fff;
            border-radius: 50%;
            color: #0ea5e9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            opacity: 0;
            transform: scale(0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .wlt-denom.active .wlt-denom-check {
            opacity: 1;
            transform: scale(1);
        }

        /* ══ BUTTONS ══ */
        .wlt-btn-submit {
            width: 100%;
            padding: 16px 24px;
            border-radius: 1rem;
            font-size: 1.05rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 16px rgba(14, 165, 233, 0.3);
            transition: all 0.3s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .wlt-btn-submit::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.5s ease;
        }

        .wlt-btn-submit:hover::after {
            left: 100%;
        }

        .wlt-btn-submit:hover {
            box-shadow: 0 6px 24px rgba(14, 165, 233, 0.45);
            transform: translateY(-2px);
        }

        .wlt-btn-submit:active {
            transform: translateY(0);
        }

        .wlt-btn-submit:disabled {
            background: #cbd5e1 !important;
            box-shadow: none !important;
            cursor: not-allowed;
            color: #64748b;
            transform: none;
        }

        /* ══ HISTORY FILTERS & TABLE ══ */
        .wlt-filter-ctrl {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.65rem 1rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: #475569;
            outline: none;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .wlt-filter-ctrl:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        .wlt-search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.2rem;
            pointer-events: none;
        }

        .wlt-btn-reset {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.65rem 1rem;
            transition: all 0.2s;
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
        }

        .wlt-btn-reset:hover {
            background: #e2e8f0;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        .wlt-btn-reset:active {
            transform: scale(0.95);
        }

        .wlt-history-row {
            display: flex;
            align-items: center;
            gap: 0.75rem; /* Gap diperkecil untuk mobile */
            padding: 1rem 0.75rem; /* Padding diperkecil untuk mobile */
            border-bottom: 1px solid #f1f5f9;
            border-left: 3px solid transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (min-width: 640px) {
            .wlt-history-row {
                gap: 1rem;
                padding: 1rem 1.25rem;
            }
        }

        .wlt-history-row:hover {
            background: #f8fafc;
            border-left: 3px solid #0ea5e9;
            transform: translateX(4px);
        }

        .wlt-history-row:last-child {
            border-bottom: none;
        }

        /* ══ STATUS BADGE ══ */
        .wlt-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
            font-family: 'Inter', sans-serif;
        }

        .wlt-badge-pending {
            background: #fef9c3;
            color: #a16207;
        }

        .wlt-badge-success {
            background: #dcfce7;
            color: #15803d;
        }

        .wlt-badge-rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        .wlt-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .wlt-dot-pending {
            background: #eab308;
        }

        .wlt-dot-success {
            background: #22c55e;
        }

        .wlt-dot-rejected {
            background: #ef4444;
        }

        /* ══ WARNING BOX ══ */
        .wlt-warning {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            border-radius: 12px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ══ INPUT ══ */
        .wlt-input-group {
            position: relative;
        }

        .wlt-input-icon {
            position: absolute;
            inset-y: 0;
            left: 0;
            padding-left: 1rem;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .wlt-input {
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 1rem;
            background: #ffffff;
            color: #0f172a;
            font-size: 1rem;
            font-weight: 500;
            outline: none;
            transition: all 0.3s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .wlt-input:focus {
            border-color: #0ea5e9;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
            transform: translateY(-1px);
        }

        .wlt-input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .wlt-step-badge {
            background: #eff6ff;
            color: #2563eb;
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 8px;
        }
    </style>
    @endpush

    {{-- Data Dummy Provider --}}
    @php
    $ewallets = [
    'gopay' => ['label' => 'GoPay', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Gopay_logo.svg'],
    'dana' => ['label' => 'DANA', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Logo_dana_blue.svg'],
    'shopeepay' => ['label' => 'ShopeePay', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Shopee.svg'],
    'ovo' => ['label' => 'OVO', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Logo_ovo_purple.svg'],
    ];
    $banks = [
    'bca' => ['label' => 'BCA', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Central_Asia.svg'],
    'mandiri' => ['label' => 'Mandiri', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Mandiri_logo_2016.svg'],
    'bni' => ['label' => 'BNI', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Negara_Indonesia_logo_(2004).svg'],
    'bri' => ['label' => 'BRI', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/BRI_2020.svg'],
    'bsi' => ['label' => 'BSI', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Syariah_Indonesia.svg'],
    ];
    @endphp

    <div class="wlt-page" x-data="walletPage()">
        <div class="px-4 sm:px-6 py-6 max-w-3xl mx-auto">

            {{-- ══ HERO — USER PROFILE CARD STYLE ══ --}}
            @php
              $user = Auth::user();
              $balance = $user->userBalance;
              $badgeCount = $balance?->badge ?? 0;
              $totalMisi = \App\Models\MisiAnggota::where('id_user', $user->id)->count();
              $misiSelesai = \App\Models\MisiAnggota::where('id_user', $user->id)
                  ->whereHas('misi', fn($q) => $q->where('status', 'selesai'))
                  ->count();
              $memberSince = $user->created_at->format('M Y');
              $points = $balance?->point ?? 0;

              if ($badgeCount <= 5) {
                  $tierName = 'Tester Beginner';
              } elseif ($badgeCount <= 50) {
                  $tierName = 'Tester Intermediate';
              } else {
                  $tierName = 'Tester Master';
              }
            @endphp
            {{-- ══ HERO — SALDO POIN ══ --}}
            <div class="prof-hero prof-fade-1 w-full rounded-3xl p-6 sm:p-8 mb-8 relative overflow-hidden">
                {{-- Aurora mesh gradient --}}
                <div class="prof-aurora"></div>

                {{-- Rotating conic glows --}}
                <div class="prof-conic"></div>
                <div class="prof-conic-2"></div>

                {{-- Grid texture --}}
                <div class="absolute inset-0 prof-grid-bg pointer-events-none"></div>

                {{-- Scanline sweep --}}
                <div class="prof-scan"></div>

                {{-- Twinkling stars --}}
                <div class="prof-stars">
                    @for($i=0;$i<18;$i++)
                        <span style="top:{{ rand(2,90) }}%; left:{{ rand(2,98) }}%; animation-delay:-{{ ($i*0.23) }}s;"></span>
                    @endfor
                </div>

                {{-- Floating particles --}}
                <div class="prof-particles">
                    @for($i=0;$i<14;$i++)
                        @php $dur = rand(7,14); $delay = $i * 0.7; $left = rand(2,98); $size = rand(3,7); $drift = rand(-40,40); @endphp
                        <span style="left:{{ $left }}%; width:{{ $size }}px; height:{{ $size }}px; animation-duration:{{ $dur }}s; animation-delay:{{ $delay }}s; --drift:{{ $drift }}px;"></span>
                    @endfor
                </div>

                {{-- Shooting stars --}}
                <div class="prof-shoot"></div>
                <div class="prof-shoot s2"></div>

                {{-- Floating decorative blobs --}}
                <div class="prof-blob absolute -right-12 -top-12 w-48 h-48 rounded-full opacity-20"
                     style="background:radial-gradient(circle,#60a5fa,transparent 70%);"></div>
                <div class="prof-blob-rev absolute right-20 -bottom-16 w-40 h-40 rounded-full opacity-15"
                     style="background:radial-gradient(circle,#a78bfa,transparent 70%);"></div>
                <div class="prof-blob absolute right-1/3 top-4 w-20 h-20 rounded-full opacity-10"
                     style="background:radial-gradient(circle,#ffffff,transparent 70%);animation-delay:-3s;"></div>

                {{-- Konten utama --}}
                <div class="relative z-10 text-center py-6">
                    <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#e0f2fe;letter-spacing:0.12em;">{{ __('SALDO POIN ANDA') }}</p>
                    <div class="flex items-baseline justify-center gap-2 mb-3">
                        <span class="font-mono-num font-bold text-white prof-counter" style="font-size:48px;line-height:1;" data-target="{{ $totalPoin ?? 0 }}">{{ number_format($totalPoin ?? 0, 0, ',', '.') }}</span>
                        <span class="text-xl font-semibold" style="color:#bae6fd;opacity:0.85;">pts</span>
                    </div>
                    <p class="text-sm font-medium" style="color:#bae6fd;">{{ __('Setara dengan') }} <span class="font-bold text-white">{{ $estimasiRupiah ?? 'Rp 0' }}</span></p>
                </div>

                {{-- Animated waves --}}
                <div class="prof-waves">
                    <svg viewBox="0 0 2400 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0,40 C150,80 350,0 600,40 C850,80 1050,0 1200,40 C1350,80 1550,0 1800,40 C2050,80 2250,0 2400,40 L2400,80 L0,80 Z" fill="rgba(255,255,255,0.18)"/>
                    </svg>
                </div>
                <div class="prof-waves w2">
                    <svg viewBox="0 0 2400 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0,50 C200,20 400,70 600,50 C800,30 1000,70 1200,50 C1400,20 1600,70 1800,50 C2000,30 2200,70 2400,50 L2400,80 L0,80 Z" fill="rgba(147,197,253,0.22)"/>
                    </svg>
                </div>
            </div>

            {{-- ══ FORM WITHDRAWAL ══ --}}
            <div class="space-y-10">

                {{-- 1. Metode Pembayaran --}}
                <section>
                    <h3 class="font-heading text-lg font-bold mb-4" style="color:#1e293b;">
                        <span class="wlt-step-badge">1</span> {{ __('Pilih Metode Penarikan') }}
                    </h3>

                    {{-- TABS CATEGORY --}}
                    <div class="wlt-tabs-container">
                        <div class="wlt-tab" :class="{ 'active': category === 'ewallet' }" @click="category = 'ewallet'; $wire.selectedMethod = null;">
                            <span class="material-symbols-outlined" style="font-size: 1.2rem; transition: transform 0.3s;" :style="category === 'ewallet' && 'transform: scale(1.1);'">account_balance_wallet</span> {{ __('E-Wallet') }}
                        </div>
                        <div class="wlt-tab" :class="{ 'active': category === 'bank' }" @click="category = 'bank'; $wire.selectedMethod = null;">
                            <span class="material-symbols-outlined" style="font-size: 1.2rem; transition: transform 0.3s;" :style="category === 'bank' && 'transform: scale(1.1);'">account_balance</span> {{ __('Transfer Bank') }}
                        </div>
                    </div>

                    {{-- E-WALLET GRID --}}
                    <div x-show="category === 'ewallet'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @foreach($ewallets as $key => $data)
                            <div class="wlt-method" :class="{ 'active': $wire.selectedMethod === '{{ $key }}' }" wire:click="$set('selectedMethod', '{{ $key }}')">
                                <span class="wlt-method-check material-symbols-outlined">check_circle</span>
                                <div class="wlt-method-icon">
                                    <img src="{{ $data['img'] }}" alt="{{ $data['label'] }}" class="w-full h-full object-contain" />
                                </div>
                                <p class="text-sm font-bold font-heading" style="color:#1e293b;">{{ $data['label'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- BANK GRID --}}
                    <div x-show="category === 'bank'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                            @foreach($banks as $key => $data)
                            <div class="wlt-method" :class="{ 'active': $wire.selectedMethod === '{{ $key }}' }" wire:click="$set('selectedMethod', '{{ $key }}')">
                                <span class="wlt-method-check material-symbols-outlined">check_circle</span>
                                <div class="wlt-method-icon">
                                    <img src="{{ $data['img'] }}" alt="{{ $data['label'] }}" class="w-full h-full object-contain" />
                                </div>
                                <p class="text-sm font-bold font-heading" style="color:#1e293b;">{{ $data['label'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- 2. Pilih Nominal --}}
                <section x-show="$wire.selectedMethod" x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                    <h3 class="font-heading text-lg font-bold mb-4" style="color:#1e293b;">
                        <span class="wlt-step-badge">2</span> {{ __('Pilih Nominal Saldo') }}
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if(isset($denominations))
                        @foreach($denominations as $idx => $d)
                        <div class="wlt-denom" :class="{ 'active': $wire.selectedDenom === {{ $idx }} }" wire:click="$set('selectedDenom', {{ $idx }})">
                            <span class="text-xl font-bold font-heading" style="color:#0f172a;">{{ $d['rupiahF'] }}</span>
                            <span class="text-xs font-semibold font-mono-num px-3 py-1.5 rounded-lg transition-colors" :style="$wire.selectedDenom === {{ $idx }} ? 'background:#e0f2fe; color:#0284c7; border-color:#bae6fd;' : 'background:#f1f5f9; color:#475569; border: 1px solid #e2e8f0;'">
                                {{ __('Biaya') }}: {{ $d['pointLabel'] }}
                            </span>
                            <span class="wlt-denom-check material-symbols-outlined">check_circle</span>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </section>

                {{-- 3. Nomor Akun --}}
                <section x-show="$wire.selectedMethod && $wire.selectedDenom !== null" x-transition:enter="transition ease-out duration-400 delay-75" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                    <h3 class="font-heading text-lg font-bold mb-4" style="color:#1e293b;">
                        <span class="wlt-step-badge">3</span> <span x-text="category === 'ewallet' ? '{{ __('Nomor HP (E-Wallet)') }}' : '{{ __('Nomor Rekening Bank') }}'">Nomor Akun</span>
                    </h3>
                    <div class="wlt-input-group">
                        <div class="wlt-input-icon">
                            <span class="material-symbols-outlined text-slate-400" style="font-size: 1.4rem;" x-text="category === 'ewallet' ? 'phone_iphone' : 'credit_card'"></span>
                        </div>
                        <input type="text"
                            class="wlt-input font-mono-num"
                            :placeholder="category === 'ewallet' ? '{{ __('Contoh: 081234567890') }}' : '{{ __('Masukkan nomor rekening Anda') }}'"
                            wire:model="nomorAkun">
                    </div>
                </section>

                {{-- Warning + Submit --}}
                <div x-show="$wire.selectedMethod && $wire.selectedDenom !== null" class="space-y-6 pt-4" style="border-top:1px dashed #cbd5e1; display: none;" x-transition:enter="transition ease-out duration-500 delay-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <div class="wlt-warning">
                        <span class="material-symbols-outlined" style="color:#2563eb; font-size:1.5rem; margin-top:2px;">info</span>
                        <div>
                            <p class="text-sm font-bold font-heading text-blue-900 mb-1">{{ __('Informasi Penarikan') }}</p>
                            <p class="text-sm font-medium" style="color:#1e3a8a; line-height:1.5; opacity: 0.85;">
                                {{ __('Proses withdrawal membutuhkan waktu maksimal :hours jam kerja. Pastikan nomor yang dimasukkan sudah benar karena transaksi tidak dapat dibatalkan.', ['hours' => '<strong>24</strong>']) }}
                            </p>
                        </div>
                    </div>

                    <button class="wlt-btn-submit group"
                        wire:click="submitWithdraw"
                        wire:loading.attr="disabled"
                        wire:target="submitWithdraw">
                        <span wire:loading.remove wire:target="submitWithdraw">{{ __('Tarik Saldo Sekarang') }}</span>
                        <span wire:loading wire:target="submitWithdraw">{{ __('Memproses Transaksi...') }}</span>
                        <span class="material-symbols-outlined transition-transform group-hover:translate-x-1" style="font-size:1.4rem;" wire:loading.remove wire:target="submitWithdraw">arrow_forward</span>
                    </button>
                </div>
            </div>

            {{-- ══ RIWAYAT WITHDRAWAL (WITH FILTER & PAGINATION) ══ --}}
            <div class="mt-16" x-data="{
            search: '',
            perPage: '5',
            filterStatus: 'all',
            filterMethod: 'all',
            get filteredHistory() {
                let result = this.$wire.riwayat || [];

                // Status Filter
                if (this.filterStatus !== 'all') {
                    result = result.filter(r => r.status === this.filterStatus);
                }

                // Method Filter
                if (this.filterMethod !== 'all') {
                    result = result.filter(r => r.metode && r.metode.toLowerCase() === this.filterMethod.toLowerCase());
                }

                // Search Filter
                if (this.search.trim() !== '') {
                    const q = this.search.toLowerCase();
                    result = result.filter(r => 
                        (r.rupiahF && r.rupiahF.toLowerCase().includes(q)) || 
                        (r.nomorAkun && r.nomorAkun.toLowerCase().includes(q)) || 
                        (r.metode && r.metode.toLowerCase().includes(q))
                    );
                }

                // Pagination / Limit
                if (this.perPage !== 'all') {
                    result = result.slice(0, parseInt(this.perPage));
                }

                return result;
            },
            get uniqueMethods() {
                // Mendapatkan list unik metode untuk dropdown
                const history = this.$wire.riwayat || [];
                const methods = history.map(r => r.metode).filter(m => m);
                return [...new Set(methods)];
            }
        }">

                {{-- Header --}}
                <div class="mb-4">
                    <h2 class="text-xl font-bold font-heading" style="color:#1e293b;">{{ __('Riwayat Penarikan') }}</h2>
                    <p class="text-sm mt-1" style="color:#64748b;">{{ __('Menampilkan riwayat transaksi penarikan saldo') }}</p>
                </div>

                {{-- Toolbar Control (Search, Filters, Reset) --}}
                <div class="flex flex-col gap-3 mb-6">

                    {{-- Search Box (Full Width) --}}
                    <div class="relative w-full">
                        <span class="material-symbols-outlined wlt-search-icon">search</span>
                        <input type="text" x-model="search" placeholder="{{ __('Cari nominal, nomor tujuan, atau metode...') }}"
                            class="wlt-filter-ctrl w-full" style="padding-left:2.5rem;">
                    </div>

                    {{-- Filters & Reset Button --}}
                    <div class="flex flex-wrap gap-2">
                        <select x-model="filterStatus" class="wlt-filter-ctrl flex-1 sm:flex-none">
                            <option value="all">{{ __('Semua Status') }}</option>
                            <option value="success">{{ __('Berhasil') }}</option>
                            <option value="pending">{{ __('Pending') }}</option>
                            <option value="rejected">{{ __('Ditolak') }}</option>
                        </select>

                        <select x-model="filterMethod" class="wlt-filter-ctrl flex-1 sm:flex-none">
                            <option value="all">{{ __('Semua Metode') }}</option>
                            <template x-for="m in uniqueMethods" :key="m">
                                <option :value="m" x-text="m.toUpperCase()"></option>
                            </template>
                        </select>

                        <select x-model="perPage" class="wlt-filter-ctrl flex-1 sm:flex-none">
                            <option value="5">{{ __('5 Data') }}</option>
                            <option value="10">{{ __('10 Data') }}</option>
                            <option value="20">{{ __('20 Data') }}</option>
                            <option value="all">{{ __('Semua Data') }}</option>
                        </select>

                        <button @click="search = ''; filterStatus = 'all'; filterMethod = 'all'; perPage = '5'"
                            wire:click="loadRiwayat"
                            wire:loading.attr="disabled"
                            wire:target="loadRiwayat"
                            class="wlt-btn-reset flex-1 sm:flex-none" title="{{ __('Refresh data') }}">
                            <span class="material-symbols-outlined" wire:loading.class="animate-spin" wire:target="loadRiwayat" style="font-size: 1.1rem;">refresh</span> {{ __('Refresh') }}
                        </button>
                    </div>
                </div>

                {{-- Table List --}}
                <div class="bg-white rounded-2xl shadow-sm" style="border: 1px solid #e2e8f0; overflow: hidden; min-height: 100px;">

                    {{-- Data Render --}}
                    <template x-for="r in filteredHistory" :key="r.id">
                        <div class="wlt-history-row cursor-pointer group" @click="$wire.showInvoice(r.id)">

                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110"
                                :style="r.status === 'success' ? 'background:#dcfce7;' : (r.status === 'pending' ? 'background:#fefce8;' : 'background:#fee2e2;')">
                                <span class="material-symbols-outlined" style="font-size: 1.3rem;"
                                    :style="r.status === 'success' ? 'color:#16a34a;' : (r.status === 'pending' ? 'color:#d97706;' : 'color:#dc2626;')"
                                    x-text="r.status === 'success' ? 'check_circle' : (r.status === 'pending' ? 'schedule' : 'cancel')">
                                </span>
                            </div>

                            <div class="flex-1 min-w-0 ml-1 sm:ml-2">
                                <div class="flex flex-wrap items-center gap-1.5 sm:gap-3 mb-1 sm:mb-1.5">
                                    <p class="text-sm sm:text-base font-bold font-heading" style="color:#0f172a;" x-text="r.rupiahF"></p>
                                    <span :class="'wlt-badge wlt-badge-' + r.status">
                                        <span :class="'wlt-dot wlt-dot-' + r.status"></span>
                                        <span x-text="r.status.charAt(0).toUpperCase() + r.status.slice(1)"></span>
                                    </span>
                                </div>
                                <p class="text-xs sm:text-sm font-medium leading-tight" style="color:#64748b;">
                                    <span class="uppercase font-bold text-slate-700" x-text="r.metode"></span> • <span x-text="r.nomorAkun"></span>
                                </p>
                            </div>

                            <div class="text-right flex-shrink-0 flex items-center gap-2 sm:gap-3">
                                <div>
                                    <p class="text-xs sm:text-sm font-bold font-mono-num mb-0.5 sm:mb-1" style="color:#ef4444;" x-text="'-' + Number(r.point).toLocaleString('id-ID') + ' pts'"></p>
                                    <p class="text-[10px] sm:text-xs font-medium" style="color:#94a3b8;" x-text="r.tanggal"></p>
                                </div>
                                <span class="material-symbols-outlined transition-transform group-hover:translate-x-1 hidden sm:block" style="color:#0ea5e9; font-size:1.2rem;">arrow_forward</span>
                            </div>

                        </div>
                    </template>

                    {{-- Empty State (Jika hasil filter kosong) --}}
                    <div x-show="filteredHistory.length === 0" x-cloak class="p-10 text-center flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-slate-300" style="font-size: 3rem; margin-bottom: 10px;">search_off</span>
                        <p class="text-slate-500 font-medium text-sm">{{ __('Tidak ada transaksi yang cocok dengan filter pencarian.') }}</p>
                    </div>

                </div>
            </div>

        </div>

        {{-- ══ INVOICE DETAIL DRAWER (RIGHT SIDE FIX) ══ --}}
        @if($invoiceDetail)
        <template x-teleport="body">
            <div class="wlt-modal-overlay" x-data="{ open: true }"
                x-show="open" x-cloak
                @keydown.window.escape="open = false; setTimeout(() => $wire.closeInvoice(), 300)"
                style="position:fixed; inset:0; z-index:99999;">

                {{-- Dark Overlay --}}
                <div style="position:absolute; inset:0; background:rgba(15, 23, 42, 0.4); backdrop-filter: blur(2px);"
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click="open = false; setTimeout(() => $wire.closeInvoice(), 300)">
                </div>

                {{-- Sliding Drawer Content --}}
                <div class="wlt-modal-content"
                    x-show="open"
                    x-transition:enter="transform transition ease-out duration-300 sm:duration-400"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in duration-300"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    style="background:#fff; width:100%; max-width:420px; height:100vh; overflow-y:auto; position:absolute; right:0; top:0; z-index:100; box-shadow:-10px 0 30px rgba(0,0,0,0.1); display:flex; flex-direction:column;">

                    {{-- Header --}}
                    <div style="padding:24px; display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #f1f5f9; background:#f8fafc;">
                        <h3 class="font-heading" style="font-size:1.1rem; font-weight:800; color:#0f172a; margin:0;">
                            <span class="material-symbols-outlined" style="font-size:1.2rem; vertical-align:middle; margin-right:6px; color:#2563eb;">receipt_long</span>
                            {{ __('Detail Transaksi') }}
                        </h3>
                        <button @click="open = false; setTimeout(() => $wire.closeInvoice(), 300)" style="background:#e2e8f0; border-radius:50%; border:none; cursor:pointer; width:32px; height:32px; display:flex; align-items:center; justify-content:center; transition:background 0.2s;">
                            <span class="material-symbols-outlined" style="color:#475569;font-size:1.2rem;">close</span>
                        </button>
                    </div>

                    <div style="padding:24px; flex-grow:1;">
                        <p style="color:#64748b; font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px;">{{ __('ID Invoice') }} #{{ $invoiceDetail['id'] }}</p>

                        {{-- Nominal Besar --}}
                        <div style="margin-bottom:24px;">
                            <h2 class="font-heading" style="font-size:2rem; font-weight:800; color:#0f172a; line-height:1; margin:0;">{{ $invoiceDetail['rupiahF'] }}</h2>
                            <p class="font-mono-num" style="color:#ef4444; font-weight:700; margin-top:6px; margin-bottom:0;">-{{ number_format($invoiceDetail['point']) }} pts</p>
                        </div>

                        {{-- Status Banner --}}
                        <div style="margin-bottom:24px; padding:12px 16px; border-radius:12px;
                         background:{{ $invoiceDetail['status'] === 'success' ? '#dcfce7' : ($invoiceDetail['status'] === 'pending' ? '#fef9c3' : '#fee2e2') }};">
                            <div style="display:flex;align-items:center;gap:8px;">
                                <span class="material-symbols-outlined" style="font-size:1.3rem;color:{{ $invoiceDetail['status'] === 'success' ? '#16a34a' : ($invoiceDetail['status'] === 'pending' ? '#d97706' : '#dc2626') }};">
                                    {{ $invoiceDetail['status'] === 'success' ? 'check_circle' : ($invoiceDetail['status'] === 'pending' ? 'schedule' : 'cancel') }}
                                </span>
                                <span class="font-heading" style="font-weight:700;font-size:.9rem;color:{{ $invoiceDetail['status'] === 'success' ? '#15803d' : ($invoiceDetail['status'] === 'pending' ? '#a16207' : '#b91c1c') }};">
                                    {{ $invoiceDetail['status'] === 'success' ? __('Withdrawal Berhasil') : ($invoiceDetail['status'] === 'pending' ? __('Menunggu Proses') : __('Withdrawal Ditolak')) }}
                                </span>
                            </div>
                        </div>

                        @if($invoiceDetail['status'] === 'pending' && $invoiceDetail['xendit_payout_id'])
                        <div style="margin-bottom: 24px;">
                            <button wire:click="syncStatus({{ $invoiceDetail['id'] }})"
                                    wire:loading.attr="disabled"
                                    style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; background: #ffffff; color: #0ea5e9; font-weight: 700; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);"
                                    onmouseover="this.style.borderColor='#0ea5e9'; this.style.background='#f0f9ff'; this.style.transform='translateY(-1px)';"
                                    onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#ffffff'; this.style.transform='none';">
                                <span class="material-symbols-outlined animate-spin" wire:loading wire:target="syncStatus" style="font-size: 1.2rem;">sync</span>
                                <span class="material-symbols-outlined" wire:loading.remove wire:target="syncStatus" style="font-size: 1.2rem;">sync</span>
                                <span wire:loading.remove wire:target="syncStatus">{{ __('Sync Status Transaksi') }}</span>
                                <span wire:loading wire:target="syncStatus">{{ __('Sinkronisasi...') }}</span>
                            </button>
                        </div>
                        @endif

                        {{-- Detail Info --}}
                        <div style="display:flex;flex-direction:column;gap:16px;">
                            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px dashed #e2e8f0;">
                                <span style="color:#64748b;font-size:.85rem;font-weight:500;">{{ __('Metode Penarikan') }}</span>
                                <span style="font-weight:700;font-size:.85rem;color:#0f172a; text-transform:uppercase;">{{ $invoiceDetail['metode'] }}</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px dashed #e2e8f0;">
                                <span style="color:#64748b;font-size:.85rem;font-weight:500;">{{ __('Nomor Tujuan') }}</span>
                                <span class="font-mono-num" style="font-weight:700;font-size:.9rem;color:#0ea5e9;">{{ $invoiceDetail['nomorAkun'] }}</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px dashed #e2e8f0;">
                                <span style="color:#64748b;font-size:.85rem;font-weight:500;">{{ __('Waktu Pengajuan') }}</span>
                                <div style="text-align:right;">
                                    <span style="font-weight:600;font-size:.85rem;color:#334155; display:block;">{{ $invoiceDetail['tanggal'] }}</span>
                                    <span style="font-weight:500;font-size:.75rem;color:#94a3b8;">{{ $invoiceDetail['waktu'] }}</span>
                                </div>
                            </div>
                            @if($invoiceDetail['status'] !== 'pending')
                            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px dashed #e2e8f0;">
                                <span style="color:#64748b;font-size:.85rem;font-weight:500;">{{ __('Diproses oleh') }}</span>
                                <span style="font-weight:600;font-size:.85rem;color:#334155;">{{ $invoiceDetail['adminNama'] }}</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px dashed #e2e8f0;">
                                <span style="color:#64748b;font-size:.85rem;font-weight:500;">{{ __('Waktu Selesai') }}</span>
                                <span style="font-weight:600;font-size:.85rem;color:#334155;">{{ $invoiceDetail['updatedAt'] }}</span>
                            </div>
                            @endif
                        </div>

                        @if($invoiceDetail['catatan'])
                        <div style="margin-top:20px; padding:16px; background:#f8fafc; border-radius:12px; border:1px solid #e2e8f0;">
                            <span style="color:#64748b;font-size:.8rem;font-weight:700;display:block;margin-bottom:6px;text-transform:uppercase;">{{ __('Catatan Admin') }}</span>
                            <span style="font-weight:500;font-size:.9rem;color:#334155;line-height:1.5;">{{ $invoiceDetail['catatan'] }}</span>
                        </div>
                        @endif

                        {{-- Bukti Transfer dari Admin --}}
                        @if($invoiceDetail['image'])
                        <div style="margin-top:24px;">
                            <p class="font-heading" style="font-weight:700;font-size:.9rem;color:#0f172a;margin-bottom:12px;">
                                <span class="material-symbols-outlined" style="font-size:1.1rem;vertical-align:middle;margin-right:4px;color:#16a34a;">verified</span>
                                {{ __('Bukti Transfer') }}
                            </p>
                            <div style="border-radius:16px; overflow:hidden; border:2px solid #e2e8f0; box-shadow:0 4px 6px rgba(0,0,0,0.05);">
                                <img src="{{ $invoiceDetail['image'] }}" alt="Bukti Transfer" style="width:100%;display:block;transition:transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Footer Action --}}
                    <div style="padding:24px; border-top:1px solid #f1f5f9; background:#fff; position:sticky; bottom:0;">
                        <button @click="open = false; setTimeout(() => $wire.closeInvoice(), 300)"
                            class="wlt-btn-submit" style="box-shadow:none; padding:14px;">
                            {{ __('Selesai') }}
                        </button>
                    </div>
                </div>
            </div>
        </template>
        @endif

    </div>

    @push('scripts')
    <script>
        function walletPage() {
            return {
                category: 'ewallet',
            };
        }

        // Animated count-up for all .prof-counter on load
        (function(){
            const animate = (el) => {
                const target = parseInt(el.dataset.target || '0', 10);
                if (!target) { el.textContent = '0'; return; }
                const dur = 1200;
                const start = performance.now();
                const tick = (now) => {
                    const p = Math.min((now - start) / dur, 1);
                    const eased = 1 - Math.pow(1 - p, 3);
                    el.textContent = Math.floor(eased * target).toLocaleString('id-ID');
                    if (p < 1) requestAnimationFrame(tick);
                    else el.textContent = target.toLocaleString('id-ID');
                };
                requestAnimationFrame(tick);
            };
            const run = () => document.querySelectorAll('.prof-counter').forEach(animate);
            if (document.readyState !== 'loading') run(); else document.addEventListener('DOMContentLoaded', run);
            // Re-run after Livewire updates
            document.addEventListener('livewire:navigated', run);
            if (window.Livewire) window.Livewire.hook('message.processed', run);
        })();
    </script>
    @endpush

</x-filament-panels::page>