<x-filament-panels::page>
  @push('styles')
  <style>
    .dev-panel {
      background: #fff;
      border: 1px solid #f1f5f9;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
    }
    .dark .dev-panel { background: #1e293b; border-color: #334155; }

    .dev-panel-header {
      padding: 20px 24px;
      border-bottom: 1px solid #f1f5f9;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .dark .dev-panel-header { border-color: #334155; }

    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 10.5px;
      font-weight: 700;
      letter-spacing: .04em;
      padding: 3px 9px;
      border-radius: 999px;
    }

    .status-progress { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .dark .status-progress { background: rgba(21,128,61,0.15); color: #86efac; border-color: rgba(74,222,128,0.2); }

    .status-pending { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .dark .status-pending { background: rgba(180,83,9,0.15); color: #fde047; border-color: rgba(250,204,21,0.2); }

    .status-selesai { background: #faf5ff; color: #7e22ce; border: 1px solid #e9d5ff; }
    .dark .status-selesai { background: rgba(126,34,206,0.15); color: #d8b4fe; border-color: rgba(192,132,252,0.2); }

    .status-closed { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
    .dark .status-closed { background: rgba(185,28,28,0.15); color: #fca5a5; border-color: rgba(248,113,113,0.2); }

    .status-failed { background: #fef2f2; color: #dc2626; border: 1px solid #fca5a5; }
    .dark .status-failed { background: rgba(220,38,38,0.15); color: #fca5a5; border-color: rgba(248,113,113,0.2); }

    .app-icon {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 800;
      flex-shrink: 0;
    }

    .icon-blue { background: #eff6ff; color: #2563eb; }
    .dark .icon-blue { background: rgba(37,99,235,0.2); color: #93c5fd; }

    .icon-amber { background: #fffbeb; color: #d97706; }
    .dark .icon-amber { background: rgba(217,119,6,0.2); color: #fcd34d; }

    .icon-purple { background: #faf5ff; color: #7e22ce; }
    .dark .icon-purple { background: rgba(126,34,206,0.2); color: #d8b4fe; }

    .icon-green { background: #f0fdf4; color: #16a34a; }
    .dark .icon-green { background: rgba(22,163,74,0.2); color: #86efac; }

    .day-cell {
      border-radius: 5px;
      display: flex;
      align-items: flex-end;
      justify-content: center;
      padding-bottom: 2px;
      height: 32px;
    }

    .day-done { background: #dbeafe; }
    .dark .day-done { background: rgba(37,99,235,0.2); }

    .day-today { background: #2563eb; }

    .day-future { background: #f1f5f9; }
    .dark .day-future { background: #334155; }

    .day-missed { background: #fee2e2; }
    .dark .day-missed { background: rgba(239,68,68,0.2); }

    .day-pending { background: #fef08a; }
    .dark .day-pending { background: rgba(234,179,8,0.2); }

    .day-rejected { background: #fecaca; }
    .dark .day-rejected { background: rgba(220,38,38,0.2); }

    .day-num { font-size: 8px; font-weight: 600; }

    .day-done .day-num { color: #1d4ed8; }
    .dark .day-done .day-num { color: #93c5fd; }

    .day-today .day-num { color: #fff; font-weight: 800; }

    .day-future .day-num { color: #94a3b8; }
    .dark .day-future .day-num { color: #64748b; }

    .day-missed .day-num { color: #ef4444; font-weight: 800; }
    .dark .day-missed .day-num { color: #fca5a5; }

    .day-pending .day-num { color: #854d0e; }
    .dark .day-pending .day-num { color: #fde047; }

    .day-rejected .day-num { color: #991b1b; }
    .dark .day-rejected .day-num { color: #fca5a5; }
  </style>
  @endpush

  <div class="space-y-7 relative">
    @if(!$isDetail)
    {{-- List of Missions View --}}
    <div>
      <h2 class="text-slate-800 dark:text-white font-bold text-lg mb-1">{{ __('Pilih Kampanye') }}</h2>
      <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">{{ __('Pilih aplikasi yang sedang "berjalan" untuk memantau progres testernya.') }}</p>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($misiList as $m)
        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 shadow-sm flex flex-col justify-between transition-all hover:shadow-md hover:border-blue-300 dark:hover:border-blue-700">
          <div>
            <div class="flex justify-between items-start mb-4">
              @if($m->logo)
              <img src="/storage/{{ $m->logo }}" alt="Logo" class="w-12 h-12 rounded-xl object-cover shadow-sm">
              @else
              <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xl">
                {{ strtoupper(substr($m->nama_aplikasi, 0, 1)) }}
              </div>
              @endif
              <span class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full inline-block"></span> {{ __('BERJALAN') }}
              </span>
            </div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-1">{{ $m->nama_aplikasi }}</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-6 line-clamp-2">{{ $m->deskripsi ?? __('Tidak ada deskripsi.') }}</p>
          </div>
          <button wire:click="$set('selectedMisiId', {{ $m->id }})" class="w-full bg-slate-50 dark:bg-slate-900/50 hover:bg-slate-100 dark:hover:bg-slate-800 text-blue-600 dark:text-blue-400 font-semibold text-sm py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 transition-colors flex items-center justify-center gap-2">
            {{ __('Lihat Progres') }} <x-heroicon-m-arrow-right class="w-4 h-4" />
          </button>
        </div>
        @empty
        <div class="col-span-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-10 text-center shadow-sm">
          <x-heroicon-o-rocket-launch class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600 mb-3" />
          <h3 class="text-slate-700 dark:text-slate-300 font-bold mb-1">{{ __('Belum Ada Kampanye Berjalan') }}</h3>
          <p class="text-slate-500 dark:text-slate-400 text-sm">{{ __('Anda belum memiliki aplikasi dengan status \'berjalan\'.') }}</p>
        </div>
        @endforelse
      </div>
    </div>
    @else
    {{-- Detail Progress View --}}

    {{-- BAGIAN TUGAS PERLU VALIDASI --}}
    @if(count($pendingSubmissions) > 0)
    <div class="mb-6">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-3">
        <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
          <x-heroicon-o-bell-alert class="w-6 h-6 text-amber-500" />
          {{ __('Butuh Validasi') }} ({{ count($pendingSubmissions) }})
        </h3>
        <div class="flex items-center gap-2">
          <button wire:click="rejectAllPending" class="text-sm font-semibold px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900/30 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors">{{ __('Tolak Semua') }}</button>
          <button wire:click="acceptAllPending" class="text-sm font-semibold px-4 py-2 bg-blue-600 text-white rounded-xl shadow-sm hover:bg-blue-700 transition-colors">{{ __('Setujui Semua') }}</button>
        </div>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach($pendingSubmissions as $p)
        <div class="bg-white dark:bg-slate-800 border border-amber-200 dark:border-amber-700/50 rounded-2xl overflow-hidden shadow-sm flex flex-col hover:shadow-md transition-shadow">
          <div class="p-4 bg-amber-50/50 dark:bg-amber-900/10 border-b border-amber-100 dark:border-amber-700/30 flex justify-between items-center">
            <div>
              <p class="font-bold text-slate-800 dark:text-white text-sm">{{ $p['tester_nama'] }}</p>
              <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ __('Hari ke-:aktif', ['aktif' => $p['hari_ke']]) }} &bull; {{ $p['waktu'] }}</p>
            </div>
            <span class="bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-400 text-[10px] font-bold px-2 py-1 rounded-md">{{ __('BARU') }}</span>
          </div>
          <div class="p-0 flex justify-center bg-slate-100 dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800 overflow-hidden relative group" style="height: 140px;" wire:click="openValidationModal({{ $p['id'] }}, '{{ addslashes($p['tester_nama']) }}', {{ $p['hari_ke'] }})">
            <img src="{{ $p['image'] }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 cursor-pointer" alt="Bukti" />
            <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/20 transition-colors cursor-pointer flex items-center justify-center">
              <x-heroicon-m-arrows-pointing-out class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" />
            </div>
          </div>
          <div class="p-4 flex gap-3">
            <button wire:click="rejectDirect({{ $p['id'] }})" class="flex-1 py-2 text-sm font-bold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900/30 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/40 hover:border-red-300 dark:hover:border-red-800 transition-colors shadow-sm">{{ __('Tolak') }}</button>
            <button wire:click="acceptDirect({{ $p['id'] }})" class="flex-1 py-2 text-sm font-bold text-white bg-blue-600 border border-transparent rounded-xl hover:bg-blue-700 transition-colors shadow-sm">{{ __('Setujui') }}</button>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif

    <div class="dev-panel overflow-x-auto">
      <div class="dev-panel-header flex-col sm:flex-row items-start sm:items-center">
        <div class="mb-4 sm:mb-0 w-full sm:w-auto">
          <div class="flex items-center gap-3 mb-1">
            <button wire:click="$set('selectedMisiId', null)" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 p-1.5 rounded-lg">
              <x-heroicon-m-arrow-left class="w-4 h-4" />
            </button>
            <h2 class="text-slate-800 dark:text-white font-bold text-base">{{ __('Progres Tester:') }} {{ $misiDetail->nama_aplikasi }}</h2>
          </div>
          <p class="text-slate-500 dark:text-slate-400 text-xs mt-0.5 ml-9">{{ __('Klik kotak berwarna pada baris tester untuk meninjau screenshot.') }}</p>
        </div>
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full sm:w-auto">
          <div class="flex flex-wrap items-center gap-3">
            <span class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400 whitespace-nowrap">
              <span class="inline-block w-2.5 h-2.5 rounded-sm day-pending"></span>{{ __('Perlu Validasi') }}
            </span>
            <span class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400 whitespace-nowrap">
              <span class="inline-block w-2.5 h-2.5 rounded-sm day-done"></span>{{ __('Disetujui') }}
            </span>
            <span class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400 whitespace-nowrap">
              <span class="inline-block w-2.5 h-2.5 rounded-sm day-rejected"></span>{{ __('Ditolak') }}
            </span>
            <span class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400 whitespace-nowrap">
              <span class="inline-block w-2.5 h-2.5 rounded-sm day-today"></span>{{ __('Hari Ini') }}
            </span>
            <span class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400 whitespace-nowrap">
              <span class="inline-block w-2.5 h-2.5 rounded-sm day-missed"></span>{{ __('Terlewat') }}
            </span>
          </div>

          {{-- Button Selesaikan Misi (Muncul di Hari 14 keatas ATAU jika sudah ada yang selesai 14 hari) --}}
          @if($hariToday >= 14 || $hasOneCompletedUser)
          <button type="button"
            onclick="confirmFinishMission()"
            class="bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs px-4 py-2 rounded-xl shadow-md transition-all flex items-center gap-2">
            <x-heroicon-m-flag class="w-4 h-4" /> {{ __('Selesaikan Misi') }}
          </button>
          @endif
        </div>
      </div>
      <div class="px-6 py-5 space-y-6 min-w-[700px]">
        @forelse ($kampanyeList as $idx => $k)
        @if ($idx > 0)
        <hr class="border-t border-slate-100 dark:border-slate-800" style="border-bottom:none;border-left:none;border-right:none;">@endif
        <div>
          <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-3">
              @if($k['logo'])
              <img src="/storage/{{ $k['logo'] }}" alt="Logo" class="w-9 h-9 rounded-xl object-cover flex-shrink-0">
              @else
              <div class="app-icon icon-{{ $k['warna'] }}">{{ $k['inisial'] }}</div>
              @endif
              <div>
                <p class="text-slate-800 dark:text-white text-sm font-semibold">{{ $k['misi_nama'] }} <span class="text-slate-400 font-normal">| Tester: {{ $k['tester_nama'] }}</span></p>
                <p class="text-slate-500 dark:text-slate-400" style="font-size:11px;">
                  {{ __('Hari ke-:aktif dari 14', ['aktif' => $k['hariAktif']]) }}
                </p>
              </div>
            </div>
            <span class="status-badge status-{{ $k['status'] }}">
              @if($k['status']==='progress')<span class="inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span> {{ __('DIPROSES') }}
              @elseif($k['status']==='pending')<span class="inline-block w-1.5 h-1.5 bg-amber-500 rounded-full"></span> {{ __('PENDING') }}
              @elseif($k['status']==='accepted')<span class="inline-block w-1.5 h-1.5 bg-blue-500 rounded-full"></span> {{ __('DITERIMA') }}
              @elseif($k['status']==='selesai')<x-heroicon-m-check class="w-2.5 h-2.5" /> {{ __('SELESAI') }}
              @elseif($k['status']==='failed')<x-heroicon-m-x-mark class="w-2.5 h-2.5" /> {{ __('GAGAL') }}
              @else {{ strtoupper($k['status']) }} @endif
            </span>
          </div>
          <div class="grid gap-1" style="grid-template-columns:repeat(14,1fr);">
            @for ($h = 1; $h <= 14; $h++)
              @php
              $cls='day-future' ;
              $dayData=$k['days'][$h] ?? ['status'=> 'notdone'];
              $statusDay = $dayData['status'];
              $subId = $dayData['sub_id'] ?? null;
              $testerNama = addslashes($k['tester_nama']);

              if ($statusDay !== 'notdone') {
              if ($statusDay === 'pending') {
              $cls = 'day-pending cursor-pointer hover:ring-2 hover:ring-amber-300 transition-all';
              } elseif ($statusDay === 'rejected') {
              $cls = 'day-rejected cursor-pointer hover:ring-2 hover:ring-red-300 transition-all';
              } else {
              $cls = 'day-done cursor-pointer hover:ring-2 hover:ring-blue-300 transition-all';
              }
              } else {
              if ($h == $k['hariAktif']) {
              $cls = 'day-today';
              } elseif ($h < $k['hariAktif']) {
                $cls='day-missed' ;
                }
                }
                @endphp
                <div class="day-cell {{ $cls }}"
                @if($subId) wire:click="openValidationModal({{ $subId }}, '{{ $testerNama }}', {{ $h }})" @endif>
                <span class="day-num">{{ $h }}</span>
          </div>
          @endfor
        </div>
      </div>
      @empty
      <div class="text-center py-8">
        <x-heroicon-o-users class="w-10 h-10 mx-auto text-slate-300 mb-2" />
        <p class="text-slate-500 text-sm">{{ __('Belum ada tester yang bergabung di kampanye Anda.') }}</p>
      </div>
      @endforelse
    </div>
  </div>

  {{-- Modal Validasi Screenshot --}}
  @if($selectedSubData)
  <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 backdrop-blur-sm" style="background: rgba(15,23,42,0.6);">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col transform transition-all">
      {{-- Modal Header --}}
      <div class="p-5 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-white dark:bg-slate-800">
        <div>
          <h3 class="text-lg font-bold text-slate-800 dark:text-white">{{ __('Validasi Screenshot') }}</h3>
          <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mt-0.5">{{ $selectedSubData['tester_nama'] }} &bull; {{ __('Hari ke-:aktif', ['aktif' => $selectedSubData['hari_ke']]) }}</p>
        </div>
        <button wire:click="closeValidationModal" class="p-2 text-slate-400 hover:text-slate-700 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-colors">
          <x-heroicon-m-x-mark class="w-6 h-6" />
        </button>
      </div>

      {{-- Modal Body --}}
      <div class="p-5 bg-slate-50 dark:bg-slate-900/50 overflow-y-auto max-h-[60vh] flex flex-col items-center">
        @if($selectedSubData['status'] === 'done')
        <div class="mb-3 w-full bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900 text-green-700 dark:text-green-400 px-4 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2">
          <x-heroicon-m-check-circle class="w-5 h-5" /> {{ __('Telah Disetujui') }}
        </div>
        @elseif($selectedSubData['status'] === 'rejected')
        <div class="mb-3 w-full bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900 text-red-700 dark:text-red-400 px-4 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2">
          <x-heroicon-m-x-circle class="w-5 h-5" /> {{ __('Telah Ditolak') }}
        </div>
        @endif

        <img src="{{ $selectedSubData['image'] }}" alt="Screenshot Hari ke-{{ $selectedSubData['hari_ke'] }}" class="max-w-full rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm" />
      </div>

      {{-- Modal Footer --}}
      <div class="p-5 border-t border-slate-100 dark:border-slate-700 bg-white dark:bg-slate-800 flex gap-3">
        <button wire:click="rejectSubmission" class="flex-1 py-3 rounded-xl border border-red-200 dark:border-red-900/50 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-bold hover:bg-red-100 dark:hover:bg-red-900/40 hover:border-red-300 dark:hover:border-red-800 transition-colors">
          {{ __('Tolak') }}
        </button>
        <button wire:click="acceptSubmission" class="flex-1 py-3 rounded-xl border border-transparent bg-blue-600 text-white font-bold shadow-sm hover:bg-blue-700 hover:shadow transition-all">
          {{ __('Setujui') }}
        </button>
      </div>
    </div>
  </div>
  @endif

  @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmFinishMission() {
      Swal.fire({
        title: '{!! __('Selesaikan Misi Sekarang?') !!}',
        html: `
                <div class="text-left text-sm space-y-2 px-2">
                    <p class="font-bold text-slate-700">{!! __('Aturan yang akan dijalankan:') !!}</p>
                    <ul class="list-disc ml-5 space-y-1.5 text-slate-600">
                        <li>{!! __('Semua tester <b>Aktif/Progress</b> otomatis menjadi <b>Selesai</b>.') !!}</li>
                        <li>{!! __('Tugas yang masih <b>Pending</b> otomatis di-<b>ACC (Done)</b>.') !!}</li>
                        <li>{!! __('<b>Point Reward</b> & <b>Badge +1</b> langsung dikirim ke tester.') !!}</li>
                        <li>{!! __('Status Kampanye ini akan resmi ditutup (<b>Selesai</b>).') !!}</li>
                    </ul>
                </div>
            `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#7e22ce',
        cancelButtonColor: '#64748b',
        confirmButtonText: '{!! __('Ya, Selesaikan!') !!}',
        cancelButtonText: '{!! __('Batal') !!}',
        padding: '2em',
        borderRadius: '1.5rem',
      }).then((result) => {
        if (result.isConfirmed) {
          @this.finishMission();
        }
      })
    }
  </script>
</x-filament-panels::page>