<x-filament-panels::page>
@push('styles')
<style>
  .dev-panel{background:#fff;border:1px solid #f1f5f9;border-radius:16px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.05);}  
  .dev-panel-header{padding:20px 24px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}  
  .status-badge{display:inline-flex;align-items:center;gap:5px;font-size:10.5px;font-weight:700;letter-spacing:.04em;padding:3px 9px;border-radius:999px;}  
  .status-progress{background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;}  
  .status-pending{background:#fffbeb;color:#b45309;border:1px solid #fde68a;}  
  .status-selesai{background:#faf5ff;color:#7e22ce;border:1px solid #e9d5ff;}  
  .status-closed{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;}
  .app-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;flex-shrink:0;}  
  .icon-blue{background:#eff6ff;color:#2563eb;}  
  .icon-amber{background:#fffbeb;color:#d97706;}  
  .icon-purple{background:#faf5ff;color:#7e22ce;}  
  .icon-green{background:#f0fdf4;color:#16a34a;}  
  .day-cell{border-radius:5px;display:flex;align-items:flex-end;justify-content:center;padding-bottom:2px;height:32px;}  
  .day-done{background:#dbeafe;}.day-today{background:#2563eb;}.day-future{background:#f1f5f9;}.day-missed{background:#fee2e2;}  
  .day-pending{background:#fef08a;} .day-rejected{background:#fecaca;}
  .day-num{font-size:8px;font-weight:600;}  
  .day-done .day-num{color:#1d4ed8;}.day-today .day-num{color:#fff;font-weight:800;}.day-future .day-num{color:#94a3b8;}.day-missed .day-num{color:#ef4444;font-weight:800;}  
  .day-pending .day-num{color:#854d0e;} .day-rejected .day-num{color:#991b1b;}
</style>
@endpush

<div class="space-y-7 relative">
@if(!$isDetail)
  {{-- List of Missions View --}}
  <div>
    <h2 class="text-slate-800 font-bold text-lg mb-1">Pilih Kampanye</h2>
    <p class="text-slate-500 text-sm mb-6">Pilih aplikasi yang sedang "running" untuk memantau progress testernya.</p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($misiList as $m)
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between transition-all hover:shadow-md hover:border-blue-300">
          <div>
            <div class="flex justify-between items-start mb-4">
              <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl">
                 {{ strtoupper(substr($m->nama_aplikasi, 0, 1)) }}
              </div>
              <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full inline-block"></span> RUNNING
              </span>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">{{ $m->nama_aplikasi }}</h3>
            <p class="text-slate-500 text-sm mb-6 line-clamp-2">{{ $m->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
          </div>
          <button wire:click="$set('selectedMisiId', {{ $m->id }})" class="w-full bg-slate-50 hover:bg-slate-100 text-blue-600 font-semibold text-sm py-2.5 rounded-xl border border-slate-200 transition-colors flex items-center justify-center gap-2">
            Lihat Progress <x-heroicon-m-arrow-right class="w-4 h-4"/>
          </button>
        </div>
      @empty
        <div class="col-span-full bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm">
           <x-heroicon-o-rocket-launch class="w-12 h-12 mx-auto text-slate-300 mb-3"/>
           <h3 class="text-slate-700 font-bold mb-1">Belum Ada Kampanye Berjalan</h3>
           <p class="text-slate-500 text-sm">Anda belum memiliki aplikasi dengan status 'running'.</p>
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
        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
          <x-heroicon-o-bell-alert class="w-6 h-6 text-amber-500"/>
          Butuh Validasi ({{ count($pendingSubmissions) }})
        </h3>
        <div class="flex items-center gap-2">
            <button wire:click="rejectAllPending" class="text-sm font-semibold px-4 py-2 bg-red-50 text-red-600 border border-red-200 rounded-xl hover:bg-red-100 transition-colors">Tolak Semua</button>
            <button wire:click="acceptAllPending" class="text-sm font-semibold px-4 py-2 bg-blue-600 text-white rounded-xl shadow-sm hover:bg-blue-700 transition-colors">ACC Semua</button>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
      @foreach($pendingSubmissions as $p)
        <div class="bg-white border border-amber-200 rounded-2xl overflow-hidden shadow-sm flex flex-col hover:shadow-md transition-shadow">
          <div class="p-4 bg-amber-50/50 border-b border-amber-100 flex justify-between items-center">
             <div>
               <p class="font-bold text-slate-800 text-sm">{{ $p['tester_nama'] }}</p>
               <p class="text-xs text-slate-500 font-medium">Hari ke-{{ $p['hari_ke'] }} &bull; {{ $p['waktu'] }}</p>
             </div>
             <span class="bg-amber-100 text-amber-700 text-[10px] font-bold px-2 py-1 rounded-md">NEW</span>
          </div>
          <div class="p-0 flex justify-center bg-slate-100 border-b border-slate-100 overflow-hidden relative group" style="height: 140px;" wire:click="openValidationModal({{ $p['id'] }}, '{{ addslashes($p['tester_nama']) }}', {{ $p['hari_ke'] }})">
             <img src="{{ $p['image'] }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 cursor-pointer" alt="Bukti"/>
             <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/20 transition-colors cursor-pointer flex items-center justify-center">
               <x-heroicon-m-arrows-pointing-out class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" />
             </div>
          </div>
          <div class="p-4 flex gap-3">
             <button wire:click="rejectDirect({{ $p['id'] }})" class="flex-1 py-2 text-sm font-bold text-red-600 bg-red-50 border border-red-200 rounded-xl hover:bg-red-100 hover:border-red-300 transition-colors shadow-sm">Tolak</button>
             <button wire:click="acceptDirect({{ $p['id'] }})" class="flex-1 py-2 text-sm font-bold text-white bg-blue-600 border border-transparent rounded-xl hover:bg-blue-700 transition-colors shadow-sm">ACC</button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  @endif

  <div class="dev-panel">  
    <div class="dev-panel-header flex-col sm:flex-row items-start sm:items-center">  
      <div class="mb-4 sm:mb-0 w-full sm:w-auto">  
        <div class="flex items-center gap-3 mb-1">
          <button wire:click="$set('selectedMisiId', null)" class="text-slate-400 hover:text-slate-600 transition-colors bg-slate-100 hover:bg-slate-200 p-1.5 rounded-lg">
             <x-heroicon-m-arrow-left class="w-4 h-4"/>
          </button>
          <h2 class="text-slate-800 font-bold text-base">Progress Tester: {{ $misiDetail->nama_aplikasi }}</h2>  
        </div>
        <p class="text-slate-500 text-xs mt-0.5 ml-9">Klik kotak berwarna pada baris tester untuk meninjau screenshot.</p>  
      </div>  
      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full sm:w-auto">  
        <div class="flex flex-wrap items-center gap-3">  
          <span class="flex items-center gap-1.5 text-xs text-slate-500 whitespace-nowrap">  
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#fef08a;"></span>Perlu ACC  
          </span>  
          <span class="flex items-center gap-1.5 text-xs text-slate-500 whitespace-nowrap">  
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#dbeafe;"></span>Di-ACC  
          </span>  
          <span class="flex items-center gap-1.5 text-xs text-slate-500 whitespace-nowrap">  
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#fecaca;"></span>Ditolak  
          </span>  
          <span class="flex items-center gap-1.5 text-xs text-slate-500 whitespace-nowrap">  
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#2563eb;"></span>Hari Ini  
          </span>  
          <span class="flex items-center gap-1.5 text-xs text-slate-500 whitespace-nowrap">  
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#fee2e2;"></span>Terlewat  
          </span>  
        </div>

        {{-- Button Selesaikan Misi (Muncul di Hari 14 keatas ATAU jika sudah ada yang selesai 14 hari) --}}
        @if($hariToday >= 14 || $hasOneCompletedUser)
          <button type="button"
                  onclick="confirmFinishMission()"
                  class="bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs px-4 py-2 rounded-xl shadow-md transition-all flex items-center gap-2">
            <x-heroicon-m-flag class="w-4 h-4"/> Selesaikan Misi
          </button>
        @endif
      </div>  
    </div>  
    <div class="px-6 py-5 space-y-6">  
      @forelse ($kampanyeList as $idx => $k)  
        @if ($idx > 0)<hr style="border:none;border-top:1px solid #f1f5f9;">@endif  
        <div>  
          <div class="flex items-center justify-between mb-3">  
            <div class="flex items-center gap-3">  
              <div class="app-icon icon-{{ $k['warna'] }}">{{ $k['inisial'] }}</div>  
              <div>  
                <p class="text-slate-800 text-sm font-semibold">{{ $k['misi_nama'] }} <span class="text-slate-400 font-normal">| Tester: {{ $k['tester_nama'] }}</span></p>  
                <p class="text-slate-500" style="font-size:11px;">  
                  Hari ke-{{ $k['hariAktif'] }} dari 14
                </p>  
              </div>  
            </div>  
            <span class="status-badge status-{{ $k['status'] }}">  
              @if($k['status']==='progress')<span class="inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span> IN PROGRESS  
              @elseif($k['status']==='pending')<span class="inline-block w-1.5 h-1.5 bg-amber-500 rounded-full"></span> PENDING  
              @elseif($k['status']==='accepted')<span class="inline-block w-1.5 h-1.5 bg-blue-500 rounded-full"></span> ACCEPTED  
              @elseif($k['status']==='selesai')<x-heroicon-m-check class="w-2.5 h-2.5"/> COMPLETED 
              @else {{ strtoupper($k['status']) }} @endif  
            </span>  
          </div>  
          <div class="grid gap-1" style="grid-template-columns:repeat(14,1fr);">  
            @for ($h = 1; $h <= 14; $h++)  
              @php  
                $cls = 'day-future';  
                $dayData = $k['days'][$h] ?? ['status' => 'notdone'];
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
                        $cls = 'day-missed';
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
            <x-heroicon-o-users class="w-10 h-10 mx-auto text-slate-300 mb-2"/>
            <p class="text-slate-500 text-sm">Belum ada tester yang bergabung di kampanye Anda.</p>
        </div>
      @endforelse  
    </div>  
  </div>  

  {{-- Modal Validasi Screenshot --}}
  @if($selectedSubData)
  <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 backdrop-blur-sm" style="background: rgba(15,23,42,0.6);">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col transform transition-all">
      {{-- Modal Header --}}
      <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-white">
        <div>
          <h3 class="text-lg font-bold text-slate-800">Validasi Screenshot</h3>
          <p class="text-sm text-slate-500 font-medium mt-0.5">{{ $selectedSubData['tester_nama'] }} &bull; Hari ke-{{ $selectedSubData['hari_ke'] }}</p>
        </div>
        <button wire:click="closeValidationModal" class="p-2 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-xl transition-colors">
          <x-heroicon-m-x-mark class="w-6 h-6"/>
        </button>
      </div>

      {{-- Modal Body --}}
      <div class="p-5 bg-slate-50 overflow-y-auto max-h-[60vh] flex flex-col items-center">
        @if($selectedSubData['status'] === 'done')
          <div class="mb-3 w-full bg-green-50 border border-green-200 text-green-700 px-4 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2">
            <x-heroicon-m-check-circle class="w-5 h-5"/> Telah di-ACC
          </div>
        @elseif($selectedSubData['status'] === 'rejected')
          <div class="mb-3 w-full bg-red-50 border border-red-200 text-red-700 px-4 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2">
            <x-heroicon-m-x-circle class="w-5 h-5"/> Telah Ditolak
          </div>
        @endif

        <img src="{{ $selectedSubData['image'] }}" alt="Screenshot Hari ke-{{ $selectedSubData['hari_ke'] }}" class="max-w-full rounded-xl border border-slate-200 shadow-sm" />
      </div>

      {{-- Modal Footer --}}
      <div class="p-5 border-t border-slate-100 bg-white flex gap-3">
        <button wire:click="rejectSubmission" class="flex-1 py-3 rounded-xl border border-red-200 bg-red-50 text-red-600 font-bold hover:bg-red-100 hover:border-red-300 transition-colors">
          Tolak
        </button>
        <button wire:click="acceptSubmission" class="flex-1 py-3 rounded-xl border border-transparent bg-blue-600 text-white font-bold shadow-sm hover:bg-blue-700 hover:shadow transition-all">
          ACC (Setuju)
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
            title: 'Selesaikan Misi Sekarang?',
            html: `
                <div class="text-left text-sm space-y-2 px-2">
                    <p class="font-bold text-slate-700">Aturan yang akan dijalankan:</p>
                    <ul class="list-disc ml-5 space-y-1.5 text-slate-600">
                        <li>Semua tester <b>Aktif/Progress</b> otomatis menjadi <b>Selesai</b>.</li>
                        <li>Tugas yang masih <b>Pending</b> otomatis di-<b>ACC (Done)</b>.</li>
                        <li><b>Point Reward</b> & <b>Badge +1</b> langsung dikirim ke tester.</li>
                        <li>Status Kampanye ini akan resmi ditutup (<b>Selesai</b>).</li>
                    </ul>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#7e22ce',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Selesaikan!',
            cancelButtonText: 'Batal',
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
