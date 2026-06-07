<x-filament-panels::page>

  @push('styles')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
  <style>
    .dev-page,
    .dev-page * {
      font-family: 'Inter', sans-serif;
    }

    .font-sora {
      font-family: 'Inter', sans-serif !important;
    }

    .font-mono-data {
      font-family: 'Inter', sans-serif !important;
    }

    .dev-stat-card {
      background: #fff;
      border: 1px solid #f1f5f9;
      border-radius: 1rem;
      padding: 1rem;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dev-stat-card:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
    }

    .dev-panel {
      background: #fff;
      border: 1px solid #f1f5f9;
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, .06);
    }

    .dev-panel-header {
      padding: 1rem 1.25rem;
      border-bottom: 1px solid #f1f5f9;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 0.75rem;
    }

    .prog-track {
      width: 100%;
      height: 6px;
      background: #f1f5f9;
      border-radius: 9999px;
      overflow: hidden;
      margin-top: 12px;
    }

    .prog-fill {
      height: 100%;
      border-radius: 9999px;
      transition: width 1s ease;
      width: 0;
    }

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

    .status-progress {
      background: #f0fdf4;
      color: #15803d;
      border: 1px solid #bbf7d0;
    }

    .status-pending {
      background: #fffbeb;
      color: #b45309;
      border: 1px solid #fde68a;
    }

    .status-selesai {
      background: #faf5ff;
      color: #7e22ce;
      border: 1px solid #e9d5ff;
    }

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

    .icon-blue {
      background: #eff6ff;
      color: #2563eb;
    }

    .icon-amber {
      background: #fffbeb;
      color: #d97706;
    }

    .icon-purple {
      background: #faf5ff;
      color: #7e22ce;
    }

    .btn-detail {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 5px 12px;
      font-size: 12px;
      font-weight: 600;
      color: #64748b;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      background: transparent;
      cursor: pointer;
      transition: all .15s;
    }

    .btn-detail:hover {
      background: #eff6ff;
      border-color: #bfdbfe;
      color: #2563eb;
    }

    .day-cell {
      border-radius: 5px;
      display: flex;
      align-items: flex-end;
      justify-content: center;
      padding-bottom: 2px;
      height: 32px;
    }

    .day-done {
      background: #dbeafe;
    }

    .day-today {
      background: #2563eb;
    }

    .day-future {
      background: #f1f5f9;
    }

    .day-num {
      font-size: 8px;
      font-weight: 600;
    }

    .day-done .day-num {
      color: #1d4ed8;
    }

    .day-today .day-num {
      color: #fff;
      font-weight: 800;
    }

    .day-future .day-num {
      color: #94a3b8;
    }

    .dev-sort-btn {
      display: inline-flex;
      align-items: center;
      gap: 3px;
      background: none;
      border: none;
      cursor: pointer;
      font-size: .75rem;
      font-weight: 600;
      color: #94a3b8;
      text-transform: uppercase;
      letter-spacing: .07em;
      padding: 0;
      transition: color 0.2s;
      font-family: 'Inter', sans-serif;
      white-space: nowrap;
    }

    .dev-sort-btn:hover {
      color: #2563eb;
    }

    .dev-sort-btn.active {
      color: #2563eb;
    }

    .dev-sort-icon {
      font-size: .95rem !important;
      line-height: 1;
    }

    .dev-table {
      width: 100%;
      border-collapse: collapse;
    }

    .dev-table th {
      background: #f8fafc;
      padding: 0.75rem 1.25rem;
      font-size: 0.7rem;
      font-weight: 600;
      color: #94a3b8;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      text-align: left;
      border-bottom: 1px solid #f1f5f9;
      white-space: nowrap;
    }

    .dev-table td {
      padding: 0.875rem 1.25rem;
      font-size: 0.8125rem;
      border-bottom: 1px solid #f8fafc;
      color: #475569;
      white-space: nowrap;
    }

    .tbl-row {
      transition: background .15s;
    }

    .tbl-row:hover td {
      background: #fafafa;
    }

    .modal-overlay {
      position: fixed;
      inset: 0;
      z-index: 60;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 16px;
    }

    .modal-backdrop {
      position: absolute;
      inset: 0;
      background: rgba(15, 23, 42, .5);
      backdrop-filter: blur(4px);
    }

    .modal-box {
      position: relative;
      z-index: 1;
      background: #fff;
      border-radius: 20px;
      width: 100%;
      max-width: 520px;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 24px 64px rgba(0, 0, 0, .18);
    }

    @keyframes modalIn {
      from {
        opacity: 0;
        transform: scale(.94) translateY(-10px);
      }

      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    .modal-animate {
      animation: modalIn .26s cubic-bezier(.34, 1.56, .64, 1) forwards;
    }

    .form-input,
    .form-textarea {
      width: 100%;
      padding: 10px 14px;
      font-size: 13.5px;
      color: #1e293b;
      background: #fff;
      border: 1.5px solid #e2e8f0;
      border-radius: 12px;
      transition: border-color .2s, box-shadow .2s;
      outline: none;
      font-family: inherit;
    }

    .form-input:focus,
    .form-textarea:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    .form-input.with-icon {
      padding-left: 38px;
    }

    .form-textarea {
      resize: none;
    }

    .text-brand-gradient {
      background: linear-gradient(135deg, #1d4ed8, #2563eb);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
  </style>
  @endpush

  <div x-data="devDashboard()" x-init="initProgressBars()" class="dev-page space-y-7">

    {{-- Welcome Row --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-2xl font-black text-slate-800">{{ __('Selamat datang kembali,') }} <span class="text-brand-gradient">Developer!</span> 👋</h1>
        <p class="text-slate-500 text-sm mt-1.5">{{ __('Berikut adalah ringkasan pengujian Anda hari ini.') }}</p>
      </div>
      <a href="{{ url('developer/misis/create') }}"
        class="shrink-0 inline-flex items-center gap-2 px-4 py-2.5 text-sm font-bold text-white rounded-xl"
        style="background:linear-gradient(135deg,#1d4ed8,#2563eb);box-shadow:0 4px 14px rgba(37,99,235,.3);">
        <x-heroicon-o-plus class="w-4 h-4" /> {{ __('Test Case Baru') }}
      </a>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-5">
      <div class="dev-stat-card" style="border-top:4px solid #2563eb;">
        <div class="flex items-start justify-between mb-5">
          <p class="text-slate-400 font-bold uppercase tracking-widest" style="font-size:10.5px;">{{ __('Pengujian Aktif') }}</p>
          <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#eff6ff;">
            <x-heroicon-o-play-circle class="w-5 h-5 text-blue-600" />
          </div>
        </div>
        <p class="font-black text-slate-800" style="font-size:48px;line-height:1;">{{ $statAktif }}</p>
        <div class="mt-3 flex items-center gap-2">
          <span class="text-green-500 text-xs font-semibold"><x-heroicon-m-arrow-trending-up class="w-3 h-3 inline" /> +1</span>
          <span class="text-slate-400 text-xs">{{ __('dari bulan lalu') }}</span>
        </div>
        <div class="mt-4 prog-track">
          <div class="prog-fill bg-blue-500" data-target="{{ $statAktifPercent }}%"></div>
        </div>
        <p class="text-slate-400 mt-1.5" style="font-size:11px;">{{ $statAktifNote }}</p>
      </div>

      <div class="dev-stat-card" style="border-top:4px solid #22c55e;">
        <div class="flex items-start justify-between mb-5">
          <p class="text-slate-400 font-bold uppercase tracking-widest" style="font-size:10.5px;">{{ __('Pengujian Selesai') }}</p>
          <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#f0fdf4;">
            <x-heroicon-o-check-circle class="w-5 h-5 text-green-600" />
          </div>
        </div>
        <p class="font-black text-slate-800" style="font-size:48px;line-height:1;">{{ $statSelesai }}</p>
        <div class="mt-3 flex items-center gap-2">
          <span class="text-green-500 text-xs font-semibold"><x-heroicon-m-check class="w-3 h-3 inline" /> {{ __('Lulus') }}</span>
          <span class="text-slate-400 text-xs">Google Play Console</span>
        </div>
        <div class="mt-4 prog-track">
          <div class="prog-fill bg-green-500" data-target="{{ $statSelesaiPercent }}%"></div>
        </div>
        <p class="text-slate-400 mt-1.5" style="font-size:11px;">{{ $statSelesaiNote }}</p>
      </div>

      <div class="dev-stat-card" style="border-top:4px solid #a855f7;">
        <div class="flex items-start justify-between mb-5">
          <p class="text-slate-400 font-bold uppercase tracking-widest" style="font-size:10.5px;">{{ __('Total Tester Direkrut') }}</p>
          <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#faf5ff;">
            <x-heroicon-o-user-group class="w-5 h-5 text-purple-600" />
          </div>
        </div>
        <p class="font-black text-slate-800" style="font-size:48px;line-height:1;">{{ $statTester }}</p>
        <div class="mt-3 flex items-center gap-2">
          <span class="text-purple-500 text-xs font-semibold"><x-heroicon-m-users class="w-3 h-3 inline" /> {{ __('Aktif') }}</span>
          <span class="text-slate-400 text-xs">{{ __('dari seluruh kampanye') }}</span>
        </div>
        <div class="mt-4 prog-track">
          <div class="prog-fill bg-purple-500" data-target="{{ $statTesterPercent }}%"></div>
        </div>
        <p class="text-slate-400 mt-1.5" style="font-size:11px;">{{ $statTesterNote }}</p>
      </div>
    </div>

    {{-- 14-Day Tracker --}}
    <div class="dev-panel">
      <div class="dev-panel-header">
        <div>
          <h2 class="text-slate-800 font-bold text-base">{{ __('Pelacak Progres 14 Hari') }}</h2>
          <p class="text-slate-500 text-xs mt-0.5">{{ __('Pantau keaktifan harian setiap sesi pengujian aktif') }}</p>
        </div>
        <div class="flex items-center gap-4">
          <span class="flex items-center gap-1.5 text-xs text-slate-500">
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#dbeafe;"></span>{{ __('Aktif') }}
          </span>
          <span class="flex items-center gap-1.5 text-xs text-slate-500">
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#2563eb;"></span>{{ __('Hari Ini') }}
          </span>
          <span class="flex items-center gap-1.5 text-xs text-slate-500">
            <span class="inline-block w-2.5 h-2.5 rounded-sm" style="background:#f1f5f9;"></span>{{ __('Mendatang') }}
          </span>
        </div>
      </div>
      <div class="px-6 py-5 space-y-6">
        @foreach ($kampanyeList as $idx => $k)
        @if ($idx > 0)
        <hr style="border:none;border-top:1px solid #f1f5f9;">@endif
        <div>
          <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-3">
              @if($k['logo'])
              <img src="/storage/{{ $k['logo'] }}" alt="Logo" class="w-9 h-9 rounded-xl object-cover flex-shrink-0">
              @else
              <div class="app-icon icon-{{ $k['warna'] }}">{{ $k['inisial'] }}</div>
              @endif
              <div>
                <p class="text-slate-800 text-sm font-semibold">{{ $k['nama'] }}</p>
                <p class="text-slate-500" style="font-size:11px;">
                  {{ $k['versi'] }} &middot;
                  @if($k['status']==='progress') {{ __('Hari ke-:aktif dari :total', ['aktif' => $k['hariAktif'], 'total' => $k['totalHari']]) }}
                  @else {{ __('Menunggu konfirmasi tester') }} @endif
                </p>
              </div>
            </div>
            <span class="status-badge status-{{ $k['status'] }}">
              @if($k['status']==='progress')<span class="inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span> {{ __('DIPROSES') }}
              @elseif($k['status']==='pending')<span class="inline-block w-1.5 h-1.5 bg-amber-500 rounded-full"></span> {{ __('PENDING') }}
              @else<x-heroicon-m-check class="w-2.5 h-2.5" /> {{ __('SELESAI') }} @endif
            </span>
          </div>
          <div class="grid gap-1" style="grid-template-columns:repeat(14,1fr);">
            @for ($h = 1; $h <= 14; $h++)
              @php
              $cls='day-future' ;
              if ($k['status']==='progress' ) {
              if ($h < $k['hariAktif']) $cls='day-done' ;
              elseif ($h===$k['hariAktif']) $cls='day-today' ;
              } elseif ($k['status']==='selesai' ) { $cls='day-done' ; }
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
        <h2 class="text-slate-800 font-bold text-base">{{ __('Aplikasi Terbaru') }}</h2>
        <p class="text-slate-500 text-xs mt-0.5">{{ __('Daftar aplikasi yang sedang atau sudah dalam sesi pengujian') }}</p>
      </div>
      <div class="flex items-center gap-2 flex-wrap">
        <div class="relative">
          <x-heroicon-o-calendar-days class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none" />
          <input type="date" x-model="filterTanggal" class="text-xs rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200"
            style="padding:7px 12px 7px 30px;background:#f8fafc;border:1px solid #e2e8f0;color:#64748b;width:148px;" />
        </div>
        <button class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold text-blue-600 rounded-xl hover:bg-blue-50 transition"
          style="border:1px solid #bfdbfe;">
          {{ __('Lihat Semua') }} <x-heroicon-m-arrow-right class="w-3 h-3" />
        </button>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="dev-table min-w-[800px]">
        <thead>
          <tr>
            <th>
              <button class="dev-sort-btn" :class="sortCol==='nama'?'active':''" @click="setSort('nama')">
                {{ __('Nama Aplikasi') }}
                <span class="material-symbols-outlined dev-sort-icon" x-text="sortCol!=='nama' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
              </button>
            </th>
            <th>{{ __('Platform') }}</th>
            <th>
              <button class="dev-sort-btn" :class="sortCol==='status'?'active':''" @click="setSort('status')">
                {{ __('Status & Progres') }}
                <span class="material-symbols-outlined dev-sort-icon" x-text="sortCol!=='status' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
              </button>
            </th>
            <th>
              <button class="dev-sort-btn" :class="sortCol==='tanggal'?'active':''" @click="setSort('tanggal')">
                {{ __('Tanggal Mulai') }}
                <span class="material-symbols-outlined dev-sort-icon" x-text="sortCol!=='tanggal' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
              </button>
            </th>
            <th>{{ __('Aksi') }}</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($aplikasiList as $a)
          <tr class="tbl-row sortable-row" data-nama="{{ strtolower($a['nama']) }}" data-status="{{ $a['status'] }}" data-tanggal="{{ strtotime($a['tanggal']) }}">
            <td>
              <div class="flex items-center gap-3">
                @if($a['logo'])
                <img src="/storage/{{ $a['logo'] }}" alt="Logo" class="w-9 h-9 rounded-xl object-cover flex-shrink-0">
                @else
                <div class="app-icon icon-{{ $a['warna'] }}">{{ $a['inisial'] }}</div>
                @endif
                <div>
                  <p class="text-slate-800 font-semibold text-sm">{{ $a['nama'] }}</p>
                  <p class="text-slate-400" style="font-size:11px;">{{ $a['versi'] }}</p>
                </div>
              </div>
            </td>
            <td>
              <div class="flex items-center gap-1.5">
                <x-heroicon-o-device-phone-mobile class="w-4 h-4 text-green-500" />
                <span class="text-slate-600 text-xs">Android</span>
              </div>
            </td>
            <td>
              <div style="min-width:180px;" class="space-y-2">
                <div class="flex items-center gap-2">
                  <span class="status-badge status-{{ $a['status'] }}">
                    @if($a['status']==='progress')<span class="inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                    @elseif($a['status']==='pending')<span class="inline-block w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                    @else<x-heroicon-m-check class="w-2.5 h-2.5" />@endif
                    {{ $a['label'] }}
                  </span>
                  <span class="text-slate-500 text-xs">{{ $a['tester'] }} {{ __('Tester') }}</span>
                </div>
                <div class="prog-track mt-0">
                  <div class="prog-fill @if($a['status']==='progress') bg-green-500 @elseif($a['status']==='pending') bg-amber-400 @else bg-purple-500 @endif"
                    data-target="{{ $a['persen'] }}%"></div>
                </div>
              </div>
            </td>
            <td class="text-slate-500" style="font-size:12px;">{{ $a['tanggal'] }}</td>
            <td>
              <button class="btn-detail"><x-heroicon-o-eye class="w-3.5 h-3.5" /> {{ __('Detail') }}</button>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-6 py-10 text-center text-slate-400 text-sm">
              <x-heroicon-o-inbox class="w-8 h-8 mx-auto mb-2 text-slate-200" />
              {{ __('Belum ada aplikasi.') }}
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="flex items-center justify-between px-6 py-4" style="border-top:1px solid #f1f5f9;">
      <p class="text-slate-400 text-xs">{{ __('Menampilkan') }} <strong class="text-slate-600">{{ count($aplikasiList) }}</strong> {{ __('aplikasi') }}</p>
      <div class="flex items-center gap-1.5">
        <button class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400" style="border:1px solid #e2e8f0;" disabled>
          <x-heroicon-m-chevron-left class="w-3 h-3" />
        </button>
        <button class="w-7 h-7 rounded-lg text-white text-xs font-bold flex items-center justify-center" style="background:#2563eb;">1</button>
        <button class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400" style="border:1px solid #e2e8f0;" disabled>
          <x-heroicon-m-chevron-right class="w-3 h-3" />
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
        sortCol: 'tanggal',
        sortDir: 'desc',

        init() {
            this.$watch('sortCol', () => this.updateSort());
            this.$watch('sortDir', () => this.updateSort());
        },

        setSort(col) {
            if (this.sortCol === col) {
                this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortCol = col;
                this.sortDir = 'asc';
            }
        },

        updateSort() {
            const tbody = document.querySelector('.dev-table tbody');
            if (!tbody) return;
            const rows = Array.from(tbody.querySelectorAll('.sortable-row'));

            rows.sort((a, b) => {
                let va, vb;
                if (this.sortCol === 'nama') {
                    va = (a.dataset.nama || '');
                    vb = (b.dataset.nama || '');
                } else if (this.sortCol === 'status') {
                    va = (a.dataset.status || '');
                    vb = (b.dataset.status || '');
                } else if (this.sortCol === 'tanggal') {
                    va = +(a.dataset.tanggal || 0);
                    vb = +(b.dataset.tanggal || 0);
                } else return 0;
                
                return va < vb ? (this.sortDir === 'asc' ? -1 : 1) : (va > vb ? (this.sortDir === 'asc' ? 1 : -1) : 0);
            });

            rows.forEach(r => tbody.appendChild(r));
        },

        initProgressBars() {
          this.$nextTick(() => {
            document.querySelectorAll('.prog-fill').forEach(el => {
              const t = el.dataset.target || '0%';
              el.style.width = '0%';
              setTimeout(() => {
                el.style.transition = 'width 900ms ease';
                el.style.width = t;
              }, 400);
            });
          });
        },

      };
    }
  </script>
  @endpush

</x-filament-panels::page>