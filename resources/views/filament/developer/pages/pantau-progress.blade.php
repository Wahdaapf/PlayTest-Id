<x-filament-panels::page>
@push('styles')
<style>
  /* ── Base ─────────────────────────────── */
  .dev-panel{background:#fff;border:1px solid #f1f5f9;border-radius:16px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.05);}
  .dark .dev-panel{background:#1e293b;border-color:#334155;}
  .dev-panel-header{padding:20px 24px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}
  .dark .dev-panel-header{border-color:#334155;}

  /* ── Status badges ────────────────────── */
  .status-badge{display:inline-flex;align-items:center;gap:5px;font-size:10.5px;font-weight:700;letter-spacing:.04em;padding:3px 9px;border-radius:999px;}
  .status-progress{background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;}
  .dark .status-progress{background:rgba(21,128,61,0.15);color:#86efac;border-color:rgba(74,222,128,0.2);}
  .status-pending{background:#fffbeb;color:#b45309;border:1px solid #fde68a;}
  .dark .status-pending{background:rgba(180,83,9,0.15);color:#fde047;border-color:rgba(250,204,21,0.2);}
  .status-selesai{background:#faf5ff;color:#7e22ce;border:1px solid #e9d5ff;}
  .dark .status-selesai{background:rgba(126,34,206,0.15);color:#d8b4fe;border-color:rgba(192,132,252,0.2);}
  .status-closed{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;}
  .dark .status-closed{background:rgba(185,28,28,0.15);color:#fca5a5;border-color:rgba(248,113,113,0.2);}
  .status-failed{background:#fef2f2;color:#dc2626;border:1px solid #fca5a5;}
  .dark .status-failed{background:rgba(220,38,38,0.15);color:#fca5a5;border-color:rgba(248,113,113,0.2);}
  .status-accepted{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;}

  /* ── App icon ─────────────────────────── */
  .app-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;flex-shrink:0;}
  .icon-blue{background:#eff6ff;color:#2563eb;}.dark .icon-blue{background:rgba(37,99,235,0.2);color:#93c5fd;}
  .icon-amber{background:#fffbeb;color:#d97706;}.dark .icon-amber{background:rgba(217,119,6,0.2);color:#fcd34d;}
  .icon-purple{background:#faf5ff;color:#7e22ce;}.dark .icon-purple{background:rgba(126,34,206,0.2);color:#d8b4fe;}
  .icon-green{background:#f0fdf4;color:#16a34a;}.dark .icon-green{background:rgba(22,163,74,0.2);color:#86efac;}

  /* ── Day cells ────────────────────────── */
  .day-cell{border-radius:5px;display:flex;align-items:flex-end;justify-content:center;padding-bottom:2px;height:32px;transition:all .15s;}
  .day-done{background:#dbeafe;}.dark .day-done{background:rgba(37,99,235,0.2);}
  .day-today{background:#2563eb;}
  .day-future{background:#f1f5f9;}.dark .day-future{background:#334155;}
  .day-missed{background:#fee2e2;}.dark .day-missed{background:rgba(239,68,68,0.2);}
  .day-pending{background:#fef08a;}.dark .day-pending{background:rgba(234,179,8,0.2);}
  .day-rejected{background:#fecaca;}.dark .day-rejected{background:rgba(220,38,38,0.2);}
  .day-num{font-size:8px;font-weight:600;}
  .day-done .day-num{color:#1d4ed8;}.dark .day-done .day-num{color:#93c5fd;}
  .day-today .day-num{color:#fff;font-weight:800;}
  .day-future .day-num{color:#94a3b8;}.dark .day-future .day-num{color:#64748b;}
  .day-missed .day-num{color:#ef4444;font-weight:800;}.dark .day-missed .day-num{color:#fca5a5;}
  .day-pending .day-num{color:#854d0e;}.dark .day-pending .day-num{color:#fde047;}
  .day-rejected .day-num{color:#991b1b;}.dark .day-rejected .day-num{color:#fca5a5;}

  /* ── Slideout panel ───────────────────── */
  .slideout-overlay{position:fixed;inset:0;z-index:50;background:rgba(15,23,42,.5);backdrop-filter:blur(4px);transition:opacity .25s;}
  .slideout-panel{position:fixed;top:0;right:0;height:100%;width:100%;max-width:520px;background:#fff;z-index:51;
    box-shadow:-4px 0 40px rgba(0,0,0,.12);display:flex;flex-direction:column;transform:translateX(100%);transition:transform .3s cubic-bezier(.4,0,.2,1);}
  .dark .slideout-panel{background:#1e293b;}
  .slideout-panel.open{transform:translateX(0);}
  .slideout-header{padding:20px 24px;border-bottom:1px solid #f1f5f9;display:flex;justify-content:space-between;align-items:flex-start;flex-shrink:0;}
  .dark .slideout-header{border-color:#334155;}
  .slideout-body{flex:1;overflow-y:auto;padding:20px 24px;}
  .sub-card{background:#fafafa;border:1px solid #f1f5f9;border-radius:14px;overflow:hidden;margin-bottom:12px;}
  .dark .sub-card{background:#0f172a;border-color:#334155;}
  .sub-card-header{padding:12px 14px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #f1f5f9;}
  .dark .sub-card-header{border-color:#334155;}
  .sub-card-body{padding:12px 14px;}
  .sub-img{width:100%;border-radius:10px;object-fit:cover;max-height:180px;cursor:pointer;transition:opacity .2s;}
  .sub-img:hover{opacity:.9;}
  .btn-acc{background:#2563eb;color:#fff;font-weight:700;font-size:12px;padding:6px 16px;border-radius:10px;cursor:pointer;transition:background .15s;}
  .btn-acc:hover{background:#1d4ed8;}
  .btn-tolak{background:#fef2f2;color:#dc2626;border:1px solid #fecaca;font-weight:700;font-size:12px;padding:6px 16px;border-radius:10px;cursor:pointer;transition:background .15s;}
  .btn-tolak:hover{background:#fee2e2;}

  /* ── Finish Mission btn ───────────────── */
  .btn-finish{background:linear-gradient(135deg,#7c3aed,#5b21b6);color:#fff;font-weight:700;font-size:12px;
    padding:8px 16px;border-radius:12px;box-shadow:0 2px 8px rgba(124,58,237,.35);transition:all .2s;
    display:flex;align-items:center;gap:6px;cursor:pointer;}
  .btn-finish:hover{box-shadow:0 4px 16px rgba(124,58,237,.45);transform:translateY(-1px);}
  .btn-finish:disabled{opacity:.5;cursor:not-allowed;transform:none;}
</style>
@endpush

<div class="space-y-7 relative">

{{-- ════════════════════════════════════════ --}}
{{-- LIST VIEW                               --}}
{{-- ════════════════════════════════════════ --}}
@if(!$isDetail)
  <div>
    <h2 class="text-slate-800 dark:text-white font-bold text-lg mb-1">{{ __('Pilih Kampanye') }}</h2>
    <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">{{ __('Pilih aplikasi yang sedang "berjalan" untuk memantau progres testernya.') }}</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($misiList as $m)
        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-blue-300 dark:hover:border-blue-700 transition-all">
          <div>
            <div class="flex justify-between items-start mb-4">
              @if($m->logo)
                <img src="/storage/{{ $m->logo }}" class="w-12 h-12 rounded-xl object-cover shadow-sm" alt="">
              @else
                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xl">{{ strtoupper(substr($m->nama_aplikasi,0,1)) }}</div>
              @endif
              <span class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>{{ __('BERJALAN') }}
              </span>
            </div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-1">{{ $m->nama_aplikasi }}</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-6 line-clamp-2">{{ strip_tags($m->instruksi) ?: __('Tidak ada deskripsi.') }}</p>
          </div>
          <button wire:click="$set('selectedMisiId', {{ $m->id }})"
            class="w-full bg-slate-50 dark:bg-slate-900/50 hover:bg-slate-100 dark:hover:bg-slate-800 text-blue-600 dark:text-blue-400 font-semibold text-sm py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 transition-colors flex items-center justify-center gap-2">
            {{ __('Lihat Progres') }} <x-heroicon-m-arrow-right class="w-4 h-4"/>
          </button>
        </div>
      @empty
        <div class="col-span-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-10 text-center shadow-sm">
          <x-heroicon-o-rocket-launch class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600 mb-3"/>
          <h3 class="text-slate-700 dark:text-slate-300 font-bold mb-1">{{ __('Belum Ada Kampanye Berjalan') }}</h3>
          <p class="text-slate-500 dark:text-slate-400 text-sm">{{ __('Anda belum memiliki aplikasi dengan status \'berjalan\'.') }}</p>
        </div>
      @endforelse
    </div>
  </div>

{{-- ════════════════════════════════════════ --}}
{{-- DETAIL VIEW                             --}}
{{-- ════════════════════════════════════════ --}}
@else

  {{-- ── Pending Submissions (perlu validasi) ── --}}
  @if(count($pendingSubmissions) > 0)
  <div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-3">
      <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
        <x-heroicon-o-bell-alert class="w-6 h-6 text-amber-500"/>
        {{ __('Butuh Validasi') }} ({{ count($pendingSubmissions) }})
      </h3>
      <div class="flex items-center gap-2">
        <button wire:click="rejectAllPending" class="text-sm font-semibold px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900/30 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/40">{{ __('Tolak Semua') }}</button>
        <button wire:click="acceptAllPending" class="text-sm font-semibold px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">{{ __('Setujui Semua') }}</button>
      </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
      @foreach($pendingSubmissions as $p)
      <div class="bg-white dark:bg-slate-800 border border-amber-200 dark:border-amber-700/50 rounded-2xl overflow-hidden shadow-sm flex flex-col hover:shadow-md transition-shadow">
        <div class="p-4 bg-amber-50/50 dark:bg-amber-900/10 border-b border-amber-100 dark:border-amber-700/30 flex justify-between items-start">
          <div>
            <p class="font-bold text-slate-800 dark:text-white text-sm">{{ $p['tester_nama'] }}</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('Hari ke-:h', ['h' => $p['hari_ke']]) }} &bull; {{ $p['waktu'] }}</p>
            @if($p['catatan_tester'])
              <p class="text-xs text-indigo-600 mt-1 font-medium">💬 {{ __('Ada komentar tester') }}</p>
            @endif
          </div>
          <span class="bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-400 text-[10px] font-bold px-2 py-1 rounded-md">{{ __('BARU') }}</span>
        </div>
        <div class="p-0 flex justify-center bg-slate-100 dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800 overflow-hidden relative group"
             style="height:140px;"
             wire:click="openValidationModal({{ $p['id'] }}, '{{ addslashes($p['tester_nama']) }}', {{ $p['hari_ke'] }})">
          <img src="{{ $p['image'] }}" class="w-full h-full object-cover cursor-pointer group-hover:scale-105 transition-transform duration-300" alt="Bukti"/>
          <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/20 transition-colors flex items-center justify-center">
            <x-heroicon-m-arrows-pointing-out class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity"/>
          </div>
        </div>
        <div class="p-4 flex gap-3">
          <button wire:click="rejectDirect({{ $p['id'] }})" class="flex-1 py-2 text-sm font-bold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900/30 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/40">{{ __('Tolak') }}</button>
          <button wire:click="acceptDirect({{ $p['id'] }})" class="flex-1 py-2 text-sm font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700">{{ __('ACC ✓') }}</button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif

  {{-- ── Main Panel ── --}}
  <div class="dev-panel" wire:poll.10s="refreshTracking">
    <div class="dev-panel-header flex-col sm:flex-row items-start sm:items-center">
      {{-- Judul --}}
      <div class="mb-4 sm:mb-0 w-full sm:w-auto">
        <div class="flex items-center gap-3 mb-1">
          <button wire:click="$set('selectedMisiId', null)" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 p-1.5 rounded-lg transition-colors">
            <x-heroicon-m-arrow-left class="w-4 h-4"/>
          </button>
          <h2 class="text-slate-800 dark:text-white font-bold text-base">{{ __('Progress Tester:') }} {{ $misiDetail->nama_aplikasi }}</h2>
        </div>
        <p class="text-slate-500 dark:text-slate-400 text-xs mt-0.5 ml-9">{{ __('Klik nama tester untuk melihat detail & review screenshot per hari.') }}</p>
      </div>

      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full sm:w-auto">
        {{-- Legend --}}
        <div class="flex flex-wrap items-center gap-3">
          <span class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400"><span class="w-2.5 h-2.5 rounded-sm day-pending"></span>{{ __('Perlu Validasi') }}</span>
          <span class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400"><span class="w-2.5 h-2.5 rounded-sm day-done"></span>{{ __('Disetujui') }}</span>
          <span class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400"><span class="w-2.5 h-2.5 rounded-sm day-rejected"></span>{{ __('Ditolak') }}</span>
          <span class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400"><span class="w-2.5 h-2.5 rounded-sm day-today"></span>{{ __('Hari Ini') }}</span>
          <span class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400"><span class="w-2.5 h-2.5 rounded-sm day-missed"></span>{{ __('Terlewat') }}</span>
        </div>

        {{-- ── TOMBOL SELESAIKAN MISI ── --}}
        @if($canFinish)
          <button type="button" onclick="confirmFinishMission()" class="btn-finish">
            <x-heroicon-m-flag class="w-4 h-4"/> {{ __('Selesaikan Misi') }}
          </button>
        @elseif($hariToday >= 14 || $hasOneCompletedUser)
          <button type="button" onclick="confirmFinishMission()" class="btn-finish">
            <x-heroicon-m-flag class="w-4 h-4"/> {{ __('Selesaikan Misi') }}
          </button>
        @endif

        {{-- ── TOMBOL GENERATE AI REPORT ── --}}
        @if($hasAiFeature)
          <button wire:click="generateAiReport" wire:loading.attr="disabled"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl border border-violet-300 bg-violet-50 text-violet-700 hover:bg-violet-100 transition-colors disabled:opacity-60">
            <x-heroicon-m-sparkles class="w-4 h-4"/>
            <span wire:loading.remove wire:target="generateAiReport">{{ __('AI Report (Semua Hari)') }}</span>
            <span wire:loading wire:target="generateAiReport">{{ __('Menganalisis...') }}</span>
          </button>
        @else
          <div class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl border border-slate-200 bg-slate-50 text-slate-400 cursor-not-allowed"
            title="{{ __('Fitur AI Report hanya tersedia di Paket Pro') }}">
            <x-heroicon-m-lock-closed class="w-4 h-4"/>
            {{ __('AI Report — Paket Pro') }}
          </div>
        @endif
      </div>
    </div>

    {{-- ── Daftar Tester ── --}}
    <div class="px-6 py-5 space-y-6 min-w-[700px] overflow-x-auto">
      @forelse($kampanyeList as $idx => $k)
        @if($idx > 0)<hr style="border:none;border-top:1px solid #f1f5f9;" class="dark:border-slate-800">@endif
        <div>
          {{-- Info tester --}}
          <div class="flex items-center justify-between mb-3 flex-wrap gap-2">
            <div class="flex items-center gap-3">
              @if($k['logo'])
                <img src="/storage/{{ $k['logo'] }}" class="w-9 h-9 rounded-xl object-cover flex-shrink-0" alt="">
              @else
                <div class="app-icon icon-{{ $k['warna'] }}">{{ $k['inisial'] }}</div>
              @endif
              <div>
                {{-- Klik nama → buka slideout --}}
                <button wire:click="openSlideout({{ $k['ma_id'] }})"
                  class="text-slate-800 dark:text-white text-sm font-semibold hover:text-blue-600 hover:underline transition-colors text-left">
                  {{ $k['misi_nama'] }}
                  <span class="text-slate-400 font-normal">| {{ __('Tester:') }} {{ $k['tester_nama'] }}</span>
                </button>
                <p class="text-slate-500 dark:text-slate-400" style="font-size:11px;">
                  {{ __('Hari ke-:aktif dari 14', ['aktif' => $k['hariAktif']]) }}
                  @if($k['pending_count'] > 0)
                    &bull; <span class="text-amber-600 font-semibold">{{ $k['pending_count'] }} {{ __('menunggu review') }}</span>
                  @endif
                  @if($k['all_done'])
                    &bull; <span class="text-green-600 font-semibold">✓ {{ __('14 hari selesai') }}</span>
                  @endif
                </p>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <span class="status-badge status-{{ $k['status'] }}">
                @if($k['status']==='progress')<span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> {{ __('DIPROSES') }}
                @elseif($k['status']==='accepted')<span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span> {{ __('DITERIMA') }}
                @elseif($k['status']==='selesai')<x-heroicon-m-check class="w-2.5 h-2.5"/> {{ __('SELESAI') }}
                @elseif($k['status']==='failed')<x-heroicon-m-x-mark class="w-2.5 h-2.5"/> {{ __('GAGAL') }}
                @else {{ strtoupper($k['status']) }} @endif
              </span>
              {{-- Tombol detail slideout --}}
              <button wire:click="openSlideout({{ $k['ma_id'] }})"
                class="text-xs font-semibold px-3 py-1.5 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-colors flex items-center gap-1">
                {{ __('Detail') }} <x-heroicon-m-chevron-right class="w-3 h-3"/>
              </button>
            </div>
          </div>

          {{-- ── 14-hari grid ── --}}
          <div class="grid gap-1" style="grid-template-columns:repeat(14,1fr);">
            @for($h = 1; $h <= 14; $h++)
              @php
                $dayData   = $k['days'][$h] ?? ['status' => 'notdone'];
                $statusDay = $dayData['status'];
                $subId     = $dayData['sub_id'] ?? null;
                $hasCat    = !empty($dayData['catatan_tester'] ?? null);
                $tNama     = addslashes($k['tester_nama']);

                $cls = 'day-future';
                if ($statusDay !== 'notdone') {
                    $cls = match($statusDay) {
                        'pending'  => 'day-pending cursor-pointer hover:ring-2 hover:ring-amber-300',
                        'rejected' => 'day-rejected cursor-pointer hover:ring-2 hover:ring-red-300',
                        default    => 'day-done cursor-pointer hover:ring-2 hover:ring-blue-300',
                    };
                } elseif ($h == $k['hariAktif']) {
                    $cls = 'day-today';
                } elseif ($h < $k['hariAktif']) {
                    $cls = 'day-missed';
                }
              @endphp
              <div class="day-cell {{ $cls }} relative"
                @if($subId) wire:click="openValidationModal({{ $subId }}, '{{ $tNama }}', {{ $h }})" @endif>
                <span class="day-num">{{ $h }}</span>
                @if($hasCat)
                  <span class="absolute top-0.5 right-0.5 w-1.5 h-1.5 bg-indigo-400 rounded-full"></span>
                @endif
              </div>
            @endfor
          </div>
        </div>
      @empty
        <div class="text-center py-8">
          <x-heroicon-o-users class="w-10 h-10 mx-auto text-slate-300 mb-2"/>
          <p class="text-slate-500 text-sm">{{ __('Belum ada tester yang bergabung.') }}</p>
        </div>
      @endforelse
    </div>
  </div>

  {{-- ════════════════════════════════════
       AI REPORT SECTION
  ════════════════════════════════════ --}}
  @if(!$hasAiFeature)
  <div class="rounded-2xl border border-dashed border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 p-6">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 rounded-2xl bg-slate-200 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
        <x-heroicon-o-lock-closed class="w-6 h-6 text-slate-400 dark:text-slate-500"/>
      </div>
      <div class="flex-1">
        <p class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ __('Fitur AI Report tidak tersedia di paket ini') }}</p>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ __('Upgrade ke Paket Pro untuk mendapatkan analisis feedback tester secara otomatis menggunakan AI, tersedia per hari maupun keseluruhan.') }}</p>
      </div>
      <span class="flex-shrink-0 text-xs font-bold px-3 py-1.5 rounded-lg bg-violet-100 text-violet-700 border border-violet-200">PRO</span>
    </div>
  </div>

  @elseif(isset($aiReport) && $aiReport)
  @php
    $report = json_decode($aiReport->result, true);
    $skor = $report['skor'] ?? 0;
    $skorColor = $skor >= 9 ? ['bg'=>'bg-emerald-500','text'=>'text-emerald-700','light'=>'bg-emerald-50 border-emerald-200']
               : ($skor >= 7 ? ['bg'=>'bg-blue-500','text'=>'text-blue-700','light'=>'bg-blue-50 border-blue-200']
               : ($skor >= 4 ? ['bg'=>'bg-amber-500','text'=>'text-amber-700','light'=>'bg-amber-50 border-amber-200']
               : ['bg'=>'bg-red-500','text'=>'text-red-700','light'=>'bg-red-50 border-red-200']));
    $severityMap = [
      'critical' => ['label'=>'Critical','cls'=>'bg-red-100 text-red-700 border-red-200'],
      'major'    => ['label'=>'Major','cls'=>'bg-orange-100 text-orange-700 border-orange-200'],
      'minor'    => ['label'=>'Minor','cls'=>'bg-slate-100 text-slate-600 border-slate-200'],
    ];
    $bugs = $report['bugs'] ?? [];
    $criticalCount = collect($bugs)->where('severity','critical')->count();
    $majorCount = collect($bugs)->where('severity','major')->count();
  @endphp

  <div class="space-y-4">
    {{-- Header --}}
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-violet-600 flex items-center justify-center">
          <x-heroicon-m-sparkles class="w-4 h-4 text-white"/>
        </div>
        <div>
          <h3 class="text-sm font-bold text-slate-800 dark:text-white">AI Quality Report</h3>
          <p class="text-xs text-slate-400">{{ $aiReport->feedback_count }} feedback
            · {{ $aiReport->hari_ke ? __('Hari ke-').$aiReport->hari_ke : __('Semua Hari') }}
            · {{ __('diperbarui') }} {{ $aiReport->updated_at->diffForHumans() }}</p>
        </div>
      </div>
      <button wire:click="generateAiReport({{ $selectedHariKe ?? 'null' }})" wire:loading.attr="disabled"
        class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-lg border border-slate-200 bg-white dark:bg-slate-800 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 transition-colors disabled:opacity-50">
        <x-heroicon-m-arrow-path class="w-3.5 h-3.5" wire:loading.class="animate-spin" wire:target="generateAiReport"/>
        <span wire:loading.remove wire:target="generateAiReport">{{ __('Regenerate') }}</span>
        <span wire:loading wire:target="generateAiReport">{{ __('Menganalisis...') }}</span>
      </button>
    </div>

    {{-- Tab Hari Selector --}}
    <div class="rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 p-1.5">
      <div class="overflow-x-auto">
        <div class="flex items-center gap-1 min-w-max">
          @php $sudahAll = $allAiReports->whereNull('hari_ke')->count(); @endphp
          <button wire:click="switchAiReport(null)"
            class="inline-flex items-center gap-1.5 text-xs font-semibold px-3.5 py-2 rounded-lg whitespace-nowrap transition-all
              {{ $selectedHariKe === null ? 'bg-white dark:bg-slate-700 text-violet-700 dark:text-violet-300 shadow-sm border border-violet-200 dark:border-violet-700' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-white/60 dark:hover:bg-slate-700/50' }}">
            <x-heroicon-m-squares-2x2 class="w-3.5 h-3.5"/>
            {{ __('Semua Hari') }}
            @if($sudahAll)<span class="w-1.5 h-1.5 rounded-full bg-emerald-400 ml-0.5"></span>@endif
          </button>
          <div class="w-px h-5 bg-slate-200 dark:bg-slate-600 mx-1"></div>
          @foreach($hariDenganFeedback as $hari)
          @php $sudahGenerate = $allAiReports->firstWhere('hari_ke', $hari); @endphp
          <button wire:click="switchAiReport({{ $hari }})"
            class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-2 rounded-lg whitespace-nowrap transition-all
              {{ $selectedHariKe === $hari ? 'bg-white dark:bg-slate-700 text-violet-700 dark:text-violet-300 shadow-sm border border-violet-200 dark:border-violet-700' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-white/60 dark:hover:bg-slate-700/50' }}">
            H{{ $hari }}
            @if($sudahGenerate)<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
            @else<span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>@endif
          </button>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Tombol generate jika hari dipilih tapi belum ada report --}}
    @if($selectedHariKe && !$allAiReports->firstWhere('hari_ke', $selectedHariKe))
    <div class="rounded-xl border border-dashed border-violet-200 bg-violet-50/40 p-4 flex items-center justify-between">
      <div class="flex items-center gap-2">
        <x-heroicon-o-sparkles class="w-4 h-4 text-violet-400"/>
        <p class="text-sm text-violet-700 font-medium">{{ __('Report Hari ke-:h belum digenerate', ['h' => $selectedHariKe]) }}</p>
      </div>
      <button wire:click="generateAiReport({{ $selectedHariKe }})" wire:loading.attr="disabled"
        class="inline-flex items-center gap-1.5 text-xs font-bold px-4 py-2 rounded-lg bg-violet-600 text-white hover:bg-violet-700 transition-colors disabled:opacity-60">
        <x-heroicon-m-sparkles class="w-3.5 h-3.5"/>
        <span wire:loading.remove wire:target="generateAiReport">{{ __('Generate Sekarang') }}</span>
        <span wire:loading wire:target="generateAiReport">{{ __('Menganalisis...') }}</span>
      </button>
    </div>
    @endif

    {{-- Row atas: Skor + Ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
      {{-- Skor --}}
      <div class="rounded-2xl border {{ $skorColor['light'] }} p-5 flex flex-col items-center justify-center text-center">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-2">Launch Score</p>
        <div class="relative w-20 h-20 mb-3">
          <svg class="w-20 h-20 -rotate-90" viewBox="0 0 36 36">
            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#e2e8f0" stroke-width="3"/>
            <circle cx="18" cy="18" r="15.9" fill="none" stroke-width="3"
              stroke="{{ $skor >= 9 ? '#10b981' : ($skor >= 7 ? '#3b82f6' : ($skor >= 4 ? '#f59e0b' : '#ef4444')) }}"
              stroke-dasharray="{{ $skor * 10 }}, 100"
              stroke-linecap="round"/>
          </svg>
          <div class="absolute inset-0 flex items-center justify-center">
            <span class="text-2xl font-black {{ $skorColor['text'] }}">{{ $skor }}</span>
          </div>
        </div>
        <p class="text-sm font-bold {{ $skorColor['text'] }}">{{ $report['skor_label'] ?? '' }}</p>
        <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $report['skor_deskripsi'] ?? '' }}</p>
      </div>

      {{-- Ringkasan + stats --}}
      <div class="sm:col-span-2 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-2">{{ __('Ringkasan Analisis') }}</p>
        <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed mb-4">{{ $report['ringkasan'] ?? '' }}</p>
        <div class="flex gap-3 flex-wrap">
          <div class="flex items-center gap-1.5 bg-red-50 border border-red-200 rounded-lg px-3 py-1.5">
            <span class="w-2 h-2 rounded-full bg-red-500"></span>
            <span class="text-xs font-semibold text-red-700">{{ $criticalCount }} Critical Bug</span>
          </div>
          <div class="flex items-center gap-1.5 bg-orange-50 border border-orange-200 rounded-lg px-3 py-1.5">
            <span class="w-2 h-2 rounded-full bg-orange-400"></span>
            <span class="text-xs font-semibold text-orange-700">{{ $majorCount }} Major Bug</span>
          </div>
          <div class="flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 rounded-lg px-3 py-1.5">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span class="text-xs font-semibold text-emerald-700">{{ count($report['positif'] ?? []) }} {{ __('Hal Positif') }}</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Bug List --}}
    @if(!empty($bugs))
    <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5">
      <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-3">{{ __('Bug yang Ditemukan') }}</p>
      <div class="space-y-2">
        @foreach($bugs as $bug)
        @php $sev = $severityMap[$bug['severity']] ?? $severityMap['minor']; @endphp
        <div class="flex items-center justify-between py-2.5 px-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700">
          <div class="flex items-center gap-2.5">
            <span class="text-xs font-bold px-2 py-0.5 rounded-md border {{ $sev['cls'] }}">{{ $sev['label'] }}</span>
            <span class="text-sm text-slate-700 dark:text-slate-300 font-medium">{{ $bug['judul'] }}</span>
          </div>
          <span class="text-xs font-semibold text-slate-500 bg-slate-100 dark:bg-slate-700 rounded-lg px-2.5 py-1">{{ $bug['jumlah'] }} tester</span>
        </div>
        @endforeach
      </div>
    </div>
    @endif

    {{-- Row bawah: UX Issues + Positif + Rekomendasi --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
      {{-- UX Issues --}}
      <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-3">{{ __('Masalah UX/UI') }}</p>
        @forelse($report['ux_issues'] ?? [] as $ux)
        <div class="flex gap-2 mb-2">
          <span class="mt-1 w-1.5 h-1.5 rounded-full bg-amber-400 flex-shrink-0"></span>
          <div>
            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $ux['judul'] }}</p>
            @if(!empty($ux['detail']))<p class="text-xs text-slate-500">{{ $ux['detail'] }}</p>@endif
          </div>
        </div>
        @empty
        <p class="text-sm text-slate-400 italic">{{ __('Tidak ada masalah UX/UI.') }}</p>
        @endforelse
      </div>

      {{-- Positif --}}
      <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-3">{{ __('Hal Positif') }}</p>
        @forelse($report['positif'] ?? [] as $pos)
        <div class="flex gap-2 mb-2">
          <span class="mt-0.5 flex-shrink-0 text-emerald-500">
            <x-heroicon-m-check-circle class="w-4 h-4"/>
          </span>
          <p class="text-sm text-slate-700 dark:text-slate-300">{{ $pos }}</p>
        </div>
        @empty
        <p class="text-sm text-slate-400 italic">{{ __('Tidak ada catatan positif.') }}</p>
        @endforelse
      </div>

      {{-- Rekomendasi --}}
      <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-3">{{ __('Rekomendasi Prioritas') }}</p>
        @forelse($report['rekomendasi'] ?? [] as $rek)
        <div class="flex gap-2.5 mb-3">
          <span class="w-5 h-5 rounded-full bg-violet-100 text-violet-700 text-xs font-black flex items-center justify-center flex-shrink-0 mt-0.5">{{ $rek['prioritas'] }}</span>
          <div>
            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $rek['judul'] }}</p>
            <p class="text-xs text-slate-500 leading-relaxed">{{ $rek['detail'] }}</p>
          </div>
        </div>
        @empty
        <p class="text-sm text-slate-400 italic">{{ __('Tidak ada rekomendasi.') }}</p>
        @endforelse
      </div>
    </div>
  </div>

  @else
  {{-- AI Report belum digenerate --}}
  <div class="space-y-4">
    <div class="flex items-center gap-2.5">
      <div class="w-8 h-8 rounded-lg bg-violet-600 flex items-center justify-center">
        <x-heroicon-m-sparkles class="w-4 h-4 text-white"/>
      </div>
      <h3 class="text-sm font-bold text-slate-800 dark:text-white">AI Quality Report</h3>
    </div>

    @if($hariDenganFeedback->count())
    <div class="rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 p-1.5">
      <div class="overflow-x-auto">
        <div class="flex items-center gap-1 min-w-max">
          <button wire:click="switchAiReport(null)"
            class="inline-flex items-center gap-1.5 text-xs font-semibold px-3.5 py-2 rounded-lg whitespace-nowrap transition-all
              {{ $selectedHariKe === null ? 'bg-white dark:bg-slate-700 text-violet-700 shadow-sm border border-violet-200' : 'text-slate-500 hover:text-slate-700 hover:bg-white/60' }}">
            <x-heroicon-m-squares-2x2 class="w-3.5 h-3.5"/>
            {{ __('Semua Hari') }}
          </button>
          <div class="w-px h-5 bg-slate-200 mx-1"></div>
          @foreach($hariDenganFeedback as $hari)
          <button wire:click="switchAiReport({{ $hari }})"
            class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-2 rounded-lg whitespace-nowrap transition-all
              {{ $selectedHariKe === $hari ? 'bg-white dark:bg-slate-700 text-violet-700 shadow-sm border border-violet-200' : 'text-slate-500 hover:text-slate-700 hover:bg-white/60' }}">
            H{{ $hari }}<span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
          </button>
          @endforeach
        </div>
      </div>
    </div>
    @endif

    <div class="rounded-2xl border border-dashed border-violet-200 bg-violet-50/40 p-6 text-center">
      <div class="w-10 h-10 rounded-xl bg-violet-100 flex items-center justify-center mx-auto mb-3">
        <x-heroicon-o-sparkles class="w-5 h-5 text-violet-500"/>
      </div>
      <p class="text-sm font-bold text-violet-700">
        @if($selectedHariKe) {{ __('Report Hari ke-:h belum digenerate', ['h' => $selectedHariKe]) }}
        @else {{ __('AI Quality Report belum dibuat') }} @endif
      </p>
      <p class="text-xs text-slate-500 mt-1 mb-4">{{ __('Klik tombol di bawah untuk menganalisis feedback tester menggunakan AI.') }}</p>
      <button wire:click="generateAiReport({{ $selectedHariKe ?? 'null' }})" wire:loading.attr="disabled"
        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl bg-violet-600 text-white hover:bg-violet-700 transition-colors disabled:opacity-60 mx-auto">
        <x-heroicon-m-sparkles class="w-4 h-4"/>
        <span wire:loading.remove wire:target="generateAiReport">
          {{ $selectedHariKe ? __('Generate Report Hari :h', ['h' => $selectedHariKe]) : __('Generate Report Semua Hari') }}
        </span>
        <span wire:loading wire:target="generateAiReport">{{ __('Menganalisis...') }}</span>
      </button>
    </div>
  </div>
  @endif

  {{-- ════════════════════════════════════
       SLIDEOUT PANEL — detail per tester
  ════════════════════════════════════ --}}
  @if($slideoutData)
  <div class="slideout-overlay" wire:click.self="closeSlideout()"></div>
  <div class="slideout-panel open">
    {{-- Header --}}
    <div class="slideout-header">
      <div>
        <h3 class="text-base font-bold text-slate-800 dark:text-white">{{ $slideoutData['tester_nama'] }}</h3>
        <p class="text-xs text-slate-500 mt-0.5">{{ $slideoutData['tester_email'] }}</p>
        <div class="flex items-center gap-3 mt-2 flex-wrap">
          <span class="status-badge status-{{ $slideoutData['status'] }}">{{ strtoupper($slideoutData['status']) }}</span>
          <span class="text-xs bg-blue-50 text-blue-700 border border-blue-200 px-2 py-1 rounded-full font-semibold">
            ✓ {{ $slideoutData['done_count'] }}/14 {{ __('hari') }}
          </span>
          @if($slideoutData['pending_count'] > 0)
          <span class="text-xs bg-amber-50 text-amber-700 border border-amber-200 px-2 py-1 rounded-full font-semibold">
            ⏳ {{ $slideoutData['pending_count'] }} pending
          </span>
          @endif
        </div>
      </div>
      <button wire:click="closeSlideout()" class="text-slate-400 hover:text-slate-700 dark:hover:text-white p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors flex-shrink-0">
        <x-heroicon-m-x-mark class="w-5 h-5"/>
      </button>
    </div>

    {{-- Body — daftar hari --}}
    <div class="slideout-body">
      @if(empty($slideoutData['subs']))
        <div class="text-center py-12 text-slate-400">
          <x-heroicon-o-document class="w-10 h-10 mx-auto mb-2"/>
          <p class="text-sm">{{ __('Belum ada submission dari tester ini.') }}</p>
        </div>
      @else
        @foreach($slideoutData['subs'] as $sub)
        @if(in_array($sub['status'], ['pending', 'done', 'notdone']) && !$sub['image'] && $sub['status'] === 'notdone')
          @continue
        @endif
        <div class="sub-card">
          <div class="sub-card-header">
            <div class="flex items-center gap-2">
              <span class="text-xs font-bold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 px-2.5 py-1 rounded-lg">{{ __('Hari') }} {{ $sub['hari_ke'] }}</span>
              @php
                $sColor = match($sub['status']) {
                    'done'     => 'bg-green-100 text-green-700',
                    'pending'  => 'bg-amber-100 text-amber-700',
                    'rejected' => 'bg-red-100 text-red-700',
                    default    => 'bg-slate-100 text-slate-500',
                };
                $sLabel = match($sub['status']) {
                    'done'    => '✓ ' . __('Di-ACC'),
                    'pending' => '⏳ ' . __('Menunggu Review'),
                    'rejected'=> '✗ ' . __('Ditolak'),
                    default   => __('Belum Submit'),
                };
              @endphp
              <span class="text-[10px] font-bold px-2 py-1 rounded-full {{ $sColor }}">{{ $sLabel }}</span>
            </div>
            <span class="text-[10px] text-slate-400">{{ $sub['waktu'] }}</span>
          </div>

          <div class="sub-card-body">
            {{-- Screenshot --}}
            @if($sub['image'])
            <img src="{{ $sub['image'] }}" alt="{{ __('Screenshot Hari') }} {{ $sub['hari_ke'] }}"
              class="sub-img mb-3"
              onclick="window.open('{{ $sub['image'] }}', '_blank')"/>
            @endif

            {{-- Komentar tester --}}
            @if($sub['catatan_tester'])
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-3 mb-3">
              <p class="text-[10px] font-bold text-indigo-500 mb-1">💬 {{ __('KOMENTAR TESTER') }}</p>
              <p class="text-xs text-slate-700">{{ $sub['catatan_tester'] }}</p>
            </div>
            @endif

            {{-- Alasan tolak --}}
            @if($sub['alasan_tolak'])
            <div class="bg-red-50 border border-red-100 rounded-xl p-3 mb-3">
              <p class="text-[10px] font-bold text-red-500 mb-1">❌ {{ __('ALASAN DITOLAK') }}</p>
              <p class="text-xs text-slate-700">{{ $sub['alasan_tolak'] }}</p>
            </div>
            @endif

            {{-- Tombol ACC / Tolak (hanya jika pending) --}}
            @if($sub['status'] === 'pending' && $sub['image'])
            <div class="flex gap-2 mt-2">
              <button wire:click="rejectDirect({{ $sub['id'] }}, '{{ __('Screenshot kurang jelas, mohon upload ulang.') }}')"
                class="btn-tolak flex-1">✗ {{ __('Tolak') }}</button>
              <button wire:click="acceptDirect({{ $sub['id'] }})"
                class="btn-acc flex-1">✓ {{ __('ACC') }}</button>
            </div>
            @endif

            {{-- Re-review jika done --}}
            @if($sub['status'] === 'done')
            <button wire:click="rejectDirect({{ $sub['id'] }}, '{{ __('Perlu perbaikan, silakan ulangi hari ini.') }}')"
              class="btn-tolak w-full mt-2 text-xs">{{ __('Batalkan ACC / Minta Ulang') }}</button>
            @endif
          </div>
        </div>
        @endforeach
      @endif
    </div>
  </div>
  @endif

  {{-- ════════════════
       MODAL VALIDASI
  ════════════════ --}}
  @if($selectedSubData)
  <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 backdrop-blur-sm" style="background:rgba(15,23,42,.6);">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col">
      {{-- Header --}}
      <div class="p-5 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
        <div>
          <h3 class="text-lg font-bold text-slate-800 dark:text-white">{{ __('Review Screenshot') }}</h3>
          <p class="text-sm text-slate-500 mt-0.5">{{ $selectedSubData['tester_nama'] }} &bull; {{ __('Hari ke-:h', ['h' => $selectedSubData['hari_ke']]) }}</p>
        </div>
        <button wire:click="closeValidationModal" class="p-2 text-slate-400 hover:text-slate-700 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl">
          <x-heroicon-m-x-mark class="w-6 h-6"/>
        </button>
      </div>

      {{-- Body --}}
      <div class="p-5 bg-slate-50 dark:bg-slate-900/50 overflow-y-auto max-h-[60vh] space-y-3">
        @if($selectedSubData['status'] === 'done')
        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900 text-green-700 dark:text-green-400 px-4 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2">
          <x-heroicon-m-check-circle class="w-5 h-5"/> {{ __('Telah Disetujui') }}
        </div>
        @elseif($selectedSubData['status'] === 'rejected')
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900 text-red-700 dark:text-red-400 px-4 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2">
          <x-heroicon-m-x-circle class="w-5 h-5"/> {{ __('Telah Ditolak') }}
        </div>
        @endif

        <img src="{{ $selectedSubData['image'] }}" alt="Screenshot" class="max-w-full rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm"/>

        {{-- Komentar tester --}}
        @if(!empty($selectedSubData['catatan_tester']))
        <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-3">
          <p class="text-[10px] font-bold text-indigo-500 mb-1">💬 {{ __('KOMENTAR TESTER') }}</p>
          <p class="text-sm text-slate-700">{{ $selectedSubData['catatan_tester'] }}</p>
        </div>
        @endif

        {{-- Input alasan tolak --}}
        <div>
          <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">{{ __('Alasan Tolak (opsional)') }}</label>
          <textarea wire:model="alasanTolak"
            rows="2"
            placeholder="{{ __('Contoh: Screenshot tidak jelas, mohon ulangi...') }}"
            class="w-full text-sm border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-xl px-3 py-2 focus:outline-none focus:border-blue-400 resize-none"></textarea>
        </div>
      </div>

      {{-- Footer --}}
      <div class="p-5 border-t border-slate-100 dark:border-slate-700 bg-white dark:bg-slate-800 flex gap-3">
        <button wire:click="rejectSubmission" class="flex-1 py-3 rounded-xl border border-red-200 bg-red-50 text-red-600 font-bold hover:bg-red-100">
          ✗ {{ __('Tolak') }}
        </button>
        <button wire:click="acceptSubmission" class="flex-1 py-3 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-sm">
          ✓ {{ __('ACC (Setuju)') }}
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
        title: '{{ __('Selesaikan Misi Sekarang?') }}',
        html: `<div class="text-left text-sm space-y-2 px-2">
          <p class="font-bold text-slate-700">{{ __('Aturan yang akan dijalankan:') }}</p>
          <ul class="list-disc ml-5 space-y-1.5 text-slate-600">
            <li>{{ __('Semua tester Aktif/Progress otomatis menjadi Selesai.') }}</li>
            <li>{{ __('Tugas yang masih Pending otomatis di-ACC (Done).') }}</li>
            <li>{{ __('Point Reward & Badge +1 langsung dikirim ke tester.') }}</li>
            <li>{{ __('Status Kampanye ini akan resmi ditutup (Selesai).') }}</li>
          </ul>
        </div>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#7c3aed',
        cancelButtonColor: '#64748b',
        confirmButtonText: '🏁 {{ __('Ya, Selesaikan!') }}',
        cancelButtonText: '{{ __('Batal') }}',
    }).then(r => { if (r.isConfirmed) @this.finishMission() });
}
</script>
</x-filament-panels::page>
