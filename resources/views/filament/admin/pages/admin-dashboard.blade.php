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
  
<style>  
/* ══════════════════════════════════════  
   FONTS  
══════════════════════════════════════ */  
.adm-page, .adm-page * { font-family: 'Inter', sans-serif; }  
.font-sora  { font-family: 'Sora', sans-serif !important; }  
.font-mono-data { font-family: 'JetBrains Mono', monospace !important; }  
  
/* ══════════════════════════════════════  
   SIDEBAR OVERRIDES  — match dark design  
══════════════════════════════════════ */  
  
/* Sidebar root */  
.fi-sidebar {  
    background-color: #0f172a !important;  
    border-right: none !important;  
}  
  
/* Sidebar inner / nav wrapper */  
.fi-sidebar-nav { background-color: #0f172a !important; }  
  
/* Logo / brand area */  
.fi-sidebar-header {  
    background-color: #0f172a !important;  
    border-bottom: 1px solid #1e293b !important;  
    padding: 20px !important;  
}  
  
/* Nav group label */  
.fi-sidebar-group-label {  
    color: #475569 !important;  
    font-size: 0.65rem !important;  
    font-weight: 600 !important;  
    letter-spacing: 0.08em !important;  
    text-transform: uppercase !important;  
}  
  
/* Nav item — inactive */  
.fi-sidebar-item-button {  
    color: #94a3b8 !important;  
    border-radius: 0.75rem !important;  
    transition: all 0.15s ease !important;  
}  
.fi-sidebar-item-button:hover {  
    background-color: #1e293b !important;  
    color: #cbd5e1 !important;  
}  
  
/* Nav item icon — inactive */  
.fi-sidebar-item-icon { color: #94a3b8 !important; }  
.fi-sidebar-item-button:hover .fi-sidebar-item-icon { color: #cbd5e1 !important; }  
  
/* Nav item — ACTIVE */  
.fi-sidebar-item-button.fi-active,  
.fi-sidebar-item-button[aria-current="page"] {  
    background-color: #1e3a5f !important;  
    color: #60a5fa !important;  
    border-left: 3px solid #2563eb !important;  
    border-radius: 0.75rem !important;  
}  
.fi-sidebar-item-button.fi-active .fi-sidebar-item-icon,  
.fi-sidebar-item-button[aria-current="page"] .fi-sidebar-item-icon {  
    color: #60a5fa !important;  
}  
  
/* Badge (notification count) */  
.fi-sidebar-item-badge {  
    background-color: #1e293b !important;  
    color: #f59e0b !important;  
    font-family: 'JetBrains Mono', monospace !important;  
    font-size: 0.65rem !important;  
    font-weight: 600 !important;  
}  
  
/* Nav group divider */  
.fi-sidebar-group { border-color: #1e293b !important; }  
  
/* ── Sidebar Footer / User Card ────────── */  
.fi-sidebar-footer {  
    background-color: #0f172a !important;  
    border-top: 1px solid #1e293b !important;  
    padding: 12px !important;  
}  
.fi-user-menu-trigger {  
    background-color: #1e293b !important;  
    border-radius: 0.75rem !important;  
    padding: 8px 12px !important;  
    border: none !important;  
    width: 100% !important;  
}  
.fi-user-menu-trigger:hover { background-color: #334155 !important; }  
.fi-user-menu-trigger-name  { color: #f1f5f9 !important; font-weight: 600 !important; }  
.fi-user-menu-trigger-email { color: #64748b !important; font-size: 0.7rem !important; }  
.fi-avatar {  
    background-color: #f59e0b !important;  
    color: #0f172a !important;  
    font-weight: 700 !important;  
    font-size: 0.7rem !important;  
}  
.fi-sidebar-footer .fi-icon-btn { color: #64748b !important; }  
  
/* ══════════════════════════════════════  
   TOPBAR OVERRIDES  
══════════════════════════════════════ */  
.fi-topbar {  
    background-color: #ffffff !important;  
    border-bottom: 1px solid #f1f5f9 !important;  
    box-shadow: none !important;  
}  
.fi-breadcrumbs-item-label { color: #94a3b8 !important; }  
.fi-breadcrumbs-item-label.fi-active,  
.fi-breadcrumbs li:last-child .fi-breadcrumbs-item-label {  
    color: #1e293b !important;  
    font-weight: 600 !important;  
}  
.fi-breadcrumbs-separator { color: #cbd5e1 !important; }  
.fi-page-header-heading { display: none !important; } /* pakai header sendiri di bawah */  
  
/* ══════════════════════════════════════  
   PAGE BACKGROUND  
══════════════════════════════════════ */  
.fi-main { background-color: #f8fafc !important; }  
.fi-page  { padding: 0 !important; }  
  
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
}  
.adm-table td {  
    padding: 0.875rem 1.25rem;  
    font-size: 0.8125rem;  
    border-bottom: 1px solid #f8fafc;  
    color: #475569;  
}  
.adm-table tr:hover td { background-color: #fafafa; }  
.adm-table tr:last-child td { border-bottom: none; }  
  
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
</style>  
@endpush  
  
{{-- ═══════════════════════════════════════════════  
     DASHBOARD CONTENT  (Alpine root)  
════════════════════════════════════════════════ --}}  
<div class="adm-page" x-data="adminDashboard()" x-init="initBars()">  
  
    {{-- ── PAGE HEADER ─────────────────────────────────── --}}  
    <div data-design-id="page-header" class="flex items-center justify-between mb-6 px-6 pt-6">  
        <div>  
                     
            <p class="text-sm mt-0.5" style="color:#64748b;">  
                Ringkasan platform PlayTest ID — data diperbarui {{ now()->diffForHumans() }}  
            </p>  
        </div>  
        <div class="flex items-center gap-3">  
            <button class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium"  
                    style="background:#ffffff;border:1px solid #e2e8f0;color:#64748b;">  
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">  
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/>  
                </svg>  
                Export  
            </button>  
            <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white"  
                    style="background:#2563eb;box-shadow:0 4px 14px rgba(37,99,235,0.3);"  
                    @click="initBars()">  
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">  
                    <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>  
                </svg>  
                Refresh Data  
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
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">Developer</p>  
                        <p class="text-2xl font-bold mt-0.5 leading-none font-mono-data" style="color:#1e293b;">{{ $statDeveloper }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#10b981;">+12 bulan ini</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track mt-3">  
                    <div class="adm-progress-fill" style="width:71%;background:#2563eb;"></div>  
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
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">Tester</p>  
                        <p class="text-2xl font-bold mt-0.5 leading-none font-mono-data" style="color:#1e293b;">{{ $statTester }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#10b981;">+87 bulan ini</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track">  
                    <div class="adm-progress-fill" style="width:84%;background:#10b981;"></div>  
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
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">Aktif</p>  
                        <p class="text-2xl font-bold mt-0.5 leading-none font-mono-data" style="color:#1e293b;">{{ $statAktif }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#f59e0b;">+3 minggu ini</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track">  
                    <div class="adm-progress-fill" style="width:56%;background:#f59e0b;"></div>  
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
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">Selesai</p>  
                        <p class="text-2xl font-bold mt-0.5 leading-none font-mono-data" style="color:#1e293b;">{{ $statSelesai }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#8b5cf6;">Total campaign</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track">  
                    <div class="adm-progress-fill" style="width:87%;background:#8b5cf6;"></div>  
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
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">Pendapatan</p>  
                        <p class="text-xl font-bold mt-0.5 leading-none font-mono-data" style="color:#1e293b;">Rp {{ $statPendapatan }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#10b981;">+18% vs bln lalu</p>  
                    </div>  
                </div>  
                <div class="adm-progress-track">  
                    <div class="adm-progress-fill" style="width:63%;background:#10b981;"></div>  
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
                        <p class="text-xs font-medium uppercase tracking-wider" style="color:#94a3b8;">Pending</p>  
                        <p class="text-2xl font-bold mt-0.5 leading-none font-mono-data" style="color:#ef4444;">{{ $statPending }}</p>  
                        <p class="text-xs font-medium mt-1" style="color:#ef4444;">Perlu review</p>  
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
                        <h2 class="text-sm font-semibold font-sora" style="color:#1e293b;">Aktivitas Mingguan</h2>  
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">Registrasi Developer vs Tester (7 hari terakhir)</p>  
                    </div>  
                    <div class="flex items-center gap-4 text-xs">  
                        <div class="flex items-center gap-1.5">  
                            <div class="w-2.5 h-2.5 rounded-full" style="background:#2563eb;"></div>  
                            <span style="color:#64748b;">Developer</span>  
                        </div>  
                        <div class="flex items-center gap-1.5">  
                            <div class="w-2.5 h-2.5 rounded-full" style="background:#10b981;"></div>  
                            <span style="color:#64748b;">Tester</span>  
                        </div>  
                    </div>  
                </div>  
  
                <div class="px-5 py-5">  
                    {{-- Bar chart --}}  
                    <div class="flex items-end gap-3" style="height:144px;">  
                        @foreach($chartHari as $i => $hari)  
                        <div class="flex-1 flex flex-col items-center gap-1">  
                            <div class="w-full flex items-end gap-0.5 justify-center" style="height:112px;">  
                                <div class="adm-chart-bar flex-1"  
                                     style="background:#2563eb;max-width:14px;  
                                            {{ ($i >= 5) ? 'opacity:0.65;' : '' }}  
                                            height:0%;"  
                                     data-target="{{ $chartDev[$i] }}%">  
                                </div>  
                                <div class="adm-chart-bar flex-1"  
                                     style="background:#10b981;max-width:14px;  
                                            {{ ($i >= 5) ? 'opacity:0.65;' : '' }}  
                                            height:0%;"  
                                     data-target="{{ $chartTester[$i] }}%">  
                                </div>  
                            </div>  
                            <span class="text-xs font-medium" style="color:#94a3b8;">{{ $hari }}</span>  
                        </div>  
                        @endforeach  
                    </div>  
  
                    {{-- Chart stats row --}}  
                    <div class="flex items-center justify-between mt-4 pt-4" style="border-top:1px solid #f1f5f9;">  
                        <div class="text-center">  
                            <p class="text-sm font-bold font-mono-data" style="color:#2563eb;">+48</p>  
                            <p class="text-xs" style="color:#94a3b8;">Dev minggu ini</p>  
                        </div>  
                        <div class="text-center">  
                            <p class="text-sm font-bold font-mono-data" style="color:#10b981;">+312</p>  
                            <p class="text-xs" style="color:#94a3b8;">Tester minggu ini</p>  
                        </div>  
                        <div class="text-center">  
                            <p class="text-sm font-bold font-mono-data" style="color:#1e293b;">1:6.5</p>  
                            <p class="text-xs" style="color:#94a3b8;">Rasio Dev:Tester</p>  
                        </div>  
                        <div class="text-center">  
                            <p class="text-sm font-bold font-mono-data" style="color:#f59e0b;">Jumat</p>  
                            <p class="text-xs" style="color:#94a3b8;">Hari paling aktif</p>  
                        </div>  
                    </div>  
                </div>  
            </div>{{-- end chart --}}  
  
  
            {{-- ── Quick Actions ────────────────────────── --}}  
            <div data-design-id="quick-actions-card" class="adm-panel">  
                <div class="adm-panel-header">  
                    <div>  
                        <h2 class="text-sm font-semibold font-sora" style="color:#1e293b;">Quick Actions</h2>  
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">Aksi admin cepat</p>  
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
                            <p class="text-sm font-semibold" style="color:#b45309;">Approve Pendaftaran</p>  
                            <p class="text-xs" style="color:#d97706;">{{ $statPending }} menunggu review</p>  
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
                            <p class="text-sm font-semibold" style="color:#1d4ed8;">Export Data</p>  
                            <p class="text-xs" style="color:#3b82f6;">CSV / Excel format</p>  
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
                            <p class="text-sm font-semibold" style="color:#6d28d9;">Broadcast Notif</p>  
                            <p class="text-xs" style="color:#7c3aed;">Kirim ke semua user</p>  
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
                            <p class="text-sm font-semibold" style="color:#15803d;">Manajemen Pengguna</p>  
                            <p class="text-xs" style="color:#16a34a;">Kelola akun user</p>  
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
                        <h2 class="text-sm font-semibold font-sora" style="color:#1e293b;">Pendaftaran Terbaru</h2>  
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ count($pendaftaranList) }} pendaftar terakhir platform</p>  
                    </div>  
                    <button class="text-xs font-semibold px-3 py-1.5 rounded-xl"  
                            style="color:#2563eb;border:1px solid #bfdbfe;background:#eff6ff;">  
                        Lihat Semua  
                    </button>  
                </div>  
  
                <div class="overflow-x-auto">  
                    <table class="adm-table">  
                        <thead>  
                            <tr>  
                                <th>Nama</th>  
                                <th>Role</th>  
                                <th>Tanggal</th>  
                                <th>Status</th>  
                                <th class="text-right">Aksi</th>  
                            </tr>  
                        </thead>  
                        <tbody>  
                            @foreach($pendaftaranList as $user)  
                            <tr>  
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
                                        <button class="text-xs font-semibold px-3 py-1 rounded-lg"  
                                                style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;">  
                                            Detail  
                                        </button>  
                                        @if($user['status'] === 'Pending')  
                                        <button class="text-xs font-semibold px-3 py-1 rounded-lg"  
                                                style="background:#fffbeb;color:#b45309;border:1px solid #fde68a;">  
                                            Approve  
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
                        <h2 class="text-sm font-semibold font-sora" style="color:#1e293b;">Kampanye Terbaru</h2>  
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ count($kampanyeList) }} kampanye aktif</p>  
                    </div>  
                    <button class="text-xs font-semibold px-3 py-1.5 rounded-xl"  
                            style="color:#2563eb;border:1px solid #bfdbfe;background:#eff6ff;">  
                        Semua  
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
                            <div class="flex-1 min-w-0">  
                                <p class="text-sm font-semibold truncate" style="color:#1e293b;">{{ $k['nama'] }}</p>  
                                <p class="text-xs" style="color:#94a3b8;">by {{ $k['developer'] }}</p>  
                            </div>  
                            <span class="adm-badge flex-shrink-0"  
                                  style="background:{{ $sc['bg'] }};color:{{ $sc['text'] }};">  
                                {{ $k['status'] }}  
                            </span>  
                        </div>  
  
                        {{-- Tester progress --}}  
                        <div class="flex items-center justify-between text-xs mb-1">  
                            <span style="color:#64748b;">Tester</span>  
                            <span class="font-mono-data font-semibold" style="color:#1e293b;">  
                                {{ $k['tester'] }}/{{ $k['max'] }}  
                            </span>  
                        </div>  
                        <div class="adm-progress-track mb-2" style="margin-top:0;">  
                            <div class="adm-progress-fill" style="width:{{ $pctTester }}%;background:#2563eb;"></div>  
                        </div>  
  
                        {{-- Hari progress --}}  
                        <div class="flex items-center justify-between text-xs mb-1">  
                            <span style="color:#64748b;">Hari ke-</span>  
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
        initBars() {  
            this.$nextTick(() => {  
                /* Animasi bar chart naik dari 0 ke target */  
                document.querySelectorAll('.adm-chart-bar').forEach(bar => {  
                    const target = bar.dataset.target || '0%';  
                    bar.style.height = '0%';  
                    setTimeout(() => {  
                        bar.style.transition = 'height 0.8s cubic-bezier(0.34, 1.56, 0.64, 1)';  
                        bar.style.height = target;  
                    }, 300);  
                });  
            });  
        }  
    };  
}  
</script>  
@endpush  
  
</x-filament-panels::page> 