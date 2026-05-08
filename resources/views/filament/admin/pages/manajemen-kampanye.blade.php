{{--
    Manajemen Kampanye — PlayTest ID Admin Panel
    Page   : ManajemenKampanye.php
    Panel  : Admin (/admin)
    Fonts  : Sora (heading), JetBrains Mono (angka), Inter (body)
--}}

<x-filament-panels::page>

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<style>
    body, .fi-main, .fi-simple-main { font-family: 'Inter', sans-serif !important; }
    .mp-sora { font-family: 'Sora', sans-serif !important; }
    .mp-mono  { font-family: 'JetBrains Mono', monospace !important; }
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
    .mp-grad-green   { background: linear-gradient(90deg, #22c55e, #86efac); }
    .mp-grad-orange  { background: linear-gradient(90deg, #f59e0b, #fcd34d); }
    .mp-grad-red     { background: linear-gradient(90deg, #ef4444, #fca5a5); }
    .mp-grad-slate   { background: linear-gradient(90deg, #64748b, #94a3b8); }
    .mp-bg-blue    { background: #eff6ff; color: #2563eb; }
    .mp-bg-green   { background: #dcfce7; color: #16a34a; }
    .mp-bg-orange  { background: #fef9c3; color: #f59e0b; }
    .mp-bg-red     { background: #fef2f2; color: #ef4444; }
    .mp-bg-slate   { background: #f1f5f9; color: #64748b; }

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
    .mp-btn-primary { background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #fff; }
    .mp-btn-primary:hover { box-shadow: 0 6px 16px rgba(37,99,235,0.35); transform: translateY(-1px); }
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
    .mk-badge-aktif    { background: #eff6ff; color: #1d4ed8; }
    .mk-badge-selesai  { background: #f0fdf4; color: #15803d; }
    .mk-badge-ditinjau { background: #fffbeb; color: #b45309; }
    .mk-badge-ditolak  { background: #fff1f2; color: #be123c; }
    .mk-badge-pro      { background: #fffbeb; color: #b45309; }
    .mk-badge-starter  { background: #eff6ff; color: #1d4ed8; }

    /* Action buttons (card & list) */
    .mk-action-btn { position: relative; width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s ease; border: 1px solid transparent; }
    .mk-action-btn:hover { transform: scale(1.08); }
    .mk-btn-detail  { background: #eff6ff; border-color: #bfdbfe; }
    .mk-btn-detail:hover  { background: #dbeafe; }
    .mk-btn-approve { background: #f0fdf4; border-color: #bbf7d0; }
    .mk-btn-approve:hover { background: #dcfce7; }
    .mk-btn-reject  { background: #fff1f2; border-color: #fecdd3; }
    .mk-btn-reject:hover  { background: #ffe4e6; }
    .mk-btn-pause   { background: #fff1f2; border-color: #fecdd3; }
    .mk-btn-pause:hover   { background: #ffe4e6; }
    .mk-btn-more    { background: #f8fafc; border-color: #e2e8f0; }
    .mk-btn-more:hover    { background: #f1f5f9; }
    .mk-btn-report  { background: #f0fdf4; border-color: #bbf7d0; }
    .mk-btn-report:hover  { background: #dcfce7; }

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
</style>
@endpush


{{-- ══════════════════════════════════════════════════
     ALPINE ROOT
══════════════════════════════════════════════════ --}}
<div class="space-y-5" x-data="manajemenKampanye()" @keydown.escape.window="tutupModal()">

{{-- ── PAGE HEADER ──────────────────────────────── --}}
<div class="flex items-start justify-between animate-fade-in-up">
    <div>
        <h1 class="mp-sora text-xl font-bold text-slate-900">Manajemen Kampanye</h1>
        <p class="text-sm text-slate-500 mt-0.5">
            Pantau dan kelola semua kampanye pengujian aplikasi yang aktif di platform.
        </p>
    </div>
    <div class="flex items-center gap-3">
        {{-- View Toggle Grid/List --}}
        <div class="mk-view-toggle">
            <button class="mk-view-btn"
                    :class="viewMode === 'grid' ? 'mk-view-active' : 'mk-view-inactive'"
                    @click="viewMode = 'grid'">
                <span class="material-symbols-outlined text-[.95rem]">grid_view</span>
                Grid
            </button>
            <button class="mk-view-btn"
                    :class="viewMode === 'list' ? 'mk-view-active' : 'mk-view-inactive'"
                    @click="viewMode = 'list'">
                <span class="material-symbols-outlined text-[.95rem]">view_list</span>
                List
            </button>
        </div>
        {{-- Export --}}
        <button class="mp-btn mp-btn-primary">
            <span class="material-symbols-outlined text-[1.1rem]">download</span>
            Export CSV
        </button>
    </div>
</div>

{{-- ── STAT CARDS ──────────────────────────────── --}}
<div class="grid grid-cols-2 xl:grid-cols-5 gap-4 animate-fade-in-up delay-100">

    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-slate"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-slate">
                <span class="material-symbols-outlined">folder_copy</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="mp-stat-label">Total</div>
                <div class="mp-stat-value">{{ $statTotal }}</div>
                <div class="mp-stat-sub">semua kampanye</div>
            </div>
        </div>
    </div>

    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-blue"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-blue">
                <span class="material-symbols-outlined">play_circle</span>
            </div>
            <div>
                <div class="mp-stat-label">Aktif</div>
                <div class="mp-stat-value text-blue-700">{{ $statAktif }}</div>
                <div class="mp-stat-sub">sedang berjalan</div>
            </div>
        </div>
    </div>

    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-green"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-green">
                <span class="material-symbols-outlined">task_alt</span>
            </div>
            <div>
                <div class="mp-stat-label">Selesai</div>
                <div class="mp-stat-value text-green-700">{{ $statSelesai }}</div>
                <div class="mp-stat-sub">sudah selesai</div>
            </div>
        </div>
    </div>

    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-orange"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-orange">
                <span class="material-symbols-outlined">rate_review</span>
            </div>
            <div>
                <div class="mp-stat-label">Ditinjau</div>
                <div class="mp-stat-value text-amber-600">{{ $statDitinjau }}</div>
                <div class="mp-stat-sub">perlu tinjauan</div>
            </div>
        </div>
    </div>

    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-red"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-red">
                <span class="material-symbols-outlined">cancel</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="mp-stat-label">Ditolak</div>
                <div class="mp-stat-value text-red-600">{{ $statDitolak }}</div>
                <div class="mp-stat-sub">tidak disetujui</div>
            </div>
        </div>
    </div>

</div>

{{-- ── FILTER BAR ───────────────────────────────── --}}
<div class="mp-filter-bar animate-fade-in-up delay-200">

    {{-- Search --}}
    <div class="mp-search-wrap">
        <span class="material-symbols-outlined mp-search-icon">search</span>
        <input type="text" placeholder="Cari nama kampanye atau developer…"
               x-model="cariTeks"
               class="mp-input mp-search-input">
    </div>

    <div class="mp-filter-divider"></div>

    {{-- Filter Status --}}
    <select x-model="filterStatus" class="mp-select">
        <option value="">Semua Status</option>
        <option value="Aktif">Aktif</option>
        <option value="Selesai">Selesai</option>
        <option value="Ditinjau">Ditinjau</option>
        <option value="Ditolak">Ditolak</option>
    </select>

    {{-- Urutkan --}}
    <select x-model="sortBy" class="mp-select">
        <option value="terbaru">Terbaru</option>
        <option value="terlama">Terlama</option>
        <option value="tester">Tester Terbanyak</option>
        <option value="progress">Progress Tertinggi</option>
        <option value="nama">Nama A-Z</option>
    </select>

    {{-- Reset --}}
    <button @click="resetFilter()" class="mp-btn mp-btn-ghost">
        Reset
    </button>

    {{-- Hasil count --}}
    <div class="ml-auto text-sm font-medium text-slate-400">
        <strong class="mp-mono text-slate-700" x-text="filteredCount()"></strong>
        kampanye ditampilkan
    </div>

    {{-- Timestamp --}}
    <div class="flex items-center gap-1.5 text-xs text-slate-400">
        <span class="material-symbols-outlined text-[.9rem]">refresh</span>
        Update: {{ now()->format('H:i') }} WIB
    </div>

</div>

{{-- ── SECTION LABEL ─────────────────────────────── --}}
<div class="flex items-center justify-between animate-fade-in-up delay-300">
    <div class="mp-sora font-bold text-slate-900 text-base flex items-center gap-2">
        <span class="material-symbols-outlined text-blue-600 text-[1.2rem]">campaign</span>
        <span x-text="filterStatus || 'Semua Kampanye'"></span>
    </div>
    <span class="text-xs mp-mono px-2.5 py-1 rounded-lg font-semibold"
          style="background:#eff6ff;color:#2563eb;"
          x-text="filteredCount() + ' kampanye'">
    </span>
</div>

{{-- ══════════════════════════════════════════════
     GRID VIEW
══════════════════════════════════════════════ --}}
<div x-show="viewMode === 'grid'"
     class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    @foreach($kampanyeList as $idx => $k)
    @php
        $borderColor = ['Aktif'=>'#2563eb','Selesai'=>'#16a34a','Ditinjau'=>'#f59e0b','Ditolak'=>'#ef4444'][$k['status']] ?? '#94a3b8';
        $progColor   = $borderColor;
        $dotClass    = ['Aktif'=>'mk-dot-filled-blue','Selesai'=>'mk-dot-filled-green','Ditinjau'=>'mk-dot-filled-amber','Ditolak'=>'mk-dot-empty'][$k['status']] ?? 'mk-dot-empty';
        $pctTester   = $k['maxTester'] > 0 ? round($k['tester'] / $k['maxTester'] * 100) : 0;
    @endphp

    <div class="mk-card"
         style="border-left-color:{{ $borderColor }};"
         x-show="tampilKard('{{ $k['status'] }}', '{{ strtolower($k['nama']) }}', '{{ strtolower($k['developer']) }}')">
        <div class="p-5">

            {{-- App info --}}
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 text-lg font-bold text-white"
                         style="background:{{ $k['ikonGrad'] }};">
                        {{ $k['ikonHuruf'] }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold mp-sora leading-tight" style="color:#1e293b;">{{ $k['nama'] }}</p>
                        <p class="text-xs mt-0.5" style="color:#64748b;">{{ $k['developer'] }}</p>
                    </div>
                </div>
                <span class="mk-badge mk-badge-{{ strtolower($k['status']) }} flex-shrink-0">
                    <span class="w-1.5 h-1.5 rounded-full" style="background:{{ $borderColor }};"></span>
                    {{ $k['status'] }}
                </span>
            </div>

            {{-- Tester progress --}}
            <div class="mb-3">
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs font-medium" style="color:#64748b;">Tester Bergabung</span>
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
                    <span class="text-xs font-medium" style="color:#64748b;">Timeline 14 Hari</span>
                    @if($k['hariKe'] > 0)
                        <span class="text-xs mp-mono font-semibold" style="color:{{ $progColor }};">Hari {{ $k['hariKe'] }}</span>
                    @elseif($k['status'] === 'Ditinjau')
                        <span class="text-xs mp-mono font-semibold" style="color:#b45309;">Menunggu</span>
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
                <button class="flex-1 flex items-center justify-center gap-1.5 py-2 rounded-xl text-xs font-semibold"
                        style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;transition:all .15s;"
                        onmouseover="this.style.background='#dbeafe'"
                        onmouseout="this.style.background='#eff6ff'"
                        @click="bukaModal({{ $idx }})">
                    <span class="material-symbols-outlined text-[.95rem]">visibility</span>
                    Detail
                </button>

                @if($k['status'] === 'Aktif')
                <button class="mk-action-btn mk-btn-pause" title="Hentikan Sementara" wire:click="pauseKampanye('{{ $k['id'] }}')">
                    <span class="material-symbols-outlined text-[1rem]" style="color:#ef4444;">pause_circle</span>
                </button>
                <button class="mk-action-btn mk-btn-more" title="Lainnya">
                    <span class="material-symbols-outlined text-[1rem]" style="color:#64748b;">more_horiz</span>
                </button>

                @elseif($k['status'] === 'Ditinjau')
                <button class="mk-action-btn mk-btn-approve" title="Setujui" wire:click="approveKampanye('{{ $k['id'] }}')">
                    <span class="material-symbols-outlined text-[1rem]" style="color:#16a34a;">check_circle</span>
                </button>
                <button class="mk-action-btn mk-btn-reject" title="Tolak" wire:click="rejectKampanye('{{ $k['id'] }}')">
                    <span class="material-symbols-outlined text-[1rem]" style="color:#ef4444;">cancel</span>
                </button>

                @elseif($k['status'] === 'Selesai')
                <button class="mk-action-btn mk-btn-report" title="Lihat Laporan">
                    <span class="material-symbols-outlined text-[1rem]" style="color:#16a34a;">bar_chart</span>
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
                <span class="material-symbols-outlined text-slate-400 text-[1.8rem]">campaign</span>
            </div>
            <p class="text-sm font-semibold text-slate-600">Tidak ada kampanye ditemukan</p>
            <p class="text-xs mt-1 text-slate-400">Coba ubah filter atau kata kunci pencarian</p>
        </div>
    </div>

</div>{{-- end grid --}}


{{-- ══════════════════════════════════════════════
     LIST VIEW
══════════════════════════════════════════════ --}}
<div x-show="viewMode === 'list'"
     x-cloak
     class="bg-white rounded-2xl border border-slate-200 overflow-hidden"
     style="box-shadow:0 4px 6px -1px rgba(0,0,0,0.02);">

    {{-- List Header --}}
    <div class="flex items-center gap-4 px-5 py-3" style="background:#f8fafc;border-bottom:1px solid #e2e8f0;">
        <div class="w-56 flex-shrink-0">
            <span class="mp-sort-btn" style="cursor:default;font-size:.72rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.07em;">Kampanye</span>
        </div>
        <div class="w-24 flex-shrink-0">
            <span style="font-size:.72rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.07em;">Status</span>
        </div>
        <div class="flex-1">
            <span style="font-size:.72rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.07em;">Tester</span>
        </div>
        <div class="w-32 flex-shrink-0">
            <span style="font-size:.72rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.07em;">Timeline</span>
        </div>
        <div class="w-24 flex-shrink-0">
            <span style="font-size:.72rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.07em;">Paket</span>
        </div>
        <div class="w-28 flex-shrink-0 text-center">
            <span style="font-size:.72rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.07em;">Aksi</span>
        </div>
    </div>

    @foreach($kampanyeList as $idx => $k)
    @php
        $borderColor = ['Aktif'=>'#2563eb','Selesai'=>'#16a34a','Ditinjau'=>'#f59e0b','Ditolak'=>'#ef4444'][$k['status']] ?? '#94a3b8';
        $pctTester = $k['maxTester'] > 0 ? round($k['tester']/$k['maxTester']*100) : 0;
        $pctHari   = $k['maxHari']   > 0 ? round($k['hariKe']/$k['maxHari']*100)   : 0;
    @endphp
    <div class="mk-list-row"
         x-show="tampilKard('{{ $k['status'] }}', '{{ strtolower($k['nama']) }}', '{{ strtolower($k['developer']) }}')">

        {{-- App info --}}
        <div class="flex items-center gap-3 w-56 flex-shrink-0">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold text-white flex-shrink-0"
                 style="background:{{ $k['ikonGrad'] }};">{{ $k['ikonHuruf'] }}</div>
            <div class="min-w-0">
                <p class="text-sm font-semibold mp-sora truncate" style="color:#1e293b;">{{ $k['nama'] }}</p>
                <p class="text-xs truncate" style="color:#64748b;">{{ $k['developer'] }}</p>
            </div>
        </div>

        {{-- Status --}}
        <div class="w-24 flex-shrink-0">
            <span class="mk-badge mk-badge-{{ strtolower($k['status']) }}">{{ $k['status'] }}</span>
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
            <div class="flex items-center justify-between mb-1">
                <span class="text-xs mp-mono font-semibold" style="color:#1e293b;">{{ $k['hariKe'] }}/{{ $k['maxHari'] }}</span>
                <span class="text-xs mp-mono" style="color:#94a3b8;">{{ $pctHari }}%</span>
            </div>
            <div class="mk-progress-track h-1.5 w-full">
                <div class="mk-progress-fill h-1.5" style="width:{{ $pctHari }}%;background:{{ $borderColor }};"></div>
            </div>
        </div>

        {{-- Paket --}}
        <div class="w-24 flex-shrink-0">
            <span class="mk-badge mk-badge-{{ strtolower($k['paket']) }}">{{ $k['paket'] }}</span>
        </div>

        {{-- Aksi --}}
        <div class="w-28 flex-shrink-0 flex items-center justify-center gap-1.5">
            <button class="mk-action-btn mk-btn-detail" @click="bukaModal({{ $idx }})" title="Detail">
                <span class="material-symbols-outlined text-[1rem]" style="color:#2563eb;">visibility</span>
            </button>
            @if($k['status'] === 'Ditinjau')
            <button class="mk-action-btn mk-btn-approve" title="Approve" wire:click="approveKampanye('{{ $k['id'] }}')">
                <span class="material-symbols-outlined text-[1rem]" style="color:#16a34a;">check_circle</span>
            </button>
            <button class="mk-action-btn mk-btn-reject" title="Tolak" wire:click="rejectKampanye('{{ $k['id'] }}')">
                <span class="material-symbols-outlined text-[1rem]" style="color:#ef4444;">cancel</span>
            </button>
            @elseif($k['status'] === 'Aktif')
            <button class="mk-action-btn mk-btn-pause" title="Pause" wire:click="pauseKampanye('{{ $k['id'] }}')">
                <span class="material-symbols-outlined text-[1rem]" style="color:#ef4444;">pause_circle</span>
            </button>
            @elseif($k['status'] === 'Selesai')
            <button class="mk-action-btn mk-btn-report" title="Laporan">
                <span class="material-symbols-outlined text-[1rem]" style="color:#16a34a;">bar_chart</span>
            </button>
            @endif
        </div>

    </div>
    @endforeach

    {{-- Empty State --}}
    <div x-show="filteredCount() === 0" x-cloak class="mp-empty">
        <div class="mp-empty-icon">
            <span class="material-symbols-outlined text-slate-400 text-[1.8rem]">campaign</span>
        </div>
        <p class="text-sm font-semibold text-slate-600">Tidak ada kampanye ditemukan</p>
        <p class="text-xs mt-1 text-slate-400">Coba ubah filter atau kata kunci pencarian</p>
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
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg font-bold text-white flex-shrink-0"
                     :style="'background:' + (kampanye?.ikonGrad ?? '#94a3b8')">
                    <span x-text="kampanye?.ikonHuruf ?? ''"></span>
                </div>
                <div>
                    <p class="text-sm font-bold mp-sora" style="color:#1e293b;" x-text="kampanye?.nama ?? ''"></p>
                    <p class="text-xs" style="color:#64748b;" x-text="kampanye?.developer ?? ''"></p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="mk-badge"
                      :class="{
                          'mk-badge-aktif':    kampanye?.status === 'Aktif',
                          'mk-badge-selesai':  kampanye?.status === 'Selesai',
                          'mk-badge-ditinjau': kampanye?.status === 'Ditinjau',
                          'mk-badge-ditolak':  kampanye?.status === 'Ditolak',
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
                        <span class="text-xs font-medium" style="color:#64748b;">Tester</span>
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
                        <span class="text-xs font-medium" style="color:#64748b;">Hari</span>
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
                <span class="mk-detail-label">Paket</span>
                <span class="mk-detail-value">
                    <span class="mk-badge"
                          :class="kampanye?.paket === 'Pro' ? 'mk-badge-pro' : 'mk-badge-starter'"
                          x-text="kampanye?.paket ?? '-'">
                    </span>
                </span>
            </div>
            <div class="mk-detail-row">
                <span class="mk-detail-label">Tanggal Mulai</span>
                <span class="mk-detail-value mp-mono" x-text="kampanye?.mulai ?? '-'"></span>
            </div>
            <div class="mk-detail-row">
                <span class="mk-detail-label">Tanggal Selesai</span>
                <span class="mk-detail-value mp-mono" x-text="kampanye?.selesai ?? '-'"></span>
            </div>
            <div class="mk-detail-row">
                <span class="mk-detail-label">Developer</span>
                <span class="mk-detail-value" x-text="kampanye?.developer ?? '-'"></span>
            </div>
        </div>

        {{-- Footer --}}
        <div class="mk-modal-footer">
            <button @click="tutupModal()" class="mp-btn mp-btn-ghost">Tutup</button>

            <template x-if="kampanye?.status === 'Ditinjau'">
                <div class="flex gap-2">
                    <button @click="$wire.rejectKampanye(kampanye.id); tutupModal()"
                            class="mp-btn" style="background:#fff1f2;color:#ef4444;border:1px solid #fecdd3;">
                        <span class="material-symbols-outlined text-[1rem]">cancel</span>
                        Tolak
                    </button>
                    <button @click="$wire.approveKampanye(kampanye.id); tutupModal()"
                            class="mp-btn" style="background:linear-gradient(135deg,#16a34a,#15803d);color:#fff;box-shadow:0 4px 12px rgba(22,163,74,0.25);">
                        <span class="material-symbols-outlined text-[1rem]">check_circle</span>
                        Setujui
                    </button>
                </div>
            </template>

            <template x-if="kampanye?.status === 'Aktif'">
                <button @click="$wire.pauseKampanye(kampanye.id); tutupModal()"
                        class="mp-btn" style="background:#fff1f2;color:#ef4444;border:1px solid #fecdd3;">
                    <span class="material-symbols-outlined text-[1rem]">pause_circle</span>
                    Hentikan Sementara
                </button>
            </template>
        </div>

    </div>
</div>{{-- end modal --}}

</div>{{-- end Alpine root --}}


@push('scripts')
<script>
const KAMPANYE_DATA = @json($kampanyeList);

function manajemenKampanye() {
    return {
        viewMode     : 'grid',
        filterStatus : '',
        sortBy       : 'terbaru',
        cariTeks     : '',
        modalTerbuka : false,
        kampanye     : null,

        /* ── Filter Logic ─────────────── */
        tampilKard(status, nama, developer) {
            if (this.filterStatus && status !== this.filterStatus) return false;
            if (this.cariTeks) {
                const q = this.cariTeks.toLowerCase();
                if (!nama.includes(q) && !developer.includes(q)) return false;
            }
            return true;
        },

        filteredCount() {
            return KAMPANYE_DATA.filter(k =>
                (!this.filterStatus || k.status === this.filterStatus) &&
                (!this.cariTeks || k.nama.toLowerCase().includes(this.cariTeks.toLowerCase()) ||
                 k.developer.toLowerCase().includes(this.cariTeks.toLowerCase()))
            ).length;
        },

        resetFilter() {
            this.filterStatus = '';
            this.sortBy       = 'terbaru';
            this.cariTeks     = '';
        },

        /* ── Modal ────────────────────── */
        bukaModal(idx) {
            this.kampanye     = KAMPANYE_DATA[idx] ?? null;
            this.modalTerbuka = true;
            document.body.style.overflow = 'hidden';
        },

        tutupModal() {
            this.modalTerbuka = false;
            document.body.style.overflow = '';
            setTimeout(() => { this.kampanye = null; }, 200);
        },
    };
}
</script>
@endpush

</x-filament-panels::page>