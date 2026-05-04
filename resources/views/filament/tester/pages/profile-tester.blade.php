<x-filament-panels::page>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<style>
.prof-page, .prof-page * { font-family: 'Inter', sans-serif; }
.font-mono-num { font-family: 'JetBrains Mono', monospace !important; }
.fi-main { background-color: #f8fafc !important; }
.fi-page { padding: 0 !important; }
.fi-page-header-heading { display: none !important; }
</style>
@endpush

@php $stats = $this->getStats(); @endphp

<div class="prof-page">
  <div class="px-6 py-6">

    {{-- ═══════════ HERO BANNER (sama persis dengan tester dashboard) ═══════════ --}}
    <div class="w-full rounded-2xl p-6 mb-6 relative overflow-hidden"
         style="background:linear-gradient(135deg,#0ea5e9 0%,#06b6d4 40%,#2563eb 100%);
                box-shadow:0 8px 32px rgba(14,165,233,0.25);">

      {{-- Dekorasi lingkaran --}}
      <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full opacity-10" style="background:#ffffff;"></div>
      <div class="absolute right-16 -bottom-10 w-28 h-28 rounded-full opacity-10" style="background:#ffffff;"></div>
      <div class="absolute right-4 top-4 w-16 h-16 rounded-full opacity-5" style="background:#ffffff;"></div>

      {{-- Konten utama --}}
      <div class="relative z-10 flex items-center justify-between flex-wrap gap-4">
        <div>
          <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#e0f2fe;letter-spacing:0.12em;">POIN KAMU</p>
          <div class="flex items-baseline gap-2 mb-2">
            <span class="font-mono-num font-bold text-white" style="font-size:48px;line-height:1;">{{ number_format($stats['point']) }}</span>
            <span class="text-xl font-semibold" style="color:#bae6fd;opacity:0.85;">pts</span>
          </div>
          <div class="flex items-center gap-2 flex-wrap">
            <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full"
                  style="background:rgba(255,255,255,0.2);color:#ffffff;backdrop-filter:blur(4px);">
              ⭐ {{ $stats['badge'] > 0 ? 'Experienced Tester' : 'Novice Tester' }}
            </span>
            <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full"
                  style="background:rgba(255,255,255,0.15);color:#e0f2fe;">
              <span class="w-1.5 h-1.5 rounded-full inline-block" style="background:#fbbf24;"></span>
              {{ $stats['badge'] }} badge diraih
            </span>
          </div>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
          <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold"
                  style="background:rgba(255,255,255,0.2);color:#ffffff;border:1px solid rgba(255,255,255,0.3);backdrop-filter:blur(4px);">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Riwayat
          </button>
          <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold"
                  style="background:#ffffff;color:#0ea5e9;box-shadow:0 2px 8px rgba(0,0,0,0.1);">
            Tukar Poin
          </button>
        </div>
      </div>

      {{-- Mini stats --}}
      <div class="relative z-10 grid grid-cols-2 sm:flex sm:items-center gap-4 sm:gap-6 mt-5 pt-4"
           style="border-top:1px solid rgba(255,255,255,0.2);">
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ $stats['misi_selesai'] }}</p>
          <p class="text-xs opacity-70" style="color:#e0f2fe;">Misi Selesai</p>
        </div>
        <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ $stats['badge'] }}</p>
          <p class="text-xs opacity-70" style="color:#e0f2fe;">Badge</p>
        </div>
        <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ $stats['total_misi'] }}</p>
          <p class="text-xs opacity-70" style="color:#e0f2fe;">Aktif Sekarang</p>
        </div>
        <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ $stats['member_since'] }}</p>
          <p class="text-xs opacity-70" style="color:#e0f2fe;">Member Sejak</p>
        </div>
      </div>
    </div>

    {{-- ═══════════ EDIT FORM ═══════════ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
      <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#e0f2fe;">
          <svg class="w-4 h-4" style="color:#0ea5e9;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
          </svg>
        </div>
        <div>
          <h2 class="font-bold text-slate-800 text-sm">Edit Profil</h2>
          <p class="text-slate-400 text-xs">Perbarui nama, email, atau password akun Anda</p>
        </div>
      </div>

      <div class="p-6">
        <form wire:submit="save">
          {{ $this->form }}
          <div class="mt-6 flex justify-end">
            <button type="submit"
              class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white transition"
              style="background:linear-gradient(135deg,#0ea5e9,#2563eb);box-shadow:0 4px 12px rgba(14,165,233,0.3);">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
              </svg>
              Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<x-filament-actions::modals />
</x-filament-panels::page>
