<x-filament-panels::page>
    <div class="space-y-6">
        <x-filament::card>
            <div class="flex items-center justify-between border-b pb-4 mb-4">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    {{ $misi->nama_aplikasi }}
                </h1>
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
                    <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $misi->paket?->desc ?? '-' }}
                    </p>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Testing Instructions</h3>
                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 prose dark:prose-invert max-w-none">
                    {!! nl2br(e($misi->instruksi)) !!}
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <x-filament::button 
                    wire:click="takeMission" 
                    size="lg"
                    class="shadow-lg transform transition hover:scale-105"
                >
                    Ambil Misi
                </x-filament::button>
            </div>
        </x-filament::card>

        @if($misi->link_aplikasi)
            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-200 dark:border-blue-800 flex items-start space-x-3">
                <x-heroicon-o-information-circle class="w-6 h-6 text-blue-500 mt-0.5" />
                <div>
                    <h4 class="font-semibold text-blue-800 dark:text-blue-300">Application Link</h4>
                    <p class="text-blue-700 dark:text-blue-400 text-sm mb-2">Click the button below to visit the application site.</p>
                    <a href="{{ $misi->link_aplikasi }}" target="_blank" class="text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline">
                        Visit Application &rarr;
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
