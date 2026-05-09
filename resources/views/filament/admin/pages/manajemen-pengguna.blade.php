{{--
    Manajemen Pengguna — PlayTest ID Admin Panel
    Page   : ManajemenPengguna.php
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
    .mp-grad-violet  { background: linear-gradient(90deg, #7c3aed, #a78bfa); }
    .mp-bg-blue    { background: #eff6ff; color: #2563eb; }
    .mp-bg-green   { background: #dcfce7; color: #16a34a; }
    .mp-bg-orange  { background: #fef9c3; color: #f59e0b; }
    .mp-bg-violet  { background: #f5f3ff; color: #7c3aed; }

    /* ══ FILTER BAR ══ */
    .mp-filter-bar { background: transparent; border-top: 1px solid #e2e8f0; padding: 12px 16px; display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
    .mp-search-wrap { position: relative; flex: 2; min-width: 220px; }
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
    .mp-btn-ghost { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
    .mp-btn-ghost:hover { background: #e2e8f0; color: #1e293b; }

    /* ══ FILTER TABS ══ */
    .mp-tab { display: inline-flex; align-items: center; gap: 6px; padding: 14px 16px; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.15s ease; border-bottom: 2px solid transparent; white-space: nowrap; background: transparent; border-top: none; border-left: none; border-right: none; font-family: 'Inter', sans-serif; }
    .mp-tab.active   { color: #1e293b; border-bottom-color: #2563eb; font-weight: 600; }
    .mp-tab.inactive { color: #64748b; }
    .mp-tab.inactive:hover { color: #475569; }
    .mp-count-badge { font-size: 0.65rem; font-weight: 600; padding: 2px 7px; border-radius: 9999px; font-family: 'JetBrains Mono', monospace; }

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
    .mp-table th.text-center { text-align: center; }
    .mp-table td { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; font-size: .85rem; color: #334155; transition: background 0.2s; }
    .mp-table tbody tr { transition: all .2s; }
    .mp-table tbody tr td:first-child { border-left: 3px solid transparent; transition: border-color 0.2s; }
    .mp-table tbody tr:hover { background: #f8fafc; }
    .mp-table tbody tr:hover td:first-child { border-left-color: #2563eb; }
    .mp-table tbody tr:last-child td { border-bottom: none; }

    /* ══ BADGES ══ */
    .mp-badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 8px; font-size: 0.7rem; font-weight: 600; white-space: nowrap; }
    .mp-badge-developer { background: #dbeafe; color: #1d4ed8; }
    .mp-badge-tester    { background: #dcfce7; color: #16a34a; }
    .mp-badge-aktif     { background: #f0fdf4; color: #15803d; }
    .mp-badge-pending   { background: #fffbeb; color: #b45309; }
    .mp-badge-suspend   { background: #fff1f2; color: #be123c; }

    /* ══ ACTION BUTTONS ══ */
    .mp-action-btn { position: relative; width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s ease; border: 1px solid transparent; }
    .mp-action-btn .mp-tooltip { display: none; position: absolute; bottom: calc(100% + 6px); left: 50%; transform: translateX(-50%); background: #1e293b; color: #fff; font-size: 0.65rem; padding: 3px 8px; border-radius: 6px; white-space: nowrap; pointer-events: none; z-index: 50; }
    .mp-action-btn:hover .mp-tooltip { display: block; }
    .mp-action-detail   { background: #f8fafc; border-color: #e2e8f0; }
    .mp-action-detail:hover { background: #f1f5f9; transform: scale(1.05); }
    .mp-action-approve  { background: #f0fdf4; border-color: #bbf7d0; }
    .mp-action-approve:hover { background: #dcfce7; transform: scale(1.05); }
    .mp-action-danger   { background: #fff1f2; border-color: #fecdd3; }
    .mp-action-danger:hover { background: #ffe4e6; transform: scale(1.05); }
    .mp-action-reactive { background: #eff6ff; border-color: #bfdbfe; }
    .mp-action-reactive:hover { background: #dbeafe; transform: scale(1.05); }

    /* ══ PAGINATION ══ */
    .mp-pagi { display: flex; align-items: center; justify-content: space-between; padding: 14px 20px; border-top: 1px solid #f1f5f9; font-size: .8rem; color: #64748b; }
    .mp-pagi-btn { width: 32px; height: 32px; border-radius: 8px; border: 1px solid #e2e8f0; background: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: .85rem; color: #475569; transition: all .15s; }
    .mp-pagi-btn:hover { background: #eff6ff; border-color: #2563eb; color: #2563eb; transform: translateY(-1px); }
    .mp-pagi-btn.active { background: #2563eb; border-color: #2563eb; color: #fff; box-shadow: 0 4px 10px rgba(37,99,235,0.25); }
    .mp-pagi-btn:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }

    /* ══ EMPTY STATE ══ */
    .mp-empty { padding: 48px 20px; text-align: center; }
    .mp-empty-icon { width: 56px; height: 56px; background: #f1f5f9; border-radius: 16px; margin: 0 auto 14px; display: flex; align-items: center; justify-content: center; }

    /* ══ MODAL ══ */
    .mp-modal-overlay { position: fixed; inset: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 1rem; }
    .mp-modal-backdrop { position: absolute; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); }
    .mp-modal-box { position: relative; z-index: 1; background: #ffffff; border-radius: 20px; box-shadow: 0 25px 60px rgba(0,0,0,0.2); width: 100%; max-width: 520px; overflow: hidden; }
    .mp-modal-header { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; }
    .mp-modal-body   { padding: 1.5rem; }
    .mp-modal-footer { display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9; background: #f8fafc; }
    .mp-detail-row { display: flex; align-items: flex-start; gap: 0.75rem; padding: 0.625rem 0; border-bottom: 1px solid #f8fafc; }
    .mp-detail-row:last-child { border-bottom: none; }
    .mp-detail-label { font-size: 0.75rem; color: #94a3b8; font-weight: 500; width: 120px; flex-shrink: 0; padding-top: 1px; }
    .mp-detail-value { font-size: 0.8125rem; color: #1e293b; font-weight: 500; flex: 1; }
</style>
@endpush

<div class="space-y-5" x-data="manajemenPengguna()" x-init="init()" @keydown.escape.window="tutupModal()">

{{-- ══ HEADER ══ --}}
<div class="flex items-center justify-between animate-fade-in-up">
    <div>
        <h1 class="mp-sora text-xl font-bold text-slate-900">Manajemen Pengguna</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola semua Developer dan Tester yang terdaftar di platform</p>
    </div>
    <button class="mp-btn mp-btn-primary">
        <span class="material-symbols-outlined text-[1.1rem]">download</span>
        Export CSV
    </button>
</div>

{{-- ══ STAT CARDS ══ --}}
<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 animate-fade-in-up delay-100">

    {{-- Total Pengguna --}}
    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-blue"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-blue">
                <span class="material-symbols-outlined">group</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="mp-stat-label">Total Pengguna</div>
                <div class="mp-stat-value">{{ $statTotal }}</div>
                <div class="mp-stat-sub">pengguna terdaftar</div>
            </div>
        </div>
    </div>

    {{-- Developer --}}
    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-violet"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-violet">
                <span class="material-symbols-outlined">code</span>
            </div>
            <div>
                <div class="mp-stat-label">Developer</div>
                <div class="mp-stat-value" style="color:#7c3aed;">{{ $statDeveloper }}</div>
                <div class="mp-stat-sub">akun developer</div>
            </div>
        </div>
    </div>

    {{-- Tester --}}
    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-green"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-green">
                <span class="material-symbols-outlined">verified</span>
            </div>
            <div>
                <div class="mp-stat-label">Tester</div>
                <div class="mp-stat-value text-green-700">{{ $statTester }}</div>
                <div class="mp-stat-sub">akun tester</div>
            </div>
        </div>
    </div>

    {{-- Pending Approval --}}
    <div class="mp-stat">
        <div class="mp-stat-accent mp-grad-orange"></div>
        <div class="flex items-start gap-3 mt-1">
            <div class="mp-stat-icon mp-bg-orange">
                <span class="material-symbols-outlined">pending_actions</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="mp-stat-label">Menunggu Approval</div>
                <div class="mp-stat-value text-amber-600">{{ $statPending }}</div>
                <div class="mp-stat-sub">perlu ditinjau</div>
            </div>
        </div>
    </div>

</div>

{{-- ══ DAFTAR PENGGUNA TABLE ══ --}}
<div class="animate-fade-in-up delay-200">

    <div class="flex items-center justify-between mb-4">
        <div class="mp-sora font-bold text-slate-900 text-base flex items-center gap-2">
            <span class="material-symbols-outlined text-blue-600 text-[1.2rem]">manage_accounts</span>
            Daftar Pengguna
        </div>
    </div>

    <div class="mp-table-wrap">

        {{-- Filter Tabs --}}
        <div style="border-bottom:1px solid #e2e8f0;">
            <div class="flex items-center flex-wrap gap-0 px-1">
                <button class="mp-tab" :class="filterAktif==='semua'    ? 'active' : 'inactive'" @click="setFilter('semua')">
                    Semua
                    <span class="mp-count-badge" style="background:#f1f5f9;color:#64748b;">{{ $statTotal }}</span>
                </button>
                <button class="mp-tab" :class="filterAktif==='developer' ? 'active' : 'inactive'" @click="setFilter('developer')">
                    Developer
                    <span class="mp-count-badge" style="background:#eff6ff;color:#2563eb;">{{ $statDeveloper }}</span>
                </button>
                <button class="mp-tab" :class="filterAktif==='tester'   ? 'active' : 'inactive'" @click="setFilter('tester')">
                    Tester
                    <span class="mp-count-badge" style="background:#f0fdf4;color:#16a34a;">{{ $statTester }}</span>
                </button>
                <button class="mp-tab" :class="filterAktif==='pending'  ? 'active' : 'inactive'" @click="setFilter('pending')">
                    Pending
                    <span class="mp-count-badge" style="background:#fffbeb;color:#b45309;">{{ $statPending }}</span>
                </button>
            </div>
        </div>

        {{-- Filter Bar --}}
        <div class="mp-filter-bar">
            <div class="mp-search-wrap">
                <span class="material-symbols-outlined mp-search-icon">search</span>
                <input type="text" placeholder="Cari nama atau email…" class="mp-input mp-search-input" x-model="cariTeks">
            </div>
            <select class="mp-select" x-model="filterStatus">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="pending">Pending</option>
                <option value="suspend">Suspend</option>
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
        <div class="overflow-x-auto">
            <table class="mp-table min-w-[900px]">
                <thead>
                    <tr>
                        <th style="width:32%;">
                            <button class="mp-sort-btn" :class="sortCol==='nama'?'active':''" @click="setSort('nama')">
                                Pengguna
                                <span class="material-symbols-outlined mp-sort-icon"
                                      x-text="sortCol!=='nama'     ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="mp-sort-btn" :class="sortCol==='role'?'active':''" @click="setSort('role')">
                                Role
                                <span class="material-symbols-outlined mp-sort-icon"
                                      x-text="sortCol!=='role'     ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="mp-sort-btn" :class="sortCol==='tanggal'?'active':''" @click="setSort('tanggal')">
                                Tanggal Daftar
                                <span class="material-symbols-outlined mp-sort-icon"
                                      x-text="sortCol!=='tanggal'  ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="mp-sort-btn" :class="sortCol==='status'?'active':''" @click="setSort('status')">
                                Status
                                <span class="material-symbols-outlined mp-sort-icon"
                                      x-text="sortCol!=='status'   ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th class="text-center">
                            <button class="mp-sort-btn" style="margin:0 auto;" :class="sortCol==='kampanye'?'active':''" @click="setSort('kampanye')">
                                Kampanye
                                <span class="material-symbols-outlined mp-sort-icon"
                                      x-text="sortCol!=='kampanye' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th class="text-center">
                            <span class="mp-sort-btn" style="cursor:default;">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penggunaList as $idx => $user)
                    @php
                        $dotColor = ['Aktif' => '#10b981', 'Pending' => '#f59e0b', 'Suspend' => '#ef4444'][$user['status']] ?? '#94a3b8';
                    @endphp
                    <tr
                        data-id="{{ $idx }}"
                        data-nama="{{ strtolower($user['nama']) }}"
                        data-email="{{ strtolower($user['email']) }}"
                        data-role="{{ strtolower($user['role']) }}"
                        data-tanggal="{{ strtotime($user['tanggal'] ?? '') ?: 0 }}"
                        data-status="{{ strtolower($user['status']) }}"
                        data-kampanye="{{ $user['kampanye'] }}"
                        x-show="tampilRow($el)">

                        {{-- Avatar + Nama + Email --}}
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold text-white flex-shrink-0"
                                     style="background:{{ $user['avatarColor'] }};">
                                    {{ $user['inisial'] }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold" style="color:{{ $user['status'] === 'Suspend' ? '#94a3b8' : '#1e293b' }};">
                                        {{ $user['nama'] }}
                                    </p>
                                    <p class="text-xs" style="color:#94a3b8;">{{ $user['email'] }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Role Badge --}}
                        <td>
                            <span class="mp-badge mp-badge-{{ strtolower($user['role']) }}">
                                {{ $user['role'] }}
                            </span>
                        </td>

                        {{-- Tanggal --}}
                        <td>
                            <span class="text-sm mp-mono" style="color:{{ $user['status'] === 'Suspend' ? '#94a3b8' : '#64748b' }};">
                                {{ $user['tanggal'] }}
                            </span>
                        </td>

                        {{-- Status Badge --}}
                        <td>
                            <span class="mp-badge mp-badge-{{ strtolower($user['status']) }}">
                                <span class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:{{ $dotColor }};"></span>
                                {{ $user['status'] }}
                            </span>
                        </td>

                        {{-- Kampanye Count --}}
                        <td class="text-center">
                            <span class="text-sm font-semibold mp-mono"
                                  style="color:{{ $user['status'] === 'Suspend' ? '#94a3b8' : '#1e293b' }};">
                                {{ $user['kampanye'] }}
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td>
                            <div class="flex items-center justify-center gap-1.5">

                                {{-- Detail (selalu ada) --}}
                                <button class="mp-action-btn mp-action-detail" @click="bukaModal({{ $idx }})">
                                    <span class="material-symbols-outlined text-[1rem]" style="color:#64748b;">visibility</span>
                                    <span class="mp-tooltip">Lihat Detail</span>
                                </button>

                                @if($user['status'] === 'Aktif')
                                <button class="mp-action-btn mp-action-danger">
                                    <span class="material-symbols-outlined text-[1rem]" style="color:#ef4444;">block</span>
                                    <span class="mp-tooltip">Suspend</span>
                                </button>

                                @elseif($user['status'] === 'Pending')
                                <button class="mp-action-btn mp-action-approve">
                                    <span class="material-symbols-outlined text-[1rem]" style="color:#16a34a;">check_circle</span>
                                    <span class="mp-tooltip">Approve</span>
                                </button>
                                <button class="mp-action-btn mp-action-danger">
                                    <span class="material-symbols-outlined text-[1rem]" style="color:#ef4444;">cancel</span>
                                    <span class="mp-tooltip">Tolak</span>
                                </button>

                                @elseif($user['status'] === 'Suspend')
                                <button class="mp-action-btn mp-action-reactive">
                                    <span class="material-symbols-outlined text-[1rem]" style="color:#2563eb;">restart_alt</span>
                                    <span class="mp-tooltip">Aktifkan Kembali</span>
                                </button>
                                @endif

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Empty State --}}
            <div x-show="!adaHasil()" x-cloak class="mp-empty">
                <div class="mp-empty-icon">
                    <span class="material-symbols-outlined text-slate-400 text-[1.8rem]">manage_accounts</span>
                </div>
                <p class="text-sm font-semibold text-slate-600">Tidak ada pengguna ditemukan</p>
                <p class="text-xs mt-1 text-slate-400">Coba ubah filter atau kata kunci pencarian</p>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mp-pagi">
            <span>
                Menampilkan
                <strong class="text-slate-800 mp-mono"
                        x-text="totalItems">
                </strong>
                dari <strong class="text-slate-800 mp-mono" x-text="totalItems"></strong> pengguna
            </span>
            <div class="flex items-center gap-1.5">
                <button class="mp-pagi-btn" :disabled="currentPage<=1" @click="currentPage--; applyFilter()">
                    <span class="material-symbols-outlined" style="font-size:1.1rem">chevron_left</span>
                </button>
                <template x-for="p in pageRange" :key="p">
                    <button class="mp-pagi-btn"
                            :class="p===currentPage ? 'active' : ''"
                            :style="p==='…' ? 'cursor:default;border:none;' : ''"
                            @click="if(p!=='…'){ currentPage=p; applyFilter(); }"
                            x-text="p">
                    </button>
                </template>
                <button class="mp-pagi-btn" :disabled="currentPage>=totalPages" @click="currentPage++; applyFilter()">
                    <span class="material-symbols-outlined" style="font-size:1.1rem">chevron_right</span>
                </button>
            </div>
        </div>

    </div>{{-- end mp-table-wrap --}}
</div>{{-- end section --}}


{{-- ══════════════════════════════════════════════════════
     MODAL DETAIL PENGGUNA
══════════════════════════════════════════════════════ --}}
<div class="mp-modal-overlay"
     x-show="modalTerbuka"
     x-cloak
     style="display:none;"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <div class="mp-modal-backdrop" @click="tutupModal()"></div>

    <div class="mp-modal-box"
         @click.stop
         x-show="modalTerbuka"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 -translate-y-2">

        {{-- Header --}}
        <div class="mp-modal-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white flex-shrink-0"
                     :style="'background:' + (pengguna?.avatarColor ?? '#94a3b8')">
                    <span x-text="pengguna?.inisial ?? ''"></span>
                </div>
                <div>
                    <p class="text-sm font-bold mp-sora" style="color:#1e293b;" x-text="pengguna?.nama ?? ''"></p>
                    <p class="text-xs" style="color:#64748b;" x-text="pengguna?.email ?? ''"></p>
                </div>
            </div>
            <button @click="tutupModal()"
                    class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                    style="background:#f8fafc;border:1px solid #e2e8f0;">
                <span class="material-symbols-outlined text-[1rem]" style="color:#64748b;">close</span>
            </button>
        </div>

        {{-- Body --}}
        <div class="mp-modal-body">
            <div class="mp-detail-row">
                <span class="mp-detail-label">Role</span>
                <span class="mp-detail-value">
                    <span class="mp-badge"
                          :class="pengguna?.role === 'Developer' ? 'mp-badge-developer' : 'mp-badge-tester'"
                          x-text="pengguna?.role ?? ''"></span>
                </span>
            </div>
            <div class="mp-detail-row">
                <span class="mp-detail-label">Status</span>
                <span class="mp-detail-value">
                    <span class="mp-badge"
                          :class="{
                              'mp-badge-aktif':   pengguna?.status === 'Aktif',
                              'mp-badge-pending': pengguna?.status === 'Pending',
                              'mp-badge-suspend': pengguna?.status === 'Suspend'
                          }"
                          x-text="pengguna?.status ?? ''"></span>
                </span>
            </div>
            <div class="mp-detail-row">
                <span class="mp-detail-label">Tanggal Daftar</span>
                <span class="mp-detail-value mp-mono" x-text="pengguna?.tanggal ?? ''"></span>
            </div>
            <div class="mp-detail-row">
                <span class="mp-detail-label">Nomor HP</span>
                <span class="mp-detail-value mp-mono" x-text="pengguna?.phone ?? '-'"></span>
            </div>
            <div class="mp-detail-row">
                <span class="mp-detail-label">Kota</span>
                <span class="mp-detail-value" x-text="pengguna?.kota ?? '-'"></span>
            </div>
            <div class="mp-detail-row">
                <span class="mp-detail-label">Total Kampanye</span>
                <span class="mp-detail-value mp-mono font-bold" style="color:#1e293b;" x-text="pengguna?.kampanye ?? 0"></span>
            </div>
        </div>

        {{-- Footer Actions --}}
        <div class="mp-modal-footer">
            <button @click="tutupModal()" class="mp-btn mp-btn-ghost">Tutup</button>

            <template x-if="pengguna?.status === 'Pending'">
                <div class="flex gap-2">
                    <button class="mp-btn" style="background:#fff1f2;color:#ef4444;border:1px solid #fecdd3;">
                        <span class="material-symbols-outlined text-[1rem]">cancel</span>
                        Tolak
                    </button>
                    <button class="mp-btn" style="background:linear-gradient(135deg,#16a34a,#15803d);color:#fff;box-shadow:0 4px 12px rgba(22,163,74,0.25);">
                        <span class="material-symbols-outlined text-[1rem]">check_circle</span>
                        Approve
                    </button>
                </div>
            </template>

            <template x-if="pengguna?.status === 'Aktif'">
                <button class="mp-btn" style="background:#fff1f2;color:#ef4444;border:1px solid #fecdd3;">
                    <span class="material-symbols-outlined text-[1rem]">block</span>
                    Suspend Akun
                </button>
            </template>

            <template x-if="pengguna?.status === 'Suspend'">
                <button class="mp-btn mp-btn-primary">
                    <span class="material-symbols-outlined text-[1rem]">restart_alt</span>
                    Aktifkan Kembali
                </button>
            </template>
        </div>

    </div>{{-- end modal-box --}}
</div>{{-- end modal-overlay --}}

</div>{{-- end Alpine root --}}


@push('scripts')
<script>
/* ─────────────────────────────────────────────
   Data pengguna dari PHP → JavaScript
──────────────────────────────────────────────── */
const PENGGUNA_DATA = @json($penggunaList);

function manajemenPengguna() {
    return {
        /* ── Filter & Search ── */
        filterAktif  : 'semua',
        cariTeks     : '',
        filterStatus : '',

        /* ── Sort ── */
        sortCol : 'nama',
        sortDir : 'asc',

        /* ── Pagination ── */
        perPage     : 10,
        currentPage : 1,
        totalPages  : 1,
        totalItems  : 0,
        visibleIds  : [],

        /* ── Modal ── */
        modalTerbuka : false,
        pengguna     : null,

        /* ── Computed: page range ── */
        get pageRange() {
            const t = this.totalPages, c = this.currentPage;
            if (t <= 7) return Array.from({ length: t }, (_, i) => i + 1);
            const pages = [];
            if (c > 3)   { pages.push(1); if (c > 4) pages.push('…'); }
            for (let i = Math.max(1, c - 2); i <= Math.min(t, c + 2); i++) pages.push(i);
            if (c < t - 2) { if (c < t - 3) pages.push('…'); pages.push(t); }
            return pages;
        },

        /* ── Init ── */
        init() {
            document.body.style.overflow = '';
            this.$watch('cariTeks',     () => { this.currentPage = 1; this.applyFilter(); });
            this.$watch('filterStatus', () => { this.currentPage = 1; this.applyFilter(); });
            this.$watch('perPage',      () => { this.currentPage = 1; this.applyFilter(); });
            this.applyFilter();
        },

        /* ── Sort ── */
        setSort(col) {
            if (this.sortCol === col) this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
            else { this.sortCol = col; this.sortDir = 'asc'; }
            this.currentPage = 1;
            this.applyFilter();
        },

        /* ── Filter Tabs ── */
        setFilter(val) {
            this.filterAktif = val;
            this.filterStatus = val === 'pending' ? 'pending' : '';
            this.currentPage = 1;
            this.applyFilter();
        },

        resetFilter() {
            this.filterAktif  = 'semua';
            this.cariTeks     = '';
            this.filterStatus = '';
            this.perPage      = 10;
            this.sortCol      = 'nama';
            this.sortDir      = 'asc';
            this.currentPage  = 1;
            this.applyFilter();
        },

        /* ── Sort + Filter + Paginate ── */
        applyFilter() {
            const tbody = document.querySelector('tbody');
            if (!tbody) return;
            const rows = Array.from(tbody.querySelectorAll('tr[data-id]'));

            /* ── Sort ── */
            const dir = this.sortDir === 'asc' ? 1 : -1;
            rows.sort((a, b) => {
                switch (this.sortCol) {
                    case 'nama':     return dir * (a.dataset.nama   || '').localeCompare(b.dataset.nama   || '');
                    case 'role':     return dir * (a.dataset.role   || '').localeCompare(b.dataset.role   || '');
                    case 'status':   return dir * (a.dataset.status || '').localeCompare(b.dataset.status || '');
                    case 'tanggal':  return dir * ((+a.dataset.tanggal)  - (+b.dataset.tanggal));
                    case 'kampanye': return dir * ((+a.dataset.kampanye) - (+b.dataset.kampanye));
                    default:         return 0;
                }
            });
            rows.forEach(r => tbody.appendChild(r));

            /* ── Filter ── */
            const matched = rows.filter(r => this.cocokFilter(r));

            this.totalItems = matched.length;
            this.totalPages = Math.ceil(matched.length / this.perPage) || 1;
            if (this.currentPage > this.totalPages) this.currentPage = this.totalPages;
            if (this.currentPage < 1) this.currentPage = 1;

            const start = (this.currentPage - 1) * parseInt(this.perPage);
            this.visibleIds = matched.slice(start, start + parseInt(this.perPage)).map(r => r.dataset.id);
        },

        cocokFilter(el) {
            const role   = el.dataset.role   || '';
            const status = el.dataset.status || '';

            /* tab filter */
            if (this.filterAktif === 'developer' && role   !== 'developer') return false;
            if (this.filterAktif === 'tester'    && role   !== 'tester')    return false;
            if (this.filterAktif === 'pending'   && status !== 'pending')   return false;

            /* dropdown status */
            if (this.filterStatus && status !== this.filterStatus.toLowerCase()) return false;

            /* teks */
            if (this.cariTeks) {
                const q = this.cariTeks.toLowerCase();
                if (!(el.dataset.nama  || '').includes(q) &&
                    !(el.dataset.email || '').includes(q)) return false;
            }
            return true;
        },

        tampilRow($el) {
            return this.visibleIds.includes($el.dataset.id);
        },

        adaHasil() {
            for (const r of document.querySelectorAll('tbody tr[data-id]')) {
                if (this.cocokFilter(r)) return true;
            }
            return false;
        },

        /* ── Modal ── */
        bukaModal(idx) {
            this.pengguna     = PENGGUNA_DATA[idx] ?? null;
            this.modalTerbuka = true;
            document.body.style.overflow = 'hidden';
        },

        tutupModal() {
            this.modalTerbuka = false;
            document.body.style.overflow = '';
            setTimeout(() => { this.pengguna = null; }, 200);
        },
    };
}
</script>
@endpush

</x-filament-panels::page>