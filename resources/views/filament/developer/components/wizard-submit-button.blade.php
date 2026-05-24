<x-filament::button 
    type="submit" 
    size="md"
    color="danger" 
    wire:loading.attr="disabled"
    wire:target="create"
    class="transition-all duration-300 hover:shadow-lg hover:shadow-red-500/30"
>
    <x-slot name="icon">
        <x-heroicon-m-check-circle class="w-5 h-5 transition-transform duration-300" wire:loading.remove wire:target="create" />
        <x-filament::loading-indicator class="w-5 h-5" wire:loading wire:target="create" />
    </x-slot>

    <span wire:loading.remove wire:target="create" class="font-bold">
        Buat Misi Sekarang
    </span>
    
    <span wire:loading wire:target="create" class="font-bold">
        Memproses Pembayaran...
    </span>
</x-filament::button>