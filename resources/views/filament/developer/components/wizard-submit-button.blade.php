<style>
    @keyframes wsb-aurora {
        0%,100% { background-position: 0% 50%; }
        50%     { background-position: 100% 50%; }
    }
    @keyframes wsb-shine {
        0%   { transform: translateX(-150%) skewX(-20deg); }
        100% { transform: translateX(250%)  skewX(-20deg); }
    }
    .wsb-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .6rem;
        padding: .85rem 1.6rem;
        border-radius: 1rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: .02em;
        background: linear-gradient(120deg, #4f46e5, #a855f7, #06b6d4, #4f46e5);
        background-size: 300% 300%;
        animation: wsb-aurora 6s ease infinite;
        box-shadow:
            0 10px 30px -10px rgba(99,102,241,.55),
            0 4px 12px -4px rgba(168,85,247,.4),
            inset 0 1px 0 rgba(255,255,255,.25);
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease, filter .25s ease;
        border: 1px solid rgba(255,255,255,.15);
    }
    .wsb-btn:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow:
            0 18px 40px -10px rgba(99,102,241,.7),
            0 6px 18px -4px rgba(168,85,247,.5),
            inset 0 1px 0 rgba(255,255,255,.3);
    }
    .wsb-btn:active { transform: translateY(0) scale(.99); }
    .wsb-btn[disabled] { filter: saturate(.7) brightness(.9); cursor: wait; }

    .wsb-btn::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(110deg, transparent 30%, rgba(255,255,255,.45) 50%, transparent 70%);
        transform: translateX(-150%) skewX(-20deg);
        pointer-events: none;
    }
    .wsb-btn:hover::before { animation: wsb-shine 1s ease-out; }

    .wsb-btn svg { width: 1.15rem; height: 1.15rem; }
</style>

@php
    $isEdit = $this instanceof \Filament\Resources\Pages\EditRecord;
    $targetAction = $isEdit ? 'save' : 'create';
    $btnText = $isEdit ? __('Perbarui Aplikasi') : __('Buat Misi Sekarang');
    $loadingText = $isEdit ? __('Memperbarui Aplikasi...') : __('Memproses Pembayaran...');
@endphp

<div class="flex items-center justify-end w-full gap-3 mt-6">
    @if($isEdit)
        <div class="flex-1">
            <a href="{{ \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('index') }}"
               class="px-5 py-2.5 inline-flex rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-white/5 transition-colors">
                &larr; {{ __('Kembali') }}
            </a>
        </div>
    @endif

    <button
        type="submit"
        wire:loading.attr="disabled"
        wire:target="{{ $targetAction }}"
        class="wsb-btn"
    >
        <span wire:loading.remove wire:target="{{ $targetAction }}" class="inline-flex items-center gap-2">
            <x-heroicon-m-sparkles class="drop-shadow" />
            {{ $btnText }}
            <x-heroicon-m-arrow-right class="transition-transform duration-300 group-hover:translate-x-0.5" />
        </span>

        <span wire:loading wire:target="{{ $targetAction }}" class="inline-flex items-center gap-2">
            <svg class="animate-spin" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-opacity=".25" stroke-width="3"></circle>
                <path d="M22 12a10 10 0 0 1-10 10" stroke="currentColor" stroke-width="3" stroke-linecap="round"></path>
            </svg>
            {{ $loadingText }}
        </span>
    </button>
</div>
