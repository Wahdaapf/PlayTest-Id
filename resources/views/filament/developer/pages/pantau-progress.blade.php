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
  {{-- 14-Day Tracker --}}  
  <div class="dev-panel">  
    <div class="dev-panel-header flex-col sm:flex-row items-start sm:items-center">  
      <div class="mb-4 sm:mb-0 w-full sm:w-auto">  
        <h2 class="text-slate-800 font-bold text-base">Progress Tester</h2>  
        <p class="text-slate-500 text-xs mt-0.5">Pantau laporan harian dari masing-masing tester di kampanye Anda</p>  
      </div>  
      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full sm:w-auto">  
        <select wire:model.live="selectedMisiId" class="bg-white border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl focus:ring-blue-500 focus:border-blue-500 py-2 px-3 shadow-sm transition-all outline-none" style="min-width:180px;">
            <option value="">-- Semua Aplikasi --</option>
            @foreach($misiDropdown as $id => $nama)
                <option value="{{ $id }}">{{ $nama }}</option>
            @endforeach
        </select>
        
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
</div>
</x-filament-panels::page>
