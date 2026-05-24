@php
    $paketId = $this->data['id_paket'] ?? null;
    $paket = $paketId ? \App\Models\Paket::find($paketId) : null;
    
    $price = $paket?->price ?? 0;
    $fee = $paket?->fee ?? 0;
    $total = $price + $fee;
@endphp

<div class="bg-white dark:bg-gray-900 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm overflow-hidden">
    {{-- Header Summary --}}
    <div class="bg-slate-50 dark:bg-gray-800 p-5 border-b border-slate-200 dark:border-gray-700">
        <h3 class="text-sm font-black uppercase tracking-widest text-slate-800 dark:text-white flex items-center gap-2">
            <x-heroicon-o-receipt-percent class="w-5 h-5 text-red-500" />
            Detail Pembayaran
        </h3>
    </div>

    <div class="p-5 space-y-6">
        {{-- Paket terpilih --}}
        @if ($paket)
            <div class="rounded-xl bg-gradient-to-br from-red-50 to-orange-50 dark:from-red-900/20 dark:to-orange-900/10 border border-red-100 dark:border-red-900/50 p-4 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-3 opacity-10 dark:opacity-5">
                    <x-heroicon-o-cube class="w-16 h-16 text-red-600 dark:text-red-400" />
                </div>
                <p class="text-xs font-bold uppercase tracking-widest text-red-600 dark:text-red-400 mb-1">Paket Terpilih</p>
                <p class="text-lg font-black text-slate-900 dark:text-white relative z-10">
                    {{ $paket->name ?? $paket->desc ?? "Paket #{$paket->id}" }}
                </p>
            </div>
        @else
            <div class="rounded-xl border-2 border-dashed border-slate-200 dark:border-gray-700 p-6 text-center bg-slate-50 dark:bg-gray-800">
                <x-heroicon-o-cube class="w-8 h-8 text-slate-300 dark:text-gray-600 mx-auto mb-2" />
                <p class="text-xs text-slate-500 dark:text-gray-400 font-bold uppercase tracking-tight">Belum ada paket dipilih</p>
            </div>
        @endif

        {{-- Rincian biaya (Struk Layout) --}}
        <div class="space-y-4">
            <div class="flex justify-between items-center text-sm">
                <span class="font-medium text-slate-500 dark:text-gray-400">Harga Paket</span>
                <span class="font-bold text-slate-900 dark:text-white">Rp {{ number_format($price, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between items-center text-sm">
                <span class="font-medium text-slate-500 dark:text-gray-400">Service Fee</span>
                <span class="font-bold text-slate-900 dark:text-white">Rp {{ number_format($fee, 0, ',', '.') }}</span>
            </div>

            {{-- Pemisah putus-putus ala struk belanja --}}
            <div class="border-t-2 border-dashed border-slate-200 dark:border-gray-700 pt-4 flex justify-between items-end mt-2">
                <div>
                    <span class="block text-[10px] font-bold text-slate-400 dark:text-gray-500 uppercase tracking-widest mb-0.5">Total Transfer</span>
                    <span class="text-sm font-black text-slate-800 dark:text-gray-200">IDR</span>
                </div>
                <span class="text-2xl font-black text-red-600 dark:text-red-500 tracking-tight">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- Catatan & Security Badge --}}
        <div class="space-y-3 pt-2">
            <div class="flex gap-3 p-3 rounded-xl bg-amber-50/50 dark:bg-amber-500/10 border border-amber-100 dark:border-amber-500/20">
                <x-heroicon-s-information-circle class="w-5 h-5 text-amber-500 flex-shrink-0" />
                <p class="text-[11px] text-amber-800 dark:text-amber-200 leading-relaxed font-medium">
                    Misi aktif setelah admin memverifikasi bukti pembayaranmu. Maksimal <span class="font-bold text-amber-900 dark:text-amber-100">1×24 jam</span>.
                </p>
            </div>

            <div class="flex items-center gap-2 justify-center py-2 bg-slate-50 dark:bg-gray-800 rounded-lg">
                <x-heroicon-s-shield-check class="w-4 h-4 text-emerald-500" />
                <span class="text-[10px] text-slate-500 dark:text-gray-400 font-bold uppercase tracking-widest">Pembayaran 100% Aman</span>
            </div>
        </div>
    </div>
</div>