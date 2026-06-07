<x-filament-panels::page>
@push('styles')
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

    {{-- ================================================================
         VIEW 1: DAFTAR MISI
    ================================================================ --}}
    @if (! $showSubmitForm)
        <div class="space-y-6" style="font-family: 'Inter', sans-serif;">

            {{-- ── Stats Banner (Menyamai gaya Dashboard) ──────────────────────────────────── --}}
            {{-- ── Stats Banner (Menyamai gaya Dashboard/Profile) ──────────────────────────────────── --}}
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
            {{-- ── Stats Banner (Menyamai gaya Dashboard) ──────────────────────────────────── --}}
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
                        <i style="top:{{ rand(2,90) }}%; left:{{ rand(2,98) }}%; animation-delay:{{ ($i*0.23) }}s; position:absolute; width:2px; height:2px; background:#fff; box-shadow:0 0 6px #fff; animation: prof-twinkle 3s ease-in-out infinite;"></i>
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

                {{-- Konten --}}
                <div class="relative z-10 text-left">
                    <p class="mb-1.5 text-xs font-semibold uppercase tracking-widest text-sky-100" style="letter-spacing:0.12em;">
                        Misi Kamu
                    </p>
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <div class="flex items-baseline gap-2">
                                <span class="font-bold text-white" style="font-size:48px;line-height:1;font-family: 'JetBrains Mono', monospace;">{{ count($this->getMissionsData()) }}</span>
                            </div>
                            <p class="mt-1 text-sm font-medium text-sky-100">misi sedang berjalan</p>
                        </div>
                        @php $stats = $this->getStats(); @endphp
                        <div class="flex gap-4 sm:gap-8 border-t border-white/20 sm:border-none pt-4 sm:pt-0 mt-2 sm:mt-0">
                            <div class="text-center">
                                <p class="text-2xl font-bold font-mono text-white">{{ $stats['selesai'] }}</p>
                                <p class="text-xs text-sky-100">Selesai</p>
                            </div>
                            <div class="hidden w-px bg-white/20 sm:block"></div>
                            <div class="text-center">
                                <p class="text-2xl font-bold font-mono text-white">{{ $stats['aktif'] }}</p>
                                <p class="text-xs text-sky-100">Aktif</p>
                            </div>
                            <div class="hidden w-px bg-white/20 sm:block"></div>
                            <div class="text-center">
                                <p class="text-2xl font-bold font-mono text-white">{{ $stats['pending'] >= 0 ? '+' : '' }}{{ $stats['pending'] }}</p>
                                <p class="text-xs text-sky-100">Pts Pending</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Animated waves --}}
                <div class="prof-waves" style="position:absolute; left:0; right:0; bottom:0; height:80px; overflow:hidden; pointer-events:none; opacity:.35; mask-image: linear-gradient(180deg, transparent, #000 60%);">
                    <svg viewBox="0 0 2400 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:200%; height:100%; display:block; animation: prof-wave 14s linear infinite;">
                        <path d="M0,40 C150,80 350,0 600,40 C850,80 1050,0 1200,40 C1350,80 1550,0 1800,40 C2050,80 2250,0 2400,40 L2400,80 L0,80 Z" fill="rgba(255,255,255,0.18)"/>
                    </svg>
                </div>
            </div>

            {{-- ── Judul Seksi ──────────────────────────────────── --}}
            <div>
                <h2 class="text-lg font-bold text-slate-800" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    Aplikasi yang Saya Submit
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">
                    {{ count($this->getMissionsData()) }} misi sedang berjalan
                </p>
            </div>

            {{-- ── Kartu Misi (Responsive Grid) ─────────────────── --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($this->getMissionsData() as $mission)
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 transition-all hover:-translate-y-1 hover:shadow-lg" style="box-shadow: 0 1px 3px rgba(0,0,0,0.05);">

                        {{-- Header kartu --}}
                        <div class="mb-4 flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                {{-- Avatar inisial atau Logo --}}
                                @if($mission['logo'])
                                    <img src="/storage/{{ $mission['logo'] }}" alt="Logo" class="flex h-11 w-11 flex-shrink-0 object-cover rounded-xl shadow-sm">
                                @else
                                    <div
                                        class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl text-sm font-bold text-white shadow-sm"
                                        style="background-color: {{ $mission['color'] }}">
                                        {{ $mission['initials'] }}
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-bold text-slate-800" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                                        {{ $mission['name'] }}
                                    </p>
                                    <p class="text-xs text-slate-500">
                                        {{ $mission['type'] }}
                                    </p>
                                </div>
                            </div>
                            {{-- Badge status --}}
                            @if($mission['ma_status'] === 'failed')
                                <span class="rounded-lg bg-red-50 px-2 py-0.5 text-xs font-semibold text-red-600 border border-red-200">
                                    {{ $mission['status'] }}
                                </span>
                            @else
                                <span class="rounded-lg bg-green-50 px-2 py-0.5 text-xs font-semibold text-green-600">
                                    {{ $mission['status'] }}
                                </span>
                            @endif
                        </div>

                        {{-- Progress bar --}}
                        <div class="mb-4">
                            <div class="mb-1.5 flex items-center justify-between text-xs">
                                <span class="font-medium text-slate-500">
                                    <span class="font-bold text-slate-800" style="font-family: 'JetBrains Mono', monospace;">Day {{ $mission['day'] }}</span> of {{ $mission['total_days'] }}
                                </span>
                                <span class="font-semibold" style="font-family: 'JetBrains Mono', monospace; color: {{ $mission['color'] }}">{{ $mission['progress'] }}%</span>
                            </div>
                            <div class="h-1.5 w-full overflow-hidden rounded-full bg-slate-200">
                                <div
                                    class="h-1.5 rounded-full transition-all duration-500"
                                    style="width: {{ $mission['progress'] }}%; background-color: {{ $mission['color'] }}">
                                </div>
                            </div>
                        </div>

                        {{-- 14 Days History --}}
                        <div class="mb-5 border-t border-slate-100 pt-3">
                            <div class="flex justify-between items-center text-[10px] font-bold text-slate-400 mb-1.5 uppercase tracking-wider">
                                <span>Tracker 14 Hari</span>
                            </div>
                            <div class="flex gap-1">
                                @for ($h = 1; $h <= 14; $h++)
                                    @php
                                        $hist = $mission['days_history'][$h] ?? 'notdone';
                                        $isToday = ($h == $mission['day']);
                                        
                                        $cellClass = 'bg-slate-100 border border-transparent text-slate-400'; // Default / Future
                                        
                                        if ($hist === 'done') {
                                            $cellClass = 'bg-emerald-100 border border-emerald-200 text-emerald-600';
                                        } elseif ($hist === 'pending') {
                                            $cellClass = 'bg-amber-100 border border-amber-200 text-amber-600';
                                        } elseif ($hist === 'rejected') {
                                            $cellClass = 'bg-red-100 border border-red-200 text-red-600';
                                        } else {
                                            if ($mission['ma_status'] === 'failed' || $h < $mission['day']) {
                                                // Missed
                                                $cellClass = 'bg-slate-50 border border-red-100 text-red-400 opacity-60';
                                            }
                                        }
                                        
                                        // Highlight today
                                        if ($isToday && $mission['ma_status'] !== 'failed') {
                                            if ($hist === 'notdone') {
                                                $cellClass = 'bg-blue-500 border-blue-600 text-white shadow-sm ring-1 ring-blue-300 ring-offset-1';
                                            } else {
                                                $cellClass .= ' ring-1 ring-offset-1 ring-slate-300';
                                            }
                                        }
                                    @endphp
                                    <div class="flex-1 flex items-center justify-center rounded-[4px] h-5 text-[9px] font-bold transition-all {{ $cellClass }}" title="Hari {{ $h }}: {{ strtoupper($hist) }}">
                                        {{ $h }}
                                    </div>
                                @endfor
                            </div>
                        </div>

                        {{-- Footer: poin + tombol --}}
                        <div class="flex items-center justify-between mt-2">
                            <span class="flex items-center gap-1 text-xs font-semibold text-emerald-500">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                +{{ $mission['points'] }} pts
                            </span>
                            @if ($mission['ma_status'] === 'failed')
                                <button
                                    disabled
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600 opacity-80 cursor-not-allowed">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Misi Gagal
                                </button>
                            @elseif ($mission['today_status'] === 'done')
                                <button
                                    disabled
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-600 opacity-80 cursor-not-allowed">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Hari Ini Selesai
                                </button>
                            @elseif ($mission['today_status'] === 'pending')
                                <button
                                    disabled
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-600 opacity-80 cursor-not-allowed">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Menunggu ACC
                                </button>
                            @elseif ($mission['today_status'] === 'rejected')
                                <button
                                    wire:click="openSubmitForm({{ $mission['id'] }})"
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600 transition-colors hover:bg-red-100 disabled:opacity-60">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Upload Ulang (Ditolak)
                                </button>
                            @else
                                <button
                                    wire:click="openSubmitForm({{ $mission['id'] }})"
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 transition-colors hover:bg-slate-100 disabled:opacity-60">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Submit Task
                                </button>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>

        </div>

    {{-- ================================================================
         VIEW 2: FORM SUBMIT TASK (RESPONSIVE)
    ================================================================ --}}
    @else
        @php $mission = $this->getSelectedMission(); @endphp

        @if ($mission)
            <div class="mx-auto w-full max-w-5xl space-y-6" style="font-family: 'Inter', sans-serif;">

                {{-- ── Header dengan tombol kembali ────────────── --}}
                <div class="flex items-center gap-4 border-b border-slate-200 pb-4">
                    <button
                        wire:click="backToList"
                        class="rounded-xl border border-slate-200 bg-white p-2.5 text-slate-600 shadow-sm transition-colors hover:bg-slate-50 hover:text-slate-900">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-slate-800" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                            Submit Daily Task
                        </h1>
                        <p class="text-sm text-slate-500">Unggah bukti pengerjaan tugas hari ini.</p>
                    </div>
                </div>

                {{-- ── Layout Grid Responsive ───────────────────── --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                    
                    {{-- Kolom Kiri: Info & Instruksi --}}
                    <div class="lg:col-span-5 space-y-5">
                        {{-- Info Aplikasi --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <h3 class="mb-3 text-sm font-bold text-slate-800 uppercase tracking-wider">Detail Misi</h3>
                            <div class="flex items-center gap-4 rounded-xl bg-slate-50 p-4">
                                @if($mission['logo'])
                                    <img src="/storage/{{ $mission['logo'] }}" alt="Logo" class="flex h-14 w-14 flex-shrink-0 object-cover rounded-xl shadow-sm">
                                @else
                                    <div
                                        class="flex h-14 w-14 items-center justify-center rounded-xl text-lg font-bold text-white shadow-sm"
                                        style="background-color: {{ $mission['color'] }}">
                                        {{ $mission['initials'] }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold text-slate-800 text-base">{{ $mission['name'] }}</p>
                                    <p class="text-sm font-medium text-slate-500 mt-0.5">Day {{ $mission['day'] }} of {{ $mission['total_days'] }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- App Download Link --}}
                        @if(!empty($mission['link_aplikasi']))
                        <div class="rounded-2xl border border-blue-200 bg-blue-50 p-5 shadow-sm">
                            <h3 class="mb-2 text-sm font-bold text-blue-800 uppercase tracking-wider">Akses Aplikasi</h3>
                            <p class="text-sm text-blue-700 mb-4">
                                Silakan download dan buka aplikasi yang akan diuji melalui link berikut:
                            </p>
                            <a href="{{ $mission['link_aplikasi'] }}" target="_blank" class="w-full flex items-center justify-center gap-2 rounded-xl bg-white border border-blue-300 py-3 text-sm font-bold text-blue-700 shadow-sm transition-colors hover:bg-blue-100">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Buka Link Aplikasi
                            </a>
                        </div>
                        @else
                        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
                            <h3 class="mb-2 text-sm font-bold text-amber-800 uppercase tracking-wider">Menunggu Link</h3>
                            <p class="text-sm text-amber-700">
                                Developer belum memberikan link aplikasi. Mohon tunggu.
                            </p>
                        </div>
                        @endif

                        {{-- Instruksi --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <h3 class="mb-4 text-sm font-bold text-slate-800 uppercase tracking-wider">Instructions</h3>
                            <div class="space-y-4">
                                @foreach ([
                                    'Buka aplikasi dan mainkan selama 10–15 menit.',
                                    'Ambil screenshot layar yang menunjukkan aktivitasmu.',
                                    'Unggah screenshot di form yang disediakan.',
                                ] as $i => $instruction)
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-blue-50 text-xs font-bold text-blue-600">
                                            {{ $i + 1 }}
                                        </div>
                                        <p class="text-sm text-slate-600 leading-relaxed pt-0.5">
                                            {{ $instruction }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Area Upload --}}
                    <div class="lg:col-span-7 space-y-5">
                        
                        {{-- Peringatan Penting --}}
                        <div class="flex items-start gap-3 rounded-2xl border border-amber-200 bg-amber-50 p-4 shadow-sm">
                            <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="text-sm text-amber-700 leading-relaxed">
                                <span class="font-bold">Important:</span>
                                You must play the app for 10–15 minutes before capturing! Screenshots that don't meet the criteria will be rejected.
                            </p>
                        </div>

                        {{-- Area Upload Screenshot --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="mb-4 text-sm font-bold text-slate-800 uppercase tracking-wider">Upload Screenshot</h3>
                            
                            {{ $this->form }}

                        </div>

                        {{-- Tombol Submit --}}
                        <div class="pt-2">
                            <button
                                wire:click="submitTask"
                                wire:loading.attr="disabled"
                                wire:loading.class="cursor-not-allowed opacity-70"
                                class="w-full rounded-2xl bg-blue-600 py-4 text-base font-bold text-white shadow-md shadow-blue-500/20 transition-all hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-500/30 active:translate-y-0.5">

                                <span wire:loading.remove wire:target="submitTask" class="flex justify-center items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Submit Task Sekarang
                                </span>

                                <span wire:loading wire:target="submitTask" class="flex items-center justify-center gap-2">
                                    <svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                    </svg>
                                    Submitting...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    @endif

</x-filament-panels::page>