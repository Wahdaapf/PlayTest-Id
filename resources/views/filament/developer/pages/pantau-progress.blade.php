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
  .day-done{background:#dbeafe;}.day-today{background:#2563eb;}.day-future{background:#f1f5f9;}  
  .day-num{font-size:8px;font-weight:600;}  
  .day-done .day-num{color:#1d4ed8;}.day-today .day-num{color:#fff;font-weight:800;}.day-future .day-num{color:#94a3b8;}  
</style>
@endpush

<div class="space-y-7">
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
  <div class="dev-panel">  
    <div class="dev-panel-header flex-col sm:flex-row items-start sm:items-center">  
      <div class="mb-4 sm:mb-0 w-full sm:w-auto">  
        <div class="flex items-center gap-3 mb-1">
          <button wire:click="$set('selectedMisiId', null)" class="text-slate-400 hover:text-slate-600 transition-colors bg-slate-100 hover:bg-slate-200 p-1.5 rounded-lg">
             <x-heroicon-m-arrow-left class="w-4 h-4"/>
          </button>
          <h2 class="text-slate-800 font-bold text-base">Progress Tester: {{ $misiDetail->nama_aplikasi }}</h2>  
        </div>
        <p class="text-slate-500 text-xs mt-0.5 ml-9">Pantau laporan harian dari masing-masing tester di kampanye ini</p>  
      </div>  
      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full sm:w-auto">  
        <div class="flex items-center gap-3">  
          <span class="flex items-center gap-1.5 text-xs text-slate-500 whitespace-nowrap">  
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#dbeafe;"></span>Sudah Dilaporkan  
          </span>  
          <span class="flex items-center gap-1.5 text-xs text-slate-500 whitespace-nowrap">  
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#2563eb;"></span>Hari Ini  
          </span>  
          <span class="flex items-center gap-1.5 text-xs text-slate-500 whitespace-nowrap">  
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#f1f5f9;"></span>Belum/Mendatang  
          </span>  
        </div>
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
                $statusDay = $k['days'][$h] ?? 'notdone';
                if ($statusDay !== 'notdone') {
                    $cls = 'day-done';
                } else {
                    if ($h == $k['hariAktif']) {
                        $cls = 'day-today';
                    }
                }
              @endphp  
              <div class="day-cell {{ $cls }}"><span class="day-num">{{ $h }}</span></div>  
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
@endif
</div>
</x-filament-panels::page>
