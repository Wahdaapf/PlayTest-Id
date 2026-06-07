{{--  
    Admin Dashboard — PlayTest ID  
    Panel  : Admin (path /admin)  
    Page   : AdminDashboard.php  
    Fonts  : Sora (heading), JetBrains Mono (angka), Inter (body)  
--}}  
  
<x-filament-panels::page>  
  
@push('styles')  
<link rel="preconnect" href="https://fonts.googleapis.com">  
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>  
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">  
  
<style>  
/* ══════════════════════════════════════  
   FONTS  
══════════════════════════════════════ */  
.adm-page, .adm-page * { font-family: 'Inter', sans-serif; }  
.font-sora  { font-family: 'Inter', sans-serif !important; }  
.font-mono-data { font-family: 'Inter', sans-serif !important; }  
  
/* ══════════════════════════════════════  
   STAT CARDS  
══════════════════════════════════════ */  
.adm-stat-card {  
    background: #ffffff;  
    border-radius: 1rem;  
    padding: 1rem;  
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);  
    border: 1px solid #f1f5f9;  
    transition: box-shadow 0.2s ease, transform 0.2s ease;  
}  
.adm-stat-card:hover {  
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);  
    transform: translateY(-1px);  
}  
.adm-stat-icon {  
    width: 36px; height: 36px;  
    border-radius: 0.75rem;  
    display: flex; align-items: center; justify-content: center;  
    flex-shrink: 0;  
}  
.adm-progress-track {  
    height: 6px; border-radius: 9999px;  
    background: #f1f5f9; overflow: hidden; margin-top: 12px;  
}  
.adm-progress-fill {  
    height: 100%; border-radius: 9999px;  
    transition: width 1s ease;  
}  
  
/* ══════════════════════════════════════  
   PANEL CARDS (Chart, Table, Quick Actions)  
══════════════════════════════════════ */  
.adm-panel {  
    background: #ffffff;  
    border-radius: 1rem;  
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);  
    border: 1px solid #f1f5f9;  
    overflow: hidden;  
}  
.adm-panel-header {  
    display: flex; align-items: center; justify-content: space-between;  
    padding: 1rem 1.25rem;  
    border-bottom: 1px solid #f1f5f9;  
}  
  
/* ══════════════════════════════════════  
   CHART BARS  
══════════════════════════════════════ */  
.adm-chart-bar {  
    border-radius: 4px 4px 0 0;  
    transition: height 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);  
    min-height: 4px;  
}  
  
