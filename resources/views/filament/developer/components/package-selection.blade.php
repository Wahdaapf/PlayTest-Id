@php
    $pakets = \App\Models\Paket::all();
    $selectedId = $get('id_paket');
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-1">
    @foreach($pakets as $paket)
        @php
            $isSelected = $selectedId == $paket->id;
        @endphp
        <div x-on:click="$wire.set('data.id_paket', {{ $paket->id }})" class="group relative cursor-pointer rounded-2xl border transition-all duration-300 ease-out
                   hover:-translate-y-1.5 hover:shadow-xl active:scale-[0.98] flex flex-col h-full
                   {{ $isSelected
            ? 'border-red-500/60 shadow-lg shadow-red-100 ring-2 ring-red-500/20 bg-gradient-to-b from-red-50 to-white'
            : 'border-gray-400 bg-white hover:border-red-200 hover:shadow-red-50/80' }}">

            {{-- ── Glow layer saat selected ── --}}
            @if($isSelected)
                <div
                    class="absolute inset-0 rounded-2xl bg-gradient-to-br from-red-500/5 via-transparent to-orange-500/5 pointer-events-none">
                </div>
            @endif

            {{-- ── Badge Most Popular ── --}}
            @if($paket->most_popular)
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 z-10">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest text-white
                                         bg-gradient-to-r from-red-600 via-rose-500 to-orange-500
                                         shadow-md shadow-red-200 ring-2 ring-white">
                        <x-heroicon-m-fire class="w-3 h-3 animate-pulse" />
                        Most Popular
                    </span>
                </div>
            @endif

            {{-- ── Konten utama ── --}}
            <div class="p-6 flex-grow {{ $paket->most_popular ? 'pt-8' : '' }}">

                {{-- Baris atas: ikon + selection indicator --}}
                <div class="flex items-start justify-between mb-5">

                    {{-- Icon box --}}
                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-300
                                    {{ $isSelected
            ? 'bg-gradient-to-br from-red-500 to-orange-500 shadow-md shadow-red-200'
            : 'bg-gradient-to-br from-red-50 to-orange-50 group-hover:from-red-100 group-hover:to-orange-100' }}">
                            <x-heroicon-o-cube-transparent class="w-7 h-7 transition-colors duration-300
                                       {{ $isSelected ? 'text-white' : 'text-red-500' }}" />
                        </div>

                        {{-- Dot pulse saat selected --}}
                        @if($isSelected)
                            <span class="absolute -top-1 -right-1 flex h-3 w-3">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                            </span>
                        @endif
                    </div>

                    {{-- Selection indicator --}}
                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center flex-shrink-0 mt-0.5
                                transition-all duration-200
                                {{ $isSelected
            ? 'bg-red-600 border-red-600 shadow-sm shadow-red-300'
            : 'border-gray-200 bg-gray-50 group-hover:border-red-300' }}">
                        <x-heroicon-m-check class="w-3.5 h-3.5 stroke-[3] text-white transition-opacity duration-200
                                   {{ $isSelected ? 'opacity-100' : 'opacity-0' }}" />
                    </div>
                </div>

                {{-- Nama paket --}}
                <h3 class="text-lg font-black text-slate-900 tracking-tight transition-colors duration-200
                           {{ $isSelected ? 'text-red-700' : 'group-hover:text-red-700' }}">
                    {{ $paket->name ?? $paket->desc ?? "Paket #{ $paket->id}" }}
                </h3>

                {{-- Deskripsi --}}
                <p class="mt-1.5 text-sm text-slate-500 leading-relaxed line-clamp-2">
                    {{ $paket->desc ?? 'Ideal untuk testing aplikasi standar dengan hasil maksimal.' }}
                </p>

                {{-- Harga --}}
                <div class="mt-4 flex items-baseline gap-1">
                    <span class="text-3xl font-black tracking-tight
                                 {{ $isSelected ? 'text-red-600' : 'text-slate-900' }}">
                        Rp {{ number_format($paket->price, 0, ',', '.') }}
                    </span>
                    <span class="text-xs text-slate-400 font-medium">/project</span>
                </div>

                {{-- Divider --}}
                <div class="my-5 h-px {{ $isSelected ? 'bg-red-100' : 'bg-gray-100' }}"></div>

                {{-- Footer: reward + arrow --}}
                <div class="flex items-center justify-between">

                    {{-- Reward points badge --}}
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl
                                {{ $isSelected
            ? 'bg-emerald-100 text-emerald-700'
            : 'bg-gray-50 text-gray-500 group-hover:bg-emerald-50 group-hover:text-emerald-600' }}
                                transition-colors duration-200">
                        <x-heroicon-m-bolt class="w-3.5 h-3.5 flex-shrink-0" />
                        <span class="text-[11px] font-black uppercase tracking-tight">
                            +{{ $paket->point }} Points
                        </span>
                    </div>

                    {{-- Arrow pill --}}
                    <div class="flex items-center gap-0.5 px-2 py-1 rounded-lg
                                {{ $isSelected
            ? 'text-red-500 bg-red-50'
            : 'text-gray-300 group-hover:text-red-400 group-hover:bg-red-50' }}
                                transition-all duration-200">
                        <span
                            class="text-[10px] font-bold {{ $isSelected ? 'text-red-500' : 'text-gray-400 group-hover:text-red-400' }}">
                            {{ $isSelected ? 'Dipilih' : 'Pilih' }}
                        </span>
                        <x-heroicon-m-chevron-right
                            class="w-3.5 h-3.5 {{ $isSelected ? '-rotate-90' : '' }} transition-transform duration-200" />
                    </div>
                </div>

            </div>

            {{-- ── Bottom accent bar saat selected ── --}}
            <div class="h-1 w-full rounded-b-2xl transition-all duration-300
                        {{ $isSelected
            ? 'bg-gradient-to-r from-red-500 via-rose-500 to-orange-400'
            : 'bg-transparent group-hover:bg-gradient-to-r group-hover:from-red-200 group-hover:to-orange-200' }}">
            </div>

        </div>
    @endforeach
</div>