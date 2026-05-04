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

<div class="prof-page">
  <div class="px-6 py-6">

    {{-- ═══════════ HERO BANNER ═══════════ --}}
    <div class="w-full rounded-2xl p-6 mb-6 relative overflow-hidden"
         style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#2563eb 100%);
                box-shadow:0 8px 32px rgba(37,99,235,0.25);">

      {{-- Dekorasi lingkaran --}}
      <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full opacity-10" style="background:#ffffff;"></div>
      <div class="absolute right-16 -bottom-10 w-28 h-28 rounded-full opacity-10" style="background:#ffffff;"></div>
      <div class="absolute right-4 top-4 w-16 h-16 rounded-full opacity-5" style="background:#ffffff;"></div>

      {{-- Konten utama --}}
      <div class="relative z-10 flex items-center justify-between flex-wrap gap-4">
        <div>
          <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#bfdbfe;letter-spacing:0.12em;">ADMIN PANEL</p>
          <div class="flex items-baseline gap-2 mb-2">
            <span class="font-mono-num font-bold text-white" style="font-size:36px;line-height:1;">{{ Auth::user()->name }}</span>
          </div>
          <div class="flex items-center gap-2 flex-wrap">
            <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full"
                  style="background:rgba(255,255,255,0.2);color:#ffffff;">
              🛡️ Administrator
            </span>
            <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full"
                  style="background:rgba(255,255,255,0.15);color:#dbeafe;">
              <span class="w-1.5 h-1.5 rounded-full inline-block" style="background:#34d399;"></span>
              Bergabung {{ Auth::user()->created_at->format('M Y') }}
            </span>
          </div>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
          <div class="text-center px-4">
            <p class="font-mono-num text-2xl font-bold text-white">{{ \App\Models\User::count() }}</p>
            <p class="text-xs opacity-70" style="color:#dbeafe;">Total User</p>
          </div>
          <div class="w-px h-10 opacity-20" style="background:#ffffff;"></div>
          <div class="text-center px-4">
            <p class="font-mono-num text-2xl font-bold text-white">{{ \App\Models\Misi::count() }}</p>
            <p class="text-xs opacity-70" style="color:#dbeafe;">Kampanye</p>
          </div>
          <div class="w-px h-10 opacity-20" style="background:#ffffff;"></div>
          <div class="text-center px-4">
            <p class="font-mono-num text-2xl font-bold text-white">{{ \App\Models\Pembayaran::where('status','accepted')->count() }}</p>
            <p class="text-xs opacity-70" style="color:#dbeafe;">Transaksi</p>
          </div>
        </div>
      </div>

      {{-- Mini stats --}}
      <div class="relative z-10 grid grid-cols-2 sm:flex sm:items-center gap-4 sm:gap-6 mt-5 pt-4"
           style="border-top:1px solid rgba(255,255,255,0.2);">
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ \App\Models\User::where('role',\App\Enums\UserRole::developer)->count() }}</p>
          <p class="text-xs opacity-70" style="color:#dbeafe;">Developer</p>
        </div>
        <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ \App\Models\User::where('role',\App\Enums\UserRole::tester)->count() }}</p>
          <p class="text-xs opacity-70" style="color:#dbeafe;">Tester</p>
        </div>
        <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ \App\Models\Misi::whereIn('status',['open','progress'])->count() }}</p>
          <p class="text-xs opacity-70" style="color:#dbeafe;">Misi Aktif</p>
        </div>
        <div class="hidden sm:block w-px h-8 opacity-20" style="background:#ffffff;"></div>
        <div>
          <p class="font-mono-num text-lg font-bold text-white">{{ \App\Models\Pembayaran::where('status','waiting')->count() }}</p>
          <p class="text-xs opacity-70" style="color:#dbeafe;">Pending</p>
        </div>
      </div>
    </div>

    {{-- ═══════════ EDIT FORM ═══════════ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
      <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#eff6ff;">
          <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
          </svg>
        </div>
        <div>
          <h2 class="font-bold text-slate-800 text-sm">Edit Profil</h2>
          <p class="text-slate-400 text-xs">Perbarui informasi akun Anda</p>
        </div>
      </div>

      <div class="p-6">
        <form wire:submit="save">
          {{ $this->form }}
          <div class="mt-6 flex justify-end">
            <button type="submit"
              class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white transition"
              style="background:linear-gradient(135deg,#1d4ed8,#2563eb);box-shadow:0 4px 12px rgba(37,99,235,0.3);">
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
