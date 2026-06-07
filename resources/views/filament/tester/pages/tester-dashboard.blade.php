{{--  
    Tester Dashboard — PlayTest ID  
    Panel  : Tester (path /tester)  
    Page   : TesterDashboard.php  
    Fonts  : Plus Jakarta Sans (heading), JetBrains Mono (angka), Inter (body)  
--}}  
  
<x-filament-panels::page>  
  
@push('styles')  
<link rel="preconnect" href="https://fonts.googleapis.com">  
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>  
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">  
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  
<style>  
/* ══════════════════════════════════════  
   FONTS  
══════════════════════════════════════ */  
.tsr-page, .tsr-page * { font-family: 'Inter', sans-serif; }  
.font-heading  { font-family: 'Plus Jakarta Sans', sans-serif !important; }  
.font-mono-num { font-family: 'JetBrains Mono', monospace !important; }  
  
/* ══════════════════════════════════════  
   PROGRESS BAR  
══════════════════════════════════════ */  
.tsr-progress-track {  
    height: 6px;  
    background: #e2e8f0;  
    border-radius: 9999px;  
    overflow: hidden;  
}  
.tsr-progress-fill {  
    height: 100%;  
    border-radius: 9999px;  
    transition: width 1s cubic-bezier(0.34, 1.56, 0.64, 1);  
}  
  
/* ══════════════════════════════════════  
   MISSION CARDS  
══════════════════════════════════════ */  
.tsr-mission-card {  
    background: #ffffff;  
    border-radius: 1rem;  
    padding: 1rem;  
    border: 1px solid #e2e8f0;  
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);  
    transition: box-shadow 0.2s ease, transform 0.2s ease;  
}  
.tsr-mission-card:hover {  
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);  
    transform: translateY(-2px);  
}  
  
