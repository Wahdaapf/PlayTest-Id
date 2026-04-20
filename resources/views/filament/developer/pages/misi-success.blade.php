<x-filament-panels::page>
    <div class="flex flex-col items-center justify-center min-h-[400px] text-center">
        <div class="p-4 mb-4 bg-green-100 rounded-full dark:bg-green-900">
            <x-heroicon-o-check-circle class="w-12 h-12 text-green-600 dark:text-green-400" />
        </div>
        <h2 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
            Data Berhasil Disubmit
        </h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">
            Terima kasih! Bukti pembayaran Anda telah kami terima. Silakan menunggu konfirmasi dan persetujuan dari admin.
        </p>
        <div class="mt-6">
            <x-filament::button
                href="{{ \App\Filament\Developer\Resources\Misis\MisiResource::getUrl() }}"
                tag="a"
            >
                Kembali ke Daftar Misi
            </x-filament::button>
        </div>
    </div>
</x-filament-panels::page>
