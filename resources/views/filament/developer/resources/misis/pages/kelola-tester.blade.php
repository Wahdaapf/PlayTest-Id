<x-filament-panels::page>

    @push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        .mp-sora { font-family: 'Sora', sans-serif !important; }
        .mp-mono { font-family: 'JetBrains Mono', monospace !important; }

        /* ══ ANIMATIONS ══ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }

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

        .mp-grad-blue   { background: linear-gradient(90deg, #2563eb, #60a5fa); }
        .mp-grad-green  { background: linear-gradient(90deg, #22c55e, #86efac); }
        .mp-grad-orange { background: linear-gradient(90deg, #f59e0b, #fcd34d); }
        .mp-grad-rose   { background: linear-gradient(90deg, #e11d48, #fb7185); }

        .mp-bg-blue   { background: #eff6ff; color: #2563eb; }
        .mp-bg-green  { background: #dcfce7; color: #16a34a; }
        .mp-bg-orange { background: #fffbeb; color: #d97706; }
        .mp-bg-rose   { background: #fff1f2; color: #e11d48; }

        /* ══ FILTER BAR ══ */
        .mp-filter-bar {
            background: transparent; border-top: 1px solid #e2e8f0; padding: 12px 16px;
            display: flex; flex-wrap: wrap; gap: 10px; align-items: center;
        }
        .mp-search-wrap { position: relative; flex: 2; min-width: 220px; }
        .mp-search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 1.2rem; transition: color 0.2s; }
        .mp-search-wrap:focus-within .mp-search-icon { color: #2563eb; }
        .mp-input, .mp-select {
            border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 14px; font-size: .85rem; color: #334155;
            background: #f8fafc; outline: none; transition: all .2s; font-family: 'Inter', sans-serif;
        }
        .mp-input:focus, .mp-select:focus { border-color: #2563eb; background: #fff; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
        .mp-search-input { width: 100%; padding-left: 42px !important; }

        .mp-tab {
            padding: 12px 18px;
            font-size: .85rem;
            font-weight: 600;
            color: #334155;
            background: transparent;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Inter', sans-serif;
        }

        .mp-tab.active {
            border-bottom-color: #2563eb;
            color: #2563eb;
            font-weight: 600;
        }

        .mp-tab.inactive {
            color: #64748b;
        }

        .mp-tab.inactive:hover {
            color: #475569;
        }

        .mp-count-badge {
            font-size: 0.65rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 9999px;
            font-family: 'JetBrains Mono', monospace;
        }

        /* ══ BUTTONS ══ */
        .mp-btn {
            padding: 8px 16px; border-radius: 8px; font-size: .85rem; font-weight: 600; cursor: pointer; border: none;
            transition: all .15s cubic-bezier(0.4, 0, 0.2, 1); font-family: 'Inter', sans-serif; display: inline-flex; align-items: center; gap: 6px; justify-content: center;
        }
        .mp-btn-ghost { background: #f1f5f9; color: #64748b; }
        .mp-btn-ghost:hover { background: #e2e8f0; color: #334155; }

        /* ══ SORT HEADER BUTTON ══ */
        .mp-sort-btn {
            display: inline-flex; align-items: center; gap: 3px; background: none; border: none; cursor: pointer;
            font-size: .75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .07em; padding: 0; transition: color 0.2s; font-family: 'Inter', sans-serif; white-space: nowrap;
        }
        .mp-sort-btn:hover, .mp-sort-btn.active { color: #2563eb; }
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

        /* ══ BADGES ══ */
        .mp-badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 8px; font-size: 0.7rem; font-weight: 600; white-space: nowrap; }
        .mp-badge-accepted { background: #dcfce7; color: #16a34a; }
        .mp-badge-progress { background: #fef9c3; color: #ca8a04; }
        .mp-badge-selesai { background: #f0fdf4; color: #15803d; }
        .mp-badge-pending, .mp-badge-reviewing, .mp-badge-submitted { background: #eff6ff; color: #2563eb; }
        .mp-badge-rejected, .mp-badge-failed { background: #fff1f2; color: #be123c; }

        /* ══ ACTION BUTTONS ══ */
        .mp-action-btn { position: relative; width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s ease; border: 1px solid transparent; }
        .mp-action-btn .mp-tooltip { display: none; position: absolute; bottom: calc(100% + 6px); left: 50%; transform: translateX(-50%); background: #1e293b; color: #fff; font-size: 0.65rem; padding: 3px 8px; border-radius: 6px; white-space: nowrap; pointer-events: none; z-index: 50; }
        .mp-action-btn:hover .mp-tooltip { display: block; }
        .mp-action-approve { background: #f0fdf4; border-color: #bbf7d0; color: #16a34a; }
        .mp-action-approve:hover { background: #dcfce7; transform: scale(1.05); }
        .mp-action-danger { background: #fff1f2; border-color: #fecdd3; color: #e11d48; }
        .mp-action-danger:hover { background: #ffe4e6; transform: scale(1.05); }

        /* ══ PAGINATION ══ */
        .mp-pagi { display: flex; align-items: center; justify-content: space-between; padding: 14px 20px; border-top: 1px solid #f1f5f9; font-size: .8rem; color: #64748b; }
        .mp-pagi-btn { width: 32px; height: 32px; border-radius: 8px; border: 1px solid #e2e8f0; background: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: .85rem; color: #475569; transition: all .15s; }
        .mp-pagi-btn:hover { background: #eff6ff; border-color: #2563eb; color: #2563eb; transform: translateY(-1px); }
        .mp-pagi-btn.active { background: #2563eb; border-color: #2563eb; color: #fff; box-shadow: 0 4px 10px rgba(37,99,235,0.25); }
        .mp-pagi-btn:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }

        /* ══ EMPTY STATE ══ */
        .mp-empty { padding: 48px 20px; text-align: center; }
        .mp-empty-icon { width: 56px; height: 56px; background: #f1f5f9; border-radius: 16px; margin: 0 auto 14px; display: flex; align-items: center; justify-content: center; }

        [x-cloak] { display: none !important; }

        /* ══ DARK MODE OVERRIDES ══ */
        .dark .mp-stat, .dark .mp-table-wrap { background: #1e293b; border-color: #334155; }
        .dark .mp-stat-value { color: #f8fafc !important; }
        .dark .mp-stat-label, .dark .mp-stat-sub { color: #94a3b8; }
        .dark .mp-filter-bar { border-color: #334155; }
        .dark .mp-input, .dark .mp-select { background: #0f172a; border-color: #334155; color: #f8fafc; }
        .dark .mp-input:focus, .dark .mp-select:focus { background: #1e293b; border-color: #3b82f6; }
        .dark .mp-tab { color: #94a3b8; }
        .dark .mp-tab.active { color: #60a5fa; border-bottom-color: #60a5fa; }
        .dark .mp-tab.inactive:hover { color: #cbd5e1; }
        .dark .mp-btn-ghost { background: #0f172a; color: #94a3b8; border-color: #334155; }
        .dark .mp-btn-ghost:hover { background: #334155; color: #f8fafc; }
        .dark .mp-table thead tr { background: #0f172a; border-color: #334155; }
        .dark .mp-table td { border-color: #334155; color: #cbd5e1; }
        .dark .mp-table tbody tr:hover { background: #0f172a; }
        .dark .mp-sort-btn { color: #94a3b8; }
        .dark .mp-sort-btn:hover, .dark .mp-sort-btn.active { color: #f8fafc; }
        .dark .mp-pagi { border-color: #334155; color: #94a3b8; }
        .dark .mp-pagi-btn { background: #0f172a; border-color: #334155; color: #94a3b8; }
        .dark .mp-pagi-btn:hover { background: #334155; color: #f8fafc; }
        .dark .mp-pagi-btn.active { background: #2563eb; color: #fff; border-color: #2563eb; }
        .dark .mp-empty-icon { background: #0f172a; }
        
        .dark .text-slate-900, .dark h1, .dark h3 { color: #f8fafc !important; }
        .dark .text-slate-800 { color: #e2e8f0 !important; }
        .dark .text-slate-500 { color: #94a3b8 !important; }
        .dark p[style*="color:#1e293b"] { color: #f8fafc !important; }
        .dark p[style*="color:#94a3b8"], .dark span[style*="color:#64748b"] { color: #94a3b8 !important; }
        .dark div[style*="border-bottom:1px solid #e2e8f0"] { border-color: #334155 !important; }
        
        .dark span[style*="background:#f1f5f9"] { background: #334155 !important; color: #cbd5e1 !important; }
        .dark span[style*="background:#f0fdf4"] { background: rgba(22,163,74,0.2) !important; color: #86efac !important; }
        .dark span[style*="background:#fffbeb"] { background: rgba(217,119,6,0.2) !important; color: #fcd34d !important; }
        .dark span[style*="background:#fff1f2"] { background: rgba(225,29,72,0.2) !important; color: #fda4af !important; }
        
        .dark .mp-badge-accepted { background: rgba(22,163,74,0.2); color: #86efac; }
        .dark .mp-badge-progress { background: rgba(202,138,4,0.2); color: #fde047; }
        .dark .mp-badge-selesai { background: rgba(21,128,61,0.2); color: #86efac; }
        .dark .mp-badge-pending, .dark .mp-badge-reviewing, .dark .mp-badge-submitted { background: rgba(37,99,235,0.2); color: #93c5fd; }
        .dark .mp-badge-rejected, .dark .mp-badge-failed { background: rgba(190,18,60,0.2); color: #fda4af; }
        
        .dark .mp-action-approve { background: rgba(22,163,74,0.2); border-color: rgba(74,222,128,0.2); color: #86efac; }
        .dark .mp-action-approve:hover { background: rgba(22,163,74,0.3); }
        .dark .mp-action-danger { background: rgba(225,29,72,0.2); border-color: rgba(251,113,133,0.2); color: #fda4af; }
        .dark .mp-action-danger:hover { background: rgba(225,29,72,0.3); }

        /* Responsive additions */
        @media (max-width: 640px) {
            .mp-pagi { flex-direction: column; gap: 1rem; justify-content: center; text-align: center; }
            .mp-filter-bar { flex-direction: column; align-items: stretch; }
            .mp-search-wrap, .mp-select, .mp-btn-ghost { width: 100%; max-width: 100% !important; }
        }
    </style>
    @endpush

    @php
        $stats = $this->getViewData();
    @endphp

    <div class="space-y-5" x-data="kelolaTesterApp()">
        {{-- ══ HEADER ══ --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between animate-fade-in-up gap-4 sm:gap-0">
            <div class="w-full sm:w-auto">
                <h1 class="mp-sora text-xl font-bold text-slate-900">{{ __('Kelola Daftar Tester :') }} {{ $this->record->nama_aplikasi }}</h1>
                <p class="text-sm text-slate-500 mt-0.5">{{ __('Kelola persetujuan dan partisipasi tester untuk kampanye ini.') }}</p>
            </div>
        </div>

        {{-- ══ STAT CARDS ══ --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 animate-fade-in-up delay-100">
            <div class="mp-stat">
                <div class="mp-stat-accent mp-grad-blue"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="mp-stat-icon mp-bg-blue"><span class="material-symbols-outlined">group</span></div>
                    <div class="flex-1 min-w-0">
                        <div class="mp-stat-label">{{ __('Total Tester') }}</div>
                        <div class="mp-stat-value">{{ $stats['statTotal'] }}</div>
                        <div class="mp-stat-sub">{{ __('berpartisipasi') }}</div>
                    </div>
                </div>
            </div>
            <div class="mp-stat">
                <div class="mp-stat-accent mp-grad-green"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="mp-stat-icon mp-bg-green"><span class="material-symbols-outlined">how_to_reg</span></div>
                    <div>
                        <div class="mp-stat-label">{{ __('Diterima') }}</div>
                        <div class="mp-stat-value text-green-700">{{ $stats['statDiterima'] }}</div>
                        <div class="mp-stat-sub">{{ __('sedang/telah menguji') }}</div>
                    </div>
                </div>
            </div>
            <div class="mp-stat">
                <div class="mp-stat-accent mp-grad-orange"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="mp-stat-icon mp-bg-orange"><span class="material-symbols-outlined">pending_actions</span></div>
                    <div class="flex-1 min-w-0">
                        <div class="mp-stat-label">{{ __('Menunggu') }}</div>
                        <div class="mp-stat-value text-amber-600">{{ $stats['statMenunggu'] }}</div>
                        <div class="mp-stat-sub">{{ __('perlu ditinjau') }}</div>
                    </div>
                </div>
            </div>
            <div class="mp-stat">
                <div class="mp-stat-accent mp-grad-rose"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="mp-stat-icon mp-bg-rose"><span class="material-symbols-outlined">block</span></div>
                    <div>
                        <div class="mp-stat-label">{{ __('Ditolak') }}</div>
                        <div class="mp-stat-value" style="color:#e11d48;">{{ $stats['statDitolak'] }}</div>
                        <div class="mp-stat-sub">{{ __('ditolak / gagal') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ TABLE SECTION ══ --}}
        <div class="animate-fade-in-up delay-200">

            <div class="flex items-center justify-between mb-4">
                <div class="mp-sora font-bold text-slate-900 text-base flex items-center gap-2">
                    <span class="material-symbols-outlined text-blue-600 text-[1.2rem]">manage_accounts</span>
                    {{ __('Daftar Tester') }}
                </div>
            </div>

            <div class="mp-table-wrap">
                {{-- Filter Tabs --}}
                <div style="border-bottom:1px solid #e2e8f0;">
                    <div class="flex items-center flex-wrap gap-0 px-1">
                        <button class="mp-tab" :class="filterAktif==='semua' ? 'active' : 'inactive'" @click="setFilter('semua')">
                            {{ __('Semua') }}
                            <span class="mp-count-badge" style="background:#f1f5f9;color:#64748b;">{{ $stats['statTotal'] }}</span>
                        </button>
                        <button class="mp-tab" :class="filterAktif==='diterima' ? 'active' : 'inactive'" @click="setFilter('diterima')">
                            {{ __('Diterima') }}
                            <span class="mp-count-badge" style="background:#f0fdf4;color:#16a34a;">{{ $stats['statDiterima'] }}</span>
                        </button>
                        <button class="mp-tab" :class="filterAktif==='menunggu' ? 'active' : 'inactive'" @click="setFilter('menunggu')">
                            {{ __('Menunggu') }}
                            <span class="mp-count-badge" style="background:#fffbeb;color:#b45309;">{{ $stats['statMenunggu'] }}</span>
                        </button>
                        <button class="mp-tab" :class="filterAktif==='ditolak' ? 'active' : 'inactive'" @click="setFilter('ditolak')">
                            {{ __('Ditolak') }}
                            <span class="mp-count-badge" style="background:#fff1f2;color:#e11d48;">{{ $stats['statDitolak'] }}</span>
                        </button>
                    </div>
                </div>

                {{-- Filter Bar --}}
                <div class="mp-filter-bar">
                    <div class="mp-search-wrap">
                        <span class="material-symbols-outlined mp-search-icon">search</span>
                        <input type="text" class="mp-input mp-search-input" placeholder="{{ __('Cari tester...') }}" x-model.debounce.300ms="cariTeks">
                    </div>
                    <select class="mp-select" x-model="filterStatus">
                        <option value="">{{ __('Semua Status') }}</option>
                        <option value="accepted">{{ __('Diterima') }}</option>
                        <option value="pending">{{ __('Menunggu') }}</option>
                        <option value="progress">{{ __('Berlangsung') }}</option>
                        <option value="selesai">{{ __('Selesai') }}</option>
                        <option value="rejected">{{ __('Ditolak') }}</option>
                    </select>
                    <select class="mp-select max-w-[120px]" x-model="perPage">
                        <option value="5">{{ __('5 Data') }}</option>
                        <option value="10">{{ __('10 Data') }}</option>
                        <option value="20">{{ __('20 Data') }}</option>
                        <option value="50">{{ __('50 Data') }}</option>
                        <option value="1000">{{ __('Semua') }}</option>
                    </select>
                    <button class="mp-btn mp-btn-ghost" @click="resetFilter()">{{ __('Reset') }}</button>
                </div>

                {{-- Table Body --}}
                <div class="overflow-x-auto">
                    <table class="mp-table">
                        <thead>
                            <tr>
                                <th>
                                    <button class="mp-sort-btn" :class="sortCol==='nama'?'active':''" @click="setSort('nama')">
                                        {{ __('Nama Tester') }}
                                        <span class="material-symbols-outlined mp-sort-icon" x-text="sortCol!=='nama' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                                    </button>
                                </th>
                                <th>
                                    <span class="mp-sort-btn" style="cursor:default;">{{ __('Badge') }}</span>
                                </th>
                                <th>
                                    <button class="mp-sort-btn" :class="sortCol==='status'?'active':''" @click="setSort('status')">
                                        {{ __('Status') }}
                                        <span class="material-symbols-outlined mp-sort-icon" x-text="sortCol!=='status' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                                    </button>
                                </th>
                                <th>
                                    <button class="mp-sort-btn" :class="sortCol==='tanggal'?'active':''" @click="setSort('tanggal')">
                                        {{ __('Bergabung Pada') }}
                                        <span class="material-symbols-outlined mp-sort-icon" x-text="sortCol!=='tanggal' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                                    </button>
                                </th>
                                <th class="text-center">
                                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">{{ __('Aksi') }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats['testerList'] as $idx => $t)
                                <tr data-id="{{ $t['id'] }}" 
                                    data-nama="{{ strtolower($t['nama']) }}" 
                                    data-status="{{ $t['raw_status'] }}" 
                                    data-tanggal="{{ \Carbon\Carbon::parse($t['tanggal'])->timestamp }}"
                                    x-show="tampilRow($el)" x-cloak>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold text-white flex-shrink-0"
                                                 style="background:{{ $t['avatarColor'] }};">{{ $t['inisial'] }}</div>
                                            <div>
                                                <p class="text-sm font-semibold" style="color:#1e293b;">{{ $t['nama'] }}</p>
                                                <p class="text-xs" style="color:#94a3b8;">{{ $t['email'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="
                                            display: inline-flex;
                                            align-items: center;
                                            gap: 4px;
                                            padding: 3px 10px;
                                            border-radius: 9999px;
                                            font-size: 11px;
                                            font-weight: 600;
                                            color: {{ $t['badgeColor'] }};
                                            background-color: color-mix(in srgb, {{ $t['badgeColor'] }} 12%, transparent);
                                            border: 1px solid color-mix(in srgb, {{ $t['badgeColor'] }} 30%, transparent);
                                            white-space: nowrap;
                                        ">
                                            {{ $t['badgeIcon'] }} {{ $t['badgeTier'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mp-badge mp-badge-{{ $t['raw_status'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#94a3b8;"></span>
                                            {{ $t['status'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm mp-mono" style="color:#64748b;">{{ $t['tanggal'] }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            @if(in_array($t['raw_status'], ['pending', 'reviewing']))
                                                <button class="mp-action-btn mp-action-approve" title="{{ __('Terima') }}" wire:click="terimaTester({{ $t['id'] }})" wire:loading.attr="disabled">
                                                    <span class="material-symbols-outlined text-[1.1rem]">check_circle</span>
                                                    <div class="mp-tooltip">{{ __('Terima Tester') }}</div>
                                                </button>
                                                <button class="mp-action-btn mp-action-danger" title="{{ __('Tolak') }}" wire:click="tolakTester({{ $t['id'] }})" wire:loading.attr="disabled" wire:confirm="{{ __('Yakin ingin menolak tester ini?') }}">
                                                    <span class="material-symbols-outlined text-[1.1rem]">cancel</span>
                                                    <div class="mp-tooltip">{{ __('Tolak Tester') }}</div>
                                                </button>
                                            @else
                                                <span class="text-xs text-slate-400 italic">{{ __('-') }}</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Empty State --}}
                    <div class="mp-empty" x-show="!adaHasil()" x-cloak>
                        <div class="mp-empty-icon">
                            <span class="material-symbols-outlined text-slate-400 text-3xl">group_off</span>
                        </div>
                        <h3 class="text-base font-semibold text-slate-800 mb-1">{{ __('Tidak ada tester') }}</h3>
                        <p class="text-sm text-slate-500">{{ __('Belum ada tester yang cocok dengan pencarian Anda.') }}</p>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="mp-pagi">
                    <span>
                        {{ __('Menampilkan') }}
                        <strong class="text-slate-800 mp-mono" x-text="visibleIds.length"></strong>
                        {{ __('dari') }} <strong class="text-slate-800 mp-mono" x-text="totalItems"></strong> {{ __('tester') }}
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
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function kelolaTesterApp() {
            return {
                filterAktif: 'semua',
                cariTeks: '',
                filterStatus: '',
                sortCol: 'tanggal',
                sortDir: 'asc',
                perPage: 10,
                currentPage: 1,
                totalPages: 1,
                totalItems: 0,
                visibleIds: [],

                get pageRange() {
                    const t = this.totalPages, c = this.currentPage;
                    if (t <= 7) return Array.from({length: t}, (_, i) => i + 1);
                    const pages = [];
                    if (c > 3) { pages.push(1); if (c > 4) pages.push('…'); }
                    for (let i = Math.max(1, c - 2); i <= Math.min(t, c + 2); i++) pages.push(i);
                    if (c < t - 2) { if (c < t - 3) pages.push('…'); pages.push(t); }
                    return pages;
                },

                init() {
                    this.$watch('cariTeks', () => { this.currentPage = 1; this.applyFilter(); });
                    this.$watch('filterStatus', () => { this.currentPage = 1; this.applyFilter(); });
                    this.$watch('perPage', () => { this.currentPage = 1; this.applyFilter(); });
                    
                    document.addEventListener('livewire:initialized', () => {
                        Livewire.hook('morph.updated', ({ el, component }) => {
                            this.applyFilter();
                        });
                    });

                    this.applyFilter();
                },

                setFilter(val) {
                    this.filterAktif = val;
                    this.currentPage = 1;
                    this.applyFilter();
                },

                setSort(col) {
                    if (this.sortCol === col) this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
                    else { this.sortCol = col; this.sortDir = 'asc'; }
                    this.currentPage = 1;
                    this.applyFilter();
                },

                resetFilter() {
                    this.filterAktif = 'semua';
                    this.cariTeks = '';
                    this.filterStatus = '';
                    this.perPage = 10;
                    this.sortCol = 'tanggal';
                    this.sortDir = 'asc';
                    this.currentPage = 1;
                    this.applyFilter();
                },

                applyFilter() {
                    const tbody = document.querySelector('.mp-table tbody');
                    if (!tbody) return;
                    const rows = Array.from(tbody.querySelectorAll('tr[data-id]'));

                    // Sort
                    const dir = this.sortDir === 'asc' ? 1 : -1;
                    rows.sort((a, b) => {
                        switch(this.sortCol) {
                            case 'nama': return dir * (a.dataset.nama || '').localeCompare(b.dataset.nama || '');
                            case 'status': return dir * (a.dataset.status || '').localeCompare(b.dataset.status || '');
                            case 'tanggal': return dir * ((+a.dataset.tanggal) - (+b.dataset.tanggal));
                            default: return 0;
                        }
                    });
                    rows.forEach(r => tbody.appendChild(r));

                    // Filter
                    const matched = rows.filter(r => this.cocokFilter(r));
                    
                    this.totalItems = matched.length;
                    this.totalPages = Math.ceil(matched.length / this.perPage) || 1;
                    if (this.currentPage > this.totalPages) this.currentPage = this.totalPages;
                    if (this.currentPage < 1) this.currentPage = 1;

                    const start = (this.currentPage - 1) * parseInt(this.perPage);
                    this.visibleIds = matched.slice(start, start + parseInt(this.perPage)).map(r => r.dataset.id);
                },

                cocokFilter(el) {
                    const status = el.dataset.status || '';
                    
                    // Tab filter
                    if (this.filterAktif === 'diterima' && !['accepted','progress','selesai'].includes(status)) return false;
                    if (this.filterAktif === 'menunggu' && !['pending','reviewing','submitted'].includes(status)) return false;
                    if (this.filterAktif === 'ditolak' && !['rejected','failed'].includes(status)) return false;

                    // Dropdown filter
                    if (this.filterStatus && status !== this.filterStatus.toLowerCase()) return false;
                    
                    // Search
                    if (this.cariTeks) {
                        const q = this.cariTeks.toLowerCase();
                        if (!(el.dataset.nama || '').includes(q)) return false;
                    }
                    return true;
                },

                tampilRow($el) {
                    return this.visibleIds.includes($el.dataset.id);
                },

                adaHasil() {
                    return this.visibleIds.length > 0;
                }
            };
        }
    </script>
    @endpush

</x-filament-panels::page>
