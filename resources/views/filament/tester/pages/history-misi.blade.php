<x-filament-panels::page>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=JetBrains+Mono:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
.hist-page, .hist-page * { font-family: 'Inter', sans-serif; }
.font-mono-num { font-family: 'JetBrains Mono', monospace !important; }
.font-heading  { font-family: 'Plus Jakarta Sans', sans-serif !important; }

/* ── Stat cards ────────────────────────────────── */
.hist-stat {
    background: #ffffff;
    border-radius: 1rem;
    padding: 1.25rem 1.5rem;
    border: 1px solid #f1f5f9;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
    display: flex; align-items: center; gap: 1rem;
}
.dark .hist-stat {
    background: rgb(30 41 59 / 0.6);
    border-color: rgb(51 65 85 / 0.5);
}

/* ── History card ──────────────────────────────── */
.hist-card {
    background: #ffffff;
    border-radius: 1rem;
    border: 1px solid #e2e8f0;
    padding: 1rem 1.25rem;
    display: flex; align-items: center; gap: 1rem;
    transition: box-shadow 0.2s ease, transform 0.2s ease;
}
.hist-card:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,.08);
    transform: translateY(-1px);
}
.dark .hist-card {
    background: rgb(30 41 59 / 0.6);
    border-color: rgb(51 65 85 / 0.4);
}
.dark .hist-card:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,.25);
}

