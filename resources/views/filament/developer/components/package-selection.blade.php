@php
    $pakets = \App\Models\Paket::where('aktif', true)->get();
    
    // Sesuaikan grid berdasarkan jumlah paket agar tidak ada spasi kosong
    $count = $pakets->count();
    $gridClass = 'md:grid-cols-3';
    if ($count === 1) {
        $gridClass = 'md:grid-cols-1 max-w-md mx-auto';
    } elseif ($count === 2) {
        $gridClass = 'md:grid-cols-2 max-w-3xl mx-auto';
    }
@endphp

<div x-data="{ selectedId: @entangle('data.id_paket') }" class="grid grid-cols-1 sm:grid-cols-2 {{ $gridClass }} gap-4 sm:gap-6 p-2 pt-6 w-full">
    @foreach($pakets as $paket)
        @php $id = $paket->id; @endphp
        
        <div 
            x-on:click="selectedId = {{ $id }}" 
            class="group relative cursor-pointer rounded-2xl border-2 transition-all duration-300 ease-out flex flex-col h-full overflow-visible"
            :class="selectedId == {{ $id }} 
                ? 'border-red-500 bg-red-50 dark:bg-[#2a171c] scale-105 z-10 shadow-[0_8px_30px_rgb(239,68,68,0.15)] dark:shadow-[0_8px_30px_rgb(239,68,68,0.08)] ring-4 ring-red-500/10 dark:ring-red-500/20' 
                : 'border-slate-200 dark:border-white/10 bg-white dark:bg-white/5 hover:border-red-300 dark:hover:border-red-500/50 hover:shadow-lg hover:-translate-y-1'"
        >
            {{-- ── Glow layer saat selected ── --}}
            <div 
                x-show="selectedId == {{ $id }}"
                x-transition.opacity.duration.500ms
                class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-transparent pointer-events-none rounded-2xl"
            ></div>

            {{-- ── Badge Most Popular (Pill Style) ── --}}
            @if($paket->most_popular)
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-20">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest text-white bg-gradient-to-r from-red-600 to-orange-500 shadow-md ring-4 ring-white dark:ring-gray-900 transition-all duration-300"
                          :class="selectedId == {{ $id }} ? 'dark:ring-[#2a171c]' : ''">
                        <x-heroicon-m-fire class="w-3.5 h-3.5" />
                        {{ __('Popular') }}
                    </span>
                </div>
            @endif

            {{-- ── Konten utama ── --}}
            <div class="p-3 sm:p-6 flex-grow flex flex-col relative z-20">

                {{-- Baris atas: ikon + selection indicator --}}
                <div class="flex items-start justify-between mb-3 sm:mb-6">
                    {{-- Icon box --}}
                    <div class="relative">
                        <div 
                            class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl flex items-center justify-center transition-all duration-500"
                            :class="selectedId == {{ $id }} 
                                ? 'bg-gradient-to-br from-red-500 to-orange-500 shadow-lg shadow-red-500/30 rotate-3' 
                                : 'bg-slate-50 dark:bg-white/5 group-hover:bg-red-50 dark:group-hover:bg-red-500/10 group-hover:rotate-3'"
                        >
                            <x-heroicon-o-cube-transparent 
                                class="w-5 h-5 sm:w-7 sm:h-7 transition-colors duration-300"
                                x-bind:class="selectedId == {{ $id }} ? 'text-white' : 'text-slate-400 dark:text-gray-400 group-hover:text-red-500 dark:group-hover:text-red-400'" 
                            />
                        </div>
                    </div>

                    {{-- Selection indicator (Checklist) --}}
                    <div 
                        class="w-7 h-7 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all duration-300"
                        :class="selectedId == {{ $id }} 
                            ? 'bg-red-500 border-red-500 shadow-md' 
                            : 'border-slate-200 dark:border-gray-600 bg-slate-50 dark:bg-gray-800 group-hover:border-red-300 dark:group-hover:border-red-500/50'"
                    >
                        <x-heroicon-m-check 
                            class="w-4 h-4 stroke-[3] text-white transition-transform duration-300" 
                            x-bind:class="selectedId == {{ $id }} ? 'scale-100 opacity-100' : 'scale-0 opacity-0'"
                        />
                    </div>
                </div>

                {{-- Nama paket --}}
                <h3 
                    class="text-sm sm:text-xl font-black tracking-tight transition-colors duration-200"
                    :class="selectedId == {{ $id }} ? 'text-red-600 dark:text-red-400' : 'text-slate-800 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400'"
                >
                    {{ $paket->name ?? $paket->desc ?? __('Paket') . " #{$id}" }}
                </h3>

                {{-- Deskripsi --}}
                <p class="mt-1 text-xs sm:text-sm leading-relaxed line-clamp-2 transition-colors duration-200"
                   :class="selectedId == {{ $id }} ? 'text-slate-600 dark:text-gray-300' : 'text-slate-500 dark:text-gray-400'">
                    {{ $paket->short_desc ?? strip_tags($paket->desc) ?? __('Ideal untuk testing aplikasi standar dengan hasil maksimal.') }}
                </p>

                <div class="mt-auto pt-3 sm:pt-6">
                    {{-- Harga --}}
                    <div class="flex items-baseline gap-1.5 mb-4">
                        <span 
                            class="text-lg sm:text-3xl font-black tracking-tighter transition-colors duration-200"
                            :class="selectedId == {{ $id }} ? 'text-slate-900 dark:text-white' : 'text-slate-800 dark:text-gray-200'"
                        >
                            Rp {{ number_format($paket->price, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- Footer: reward --}}
                    <div class="flex items-center justify-between p-3 rounded-xl transition-colors duration-300"
                         :class="selectedId == {{ $id }} ? 'bg-red-100/50 dark:bg-red-500/20' : 'bg-slate-50 dark:bg-white/5 group-hover:bg-red-50/50 dark:group-hover:bg-red-500/10'">
                        <div class="flex items-center gap-2">
                            <div class="p-1.5 bg-emerald-100 dark:bg-emerald-500/20 rounded-lg">
                                <x-heroicon-m-bolt class="w-4 h-4 text-emerald-600 dark:text-emerald-400" />
                            </div>
                            <span class="text-xs font-bold transition-colors duration-200"
                                  :class="selectedId == {{ $id }} ? 'text-slate-700 dark:text-emerald-50' : 'text-slate-700 dark:text-gray-300'">
                                +{{ $paket->point }} Points
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Bottom accent bar saat selected ── --}}
            <div 
                class="absolute bottom-0 inset-x-0 h-1.5 transition-all duration-500 rounded-b-2xl overflow-hidden"
                :class="selectedId == {{ $id }} ? 'bg-gradient-to-r from-red-500 to-orange-500' : 'bg-transparent'"
            ></div>
        </div>
    @endforeach
</div>