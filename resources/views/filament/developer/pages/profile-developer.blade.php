<x-filament-panels::page>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  .prof-page, .prof-page * { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; }
  .font-mono-num { font-family: 'JetBrains Mono', monospace !important; font-variant-numeric: tabular-nums; }
  .fi-main { background-color: #f1f5f9 !important; }
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
  .prof-avatar {
    background: linear-gradient(135deg,#3b82f6,#2563eb,#7c3aed);
    box-shadow: 0 8px 24px rgba(0,0,0,.25), 0 0 0 4px rgba(255,255,255,.15);
  }
  .prof-status-dot { animation: prof-pulse-ring 2s infinite; }
  .prof-stat-pill {
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,.15);
    transition: all .3s cubic-bezier(.4,0,.2,1);
    position: relative;
    overflow: hidden;
  }
  .prof-stat-pill:hover {
    background: rgba(255,255,255,.15);
    transform: translateY(-3px);
    border-color: rgba(255,255,255,.3);
  }
  .prof-stat-pill::after {
    content:''; position:absolute; top:0; left:0; width:40%; height:100%;
    background: linear-gradient(90deg,transparent,rgba(255,255,255,.2),transparent);
    transform: translateX(-100%);
  }
  .prof-stat-pill:hover::after { animation: prof-shimmer 1.2s ease forwards; }

  .prof-mini {
    transition: transform .25s ease;
    cursor: default;
  }
  .prof-mini:hover { transform: translateY(-2px); }
  .prof-mini:hover .prof-mini-dot { animation: prof-bounce-soft .6s ease; }

  .prof-card {
    animation: prof-fade-up .6s ease both;
    transition: box-shadow .3s ease, transform .3s ease;
  }
  .prof-card:hover { box-shadow: 0 12px 40px -12px rgba(37,99,235,.18); }

  .prof-fade-1 { animation: prof-fade-up .6s .05s ease both; }
  .prof-fade-2 { animation: prof-fade-up .6s .15s ease both; }
  .prof-fade-3 { animation: prof-fade-up .6s .25s ease both; }

  .prof-btn-save {
    background: linear-gradient(135deg,#1d4ed8,#2563eb,#3b82f6);
    background-size: 200% 200%;
    box-shadow: 0 6px 20px rgba(37,99,235,.4), 0 0 0 1px rgba(255,255,255,.1) inset;
    transition: all .3s ease;
    position: relative;
    overflow: hidden;
  }
  .prof-btn-save:hover {
    background-position: 100% 50%;
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(37,99,235,.5);
  }
  .prof-btn-save::before {
    content:''; position:absolute; inset:0;
    background: linear-gradient(90deg,transparent,rgba(255,255,255,.3),transparent);
    transform: translateX(-100%);
  }
  .prof-btn-save:hover::before { animation: prof-shimmer .8s ease; }

  .prof-icon-wrap { transition: transform .4s ease; }
  .prof-icon-wrap:hover { transform: rotate(-8deg) scale(1.1); }

  .prof-divider-anim {
    background: linear-gradient(180deg,transparent,rgba(255,255,255,.4),transparent);
    background-size: 100% 200%;
    animation: prof-gradient 3s ease infinite;
  }

  /* Counter target (animated by JS) */
  .prof-counter { display: inline-block; }

  @media (prefers-reduced-motion: reduce) {
    .prof-hero, .prof-blob, .prof-blob-rev, .prof-status-dot,
    .prof-btn-save, .prof-divider-anim, .prof-aurora, .prof-conic, .prof-conic-2,
    .prof-grid-bg, .prof-particles span, .prof-shoot, .prof-waves svg, .prof-scan, .prof-stars i { animation: none !important; }
  }
</style>
@endpush

@php $stats = $this->getStats(); @endphp

<div class="prof-page">
  <div class="px-6 py-6">

    {{-- ═══════════ HERO BANNER ═══════════ --}}
    <div class="prof-hero prof-fade-1 w-full rounded-3xl p-6 sm:p-8 mb-6 relative overflow-hidden">

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
      <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-start sm:items-center gap-4">
          {{-- Avatar with initial --}}
          <div class="relative flex-shrink-0">
            <div class="prof-avatar w-16 h-16 sm:w-20 sm:h-20 rounded-2xl flex items-center justify-center text-white text-2xl sm:text-3xl font-extrabold select-none">
              {{ strtoupper(substr(Auth::user()->name,0,1)) }}
            </div>
            <span class="prof-status-dot absolute -bottom-1 -right-1 w-4 h-4 sm:w-5 sm:h-5 rounded-full border-2 border-white"
                  style="background:#34d399;"></span>
          </div>

          <div class="min-w-0">
            <p class="text-[10px] font-bold uppercase mb-1 flex items-center gap-2"
               style="color:#bfdbfe;letter-spacing:0.18em;">
              <span class="w-4 h-px" style="background:#bfdbfe;"></span>
              DEVELOPER PANEL
            </p>
            <h1 class="font-bold text-white mb-2 truncate" style="font-size:clamp(20px,5vw,34px);line-height:1.1;letter-spacing:-0.02em;">
              {{ Auth::user()->name }}
            </h1>
            <div class="flex items-center gap-1.5 flex-wrap">
              <span class="inline-flex items-center gap-1 text-[10px] sm:text-xs font-bold px-2 py-1 rounded-full"
                    style="background:linear-gradient(135deg,rgba(59,130,246,.25),rgba(124,58,237,.25));color:#dbeafe;border:1px solid rgba(59,130,246,.3);">
                💻 Developer
              </span>
              <span class="inline-flex items-center gap-1 text-[10px] sm:text-xs font-medium px-2 py-1 rounded-full"
                    style="background:rgba(255,255,255,0.12);color:#dbeafe;border:1px solid rgba(255,255,255,.15);">
                <span class="w-1.5 h-1.5 rounded-full inline-block prof-status-dot" style="background:#34d399;"></span>
                Bergabung {{ Auth::user()->created_at->format('M Y') }}
              </span>
              <span class="inline-flex items-center gap-1 text-[10px] sm:text-xs font-medium px-2 py-1 rounded-full max-w-full truncate"
                    style="background:rgba(255,255,255,0.12);color:#dbeafe;border:1px solid rgba(255,255,255,.15);">
                ✉️ {{ Auth::user()->email }}
              </span>
            </div>
          </div>
        </div>

        {{-- Top stat pills: 3-col grid on mobile --}}
        <div class="grid grid-cols-3 sm:flex sm:items-center gap-2 sm:gap-3 w-full sm:w-auto">
          <div class="prof-stat-pill rounded-2xl px-3 sm:px-5 py-2.5 sm:py-3 text-center">
            <p class="font-mono-num text-xl sm:text-2xl font-bold text-white prof-counter" data-target="{{ $stats['total_misi'] }}">0</p>
            <p class="text-[9px] sm:text-[10px] font-semibold uppercase tracking-wider mt-0.5" style="color:#dbeafe;letter-spacing:0.08em;">Total Misi</p>
          </div>
          <div class="prof-stat-pill rounded-2xl px-3 sm:px-5 py-2.5 sm:py-3 text-center">
            <p class="font-mono-num text-xl sm:text-2xl font-bold text-white prof-counter" data-target="{{ $stats['misi_selesai'] }}">0</p>
            <p class="text-[9px] sm:text-[10px] font-semibold uppercase tracking-wider mt-0.5" style="color:#dbeafe;letter-spacing:0.08em;">Selesai</p>
          </div>
          <div class="prof-stat-pill rounded-2xl px-3 sm:px-5 py-2.5 sm:py-3 text-center">
            <p class="font-mono-num text-xl sm:text-2xl font-bold text-white prof-counter" data-target="{{ $stats['total_misi'] > 0 ? round($stats['misi_selesai'] / $stats['total_misi'] * 100) : 0 }}">0</p>
            <p class="text-[9px] sm:text-[10px] font-semibold uppercase tracking-wider mt-0.5" style="color:#dbeafe;letter-spacing:0.08em;">% Sukses</p>
          </div>
        </div>
      </div>

      {{-- Mini stats footer --}}
      <div class="relative z-10 grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6 pt-5"
           style="border-top:1px solid rgba(255,255,255,0.15);">
        @php
          $mini = [
            ['label'=>'Misi Dibuat','val'=>$stats['total_misi'],'color'=>'#60a5fa'],
            ['label'=>'Misi Selesai','val'=>$stats['misi_selesai'],'color'=>'#34d399'],
            ['label'=>'Paket Aktif','val'=>$stats['paket'],'color'=>'#a78bfa','isText'=>true],
          ];
        @endphp
        @foreach($mini as $m)
          <div class="prof-mini flex items-center gap-3">
            <span class="prof-mini-dot w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:{{ $m['color'] }};box-shadow:0 0 12px {{ $m['color'] }};"></span>
            <div>
              @if(isset($m['isText']) && $m['isText'])
                <p class="font-mono-num text-lg font-bold text-white">{{ $m['val'] }}</p>
              @else
                <p class="font-mono-num text-lg font-bold text-white prof-counter" data-target="{{ $m['val'] }}">0</p>
              @endif
              <p class="text-[10px] font-semibold uppercase tracking-wider" style="color:#dbeafe;letter-spacing:0.12em;">{{ $m['label'] }}</p>
            </div>
          </div>
        @endforeach
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

    {{-- ═══════════ EDIT FORM ═══════════ --}}
    <div class="prof-card prof-fade-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
      <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3 relative overflow-hidden">
        <div class="absolute inset-0 opacity-50"
             style="background:linear-gradient(90deg,rgba(239,246,255,.6),transparent 60%);"></div>
        <div class="prof-icon-wrap relative w-10 h-10 rounded-xl flex items-center justify-center"
             style="background:linear-gradient(135deg,#dbeafe,#bfdbfe);box-shadow:0 4px 12px rgba(37,99,235,.15);">
          <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
          </svg>
        </div>
        <div class="relative">
          <h2 class="font-bold text-slate-800 text-base">Edit Profil</h2>
          <p class="text-slate-400 text-xs">Perbarui informasi akun & keamanan Anda</p>
        </div>
      </div>

      <div class="p-6 prof-fade-3">
        <form wire:submit="save">
          {{ $this->form }}
          <div class="mt-6 flex justify-end">
            <button type="submit"
              class="prof-btn-save inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-sm font-bold text-white">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
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

@push('scripts')
<script>
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
    // Re-run after Livewire updates (e.g. after save)
    document.addEventListener('livewire:navigated', run);
    if (window.Livewire) window.Livewire.hook('message.processed', run);
  })();
</script>
@endpush

<x-filament-actions::modals />
</x-filament-panels::page>
