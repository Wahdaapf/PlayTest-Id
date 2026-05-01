<x-filament-panels::page>
    <div class="mb-4">
        <h2 class="text-xl font-bold">Daftar Tester untuk Misi: {{ $record->nama_aplikasi }}</h2>
        <p class="text-gray-500 text-sm">Di bawah ini adalah daftar tester yang telah mengambil misi ini.</p>
    </div>

    {{ $this->table }}
</x-filament-panels::page>