/* ── Filter tabs ───────────────────────────────── */
.hist-tab-active {
    background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;
    font-size: 0.75rem; font-weight: 600; padding: 6px 14px;
    border-radius: 9999px; cursor: pointer; transition: all 0.15s;
}
.hist-tab-inactive {
    background: transparent; color: #64748b; border: 1px solid transparent;
    font-size: 0.75rem; font-weight: 600; padding: 6px 14px;
    border-radius: 9999px; cursor: pointer; transition: all 0.15s;
}
.hist-tab-inactive:hover { background: #f8fafc; color: #1e293b; }

/* ── Empty state ───────────────────────────────── */
.hist-empty {
    text-align: center; padding: 4rem 2rem;
    color: #94a3b8;
}
</style>
@endpush

@php
    $viewData = $this->getViewData();
    $history  = $viewData['history'];
    $total    = $viewData['total'];
    $selesai  = $viewData['selesai'];
    $gagal    = $viewData['gagal'];
    $aktif    = $viewData['aktif'];
@endphp

<div class="hist-page px-6 py-6" x-data="{ filter: 'semua' }">

    {{-- ── SUMMARY STATS ──────────────────────────────────────── --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

        <div class="hist-stat">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#f0fdf4;">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#10b981;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-mono-num text-2xl font-bold" style="color:#10b981;">{{ $selesai }}</p>
                <p class="text-xs font-medium" style="color:#64748b;">Misi Selesai</p>
            </div>
        </div>

        <div class="hist-stat">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#eff6ff;">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#3b82f6;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div>
                <p class="font-mono-num text-2xl font-bold" style="color:#3b82f6;">{{ $aktif }}</p>
                <p class="text-xs font-medium" style="color:#64748b;">Sedang Aktif</p>
            </div>
        </div>

        <div class="hist-stat">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#fef2f2;">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#ef4444;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-mono-num text-2xl font-bold" style="color:#ef4444;">{{ $gagal }}</p>
                <p class="text-xs font-medium" style="color:#64748b;">Misi Gagal</p>
            </div>
        </div>

        <div class="hist-stat">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#f8fafc;">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#64748b;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div>
                <p class="font-mono-num text-2xl font-bold" style="color:#1e293b;">{{ $total }}</p>
                <p class="text-xs font-medium" style="color:#64748b;">Total Pernah Ikut</p>
            </div>
        </div>
    </div>

    {{-- ── FILTER TABS + LIST ─────────────────────────────────── --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl border dark:border-slate-700 overflow-hidden" style="border-color:#e2e8f0;">

        {{-- Header --}}
        <div class="flex items-center justify-between flex-wrap gap-3 px-5 py-4" style="border-bottom:1px solid #f1f5f9;">
            <div>
                <h2 class="font-heading text-sm font-bold" style="color:#1e293b;">Riwayat Semua Misi</h2>
                <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ $total }} misi pernah diikuti</p>
            </div>
            {{-- Filter tabs --}}
            <div class="flex items-center gap-1.5 flex-wrap">
                <button class="hist-tab-active"
                        :class="filter==='semua' ? 'hist-tab-active' : 'hist-tab-inactive'"
                        @click="filter='semua'">Semua</button>
                <button :class="filter==='aktif' ? 'hist-tab-active' : 'hist-tab-inactive'"
                        @click="filter='aktif'">Aktif</button>
                <button :class="filter==='selesai' ? 'hist-tab-active' : 'hist-tab-inactive'"
                        @click="filter='selesai'">Selesai</button>
                <button :class="filter==='gagal' ? 'hist-tab-active' : 'hist-tab-inactive'"
                        @click="filter='gagal'">Gagal</button>
            </div>
        </div>

        {{-- List --}}
        @if(count($history) === 0)
            <div class="hist-empty">
                <svg class="w-14 h-14 mx-auto mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-sm font-medium">Belum ada misi yang diikuti</p>
                <p class="text-xs mt-1">Temukan misi di halaman dashboard dan mulai pengujian pertamamu!</p>
            </div>
        @else
            <div class="divide-y dark:divide-slate-700" style="border-color:#f1f5f9;">
                @foreach($history as $item)
                    @php
                        $filterGroup = match($item['status']) {
                            'accepted', 'progress' => 'aktif',
                            'selesai'              => 'selesai',
                            'failed'               => 'gagal',
                            default                => 'lainnya',
                        };
                    @endphp
                    <div class="hist-card"
                         x-show="filter === 'semua' || filter === '{{ $filterGroup }}'">

                        {{-- Logo / Inisial --}}
                        @if($item['logo'])
                            <img src="/storage/{{ $item['logo'] }}" alt="Logo"
                                 class="w-11 h-11 rounded-xl object-cover flex-shrink-0">
                        @else
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 text-white font-bold text-sm"
                                 style="background:{{ $item['gradient'] }};">
                                {{ $item['inisial'] }}
                            </div>
                        @endif

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="font-heading text-sm font-bold truncate" style="color:#1e293b;">
                                {{ $item['nama'] }}
                            </p>
                            <div class="flex items-center gap-2 mt-0.5 flex-wrap">
                                <span class="text-xs" style="color:#94a3b8;">{{ $item['tipe'] }}</span>
                                <span class="text-xs" style="color:#cbd5e1;">•</span>
                                <span class="text-xs" style="color:#94a3b8;">Bergabung {{ $item['joinedAt'] }}</span>
                            </div>
                        </div>

                        {{-- Point reward --}}
                        <div class="text-right flex-shrink-0 hidden sm:block">
                            <p class="font-mono-num text-sm font-bold" style="color:#10b981;">+{{ $item['point'] }} pts</p>
                            <p class="text-xs" style="color:#94a3b8;">Reward</p>
                        </div>

                        {{-- Status badge --}}
                        <span class="flex-shrink-0 inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full"
                              style="background:{{ $item['statusBg'] }};color:{{ $item['statusColor'] }};border:1px solid color-mix(in srgb, {{ $item['statusColor'] }} 25%, transparent);">
                            {{ $item['statusIcon'] }} {{ $item['statusLabel'] }}
                        </span>

                    </div>

                @endforeach
            </div>

            {{-- No result after filter --}}
            <div class="hist-empty" x-show="filter !== 'semua'" style="display:none;"
                 x-cloak>
                <p class="text-sm font-medium">Tidak ada misi dengan filter ini</p>
            </div>
        @endif
    </div>

    {{-- ── INFO BOX: Mengapa bisa gagal ─────────────────────── --}}
    @if($gagal > 0)
    <div class="mt-4 flex items-start gap-3 px-4 py-3 rounded-xl"
         style="background:#fef2f2;border:1px solid #fecdd3;">
        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#ef4444;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-xs leading-relaxed" style="color:#b91c1c;">
            <strong>Mengapa misi berstatus Gagal?</strong>
            Misi dinyatakan gagal jika kamu tidak mengumpulkan laporan harian selama satu hari penuh.
            Pastikan submit screenshot bukti tugas setiap hari agar tidak melewatkan tenggat waktu.
        </p>
    </div>
    @endif

</div>

</x-filament-panels::page>
