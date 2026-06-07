<x-filament-panels::page>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<style>
.prof-page, .prof-page * { font-family: 'Inter', sans-serif; }
.font-mono-num { font-family: 'JetBrains Mono', monospace !important; }
.fi-main { background-color: #f8fafc !important; }
.fi-page { padding: 0 !important; }
.fi-page-header-heading { display: none !important; }

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
  $stats = $this->getStats();
  $badgeCount = $stats['badge'] ?? 0;
  if ($badgeCount <= 5) {
      $tierName = 'Tester Beginner';
  } elseif ($badgeCount <= 50) {
      $tierName = 'Tester Intermediate';
  } else {
      $tierName = 'Tester Master';
  }
@endphp

<div class="prof-page">
  <div class="px-6 py-6">

    {{-- ═══════════ HERO BANNER (dengan style profile admin) ═══════════ --}}
    <div class="prof-hero w-full rounded-3xl p-6 sm:p-8 mb-6 relative overflow-hidden">

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
      <div class="relative z-10 flex items-center justify-between flex-wrap gap-6">
        <div class="flex items-center gap-5">
          {{-- Avatar with initial --}}
          <div class="relative">
            <div class="w-20 h-20 rounded-2xl flex items-center justify-center text-white text-3xl font-extrabold select-none"
                 style="background: linear-gradient(135deg,#fbbf24,#f59e0b,#ef4444); box-shadow: 0 8px 24px rgba(0,0,0,.25), 0 0 0 4px rgba(255,255,255,.15);">
              {{ strtoupper(substr(Auth::user()->name,0,1)) }}
            </div>
            <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full border-2 border-white"
                  style="background:#34d399; animation: prof-pulse-ring 2s infinite;"></span>
          </div>

          <div>
            <p class="text-[11px] font-bold uppercase mb-1.5 flex items-center gap-2"
               style="color:#bfdbfe;letter-spacing:0.18em;">
              <span class="w-6 h-px" style="background:#bfdbfe;"></span>
              TESTER PROFILE
            </p>
            <h1 class="font-bold text-white mb-2.5" style="font-size:34px;line-height:1.1;letter-spacing:-0.02em;">
              {{ Auth::user()->name }}
            </h1>
            <div class="flex items-center gap-2 flex-wrap">
              <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-full"
                    style="background:linear-gradient(135deg,rgba(251,191,36,.25),rgba(245,158,11,.25));color:#fef3c7;border:1px solid rgba(251,191,36,.4);">
                ⭐ {{ $tierName }}
              </span>
              <span class="inline-flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-full"
                    style="background:rgba(255,255,255,0.12);color:#dbeafe;border:1px solid rgba(255,255,255,.15);">
                📅 Bergabung {{ $stats['member_since'] }}
              </span>
              <span class="inline-flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-full"
                    style="background:rgba(255,255,255,0.12);color:#dbeafe;border:1px solid rgba(255,255,255,.15);">
                ✉️ {{ Auth::user()->email }}
              </span>
            </div>
          </div>
        </div>

        {{-- Top stats (Points) --}}
        <div class="flex items-center gap-3 flex-wrap">
          <div style="background: rgba(255,255,255,.08); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,.15);" class="rounded-2xl px-5 py-3 text-center min-w-[130px]">
            <p class="font-mono-num text-2xl font-bold text-white">{{ number_format($stats['point']) }}</p>
            <p class="text-[10px] font-semibold uppercase tracking-wider mt-0.5" style="color:#dbeafe;letter-spacing:0.12em;">Poin Kamu (pts)</p>
          </div>
          <div class="flex flex-col gap-1.5">
            <a href="{{ \App\Filament\Tester\Pages\Dompet::getUrl() }}"
               class="flex items-center justify-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-center"
               style="background:#ffffff !important;color:#1d4ed8 !important;box-shadow:0 6px 15px -3px rgba(29,78,216,0.3);text-decoration:none !important;">
              Tukar Poin
            </a>
          </div>
        </div>
      </div>


      {{-- Mini stats --}}
      <div class="relative z-10 grid grid-cols-2 sm:flex sm:items-center gap-4 sm:gap-6 mt-5 pt-4"
           style="border-top:1px solid rgba(255,255,255,0.15);align-items:center;">
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ $stats['misi_selesai'] }}</p>
          <p class="text-xs opacity-70" style="color:#e0f2fe;">Misi Selesai</p>
        </div>
        <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>
        
        {{-- HIGHTLIGHT BADGE COLUMN --}}
        <div class="px-4 py-2 rounded-2xl bg-white/10 border border-white/20 transform scale-110 shadow-lg" style="backdrop-filter:blur(8px);">
          <p class="font-mono-num text-xl font-extrabold flex items-center gap-1.5 leading-none" style="color:#fbbf24 !important;">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="color:#fbbf24 !important; display: inline-block; vertical-align: middle;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.643 12.984l-1.18 2.044a2.5 2.5 0 01-2.222 1.344H7.759a2.5 2.5 0 01-2.222-1.344l-1.18-2.044a2.5 2.5 0 010-2.5l1.18-2.044A2.5 2.5 0 017.759 7.07h8.482a2.5 2.5 0 012.222 1.344l1.18 2.044a2.5 2.5 0 010 2.5z" />
            </svg>
            <span style="color:#fbbf24 !important;">{{ $badgeCount }}</span>
          </p>
          <p class="text-[9px] font-bold uppercase tracking-wider mt-0.5" style="color:#fef3c7 !important;">Badge</p>
        </div>
        
        <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ $stats['total_misi'] }}</p>
          <p class="text-xs opacity-70" style="color:#e0f2fe;">Aktif Sekarang</p>
        </div>
        <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ $stats['member_since'] }}</p>
          <p class="text-xs opacity-70" style="color:#e0f2fe;">Member Sejak</p>
        </div>
      </div>

      {{-- Animated waves --}}
      <div class="prof-waves" style="position:absolute; left:0; right:0; bottom:0; height:80px; overflow:hidden; pointer-events:none; opacity:.35; mask-image: linear-gradient(180deg, transparent, #000 60%);">
        <svg viewBox="0 0 2400 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:200%; height:100%; display:block; animation: prof-wave 14s linear infinite;">
          <path d="M0,40 C150,80 350,0 600,40 C850,80 1050,0 1200,40 C1350,80 1550,0 1800,40 C2050,80 2250,0 2400,40 L2400,80 L0,80 Z" fill="rgba(255,255,255,0.18)"/>
        </svg>
      </div>
      <div class="prof-waves w2" style="position:absolute; left:0; right:0; bottom:0; height:80px; overflow:hidden; pointer-events:none; opacity:.35; mask-image: linear-gradient(180deg, transparent, #000 60%);">
        <svg viewBox="0 0 2400 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:200%; height:100%; display:block; animation: prof-wave 22s linear infinite; opacity:.6;">
          <path d="M0,50 C200,20 400,70 600,50 C800,30 1000,70 1200,50 C1400,20 1600,70 1800,50 C2000,30 2200,70 2400,50 L2400,80 L0,80 Z" fill="rgba(147,197,253,0.22)"/>
        </svg>
      </div>
    </div>

    {{-- ═══════════ EDIT FORM ═══════════ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
      <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#e0f2fe;">
          <svg class="w-4 h-4" style="color:#0ea5e9;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
          </svg>
        </div>
        <div>
          <h2 class="font-bold text-slate-800 text-sm">Edit Profil</h2>
          <p class="text-slate-400 text-xs">Perbarui nama, email, atau password akun Anda</p>
        </div>
      </div>

      <div class="p-6">
        <form wire:submit="save">
          {{ $this->form }}
          <div class="mt-6 flex justify-end">
            <button type="submit"
              class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white transition"
              style="background:linear-gradient(135deg,#0ea5e9,#2563eb);box-shadow:0 4px 12px rgba(14,165,233,0.3);">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
              </svg>
              Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<x-filament-actions::modals />
</x-filament-panels::page>
