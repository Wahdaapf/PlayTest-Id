@php
    $paketId = $this->data['id_paket'] ?? null;
    $paket = $paketId ? \App\Models\Paket::find($paketId) : null;

    $price = $paket?->price ?? 0;
    $fee = $paket?->fee ?? 0;
    $total = $price + $fee;
@endphp

{{-- ══════════════════════════════════════════════════════════════
     PAYMENT SUMMARY — Midnight Aurora Theme
     Glassmorphism receipt with animated gradient header
   ══════════════════════════════════════════════════════════════ --}}

<style>
    @keyframes sum-aurora {
        0%,100% { background-position: 0% 50%; }
        50%     { background-position: 100% 50%; }
    }
    @keyframes sum-fadein {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .sum-card {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        animation: sum-fadein .5s ease-out both;
    }
    .sum-header {
        background: linear-gradient(120deg, #4f46e5, #a855f7, #06b6d4, #4f46e5);
        background-size: 300% 300%;
        animation: sum-aurora 8s ease infinite;
    }
    .sum-total-amount {
        background: linear-gradient(135deg, #4f46e5, #a855f7 50%, #06b6d4);
        -webkit-background-clip: text;
                background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<div class="sum-card rounded-2xl border border-white/40 dark:border-white/10 shadow-xl shadow-indigo-500/5 dark:shadow-indigo-500/10 overflow-hidden bg-white/70 dark:bg-slate-900/60">

    {{-- Animated aurora header --}}
    <div class="sum-header relative p-5 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.25),transparent_60%)]"></div>
        <div class="relative flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center ring-1 ring-white/30">
                <x-heroicon-m-receipt-percent class="w-5 h-5 text-white" />
            </div>
            <div>
                <h3 class="text-sm font-black uppercase tracking-[0.18em] text-white">
                    {{ __('Detail Pembayaran') }}
                </h3>
                <p class="text-[10px] font-medium text-white/80 mt-0.5">{{ __('Ringkasan transaksi Anda') }}</p>
            </div>
        </div>
    </div>

    <div class="p-5 space-y-6">
        {{-- Paket terpilih --}}
        @if ($paket)
            <div class="group relative rounded-xl p-4 overflow-hidden border border-indigo-100/70 dark:border-indigo-400/20
                        bg-gradient-to-br from-indigo-50 via-white to-cyan-50
                        dark:from-indigo-500/15 dark:via-slate-900/40 dark:to-cyan-500/10
                        transition-all duration-500 hover:shadow-lg hover:shadow-indigo-500/10">
                <div class="absolute -top-4 -right-4 opacity-10 dark:opacity-15 transition-transform duration-700 group-hover:rotate-12 group-hover:scale-110">
                    <x-heroicon-o-cube class="w-24 h-24 text-indigo-600 dark:text-indigo-400" />
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-300 mb-1.5 flex items-center gap-1.5">
                    <x-heroicon-m-sparkles class="w-3 h-3" />
                    {{ __('Paket Terpilih') }}
                </p>
                <p class="text-lg font-black text-slate-900 dark:text-white relative z-10">
                    {{ $paket->name ?? $paket->desc ?? __('Paket') . " #{$paket->id}" }}
                </p>
            </div>
        @else
            <div class="rounded-xl border-2 border-dashed border-slate-200 dark:border-slate-700 p-6 text-center bg-slate-50/50 dark:bg-white/5">
                <x-heroicon-o-cube class="w-9 h-9 text-slate-300 dark:text-slate-600 mx-auto mb-2 animate-pulse" />
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">{{ __('Belum ada paket dipilih') }}</p>
            </div>
        @endif

        {{-- Rincian biaya --}}
        <div class="space-y-3.5">
            <div class="flex justify-between items-center text-sm">
                <span class="font-medium text-slate-500 dark:text-slate-400 flex items-center gap-2">
                    <span class="w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                    {{ __('Harga Paket') }}
                </span>
                <span class="font-bold text-slate-900 dark:text-white tabular-nums">Rp {{ number_format($price, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between items-center text-sm">
                <span class="font-medium text-slate-500 dark:text-slate-400 flex items-center gap-2">
                    <span class="w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                    {{ __('Biaya Layanan') }}
                </span>
                <span class="font-bold text-slate-900 dark:text-white tabular-nums">Rp {{ number_format($fee, 0, ',', '.') }}</span>
            </div>

            {{-- Dotted receipt-style separator --}}
            <div class="relative py-2">
                <div class="border-t-2 border-dashed border-slate-200 dark:border-slate-700"></div>
                <div class="absolute -left-7 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-slate-50 dark:bg-slate-950 border-2 border-white/40 dark:border-white/10"></div>
                <div class="absolute -right-7 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-slate-50 dark:bg-slate-950 border-2 border-white/40 dark:border-white/10"></div>
            </div>

            <div class="flex justify-between items-end pt-1">
                <div>
                    <span class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.18em] mb-0.5">{{ __('Total Transfer') }}</span>
                    <span class="text-xs font-bold text-slate-600 dark:text-slate-400">IDR</span>
                </div>
                <span class="sum-total-amount text-3xl font-black tracking-tighter tabular-nums">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- Info & security --}}
        <div class="space-y-3 pt-1">
            <div class="flex gap-3 p-3.5 rounded-xl bg-gradient-to-br from-amber-50 to-orange-50/60 dark:from-amber-500/10 dark:to-orange-500/5 border border-amber-200/50 dark:border-amber-500/20">
                <div class="shrink-0 w-7 h-7 rounded-lg bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow shadow-amber-500/30">
                    <x-heroicon-s-information-circle class="w-4 h-4 text-white" />
                </div>
                <p class="text-[11px] text-amber-900 dark:text-amber-100 leading-relaxed font-medium">
                    {{ __('Misi aktif setelah sistem memverifikasi pembayaran Anda. Maksimal') }}
                    <span class="font-black">1×24 {{ __('jam') }}</span>.
                </p>
            </div>

            <div class="flex items-center gap-2 justify-center py-2.5 rounded-xl bg-gradient-to-r from-emerald-50 via-cyan-50 to-emerald-50 dark:from-emerald-500/10 dark:via-cyan-500/10 dark:to-emerald-500/10 border border-emerald-200/40 dark:border-emerald-500/20">
                <x-heroicon-s-shield-check class="w-4 h-4 text-emerald-500" />
                <span class="text-[10px] text-emerald-700 dark:text-emerald-300 font-black uppercase tracking-[0.18em]">
                    {{ __('Pembayaran 100% Aman') }}
                </span>
            </div>
        </div>
    </div>
</div>
