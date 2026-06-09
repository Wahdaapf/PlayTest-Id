@php
    $pakets = \App\Models\Paket::where('aktif', true)->get();

    $count = $pakets->count();
    $gridClass = 'md:grid-cols-3';
    if ($count === 1) {
        $gridClass = 'md:grid-cols-1 max-w-md mx-auto';
    } elseif ($count === 2) {
        $gridClass = 'md:grid-cols-2 max-w-3xl mx-auto';
    }
@endphp

{{-- ══════════════════════════════════════════════════════════════
     PACKAGE SELECTION — Midnight Aurora Theme
     • Glassmorphism cards with animated gradient borders
     • Conic shimmer on selected state
     • Floating icon, parallax hover, ripple selection
   ══════════════════════════════════════════════════════════════ --}}

<style>
    @keyframes aurora-border-shift {
        0%, 100% { background-position: 0% 50%; }
        50%      { background-position: 100% 50%; }
    }
    @keyframes aurora-float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50%      { transform: translateY(-6px) rotate(3deg); }
    }
    @keyframes aurora-pop {
        0%   { transform: scale(0) rotate(-180deg); opacity: 0; }
        60%  { transform: scale(1.2) rotate(10deg); opacity: 1; }
        100% { transform: scale(1) rotate(0deg); opacity: 1; }
    }
    @keyframes aurora-shimmer {
        0%   { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    @keyframes aurora-pulse-ring {
        0%   { box-shadow: 0 0 0 0 rgba(99,102,241,.5); }
        70%  { box-shadow: 0 0 0 14px rgba(99,102,241,0); }
        100% { box-shadow: 0 0 0 0 rgba(99,102,241,0); }
    }

    .aurora-card {
        background:
            linear-gradient(180deg, rgba(255,255,255,.85), rgba(255,255,255,.65));
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
    }
    .dark .aurora-card {
        background:
            linear-gradient(180deg, rgba(30,27,75,.55), rgba(15,23,42,.65));
    }

    .aurora-card[data-selected="true"] {
        background:
            radial-gradient(120% 80% at 0% 0%, rgba(99,102,241,.18), transparent 60%),
            radial-gradient(120% 80% at 100% 100%, rgba(34,211,238,.16), transparent 60%),
            linear-gradient(180deg, rgba(255,255,255,.9), rgba(238,242,255,.85));
    }

    @keyframes ah-aurora-shift {
        0%, 100% { background-position: 0% 50%; }
        50%      { background-position: 100% 50%; }
    }
    @keyframes ah-float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50%      { transform: translateY(-8px) rotate(-3deg); }
    }
    @keyframes ah-pulse-ring {
        0%   { box-shadow: 0 0 0 0 rgba(99,102,241,.45); }
        70%  { box-shadow: 0 0 0 18px rgba(99,102,241,0); }
        100% { box-shadow: 0 0 0 0 rgba(99,102,241,0); }
    }
    .ah-header {
        background:
            radial-gradient(120% 100% at 0% 0%, rgba(99,102,241,.22), transparent 60%),
            radial-gradient(120% 100% at 100% 100%, rgba(34,211,238,.22), transparent 60%),
            linear-gradient(120deg, #6366f1, #a855f7, #22d3ee, #6366f1);
        background-size: 200% 200%, 200% 200%, 300% 300%;
        animation: ah-aurora-shift 10s ease-in-out infinite;
    }
    .ah-icon-wrap {
        animation: ah-float 4s ease-in-out infinite;
    }
    .ah-icon-pulse {
        animation: ah-pulse-ring 2.2s ease-out infinite;
    }
    .dark .aurora-card[data-selected="true"] {
        background:
            radial-gradient(120% 80% at 0% 0%, rgba(99,102,241,.35), transparent 60%),
            radial-gradient(120% 80% at 100% 100%, rgba(34,211,238,.25), transparent 60%),
            linear-gradient(180deg, rgba(30,27,75,.7), rgba(15,23,42,.85));
    }

    /* Animated gradient border on selected */
    .aurora-border::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 1.25rem;
        padding: 2px;
        background: linear-gradient(120deg, #6366f1, #a855f7, #22d3ee, #6366f1, #a855f7);
        background-size: 300% 300%;
        -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
                mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
        -webkit-mask-composite: xor;
                mask-composite: exclude;
        opacity: 0;
        transition: opacity .4s ease;
        animation: aurora-border-shift 6s ease-in-out infinite;
        pointer-events: none;
    }
    .aurora-border[data-selected="true"]::before { opacity: 1; }

    .aurora-icon-float { animation: aurora-float 3.5s ease-in-out infinite; }
    .aurora-check-pop  { animation: aurora-pop .5s cubic-bezier(.34,1.56,.64,1) both; }
    .aurora-pulse      { animation: aurora-pulse-ring 1.8s ease-out infinite; }

    .aurora-popular {
        background: linear-gradient(90deg, #6366f1, #a855f7, #22d3ee, #6366f1);
        background-size: 200% 100%;
        animation: aurora-shimmer 3s linear infinite;
    }

    .aurora-price {
        background: linear-gradient(135deg, #4f46e5 0%, #a855f7 50%, #06b6d4 100%);
        -webkit-background-clip: text;
                background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    @keyframes ps-border-shift {
        0%, 100% { background-position: 0% 50%; }
        50%      { background-position: 100% 50%; }
    }
    .ps-panel {
        position: relative;
        background: linear-gradient(180deg, rgba(255,255,255,.88), rgba(255,255,255,.72));
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 1.5rem;
        overflow: hidden;
    }
    .dark .ps-panel {
        background: linear-gradient(180deg, rgba(30,27,75,.55), rgba(15,23,42,.7));
    }
    .ps-panel::before {
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
        animation: ps-border-shift 8s ease-in-out infinite;
        pointer-events: none;
    }
</style>

<div x-data="{ selectedId: @entangle('data.id_paket') }" class="ps-panel p-6 md:p-8 shadow-[0_20px_60px_-20px_rgba(99,102,241,0.45)] dark:shadow-[0_20px_60px_-20px_rgba(0,0,0,0.8)] max-w-7xl mx-auto space-y-6">

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
            <div class="ah-icon-wrap shrink-0">
                <div class="ah-icon-pulse w-14 h-14 md:w-16 md:h-16 rounded-2xl bg-white/10 dark:bg-slate-900/40 backdrop-blur-md border border-white/20 grid place-content-center shadow-xl">
                    <x-heroicon-o-cube class="w-8 h-8 text-white stroke-[1.8]" />
                </div>
            </div>
            <div class="flex-1 text-white">
                <h2 class="text-lg md:text-xl font-bold drop-shadow-sm">{{ __('Pilihan Paket Publikasi') }}</h2>
                <p class="text-white/85 text-sm mt-1.5 max-w-xl">{{ __('Pilih paket publikasi yang sesuai dengan kebutuhan pengujian aplikasi Anda. Dapatkan lebih banyak penguji dengan paket yang lebih besar.') }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 {{ $gridClass }} gap-5 sm:gap-7 p-2 w-full">
    @foreach($pakets as $paket)
        @php $id = $paket->id; @endphp

        <div
            x-on:click="selectedId = {{ $id }}"
            x-bind:data-selected="selectedId == {{ $id }} ? 'true' : 'false'"
            class="aurora-card aurora-border group relative cursor-pointer rounded-2xl border border-slate-200 dark:border-slate-800 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.08)] dark:shadow-none transition-all duration-500 ease-out flex flex-col h-full overflow-visible"
            :class="selectedId == {{ $id }}
                ? 'scale-[1.03] z-10 shadow-[0_20px_60px_-15px_rgba(99,102,241,0.45)] dark:shadow-[0_20px_60px_-15px_rgba(99,102,241,0.6)]'
                : 'hover:-translate-y-1.5 hover:shadow-[0_15px_40px_-15px_rgba(99,102,241,0.3)] dark:hover:shadow-[0_15px_40px_-15px_rgba(168,85,247,0.35)]'"
        >
            {{-- Badge Most Popular --}}
            @if($paket->most_popular)
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-30">
                    <span class="aurora-popular inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.15em] text-white shadow-lg shadow-indigo-500/40 ring-4 ring-white dark:ring-slate-950">
                        <x-heroicon-m-sparkles class="w-3.5 h-3.5" />
                        {{ __('Populer') }}
                    </span>
                </div>
            @endif

            <div class="p-4 sm:p-6 flex-grow flex flex-col relative z-20">
                {{-- Header row --}}
                <div class="flex items-start justify-between mb-4 sm:mb-6">
                    {{-- Floating icon --}}
                    <div class="relative">
                        <div
                            class="w-12 h-12 sm:w-16 sm:h-16 rounded-2xl flex items-center justify-center transition-all duration-500 aurora-icon-float"
                            :class="selectedId == {{ $id }}
                                ? 'bg-gradient-to-br from-indigo-500 via-violet-500 to-cyan-400 shadow-xl shadow-indigo-500/40'
                                : 'bg-gradient-to-br from-slate-100 to-slate-200 dark:from-white/5 dark:to-white/10 group-hover:from-indigo-100 group-hover:to-violet-100 dark:group-hover:from-indigo-500/20 dark:group-hover:to-violet-500/20'"
                        >
                            <x-heroicon-o-cube-transparent
                                class="w-6 h-6 sm:w-8 sm:h-8 transition-all duration-500"
                                x-bind:class="selectedId == {{ $id }}
                                    ? 'text-white drop-shadow'
                                    : 'text-slate-400 dark:text-slate-500 group-hover:text-indigo-500 dark:group-hover:text-indigo-400'"
                            />
                        </div>
                        {{-- Glow halo when selected --}}
                        <div
                            x-show="selectedId == {{ $id }}"
                            x-transition.opacity.duration.700ms
                            class="absolute inset-0 rounded-2xl bg-gradient-to-br from-indigo-500 to-cyan-400 blur-xl opacity-50 -z-10"
                        ></div>
                    </div>

                    {{-- Selection indicator --}}
                    <div
                        class="w-8 h-8 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all duration-300"
                        :class="selectedId == {{ $id }}
                            ? 'bg-gradient-to-br from-indigo-500 to-violet-500 border-transparent aurora-pulse'
                            : 'border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-white/5 group-hover:border-indigo-300 dark:group-hover:border-indigo-500/50'"
                    >
                        <template x-if="selectedId == {{ $id }}">
                            <x-heroicon-m-check class="w-5 h-5 stroke-[3] text-white aurora-check-pop" />
                        </template>
                    </div>
                </div>

                {{-- Name --}}
                <h3
                    class="text-base sm:text-xl font-black tracking-tight transition-colors duration-300"
                    :class="selectedId == {{ $id }}
                        ? 'text-indigo-700 dark:text-white'
                        : 'text-slate-800 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-300'"
                >
                    {{ $paket->name ?? $paket->desc ?? __('Paket') . " #{$id}" }}
                </h3>

                {{-- Description --}}
                <p class="mt-1.5 text-xs sm:text-sm leading-relaxed line-clamp-2 text-slate-500 dark:text-slate-400">
                    {{ $paket->short_desc ?? strip_tags($paket->desc) ?? __('Ideal untuk pengujian aplikasi standar dengan hasil maksimal.') }}
                </p>

                <div class="mt-auto pt-5 sm:pt-7">
                    {{-- Price --}}
                    <div class="flex items-baseline gap-1.5 mb-4">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-500">Rp</span>
                        <span class="aurora-price text-2xl sm:text-4xl font-black tracking-tighter">
                            {{ number_format($paket->price, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- Reward chip --}}
                    <div class="flex items-center justify-between p-3 rounded-xl border transition-all duration-300 backdrop-blur"
                         :class="selectedId == {{ $id }}
                            ? 'bg-white/60 dark:bg-white/10 border-indigo-200/60 dark:border-indigo-400/30'
                            : 'bg-slate-50/70 dark:bg-white/5 border-slate-200/60 dark:border-white/5 group-hover:border-indigo-200 dark:group-hover:border-indigo-500/30'">
                        <div class="flex items-center gap-2">
                            <div class="p-1.5 rounded-lg bg-gradient-to-br from-cyan-400 to-emerald-400 shadow shadow-cyan-500/30">
                                <x-heroicon-m-bolt class="w-3.5 h-3.5 text-white" />
                            </div>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-200">
                                +{{ $paket->point }} {{ __('Poin') }}
                            </span>
                        </div>
                        <x-heroicon-m-arrow-right
                            class="w-4 h-4 transition-all duration-300"
                            x-bind:class="selectedId == {{ $id }}
                                ? 'text-indigo-500 translate-x-0.5'
                                : 'text-slate-300 dark:text-slate-600 group-hover:text-indigo-400 group-hover:translate-x-0.5'"
                        />
                    </div>
                </div>
            </div>

            {{-- Bottom aurora bar --}}
            <div
                class="absolute bottom-0 inset-x-4 h-[3px] rounded-full transition-all duration-500"
                :class="selectedId == {{ $id }}
                    ? 'bg-gradient-to-r from-indigo-500 via-violet-500 to-cyan-400 opacity-100'
                    : 'opacity-0'"
            ></div>
        </div>
    @endforeach
    </div>
</div>
