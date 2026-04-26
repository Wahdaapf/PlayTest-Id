<x-filament-panels::page>  
  
@push('styles')  
<link rel="preconnect" href="https://fonts.googleapis.com">  
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">  
<style>  
/* FONT */  
body, .fi-main { font-family: 'Inter', sans-serif !important; }  
.mp-sora { font-family: 'Sora', sans-serif !important; }  
.mp-mono { font-family: 'JetBrains Mono', monospace !important; }  
  
[x-cloak] { display: none !important; }  
  
/* STAT CARDS */  
.mp-stat {  
    background: #fff; border-radius: 14px; padding: 18px 20px;  
    border: 1px solid #e2e8f0; position: relative; overflow: hidden; transition: box-shadow .2s;  
}  
.mp-stat:hover { box-shadow: 0 4px 20px rgba(0,0,0,.08); }  
.mp-stat-accent { position: absolute; top:0;left:0;right:0; height:3px; }  
.mp-stat-icon { width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0; }  
.mp-stat-label { font-size:.72rem;color:#64748b;font-weight:500;text-transform:uppercase;letter-spacing:.06em; }  
.mp-stat-value { font-size:1.5rem;font-weight:800;color:#0f172a;line-height:1.1; }  
.mp-stat-sub   { font-size:.72rem;color:#94a3b8;margin-top:2px; }  
  
/* PAKET CARDS */  
.mp-paket-card {  
    background:#fff; border-radius:18px; border:2px solid #e2e8f0;  
    overflow:hidden; position:relative; transition:box-shadow .25s,transform .25s;  
    display:flex; flex-direction:column;  
}  
.mp-paket-card:hover { box-shadow:0 8px 32px rgba(0,0,0,.1); transform:translateY(-2px); }  
.mp-paket-card.mp-popular { border-color:#2563eb; box-shadow:0 4px 24px rgba(37,99,235,.18); }  
.mp-paket-card.mp-premium { border-color:#7c3aed; box-shadow:0 4px 24px rgba(124,58,237,.12); }  
.mp-paket-header { padding:24px 24px 20px; position:relative; }  
.mp-paket-body { padding:0 24px 24px; flex:1; display:flex; flex-direction:column; }  
.mp-badge { position:absolute;top:16px;right:16px;font-size:.68rem;font-weight:700;padding:3px 10px;border-radius:20px; }  
.mp-badge-popular { background:#2563eb;color:#fff; }  
.mp-badge-premium { background:#7c3aed;color:#fff; }  
.mp-paket-nama { font-size:1.25rem;font-weight:800;margin-bottom:4px; }  
.mp-paket-desc { font-size:.78rem;color:#64748b;line-height:1.5;min-height:48px; }  
.mp-harga-wrap { margin:20px 0 16px; }  
.mp-harga-angka { font-size:2rem;font-weight:800;line-height:1; }  
.mp-harga-sub   { font-size:.75rem;color:#94a3b8;margin-top:2px; }  
.mp-divider { border:none;border-top:1px solid #f1f5f9;margin:0 0 16px; }  
.mp-fitur-list { list-style:none;padding:0;margin:0 0 16px;flex:1; }  
.mp-fitur-list li { display:flex;align-items:center;gap:8px;font-size:.8rem;color:#334155;padding:5px 0; }  
.mp-fitur-list li .mp-check { color:#22c55e;font-size:.9rem;flex-shrink:0; }  
.mp-fitur-list li .mp-cross { color:#cbd5e1;font-size:.85rem;flex-shrink:0; }  
.mp-fitur-list li.mp-bukan  { color:#94a3b8;text-decoration:line-through; }  
.mp-meta-grid { display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:16px; }  
.mp-meta-item { background:#f8fafc;border-radius:10px;padding:10px 12px;font-size:.75rem; }  
.mp-meta-label { color:#94a3b8;font-size:.68rem;margin-bottom:2px; }  
.mp-meta-val   { font-weight:700;color:#0f172a; }  
.mp-stats-row { display:flex;justify-content:space-between;align-items:center;background:#f8fafc;border-radius:10px;padding:10px 14px;margin-bottom:8px;font-size:.78rem; }  
.mp-stats-row-label { color:#64748b; }  
.mp-stats-row-val   { font-weight:700;color:#0f172a; }  
.mp-btn-edit { width:100%;padding:10px;border-radius:10px;border:2px solid currentColor;background:transparent;font-size:.82rem;font-weight:700;cursor:pointer;transition:all .15s;font-family:'Inter',sans-serif; }  
.mp-btn-edit:hover { color:#fff !important; }  
  
/* FILTER & TABLE */  
.mp-section-title { font-size:.95rem;font-weight:700;color:#0f172a;margin-bottom:14px;display:flex;align-items:center;gap:8px; }  
.mp-filter-bar { background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:12px 16px;display:flex;flex-wrap:wrap;gap:10px;align-items:center;margin-bottom:14px; }  
.mp-input,.mp-select { border:1px solid #e2e8f0;border-radius:8px;padding:7px 12px;font-size:.82rem;color:#334155;background:#f8fafc;outline:none;transition:border-color .15s;font-family:'Inter',sans-serif; }  
.mp-input:focus,.mp-select:focus { border-color:#2563eb;background:#fff; }  
.mp-btn-ghost { padding:7px 14px;border-radius:8px;font-size:.82rem;font-weight:600;cursor:pointer;background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;transition:all .15s;font-family:'Inter',sans-serif; }  
.mp-btn-ghost:hover { background:#e2e8f0; }  
.mp-table-wrap { background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden; }  
.mp-table { width:100%;border-collapse:collapse; }  
.mp-table thead tr { background:#f8fafc;border-bottom:1px solid #e2e8f0; }  
.mp-table th { padding:10px 16px;font-size:.7rem;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.07em;text-align:left;white-space:nowrap; }  
.mp-table td { padding:12px 16px;font-size:.82rem;color:#334155;border-bottom:1px solid #f1f5f9;vertical-align:middle; }  
.mp-table tbody tr:hover { background:#f8fafc; }  
.mp-table tbody tr:last-child td { border-bottom:none; }  
.mp-avatar { width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:700;color:#fff;flex-shrink:0; }  
.mp-paket-pill { display:inline-block;padding:2px 10px;border-radius:20px;font-size:.7rem;font-weight:700; }  
.mp-pill-starter  { background:#f1f5f9;color:#475569; }  
.mp-pill-pro      { background:#eff6ff;color:#1d4ed8; }  
.mp-pill-business { background:#fdf4ff;color:#7e22ce; }  
.mp-status-pill { display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:600; }  
.mp-status-aktif   { background:#dcfce7;color:#15803d; }  
.mp-status-review  { background:#fef9c3;color:#a16207; }  
.mp-status-selesai { background:#f1f5f9;color:#475569; }  
.mp-dot { width:6px;height:6px;border-radius:50%; }  
.mp-dot-aktif   { background:#22c55e; }  
.mp-dot-review  { background:#eab308; }  
.mp-dot-selesai { background:#94a3b8; }  
  
/* MODAL */  
.mp-modal-bg { position:fixed;inset:0;background:rgba(15,23,42,.45);backdrop-filter:blur(3px);z-index:9998;display:flex;align-items:flex-start;justify-content:flex-end; }  
.mp-modal-panel { width:460px;max-width:95vw;height:100vh;background:#fff;overflow-y:auto;box-shadow:-8px 0 40px rgba(0,0,0,.15); }  
.mp-modal-header { padding:22px 24px 18px;border-bottom:1px solid #e2e8f0;background:#f8fafc;position:sticky;top:0;z-index:1; }  
.mp-modal-body { padding:24px; }  
.mp-modal-section { font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#94a3b8;margin:20px 0 10px; }  
.mp-modal-section:first-child { margin-top:0; }  
.mp-form-group { margin-bottom:14px; }  
.mp-form-label { display:block;font-size:.78rem;font-weight:600;color:#374151;margin-bottom:5px; }  
.mp-form-input,.mp-form-select,.mp-form-textarea { width:100%;padding:9px 12px;border:1px solid #e2e8f0;border-radius:8px;font-size:.83rem;color:#334155;background:#fff;outline:none;transition:border-color .15s;font-family:'Inter',sans-serif;box-sizing:border-box; }  
.mp-form-input:focus,.mp-form-select:focus,.mp-form-textarea:focus { border-color:#2563eb; }  
.mp-form-textarea { resize:vertical;min-height:70px; }  
.mp-form-note { font-size:.7rem;color:#94a3b8;margin-top:4px; }  
.mp-form-row { display:grid;grid-template-columns:1fr 1fr;gap:12px; }  
.mp-toggle-wrap { display:flex;align-items:center;justify-content:space-between;padding:10px 0; }  
.mp-toggle-label { font-size:.83rem;color:#374151;font-weight:500; }  
.mp-toggle { width:40px;height:22px;border-radius:20px;background:#e2e8f0;cursor:pointer;position:relative;transition:background .2s;flex-shrink:0;border:none; }  
.mp-toggle.on { background:#2563eb; }  
.mp-toggle::after { content:'';position:absolute;top:3px;left:3px;width:16px;height:16px;border-radius:50%;background:#fff;transition:left .2s;box-shadow:0 1px 3px rgba(0,0,0,.2); }  
.mp-toggle.on::after { left:21px; }  
.mp-modal-footer { padding:16px 24px;border-top:1px solid #e2e8f0;display:flex;gap:10px;background:#f8fafc;position:sticky;bottom:0; }  
.mp-btn-save { flex:1;padding:10px;border-radius:8px;border:none;background:#2563eb;color:#fff;font-size:.85rem;font-weight:700;cursor:pointer;font-family:'Inter',sans-serif;transition:background .15s; }  
.mp-btn-save:hover { background:#1d4ed8; }  
.mp-btn-cancel { padding:10px 18px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;color:#475569;font-size:.85rem;font-weight:600;cursor:pointer;font-family:'Inter',sans-serif;transition:all .15s; }  
.mp-btn-cancel:hover { background:#f1f5f9; }  
.mp-preview-box { border-radius:12px;padding:16px;border:2px dashed #e2e8f0;text-align:center;margin-bottom:4px; }  
</style>  
@endpush  
  
<div class="space-y-6" x-data="manajemenPaket()" x-init="init()">  
  
{{-- HEADER --}}  
<div class="flex items-center justify-between">  
    <div>  
        <h1 class="mp-sora text-xl font-bold text-slate-900">Manajemen Paket</h1>  
        <p class="text-sm text-slate-500 mt-0.5">Kelola paket harga dan fitur yang tersedia untuk developer</p>  
    </div>  
    <a href="{{ \App\Filament\Admin\Resources\Pakets\PaketResource::getUrl('create') }}"
       class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold text-white transition"  
       style="background:#0f172a"  
       onmouseover="this.style.background='#1e293b'"  
       onmouseout="this.style.background='#0f172a'">  
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">  
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>  
        </svg>  
        Tambah Paket  
    </a>  
</div>  
  
{{-- STAT CARDS --}}  
<div class="grid grid-cols-2 xl:grid-cols-4 gap-4">  
  
    <div class="mp-stat">  
        <div class="mp-stat-accent" style="background:linear-gradient(90deg,#2563eb,#60a5fa)"></div>  
        <div class="flex items-start gap-3 mt-1">  
            <div class="mp-stat-icon" style="background:#eff6ff">
                <svg class="w-5 h-5" style="color:#2563eb" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>  
            <div>  
                <div class="mp-stat-label">Total Paket</div>  
                <div class="mp-stat-value">{{ $statTotalPaket }}</div>  
                <div class="mp-stat-sub">paket tersedia</div>  
            </div>  
        </div>  
    </div>  
  
    <div class="mp-stat">  
        <div class="mp-stat-accent" style="background:linear-gradient(90deg,#22c55e,#86efac)"></div>  
        <div class="flex items-start gap-3 mt-1">  
            <div class="mp-stat-icon" style="background:#dcfce7">
                <svg class="w-5 h-5" style="color:#16a34a" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>  
            <div>  
                <div class="mp-stat-label">Paket Aktif</div>  
                <div class="mp-stat-value">{{ $statPaketAktif }}</div>  
                <div class="mp-stat-sub">sedang berjalan</div>  
            </div>  
        </div>  
    </div>  
  
    <div class="mp-stat">  
        <div class="mp-stat-accent" style="background:linear-gradient(90deg,#f59e0b,#fcd34d)"></div>  
        <div class="flex items-start gap-3 mt-1">  
            <div class="mp-stat-icon" style="background:#fef9c3">
                <svg class="w-5 h-5" style="color:#f59e0b" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5V4H2v16h5m2 0h6m-3-3v3m-3-3l3-3 3 3"/></svg>
            </div>  
            <div>  
                <div class="mp-stat-label">Total Subscriber</div>  
                <div class="mp-stat-value">{{ $statTotalSubscriber }}</div>  
                <div class="mp-stat-sub">developer aktif</div>  
            </div>  
        </div>  
    </div>  
  
    <div class="mp-stat">  
        <div class="mp-stat-accent" style="background:linear-gradient(90deg,#10b981,#34d399)"></div>  
        <div class="flex items-start gap-3 mt-1">  
            <div class="mp-stat-icon" style="background:#d1fae5">
                <svg class="w-5 h-5" style="color:#10b981" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>  
            <div>  
                <div class="mp-stat-label">Total Pendapatan</div>  
                <div class="mp-stat-value mp-mono" style="font-size:1.1rem">{{ $statPendapatan }}</div>  
                <div class="mp-stat-sub">dari semua paket</div>  
            </div>  
        </div>  
    </div>  
  
</div>  
  
{{-- 3 PAKET CARDS --}}  
<div>  
    <div class="mp-sora font-bold text-slate-900 text-base mb-4">Daftar Paket</div>  
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">  
  
        @foreach($paketList as $idx => $p)  
        @php  
            $isPopular = $p['badge'] === 'Terpopuler';  
            $isPremium = $p['badge'] === 'Premium';  
            $cardClass = $isPopular ? 'mp-popular' : ($isPremium ? 'mp-premium' : '');  
        @endphp  
  
        <div class="mp-paket-card {{ $cardClass }}">  
            <div class="mp-paket-header" style="background:{{ $p['warnaBg'] }};border-bottom:1px solid {{ $p['warnaBorder'] }}">  
                @if($p['badge'])  
                <span class="mp-badge mp-badge-{{ $isPopular ? 'popular' : 'premium' }}">  
                    {{ $isPopular ? '🔥' : '⭐' }} {{ $p['badge'] }}  
                </span>  
                @endif  
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br {{ $p['warnaGrad'] }} flex items-center justify-center text-white font-black text-lg mb-3 shadow-lg">  
                    {{ strtoupper(substr($p['nama'], 0, 1)) }}  
                </div>  
                <div class="mp-paket-nama mp-sora flex items-center gap-1.5" style="color:{{ $p['warnaPrimary'] }}">
                    {{ $p['nama'] }}
                    @if($p['trusted_badge'])
                        <x-heroicon-m-check-badge class="w-5 h-5 text-blue-500" />
                    @endif
                </div>  
                <div class="mp-paket-desc">{{ $p['deskripsi'] }}</div>  
                <div class="mp-harga-wrap">  
                    <div class="mp-harga-angka mp-mono" style="color:{{ $p['warnaPrimary'] }}">{{ $p['hargaF'] }}</div>  
                    <div class="mp-harga-sub">per kampanye · 14 hari</div>  
                </div>  
            </div>  
  
            <div class="mp-paket-body">  
                <div class="mp-meta-grid mt-4">  
                    <div class="mp-meta-item">  
                        <div class="mp-meta-label">Max Tester</div>  
                        <div class="mp-meta-val">{{ $p['maxTester'] }} orang</div>  
                    </div>  
                    <div class="mp-meta-item">  
                        <div class="mp-meta-label">Durasi</div>  
                        <div class="mp-meta-val">{{ $p['durasiHari'] }} hari</div>  
                    </div>  
                    <div class="mp-meta-item">  
                        <div class="mp-meta-label">Revisi</div>  
                        <div class="mp-meta-val">{{ $p['maxRevisi'] == 99 ? 'Unlimited' : $p['maxRevisi'].'x' }}</div>  
                    </div>  
                    <div class="mp-meta-item">  
                        <div class="mp-meta-label">Support</div>  
                        <div class="mp-meta-val" style="font-size:.7rem">{{ $p['support'] }}</div>  
                    </div>  
                </div>  
  
                <div class="mp-stats-row">  
                    <span class="mp-stats-row-label">Subscriber</span>  
                    <span class="mp-stats-row-val">{{ $p['totalSubscriber'] }} developer</span>  
                </div>  
                <div class="mp-stats-row">  
                    <span class="mp-stats-row-label">Pendapatan</span>  
                    <span class="mp-stats-row-val mp-mono" style="font-size:.75rem">{{ $p['pendapatanTotal'] }}</span>  
                </div>  
  
                <hr class="mp-divider mt-2">  
  
                <ul class="mp-fitur-list">  
                    @foreach($p['fitur'] as $f)  
                    <li><span class="mp-check">✓</span>{{ $f }}</li>  
                    @endforeach  
                    @foreach($p['bukan'] as $b)  
                    <li class="mp-bukan"><span class="mp-cross">✗</span>{{ $b }}</li>  
                    @endforeach  
                </ul>  
  
                <button  
                    class="mp-btn-edit flex items-center justify-center gap-2"  
                    style="color:{{ $p['warnaPrimary'] }}"  
                    onmouseover="this.style.background='{{ $p['warnaPrimary'] }}'"  
                    onmouseout="this.style.background='transparent'"  
                    @click="bukaModal({{ $idx }})"  
                >  
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg> 
                    Edit Paket {{ $p['nama'] }}  
                </button>  
            </div>  
        </div>  
        @endforeach  
  
    </div>  
</div>  
  
{{-- SUBSCRIBER TABLE --}}  
<div>  
    <div class="mp-section-title mp-sora">  
        <span>Riwayat Subscriber</span>  
        <span class="text-xs font-normal text-slate-400 ml-1">{{ count($subscriberList) }} developer terbaru</span>  
    </div>  
  
    <div class="mp-filter-bar">  
        <div class="relative flex-1 min-w-40">  
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">  
                <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>  
            </svg>  
            <input type="text" placeholder="Cari developer atau kampanye…" class="mp-input w-full pl-9" x-model="cariSub">  
        </div>  
        <select class="mp-select" x-model="filterSubPaket">  
            <option value="">Semua Paket</option>  
            <option value="Starter">Starter</option>  
            <option value="Pro">Pro</option>  
            <option value="Business">Business</option>  
        </select>  
        <select class="mp-select" x-model="filterSubStatus">  
            <option value="">Semua Status</option>  
            <option value="Aktif">Aktif</option>  
            <option value="Review">Review</option>  
            <option value="Selesai">Selesai</option>  
        </select>  
        <button class="mp-btn-ghost" @click="resetSubFilter()">Reset</button>  
    </div>  
  
    <div class="mp-table-wrap">  
        <table class="mp-table">  
            <thead>  
                <tr>  
                    <th>Developer</th>  
                    <th>Kampanye</th>  
                    <th>Paket</th>  
                    <th>Status Kampanye</th>  
                    <th>Tanggal Mulai</th>  
                </tr>  
            </thead>  
            <tbody>  
                @foreach($subscriberList as $s)  
                @php $paketSlg = strtolower($s['paket']); $statSlg = strtolower($s['status']); @endphp  
                <tr  
                    data-nama="{{ strtolower($s['nama']) }}"  
                    data-kampanye="{{ strtolower($s['kampanye']) }}"  
                    data-paket="{{ $s['paket'] }}"  
                    data-status="{{ $s['status'] }}"  
                    x-show="tampilSub($el)"  
                >  
                    <td>  
                        <div class="flex items-center gap-2">  
                            <div class="mp-avatar bg-gradient-to-br {{ $s['avatarColor'] }}">{{ $s['inisial'] }}</div>  
                            <div class="font-semibold text-slate-800">{{ $s['nama'] }}</div>  
                        </div>  
                    </td>  
                    <td class="text-slate-600">{{ $s['kampanye'] }}</td>  
                    <td><span class="mp-paket-pill mp-pill-{{ $paketSlg }}">{{ $s['paket'] }}</span></td>  
                    <td>  
                        <span class="mp-status-pill mp-status-{{ $statSlg }}">  
                            <span class="mp-dot mp-dot-{{ $statSlg }}"></span>  
                            {{ $s['status'] }}  
                        </span>  
                    </td>  
                    <td class="text-slate-500">{{ $s['tanggal'] }}</td>  
                </tr>  
                @endforeach  
  
                <tr x-show="!adaSubHasil()" x-cloak>  
                    <td colspan="5" class="text-center py-10 text-slate-400">  
                        <div class="w-14 h-14 mx-auto rounded-2xl flex items-center justify-center mb-3 bg-slate-100">
                            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                            </svg>
                        </div> 
                        <div class="font-semibold text-slate-500">Tidak ada subscriber ditemukan</div>  
                    </td>  
                </tr>  
            </tbody>  
        </table>  
    </div>  
</div>  
  
{{-- MODAL EDIT PAKET --}}  
<div  
    class="mp-modal-bg"  
    x-show="modalTerbuka"  
    x-cloak  
    style="display:none"  
    x-transition:enter="transition ease-out duration-250"  
    x-transition:enter-start="opacity-0"  
    x-transition:enter-end="opacity-100"  
    x-transition:leave="transition ease-in duration-150"  
    x-transition:leave-start="opacity-100"  
    x-transition:leave-end="opacity-0"  
    @click.self="tutupModal()"  
    @keydown.escape.window="tutupModal()"  
>  
    <div  
        class="mp-modal-panel"  
        x-show="modalTerbuka"  
        x-transition:enter="transition ease-out duration-250"  
        x-transition:enter-start="opacity-0 translate-x-8"  
        x-transition:enter-end="opacity-100 translate-x-0"  
        x-transition:leave="transition ease-in duration-150"  
        x-transition:leave-start="opacity-100 translate-x-0"  
        x-transition:leave-end="opacity-0 translate-x-8"  
    >  
        <div class="mp-modal-header">  
            <div class="flex items-center justify-between">  
                <div>  
                    <div class="mp-sora font-bold text-slate-900 text-base">Edit Paket</div>  
                    <div class="text-xs text-slate-400 mt-0.5" x-text="paket ? 'ID: ' + paket.id : ''"></div>  
                </div>  
                <button @click="tutupModal()" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-200 transition">  
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">  
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>  
                    </svg>  
                </button>  
            </div>  
        </div>  
  
        <template x-if="paket">  
            <div class="mp-modal-body">  
  
                <div class="mp-preview-box mb-4">  
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-lg mx-auto mb-2"  
                         :style="'background:' + paket.warnaPrimary"  
                         x-text="paket.nama.charAt(0)"></div>  
                    <div class="font-bold text-slate-900 mp-sora" x-text="paket.nama"></div>  
                    <div class="mp-mono font-bold mt-1" :style="'color:' + paket.warnaPrimary" x-text="paket.hargaF"></div>  
                </div>  
  
                <div class="mp-modal-section">Informasi Dasar</div>  
  
                <div class="mp-form-group">  
                    <label class="mp-form-label">Nama Paket</label>  
                    <input type="text" class="mp-form-input" :value="paket.nama" readonly>  
                    <div class="mp-form-note">Nama paket tidak dapat diubah</div>  
                </div>  
                <div class="mp-form-group">  
                    <label class="mp-form-label">Fitur (pisahkan dengan baris baru/Enter)</label>  
                    <textarea class="mp-form-textarea" x-model="paket.rawDesc"></textarea>  
                </div>  
                <div class="mp-form-group">  
                    <label class="mp-form-label">Badge Label</label>  
                    <input type="text" class="mp-form-input" x-model="paket.badge" placeholder="Kosongkan jika tidak ada">  
                </div>  
  
                <div class="mp-modal-section">Harga &amp; Ketentuan</div>  
                <div class="mp-form-row">  
                    <div class="mp-form-group">  
                        <label class="mp-form-label">Harga (Rp)</label>  
                        <input type="number" class="mp-form-input" x-model="paket.harga">  
                    </div>  
                    <div class="mp-form-group">  
                        <label class="mp-form-label">Durasi (hari)</label>  
                        <input type="number" class="mp-form-input" :value="paket.durasiHari" readonly>  
                    </div>  
                </div>  
                <div class="mp-form-row">  
                    <div class="mp-form-group">  
                        <label class="mp-form-label">Maks. Tester</label>  
                        <input type="number" class="mp-form-input" x-model="paket.maxTester">  
                    </div>  
                    <div class="mp-form-group">  
                        <label class="mp-form-label">Maks. Revisi</label>  
                        <input type="number" class="mp-form-input" :value="paket.maxRevisi === 99 ? 0 : paket.maxRevisi" readonly>  
                        <div class="mp-form-note">Hanya bisa diubah oleh Super Admin</div>  
                    </div>  
                </div>  
  
                <div class="mp-modal-section">Fitur &amp; Layanan</div>  
                <div class="mp-form-group">  
                    <label class="mp-form-label">Tipe Laporan</label>  
                    <select class="mp-form-select">  
                        <option :selected="paket.laporan === 'Dasar'">Dasar</option>  
                        <option :selected="paket.laporan === 'Detail + Analitik'">Detail + Analitik</option>  
                        <option :selected="paket.laporan === 'Lengkap + Export'">Lengkap + Export</option>  
                    </select>  
                </div>  
                <div class="mp-form-group">  
                    <label class="mp-form-label">Prioritas Review</label>  
                    <select class="mp-form-select">  
                        <option :selected="paket.prioritasReview === 'Normal'">Normal</option>  
                        <option :selected="paket.prioritasReview === 'Prioritas'">Prioritas</option>  
                        <option :selected="paket.prioritasReview === 'Sangat Prioritas'">Sangat Prioritas</option>  
                    </select>  
                </div>  
                <div class="mp-form-group">  
                    <label class="mp-form-label">Tipe Support</label>  
                    <select class="mp-form-select">  
                        <option :selected="paket.support === 'Email'">Email</option>  
                        <option :selected="paket.support === 'Email & Chat'">Email & Chat</option>  
                        <option :selected="paket.support === 'Dedicated Manager'">Dedicated Manager</option>  
                    </select>  
                </div>  
  
                <div class="mp-modal-section">Status Paket</div>  
                <div class="mp-toggle-wrap">  
                    <span class="mp-toggle-label">Paket Aktif</span>  
                    <button class="mp-toggle" :class="paketAktif ? 'on' : ''" @click="paketAktif = !paketAktif"></button>  
                </div>  
                <div class="mp-toggle-wrap">  
                    <span class="mp-toggle-label">Trusted Badge</span>  
                    <button class="mp-toggle" :class="trustedBadge ? 'on' : ''" @click="trustedBadge = !trustedBadge"></button>  
                </div>  
                <div class="text-xs text-slate-400 mt-1 mb-2">  
                    Jika dinonaktifkan, paket tidak akan muncul di halaman pilihan developer.  
                </div>  
  
            </div>  
        </template>  
  
        <div class="mp-modal-footer">  
            <button class="mp-btn-cancel" @click="tutupModal()">Batal</button>  
            <button class="mp-btn-save flex items-center justify-center gap-2" @click="$wire.savePaket(paket.db_id, paket.harga, paket.maxTester, paket.rawDesc, paketAktif, trustedBadge); tutupModal()">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                Simpan Perubahan
            </button>  
        </div>  
    </div>  
</div>  
  
</div>  
  
@push('scripts')  
<script>  
const PAKET_DATA = @json($paketList);  
  
function manajemenPaket() {  
    return {  
        cariSub: '', filterSubPaket: '', filterSubStatus: '',  
        modalTerbuka: false, paket: null, paketAktif: true, trustedBadge: false,  
  
        init() {},  
  
        tampilSub($el) {  
            const nama     = $el.dataset.nama     || '';  
            const kampanye = $el.dataset.kampanye || '';  
            const paket    = $el.dataset.paket    || '';  
            const status   = $el.dataset.status   || '';  
            const q        = this.cariSub.toLowerCase().trim();  
            if (q && !nama.includes(q) && !kampanye.includes(q)) return false;  
            if (this.filterSubPaket  && paket  !== this.filterSubPaket)  return false;  
            if (this.filterSubStatus && status !== this.filterSubStatus) return false;  
            return true;  
        },  
  
        adaSubHasil() {  
            const rows = document.querySelectorAll('tbody tr[data-paket]');  
            for (const r of rows) { if (this.tampilSub(r)) return true; }  
            return false;  
        },  
  
        resetSubFilter() { this.cariSub = ''; this.filterSubPaket = ''; this.filterSubStatus = ''; },  
  
        bukaModal(idx) {  
            this.paket       = PAKET_DATA[idx];  
            this.paketAktif  = this.paket.is_aktif;  
            this.trustedBadge = this.paket.trusted_badge;
            this.modalTerbuka = true;  
        },  
  
        tutupModal() {  
            this.modalTerbuka = false;  
            setTimeout(() => { this.paket = null; }, 200);  
        },  
    };  
}  
</script>  
@endpush  
  
</x-filament-panels::page>  