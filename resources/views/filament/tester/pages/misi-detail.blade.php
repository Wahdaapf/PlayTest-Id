<x-filament-panels::page>
    <div class="space-y-6">
        <x-filament::card>
            <div class="flex items-center justify-between border-b pb-4 mb-4">
                <div class="flex items-center gap-4">
                    @if($misi->logo)
                        <img src="/storage/{{ $misi->logo }}" alt="Logo" class="w-14 h-14 rounded-2xl object-cover shadow-sm">
                    @endif
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{ $misi->nama_aplikasi }}
                    </h1>
                </div>
                <div class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">
                    Reward: {{ $misi->point }} pts
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Capacity</h3>
                    <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $misi->kapasitas }} / 20
                    </p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Package</h3>
                    <div class="prose dark:prose-invert prose-sm text-gray-900 dark:text-gray-100 max-w-none">
                        {!! $misi->paket?->desc ?? '-' !!}
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Testing Instructions</h3>
                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 prose dark:prose-invert max-w-none">
                    {!! $misi->instruksi !!}
                </div>
            </div>

            <div class="mt-8">
                @if($alreadyJoined)
                    @if($misi->link_aplikasi)
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-5 rounded-xl border border-blue-200 dark:border-blue-800 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                            <div class="flex items-start gap-3">
                                <x-heroicon-o-information-circle class="w-8 h-8 text-blue-500 flex-shrink-0 mt-0.5" />
                                <div>
                                    <h4 class="font-bold text-blue-800 dark:text-blue-300 text-lg">Misi Telah Dimulai!</h4>
                                    <p class="text-blue-700 dark:text-blue-400 text-sm mt-1">
                                        Anda harus mendownload aplikasi terlebih dahulu dan memainkannya. Setelah selesai, kumpulkan laporan untuk misi hari pertama.
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full md:w-auto flex-shrink-0">
                                <a href="{{ $misi->link_aplikasi }}" target="_blank" class="inline-flex justify-center items-center px-4 py-2 bg-white border border-blue-300 text-blue-700 rounded-lg text-sm font-bold shadow-sm hover:bg-blue-50 transition-colors">
                                    <x-heroicon-o-arrow-down-tray class="w-4 h-4 mr-2" />
                                    Download Aplikasi
                                </a>
                                <a href="/tester/misi-saya" class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold shadow-sm hover:bg-blue-700 transition-colors">
                                    Mulai Misi Hari 1 &rarr;
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="bg-amber-50 dark:bg-amber-900/20 p-4 rounded-xl border border-amber-200 dark:border-amber-800 flex items-start gap-3">
                            <x-heroicon-o-clock class="w-6 h-6 text-amber-500 flex-shrink-0 mt-0.5" />
                            <div>
                                <h4 class="font-bold text-amber-800 dark:text-amber-300">Menunggu Developer</h4>
                                <p class="text-amber-700 dark:text-amber-400 text-sm mt-1">
                                    Anda sudah bergabung dengan misi ini. Silakan tunggu developer memulai misi dan memberikan link aplikasi.
                                </p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="flex justify-end">
                        @if($misi->kapasitas >= 20 || $misi->status === 'closed')
                            <x-filament::button 
                                disabled
                                color="gray"
                                size="lg"
                            >
                                Misi Penuh
                            </x-filament::button>
                        @else
                            <x-filament::button 
                                wire:click="takeMission" 
                                size="lg"
                                class="shadow-lg transform transition hover:scale-105"
                            >
                                Ambil Misi
                            </x-filament::button>
                        @endif
                    </div>
                @endif
            </div>
        </x-filament::card>
    </div>
</x-filament-panels::page>
