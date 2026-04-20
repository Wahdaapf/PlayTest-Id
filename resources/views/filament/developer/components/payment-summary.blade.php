@php
    $paketId = $this->data['id_paket'] ?? null;
    $paket = $paketId ? \App\Models\Paket::find($paketId) : null;
    
    $price = $paket?->price ?? 0;
    $fee = $paket?->fee ?? 0;
    $total = $price + $fee;
@endphp

<div class="space-y-4">

    {{-- Paket terpilih --}}
    @if ($paket)
        <div class="rounded-xl bg-red-50 border-2 border-red-200 p-4 shadow-sm">
            <div class="flex items-center gap-2 mb-1">
                <x-heroicon-m-check-badge class="w-5 h-5 text-red-600" />
                <span class="text-xs font-black uppercase tracking-widest text-red-600">Paket Terpilih</span>
            </div>
            <p class="text-lg font-black text-slate-900 mt-1">
                {{ $paket->name ?? $paket->desc ?? "Paket #{$paket->id}" }}
            </p>
        </div>
    @else
        <div class="rounded-xl border border-dashed border-gray-300 p-4 text-center">
            <x-heroicon-o-cube class="w-6 h-6 text-gray-300 mx-auto mb-1" />
            <p class="text-xs text-gray-400 font-bold uppercase tracking-tight">Belum ada paket dipilih</p>
        </div>
    @endif

    {{-- Rincian biaya --}}
    <div class="space-y-3 py-2 px-1">
        <div class="flex justify-between items-center text-sm">
            <span class="font-bold text-slate-600">Harga Paket</span>
            <span class="font-black text-slate-900 text-base">Rp {{ number_format($price, 0, ',', '.') }}</span>
        </div>

        <div class="flex justify-between items-center text-sm">
            <span class="font-bold text-slate-600">Service Fee</span>
            <span class="font-black text-slate-900 text-base">Rp {{ number_format($fee, 0, ',', '.') }}</span>
        </div>

        <div class="border-t-2 border-slate-100 pt-3 flex justify-between items-center">
            <span class="font-black text-slate-900 text-base uppercase tracking-tight">Total Transfer</span>
            <span class="text-xl font-black text-red-600">
                Rp {{ number_format($total, 0, ',', '.') }}
            </span>
        </div>
    </div>

    {{-- Catatan --}}
    <div class="rounded-lg bg-amber-50 border border-amber-200 p-3">
        <div class="flex gap-2">
            <x-heroicon-o-exclamation-triangle class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5" />
            <p class="text-[11px] text-amber-900 leading-relaxed font-medium">
                Misi akan aktif setelah admin memverifikasi bukti pembayaranmu. Proses verifikasi maksimal <strong>1×24 jam</strong>.
            </p>
        </div>
    </div>

    {{-- Security --}}
    <div class="flex items-center gap-1.5 justify-center py-2">
        <x-heroicon-o-lock-closed class="w-3 h-3 text-gray-400" />
        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Safe & Encrypted</span>
    </div>

</div>