<x-filament-panels::page>  
  
@push('styles')  
<style>  
  .dev-stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:16px;padding:24px;transition:transform .25s,box-shadow .25s;}  
  .dev-stat-card:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(0,0,0,.08);}  
  .dev-panel{background:#fff;border:1px solid #f1f5f9;border-radius:16px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.05);}  
  .dev-panel-header{padding:20px 24px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}  
  .prog-track{width:100%;height:5px;background:#f1f5f9;border-radius:999px;overflow:hidden;}  
  .prog-fill{height:100%;border-radius:999px;width:0;}  
  .status-badge{display:inline-flex;align-items:center;gap:5px;font-size:10.5px;font-weight:700;letter-spacing:.04em;padding:3px 9px;border-radius:999px;}  
  .status-progress{background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;}  
  .status-pending{background:#fffbeb;color:#b45309;border:1px solid #fde68a;}  
  .status-selesai{background:#faf5ff;color:#7e22ce;border:1px solid #e9d5ff;}  
  .app-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;flex-shrink:0;}  
  .icon-blue{background:#eff6ff;color:#2563eb;}  
  .icon-amber{background:#fffbeb;color:#d97706;}  
  .icon-purple{background:#faf5ff;color:#7e22ce;}  
  .btn-detail{display:inline-flex;align-items:center;gap:5px;padding:5px 12px;font-size:12px;font-weight:600;color:#64748b;border:1px solid #e2e8f0;border-radius:8px;background:transparent;cursor:pointer;transition:all .15s;}  
  .btn-detail:hover{background:#eff6ff;border-color:#bfdbfe;color:#2563eb;}  
  .day-cell{border-radius:5px;display:flex;align-items:flex-end;justify-content:center;padding-bottom:2px;height:32px;}  
  .day-done{background:#dbeafe;}.day-today{background:#2563eb;}.day-future{background:#f1f5f9;}  
  .day-num{font-size:8px;font-weight:600;}  
  .day-done .day-num{color:#1d4ed8;}.day-today .day-num{color:#fff;font-weight:800;}.day-future .day-num{color:#94a3b8;}  
  .tbl-row{transition:background .15s;}.tbl-row:hover td{background:#f8fafc;}  
  .modal-overlay{position:fixed;inset:0;z-index:60;display:flex;align-items:center;justify-content:center;padding:16px;}  
  .modal-backdrop{position:absolute;inset:0;background:rgba(15,23,42,.5);backdrop-filter:blur(4px);}  
  .modal-box{position:relative;z-index:1;background:#fff;border-radius:20px;width:100%;max-width:520px;max-height:90vh;overflow-y:auto;box-shadow:0 24px 64px rgba(0,0,0,.18);}  
  @keyframes modalIn{from{opacity:0;transform:scale(.94) translateY(-10px);}to{opacity:1;transform:scale(1) translateY(0);}}  
  .modal-animate{animation:modalIn .26s cubic-bezier(.34,1.56,.64,1) forwards;}  
  .form-input,.form-textarea{width:100%;padding:10px 14px;font-size:13.5px;color:#1e293b;background:#fff;border:1.5px solid #e2e8f0;border-radius:12px;transition:border-color .2s,box-shadow .2s;outline:none;font-family:inherit;}  
  .form-input:focus,.form-textarea:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.12);}  
  .form-input.with-icon{padding-left:38px;}  
  .form-textarea{resize:none;}  
  .text-brand-gradient{background:linear-gradient(135deg,#1d4ed8,#2563eb);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}  
</style>  
@endpush  
  
<div x-data="devDashboard()" x-init="initProgressBars()" class="space-y-7">  
  
  {{-- Welcome Row --}}  
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">  
    <div>  
      <h1 class="text-2xl font-black text-slate-800">Welcome back, <span class="text-brand-gradient">Developer!</span> 👋</h1>  
      <p class="text-slate-500 text-sm mt-1.5">Here's what's happening with your playtests today.</p>  
    </div>  
    <a href="{{ url('developer/misis/create') }}"  
      class="shrink-0 inline-flex items-center gap-2 px-4 py-2.5 text-sm font-bold text-white rounded-xl"  
      style="background:linear-gradient(135deg,#1d4ed8,#2563eb);box-shadow:0 4px 14px rgba(37,99,235,.3);">  
      <x-heroicon-o-plus class="w-4 h-4"/> New Test Case  
    </a>  
  </div>  
  
  {{-- Stat Cards --}}  
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">  
    <div class="dev-stat-card" style="border-top:4px solid #2563eb;">  
      <div class="flex items-start justify-between mb-5">  
        <p class="text-slate-400 font-bold uppercase tracking-widest" style="font-size:10.5px;">Active Testing</p>  
        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#eff6ff;">  
          <x-heroicon-o-play-circle class="w-5 h-5 text-blue-600"/>  
        </div>  
      </div>  
      <p class="font-black text-slate-800" style="font-size:48px;line-height:1;">{{ $statAktif }}</p>  
      <div class="mt-3 flex items-center gap-2">  
        <span class="text-green-500 text-xs font-semibold"><x-heroicon-m-arrow-trending-up class="w-3 h-3 inline"/> +1</span>  
        <span class="text-slate-400 text-xs">dari bulan lalu</span>  
      </div>  
      <div class="mt-4 prog-track"><div class="prog-fill bg-blue-500" data-target="{{ $statAktifPercent }}%"></div></div>  
      <p class="text-slate-400 mt-1.5" style="font-size:11px;">{{ $statAktifNote }}</p>  
    </div>  
  
    <div class="dev-stat-card" style="border-top:4px solid #22c55e;">  
      <div class="flex items-start justify-between mb-5">  
        <p class="text-slate-400 font-bold uppercase tracking-widest" style="font-size:10.5px;">Completed Tests</p>  
        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#f0fdf4;">  
          <x-heroicon-o-check-circle class="w-5 h-5 text-green-600"/>  
        </div>  
      </div>  
      <p class="font-black text-slate-800" style="font-size:48px;line-height:1;">{{ $statSelesai }}</p>  
      <div class="mt-3 flex items-center gap-2">  
        <span class="text-green-500 text-xs font-semibold"><x-heroicon-m-check class="w-3 h-3 inline"/> Lulus</span>  
        <span class="text-slate-400 text-xs">Google Play Console</span>  
      </div>  
      <div class="mt-4 prog-track"><div class="prog-fill bg-green-500" data-target="{{ $statSelesaiPercent }}%"></div></div>  
      <p class="text-slate-400 mt-1.5" style="font-size:11px;">{{ $statSelesaiNote }}</p>  
    </div>  
  
    <div class="dev-stat-card" style="border-top:4px solid #a855f7;">  
      <div class="flex items-start justify-between mb-5">  
        <p class="text-slate-400 font-bold uppercase tracking-widest" style="font-size:10.5px;">Total Tester Recruited</p>  
        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#faf5ff;">  
          <x-heroicon-o-user-group class="w-5 h-5 text-purple-600"/>  
        </div>  
      </div>  
      <p class="font-black text-slate-800" style="font-size:48px;line-height:1;">{{ $statTester }}</p>  
      <div class="mt-3 flex items-center gap-2">  
        <span class="text-purple-500 text-xs font-semibold"><x-heroicon-m-users class="w-3 h-3 inline"/> Aktif</span>  
        <span class="text-slate-400 text-xs">across all campaign</span>  
      </div>  
      <div class="mt-4 prog-track"><div class="prog-fill bg-purple-500" data-target="{{ $statTesterPercent }}%"></div></div>  
      <p class="text-slate-400 mt-1.5" style="font-size:11px;">{{ $statTesterNote }}</p>  
    </div>  
  </div>  
  
  {{-- 14-Day Tracker --}}  
  <div class="dev-panel">  
    <div class="dev-panel-header">  
      <div>  
        <h2 class="text-slate-800 font-bold text-base">14-Day Progress Tracker</h2>  
        <p class="text-slate-500 text-xs mt-0.5">Pantau keaktifan harian setiap sesi pengujian aktif</p>  
      </div>  
      <div class="flex items-center gap-4">  
        <span class="flex items-center gap-1.5 text-xs text-slate-500">  
          <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#dbeafe;"></span>Aktif  
        </span>  
        <span class="flex items-center gap-1.5 text-xs text-slate-500">  
          <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#2563eb;"></span>Hari Ini  
        </span>  
        <span class="flex items-center gap-1.5 text-xs text-slate-500">  
          <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#f1f5f9;"></span>Mendatang  
        </span>  
      </div>  
    </div>  
    <div class="px-6 py-5 space-y-6">  
      @foreach ($kampanyeList as $idx => $k)  
        @if ($idx > 0)<hr style="border:none;border-top:1px solid #f1f5f9;">@endif  
        <div>  
          <div class="flex items-center justify-between mb-3">  
            <div class="flex items-center gap-3">  
              <div class="app-icon icon-{{ $k['warna'] }}">{{ $k['inisial'] }}</div>  
              <div>  
                <p class="text-slate-800 text-sm font-semibold">{{ $k['nama'] }}</p>  
                <p class="text-slate-500" style="font-size:11px;">  
                  {{ $k['versi'] }} &middot;  
                  @if($k['status']==='progress') Hari ke-{{ $k['hariAktif'] }} dari {{ $k['totalHari'] }}  
                  @else Menunggu konfirmasi tester @endif  
                </p>  
              </div>  
            </div>  
            <span class="status-badge status-{{ $k['status'] }}">  
              @if($k['status']==='progress')<span class="inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span> IN PROGRESS  
              @elseif($k['status']==='pending')<span class="inline-block w-1.5 h-1.5 bg-amber-500 rounded-full"></span> PENDING  
              @else<x-heroicon-m-check class="w-2.5 h-2.5"/> COMPLETED @endif  
            </span>  
          </div>  
          <div class="grid gap-1" style="grid-template-columns:repeat(14,1fr);">  
            @for ($h = 1; $h <= 14; $h++)  
              @php  
                $cls = 'day-future';  
                if ($k['status']==='progress') {  
                  if ($h < $k['hariAktif']) $cls = 'day-done';  
                  elseif ($h === $k['hariAktif']) $cls = 'day-today';  
                } elseif ($k['status']==='selesai') { $cls = 'day-done'; }  
              @endphp  
              <div class="day-cell {{ $cls }}"><span class="day-num">{{ $h }}</span></div>  
            @endfor  
          </div>  
        </div>  
      @endforeach  
    </div>  
  </div>  
  
  {{-- Recent Applications Table --}}  
  <div class="dev-panel">  
    <div class="dev-panel-header">  
      <div>  
        <h2 class="text-slate-800 font-bold text-base">Recent Applications</h2>  
        <p class="text-slate-500 text-xs mt-0.5">Daftar aplikasi yang sedang atau sudah dalam sesi pengujian</p>  
      </div>  
      <div class="flex items-center gap-2 flex-wrap">  
        <div class="relative">  
          <x-heroicon-o-calendar-days class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"/>  
          <input type="date" x-model="filterTanggal" class="text-xs rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200"  
            style="padding:7px 12px 7px 30px;background:#f8fafc;border:1px solid #e2e8f0;color:#64748b;width:148px;"/>  
        </div>  
        <button class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold text-blue-600 rounded-xl hover:bg-blue-50 transition"  
          style="border:1px solid #bfdbfe;">  
          View All <x-heroicon-m-arrow-right class="w-3 h-3"/>  
        </button>  
      </div>  
    </div>  
    <div class="overflow-x-auto">  
      <table class="w-full">  
        <thead>  
          <tr style="background:#f8fafc;border-bottom:1px solid #f1f5f9;">  
            <th class="text-left px-6 py-3 text-slate-400 font-semibold uppercase tracking-wider" style="font-size:10.5px;">App Name</th>  
            <th class="text-left px-6 py-3 text-slate-400 font-semibold uppercase tracking-wider" style="font-size:10.5px;">Platform</th>  
            <th class="text-left px-6 py-3 text-slate-400 font-semibold uppercase tracking-wider" style="font-size:10.5px;">Status &amp; Progress</th>  
            <th class="text-left px-6 py-3 text-slate-400 font-semibold uppercase tracking-wider" style="font-size:10.5px;">Date Started</th>  
            <th class="text-left px-6 py-3 text-slate-400 font-semibold uppercase tracking-wider" style="font-size:10.5px;">Action</th>  
          </tr>  
        </thead>  
        <tbody>  
          @forelse ($aplikasiList as $a)  
          <tr class="tbl-row" style="border-bottom:1px solid #f8fafc;">  
            <td class="px-6 py-4">  
              <div class="flex items-center gap-3">  
                <div class="app-icon icon-{{ $a['warna'] }}">{{ $a['inisial'] }}</div>  
                <div>  
                  <p class="text-slate-800 font-semibold text-sm">{{ $a['nama'] }}</p>  
                  <p class="text-slate-400" style="font-size:11px;">{{ $a['versi'] }}</p>  
                </div>  
              </div>  
            </td>  
            <td class="px-6 py-4">  
              <div class="flex items-center gap-1.5">  
                <x-heroicon-o-device-phone-mobile class="w-4 h-4 text-green-500"/>  
                <span class="text-slate-600 text-xs">Android</span>  
              </div>  
            </td>  
            <td class="px-6 py-4">  
              <div style="min-width:180px;" class="space-y-2">  
                <div class="flex items-center gap-2">  
                  <span class="status-badge status-{{ $a['status'] }}">  
                    @if($a['status']==='progress')<span class="inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span>  
                    @elseif($a['status']==='pending')<span class="inline-block w-1.5 h-1.5 bg-amber-500 rounded-full"></span>  
                    @else<x-heroicon-m-check class="w-2.5 h-2.5"/>@endif  
                    {{ $a['label'] }}  
                  </span>  
                  <span class="text-slate-500 text-xs">{{ $a['tester'] }} Tester</span>  
                </div>  
                <div class="prog-track">  
                  <div class="prog-fill @if($a['status']==='progress') bg-green-500 @elseif($a['status']==='pending') bg-amber-400 @else bg-purple-500 @endif"  
                       data-target="{{ $a['persen'] }}%"></div>  
                </div>  
              </div>  
            </td>  
            <td class="px-6 py-4 text-slate-500" style="font-size:12px;white-space:nowrap;">{{ $a['tanggal'] }}</td>  
            <td class="px-6 py-4">  
              <button class="btn-detail"><x-heroicon-o-eye class="w-3.5 h-3.5"/> Details</button>  
            </td>  
          </tr>  
          @empty  
          <tr><td colspan="5" class="px-6 py-10 text-center text-slate-400 text-sm">  
            <x-heroicon-o-inbox class="w-8 h-8 mx-auto mb-2 text-slate-200"/>  
            Belum ada aplikasi.  
          </td></tr>  
          @endforelse  
        </tbody>  
      </table>  
    </div>  
    <div class="flex items-center justify-between px-6 py-4" style="border-top:1px solid #f1f5f9;">  
      <p class="text-slate-400 text-xs">Menampilkan <strong class="text-slate-600">{{ count($aplikasiList) }}</strong> aplikasi</p>  
      <div class="flex items-center gap-1.5">  
        <button class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400" style="border:1px solid #e2e8f0;" disabled>  
          <x-heroicon-m-chevron-left class="w-3 h-3"/>  
        </button>  
        <button class="w-7 h-7 rounded-lg text-white text-xs font-bold flex items-center justify-center" style="background:#2563eb;">1</button>  
        <button class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400" style="border:1px solid #e2e8f0;" disabled>  
          <x-heroicon-m-chevron-right class="w-3 h-3"/>  
        </button>  
      </div>  
    </div>  
  </div>  
  
</div>  
  
@push('scripts')  
<script>  
function devDashboard() {  
  return {  
    filterTanggal: '',  
  
    initProgressBars() {  
      this.$nextTick(() => {  
        document.querySelectorAll('.prog-fill').forEach(el => {  
          const t = el.dataset.target || '0%';  
          el.style.width = '0%';  
          setTimeout(() => { el.style.transition = 'width 900ms ease'; el.style.width = t; }, 400);  
        });  
      });  
    },  

  };  
}  
</script>  
@endpush  
  
</x-filament-panels::page>  