@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
    /* FONT & BASIC */
    .dm-sora { font-family: 'Sora', sans-serif !important; }
    .dm-mono { font-family: 'JetBrains Mono', monospace !important; }
    .fi-header { display: none !important; } /* Hide default Filament header */

    /* ANIMATIONS */
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }

    /* STAT CARDS */
    .dm-stat {
        background: #fff; border-radius: 14px; padding: 18px 20px;
        border: 1px solid #e2e8f0; position: relative; overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .dm-stat:hover { transform: translateY(-5px); box-shadow: 0 15px 30px -10px rgba(0,0,0,.1); }
    .dm-stat::after {
        content: ''; position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg); transition: 0.75s; z-index: 1; pointer-events: none;
    }
    .dm-stat:hover::after { left: 125%; }
    .dm-stat-accent { position: absolute; top:0;left:0;right:0; height:3px; }
    .dm-stat-icon { width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0; transition: transform 0.3s ease; }
    .dm-stat:hover .dm-stat-icon { transform: scale(1.1) rotate(-5deg); }
    .dm-stat-label { font-size:.72rem;color:#64748b;font-weight:500;text-transform:uppercase;letter-spacing:.06em; }
    .dm-stat-value { font-size:1.4rem;font-weight:800;color:#0f172a;line-height:1.1; }
    .dm-stat-sub   { font-size:.72rem;color:#94a3b8;margin-top:2px; }

    /* TABLE SYNC */
    .fi-ta-ctn { border: 1px solid #e2e8f0 !important; border-radius: 14px !important; overflow: hidden !important; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02) !important; background: #fff !important; margin-top: 24px !important; }
    .fi-ta-header-toolbar { padding: 14px 18px !important; background: #fff !important; border-bottom: 1px solid #e2e8f0 !important; }
    .fi-ta-header-cell { background: #f8fafc !important; padding: 12px 16px !important; border-bottom: 1px solid #e2e8f0 !important; }
    .fi-ta-header-cell label, .fi-ta-header-cell span { font-size: .72rem !important; font-weight: 700 !important; color: #64748b !important; text-transform: uppercase !important; letter-spacing: .08em !important; }
    .fi-ta-record { transition: all 0.2s !important; border-bottom: 1px solid #f1f5f9 !important; }
    .fi-ta-record:hover { background-color: #f8fafc !important; }
    .fi-ta-record td:first-child { border-left: 3px solid transparent !important; transition: border-color 0.2s !important; }
    .fi-ta-record:hover td:first-child { border-left-color: #2563eb !important; }
    .fi-ta-record:last-child { border-bottom: none !important; }
    
    .dm-btn-primary { 
        background: #0f172a; color: #fff; font-size: .85rem; font-weight: 700; 
        padding: 10px 20px; border-radius: 12px; transition: all 0.2s; 
        display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer;
    }
    .dm-btn-primary:hover { background: #1e293b; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2); }
</style>
@endpush

<div class="space-y-6">
    {{-- HEADER --}}
    <div class="flex items-center justify-between animate-fade-in-up">
        <div>
            <h1 class="dm-sora text-xl font-bold text-slate-900">My Apps</h1>
            <p class="text-sm text-slate-500 mt-0.5">Kelola dan pantau aplikasi serta misi yang Anda buat</p>
        </div>
        <a href="{{ \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('create') }}" class="dm-btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Misi Baru
        </a>
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 animate-fade-in-up delay-100">
        <div class="dm-stat">
            <div class="dm-stat-accent" style="background:linear-gradient(90deg,#2563eb,#60a5fa)"></div>
            <div class="flex items-start gap-3 mt-1">
                <div class="dm-stat-icon" style="background:#eff6ff">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <div class="dm-stat-label">Total Apps</div>
                    <div class="dm-stat-value">{{ $statTotal }}</div>
                    <div class="dm-stat-sub">aplikasi didaftarkan</div>
                </div>
            </div>
        </div>

        <div class="dm-stat">
            <div class="dm-stat-accent" style="background:linear-gradient(90deg,#10b981,#34d399)"></div>
            <div class="flex items-start gap-3 mt-1">
                <div class="dm-stat-icon" style="background:#d1fae5">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <div class="dm-stat-label">Running</div>
                    <div class="dm-stat-value">{{ $statRunning }}</div>
                    <div class="dm-stat-sub">misi sedang aktif</div>
                </div>
            </div>
        </div>

        <div class="dm-stat">
            <div class="dm-stat-accent" style="background:linear-gradient(90deg,#f59e0b,#fcd34d)"></div>
            <div class="flex items-start gap-3 mt-1">
                <div class="dm-stat-icon" style="background:#fef9c3">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m2 0h6m-3-3v3m-3-3l3-3 3 3"/></svg>
                </div>
                <div>
                    <div class="dm-stat-label">Total Testers</div>
                    <div class="dm-stat-value">{{ $statTesters }}</div>
                    <div class="dm-stat-sub">orang sedang menguji</div>
                </div>
            </div>
        </div>

        <div class="dm-stat">
            <div class="dm-stat-accent" style="background:linear-gradient(90deg,#7c3aed,#a78bfa)"></div>
            <div class="flex items-start gap-3 mt-1">
                <div class="dm-stat-icon" style="background:#f5f3ff">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <div class="dm-stat-label">Total Points</div>
                    <div class="dm-stat-value dm-mono">{{ number_format($statPoints, 0, ',', '.') }}</div>
                    <div class="dm-stat-sub">poin dikeluarkan</div>
                </div>
            </div>
        </div>
    </div>
</div>