/* ══════════════════════════════════════  
   APP LIST ITEMS  
══════════════════════════════════════ */  
.tsr-app-item {  
    padding: 1rem 1.25rem;  
    border-bottom: 1px solid #f1f5f9;  
    transition: background 0.15s ease;  
}  
.tsr-app-item:hover { background: #fafafa; }  
.tsr-app-item:last-child { border-bottom: none; }  
  
/* ══════════════════════════════════════  
   BUTTONS  
══════════════════════════════════════ */  
.tsr-btn-apply {  
    display: inline-flex; align-items: center; gap: 6px;  
    padding: 8px 16px; border-radius: 0.75rem;  
    font-size: 0.8125rem; font-weight: 600; color: #ffffff;  
    background: #2563eb; cursor: pointer;  
    box-shadow: 0 4px 12px rgba(37,99,235,0.25);  
    transition: all 0.15s ease; border: none; white-space: nowrap;  
}  
.tsr-btn-apply:hover { background: #1d4ed8; box-shadow: 0 6px 16px rgba(37,99,235,0.35); }  
.tsr-btn-apply:disabled {  
    background: #94a3b8 !important;  
    box-shadow: none !important;  
    cursor: not-allowed !important;  
    opacity: 0.7;  
}  
  
.tsr-btn-submit {  
    display: inline-flex; align-items: center; gap: 6px;  
    padding: 6px 12px; border-radius: 0.75rem;  
    font-size: 0.75rem; font-weight: 600; color: #475569;  
    background: #f8fafc; cursor: pointer;  
    border: 1px solid #e2e8f0; transition: all 0.15s ease;  
}  
.tsr-btn-submit:hover { background: #f1f5f9; }  
  
.tsr-btn-laporkan {  
    display: inline-flex; align-items: center; gap: 6px;  
    padding: 6px 12px; border-radius: 0.75rem;  
    font-size: 0.75rem; font-weight: 600; color: #ef4444;  
    background: #fff1f2; cursor: pointer;  
    border: 1px solid #fecdd3; transition: all 0.15s ease;  
}  
.tsr-btn-laporkan:hover { background: #ffe4e6; }  
  
/* ══════════════════════════════════════  
   FILTER TABS  
══════════════════════════════════════ */  
.tsr-filter-active {  
    background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;  
    font-weight: 600; font-size: 0.75rem; padding: 6px 12px; border-radius: 0.75rem;  
    cursor: pointer; transition: all 0.15s ease;  
}  
.tsr-filter-inactive {  
    background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0;  
    font-weight: 600; font-size: 0.75rem; padding: 6px 12px; border-radius: 0.75rem;  
    cursor: pointer; transition: all 0.15s ease;  
}  
.tsr-filter-inactive:hover { background: #f1f5f9; color: #1e293b; }  

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
.prof-stars i {
  position:absolute; width:2px; height:2px; border-radius:50%;
  background:#fff; box-shadow:0 0 6px #fff;
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
  animation-delay: 2s;
  pointer-events:none;
}
.prof-shoot.s2 { top:55%; animation-duration: 9s; animation-delay: 5s; opacity:.7; }

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
  .prof-grid-bg, .prof-particles span, .prof-shoot, .prof-waves svg, .prof-scan, .prof-stars i { animation: none !important; }
}
</style>  
@endpush  

@php
  if ($userBadgeCount <= 5) {
      $tierName = 'Tester Beginner';
  } elseif ($userBadgeCount <= 50) {
      $tierName = 'Tester Intermediate';
  } else {
      $tierName = 'Tester Master';
  }
@endphp

<div class="tsr-page" x-data="testerDashboard()" x-init="animateBars()">  
  
    <div class="px-6 py-6">  
  
        {{-- ══════════════════════════════════════  
             HERO — KARTU POIN  
        ══════════════════════════════════════ --}}  
        <div data-design-id="points-card"  
             class="prof-hero w-full rounded-3xl p-6 sm:p-8 mb-6 relative overflow-hidden">  
  
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
              <i style="top:{{ rand(2,90) }}%; left:{{ rand(2,98) }}%; animation-delay:{{ ($i*0.23) }}s;"></i>
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
          <div class="relative z-10 flex items-center justify-between flex-wrap gap-4">  
                <div>  
                    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#e0f2fe;letter-spacing:0.12em;">POIN KAMU</p>  
                    <div class="flex items-baseline gap-2 mb-2">  
                        <span class="font-mono-num font-bold text-white" style="font-size:48px;line-height:1;">{{ number_format($totalPoin) }}</span>  
                        <span class="text-xl font-semibold" style="color:#bae6fd;opacity:0.85;">pts</span>  
                    </div>  
                    <div class="flex items-center gap-2 flex-wrap">  
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-full"  
                              style="background:linear-gradient(135deg,rgba(251,191,36,.25),rgba(245,158,11,.25));color:#fef3c7;border:1px solid rgba(251,191,36,.4);backdrop-filter:blur(12px);">  
                            ⭐ {{ $tierName }}  
                        </span>  
                        <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1.5 rounded-full"  
                              style="background:rgba(255,255,255,0.12);color:#e0f2fe;border:1px solid rgba(255,255,255,.15);backdrop-filter:blur(12px);">  
                            <span class="w-1.5 h-1.5 rounded-full inline-block" style="background:#fbbf24;"></span>  
                            {{ $userBadgeCount }} badge diraih  
                        </span>  
                        <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1.5 rounded-full"  
                              style="background:rgba(255,255,255,0.12);color:#e0f2fe;border:1px solid rgba(255,255,255,.15);backdrop-filter:blur(12px);">  
                            <span class="w-1.5 h-1.5 rounded-full inline-block" style="background:#10b981;"></span>  
                            +{{ $poinPending }} pts pending  
                        </span>  
                    </div>  
                </div>  
  
                <div class="flex items-center gap-3 flex-wrap">  
                    <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold"  
                            style="background:rgba(255,255,255,0.12);color:#ffffff;border:1px solid rgba(255,255,255,0.25);backdrop-filter:blur(12px);">  
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">  
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>  
                        </svg>  
                        Riwayat  
                    </button>  
                    <a href="{{ \App\Filament\Tester\Pages\Dompet::getUrl() }}"
                       class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold"
                             style="background:#ffffff !important;color:#1d4ed8 !important;box-shadow:0 10px 25px -5px rgba(29,78,216,0.3);text-decoration:none !important;">
                        Tukar Poin
                    </a>  
                </div>  
            </div>  
  
            {{-- Mini stats --}}  
            <div class="relative z-10 grid grid-cols-2 sm:flex sm:items-center gap-4 sm:gap-6 mt-5 pt-4"  
                 style="border-top:1px solid rgba(255,255,255,0.15);align-items:center;">  
                <div>  
                    <p class="font-mono-num text-lg font-bold text-white">{{ $misiSelesai }}</p>  
                    <p class="text-xs opacity-70" style="color:#e0f2fe;">Misi Selesai</p>  
                </div>  
                <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>  
                <div>  
                    <p class="font-mono-num text-lg font-bold text-white">{{ $rating }}</p>  
                    <p class="text-xs opacity-70" style="color:#e0f2fe;">Rating</p>  
                </div>  
                <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>  
                
                {{-- HIGHTLIGHT BADGE COLUMN --}}
                <div class="px-4 py-2 rounded-2xl bg-white/10 border border-white/20 transform scale-110 shadow-lg" style="backdrop-filter:blur(8px);">
                    <p class="font-mono-num text-xl font-extrabold flex items-center gap-1.5 leading-none" style="color:#fbbf24 !important;">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="color:#fbbf24 !important; display: inline-block; vertical-align: middle;">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.643 12.984l-1.18 2.044a2.5 2.5 0 01-2.222 1.344H7.759a2.5 2.5 0 01-2.222-1.344l-1.18-2.044a2.5 2.5 0 010-2.5l1.18-2.044A2.5 2.5 0 017.759 7.07h8.482a2.5 2.5 0 012.222 1.344l1.18 2.044a2.5 2.5 0 010 2.5z" />
                        </svg>
                        <span style="color:#fbbf24 !important;">{{ $userBadgeCount }}</span>
                    </p>
                    <p class="text-[9px] font-bold uppercase tracking-wider mt-0.5" style="color:#fef3c7 !important;">Badge</p>
                </div>
                
                <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>  
                <div>  
                    <p class="font-mono-num text-lg font-bold text-white">{{ $misiAktif }}</p>  
                    <p class="text-xs opacity-70" style="color:#e0f2fe;">Aktif Sekarang</p>  
                </div>  
                <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>  
                <div>  
                    <p class="font-mono-num text-lg font-bold text-white">{{ $streakHari }}</p>  
                    <p class="text-xs opacity-70" style="color:#e0f2fe;">Hari Streak</p>  
                </div>  
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
        </div>{{-- end points card --}}  
  
  
        {{-- ══════════════════════════════════════  
             MISI AKTIF  
        ══════════════════════════════════════ --}}  
        <div data-design-id="missions-section" class="mb-6">  
            <div class="flex items-center justify-between mb-4">  
                <div>  
                    <h2 class="text-base font-bold font-heading" style="color:#1e293b;">Misi Aktif Saya</h2>  
                    <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ count($misiAktifList) }} misi sedang berjalan</p>  
                </div>  
                <a href="#" class="text-sm font-semibold flex items-center gap-1" style="color:#2563eb;">  
                    Lihat Semua  
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">  
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>  
                    </svg>  
                </a>  
            </div>  
  
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">  
                @foreach($misiAktifList as $misi)  
                <div data-design-id="mission-card-{{ $loop->iteration }}" class="tsr-mission-card">  
  
                    {{-- Header: icon + nama + status --}}  
                    <div class="flex items-start justify-between mb-3">  
                        <div class="flex items-center gap-3">  
                            @if($misi['logo'])
                                <img src="/storage/{{ $misi['logo'] }}" alt="Logo" class="w-11 h-11 rounded-xl object-cover shadow-sm flex-shrink-0">
                            @else
                                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"  
                                     style="background:{{ $misi['gradient'] }};">  
                                    <span class="text-white font-bold text-sm">{{ $misi['inisial'] }}</span>  
                                </div>  
                            @endif
                            <div>  
                                <a href="/tester/misi-detail?misi_id={{ $misi['id'] }}" class="text-sm font-bold font-heading hover:underline" style="color:#1e293b;">{{ $misi['nama'] }}</a>  
                                <p class="text-xs" style="color:#64748b;">{{ $misi['tipe'] }}</p>  
                            </div>  
                        </div>  
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-lg"  
                              style="background:#f0fdf4;color:#16a34a;">{{ $misi['status'] }}</span>  
                    </div>  
  
                    {{-- Progress hari --}}  
                    <div class="mb-3">  
                        <div class="flex items-center justify-between mb-1.5">  
                            <span class="text-xs font-medium" style="color:#64748b;">  
                                <span class="font-mono-num font-bold" style="color:#1e293b;">Day {{ $misi['hari'] }}</span> of {{ $misi['maxHari'] }}  
                            </span>  
                            <span class="text-xs font-semibold font-mono-num"  
                                  style="color:{{ $misi['warnaPersen'] }};">{{ $misi['persen'] }}%</span>  
                        </div>  
                        <div class="tsr-progress-track">  
                            <div class="tsr-progress-fill"  
                                 style="width:0%;background:{{ $misi['gradientBar'] }};"  
                                 data-target="{{ $misi['persen'] }}%">  
                            </div>  
                        </div>  
                    </div>  
  
                    {{-- Footer: reward + aksi --}}  
                    <div class="flex items-center justify-between">  
                        <div class="flex items-center gap-1">  
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" style="color:#10b981;">  
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>  
                            </svg>  
                            <span class="text-xs font-semibold" style="color:#10b981;">+{{ $misi['reward'] }} pts</span>  
                        </div>  
  
                        <div class="flex items-center gap-2">
                            @if($misi['aksi'] === 'submit')  
                                @if($misi['rawStatus'] === 'progress')
                                    <a href="/tester/misi-saya" class="tsr-btn-submit" style="text-decoration:none;">  
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">  
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>  
                                        </svg>  
                                        Submit Task  
                                    </a>  
                                @else
                                    <button class="tsr-btn-submit" disabled style="opacity: 0.6; cursor: not-allowed; background: #f1f5f9; color: #94a3b8;">  
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">  
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>  
                                        </svg>  
                                        Pending  
                                    </button>
                                @endif
                            @else  
                            <button class="tsr-btn-laporkan">  
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">  
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>  
                                </svg>  
                                Laporkan  
                            </button>  
                            @endif  
                            @if($misi['rawStatus'] !== 'progress')
                                <a href="/tester/misi-detail?misi_id={{ $misi['id'] }}" class="px-3 py-1.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors flex items-center gap-1.5" style="text-decoration:none;">
                                    Detail
                                </a>
                            @endif
                        </div>  
                    </div>  
                </div>  
                @endforeach  
            </div>  
        </div>{{-- end misi aktif --}}  
  
  
        {{-- ══════════════════════════════════════  
             APLIKASI TERSEDIA  
        ══════════════════════════════════════ --}}  
        <div data-design-id="available-section" class="mb-4">  
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">  
                <div class="w-full md:w-auto">  
                    <h2 class="text-base font-bold font-heading" style="color:#1e293b;">Aplikasi Tersedia untuk Diuji</h2>  
                    <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ count($aplikasiList) }} slot terbuka • Lamar sekarang</p>  
                </div>  
                <div class="flex items-center gap-2 flex-wrap w-full md:w-auto mt-1 md:mt-0">  
                    <button class="tsr-filter-active" x-on:click="setFilter('semua')" :class="filter === 'semua' ? 'tsr-filter-active' : 'tsr-filter-inactive'">Semua</button>  
                    <button class="tsr-filter-inactive" x-on:click="setFilter('functional')" :class="filter === 'functional' ? 'tsr-filter-active' : 'tsr-filter-inactive'">Functional</button>  
                    <button class="tsr-filter-inactive" x-on:click="setFilter('ux')" :class="filter === 'ux' ? 'tsr-filter-active' : 'tsr-filter-inactive'">UX</button>  
                </div>  
            </div>  
  
            {{-- List card --}}  
            <div class="bg-white rounded-2xl shadow-sm" style="border:1px solid #e2e8f0;">  
                @foreach($aplikasiList as $app)  
                <div data-design-id="app-item-{{ $loop->iteration }}" class="tsr-app-item flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 border-b border-slate-100 last:border-none hover:bg-slate-50 transition-colors">  
  
                    <div class="flex items-center gap-4 w-full md:w-auto">  
                        {{-- Icon / Logo --}}  
                        @if($app['logo'])  
                            <img src="/storage/{{ $app['logo'] }}" alt="Logo" class="w-12 h-12 rounded-2xl object-cover shadow-sm flex-shrink-0">  
                        @else  
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0"  
                                 style="background:{{ $app['gradient'] }};">  
                                <span class="text-white font-bold text-base">{{ $app['inisial'] }}</span>  
                            </div>  
                        @endif  
        
                        {{-- Info --}}  
                        <div class="flex-1 min-w-0">  
                            <div class="flex items-center gap-2 mb-0.5 flex-wrap">  
                                <p class="text-sm font-bold font-heading truncate max-w-[150px] sm:max-w-none" style="color:#1e293b;">{{ $app['nama'] }}</p>  
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-md flex-shrink-0"  
                                      style="background:{{ $app['tipeBg'] }};color:{{ $app['tipeColor'] }};">  
                                    {{ $app['tipe'] }}  
                                </span>  
                            </div>  
                            <p class="text-xs truncate text-slate-500" style="color:#64748b; max-width: 280px; overflow: hidden; text-overflow: ellipsis;">{{ $app['deskripsi'] }}</p>  
                        </div>  
                    </div>  
  
                    {{-- Meta & Actions (Sejajar ke samping di mobile) --}}  
                    <div class="flex flex-row items-center justify-between md:justify-end gap-2 sm:gap-4 w-full md:w-auto mt-2 md:mt-0 pt-3 md:pt-0 border-t md:border-none border-slate-100">  
                        
                        {{-- Durasi --}}
                        <div class="text-center hidden lg:block">  
                            <p class="text-xs font-bold font-mono-num" style="color:#1e293b;">{{ $app['durasi'] }}</p>  
                            <p class="text-xs" style="color:#94a3b8;">Durasi</p>  
                        </div>  
                        
                        {{-- Tester --}}
                        <div class="text-center flex-shrink-0">  
                            <p class="text-xs font-bold font-mono-num" style="color:#1e293b;">  
                                {{ $app['testerCur'] }}/{{ $app['testerMax'] }}  
                            </p>  
                            <p class="text-xs" style="color:#94a3b8;">Tester</p>  
                        </div>  
                        
                        {{-- Points --}}
                        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl flex-shrink-0" style="background:#f0fdf4;">  
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" style="color:#10b981;">  
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>  
                            </svg>  
                            <span class="text-xs font-bold font-mono-num text-emerald-600" style="color:#16a34a;">+{{ $app['reward'] }} pts</span>  
                        </div>  

                        {{-- Actions (Detail & Apply) --}}
                        @php  
                            $isRestricted = $app['isTrusted'] && ($userBadgeCount <= 5);  
                        @endphp  
                        <div class="flex items-center gap-2 flex-shrink-0 ml-auto md:ml-0">  
                            <a href="/tester/misi-detail?misi_id={{ $app['id'] }}" class="px-3 py-1.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors flex items-center gap-1.5" style="text-decoration:none;">  
                                Detail  
                            </a>  
                            <button   
                                @if(!$isRestricted)   
                                    wire:click="applyMisi('{{ $app['id'] }}')"   
                                @endif  
                                @disabled($isRestricted)  
                                wire:loading.attr="disabled"  
                                class="tsr-btn-apply !px-3 !py-1.5 text-xs font-bold"  
                                @if($isRestricted) title="Misi ini membutuhkan minimal 6 badge" @endif  
                            >  
                                <span wire:loading.remove wire:target="applyMisi('{{ $app['id'] }}')">  
                                    {{ $isRestricted ? 'Locked' : 'Apply' }}  
                                </span>  
                                <span wire:loading wire:target="applyMisi('{{ $app['id'] }}')">...</span>  
                            </button>  
                        </div>  
                    </div>  
                </div>  
                @endforeach  
            </div>  
        </div>{{-- end available apps --}}  
  
    </div>  
</div>{{-- end Alpine root --}}  
  
  
@push('scripts')  
<script>  
function testerDashboard() {  
    return {  
        filter: 'semua',  
  
        animateBars() {  
            this.$nextTick(() => {  
                document.querySelectorAll('.tsr-progress-fill').forEach(el => {  
                    const target = el.dataset.target || '0%';  
                    el.style.width = '0%';  
                    setTimeout(() => {  
                        el.style.transition = 'width 1s cubic-bezier(0.34, 1.56, 0.64, 1)';  
                        el.style.width = target;  
                    }, 400);  
                });  
            });  
        },  
  
        setFilter(val) {  
            this.filter = val;  
            /* Filter visual — logika backend bisa ditambahkan nanti */  
        }  
    };  
}  
</script>  
@endpush  
  
</x-filament-panels::page>  