/* ══════════════════════════════════════  
   TABLE  
══════════════════════════════════════ */  
.adm-table { width: 100%; border-collapse: collapse; }  
.adm-table th {  
    background: #f8fafc;  
    padding: 0.75rem 1.25rem;  
    font-size: 0.7rem; font-weight: 600;  
    color: #94a3b8; text-transform: uppercase; letter-spacing: 0.06em;  
    text-align: left; border-bottom: 1px solid #f1f5f9;  
    white-space: nowrap;
}  
.adm-table td {  
    padding: 0.875rem 1.25rem;  
    font-size: 0.8125rem;  
    border-bottom: 1px solid #f8fafc;  
    color: #475569;  
    white-space: nowrap;
}  
.adm-table tr:hover td { background-color: #fafafa; }  
.adm-table tr:last-child td { border-bottom: none; }  

/* ══════════════════════════════════════  
   SORT HEADER BUTTON  
══════════════════════════════════════ */  
.adm-sort-btn { display: inline-flex; align-items: center; gap: 3px; background: none; border: none; cursor: pointer; font-size: .7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: .06em; padding: 0; transition: color 0.2s; font-family: 'Inter', sans-serif; white-space: nowrap; }  
.adm-sort-btn:hover  { color: #2563eb; }  
.adm-sort-btn.active { color: #2563eb; }  
.adm-sort-icon { font-size: .95rem !important; line-height: 1; }  
  
/* ══════════════════════════════════════  
   BADGES  
══════════════════════════════════════ */  
.adm-badge {  
    display: inline-flex; align-items: center;  
    padding: 2px 10px; border-radius: 9999px;  
    font-size: 0.7rem; font-weight: 600; white-space: nowrap;  
}  
.adm-badge-developer { background: #eff6ff; color: #1d4ed8; }  
.adm-badge-tester    { background: #f0fdf4; color: #15803d; }  
.adm-badge-aktif     { background: #f0fdf4; color: #16a34a; }  
.adm-badge-pending   { background: #fffbeb; color: #b45309; }  
.adm-badge-suspend   { background: #fef2f2; color: #dc2626; }  
.adm-badge-selesai   { background: #f5f3ff; color: #6d28d9; }  
.adm-badge-ditinjau  { background: #fefce8; color: #a16207; }  
  
/* ══════════════════════════════════════  
   QUICK ACTION BUTTONS  
══════════════════════════════════════ */  
.adm-qa-btn {  
    width: 100%; display: flex; align-items: center; gap: 0.75rem;  
    padding: 0.75rem 1rem; border-radius: 0.75rem;  
    font-size: 0.8125rem; font-weight: 500;  
    cursor: pointer; transition: all 0.15s ease; text-align: left;  
    border: 1px solid transparent; background: transparent;  
}  
.adm-qa-icon {  
    width: 32px; height: 32px; border-radius: 0.5rem;  
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;  
}  
  
/* ══════════════════════════════════════  
   INISIAL AVATAR  
══════════════════════════════════════ */  
.adm-avatar {  
    width: 32px; height: 32px; border-radius: 9999px;  
    display: flex; align-items: center; justify-content: center;  
    font-size: 0.7rem; font-weight: 700; flex-shrink: 0;  
}  
  
/* ══════════════════════════════════════  
   KAMPANYE MINI CARD  
══════════════════════════════════════ */  
.adm-kamp-card {  
    padding: 0.875rem;  
    border-radius: 0.75rem;  
    background: #f8fafc;  
    border: 1px solid #f1f5f9;  
    transition: background 0.15s;  
}  
.adm-kamp-card:hover { background: #f1f5f9; }

/* ══════════════════════════════════════
   EXPORT DROPDOWN
══════════════════════════════════════ */
.adm-export-dropdown {
    position: absolute; top: calc(100% + 8px); right: 0;
    background: #ffffff; border: 1px solid #e2e8f0;
    border-radius: 0.875rem; min-width: 280px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.12), 0 2px 8px rgba(0,0,0,0.06);
    overflow: hidden; z-index: 50;
}
.adm-export-dropdown-header {
    padding: 10px 14px 8px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.7rem; font-weight: 700; color: #94a3b8;
    text-transform: uppercase; letter-spacing: 0.08em;
}
.adm-export-item {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 16px; width: 100%; text-align: left;
    background: transparent; border: none; cursor: pointer;
    transition: background 0.12s ease; text-decoration: none; color: inherit;
}
.adm-export-item:hover { background: #f8fafc; }
.adm-export-item:last-child { border-top: 1px solid #f1f5f9; margin-top: 4px; }
.adm-export-icon {
    width: 30px; height: 30px; border-radius: 0.5rem; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
}
.adm-export-item-label { font-size: 0.8125rem; font-weight: 600; color: #1e293b; }
.adm-export-item-sub   { font-size: 0.7rem; color: #94a3b8; margin-top: 1px; }
</style>  
@endpush  
  
{{-- ═══════════════════════════════════════════════  
     DASHBOARD CONTENT  (Alpine root)  
════════════════════════════════════════════════ --}}  
<div class="adm-page" x-data="adminDashboard()" wire:poll.3s>  
  
    {{-- ── PAGE HEADER ─────────────────────────────────── --}}  
    <div data-design-id="page-header" class="flex items-center justify-between mb-6 px-6 pt-6">  
        <div>  
                     
            <p class="text-sm mt-0.5" style="color:#64748b;">  
                {{ __('Ringkasan platform PlayTest ID — data diperbarui') }} {{ now()->diffForHumans() }}  
            </p>  
        </div>  
        <div class="flex items-center gap-3">  

            {{-- ── Export Dropdown ───────────────────────── --}}
            <div class="relative" x-data="{ openExport: false }" @click.outside="openExport = false">
                <button
                    @click="openExport = !openExport"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-150"
                    :class="openExport ? 'border-blue-600 text-blue-600 bg-blue-50 border' : 'bg-white border border-slate-200 text-slate-500'"
                    id="export-dropdown-btn"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/>
                    </svg>
                    {{ __('Ekspor') }}
                    <svg class="w-3 h-3 transition-transform duration-200" :class="openExport ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown Panel --}}
                <div
                    x-show="openExport"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    class="adm-export-dropdown"
                    style="display:none;"
                >
                    <div class="adm-export-dropdown-header">{{ __('Pilih Format Ekspor') }}</div>

                    {{-- Export Pengguna CSV --}}
                    <a href="{{ route('admin.export.pengguna') }}" class="adm-export-item" @click="openExport=false" id="export-pengguna">
                        <div class="adm-export-icon" style="background:#eff6ff;">
                            <svg style="width:15px;height:15px;color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="adm-export-item-label">{{ __('Ekspor Pengguna') }}</div>
                            <div class="adm-export-item-sub">{{ __('Semua pengguna — .csv') }}</div>
                        </div>
                        <span style="font-size:10px;font-weight:700;padding:2px 7px;border-radius:9999px;background:#eff6ff;color:#2563eb;">CSV</span>
                    </a>

                    {{-- Export Kampanye CSV --}}
                    <a href="{{ route('admin.export.kampanye') }}" class="adm-export-item" @click="openExport=false" id="export-kampanye">
                        <div class="adm-export-icon" style="background:#fffbeb;">
                            <svg style="width:15px;height:15px;color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M3 11l19-9-9 19-2-8-8-2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="adm-export-item-label">{{ __('Ekspor Kampanye') }}</div>
                            <div class="adm-export-item-sub">{{ __('Semua misi & status — .csv') }}</div>
                        </div>
                        <span style="font-size:10px;font-weight:700;padding:2px 7px;border-radius:9999px;background:#fffbeb;color:#d97706;">CSV</span>
                    </a>

                    {{-- Export Pendapatan CSV --}}
                    <a href="{{ route('admin.export.pendapatan') }}" class="adm-export-item" @click="openExport=false" id="export-pendapatan">
                        <div class="adm-export-icon" style="background:#f0fdf4;">
                            <svg style="width:15px;height:15px;color:#10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="adm-export-item-label">{{ __('Ekspor Pendapatan') }}</div>
                            <div class="adm-export-item-sub">{{ __('Riwayat transaksi — .csv') }}</div>
                        </div>
                        <span style="font-size:10px;font-weight:700;padding:2px 7px;border-radius:9999px;background:#f0fdf4;color:#16a34a;">CSV</span>
                    </a>

                    {{-- Export Laporan PDF --}}
                    <a href="{{ route('admin.export.pdf') }}" target="_blank" class="adm-export-item" @click="openExport=false" id="export-pdf">
                        <div class="adm-export-icon" style="background:#fef2f2;">
                            <svg style="width:15px;height:15px;color:#ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="adm-export-item-label">{{ __('Laporan Lengkap') }}</div>
                            <div class="adm-export-item-sub">{{ __('Ringkasan dashboard — PDF') }}</div>
                        </div>
                        <span style="font-size:10px;font-weight:700;padding:2px 7px;border-radius:9999px;background:#fef2f2;color:#dc2626;">PDF</span>
                    </a>

                </div>
            </div>{{-- end export dropdown --}}

            <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white"  
                    style="background:#2563eb;box-shadow:0 4px 14px rgba(37,99,235,0.3);"  
                    wire:click="$refresh">  
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">  
                    <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>  
                </svg>  
                {{ __('Perbarui Data') }}  
            </button>  
        </div>  
    </div>  
  
    <div class="px-6 pb-6">  
  
        {{-- ══════════════════════════════════════  
             STAT CARDS — 6 kolom  
        ══════════════════════════════════════ --}}  
        <div data-design-id="stat-cards-grid"  
             class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-5">  
  
            {{-- Card 1: Developer --}}  
            <div data-design-id="stat-card-developer" class="adm-stat-card" style="border-top:4px solid #2563eb;">  
                <div class="flex items-start gap-3">  
                    <div class="adm-stat-icon" style="background:#eff6ff;">  
                        <svg style="width:18px;height:18px;color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                            <path d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>  
                        </svg>  
                    </div>  
                    <div class="flex-1 min-w-0">  
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">{{ __('Developer') }}</p>  
                        <p class="text-2xl font-bold mt-0.5 leading-none font-mono-data" style="color:#1e293b;">{{ $statDeveloper }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#10b981;">{{ $devBulanIni }} {{ __('bulan ini') }}</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track mt-3">  
                    <div class="adm-progress-fill" style="width:{{ $statDeveloper > 0 ? min(round(($devBulanIni / $statDeveloper) * 100), 100) : 0 }}%;background:#2563eb;"></div>  
                </div>  
            </div>  
  
            {{-- Card 2: Tester --}}  
            <div data-design-id="stat-card-tester" class="adm-stat-card" style="border-top:4px solid #10b981;">  
                <div class="flex items-start gap-3">  
                    <div class="adm-stat-icon" style="background:#f0fdf4;">  
                        <svg style="width:18px;height:18px;color:#10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>  
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>  
                        </svg>  
                    </div>  
                    <div class="flex-1 min-w-0">  
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">{{ __('Tester') }}</p>  
                        <p class="text-2xl font-bold mt-0.5 leading-none font-mono-data" style="color:#1e293b;">{{ $statTester }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#10b981;">{{ $testerBulanIni }} {{ __('bulan ini') }}</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track mt-3">  
                    <div class="adm-progress-fill" style="width:{{ $statTester > 0 ? min(round(($testerBulanIni / $statTester) * 100), 100) : 0 }}%;background:#10b981;"></div>  
                </div>  
            </div>  
  
            {{-- Card 3: Kampanye Aktif --}}  
            <div data-design-id="stat-card-aktif" class="adm-stat-card" style="border-top:4px solid #f59e0b;">  
                <div class="flex items-start gap-3">  
                    <div class="adm-stat-icon" style="background:#fffbeb;">  
                        <svg style="width:18px;height:18px;color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                            <path d="M3 11l19-9-9 19-2-8-8-2z"/>  
                        </svg>  
                    </div>  
                    <div class="flex-1 min-w-0">  
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">{{ __('Aktif') }}</p>  
                        <p class="text-2xl font-bold mt-0.5 leading-none font-mono-data" style="color:#1e293b;">{{ $statAktif }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#f59e0b;">{{ $aktifMingguIni }} {{ __('minggu ini') }}</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track mt-3">  
                    <div class="adm-progress-fill" style="width:{{ $statAktif > 0 ? min(round(($aktifMingguIni / $statAktif) * 100), 100) : 0 }}%;background:#f59e0b;"></div>  
                </div>  
            </div>  
  
            {{-- Card 4: Kampanye Selesai --}}  
            <div data-design-id="stat-card-selesai" class="adm-stat-card" style="border-top:4px solid #8b5cf6;">  
                <div class="flex items-start gap-3">  
                    <div class="adm-stat-icon" style="background:#f5f3ff;">  
                        <svg style="width:18px;height:18px;color:#8b5cf6;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>  
                        </svg>  
                    </div>  
                    <div class="flex-1 min-w-0">  
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">{{ __('Selesai') }}</p>  
                        <p class="text-2xl font-bold mt-0.5 leading-none font-mono-data" style="color:#1e293b;">{{ $statSelesai }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#8b5cf6;">{{ __('Total kampanye') }}</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track">  
                    <div class="adm-progress-fill" style="width:{{ $statTotalKampanye > 0 ? min(round(($statSelesai / $statTotalKampanye) * 100), 100) : 0 }}%;background:#8b5cf6;"></div>  
                </div>  
            </div>  
  
            {{-- Card 5: Pendapatan --}}  
            <div data-design-id="stat-card-pendapatan" class="adm-stat-card" style="border-top:4px solid #10b981;">  
                <div class="flex items-start gap-3">  
                    <div class="adm-stat-icon" style="background:#f0fdf4;">  
                        <svg style="width:18px;height:18px;color:#10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                            <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>  
                        </svg>  
                    </div>  
                    <div class="flex-1 min-w-0">  
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">{{ __('Pendapatan') }}</p>  
                        <p class="text-xl font-bold mt-0.5 leading-none font-mono-data" style="color:#1e293b;">Rp {{ $statPendapatan }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#10b981;">{{ $statGrowthPendapatan }} {{ __('vs bulan lalu') }}</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track mt-3">  
                    <div class="adm-progress-fill" style="width:{{ (int) str_replace(['+', '%'], '', $statGrowthPendapatan) > 0 ? min(100, (int) str_replace(['+', '%'], '', $statGrowthPendapatan)) : 10 }}%;background:#10b981;"></div>  
                </div>  
            </div>  
  
            {{-- Card 6: Pending Approval --}}  
            <div data-design-id="stat-card-pending" class="adm-stat-card" style="border-top:4px solid #ef4444;">  
                <div class="flex items-start gap-3">  
                    <div class="adm-stat-icon" style="background:#fef2f2;">  
                        <svg style="width:18px;height:18px;color:#ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                            <circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/>  
                        </svg>  
                    </div>  
                    <div class="flex-1 min-w-0">  
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">{{ __('Tertunda') }}</p>  
                        <p class="text-2xl font-bold mt-0.5 leading-none font-mono-data" style="color:#ef4444;">{{ $statPending }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#ef4444;">{{ __('Perlu ditinjau') }}</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track">  
                    <div class="adm-progress-fill" style="width:35%;background:#ef4444;"></div>  
                </div>  
            </div>  
  
        </div>{{-- end stat cards --}}  
  
  
        {{-- ══════════════════════════════════════  
             MIDDLE ROW — Chart + Quick Actions  
        ══════════════════════════════════════ --}}  
        <div data-design-id="middle-row" class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">  
  
            {{-- ── Bar Chart Aktivitas Mingguan ────────── --}}  
            <div data-design-id="chart-card" class="adm-panel lg:col-span-2">  
                <div class="adm-panel-header">  
                    <div>  
                        <h2 class="text-sm font-semibold font-sora" style="color:#1e293b;">{{ __('Aktivitas Mingguan') }}</h2>  
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ __('Registrasi Developer vs Tester (7 hari terakhir)') }}</p>  
                    </div>  
                    <div class="flex items-center gap-4 text-xs">  
                        <div class="flex items-center gap-1.5">  
                            <div class="w-2.5 h-2.5 rounded-full" style="background:#2563eb;"></div>  
                            <span style="color:#64748b;">{{ __('Developer') }}</span>  
                        </div>  
                        <div class="flex items-center gap-1.5">  
                            <div class="w-2.5 h-2.5 rounded-full" style="background:#10b981;"></div>  
                            <span style="color:#64748b;">{{ __('Tester') }}</span>  
                        </div>  
                    </div>  
                </div>  
  
                <div class="px-5 py-5">  
                    {{-- Bar chart --}}  
                    <div class="flex items-end gap-3" style="height:144px;">  
                        @php $maxChartVal = max(array_merge($chartDev ?: [0], $chartTester ?: [0])) ?: 1; @endphp
                        @foreach($chartHari as $i => $hari)  
                        <div class="flex-1 flex flex-col items-center gap-1">  
                            <div class="w-full flex items-end gap-0.5 justify-center" style="height:112px;">  
                                <div class="adm-chart-bar flex-1"  
                                     style="background:#2563eb;max-width:14px;  
                                            {{ ($i >= 5) ? 'opacity:0.65;' : '' }}  
                                            height:{{ round(($chartDev[$i] / $maxChartVal) * 100) }}%;"  
                                     data-target="{{ round(($chartDev[$i] / $maxChartVal) * 100) }}%">  
                                </div>  
                                <div class="adm-chart-bar flex-1"  
                                     style="background:#10b981;max-width:14px;  
                                            {{ ($i >= 5) ? 'opacity:0.65;' : '' }}  
                                            height:{{ round(($chartTester[$i] / $maxChartVal) * 100) }}%;"  
                                     data-target="{{ round(($chartTester[$i] / $maxChartVal) * 100) }}%">  
                                </div>  
                            </div>  
                            <span class="text-xs font-medium" style="color:#94a3b8;">{{ $hari }}</span>  
                        </div>  
                        @endforeach  
                    </div>  
  
                    {{-- Chart stats row --}}  
                    <div class="flex items-center justify-between mt-4 pt-4" style="border-top:1px solid #f1f5f9;">  
                        <div class="text-center">  
                            <p class="text-sm font-bold font-mono-data" style="color:#2563eb;">{{ $statDevMingguIni }}</p>  
                            <p class="text-xs" style="color:#94a3b8;">{{ __('Developer minggu ini') }}</p>  
                        </div>  
                        <div class="text-center">  
                            <p class="text-sm font-bold font-mono-data" style="color:#10b981;">{{ $statTesterMingguIni }}</p>  
                            <p class="text-xs" style="color:#94a3b8;">{{ __('Tester minggu ini') }}</p>  
                        </div>  
                        <div class="text-center">  
                            <p class="text-sm font-bold font-mono-data" style="color:#1e293b;">{{ $statRasio }}</p>  
                            <p class="text-xs" style="color:#94a3b8;">{{ __('Rasio Dev:Tester') }}</p>  
                        </div>  
                        <div class="text-center">  
                            <p class="text-sm font-bold font-mono-data" style="color:#f59e0b;">{{ $statHariAktif }}</p>  
                            <p class="text-xs" style="color:#94a3b8;">{{ __('Hari paling aktif') }}</p>  
                        </div>  
                    </div>  
                </div>  
            </div>{{-- end chart --}}  
  
  
            {{-- ── Quick Actions ────────────────────────── --}}  
            <div data-design-id="quick-actions-card" class="adm-panel">  
                <div class="adm-panel-header">  
                    <div>  
                        <h2 class="text-sm font-semibold font-sora" style="color:#1e293b;">{{ __('Aksi Cepat') }}</h2>  
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ __('Aksi admin cepat') }}</p>  
                    </div>  
                    <div class="w-6 h-6 rounded-full flex items-center justify-center" style="background:#fffbeb;">  
                        <span style="color:#f59e0b;font-size:12px;">⚡</span>  
                    </div>  
                </div>  
  
                <div class="p-4 space-y-2.5">  
  
                    {{-- Approve --}}  
                    <button class="adm-qa-btn" style="background:#fffbeb;border-color:#fde68a;color:#b45309;">  
                        <div class="adm-qa-icon" style="background:#f59e0b;">  
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">  
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>  
                            </svg>  
                        </div>  
                        <div class="flex-1">  
                            <p class="text-sm font-semibold" style="color:#b45309;">{{ __('Setujui Pendaftaran') }}</p>  
                            <p class="text-xs" style="color:#d97706;">{{ $statPending }} {{ __('menunggu persetujuan') }}</p>  
                        </div>  
                        <svg class="w-4 h-4 flex-shrink-0" style="color:#d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                            <path d="M9 18l6-6-6-6"/>  
                        </svg>  
                    </button>  
  
                    {{-- Export --}}  
                    <button class="adm-qa-btn" style="background:#eff6ff;border-color:#bfdbfe;color:#1d4ed8;">  
                        <div class="adm-qa-icon" style="background:#2563eb;">  
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">  
                                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/>  
                            </svg>  
                        </div>  
                        <div class="flex-1">  
                            <p class="text-sm font-semibold" style="color:#1d4ed8;">{{ __('Ekspor Data') }}</p>  
                            <p class="text-xs" style="color:#3b82f6;">{{ __('Format CSV / Excel') }}</p>  
                        </div>  
                        <svg class="w-4 h-4 flex-shrink-0" style="color:#3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                            <path d="M9 18l6-6-6-6"/>  
                        </svg>  
                    </button>  
  
                    {{-- Broadcast --}}  
                    <button class="adm-qa-btn" style="background:#f5f3ff;border-color:#ddd6fe;color:#6d28d9;">  
                        <div class="adm-qa-icon" style="background:#8b5cf6;">  
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">  
                                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>  
                            </svg>  
                        </div>  
                        <div class="flex-1">  
                            <p class="text-sm font-semibold" style="color:#6d28d9;">{{ __('Kirim Notifikasi') }}</p>  
                            <p class="text-xs" style="color:#7c3aed;">{{ __('Kirim ke semua pengguna') }}</p>  
                        </div>  
                        <svg class="w-4 h-4 flex-shrink-0" style="color:#7c3aed;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                            <path d="M9 18l6-6-6-6"/>  
                        </svg>  
                    </button>  
  
                    {{-- Manajemen Pengguna --}}  
                    <button class="adm-qa-btn" style="background:#f0fdf4;border-color:#bbf7d0;color:#15803d;">  
                        <div class="adm-qa-icon" style="background:#10b981;">  
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">  
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>  
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>  
                            </svg>  
                        </div>  
                        <div class="flex-1">  
                            <p class="text-sm font-semibold" style="color:#15803d;">{{ __('Manajemen Pengguna') }}</p>  
                            <p class="text-xs" style="color:#16a34a;">{{ __('Kelola akun pengguna') }}</p>  
                        </div>  
                        <svg class="w-4 h-4 flex-shrink-0" style="color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                            <path d="M9 18l6-6-6-6"/>  
                        </svg>  
                    </button>  
  
                </div>  
            </div>{{-- end quick actions --}}  
  
        </div>{{-- end middle row --}}  
  
  
        {{-- ══════════════════════════════════════  
             BOTTOM ROW — Table + Kampanye  
        ══════════════════════════════════════ --}}  
        <div data-design-id="bottom-row" class="grid grid-cols-1 lg:grid-cols-3 gap-4">  
  
            {{-- ── Tabel Pendaftaran Terbaru ────────────── --}}  
            <div data-design-id="table-card" class="adm-panel lg:col-span-2">  
                <div class="adm-panel-header">  
                    <div>  
                        <h2 class="text-sm font-semibold font-sora" style="color:#1e293b;">{{ __('Pendaftaran Terbaru') }}</h2>  
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ count($pendaftaranList) }} {{ __('pendaftar terakhir platform') }}</p>  
                    </div>  
                    <button class="text-xs font-semibold px-3 py-1.5 rounded-xl"  
                            style="color:#2563eb;border:1px solid #bfdbfe;background:#eff6ff;">  
                        {{ __('Lihat Semua') }}  
                    </button>  
                </div>  
  
                <div class="overflow-x-auto">  
                    <table class="adm-table">  
                        <thead>  
                            <tr>  
                                <th>
                                    <button class="adm-sort-btn" :class="sortCol==='nama'?'active':''" @click="setSort('nama')">
                                        {{ __('Nama') }}
                                        <span class="material-symbols-outlined adm-sort-icon"
                                              x-text="sortCol!=='nama' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                                    </button>
                                </th>
                                <th>
                                    <button class="adm-sort-btn" :class="sortCol==='role'?'active':''" @click="setSort('role')">
                                        {{ __('Peran') }}
                                        <span class="material-symbols-outlined adm-sort-icon"
                                              x-text="sortCol!=='role' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                                    </button>
                                </th>
                                <th>
                                    <button class="adm-sort-btn" :class="sortCol==='tanggal'?'active':''" @click="setSort('tanggal')">
                                        {{ __('Tanggal') }}
                                        <span class="material-symbols-outlined adm-sort-icon"
                                              x-text="sortCol!=='tanggal' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                                    </button>
                                </th>
                                <th>
                                    <button class="adm-sort-btn" :class="sortCol==='status'?'active':''" @click="setSort('status')">
                                        {{ __('Status') }}
                                        <span class="material-symbols-outlined adm-sort-icon"
                                              x-text="sortCol!=='status' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                                    </button>
                                </th>
                                <th class="text-right">
                                    <span class="adm-sort-btn" style="cursor:default;pointer-events:none">{{ __('Aksi') }}</span>
                                </th>  
                            </tr>  
                        </thead>  
                        <tbody>  
                            @foreach($pendaftaranList as $user)  
                            <tr data-nama="{{ strtolower($user['nama']) }}"
                                data-role="{{ strtolower($user['role']) }}"
                                data-tanggal="{{ $user['tanggal'] }}"
                                data-tanggal-sort="{{ $user['timestamp'] }}"
                                data-status="{{ strtolower($user['status']) }}">  
                                {{-- Avatar + nama + email --}}  
                                <td>  
                                    <div class="flex items-center gap-3">  
                                        @php  
                                            $avatarColors = [  
                                                'Developer' => ['bg' => '#eff6ff', 'text' => '#2563eb'],  
                                                'Tester'    => ['bg' => '#f0fdf4', 'text' => '#16a34a'],  
                                            ];  
                                            $ac = $avatarColors[$user['role']] ?? ['bg' => '#f1f5f9', 'text' => '#475569'];  
                                        @endphp  
                                        <div class="adm-avatar"  
                                             style="background:{{ $ac['bg'] }};color:{{ $ac['text'] }};">  
                                            {{ $user['inisial'] }}  
                                        </div>  
                                        <div>  
                                            <p class="text-sm font-medium" style="color:#1e293b;">{{ $user['nama'] }}</p>  
                                            <p class="text-xs" style="color:#94a3b8;">{{ $user['email'] }}</p>  
                                        </div>  
                                    </div>  
                                </td>  
  
                                {{-- Role badge --}}  
                                <td>  
                                    <span class="adm-badge adm-badge-{{ strtolower($user['role']) }}">  
                                        {{ $user['role'] }}  
                                    </span>  
                                </td>  
  
                                {{-- Tanggal --}}  
                                <td>  
                                    <span class="font-mono-data text-xs" style="color:#64748b;">{{ $user['tanggal'] }}</span>  
                                </td>  
  
                                {{-- Status badge --}}  
                                <td>  
                                    <span class="adm-badge adm-badge-{{ strtolower($user['status']) }}">  
                                        {{ $user['status'] }}  
                                    </span>  
                                </td>  
  
                                {{-- Aksi --}}  
                                <td class="text-right">  
                                    <div class="flex items-center justify-end gap-2">  
                                        <button class="flex items-center justify-center p-1.5 rounded-lg"  
                                                style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;" title="Detail">  
                                            <span class="material-symbols-outlined text-[1.1rem]">visibility</span>
                                        </button>  
                                        @if($user['status'] === 'Pending')  
                                        <button class="flex items-center justify-center p-1.5 rounded-lg"  
                                                style="background:#fffbeb;color:#b45309;border:1px solid #fde68a;" title="Approve">  
                                            <span class="material-symbols-outlined text-[1.1rem]">check_circle</span>
                                        </button>  
                                        @endif  
                                    </div>  
                                </td>  
                            </tr>  
                            @endforeach  
                        </tbody>  
                    </table>  
                </div>  
            </div>{{-- end table --}}  
  
  
            {{-- ── Kampanye Terbaru ─────────────────────── --}}  
            <div data-design-id="kampanye-card" class="adm-panel">  
                <div class="adm-panel-header">  
                    <div>  
                        <h2 class="text-sm font-semibold font-sora" style="color:#1e293b;">{{ __('Kampanye Terbaru') }}</h2>  
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ count($kampanyeList) }} {{ __('kampanye aktif') }}</p>  
                    </div>  
                    <button class="text-xs font-semibold px-3 py-1.5 rounded-xl"  
                            style="color:#2563eb;border:1px solid #bfdbfe;background:#eff6ff;">  
                        {{ __('Semua') }}  
                    </button>  
                </div>  
  
                <div class="p-4 space-y-3">  
                    @foreach($kampanyeList as $k)  
                    @php  
                        $pctTester = $k['max'] > 0 ? round(($k['tester'] / $k['max']) * 100) : 0;  
                        $pctHari   = $k['maxHari'] > 0 ? round(($k['hari'] / $k['maxHari']) * 100) : 0;  
                        $statusMap = [  
                            'Aktif'    => ['bg' => '#f0fdf4', 'text' => '#16a34a'],  
                            'Selesai'  => ['bg' => '#f5f3ff', 'text' => '#6d28d9'],  
                            'Ditinjau' => ['bg' => '#fffbeb', 'text' => '#b45309'],  
                        ];  
                        $sc = $statusMap[$k['status']] ?? ['bg' => '#f1f5f9', 'text' => '#64748b'];  
                    @endphp  
                    <div class="adm-kamp-card">  
                        {{-- Nama + status --}}  
                        <div class="flex items-start justify-between gap-2 mb-2">  
                            <div class="flex items-center gap-3 min-w-0">
                                @if($k['logo'])
                                    <img src="/storage/{{ $k['logo'] }}" alt="Logo" class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                                @else
                                    @php
                                        $colors = ['#eff6ff', '#fffbeb', '#faf5ff', '#f0fdf4'];
                                        $textCols = ['#2563eb', '#d97706', '#7e22ce', '#16a34a'];
                                        $rnd = crc32($k['nama']) % 4;
                                    @endphp
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 text-sm font-bold"
                                         style="background:{{ $colors[$rnd] }};color:{{ $textCols[$rnd] }};">
                                        {{ $k['inisial'] }}
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">  
                                    <p class="text-sm font-semibold truncate" style="color:#1e293b;">{{ $k['nama'] }}</p>  
                                    <p class="text-xs truncate" style="color:#94a3b8;">by {{ $k['developer'] }}</p>  
                                </div>  
                            </div>
                            <span class="adm-badge flex-shrink-0"  
                                  style="background:{{ $sc['bg'] }};color:{{ $sc['text'] }};">  
                                {{ $k['status'] }}  
                            </span>  
                        </div>  
  
                        {{-- Tester progress --}}  
                        <div class="flex items-center justify-between text-xs mb-1">  
                            <span style="color:#64748b;">{{ __('Tester') }}</span>  
                            <span class="font-mono-data font-semibold" style="color:#1e293b;">  
                                {{ $k['tester'] }}/{{ $k['max'] }}  
                            </span>  
                        </div>  
                        <div class="adm-progress-track mb-2" style="margin-top:0;">  
                            <div class="adm-progress-fill" style="width:{{ $pctTester }}%;background:#2563eb;"></div>  
                        </div>  
  
                        {{-- Hari progress --}}  
                        <div class="flex items-center justify-between text-xs mb-1">  
                            <span style="color:#64748b;">{{ __('Hari ke-') }}</span>  
                            <span class="font-mono-data font-semibold" style="color:#1e293b;">  
                                {{ $k['hari'] }}/{{ $k['maxHari'] }}  
                            </span>  
                        </div>  
                        <div class="adm-progress-track" style="margin-top:0;">  
                            <div class="adm-progress-fill" style="width:{{ $pctHari }}%;background:#f59e0b;"></div>  
                        </div>  
                    </div>  
                    @endforeach  
                </div>  
            </div>{{-- end kampanye --}}  
  
        </div>{{-- end bottom row --}}  
  
    </div>{{-- end .px-6 --}}  
</div>{{-- end Alpine root --}}  
  
  
@push('scripts')  
<script>  
function adminDashboard() {  
    return {
        sortCol: 'tanggal',
        sortDir: 'desc',

        init() {
            this.updateTableSort();
            this.$watch('sortCol', () => this.updateTableSort());
            this.$watch('sortDir', () => this.updateTableSort());
        },

        setSort(col) {
            if (this.sortCol === col) { this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc'; }
            else { this.sortCol = col; this.sortDir = 'asc'; }
        },

        updateTableSort() {
            const tbody = document.querySelector('.adm-table tbody');
            if (!tbody) return;
            const rows = Array.from(tbody.querySelectorAll('tr[data-nama]'));

            rows.sort((a, b) => {
                let va, vb;
                if (this.sortCol === 'nama')    { va = (a.dataset.nama || '').toLowerCase(); vb = (b.dataset.nama || '').toLowerCase(); }
                else if (this.sortCol === 'role')     { va = (a.dataset.role || '').toLowerCase(); vb = (b.dataset.role || '').toLowerCase(); }
                else if (this.sortCol === 'tanggal')  { va = +(a.dataset.tanggalSort || 0); vb = +(b.dataset.tanggalSort || 0); }
                else if (this.sortCol === 'status')   { va = (a.dataset.status || '').toLowerCase(); vb = (b.dataset.status || '').toLowerCase(); }
                else return 0;
                return va < vb ? (this.sortDir==='asc'?-1:1) : (va > vb ? (this.sortDir==='asc'?1:-1) : 0);
            });

            rows.forEach(r => tbody.appendChild(r));
        },
    };  
}  
</script>  
@endpush  
  
</x-filament-panels::page> 