{{-- ══════════════════════════════════════════════════════════════
     UPLOAD MISI — Midnight Aurora Theme
     • Glassmorphism panel with animated aurora header
     • Animated dropzone with floating cloud icon
     • Gradient guideline cards & shimmer accents
     • Matches package-selection / payment-summary styling
     
     USAGE (Filament custom form component):
       View::make('filament.developer.components.upload-misi')
     The actual FileUpload field is rendered through
     {{ $getChildComponentContainer() }} so all validation,
     preview, and upload logic from Filament stays intact.
   ══════════════════════════════════════════════════════════════ --}}

<style>
    @keyframes um-float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50%      { transform: translateY(-8px) rotate(-3deg); }
    }
    @keyframes um-pulse-ring {
        0%   { box-shadow: 0 0 0 0 rgba(99,102,241,.45); }
        70%  { box-shadow: 0 0 0 18px rgba(99,102,241,0); }
        100% { box-shadow: 0 0 0 0 rgba(99,102,241,0); }
    }
    @keyframes um-shimmer {
        0%   { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    @keyframes um-border-shift {
        0%, 100% { background-position: 0% 50%; }
        50%      { background-position: 100% 50%; }
    }
    @keyframes um-fade-up {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ====== Profile Theme CSS ====== */
    @keyframes prof-gradient    { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
    @keyframes prof-aurora {
        0%   { transform: translate(-10%,-10%) rotate(0deg)   scale(1.1); }
        33%  { transform: translate(8%,-6%)   rotate(120deg) scale(1.25); }
        66%  { transform: translate(-6%,10%)  rotate(240deg) scale(1.15); }
        100% { transform: translate(-10%,-10%) rotate(360deg) scale(1.1); }
    }
    @keyframes prof-conic { to { transform: rotate(360deg); } }
    @keyframes prof-spin-rev { from{transform:rotate(360deg)} to{transform:rotate(0)} }
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
    .prof-conic {
        position:absolute; width:520px; height:520px; left:-160px; bottom:-200px;
        background: conic-gradient(from 0deg, rgba(59,130,246,0), rgba(96,165,250,.35), rgba(167,139,250,.25), rgba(34,211,238,.30), rgba(59,130,246,0));
        border-radius:50%; filter: blur(30px); animation: prof-conic 28s linear infinite;
        opacity:.7; pointer-events:none;
    }
    .prof-conic-2 {
        position:absolute; width:380px; height:380px; right:-120px; top:-140px;
        background: conic-gradient(from 180deg, rgba(244,114,182,0), rgba(244,114,182,.30), rgba(96,165,250,.30), rgba(244,114,182,0));
        border-radius:50%; filter: blur(30px); animation: prof-spin-rev 34s linear infinite;
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
    .prof-particles { position:absolute; inset:0; overflow:hidden; pointer-events:none; }
    .prof-particles span {
        position:absolute; bottom:-10px; width:6px; height:6px; border-radius:50%;
        background: radial-gradient(circle, #fff 0%, rgba(255,255,255,.2) 60%, transparent 70%);
        box-shadow: 0 0 12px rgba(255,255,255,.7);
        animation: prof-particle linear infinite; opacity:0;
    }
    .prof-stars { position:absolute; inset:0; pointer-events:none; }
    .prof-stars span {
        position:absolute; width:2px; height:2px; border-radius:50%;
        background:#fff !important; box-shadow:0 0 6px #fff, 0 0 12px #fff !important;
        animation: prof-twinkle 3s ease-in-out infinite;
    }
    .prof-shoot {
        position:absolute; top:18%; left:-20%; width:120px; height:2px;
        background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,.9));
        filter: drop-shadow(0 0 6px rgba(147,197,253,.9)); border-radius:2px;
        animation: prof-shoot 7s ease-in infinite; animation-delay: -2s;
        pointer-events:none; opacity: 0;
    }
    .prof-shoot.s2 { top:55%; animation-duration: 9s; animation-delay: -5s; opacity: 0; }
    .prof-scan {
        position:absolute; left:0; right:0; top:0; height:25%;
        background: linear-gradient(180deg, transparent, rgba(147,197,253,.18), transparent);
        animation: prof-scan 9s ease-in-out infinite; pointer-events:none;
    }
    @media (prefers-reduced-motion: reduce) {
        .prof-hero, .prof-aurora, .prof-conic, .prof-conic-2, .prof-grid-bg,
        .prof-particles span, .prof-shoot, .prof-scan, .prof-stars span { animation: none !important; }
    }
    /* ================================= */

    .um-panel {
        position: relative;
        background: linear-gradient(180deg, rgba(255,255,255,.88), rgba(255,255,255,.72));
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 1.5rem;
        overflow: hidden;
    }
    .dark .um-panel {
        background: linear-gradient(180deg, rgba(30,27,75,.55), rgba(15,23,42,.7));
    }

    /* Animated linear border */
    .um-panel::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 1.5rem;
        padding: 2px;
        background: linear-gradient(120deg, #6366f1, #a855f7, #22d3ee, #6366f1, #a855f7);
        background-size: 300% 300%;
        -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
                mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
        -webkit-mask-composite: xor;
                mask-composite: exclude;
        opacity: .35;
        animation: um-border-shift 8s ease-in-out infinite;
        pointer-events: none;
    }

    .um-icon-wrap {
        animation: um-float 4s ease-in-out infinite;
    }
    .um-icon-pulse {
        animation: um-pulse-ring 2.2s ease-out infinite;
    }

    .um-gradient-text {
        background: linear-gradient(90deg, #6366f1, #a855f7, #22d3ee);
        -webkit-background-clip: text;
                background-clip: text;
        color: transparent;
    }

    .um-chip {
        background: linear-gradient(90deg,
            rgba(99,102,241,.12), rgba(168,85,247,.12), rgba(34,211,238,.12));
        backdrop-filter: blur(6px);
    }
    .dark .um-chip {
        background: linear-gradient(90deg,
            rgba(99,102,241,.22), rgba(168,85,247,.22), rgba(34,211,238,.22));
    }

    .um-guide-card {
        position: relative;
        overflow: hidden;
        background: linear-gradient(180deg, rgba(255,255,255,.7), rgba(255,255,255,.4));
        backdrop-filter: blur(8px);
        transition: transform .3s ease, box-shadow .3s ease;
        animation: um-fade-up .5s ease both;
    }
    .dark .um-guide-card {
        background: linear-gradient(180deg, rgba(30,27,75,.5), rgba(15,23,42,.55));
    }
    .um-guide-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 32px -16px rgba(99,102,241,.4);
    }
    .um-guide-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(110deg,
            transparent 30%, rgba(255,255,255,.5) 50%, transparent 70%);
        background-size: 200% 100%;
        background-position: -200% 0;
        opacity: 0;
        transition: opacity .3s ease;
        pointer-events: none;
    }
    .um-guide-card:hover::after {
        opacity: .7;
        animation: um-shimmer 1.2s ease forwards;
    }

    /* Inject styling into Filament's underlying FileUpload (Filepond) */
    .um-form-wrap .filepond--root {
        font-family: inherit;
    }
    .um-form-wrap .filepond--panel-root {
        background: transparent !important;
        border: 2px dashed rgba(99,102,241,.45);
        border-radius: 1.25rem;
        transition: border-color .3s ease, background .3s ease;
    }
    .dark .um-form-wrap .filepond--panel-root {
        border-color: rgba(168,85,247,.45);
    }
    .um-form-wrap .filepond--panel-root:hover {
        border-color: #22d3ee;
        background: linear-gradient(180deg,
            rgba(99,102,241,.06), rgba(34,211,238,.06)) !important;
    }
    .um-form-wrap .filepond--drop-label {
        color: rgb(67,56,202);
        font-weight: 500;
    }
    .dark .um-form-wrap .filepond--drop-label {
        color: rgb(199,210,254);
    }
    .um-form-wrap .filepond--label-action {
        text-decoration: none;
        background: linear-gradient(90deg, #6366f1, #a855f7, #22d3ee);
        -webkit-background-clip: text;
                background-clip: text;
        color: transparent;
        font-weight: 700;
    }
    .um-form-wrap .filepond--item-panel {
        background: linear-gradient(135deg, #6366f1, #a855f7) !important;
        border-radius: .75rem;
    }
    .um-form-wrap .filepond--file-action-button {
        background-color: rgba(15,23,42,.6);
        cursor: pointer;
    }
</style>

<div class="um-panel p-6 md:p-8 shadow-[0_20px_60px_-20px_rgba(99,102,241,0.45)] dark:shadow-[0_20px_60px_-20px_rgba(0,0,0,0.8)]">

    {{-- ─────────── AURORA HEADER ─────────── --}}
    <div class="prof-hero relative rounded-2xl p-6 md:p-8 mb-6 overflow-hidden">
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

        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center gap-5">
            {{-- Floating icon --}}
            <div class="um-icon-wrap shrink-0">
                <div class="um-icon-pulse w-16 h-16 md:w-20 md:h-20 rounded-2xl
                            bg-white/10 dark:bg-slate-900/40 backdrop-blur-md border border-white/20
                            grid place-content-center shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.8"
                         class="w-9 h-9 md:w-11 md:h-11">
                        <defs>
                            <linearGradient id="um-grad" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0%"   stop-color="#60a5fa"/>
                                <stop offset="50%"  stop-color="#c084fc"/>
                                <stop offset="100%" stop-color="#22d3ee"/>
                            </linearGradient>
                        </defs>
                        <path stroke="url(#um-grad)" stroke-linecap="round" stroke-linejoin="round"
                              d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 8.25 12 3.75m0 0L7.5 8.25M12 3.75v12"/>
                    </svg>
                </div>
            </div>

            <div class="flex-1 text-white">
                <h2 class="text-xl md:text-2xl font-bold drop-shadow-sm">
                    {{ __('Detail Aplikasi & Misi') }}
                </h2>
                <p class="text-white/85 text-sm md:text-base mt-1 max-w-xl">
                    {{ __('Lengkapi profil aplikasi Anda termasuk logo, nama, dan instruksi pengujian yang jelas agar penguji dapat menjalankan misi Anda dengan tepat.') }}
                </p>
            </div>
        </div>
    </div>

    {{-- ─────────── INFO CHIPS ─────────── --}}
    <div class="flex flex-wrap gap-2 mb-6">
        <span class="um-chip inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full
                     text-xs font-semibold text-indigo-700 dark:text-indigo-200
                     ring-1 ring-indigo-300/40">
            <x-heroicon-s-information-circle class="w-4 h-4" />
            {{ __('Informasi Lengkap') }}
        </span>
        <span class="um-chip inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full
                     text-xs font-semibold text-violet-700 dark:text-violet-200
                     ring-1 ring-violet-300/40">
            <x-heroicon-s-document-text class="w-4 h-4" />
            {{ __('Instruksi Detail') }}
        </span>
        <span class="um-chip inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full
                     text-xs font-semibold text-cyan-700 dark:text-cyan-200
                     ring-1 ring-cyan-300/40">
            <x-heroicon-s-photo class="w-4 h-4" />
            {{ __('Logo Menarik') }}
        </span>
    </div>

    {{-- ─────────── FILAMENT FIELDS ─────────── --}}
    <div class="um-form-wrap relative space-y-6">
        @if(isset($getChildComponentContainer))
            {{ $getChildComponentContainer() }}
        @endif
    </div>

    {{-- ─────────── GUIDELINE CARDS ─────────── --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-6">
        @php
            $guides = [
                [
                    'title' => __('Nama & Branding'),
                    'desc'  => __('Gunakan nama aplikasi yang benar dan unggah logo resolusi tinggi (rasio 1:1).'),
                    'color' => 'from-indigo-500 to-violet-500',
                    'icon'  => 'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z',
                ],
                [
                    'title' => __('Instruksi Terarah'),
                    'desc'  => __('Tuliskan langkah-langkah detail pengujian agar penguji tidak kebingungan.'),
                    'color' => 'from-violet-500 to-fuchsia-500',
                    'icon'  => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z',
                ],
                [
                    'title' => __('Cek Kembali'),
                    'desc'  => __('Pastikan informasi sudah benar sebelum melangkah ke proses pemilihan paket.'),
                    'color' => 'from-cyan-500 to-indigo-500',
                    'icon'  => 'M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zM19.5 19.5h-15',
                ],
            ];
        @endphp

        @foreach($guides as $i => $g)
            <div class="um-guide-card rounded-xl p-4 ring-1 ring-slate-200/60 dark:ring-white/10"
                 style="animation-delay: {{ $i * 80 }}ms">
                <div class="flex items-start gap-3">
                    <div class="shrink-0 w-9 h-9 rounded-lg bg-gradient-to-br {{ $g['color'] }}
                                grid place-content-center shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $g['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-slate-800 dark:text-slate-100">
                            {{ $g['title'] }}
                        </p>
                        <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5 leading-relaxed">
                            {{ $g['desc'] }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ─────────── FOOTER NOTE ─────────── --}}
    <div class="mt-6 flex items-start gap-3 p-4 rounded-xl
                bg-gradient-to-r from-indigo-50 via-violet-50 to-cyan-50
                dark:from-indigo-950/40 dark:via-violet-950/40 dark:to-cyan-950/40
                ring-1 ring-indigo-200/50 dark:ring-white/10">
        <div class="shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-cyan-400
                    grid place-content-center shadow">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                 stroke-width="2.4" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-xs md:text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
            <span class="font-bold um-gradient-text">{{ __('Catatan:') }}</span>
            {!! __('Informasi yang lengkap dan instruksi yang detail akan sangat membantu penguji dalam memberikan umpan balik (<i>feedback</i>) yang berkualitas untuk aplikasi Anda.') !!}
        </p>
    </div>

    {{-- ─────────── TOMBOL SUBMIT (KHUSUS EDIT) ─────────── --}}
    @if($this instanceof \Filament\Resources\Pages\EditRecord)
        @include('filament.developer.components.wizard-submit-button')
    @endif
</div>
