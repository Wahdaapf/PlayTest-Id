{{--
    Developer List Misis (My Apps)
    Mirroring the Admin Manajemen Kampanye Style
--}}

<x-filament-panels::page>

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<style>
    body, .fi-main, .fi-simple-main { font-family: 'Inter', sans-serif !important; }
    .mp-sora { font-family: 'Inter', sans-serif !important; }
    .mp-mono  { font-family: 'Inter', sans-serif !important; }
    .fi-main  { background-color: #f8fafc !important; }
    [x-cloak] { display: none !important; }

    /* ══ ANIMATIONS ══ */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }

    /* ══ STAT CARDS ══ */
    .mp-stat {
        background: #fff; border-radius: 14px; padding: 18px 20px;
        border: 1px solid #e2e8f0; position: relative; overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .mp-stat:hover { transform: translateY(-5px); box-shadow: 0 15px 30px -10px rgba(0,0,0,.1); }
    .mp-stat::after {
        content: ''; position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg); transition: 0.75s; z-index: 1; pointer-events: none;
    }
    .mp-stat:hover::after { left: 125%; }
    .mp-stat-accent { position: absolute; top: 0; left: 0; right: 0; height: 3px; }
    .mp-stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: transform 0.3s ease; }
    .mp-stat:hover .mp-stat-icon { transform: scale(1.1) rotate(5deg); }
    .mp-stat-label { font-size: .72rem; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; }
    .mp-stat-value { font-size: 1.4rem; font-weight: 800; color: #0f172a; line-height: 1.1; }
    .mp-stat-sub   { font-size: .72rem; color: #94a3b8; margin-top: 2px; }
    .mp-grad-blue    { background: linear-gradient(90deg, #2563eb, #60a5fa); }
    .mp-grad-green   { background: linear-gradient(90deg, #10b981, #34d399); }
    .mp-grad-amber   { background: linear-gradient(90deg, #f59e0b, #fcd34d); }
    .mp-grad-purple  { background: linear-gradient(90deg, #7c3aed, #a78bfa); }
    .mp-bg-blue    { background: #eff6ff; color: #2563eb; }
    .mp-bg-green   { background: #d1fae5; color: #10b981; }
    .mp-bg-amber   { background: #fef9c3; color: #f59e0b; }
    .mp-bg-purple  { background: #f5f3ff; color: #7c3aed; }

    /* ══ FILTER BAR ══ */
    .mp-filter-bar { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; display: flex; flex-wrap: wrap; gap: 10px; align-items: center; transition: box-shadow 0.3s; }
    .mp-filter-bar:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
    .mp-search-wrap { position: relative; flex: 2; min-width: 200px; }
    .mp-search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 1.2rem; transition: color 0.2s; }
    .mp-search-wrap:focus-within .mp-search-icon { color: #2563eb; }
    .mp-input, .mp-select { border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 14px; font-size: .85rem; color: #334155; background: #f8fafc; outline: none; transition: all .2s; font-family: 'Inter', sans-serif; }
    .mp-input:focus, .mp-select:focus { border-color: #2563eb; background: #fff; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
    .mp-search-input { width: 100%; padding-left: 42px !important; }
    .mp-filter-divider { width: 1px; height: 20px; background: #e2e8f0; flex-shrink: 0; }

    /* ══ BUTTONS ══ */
    .mp-btn { padding: 8px 16px; border-radius: 8px; font-size: .85rem; font-weight: 600; cursor: pointer; border: none; transition: all .15s cubic-bezier(0.4,0,0.2,1); font-family: 'Inter', sans-serif; display: inline-flex; align-items: center; gap: 6px; justify-content: center; }
    .mp-btn:active { transform: scale(0.95); }
    .mp-btn-primary { background: #2563eb; color: #fff; }
    .mp-btn-primary:hover { background: #1d4ed8; box-shadow: 0 6px 16px rgba(37,99,235,0.2); transform: translateY(-1px); }
    .mp-btn-ghost { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
    .mp-btn-ghost:hover { background: #e2e8f0; color: #1e293b; }

    /* ══ VIEW TOGGLE ══ */
    .mk-view-toggle { display: flex; align-items: center; padding: 4px; border-radius: 10px; background: #f1f5f9; gap: 2px; }
    .mk-view-btn { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; border-radius: 7px; font-size: .8rem; font-weight: 600; cursor: pointer; transition: all 0.15s ease; border: none; font-family: 'Inter', sans-serif; }
    .mk-view-active   { background: #2563eb; color: #fff; box-shadow: 0 2px 8px rgba(37,99,235,0.3); }
    .mk-view-inactive { background: transparent; color: #64748b; }
    .mk-view-inactive:hover { color: #334155; background: #e2e8f0; }

    /* ══ CAMPAIGN CARD ══ */
    .mk-card {
        background: #fff; border-radius: 14px;
        border: 1px solid #e2e8f0; border-left-width: 4px;
        overflow: hidden; transition: transform 0.25s ease, box-shadow 0.25s ease;
        position: relative;
    }
    .mk-card:hover { transform: translateY(-3px); box-shadow: 0 12px 28px -8px rgba(0,0,0,0.12); }
    .mk-card::after {
        content: ''; position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.35) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg); transition: 0.75s; z-index: 1; pointer-events: none;
    }
    .mk-card:hover::after { left: 125%; }

    /* Timeline dots */
    .mk-dot { width: 7px; height: 7px; border-radius: 9999px; flex-shrink: 0; }
    .mk-dot-filled-blue  { background: #2563eb; }
    .mk-dot-filled-green { background: #16a34a; }
    .mk-dot-filled-amber { background: #f59e0b; }
    .mk-dot-empty        { background: #e2e8f0; }

    /* Progress */
    .mk-progress-track { background: #e2e8f0; border-radius: 9999px; overflow: hidden; }
    .mk-progress-fill  { height: 100%; border-radius: 9999px; transition: width 0.8s cubic-bezier(.4,0,.2,1); }

    /* Badges */
    .mk-badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 8px; font-size: 0.7rem; font-weight: 600; white-space: nowrap; }
    .mk-badge-running  { background: #eff6ff; color: #1d4ed8; }
    .mk-badge-completed{ background: #f0fdf4; color: #15803d; }
    .mk-badge-pending  { background: #fffbeb; color: #b45309; }
    .mk-badge-closed   { background: #fff1f2; color: #be123c; }
    .mk-badge-active   { background: #f0fdf4; color: #15803d; }
    .mk-badge-open     { background: #f0fdf4; color: #15803d; }
    .mk-badge-pro      { background: #fffbeb; color: #b45309; }
    .mk-badge-starter  { background: #eff6ff; color: #1d4ed8; }

    /* Action buttons (card & list) */
    .mk-action-btn { position: relative; width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s ease; border: 1px solid transparent; }
    .mk-action-btn:hover { transform: scale(1.08); }
    .mk-btn-detail  { background: #eff6ff; border-color: #bfdbfe; color: #2563eb; }
    .mk-btn-detail:hover  { background: #dbeafe; }
    .mk-btn-edit    { background: #fef9c3; border-color: #fef08a; color: #d97706; }
    .mk-btn-edit:hover    { background: #fef08a; }
    .mk-btn-users   { background: #f0fdf4; border-color: #bbf7d0; color: #16a34a; }
    .mk-btn-users:hover   { background: #dcfce7; }
    .mk-btn-start   { background: #eff6ff; border-color: #bfdbfe; color: #2563eb; }
    .mk-btn-start:hover   { background: #dbeafe; }

    /* ══ SORT HEADER BUTTON ══ */
    .mk-sort-btn { display: inline-flex; align-items: center; gap: 3px; background: none; border: none; cursor: pointer; font-size: .72rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: .07em; padding: 0; transition: color 0.2s; font-family: 'Inter', sans-serif; white-space: nowrap; }
    .mk-sort-btn:hover  { color: #0f172a; }
    .mk-sort-btn.active { color: #0f172a; }
    .mk-sort-icon { font-size: .95rem !important; line-height: 1; }

    /* ══ LIST VIEW ══ */
    .mk-list-row {
        display: flex; align-items: center; gap: 1rem;
        padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s ease;
    }
    .mk-list-row td:first-child { border-left: 3px solid transparent; transition: border-color 0.2s; }
    .mk-list-row:hover { background: #f8fafc; }
    .mk-list-row:hover { border-left: 3px solid #2563eb; padding-left: calc(1.25rem - 3px); }
    .mk-list-row:last-child { border-bottom: none; }

    /* ══ EMPTY STATE ══ */
    .mp-empty { padding: 48px 20px; text-align: center; }
    .mp-empty-icon { width: 56px; height: 56px; background: #f1f5f9; border-radius: 16px; margin: 0 auto 14px; display: flex; align-items: center; justify-content: center; }

    /* ══ MODAL ══ */
    .mk-modal-overlay  { position: fixed; inset: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 1rem; }
    .mk-modal-backdrop { position: absolute; inset: 0; background: rgba(15,23,42,0.6); backdrop-filter: blur(4px); }
    .mk-modal-box      { position: relative; z-index: 1; background: #fff; border-radius: 20px; box-shadow: 0 25px 60px rgba(0,0,0,0.2); width: 100%; max-width: 560px; overflow: hidden; }
    .mk-modal-header   { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; }
    .mk-modal-body     { padding: 1.5rem; }
    .mk-modal-footer   { display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9; background: #f8fafc; }
    .mk-detail-row     { display: flex; align-items: flex-start; gap: 0.75rem; padding: 0.625rem 0; border-bottom: 1px solid #f8fafc; }
    .mk-detail-row:last-child { border-bottom: none; }
    .mk-detail-label   { font-size: 0.75rem; color: #94a3b8; font-weight: 500; width: 130px; flex-shrink: 0; padding-top: 1px; }
    .mk-detail-value   { font-size: 0.8125rem; color: #1e293b; font-weight: 500; flex: 1; }

    /* ══ RESPONSIVE ══ */
    @media (max-width: 640px) {
        .mp-filter-bar { flex-direction: column; align-items: stretch; }
        .mp-search-wrap, .mp-select, .mp-btn-ghost { width: 100%; max-width: 100% !important; }
        .mp-filter-divider { display: none; }
        .mk-view-toggle { width: 100%; }
        .mk-view-btn { flex: 1; justify-content: center; }
        
        .mk-modal-footer { flex-direction: column; align-items: stretch; }
        .mk-modal-footer button { width: 100%; justify-content: center; }
        .mk-modal-footer .flex { flex-direction: column; width: 100%; }
    }
</style>
@endpush


{{-- ══════════════════════════════════════════════════
     ALPINE ROOT
══════════════════════════════════════════════════ --}}
<div class="space-y-5" x-data="listMisisApp()" @keydown.escape.window="tutupModal(); modalMulaiTerbuka = false" @close-modal-mulai.window="modalMulaiTerbuka = false">
    <div id="kampanye-data" style="display:none;" data-list="{{ json_encode($kampanyeList) }}"></div>

{{-- ── PAGE HEADER ──────────────────────────────── --}}
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between animate-fade-in-up gap-4 sm:gap-0">
    <div class="w-full sm:w-auto">
        <h1 class="mp-sora text-xl font-bold text-slate-900">{{ __('Aplikasi Saya') }}</h1>
        <p class="text-sm text-slate-500 mt-0.5">
            {{ __('Kelola dan pantau aplikasi serta misi yang Anda buat') }}
        </p>
    </div>
    <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 w-full sm:w-auto">
        {{-- View Toggle Grid/List --}}
        <div class="mk-view-toggle">
            <button class="mk-view-btn"
                    :class="viewMode === 'grid' ? 'mk-view-active' : 'mk-view-inactive'"
                    @click="viewMode = 'grid'">
                <span class="material-symbols-outlined text-[.95rem]">grid_view</span>
                {{ __('Kotak') }}
            </button>
            <button class="mk-view-btn"
                    :class="viewMode === 'list' ? 'mk-view-active' : 'mk-view-inactive'"
                    @click="viewMode = 'list'">
                <span class="material-symbols-outlined text-[.95rem]">view_list</span>
                {{ __('List') }}
            </button>
        </div>
        {{-- Buat Misi --}}
        <a href="{{ \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('create') }}" class="mp-btn mp-btn-primary w-full sm:w-auto justify-center">
            <span class="material-symbols-outlined text-[1.1rem]">add</span>
            {{ __('Buat Misi Baru') }}
        </a>
    </div>
</div>

{{-- ── STAT CARDS ──────────────────────────────── --}}
<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 animate-fade-in-up delay-100">

    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-blue"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-blue">
                <span class="material-symbols-outlined">apps</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="mp-stat-label">{{ __('Total Aplikasi') }}</div>
                <div class="mp-stat-value">{{ $statTotal }}</div>
                <div class="mp-stat-sub">{{ __('aplikasi didaftarkan') }}</div>
            </div>
        </div>
    </div>

    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-green"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-green">
                <span class="material-symbols-outlined">play_circle</span>
            </div>
            <div>
                <div class="mp-stat-label">{{ __('Berjalan') }}</div>
                <div class="mp-stat-value">{{ $statRunning }}</div>
                <div class="mp-stat-sub">{{ __('misi sedang aktif') }}</div>
            </div>
        </div>
    </div>

    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-amber"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-amber">
                <span class="material-symbols-outlined">groups</span>
            </div>
            <div>
                <div class="mp-stat-label">{{ __('Total Tester') }}</div>
                <div class="mp-stat-value">{{ $statTesters }}</div>
                <div class="mp-stat-sub">{{ __('orang sedang menguji') }}</div>
            </div>
        </div>
    </div>

    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-purple"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-purple">
                <span class="material-symbols-outlined">monetization_on</span>
            </div>
            <div>
                <div class="mp-stat-label">{{ __('Total Poin') }}</div>
                <div class="mp-stat-value mp-mono">{{ number_format($statPoints, 0, ',', '.') }}</div>
                <div class="mp-stat-sub">{{ __('poin dikeluarkan') }}</div>
            </div>
        </div>
    </div>

</div>

{{-- ── FILTER BAR ───────────────────────────────── --}}
<div class="mp-filter-bar animate-fade-in-up delay-200">

    {{-- Search --}}
    <div class="mp-search-wrap">
        <span class="material-symbols-outlined mp-search-icon">search</span>
        <input type="text" placeholder="{{ __('Cari nama aplikasi...') }}"
               x-model="cariTeks"
               class="mp-input mp-search-input">
    </div>

    <div class="mp-filter-divider"></div>

    {{-- Filter Status --}}
    <select x-model="filterStatus" class="mp-select">
        <option value="">{{ __('Semua Status') }}</option>
        <option value="running">{{ __('Berjalan') }}</option>
        <option value="pending">{{ __('Tertunda') }}</option>
        <option value="completed">{{ __('Selesai') }}</option>
        <option value="closed">{{ __('Ditutup') }}</option>
        <option value="open">{{ __('Terbuka') }}</option>
    </select>

    {{-- Urutkan --}}
    <select x-model="sortBy" class="mp-select">
        <option value="terbaru">{{ __('Terbaru') }}</option>
        <option value="terlama">{{ __('Terlama') }}</option>
        <option value="tester">{{ __('Tester Terbanyak') }}</option>
        <option value="progress">{{ __('Progres Tertinggi') }}</option>
        <option value="nama">{{ __('Nama A-Z') }}</option>
    </select>

    {{-- Reset --}}
    <button @click="resetFilter()" class="mp-btn mp-btn-ghost">
        {{ __('Reset') }}
    </button>

    {{-- Hasil count --}}
    <div class="sm:ml-auto text-sm font-medium text-slate-400 mt-2 sm:mt-0 text-center sm:text-left">
        <strong class="mp-mono text-slate-700" x-text="filteredCount()"></strong>
        {{ __('Aplikasi ditampilkan') }}
    </div>

</div>

{{-- ══════════════════════════════════════════════
     GRID VIEW
══════════════════════════════════════════════ --}}
<div x-show="viewMode === 'grid'"
     class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

    @foreach($kampanyeList as $idx => $k)
    @php
        $borderColor = match($k['raw_status']) {
            'running' => '#2563eb',
            'completed' => '#16a34a',
            'open' => '#16a34a',
            'pending' => '#f59e0b',
            'closed' => '#ef4444',
            default => '#94a3b8'
        };
        $progColor   = $borderColor;
        $dotClass    = match($k['raw_status']) {
            'running' => 'mk-dot-filled-blue',
            'completed' => 'mk-dot-filled-green',
            'open' => 'mk-dot-filled-green',
            'pending' => 'mk-dot-filled-amber',
            'closed' => 'mk-dot-empty',
            default => 'mk-dot-empty'
        };
        $pctTester   = $k['maxTester'] > 0 ? round($k['tester'] / $k['maxTester'] * 100) : 0;
    @endphp

    <div class="mk-card"
         style="border-left-color:{{ $borderColor }};"
         x-show="tampilKard('{{ $k['raw_status'] }}', '{{ strtolower($k['nama']) }}')">
        <div class="p-5">

            {{-- App info --}}
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    @if($k['logo'])
                        <img src="/storage/{{ $k['logo'] }}" alt="Logo" class="w-11 h-11 rounded-xl object-cover flex-shrink-0">
                    @else
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 text-lg font-bold text-white"
                             style="background:{{ $k['ikonGrad'] }};">
                            {{ $k['ikonHuruf'] }}
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-semibold mp-sora leading-tight" style="color:#1e293b;">{{ $k['nama'] }}</p>
                        <p class="text-xs mt-0.5" style="color:#64748b;">{{ $k['developer'] }}</p>
                    </div>
                </div>
                <span class="mk-badge mk-badge-{{ strtolower($k['raw_status']) }} flex-shrink-0">
                    <span class="w-1.5 h-1.5 rounded-full" style="background:{{ $borderColor }};"></span>
                    {{ $k['status'] }}
                </span>
            </div>

            {{-- Tester progress --}}
            <div class="mb-3">
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs font-medium" style="color:#64748b;">{{ __('Tester Bergabung') }}</span>
                    <span class="text-xs font-bold mp-mono" style="color:#1e293b;">
                        {{ $k['tester'] }}
                        <span style="color:#94a3b8;font-weight:400;">/ {{ $k['maxTester'] }}</span>
                    </span>
                </div>
                <div class="mk-progress-track h-2 w-full">
                    <div class="mk-progress-fill h-2" style="width:{{ $pctTester }}%;background:{{ $progColor }};"></div>
                </div>
            </div>

            {{-- Timeline --}}
            <div class="mb-3">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-medium" style="color:#64748b;">{{ __('Linimasa 14 Hari') }}</span>
                    @if($k['hariKe'] > 0)
                        <span class="text-xs mp-mono font-semibold" style="color:{{ $progColor }};">{{ __('Hari') }} {{ $k['hariKe'] }}</span>
                    @elseif($k['raw_status'] === 'pending')
                        <span class="text-xs mp-mono font-semibold" style="color:#b45309;">{{ __('Tertunda') }}</span>
                    @else
                        <span class="text-xs mp-mono font-semibold" style="color:#94a3b8;">-</span>
                    @endif
                </div>
                <div class="flex items-center gap-1">
                    @for($d = 1; $d <= 14; $d++)
                        <div class="mk-dot {{ $d <= $k['hariKe'] ? $dotClass : 'mk-dot-empty' }}"></div>
                    @endfor
                </div>
            </div>

            {{-- Tanggal --}}
            <div class="flex items-center gap-1.5 mb-4 text-xs mp-mono" style="color:#94a3b8;">
                <span class="material-symbols-outlined text-[.9rem]">calendar_month</span>
                {{ $k['mulai'] }} → {{ $k['selesai'] }}
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-2">


                <a href="{{ \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('edit', ['record' => $k['id']]) }}" class="mk-action-btn mk-btn-edit" title="{{ __('Edit') }}">
                    <span class="material-symbols-outlined text-[1rem]">edit</span>
                </a>

                <a href="{{ \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('kelola-tester', ['record' => $k['id']]) }}" class="mk-action-btn mk-btn-users" title="{{ __('Kelola Tester') }}">
                    <span class="material-symbols-outlined text-[1rem]">group</span>
                </a>

                @if($k['raw_status'] === 'closed')
                <button @click="bukaModalMulai({{ $k['id'] }})" class="mk-action-btn mk-btn-start" title="{{ __('Mulai Misi') }}">
                    <span class="material-symbols-outlined text-[1rem]">play_circle</span>
                </button>
                @endif
            </div>

        </div>
    </div>
    @endforeach

    {{-- Empty State --}}
    <div x-show="filteredCount() === 0" x-cloak class="col-span-3">
        <div class="mp-empty">
            <div class="mp-empty-icon">
                <span class="material-symbols-outlined text-slate-400 text-[1.8rem]">apps</span>
            </div>
            <p class="text-sm font-semibold text-slate-600">{{ __('Tidak ada aplikasi ditemukan') }}</p>
            <p class="text-xs mt-1 text-slate-400">{{ __('Coba ubah filter atau kata kunci pencarian') }}</p>
        </div>
    </div>

</div>{{-- end grid --}}


{{-- ══════════════════════════════════════════════
     LIST VIEW
══════════════════════════════════════════════ --}}
<div x-show="viewMode === 'list'"
     x-cloak
     class="bg-white rounded-2xl border border-slate-200 overflow-x-auto"
     style="box-shadow:0 4px 6px -1px rgba(0,0,0,0.02);">
    <div class="min-w-[900px]">

    {{-- List Header --}}
    <div class="mk-list-header flex items-center gap-4 px-5 py-3" style="background:#f8fafc;border-bottom:1px solid #e2e8f0;">
        <div class="w-56 flex-shrink-0">
            <button class="mk-sort-btn" :class="sortCol==='nama'?'active':''" @click="setSort('nama')">
                {{ __('Aplikasi') }}
                <span class="material-symbols-outlined mk-sort-icon"
                      x-text="sortCol!=='nama' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
            </button>
        </div>
        <div class="w-24 flex-shrink-0">
            <button class="mk-sort-btn" :class="sortCol==='status'?'active':''" @click="setSort('status')">
                {{ __('Status') }}
                <span class="material-symbols-outlined mk-sort-icon"
                      x-text="sortCol!=='status' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
            </button>
        </div>
        <div class="flex-1">
            <button class="mk-sort-btn" :class="sortCol==='tester'?'active':''" @click="setSort('tester')">
                {{ __('Tester') }}
                <span class="material-symbols-outlined mk-sort-icon"
                      x-text="sortCol!=='tester' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
            </button>
        </div>
        <div class="w-32 flex-shrink-0">
            <button class="mk-sort-btn" :class="sortCol==='timeline'?'active':''" @click="setSort('timeline')">
                {{ __('Linimasa') }}
                <span class="material-symbols-outlined mk-sort-icon"
                      x-text="sortCol!=='timeline' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
            </button>
        </div>
        <div class="w-24 flex-shrink-0">
            <button class="mk-sort-btn" :class="sortCol==='paket'?'active':''" @click="setSort('paket')">
                {{ __('Paket') }}
                <span class="material-symbols-outlined mk-sort-icon"
                      x-text="sortCol!=='paket' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
            </button>
        </div>
        <div class="w-28 flex-shrink-0">
            <button class="mk-sort-btn" :class="sortCol==='poin'?'active':''" @click="setSort('poin')">
                {{ __('Poin') }}
                <span class="material-symbols-outlined mk-sort-icon"
                      x-text="sortCol!=='poin' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
            </button>
        </div>
        <div class="w-32 flex-shrink-0 text-center">
            <span class="mk-sort-btn" style="cursor:default;pointer-events:none">{{ __('Aksi') }}</span>
        </div>
    </div>

    @foreach($kampanyeList as $idx => $k)
    @php
        $borderColor = match($k['raw_status']) {
            'running' => '#2563eb',
            'completed' => '#16a34a',
            'active' => '#16a34a',
            'pending' => '#f59e0b',
            'closed' => '#ef4444',
            default => '#94a3b8'
        };
        $pctTester = $k['maxTester'] > 0 ? round($k['tester']/$k['maxTester']*100) : 0;
        $pctHari   = $k['maxHari']   > 0 ? round($k['hariKe']/$k['maxHari']*100)   : 0;
    @endphp
    <div class="mk-list-row" data-row-id="{{ $idx }}"
         data-nama="{{ strtolower($k['nama']) }}"
         data-status="{{ $k['raw_status'] }}"
         data-tester="{{ $k['tester'] }}"
         data-timeline="{{ $k['hariKe'] }}"
         data-paket="{{ $k['paket'] }}"
         data-poin="{{ $k['poin'] }}"
         data-idx="{{ $idx }}"
         x-show="tampilListRow($el)">

        {{-- App info --}}
        <div class="flex items-center gap-3 w-56 flex-shrink-0">
            @if($k['logo'])
                <img src="/storage/{{ $k['logo'] }}" alt="Logo" class="w-9 h-9 rounded-xl object-cover flex-shrink-0">
            @else
                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold text-white flex-shrink-0"
                     style="background:{{ $k['ikonGrad'] }};">{{ $k['ikonHuruf'] }}</div>
            @endif
            <div class="min-w-0">
                <p class="text-sm font-semibold mp-sora truncate" style="color:#1e293b;">{{ $k['nama'] }}</p>
                <p class="text-xs truncate" style="color:#64748b;">{{ $k['developer'] }}</p>
            </div>
        </div>

        {{-- Status --}}
        <div class="w-24 flex-shrink-0">
            <span class="mk-badge mk-badge-{{ strtolower($k['raw_status']) }}">{{ $k['status'] }}</span>
        </div>

        {{-- Tester progress --}}
        <div class="flex-1">
            <div class="flex items-center justify-between mb-1">
                <span class="text-xs mp-mono font-semibold" style="color:#1e293b;">{{ $k['tester'] }}/{{ $k['maxTester'] }}</span>
                <span class="text-xs mp-mono" style="color:#94a3b8;">{{ $pctTester }}%</span>
            </div>
            <div class="mk-progress-track h-1.5 w-full">
                <div class="mk-progress-fill h-1.5" style="width:{{ $pctTester }}%;background:{{ $borderColor }};"></div>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="w-32 flex-shrink-0">
            @if(in_array(strtolower($k['raw_status']), ['pending', 'closed']))
                <div class="text-sm font-semibold text-center mt-2" style="color:#d97706;">{{ __('Tertunda') }}</div>
            @else
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs mp-mono font-semibold" style="color:#1e293b;">{{ $k['hariKe'] }}/{{ $k['maxHari'] }}</span>
                    <span class="text-xs mp-mono" style="color:#94a3b8;">{{ $pctHari }}%</span>
                </div>
                <div class="mk-progress-track h-1.5 w-full">
                    <div class="mk-progress-fill h-1.5" style="width:{{ $pctHari }}%;background:{{ $borderColor }};"></div>
                </div>
            @endif
        </div>

        {{-- Paket --}}
        <div class="w-24 flex-shrink-0">
            <span class="mk-badge mk-badge-{{ strtolower($k['paket']) }}">{{ $k['paket'] }}</span>
        </div>

        {{-- Poin --}}
        <div class="w-28 flex-shrink-0 text-sm mp-mono font-semibold" style="color:#1e293b;">
            <span class="material-symbols-outlined text-[1rem] text-slate-400 align-text-bottom mr-0.5">monetization_on</span>
            {{ number_format($k['poin'], 0, ',', '.') }}
        </div>

        {{-- Aksi --}}
        <div class="w-32 flex-shrink-0 flex items-center justify-center gap-1.5">

            <a href="{{ \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('edit', ['record' => $k['id']]) }}" class="mk-action-btn mk-btn-edit" title="{{ __('Edit') }}">
                <span class="material-symbols-outlined text-[1rem]">edit</span>
            </a>
            <a href="{{ \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('kelola-tester', ['record' => $k['id']]) }}" class="mk-action-btn mk-btn-users" title="{{ __('Kelola Tester') }}">
                <span class="material-symbols-outlined text-[1rem]">group</span>
            </a>
            @if($k['raw_status'] === 'closed')
            <button @click="bukaModalMulai({{ $k['id'] }})" class="mk-action-btn mk-btn-start" title="{{ __('Mulai Misi') }}">
                <span class="material-symbols-outlined text-[1rem]">play_circle</span>
            </button>
            @endif
        </div>

    </div>
    @endforeach

    {{-- Empty State --}}
    <div x-show="filteredCount() === 0" x-cloak class="mp-empty">
        <div class="mp-empty-icon">
            <span class="material-symbols-outlined text-slate-400 text-[1.8rem]">apps</span>
        </div>
        <p class="text-sm font-semibold text-slate-600">{{ __('Tidak ada aplikasi ditemukan') }}</p>
        <p class="text-xs mt-1 text-slate-400">{{ __('Coba ubah filter atau kata kunci pencarian') }}</p>
    </div>

    </div>
</div>{{-- end list view --}}


{{-- ══════════════════════════════════════════════════════
     MODAL DETAIL KAMPANYE
══════════════════════════════════════════════════════ --}}
<div class="mk-modal-overlay"
     x-show="modalTerbuka"
     x-cloak
     style="display:none;"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <div class="mk-modal-backdrop" @click="tutupModal()"></div>

    <div class="mk-modal-box"
         @click.stop
         x-show="modalTerbuka"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 -translate-y-2">

        {{-- Header --}}
        <div class="mk-modal-header">
            <div class="flex items-center gap-3">
                <template x-if="kampanye?.logo">
                    <img :src="'/storage/' + kampanye.logo" alt="Logo" class="w-11 h-11 rounded-xl object-cover flex-shrink-0">
                </template>
                <template x-if="!kampanye?.logo">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg font-bold text-white flex-shrink-0"
                         :style="'background:' + (kampanye?.ikonGrad ?? '#94a3b8')">
                        <span x-text="kampanye?.ikonHuruf ?? ''"></span>
                    </div>
                </template>
                <div>
                    <p class="text-sm font-bold mp-sora" style="color:#1e293b;" x-text="kampanye?.nama ?? ''"></p>
                    <p class="text-xs" style="color:#64748b;" x-text="kampanye?.developer ?? ''"></p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="mk-badge"
                      :class="{
                          'mk-badge-running':   kampanye?.raw_status === 'running',
                          'mk-badge-completed': kampanye?.raw_status === 'completed',
                          'mk-badge-pending':   kampanye?.raw_status === 'pending',
                          'mk-badge-closed':    kampanye?.raw_status === 'closed',
                      }"
                      x-text="kampanye?.status ?? ''">
                </span>
                <button @click="tutupModal()"
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                        style="background:#f8fafc;border:1px solid #e2e8f0;">
                    <span class="material-symbols-outlined text-[1rem]" style="color:#64748b;">close</span>
                </button>
            </div>
        </div>

        {{-- Body --}}
        <div class="mk-modal-body">

            {{-- Progress bars --}}
            <div class="grid grid-cols-2 gap-4 mb-5 p-4 rounded-xl" style="background:#f8fafc;">
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-medium" style="color:#64748b;">{{ __('Tester') }}</span>
                        <span class="text-xs font-bold mp-mono" style="color:#1e293b;"
                              x-text="(kampanye?.tester ?? 0) + '/' + (kampanye?.maxTester ?? 20)">
                        </span>
                    </div>
                    <div class="mk-progress-track h-2">
                        <div class="mk-progress-fill h-2" style="background:#2563eb;"
                             :style="'width:' + Math.round(((kampanye?.tester??0)/(kampanye?.maxTester??20))*100) + '%'">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-medium" style="color:#64748b;">{{ __('Hari') }}</span>
                        <span class="text-xs font-bold mp-mono" style="color:#1e293b;"
                              x-text="(kampanye?.hariKe ?? 0) + '/' + (kampanye?.maxHari ?? 14)">
                        </span>
                    </div>
                    <div class="mk-progress-track h-2">
                        <div class="mk-progress-fill h-2" style="background:#f59e0b;"
                             :style="'width:' + Math.round(((kampanye?.hariKe??0)/(kampanye?.maxHari??14))*100) + '%'">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail rows --}}
            <div class="mk-detail-row">
                <span class="mk-detail-label">{{ __('Paket') }}</span>
                <span class="mk-detail-value">
                    <span class="mk-badge"
                          :class="(kampanye?.paket && kampanye.paket.toLowerCase().includes('premium')) ? 'mk-badge-pro' : 'mk-badge-starter'"
                          x-text="kampanye?.paket ?? '-'">
                    </span>
                </span>
            </div>
            <div class="mk-detail-row">
                <span class="mk-detail-label">{{ __('Tanggal Mulai') }}</span>
                <span class="mk-detail-value mp-mono" x-text="kampanye?.mulai ?? '-'"></span>
            </div>
            <div class="mk-detail-row">
                <span class="mk-detail-label">{{ __('Tanggal Selesai') }}</span>
                <span class="mk-detail-value mp-mono" x-text="kampanye?.selesai ?? '-'"></span>
            </div>
        </div>

        {{-- Footer --}}
        <div class="mk-modal-footer">
            <button @click="tutupModal()" class="mp-btn mp-btn-ghost">{{ __('Tutup') }}</button>
        </div>

    </div>
</div>{{-- end modal detail --}}

{{-- ══════════════════════════════════════════════════════
     MODAL MULAI MISI
══════════════════════════════════════════════════════ --}}
<div class="mk-modal-overlay"
     x-show="modalMulaiTerbuka"
     x-cloak
     style="display:none;"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <div class="mk-modal-backdrop" @click="modalMulaiTerbuka = false"></div>

    <div class="mk-modal-box"
         @click.stop
         x-show="modalMulaiTerbuka"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 -translate-y-2">

        <div class="mk-modal-header">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-[1.5rem]" style="color:#2563eb;">play_circle</span>
                <p class="text-sm font-bold mp-sora" style="color:#1e293b;">{{ __('Mulai Misi') }}</p>
            </div>
            <button @click="modalMulaiTerbuka = false"
                    class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                    style="background:#f8fafc;border:1px solid #e2e8f0;">
                <span class="material-symbols-outlined text-[1rem]" style="color:#64748b;">close</span>
            </button>
        </div>

        <div class="mk-modal-body">
            <p class="text-sm text-slate-600 mb-4">
                Apakah Anda yakin ingin memulai misi ini? Sistem akan membuatkan sub-misi secara otomatis untuk para tester.
            </p>
            
            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-800">{{ __('Link Aplikasi / Test') }}</label>
                <input type="url" wire:model.defer="link_aplikasi" placeholder="https://..." class="mp-input w-full" required>
            </div>
        </div>

        <div class="mk-modal-footer">
            <button @click="modalMulaiTerbuka = false" class="mp-btn mp-btn-ghost">{{ __('Batal') }}</button>
            <button @click="submitMulai()" class="mp-btn mp-btn-primary" style="background:#16a34a; color:#fff;">
                <span class="material-symbols-outlined text-[1.1rem]">play_arrow</span>
                {{ __('Mulai Misi') }}
            </button>
        </div>
    </div>
</div>{{-- end modal mulai --}}

</div>{{-- end Alpine root --}}

@push('scripts')
<script>
function listMisisApp() {
    return {
        viewMode: 'grid',
        cariTeks: '',
        filterStatus: '',
        sortBy: 'terbaru',
        sortCol: 'created_at',
        sortDir: 'desc',

        kampanyeList: [],
        kampanyeAsli: [],

        modalTerbuka: false,
        kampanye: null,
        
        modalMulaiTerbuka: false,
        idMisiMulai: null,

        init() {
            let el = document.getElementById('kampanye-data');
            if (el) {
                try {
                    this.kampanyeAsli = JSON.parse(el.getAttribute('data-list')) || [];
                    this.kampanyeList = [...this.kampanyeAsli];
                } catch(e) {
                    this.kampanyeAsli = [];
                    this.kampanyeList = [];
                }
            }
            this.$watch('cariTeks', () => this.applyFilter());
            this.$watch('filterStatus', () => this.applyFilter());
            this.$watch('sortBy', () => this.applySort());
        },

        bukaModal(idx) {
            this.kampanye = this.kampanyeAsli[idx];
            this.modalTerbuka = true;
        },
        tutupModal() {
            this.modalTerbuka = false;
            this.kampanye = null;
        },
        
        bukaModalMulai(id) {
            this.idMisiMulai = id;
            this.modalMulaiTerbuka = true;
        },
        submitMulai() {
            if (this.idMisiMulai) {
                this.$wire.mulaiMisi(this.idMisiMulai);
            }
        },

        tampilKard(status, nama) {
            if (this.filterStatus && status !== this.filterStatus) return false;
            if (this.cariTeks) {
                if (!nama.includes(this.cariTeks.toLowerCase())) return false;
            }
            return true;
        },

        tampilListRow(el) {
            let s = el.getAttribute('data-status');
            let n = el.getAttribute('data-nama');
            if (this.filterStatus && s !== this.filterStatus) return false;
            if (this.cariTeks && !n.includes(this.cariTeks.toLowerCase())) return false;
            return true;
        },

        filteredCount() {
            let count = 0;
            for (let i=0; i<this.kampanyeAsli.length; i++) {
                let s = this.kampanyeAsli[i].raw_status;
                let n = this.kampanyeAsli[i].nama.toLowerCase();
                if (this.filterStatus && s !== this.filterStatus) continue;
                if (this.cariTeks && !n.includes(this.cariTeks.toLowerCase())) continue;
                count++;
            }
            return count;
        },

        applyFilter() {
            // Livewire/Alpine re-renders elements based on x-show
        },

        applySort() {
            if (this.sortBy === 'terbaru') {
                this.kampanyeList = [...this.kampanyeAsli];
            } else if (this.sortBy === 'terlama') {
                this.kampanyeList = [...this.kampanyeAsli].reverse();
            } else if (this.sortBy === 'tester') {
                this.kampanyeList = [...this.kampanyeAsli].sort((a,b) => b.tester - a.tester);
            } else if (this.sortBy === 'progress') {
                this.kampanyeList = [...this.kampanyeAsli].sort((a,b) => (b.hariKe/b.maxHari) - (a.hariKe/a.maxHari));
            } else if (this.sortBy === 'nama') {
                this.kampanyeList = [...this.kampanyeAsli].sort((a,b) => a.nama.localeCompare(b.nama));
            }
        },

        setSort(col) {
            if (this.sortCol === col) {
                this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortCol = col;
                this.sortDir = 'asc';
            }
            
            let asc = this.sortDir === 'asc' ? 1 : -1;
            
            this.kampanyeList = [...this.kampanyeAsli].sort((a,b) => {
                if (col === 'nama') return a.nama.localeCompare(b.nama) * asc;
                if (col === 'status') return a.status.localeCompare(b.status) * asc;
                if (col === 'tester') return (a.tester - b.tester) * asc;
                if (col === 'timeline') return (a.hariKe - b.hariKe) * asc;
                if (col === 'paket') return a.paket.localeCompare(b.paket) * asc;
                if (col === 'poin') return (a.poin - b.poin) * asc;
                return 0;
            });
        },

        resetFilter() {
            this.cariTeks = '';
            this.filterStatus = '';
            this.sortBy = 'terbaru';
        }
    }
}
</script>
@endpush

</x-filament-panels::page>
