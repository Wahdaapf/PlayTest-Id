<x-filament-panels::page>

    {{-- ================================================================
         VIEW 1: DAFTAR MISI
    ================================================================ --}}
    @if (! $showSubmitForm)
        <div class="space-y-6" style="font-family: 'Inter', sans-serif;">

            {{-- ── Stats Banner (Menyamai gaya Dashboard) ──────────────────────────────────── --}}
            <div class="relative overflow-hidden rounded-2xl p-6 text-white shadow-lg"
                 style="background:linear-gradient(135deg,#0ea5e9 0%,#06b6d4 40%,#2563eb 100%);
                        box-shadow:0 8px 32px rgba(14,165,233,0.25);">
                {{-- Dekorasi lingkaran --}}
                <div class="absolute -right-8 -top-8 h-40 w-40 rounded-full bg-white opacity-10"></div>
                <div class="absolute -right-2 bottom-0 h-24 w-24 rounded-full bg-white opacity-10"></div>
                <div class="absolute right-4 top-4 w-16 h-16 rounded-full bg-white opacity-5"></div>

                {{-- Konten --}}
                <div class="relative z-10">
                    <p class="mb-1 text-xs font-semibold uppercase tracking-widest text-sky-100" style="letter-spacing:0.12em;">
                        Misi Kamu
                    </p>
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <div class="flex items-baseline gap-2">
                                <span class="font-bold text-white" style="font-size:48px;line-height:1;font-family: 'JetBrains Mono', monospace;">{{ count($this->getMissionsData()) }}</span>
                            </div>
                            <p class="mt-1 text-sm font-medium text-sky-100">misi sedang berjalan</p>
                        </div>
                        @php $stats = $this->getStats(); @endphp
                        <div class="flex gap-4 sm:gap-8 border-t border-white/20 sm:border-none pt-4 sm:pt-0 mt-2 sm:mt-0">
                            <div class="text-center">
                                <p class="text-2xl font-bold font-mono">{{ $stats['selesai'] }}</p>
                                <p class="text-xs text-sky-100">Selesai</p>
                            </div>
                            <div class="hidden w-px bg-white/20 sm:block"></div>
                            <div class="text-center">
                                <p class="text-2xl font-bold font-mono">{{ $stats['aktif'] }}</p>
                                <p class="text-xs text-sky-100">Aktif</p>
                            </div>
                            <div class="hidden w-px bg-white/20 sm:block"></div>
                            <div class="text-center">
                                <p class="text-2xl font-bold font-mono">{{ $stats['pending'] >= 0 ? '+' : '' }}{{ $stats['pending'] }}</p>
                                <p class="text-xs text-sky-100">Pts Pending</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Judul Seksi ──────────────────────────────────── --}}
            <div>
                <h2 class="text-lg font-bold text-slate-800" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    Aplikasi yang Saya Submit
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">
                    {{ count($this->getMissionsData()) }} misi sedang berjalan
                </p>
            </div>

            {{-- ── Kartu Misi (Responsive Grid) ─────────────────── --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($this->getMissionsData() as $mission)
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 transition-all hover:-translate-y-1 hover:shadow-lg" style="box-shadow: 0 1px 3px rgba(0,0,0,0.05);">

                        {{-- Header kartu --}}
                        <div class="mb-4 flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                {{-- Avatar inisial --}}
                                <div
                                    class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl text-sm font-bold text-white shadow-sm"
                                    style="background-color: {{ $mission['color'] }}">
                                    {{ $mission['initials'] }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                                        {{ $mission['name'] }}
                                    </p>
                                    <p class="text-xs text-slate-500">
                                        {{ $mission['type'] }}
                                    </p>
                                </div>
                            </div>
                            {{-- Badge status --}}
                            <span class="rounded-lg bg-green-50 px-2 py-0.5 text-xs font-semibold text-green-600">
                                {{ $mission['status'] }}
                            </span>
                        </div>

                        {{-- Progress bar --}}
                        <div class="mb-4">
                            <div class="mb-1.5 flex items-center justify-between text-xs">
                                <span class="font-medium text-slate-500">
                                    <span class="font-bold text-slate-800" style="font-family: 'JetBrains Mono', monospace;">Day {{ $mission['day'] }}</span> of {{ $mission['total_days'] }}
                                </span>
                                <span class="font-semibold" style="font-family: 'JetBrains Mono', monospace; color: {{ $mission['color'] }}">{{ $mission['progress'] }}%</span>
                            </div>
                            <div class="h-1.5 w-full overflow-hidden rounded-full bg-slate-200">
                                <div
                                    class="h-1.5 rounded-full transition-all duration-500"
                                    style="width: {{ $mission['progress'] }}%; background-color: {{ $mission['color'] }}">
                                </div>
                            </div>
                        </div>

                        {{-- 14 Days History --}}
                        <div class="mb-5 border-t border-slate-100 pt-3">
                            <div class="flex justify-between items-center text-[10px] font-bold text-slate-400 mb-1.5 uppercase tracking-wider">
                                <span>Tracker 14 Hari</span>
                            </div>
                            <div class="flex gap-1">
                                @for ($h = 1; $h <= 14; $h++)
                                    @php
                                        $hist = $mission['days_history'][$h] ?? 'notdone';
                                        $isToday = ($h == $mission['day']);
                                        
                                        $cellClass = 'bg-slate-100 border border-transparent text-slate-400'; // Default / Future
                                        
                                        if ($hist === 'done') {
                                            $cellClass = 'bg-emerald-100 border border-emerald-200 text-emerald-600';
                                        } elseif ($hist === 'pending') {
                                            $cellClass = 'bg-amber-100 border border-amber-200 text-amber-600';
                                        } elseif ($hist === 'rejected') {
                                            $cellClass = 'bg-red-100 border border-red-200 text-red-600';
                                        } else {
                                            if ($h < $mission['day']) {
                                                // Missed
                                                $cellClass = 'bg-slate-50 border border-red-100 text-red-400 opacity-60';
                                            }
                                        }
                                        
                                        // Highlight today
                                        if ($isToday) {
                                            if ($hist === 'notdone') {
                                                $cellClass = 'bg-blue-500 border-blue-600 text-white shadow-sm ring-1 ring-blue-300 ring-offset-1';
                                            } else {
                                                $cellClass .= ' ring-1 ring-offset-1 ring-slate-300';
                                            }
                                        }
                                    @endphp
                                    <div class="flex-1 flex items-center justify-center rounded-[4px] h-5 text-[9px] font-bold transition-all {{ $cellClass }}" title="Hari {{ $h }}: {{ strtoupper($hist) }}">
                                        {{ $h }}
                                    </div>
                                @endfor
                            </div>
                        </div>

                        {{-- Footer: poin + tombol --}}
                        <div class="flex items-center justify-between mt-2">
                            <span class="flex items-center gap-1 text-xs font-semibold text-emerald-500">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                +{{ $mission['points'] }} pts
                            </span>
                            @if ($mission['today_status'] === 'done')
                                <button
                                    disabled
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-600 opacity-80 cursor-not-allowed">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Hari Ini Selesai
                                </button>
                            @elseif ($mission['today_status'] === 'pending')
                                <button
                                    disabled
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-600 opacity-80 cursor-not-allowed">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Menunggu ACC
                                </button>
                            @elseif ($mission['today_status'] === 'rejected')
                                <button
                                    wire:click="openSubmitForm({{ $mission['id'] }})"
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600 transition-colors hover:bg-red-100 disabled:opacity-60">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Upload Ulang (Ditolak)
                                </button>
                            @else
                                <button
                                    wire:click="openSubmitForm({{ $mission['id'] }})"
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 transition-colors hover:bg-slate-100 disabled:opacity-60">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Submit Task
                                </button>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>

        </div>

    {{-- ================================================================
         VIEW 2: FORM SUBMIT TASK (RESPONSIVE)
    ================================================================ --}}
    @else
        @php $mission = $this->getSelectedMission(); @endphp

        @if ($mission)
            <div class="mx-auto w-full max-w-5xl space-y-6" style="font-family: 'Inter', sans-serif;">

                {{-- ── Header dengan tombol kembali ────────────── --}}
                <div class="flex items-center gap-4 border-b border-slate-200 pb-4">
                    <button
                        wire:click="backToList"
                        class="rounded-xl border border-slate-200 bg-white p-2.5 text-slate-600 shadow-sm transition-colors hover:bg-slate-50 hover:text-slate-900">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-slate-800" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                            Submit Daily Task
                        </h1>
                        <p class="text-sm text-slate-500">Unggah bukti pengerjaan tugas hari ini.</p>
                    </div>
                </div>

                {{-- ── Layout Grid Responsive ───────────────────── --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                    
                    {{-- Kolom Kiri: Info & Instruksi --}}
                    <div class="lg:col-span-5 space-y-5">
                        {{-- Info Aplikasi --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <h3 class="mb-3 text-sm font-bold text-slate-800 uppercase tracking-wider">Detail Misi</h3>
                            <div class="flex items-center gap-4 rounded-xl bg-slate-50 p-4">
                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-xl text-lg font-bold text-white shadow-sm"
                                    style="background-color: {{ $mission['color'] }}">
                                    {{ $mission['initials'] }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-base">{{ $mission['name'] }}</p>
                                    <p class="text-sm font-medium text-slate-500 mt-0.5">Day {{ $mission['day'] }} of {{ $mission['total_days'] }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Instruksi --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <h3 class="mb-4 text-sm font-bold text-slate-800 uppercase tracking-wider">Instructions</h3>
                            <div class="space-y-4">
                                @foreach ([
                                    'Buka aplikasi dan mainkan selama 10–15 menit.',
                                    'Ambil screenshot layar yang menunjukkan aktivitasmu.',
                                    'Unggah screenshot di form yang disediakan.',
                                ] as $i => $instruction)
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-blue-50 text-xs font-bold text-blue-600">
                                            {{ $i + 1 }}
                                        </div>
                                        <p class="text-sm text-slate-600 leading-relaxed pt-0.5">
                                            {{ $instruction }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Area Upload --}}
                    <div class="lg:col-span-7 space-y-5">
                        
                        {{-- Peringatan Penting --}}
                        <div class="flex items-start gap-3 rounded-2xl border border-amber-200 bg-amber-50 p-4 shadow-sm">
                            <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="text-sm text-amber-700 leading-relaxed">
                                <span class="font-bold">Important:</span>
                                You must play the app for 10–15 minutes before capturing! Screenshots that don't meet the criteria will be rejected.
                            </p>
                        </div>

                        {{-- Area Upload Screenshot --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="mb-4 text-sm font-bold text-slate-800 uppercase tracking-wider">Upload Screenshot</h3>
                            
                            <label for="screenshot-upload" class="block cursor-pointer group">
                                <div
                                    class="rounded-2xl border-2 border-dashed {{ $screenshot ? 'p-4' : 'p-10' }} text-center transition-all duration-200
                                        {{ $screenshot
                                            ? 'border-emerald-300 bg-emerald-50'
                                            : 'border-slate-300 bg-slate-50 group-hover:border-blue-400 group-hover:bg-blue-50/50' }}">

                                    @if ($screenshot)
                                        {{-- State: sudah ada file (Preview) --}}
                                        <div class="flex flex-col items-center gap-4">
                                            <div class="relative group/preview w-full max-w-[240px] mx-auto">
                                                <img src="{{ $screenshot->temporaryUrl() }}" 
                                                     class="mx-auto max-h-48 rounded-xl shadow-lg border-4 border-white object-cover transition-transform group-hover/preview:scale-[1.02]">
                                                <div class="absolute inset-0 flex items-center justify-center bg-black/20 opacity-0 group-hover/preview:opacity-100 transition-opacity rounded-xl">
                                                     <span class="bg-white/90 text-slate-800 px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm">Ganti Gambar</span>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-base font-bold text-emerald-600">Screenshot siap dikirim!</p>
                                                <p class="text-sm text-emerald-500/80 mt-1">Klik area ini untuk mengganti file</p>
                                            </div>
                                        </div>
                                    @else
                                        {{-- State: belum ada file --}}
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white shadow-sm border border-slate-200 group-hover:bg-blue-100 group-hover:border-blue-200 transition-colors">
                                                <svg class="h-8 w-8 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-base font-bold text-slate-700 group-hover:text-blue-600">Tap to Upload Screenshot</p>
                                                <p class="text-sm text-slate-500 mt-1">PNG, JPG up to 10MB</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Input file tersembunyi --}}
                                <input
                                    id="screenshot-upload"
                                    type="file"
                                    class="hidden"
                                    wire:model="screenshot"
                                    accept="image/*" />
                            </label>

                            {{-- Pesan error validasi --}}
                            @error('screenshot')
                                <p class="mt-3 text-sm font-medium text-red-500 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror

                            {{-- Loading indicator saat upload --}}
                            <div wire:loading wire:target="screenshot" class="mt-3 flex items-center justify-center gap-2 text-sm font-medium text-blue-500">
                                <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                </svg>
                                Mengupload...
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="pt-2">
                            <button
                                wire:click="submitTask"
                                wire:loading.attr="disabled"
                                wire:loading.class="cursor-not-allowed opacity-70"
                                class="w-full rounded-2xl bg-blue-600 py-4 text-base font-bold text-white shadow-md shadow-blue-500/20 transition-all hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-500/30 active:translate-y-0.5">

                                <span wire:loading.remove wire:target="submitTask" class="flex justify-center items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Submit Task Sekarang
                                </span>

                                <span wire:loading wire:target="submitTask" class="flex items-center justify-center gap-2">
                                    <svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                    </svg>
                                    Submitting...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    @endif

</x-filament-panels::page>