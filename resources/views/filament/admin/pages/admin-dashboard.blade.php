<x-filament-panels::page>
    <div class="space-y-6">
        <div class="relative overflow-hidden rounded-3xl bg-[#1e293b] p-10 shadow-2xl ring-1 ring-white/10 group">
            <div class="absolute -right-20 -top-20 h-80 w-80 rounded-full bg-amber-500/10 blur-3xl transition-all duration-700 group-hover:bg-amber-500/20"></div>
            <div class="absolute -bottom-20 -left-20 h-80 w-80 rounded-full bg-orange-500/10 blur-3xl transition-all duration-700 group-hover:bg-orange-500/20"></div>

            <div class="relative flex flex-col md:flex-row items-center gap-8">
                <div class="flex-shrink-0">
                    <div class="relative">
                        <div class="absolute -inset-1 rounded-full bg-gradient-to-tr from-amber-500 to-orange-500 opacity-75 blur-sm animate-pulse"></div>
                        <img class="relative h-28 w-28 rounded-full border-2 border-white/20 object-cover shadow-xl" 
                             src="https://ui-avatars.com/api/?name=Admin&background=f59e0b&color=fff&size=200" 
                             alt="Admin Avatar">
                    </div>
                </div>

                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-3xl font-bold tracking-tight text-white mb-2">
                        Admin Command Center
                    </h1>
                    <p class="text-slate-400 text-lg max-w-xl">
                        Welcome to the administrative hub. All Tailwind 4 systems are nominal and ready for specialized dashboard construction.
                    </p>
                    
                    <div class="mt-6 flex flex-wrap gap-4 justify-center md:justify-start">
                        <div class="px-4 py-2 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 text-sm font-bold">
                            ADMIN PRIVILEGES ACTIVE
                        </div>
                        <div class="px-4 py-2 rounded-xl bg-slate-800 border border-white/5 text-slate-300 text-sm font-medium">
                             {{ now()->format('l, d F Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $metrics = [
                    ['label' => 'Total Users', 'value' => '8,241', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ['label' => 'Total Volume', 'value' => '$1.2M', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'Conversion', 'value' => '24.8%', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
                    ['label' => 'Active Now', 'value' => '412', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                ];
            @endphp

            @foreach($metrics as $metric)
                <div class="bg-[#1e293b] p-6 rounded-2xl ring-1 ring-white/10 hover:bg-slate-800 transition-all duration-300 shadow-xl group">
                    <div class="flex items-center gap-4">
                        <div class="p-3 rounded-xl bg-slate-800 text-amber-500 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $metric['icon'] }}" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500">{{ $metric['label'] }}</p>
                            <p class="text-2xl font-bold text-white tracking-tight">{{ $metric['value'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-filament-panels::page>
