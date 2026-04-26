{{--  
    Tester Dashboard — PlayTest ID  
    Panel  : Tester (path /tester)  
    Page   : TesterDashboard.php  
    Fonts  : Plus Jakarta Sans (heading), JetBrains Mono (angka), Inter (body)  
--}}  
  
<x-filament-panels::page>  
  
@push('styles')  
<link rel="preconnect" href="https://fonts.googleapis.com">  
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>  
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">  
  
<style>  
/* ══════════════════════════════════════  
   FONTS  
══════════════════════════════════════ */  
.tsr-page, .tsr-page * { font-family: 'Inter', sans-serif; }  
.font-heading  { font-family: 'Plus Jakarta Sans', sans-serif !important; }  
.font-mono-num { font-family: 'JetBrains Mono', monospace !important; }  
  
/* ══════════════════════════════════════  
   SIDEBAR OVERRIDES — Light/White Theme  
══════════════════════════════════════ */  
.fi-sidebar {  
    background-color: #ffffff !important;  
    border-right: 1px solid #e2e8f0 !important;  
}  
.fi-sidebar-nav   { background-color: #ffffff !important; }  
.fi-sidebar-header {  
    background-color: #ffffff !important;  
    border-bottom: 1px solid #f1f5f9 !important;  
}  
  
/* Nav group label */  
.fi-sidebar-group-label {  
    color: #94a3b8 !important;  
    font-size: 0.65rem !important;  
    font-weight: 600 !important;  
    letter-spacing: 0.08em !important;  
    text-transform: uppercase !important;  
}  
  
/* Nav item — inactive */  
.fi-sidebar-item-button {  
    color: #64748b !important;  
    border-radius: 0.75rem !important;  
    border-left: 3px solid transparent !important;  
    transition: all 0.15s ease !important;  
}  
.fi-sidebar-item-button:hover {  
    background-color: #f1f5f9 !important;  
    color: #1e293b !important;  
}  
.fi-sidebar-item-icon { color: #64748b !important; }  
.fi-sidebar-item-button:hover .fi-sidebar-item-icon { color: #1e293b !important; }  
  
/* Nav item — ACTIVE */  
.fi-sidebar-item-button.fi-active,  
.fi-sidebar-item-button[aria-current="page"] {  
    background-color: #eff6ff !important;  
    color: #2563eb !important;  
    border-left: 3px solid #2563eb !important;  
    font-weight: 600 !important;  
}  
.fi-sidebar-item-button.fi-active .fi-sidebar-item-icon,  
.fi-sidebar-item-button[aria-current="page"] .fi-sidebar-item-icon {  
    color: #2563eb !important;  
}  
  
/* Badge */  
.fi-sidebar-item-badge {  
    background-color: #eff6ff !important;  
    color: #2563eb !important;  
    font-family: 'JetBrains Mono', monospace !important;  
    font-size: 0.65rem !important;  
    font-weight: 600 !important;  
}  
  
/* Divider */  
.fi-sidebar-group { border-color: #f1f5f9 !important; }  
  
/* Sidebar footer / user area */  
.fi-sidebar-footer {  
    background-color: #ffffff !important;  
    border-top: 1px solid #f1f5f9 !important;  
}  
.fi-user-menu-trigger {  
    background-color: #f8fafc !important;  
    border: 1px solid #e2e8f0 !important;  
    border-radius: 1rem !important;  
    padding: 10px 12px !important;  
}  
.fi-user-menu-trigger:hover { background-color: #f1f5f9 !important; }  
.fi-user-menu-trigger-name  { color: #1e293b !important; font-weight: 600 !important; }  
.fi-user-menu-trigger-email { color: #64748b !important; font-size: 0.7rem !important; }  
  
/* Avatar gradient teal-biru */  
.fi-avatar {  
    background: linear-gradient(135deg, #0ea5e9, #2563eb) !important;  
    color: #ffffff !important;  
    font-weight: 700 !important;  
    font-size: 0.7rem !important;  
}  
  
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
    font-family: 'Plus Jakarta Sans', sans-serif !important;  
}  
.fi-page-header-heading { display: none !important; }  
  
/* ══════════════════════════════════════  
   PAGE BACKGROUND  
══════════════════════════════════════ */  
.fi-main { background-color: #f8fafc !important; }  
.fi-page  { padding: 0 !important; }  
  
/* ══════════════════════════════════════  
   PROGRESS BAR  
══════════════════════════════════════ */  
.tsr-progress-track {  
    height: 6px;  
    background: #e2e8f0;  
    border-radius: 9999px;  
    overflow: hidden;  
}  
.tsr-progress-fill {  
    height: 100%;  
    border-radius: 9999px;  
    transition: width 1s cubic-bezier(0.34, 1.56, 0.64, 1);  
}  
  
/* ══════════════════════════════════════  
   MISSION CARDS  
══════════════════════════════════════ */  
.tsr-mission-card {  
    background: #ffffff;  
    border-radius: 1rem;  
    padding: 1rem;  
    border: 1px solid #e2e8f0;  
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);  
    transition: box-shadow 0.2s ease, transform 0.2s ease;  
}  
.tsr-mission-card:hover {  
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);  
    transform: translateY(-2px);  
}  
  
/* ══════════════════════════════════════  
   APP LIST ITEMS  
══════════════════════════════════════ */  
.tsr-app-item {  
    display: flex;  
    align-items: center;  
    gap: 1rem;  
    padding: 1rem 1.25rem;  
    border-bottom: 1px solid #f1f5f9;  
    transition: background 0.15s ease;  
}  
.tsr-app-item:hover { background: #fafafa; }  
.tsr-app-item:last-child { border-bottom: none; }  
  
/* ══════════════════════════════════════  
   BUTTONS  
══════════════════════════════════════ */  
.tsr-btn-apply {  
    display: inline-flex; align-items: center; gap: 6px;  
    padding: 8px 16px; border-radius: 0.75rem;  
    font-size: 0.8125rem; font-weight: 600; color: #ffffff;  
    background: #2563eb; cursor: pointer;  
    box-shadow: 0 4px 12px rgba(37,99,235,0.25);  
    transition: all 0.15s ease; border: none; white-space: nowrap;  
}  
.tsr-btn-apply:hover { background: #1d4ed8; box-shadow: 0 6px 16px rgba(37,99,235,0.35); }  
.tsr-btn-apply:disabled {  
    background: #94a3b8 !important;  
    box-shadow: none !important;  
    cursor: not-allowed !important;  
    opacity: 0.7;  
}  
  
.tsr-btn-submit {  
    display: inline-flex; align-items: center; gap: 6px;  
    padding: 6px 12px; border-radius: 0.75rem;  
    font-size: 0.75rem; font-weight: 600; color: #475569;  
    background: #f8fafc; cursor: pointer;  
    border: 1px solid #e2e8f0; transition: all 0.15s ease;  
}  
.tsr-btn-submit:hover { background: #f1f5f9; }  
  
.tsr-btn-laporkan {  
    display: inline-flex; align-items: center; gap: 6px;  
    padding: 6px 12px; border-radius: 0.75rem;  
    font-size: 0.75rem; font-weight: 600; color: #ef4444;  
    background: #fff1f2; cursor: pointer;  
    border: 1px solid #fecdd3; transition: all 0.15s ease;  
}  
.tsr-btn-laporkan:hover { background: #ffe4e6; }  
  
/* ══════════════════════════════════════  
   FILTER TABS  
══════════════════════════════════════ */  
.tsr-filter-active {  
    background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;  
    font-weight: 600; font-size: 0.75rem; padding: 6px 12px; border-radius: 0.75rem;  
    cursor: pointer; transition: all 0.15s ease;  
}  
.tsr-filter-inactive {  
    background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0;  
    font-weight: 600; font-size: 0.75rem; padding: 6px 12px; border-radius: 0.75rem;  
    cursor: pointer; transition: all 0.15s ease;  
}  
.tsr-filter-inactive:hover { background: #f1f5f9; color: #1e293b; }  
</style>  
@endpush  
  
  
{{-- ═══════════════════════════════════════  
     DASHBOARD CONTENT  
════════════════════════════════════════ --}}  
<div class="tsr-page" x-data="testerDashboard()" x-init="animateBars()">  
  
    <div class="px-6 py-6">  
  
        {{-- ══════════════════════════════════════  
             HERO — KARTU POIN  
        ══════════════════════════════════════ --}}  
        <div data-design-id="points-card"  
             class="w-full rounded-2xl p-6 mb-6 relative overflow-hidden"  
             style="background:linear-gradient(135deg,#0ea5e9 0%,#06b6d4 40%,#2563eb 100%);  
                    box-shadow:0 8px 32px rgba(14,165,233,0.25);">  
  
            {{-- Dekorasi lingkaran --}}  
            <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full opacity-10" style="background:#ffffff;"></div>  
            <div class="absolute right-16 -bottom-10 w-28 h-28 rounded-full opacity-10" style="background:#ffffff;"></div>  
            <div class="absolute right-4 top-4 w-16 h-16 rounded-full opacity-5" style="background:#ffffff;"></div>  
  
            {{-- Konten utama --}}  
            <div class="relative z-10 flex items-center justify-between flex-wrap gap-4">  
                <div>  
                    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#e0f2fe;letter-spacing:0.12em;">POIN KAMU</p>  
                    <div class="flex items-baseline gap-2 mb-2">  
                        <span class="font-mono-num font-bold text-white" style="font-size:48px;line-height:1;">{{ $totalPoin }}</span>  
                        <span class="text-xl font-semibold" style="color:#bae6fd;opacity:0.85;">pts</span>  
                    </div>  
                    <div class="flex items-center gap-2 flex-wrap">  
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full"  
                              style="background:rgba(255,255,255,0.2);color:#ffffff;backdrop-filter:blur(4px);">  
                            ⭐ {{ $tierTester }}  
                        </span>  
                        <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full"  
                              style="background:rgba(255,255,255,0.15);color:#e0f2fe;">  
                            <span class="w-1.5 h-1.5 rounded-full inline-block" style="background:#fbbf24;"></span>  
                            +{{ $poinPending }} pts pending  
                        </span>  
                    </div>  
                </div>  
  
                <div class="flex items-center gap-3 flex-wrap">  
                    <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold"  
                            style="background:rgba(255,255,255,0.2);color:#ffffff;border:1px solid rgba(255,255,255,0.3);backdrop-filter:blur(4px);">  
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">  
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>  
                        </svg>  
                        Riwayat  
                    </button>  
                    <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold"  
                            style="background:#ffffff;color:#0ea5e9;box-shadow:0 2px 8px rgba(0,0,0,0.1);">  
                        Tukar Poin  
                    </button>  
                </div>  
            </div>  
  
            {{-- Mini stats --}}  
            <div class="relative z-10 grid grid-cols-2 sm:flex sm:items-center gap-4 sm:gap-6 mt-5 pt-4"  
                 style="border-top:1px solid rgba(255,255,255,0.2);">  
                <div>  
                    <p class="font-mono-num text-lg font-bold text-white">{{ $misiSelesai }}</p>  
                    <p class="text-xs opacity-70" style="color:#e0f2fe;">Misi Selesai</p>  
                </div>  
                <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>  
                <div>  
                    <p class="font-mono-num text-lg font-bold text-white">{{ $rating }}</p>  
                    <p class="text-xs opacity-70" style="color:#e0f2fe;">Rating</p>  
                </div>  
                <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>  
                <div>  
                    <p class="font-mono-num text-lg font-bold text-white">{{ $misiAktif }}</p>  
                    <p class="text-xs opacity-70" style="color:#e0f2fe;">Aktif Sekarang</p>  
                </div>  
                <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>  
                <div>  
                    <p class="font-mono-num text-lg font-bold text-white">{{ $streakHari }}</p>  
                    <p class="text-xs opacity-70" style="color:#e0f2fe;">Hari Streak</p>  
                </div>  
            </div>  
        </div>{{-- end points card --}}  
  
  
        {{-- ══════════════════════════════════════  
             MISI AKTIF  
        ══════════════════════════════════════ --}}  
        <div data-design-id="missions-section" class="mb-6">  
            <div class="flex items-center justify-between mb-4">  
                <div>  
                    <h2 class="text-base font-bold font-heading" style="color:#1e293b;">Misi Aktif Saya</h2>  
                    <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ count($misiAktifList) }} misi sedang berjalan</p>  
                </div>  
                <a href="#" class="text-sm font-semibold flex items-center gap-1" style="color:#2563eb;">  
                    Lihat Semua  
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">  
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>  
                    </svg>  
                </a>  
            </div>  
  
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">  
                @foreach($misiAktifList as $misi)  
                <div data-design-id="mission-card-{{ $loop->iteration }}" class="tsr-mission-card">  
  
                    {{-- Header: icon + nama + status --}}  
                    <div class="flex items-start justify-between mb-3">  
                        <div class="flex items-center gap-3">  
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"  
                                 style="background:{{ $misi['gradient'] }};">  
                                <span class="text-white font-bold text-sm">{{ $misi['inisial'] }}</span>  
                            </div>  
                            <div>  
                                <p class="text-sm font-bold font-heading" style="color:#1e293b;">{{ $misi['nama'] }}</p>  
                                <p class="text-xs" style="color:#64748b;">{{ $misi['tipe'] }}</p>  
                            </div>  
                        </div>  
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-lg"  
                              style="background:#f0fdf4;color:#16a34a;">{{ $misi['status'] }}</span>  
                    </div>  
  
                    {{-- Progress hari --}}  
                    <div class="mb-3">  
                        <div class="flex items-center justify-between mb-1.5">  
                            <span class="text-xs font-medium" style="color:#64748b;">  
                                <span class="font-mono-num font-bold" style="color:#1e293b;">Day {{ $misi['hari'] }}</span> of {{ $misi['maxHari'] }}  
                            </span>  
                            <span class="text-xs font-semibold font-mono-num"  
                                  style="color:{{ $misi['warnaPersen'] }};">{{ $misi['persen'] }}%</span>  
                        </div>  
                        <div class="tsr-progress-track">  
                            <div class="tsr-progress-fill"  
                                 style="width:0%;background:{{ $misi['gradientBar'] }};"  
                                 data-target="{{ $misi['persen'] }}%">  
                            </div>  
                        </div>  
                    </div>  
  
                    {{-- Footer: reward + aksi --}}  
                    <div class="flex items-center justify-between">  
                        <div class="flex items-center gap-1">  
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" style="color:#10b981;">  
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>  
                            </svg>  
                            <span class="text-xs font-semibold" style="color:#10b981;">+{{ $misi['reward'] }} pts</span>  
                        </div>  
  
                        @if($misi['aksi'] === 'submit')  
                            @if($misi['rawStatus'] === 'starting')
                                <button class="tsr-btn-submit">  
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">  
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>  
                                    </svg>  
                                    Submit Task  
                                </button>  
                            @else
                                <button class="tsr-btn-submit" disabled style="opacity: 0.6; cursor: not-allowed; background: #f1f5f9; color: #94a3b8;">  
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">  
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>  
                                    </svg>  
                                    Pending  
                                </button>
                            @endif
                        @else  
                        <button class="tsr-btn-laporkan">  
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">  
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>  
                            </svg>  
                            Laporkan  
                        </button>  
                        @endif  
                    </div>  
                </div>  
                @endforeach  
            </div>  
        </div>{{-- end misi aktif --}}  
  
  
        {{-- ══════════════════════════════════════  
             APLIKASI TERSEDIA  
        ══════════════════════════════════════ --}}  
        <div data-design-id="available-section" class="mb-4">  
            <div class="flex items-center justify-between mb-4">  
                <div>  
                    <h2 class="text-base font-bold font-heading" style="color:#1e293b;">Aplikasi Tersedia untuk Diuji</h2>  
                    <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ count($aplikasiList) }} slot terbuka • Lamar sekarang</p>  
                </div>  
                <div class="flex items-center gap-2">  
                    <button class="tsr-filter-active" x-on:click="setFilter('semua')" :class="filter === 'semua' ? 'tsr-filter-active' : 'tsr-filter-inactive'">Semua</button>  
                    <button class="tsr-filter-inactive" x-on:click="setFilter('functional')" :class="filter === 'functional' ? 'tsr-filter-active' : 'tsr-filter-inactive'">Functional</button>  
                    <button class="tsr-filter-inactive" x-on:click="setFilter('ux')" :class="filter === 'ux' ? 'tsr-filter-active' : 'tsr-filter-inactive'">UX</button>  
                </div>  
            </div>  
  
            {{-- List card --}}  
            <div class="bg-white rounded-2xl shadow-sm" style="border:1px solid #e2e8f0;">  
                @foreach($aplikasiList as $app)  
                <div data-design-id="app-item-{{ $loop->iteration }}" class="tsr-app-item flex-col sm:flex-row items-start sm:items-center">  
  
                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        {{-- Icon --}}  
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0"  
                             style="background:{{ $app['gradient'] }};">  
                            <span class="text-white font-bold text-base">{{ $app['inisial'] }}</span>  
                        </div>  
      
                        {{-- Info --}}  
                        <div class="flex-1 min-w-0">  
                            <div class="flex items-center gap-2 mb-0.5">  
                                <p class="text-sm font-bold font-heading truncate" style="color:#1e293b;">{{ $app['nama'] }}</p>  
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-md flex-shrink-0"  
                                      style="background:{{ $app['tipeBg'] }};color:{{ $app['tipeColor'] }};">  
                                    {{ $app['tipe'] }}  
                                </span>  
                            </div>  
                            <p class="text-xs truncate" style="color:#64748b;">{{ $app['deskripsi'] }}</p>  
                        </div>  
                    </div>

                    {{-- Meta --}}  
                    <div class="flex items-center justify-between sm:justify-end gap-3 w-full sm:w-auto mt-4 sm:mt-0 pt-3 sm:pt-0 border-t sm:border-none border-slate-100">  
                        <div class="text-center hidden lg:block">  
                            <p class="text-xs font-bold font-mono-num" style="color:#1e293b;">{{ $app['durasi'] }}</p>  
                            <p class="text-xs" style="color:#94a3b8;">Durasi</p>  
                        </div>  
                        <div class="text-center">  
                            <p class="text-xs font-bold font-mono-num" style="color:#1e293b;">  
                                {{ $app['testerCur'] }}/{{ $app['testerMax'] }}  
                            </p>  
                            <p class="text-xs" style="color:#94a3b8;">Tester</p>  
                        </div>  
                        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl" style="background:#f0fdf4;">  
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" style="color:#10b981;">  
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>  
                            </svg>  
                            <span class="text-xs font-bold font-mono-num" style="color:#16a34a;">+{{ $app['reward'] }} pts</span>  
                        </div>  
                        @php
                            $isRestricted = $app['isTrusted'] && ($userBadgeCount <= 5);
                        @endphp
                        <button 
                            @if(!$isRestricted) 
                                wire:click="applyMisi('{{ $app['id'] }}')" 
                            @endif
                            @disabled($isRestricted)
                            wire:loading.attr="disabled"
                            class="tsr-btn-apply !px-3 font-bold"
                            @if($isRestricted) title="Misi ini membutuhkan minimal 6 badge" @endif
                        >
                            <span wire:loading.remove wire:target="applyMisi('{{ $app['id'] }}')">
                                {{ $isRestricted ? 'Locked' : 'Apply' }}
                            </span>
                            <span wire:loading wire:target="applyMisi('{{ $app['id'] }}')">...</span>
                        </button>  
                    </div>  
                </div>  
                @endforeach  
            </div>  
        </div>{{-- end available apps --}}  
  
    </div>  
</div>{{-- end Alpine root --}}  
  
  
@push('scripts')  
<script>  
function testerDashboard() {  
    return {  
        filter: 'semua',  
  
        animateBars() {  
            this.$nextTick(() => {  
                document.querySelectorAll('.tsr-progress-fill').forEach(el => {  
                    const target = el.dataset.target || '0%';  
                    el.style.width = '0%';  
                    setTimeout(() => {  
                        el.style.transition = 'width 1s cubic-bezier(0.34, 1.56, 0.64, 1)';  
                        el.style.width = target;  
                    }, 400);  
                });  
            });  
        },  
  
        setFilter(val) {  
            this.filter = val;  
            /* Filter visual — logika backend bisa ditambahkan nanti */  
        }  
    };  
}  
</script>  
@endpush  
  
</x-filament-panels::page>  