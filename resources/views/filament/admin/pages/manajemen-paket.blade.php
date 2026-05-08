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
    .delay-400 { animation-delay: 0.4s; }

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
    .mp-grad-emerald { background: linear-gradient(90deg, #10b981, #34d399); }
    .mp-bg-blue    { background: #eff6ff; color: #2563eb; }
    .mp-bg-green   { background: #dcfce7; color: #16a34a; }
    .mp-bg-orange  { background: #fef9c3; color: #f59e0b; }
    .mp-bg-emerald { background: #d1fae5; color: #10b981; }

    /* ══ CHART ══ */
    .mp-chart-bar-wrap { display: flex; flex-direction: column; align-items: center; flex: 1; gap: 4px; }
    .mp-chart-bar-outer { width: 100%; height: 120px; display: flex; align-items: flex-end; justify-content: center; }
    .mp-chart-bar { width: 80%; border-radius: 6px 6px 0 0; background: linear-gradient(to top, #2563eb, #93c5fd); height: 0; transition: height 1.2s cubic-bezier(.4,0,.2,1), box-shadow 0.2s; position: relative; cursor: pointer; }
    .mp-chart-bar:hover { box-shadow: 0 0 12px rgba(37,99,235,0.55); transform: scaleY(1.02); transform-origin: bottom; }
    .mp-chart-bar-tooltip { position: absolute; top: -32px; left: 50%; transform: translateX(-50%) translateY(5px); background: #0f172a; color: #fff; font-size: .65rem; padding: 3px 7px; border-radius: 6px; white-space: nowrap; opacity: 0; pointer-events: none; transition: all .2s cubic-bezier(0.16,1,0.3,1); }
    .mp-chart-bar:hover .mp-chart-bar-tooltip { opacity: 1; transform: translateX(-50%) translateY(0); }
    .mp-chart-label { font-size: .7rem; color: #94a3b8; font-weight: 500; }
    .mp-chart-active .mp-chart-bar { background: linear-gradient(to top, #f59e0b, #fcd34d) !important; }
    .mp-chart-active .mp-chart-bar:hover { box-shadow: 0 0 12px rgba(245,158,11,0.6) !important; }

    /* ══ FILTER BAR ══ */
    .mp-filter-bar { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 18px; display: flex; flex-wrap: wrap; gap: 10px; align-items: center; transition: box-shadow 0.3s; }
    .mp-filter-bar:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
    .mp-search-wrap { position: relative; flex: 2; min-width: 260px; }
    .mp-search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 1.2rem; transition: color 0.2s; }
    .mp-search-wrap:focus-within .mp-search-icon { color: #2563eb; }
    .mp-input, .mp-select { border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 14px; font-size: .85rem; color: #334155; background: #f8fafc; outline: none; transition: all .2s; font-family: 'Inter', sans-serif; }
    .mp-input:focus, .mp-select:focus { border-color: #2563eb; background: #fff; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
    .mp-search-input { width: 100%; padding-left: 42px !important; }

    /* ══ BUTTONS ══ */
    .mp-btn { padding: 8px 16px; border-radius: 8px; font-size: .85rem; font-weight: 600; cursor: pointer; border: none; transition: all .15s cubic-bezier(0.4,0,0.2,1); font-family: 'Inter', sans-serif; display: inline-flex; align-items: center; gap: 6px; justify-content: center; }
    .mp-btn:active { transform: scale(0.95); }
    .mp-btn-primary { background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #fff; }
    .mp-btn-primary:hover { box-shadow: 0 6px 16px rgba(37,99,235,0.35); transform: translateY(-1px); }
    .mp-btn-danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: #fff; }
    .mp-btn-danger:hover { box-shadow: 0 6px 16px rgba(239,68,68,0.35); transform: translateY(-1px); }
    .mp-btn-success { background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; }
    .mp-btn-success:hover { box-shadow: 0 6px 16px rgba(34,197,94,0.35); transform: translateY(-1px); }
    .mp-btn-ghost { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
    .mp-btn-ghost:hover { background: #e2e8f0; color: #1e293b; }
    .mp-btn:disabled { opacity: 0.45; cursor: not-allowed; transform: none !important; box-shadow: none !important; }
    .mp-btn-icon { background: #f1f5f9; border: none; cursor: pointer; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all .15s; color: #64748b; }
    .mp-btn-icon:hover { background: #e2e8f0; color: #0f172a; transform: scale(1.05); }

    /* ══ SORT HEADER BUTTON ══ */
    .mp-sort-btn { display: inline-flex; align-items: center; gap: 3px; background: none; border: none; cursor: pointer; font-size: .75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .07em; padding: 0; transition: color 0.2s; font-family: 'Inter', sans-serif; white-space: nowrap; }
    .mp-sort-btn:hover  { color: #2563eb; }
    .mp-sort-btn.active { color: #2563eb; }
    .mp-sort-icon { font-size: .95rem !important; line-height: 1; }

    /* ══ TABLE ══ */
    .mp-table-wrap { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); }
    .mp-table { width: 100%; border-collapse: collapse; }
    .mp-table thead tr { background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
    .mp-table th { padding: 12px 16px; text-align: left; white-space: nowrap; }
    .mp-table td { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; font-size: .85rem; color: #334155; transition: background 0.2s; }
    .mp-table tbody tr { transition: all .2s; }
    .mp-table tbody tr td:first-child { border-left: 3px solid transparent; transition: border-color 0.2s; }
    .mp-table tbody tr:hover { background: #f8fafc; }
    .mp-table tbody tr:hover td:first-child { border-left-color: #2563eb; }
    .mp-table tbody tr:last-child td { border-bottom: none; }

    /* ══ TOGGLE SWITCH (table) ══ */
    .mp-toggle { width: 36px; height: 20px; border-radius: 20px; background: #e2e8f0; position: relative; transition: background .2s; flex-shrink: 0; border: none; cursor: pointer; display: block; }
    .mp-toggle.is-on       { background: #22c55e; }
    .mp-toggle.is-on-blue  { background: #2563eb; }
    .mp-toggle::after { content: ''; position: absolute; top: 2px; left: 2px; width: 16px; height: 16px; border-radius: 50%; background: #fff; transition: left .2s; box-shadow: 0 1px 3px rgba(0,0,0,.2); }
    .mp-toggle.is-on::after, .mp-toggle.is-on-blue::after { left: 18px; }

    /* ══ ACTION BUTTONS ══ */
    .mp-action { padding: 5px 12px; border-radius: 7px; font-size: .76rem; font-weight: 600; cursor: pointer; border: none; transition: all .15s; display: inline-flex; align-items: center; gap: 4px; font-family: 'Inter', sans-serif; }
    .mp-action-edit   { background: #fef9c3; color: #a16207; }
    .mp-action-edit:hover   { background: #fef08a; transform: translateY(-1px); }
    .mp-action-delete { background: #fef2f2; color: #b91c1c; }
    .mp-action-delete:hover { background: #fee2e2; transform: translateY(-1px); }

    /* ══ PAGINATION ══ */
    .mp-pagi { display: flex; align-items: center; justify-content: space-between; padding: 14px 20px; border-top: 1px solid #f1f5f9; font-size: .8rem; color: #64748b; border-radius: 0 0 14px 14px; }
    .mp-pagi-btn { width: 32px; height: 32px; border-radius: 8px; border: 1px solid #e2e8f0; background: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: .85rem; color: #475569; transition: all .15s; }
    .mp-pagi-btn:hover { background: #eff6ff; border-color: #2563eb; color: #2563eb; transform: translateY(-1px); }
    .mp-pagi-btn.active { background: #2563eb; border-color: #2563eb; color: #fff; box-shadow: 0 4px 10px rgba(37,99,235,0.25); }
    .mp-pagi-btn:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }

    /* ══ EMPTY STATE ══ */
    .mp-empty { padding: 48px 20px; text-align: center; }
    .mp-empty-icon { width: 56px; height: 56px; background: #f1f5f9; border-radius: 16px; margin: 0 auto 14px; display: flex; align-items: center; justify-content: center; }

    /* ══ SLIDE-OUT PANEL ══ */
    .mp-panel-bg { position: fixed; inset: 0; background: rgba(15,23,42,.55); backdrop-filter: blur(6px); z-index: 9998; display: flex; align-items: flex-start; justify-content: flex-end; }
    .mp-panel { width: 500px; max-width: 95vw; height: 100vh; background: #fff; overflow-y: auto; box-shadow: -15px 0 50px rgba(0,0,0,.2); }
    .mp-panel-header { padding: 22px 24px 18px; border-bottom: 1px solid #e2e8f0; background: rgba(248,250,252,0.9); backdrop-filter: blur(10px); position: sticky; top: 0; z-index: 10; }
    .mp-panel-body   { padding: 24px; }
    .mp-panel-footer { padding: 16px 24px; border-top: 1px solid #e2e8f0; display: flex; gap: 10px; background: #f8fafc; position: sticky; bottom: 0; z-index: 10; }
    .mp-panel-section { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: #94a3b8; margin: 22px 0 12px; }
    .mp-panel-section:first-child { margin-top: 0; }

    /* Form */
    .mp-form-group { margin-bottom: 16px; }
    .mp-form-label { display: block; font-size: .8rem; font-weight: 600; color: #374151; margin-bottom: 6px; }
    .mp-form-required { color: #ef4444; }
    .mp-form-input, .mp-form-select, .mp-form-textarea { width: 100%; padding: 9px 12px; border: 1.5px solid #e2e8f0; border-radius: 9px; font-size: .85rem; color: #334155; background: #fff; outline: none; transition: border-color .15s, box-shadow .15s; font-family: 'Inter', sans-serif; box-sizing: border-box; }
    .mp-form-input:focus, .mp-form-select:focus, .mp-form-textarea:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
    .mp-form-textarea { resize: vertical; min-height: 80px; }
    .mp-form-note { font-size: .72rem; color: #94a3b8; margin-top: 4px; }
    .mp-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

    /* Toggle row in form */
    .mp-toggle-row { display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; border-radius: 10px; background: #f8fafc; border: 1px solid #f1f5f9; }
    .mp-toggle-row-label { font-size: .85rem; font-weight: 500; color: #374151; }
    .mp-toggle-row-sub { font-size: .72rem; color: #94a3b8; margin-top: 2px; }
    .mp-form-toggle { width: 42px; height: 24px; border-radius: 20px; background: #e2e8f0; position: relative; transition: background .2s; flex-shrink: 0; border: none; cursor: pointer; }
    .mp-form-toggle.is-on      { background: #22c55e; }
    .mp-form-toggle.is-on-blue { background: #2563eb; }
    .mp-form-toggle::after { content: ''; position: absolute; top: 3px; left: 3px; width: 18px; height: 18px; border-radius: 50%; background: #fff; transition: left .2s; box-shadow: 0 1px 3px rgba(0,0,0,.2); }
    .mp-form-toggle.is-on::after, .mp-form-toggle.is-on-blue::after { left: 21px; }

    /* ══ CONFIRM MODAL ══ */
    .mp-confirm-overlay { position: fixed; inset: 0; z-index: 9999; background: rgba(15,23,42,.6); backdrop-filter: blur(6px); display: flex; align-items: center; justify-content: center; padding: 1rem; }
    .mp-confirm-box { background: #fff; border-radius: 20px; max-width: 420px; width: 100%; box-shadow: 0 25px 50px rgba(0,0,0,.25); overflow: hidden; }
    .mp-confirm-header { padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; }
    .mp-confirm-title { font-size: 1rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 10px; }
    .mp-confirm-icon { font-size: 1.2rem; padding: 6px; border-radius: 8px; }
    .mp-confirm-icon.c-danger  { color: #ef4444; background: #fef2f2; }
    .mp-confirm-icon.c-warning { color: #f59e0b; background: #fef9c3; }
    .mp-confirm-icon.c-success { color: #10b981; background: #ecfdf5; }
    .mp-confirm-icon.c-info    { color: #2563eb; background: #eff6ff; }
    .mp-confirm-body  { padding: 20px 24px; }
    .mp-confirm-footer { padding: 16px 24px; border-top: 1px solid #f1f5f9; display: flex; gap: 10px; justify-content: flex-end; background: #f8fafc; }
    .mp-alert { border-radius: 12px; padding: 14px 16px; display: flex; align-items: flex-start; gap: 10px; }
    .mp-alert-danger  { background: #fef2f2; border: 1px solid #fecaca; }
    .mp-alert-warning { background: #fefce8; border: 1px solid #fde68a; }
    .mp-alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; }
    .mp-alert-info    { background: #eff6ff; border: 1px solid #bfdbfe; }
    .mp-alert-title { font-size: .88rem; font-weight: 600; margin-bottom: 4px; }
    .mp-alert-text  { font-size: .82rem; line-height: 1.55; }
    .c-danger  { color: #991b1b; }
    .c-warning { color: #92400e; }
    .c-success { color: #065f46; }
    .c-info    { color: #1e40af; }
</style>
@endpush

<div class="space-y-5" x-data="manajemenPaket()" x-init="initChart()">

{{-- ══ HEADER ══ --}}
<div class="flex items-center justify-between animate-fade-in-up">
    <div>
        <h1 class="mp-sora text-xl font-bold text-slate-900">Manajemen Paket</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola paket harga dan fitur yang tersedia untuk developer</p>
    </div>
    <a href="{{ \App\Filament\Admin\Resources\Pakets\PaketResource::getUrl('create') }}" class="mp-btn mp-btn-primary">
        <span class="material-symbols-outlined text-[1.1rem]">add</span>
        Tambah Paket
    </a>
</div>

{{-- ══ STAT CARDS ══ --}}
<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 animate-fade-in-up delay-100">
    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-blue"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-blue"><span class="material-symbols-outlined">inventory_2</span></div>
            <div class="flex-1 min-w-0">
                <div class="mp-stat-label">Total Paket</div>
                <div class="mp-stat-value">{{ $statTotalPaket }}</div>
                <div class="mp-stat-sub">paket tersedia</div>
            </div>
        </div>
    </div>
    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-green"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-green"><span class="material-symbols-outlined">check_circle</span></div>
            <div>
                <div class="mp-stat-label">Paket Aktif</div>
                <div class="mp-stat-value text-green-700">{{ $statPaketAktif }}</div>
                <div class="mp-stat-sub">sedang berjalan</div>
            </div>
        </div>
    </div>
    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-orange"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-orange"><span class="material-symbols-outlined">group</span></div>
            <div>
                <div class="mp-stat-label">Total Subscriber</div>
                <div class="mp-stat-value text-amber-600">{{ $statTotalSubscriber }}</div>
                <div class="mp-stat-sub">developer aktif</div>
            </div>
        </div>
    </div>
    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-emerald"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-emerald"><span class="material-symbols-outlined">payments</span></div>
            <div class="flex-1 min-w-0">
                <div class="mp-stat-label">Total Pendapatan</div>
                <div class="mp-stat-value mp-mono" style="font-size:1.1rem">{{ $statPendapatan }}</div>
                <div class="mp-stat-sub">dari semua paket</div>
            </div>
        </div>
    </div>
</div>

{{-- ══ DAFTAR PAKET TABLE ══ --}}
<div class="animate-fade-in-up delay-300">

    <div class="flex items-center justify-between mb-4">
        <div class="mp-sora font-bold text-slate-900 text-base flex items-center gap-2">
            <span class="material-symbols-outlined text-blue-600 text-[1.2rem]">inventory_2</span>
            Daftar Paket
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="mp-filter-bar mb-4">
        <div class="mp-search-wrap">
            <span class="material-symbols-outlined mp-search-icon">search</span>
            <input type="text" placeholder="Cari nama paket…" class="mp-input mp-search-input" x-model="cariPaket">
        </div>
        <select class="mp-select" x-model="filterAktif">
            <option value="">Semua Status</option>
            <option value="1">Aktif</option>
            <option value="0">Nonaktif</option>
        </select>
        <select class="mp-select" x-model="filterTrusted">
            <option value="">Semua Badge</option>
            <option value="1">Trusted</option>
            <option value="0">Tidak Trusted</option>
        </select>
        <select class="mp-select max-w-[120px]" x-model="perPage">
            <option value="5">5 Data</option>
            <option value="10">10 Data</option>
            <option value="20">20 Data</option>
            <option value="50">50 Data</option>
            <option value="1000">Semua</option>
        </select>
        <button class="mp-btn mp-btn-ghost" @click="resetFilter()">Reset</button>
    </div>

    {{-- Table --}}
    <div class="mp-table-wrap">
        <table class="mp-table">
            <thead>
                <tr>
                    <th>
                        <button class="mp-sort-btn" :class="sortCol==='nama'?'active':''" @click="setSort('nama')">
                            Nama Paket
                            <span class="material-symbols-outlined mp-sort-icon"
                                  x-text="sortCol!=='nama' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                        </button>
                    </th>
                    <th>
                        <button class="mp-sort-btn" :class="sortCol==='harga'?'active':''" @click="setSort('harga')">
                            Harga
                            <span class="material-symbols-outlined mp-sort-icon"
                                  x-text="sortCol!=='harga' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                        </button>
                    </th>
                    <th>
                        <button class="mp-sort-btn" :class="sortCol==='durasi'?'active':''" @click="setSort('durasi')">
                            Durasi
                            <span class="material-symbols-outlined mp-sort-icon"
                                  x-text="sortCol!=='durasi' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                        </button>
                    </th>
                    <th>
                        <button class="mp-sort-btn" :class="sortCol==='subscriber'?'active':''" @click="setSort('subscriber')">
                            Subscriber
                            <span class="material-symbols-outlined mp-sort-icon"
                                  x-text="sortCol!=='subscriber' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                        </button>
                    </th>
                    <th><span class="mp-sort-btn" style="cursor:default;pointer-events:none">Aktif</span></th>
                    <th><span class="mp-sort-btn" style="cursor:default;pointer-events:none">Trusted Badge</span></th>
                    <th><span class="mp-sort-btn" style="cursor:default;pointer-events:none">Aksi</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach($paketList as $p)
                <tr
                    data-id="{{ $p['id'] }}"
                    data-nama="{{ strtolower($p['nama']) }}"
                    data-harga="{{ $p['harga'] }}"
                    data-durasi="{{ $p['durasi'] }}"
                    data-subscriber="{{ $p['subscriber'] ?? 0 }}"
                    data-aktif="{{ $p['isAktif'] ? '1' : '0' }}"
                    data-trusted="{{ $p['isTrusted'] ? '1' : '0' }}"
                    data-item="{{ json_encode($p) }}"
                    x-show="tampilPaket($el)"
                    x-transition.opacity.duration.300ms
                >
                    <td>
                        <div class="font-semibold text-slate-800">{{ $p['nama'] }}</div>
                        @if(!empty($p['subtitle']))
                        <div class="text-xs text-slate-400 mt-0.5">{{ $p['subtitle'] }}</div>
                        @endif
                    </td>
                    <td><span class="mp-mono font-bold text-slate-800">Rp {{ number_format($p['harga'], 0, ',', '.') }}</span></td>
                    <td class="text-slate-600">{{ $p['durasi'] }} hari</td>
                    <td>
                        <span class="font-semibold text-slate-700">{{ $p['subscriber'] ?? 0 }}</span>
                        <span class="text-xs text-slate-400 ml-1">dev</span>
                    </td>
                    <td>
                        <button
                            class="mp-toggle {{ $p['isAktif'] ? 'is-on' : '' }}"
                            @click="bukaToggleKonfirmasi('aktif', {{ $p['id'] }}, {{ $p['isAktif'] ? 'true' : 'false' }}, '{{ addslashes($p['nama']) }}')"
                            title="{{ $p['isAktif'] ? 'Nonaktifkan' : 'Aktifkan' }} paket ini">
                        </button>
                    </td>
                    <td>
                        <button
                            class="mp-toggle {{ $p['isTrusted'] ? 'is-on-blue' : '' }}"
                            @click="bukaToggleKonfirmasi('trusted', {{ $p['id'] }}, {{ $p['isTrusted'] ? 'true' : 'false' }}, '{{ addslashes($p['nama']) }}')"
                            title="{{ $p['isTrusted'] ? 'Cabut' : 'Berikan' }} trusted badge">
                        </button>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <button class="mp-action mp-action-edit" @click="bukaEdit($el.closest('tr'))">
                                <span class="material-symbols-outlined text-[.9rem]">edit</span>
                                Edit
                            </button>
                            <button class="mp-action mp-action-delete" @click="bukaDeleteKonfirmasi({{ $p['id'] }}, '{{ addslashes($p['nama']) }}')">
                                <span class="material-symbols-outlined text-[.9rem]">delete</span>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach

                <tr x-show="!adaPaketHasil()" x-cloak>
                    <td colspan="7">
                        <div class="mp-empty">
                            <div class="mp-empty-icon">
                                <span class="material-symbols-outlined text-[1.8rem] text-slate-400">manage_search</span>
                            </div>
                            <div class="font-semibold text-slate-500 text-sm">Tidak ada paket ditemukan</div>
                            <div class="text-xs text-slate-400 mt-1">Coba ubah filter atau kata kunci pencarian</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mp-pagi">
            <div>Menampilkan <span x-text="visibleIds.length"></span> dari <span x-text="totalItems"></span> paket</div>
            <div class="flex items-center gap-1">
                <button class="mp-pagi-btn" @click="currentPage > 1 && (currentPage--, updatePagi())" :disabled="currentPage <= 1">‹</button>
                <template x-for="p in totalPages" :key="p">
                    <button class="mp-pagi-btn" :class="currentPage===p?'active':''" @click="currentPage=p; updatePagi()" x-text="p"></button>
                </template>
                <button class="mp-pagi-btn" @click="currentPage < totalPages && (currentPage++, updatePagi())" :disabled="currentPage >= totalPages">›</button>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════
     SLIDE-OUT PANEL — Edit Paket
══════════════════════════════════════ --}}
<div class="mp-panel-bg" x-show="editTerbuka" x-cloak style="display:none"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    @click.self="tutupEdit()" @keydown.escape.window="tutupEdit()">
    <div class="mp-panel" x-show="editTerbuka"
        x-transition:enter="transition cubic-bezier(0.16,1,0.3,1) duration-400" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition cubic-bezier(0.4,0,0.2,1) duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">

        <div class="mp-panel-header">
            <div class="flex items-center justify-between">
                <div>
                    <div class="mp-sora font-bold text-slate-900 text-base flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-600 text-[1.1rem]">edit</span>
                        Edit Paket
                    </div>
                    <div class="text-xs text-slate-400 mt-0.5" x-text="editForm ? 'Mengedit: ' + editForm.nama : ''"></div>
                </div>
                <button @click="tutupEdit()" class="mp-btn-icon">
                    <span class="material-symbols-outlined text-[1.2rem]">close</span>
                </button>
            </div>
        </div>

        <template x-if="editForm">
            <div class="mp-panel-body">

                <div class="mp-panel-section">Informasi Dasar</div>

                <div class="mp-form-group">
                    <label class="mp-form-label">Nama Paket <span class="mp-form-required">*</span></label>
                    <input type="text" class="mp-form-input" x-model="editForm.nama" placeholder="Contoh: Basic Playtest">
                </div>
                <div class="mp-form-group">
                    <label class="mp-form-label">Subtitle Dasar</label>
                    <input type="text" class="mp-form-input" x-model="editForm.subtitle" placeholder="Solusi dasar untuk memenuhi syarat...">
                    <div class="mp-form-note">Deskripsi singkat yang tampil di bawah nama paket</div>
                </div>
                <div class="mp-form-group">
                    <label class="mp-form-label">Deskripsi</label>
                    <textarea class="mp-form-textarea" x-model="editForm.deskripsi" placeholder="Deskripsi lengkap paket ini..."></textarea>
                </div>

                <div class="mp-panel-section">Harga &amp; Durasi</div>

                <div class="mp-form-row">
                    <div class="mp-form-group" style="margin-bottom:0">
                        <label class="mp-form-label">Harga (Rp) <span class="mp-form-required">*</span></label>
                        <input type="number" class="mp-form-input" x-model="editForm.harga" placeholder="250000" min="0">
                    </div>
                    <div class="mp-form-group" style="margin-bottom:0">
                        <label class="mp-form-label">Durasi (hari) <span class="mp-form-required">*</span></label>
                        <input type="number" class="mp-form-input" x-model="editForm.durasi" placeholder="30" min="1">
                    </div>
                </div>

                <div class="mp-panel-section">Batas &amp; Kuota</div>

                <div class="mp-form-row">
                    <div class="mp-form-group" style="margin-bottom:0">
                        <label class="mp-form-label">Max Kampanye</label>
                        <input type="number" class="mp-form-input" x-model="editForm.maxKampanye" placeholder="1" min="0">
                    </div>
                    <div class="mp-form-group" style="margin-bottom:0">
                        <label class="mp-form-label">Max Tester</label>
                        <input type="number" class="mp-form-input" x-model="editForm.maxTester" placeholder="10" min="0">
                    </div>
                </div>
                <div class="mp-form-row" style="margin-top:14px">
                    <div class="mp-form-group" style="margin-bottom:0">
                        <label class="mp-form-label">Coin Reward Tester</label>
                        <input type="number" class="mp-form-input" x-model="editForm.coinReward" placeholder="500" min="0">
                    </div>
                    <div class="mp-form-group" style="margin-bottom:0">
                        <label class="mp-form-label">Max Revisi</label>
                        <input type="number" class="mp-form-input" x-model="editForm.maxRevisi" placeholder="2" min="0">
                    </div>
                </div>

                <div class="mp-panel-section">Pengaturan Fitur</div>

                <div class="flex flex-col gap-3">
                    <div class="mp-toggle-row">
                        <div>
                            <div class="mp-toggle-row-label">Status Aktif</div>
                            <div class="mp-toggle-row-sub">Paket tersedia untuk dipilih developer</div>
                        </div>
                        <button class="mp-form-toggle" :class="editForm.isAktif ? 'is-on' : ''" @click="editForm.isAktif = !editForm.isAktif" type="button"></button>
                    </div>
                    <div class="mp-toggle-row">
                        <div>
                            <div class="mp-toggle-row-label">Trusted Badge</div>
                            <div class="mp-toggle-row-sub">Tampilkan badge "Dipercaya" pada paket ini</div>
                        </div>
                        <button class="mp-form-toggle" :class="editForm.isTrusted ? 'is-on-blue' : ''" @click="editForm.isTrusted = !editForm.isTrusted" type="button"></button>
                    </div>
                    <div class="mp-toggle-row">
                        <div>
                            <div class="mp-toggle-row-label">Tampilkan di Landing Page</div>
                            <div class="mp-toggle-row-sub">Paket muncul pada halaman publik</div>
                        </div>
                        <button class="mp-form-toggle" :class="editForm.tampilLanding ? 'is-on' : ''" @click="editForm.tampilLanding = !editForm.tampilLanding" type="button"></button>
                    </div>
                </div>

            </div>
        </template>

        <div class="mp-panel-footer">
            <button class="mp-btn mp-btn-ghost" @click="tutupEdit()">Batal</button>
            <button class="mp-btn mp-btn-primary flex-1" @click="simpanEdit()">
                <span class="material-symbols-outlined text-[1rem]">save</span>
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════
     CONFIRM — Toggle Aktif / Trusted
══════════════════════════════════════ --}}
<template x-teleport="body">
    <div class="mp-confirm-overlay" x-show="toggleK.terbuka" x-cloak style="display:none"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        @click.self="toggleK.terbuka=false">
        <div class="mp-confirm-box"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-90 translate-y-6" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            <div class="mp-confirm-header">
                <h3 class="mp-sora mp-confirm-title">
                    <span class="material-symbols-outlined mp-confirm-icon"
                          :class="toggleK.cls"
                          x-text="toggleK.icon"></span>
                    <span x-text="toggleK.judul"></span>
                </h3>
                <button @click="toggleK.terbuka=false" class="mp-btn-icon">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="mp-confirm-body">
                <div class="mp-alert" :class="toggleK.alertCls">
                    <span class="material-symbols-outlined text-[1.3rem] mt-0.5" :class="toggleK.alertIconCls">info</span>
                    <div>
                        <p class="mp-alert-title" :class="toggleK.txtCls">Apakah Anda yakin?</p>
                        <p class="mp-alert-text"  :class="toggleK.txtCls" x-text="toggleK.pesan"></p>
                    </div>
                </div>
            </div>
            <div class="mp-confirm-footer">
                <button class="mp-btn mp-btn-ghost" @click="toggleK.terbuka=false">Batal</button>
                <button class="mp-btn" :class="toggleK.btnCls" @click="konfirmasiToggle()">
                    <span x-text="toggleK.label"></span>
                </button>
            </div>
        </div>
    </div>
</template>

{{-- ══════════════════════════════════════
     CONFIRM — Delete Paket
══════════════════════════════════════ --}}
<template x-teleport="body">
    <div class="mp-confirm-overlay" x-show="deleteK.terbuka" x-cloak style="display:none"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        @click.self="deleteK.terbuka=false">
        <div class="mp-confirm-box"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-90 translate-y-6" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            <div class="mp-confirm-header">
                <h3 class="mp-sora mp-confirm-title">
                    <span class="material-symbols-outlined mp-confirm-icon c-danger">delete_forever</span>
                    Hapus Paket
                </h3>
                <button @click="deleteK.terbuka=false" class="mp-btn-icon">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="mp-confirm-body">
                <div class="mp-alert mp-alert-danger">
                    <span class="material-symbols-outlined text-[1.3rem] mt-0.5 text-red-500">warning</span>
                    <div>
                        <p class="mp-alert-title c-danger">Tindakan ini tidak dapat dibatalkan!</p>
                        <p class="mp-alert-text c-danger">Anda akan menghapus paket <strong x-text="'«' + deleteK.nama + '»'"></strong>. Semua data yang terkait akan ikut terhapus secara permanen.</p>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-slate-600 mb-2">Ketik nama paket untuk mengonfirmasi:</p>
                    <input type="text" class="mp-form-input" :placeholder="deleteK.nama" x-model="deleteK.konfTeks">
                </div>
            </div>
            <div class="mp-confirm-footer">
                <button class="mp-btn mp-btn-ghost" @click="deleteK.terbuka=false">Batal</button>
                <button class="mp-btn mp-btn-danger" :disabled="deleteK.konfTeks !== deleteK.nama" @click="konfirmasiDelete()">
                    <span class="material-symbols-outlined text-[1rem]">delete_forever</span>
                    Ya, Hapus Sekarang
                </button>
            </div>
        </div>
    </div>
</template>

</div>{{-- end x-data --}}

@push('scripts')
<script>
function manajemenPaket() {
    return {
        /* Filter & sort */
        cariPaket: '', filterAktif: '', filterTrusted: '',
        perPage: 10, currentPage: 1, totalItems: 0, totalPages: 1, visibleIds: [],
        sortCol: 'nama', sortDir: 'asc',

        /* Edit panel */
        editTerbuka: false,
        editForm: null,

        /* Toggle confirmation */
        toggleK: {
            terbuka: false, tipe: '', id: null, nama: '', nyalakan: false,
            judul: '', pesan: '', label: '', icon: '', cls: '',
            alertCls: '', alertIconCls: '', txtCls: '', btnCls: '',
        },

        /* Delete confirmation */
        deleteK: { terbuka: false, id: null, nama: '', konfTeks: '' },

        /* ────── init ────── */
        init() {
            this.updatePagi();
            ['cariPaket','filterAktif','filterTrusted','perPage','sortCol','sortDir']
                .forEach(k => this.$watch(k, () => this.resetPagi()));
        },

        initChart() {
            this.$nextTick(() => {
                document.querySelectorAll('.mp-chart-bar').forEach(bar => {
                    const t = parseInt(bar.dataset.target || 0);
                    bar.style.height = '0px';
                    setTimeout(() => { bar.style.height = t + 'px'; }, 400);
                });
            });
        },

        /* ────── Sort ────── */
        setSort(col) {
            if (this.sortCol === col) { this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc'; }
            else { this.sortCol = col; this.sortDir = 'asc'; }
        },

        /* ────── Filter & Pagination ────── */
        resetPagi() { this.currentPage = 1; this.$nextTick(() => this.updatePagi()); },

        updatePagi() {
            const tbody = document.querySelector('.mp-table tbody');
            if (!tbody) return;
            const rows = Array.from(tbody.querySelectorAll('tr[data-id]'));

            // Sort rows in DOM
            rows.sort((a, b) => {
                let va, vb;
                if      (this.sortCol === 'nama')       { va = (a.dataset.nama || '').toLowerCase(); vb = (b.dataset.nama || '').toLowerCase(); }
                else if (this.sortCol === 'harga')      { va = +a.dataset.harga;      vb = +b.dataset.harga; }
                else if (this.sortCol === 'durasi')     { va = +a.dataset.durasi;     vb = +b.dataset.durasi; }
                else if (this.sortCol === 'subscriber') { va = +a.dataset.subscriber; vb = +b.dataset.subscriber; }
                else return 0;
                return va < vb ? (this.sortDir==='asc'?-1:1) : (va > vb ? (this.sortDir==='asc'?1:-1) : 0);
            });
            rows.forEach(r => tbody.appendChild(r));
            
            const emptyRow = tbody.querySelector('tr[x-show="!adaPaketHasil()"]');
            if (emptyRow) tbody.appendChild(emptyRow);

            let m = rows.filter(r => this.cocokFilter(r));

            this.totalItems  = m.length;
            this.totalPages  = Math.ceil(m.length / this.perPage) || 1;
            if (this.currentPage > this.totalPages && this.totalPages > 0) this.currentPage = this.totalPages;
            else if (this.currentPage < 1 && this.totalPages > 0) this.currentPage = 1;

            const s = (this.currentPage - 1) * parseInt(this.perPage);
            this.visibleIds = m.slice(s, s + parseInt(this.perPage)).map(r => r.dataset.id);
        },

        cocokFilter(el) {
            const q = this.cariPaket.toLowerCase().trim();
            if (q && !(el.dataset.nama || '').includes(q)) return false;
            if (this.filterAktif   && el.dataset.aktif   !== this.filterAktif)   return false;
            if (this.filterTrusted && el.dataset.trusted !== this.filterTrusted) return false;
            return true;
        },

        tampilPaket($el) { return this.visibleIds.includes($el.dataset.id); },

        adaPaketHasil() {
            for (const r of document.querySelectorAll('tbody tr[data-id]')) { if (this.cocokFilter(r)) return true; }
            return false;
        },

        resetFilter() {
            this.cariPaket = ''; this.filterAktif = ''; this.filterTrusted = '';
            this.perPage = 10; this.sortCol = 'nama'; this.sortDir = 'asc';
        },

        /* ────── Edit Panel ────── */
        bukaEdit(row) {
            const d = JSON.parse(row.dataset.item);
            this.editForm = {
                id: d.id, nama: d.nama ?? '', subtitle: d.subtitle ?? '',
                deskripsi: d.deskripsi ?? '', harga: d.harga ?? 0,
                durasi: d.durasi ?? 30, maxKampanye: d.maxKampanye ?? 1,
                maxTester: d.maxTester ?? 10, coinReward: d.coinReward ?? 0,
                maxRevisi: d.maxRevisi ?? 2, isAktif: d.isAktif ?? true,
                isTrusted: d.isTrusted ?? false, tampilLanding: d.tampilLanding ?? true,
            };
            this.editTerbuka = true;
        },

        tutupEdit() {
            this.editTerbuka = false;
            setTimeout(() => { this.editForm = null; }, 300);
        },

        simpanEdit() {
            if (!this.editForm) return;
            this.$wire.updatePaket(this.editForm);
            this.tutupEdit();
        },

        /* ────── Toggle Confirmation ────── */
        bukaToggleKonfirmasi(tipe, id, statusSaatIni, nama) {
            const nyalakan = !statusSaatIni;
            let judul, pesan, label, icon, cls, alertCls, alertIconCls, txtCls, btnCls;

            if (tipe === 'aktif') {
                judul    = nyalakan ? 'Aktifkan Paket' : 'Nonaktifkan Paket';
                pesan    = nyalakan
                    ? `Paket «${nama}» akan diaktifkan dan dapat dipilih oleh developer.`
                    : `Paket «${nama}» akan dinonaktifkan. Developer baru tidak bisa memilih paket ini.`;
                label    = nyalakan ? 'Ya, Aktifkan' : 'Ya, Nonaktifkan';
                icon     = 'power_settings_new';
                cls      = nyalakan ? 'c-success' : 'c-warning';
                alertCls = nyalakan ? 'mp-alert-success' : 'mp-alert-warning';
                alertIconCls = nyalakan ? 'text-green-600' : 'text-amber-500';
                txtCls   = nyalakan ? 'c-success' : 'c-warning';
                btnCls   = nyalakan ? 'mp-btn-success' : 'mp-btn-ghost';
            } else {
                judul    = nyalakan ? 'Berikan Trusted Badge' : 'Cabut Trusted Badge';
                pesan    = nyalakan
                    ? `Badge "Dipercaya" akan diberikan pada paket «${nama}».`
                    : `Badge "Dipercaya" pada paket «${nama}» akan dicabut.`;
                label    = nyalakan ? 'Ya, Berikan Badge' : 'Ya, Cabut Badge';
                icon     = 'workspace_premium';
                cls      = 'c-info';
                alertCls = 'mp-alert-info';
                alertIconCls = 'text-blue-600';
                txtCls   = 'c-info';
                btnCls   = 'mp-btn-primary';
            }

            this.toggleK = { terbuka: true, tipe, id, nama, nyalakan, judul, pesan, label, icon, cls, alertCls, alertIconCls, txtCls, btnCls };
        },

        konfirmasiToggle() {
            const { tipe, id, nyalakan } = this.toggleK;
            if (tipe === 'aktif')   this.$wire.toggleAktif(id, nyalakan);
            else                    this.$wire.toggleTrusted(id, nyalakan);
            this.toggleK.terbuka = false;
        },

        /* ────── Delete Confirmation ────── */
        bukaDeleteKonfirmasi(id, nama) {
            this.deleteK = { terbuka: true, id, nama, konfTeks: '' };
        },

        konfirmasiDelete() {
            if (this.deleteK.konfTeks !== this.deleteK.nama) return;
            this.$wire.deletePaket(this.deleteK.id);
            this.deleteK.terbuka = false;
        },
    };
}
</script>
@endpush

</x-filament-panels::page>