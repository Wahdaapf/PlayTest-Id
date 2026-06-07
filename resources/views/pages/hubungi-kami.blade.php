<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('pt-theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ __('Hubungi Kami') }} – PlayTest ID</title>
  <link rel="icon" href="{{ asset('logoheader.png') }}" type="image/png" />
  <meta name="description" content="{{ __('Hubungi tim PlayTest ID untuk pertanyaan, laporan masalah, atau saran. Kami siap membantu Anda.') }}">
  <script>
    (function() {
      var t = localStorage.getItem('pt-theme');
      if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      }
    })();
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'sans-serif'] },
          colors: {
            brand: { 50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',300:'#93c5fd',400:'#60a5fa',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8',800:'#1e40af',900:'#1e3a8a',950:'#172554' }
          }
        }
      }
    };
  </script>
  <style>
    body { font-family: 'Inter', sans-serif; }
    /* Admin-style cards */
    .page-card {
      background: #ffffff;
      border-radius: 1rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.06);
      border: 1px solid #f1f5f9;
    }
    .dark .page-card {
      background: #1e293b;
      border-color: #334155;
      box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    /* Contact info card – accent left border like mini-kamp-card */
    .contact-card {
      background: #f8fafc;
      border-radius: 0.75rem;
      border: 1px solid #f1f5f9;
      padding: 1rem;
      transition: background 0.15s;
    }
    .dark .contact-card {
      background: #0f172a;
      border-color: #1e293b;
    }
    .contact-card:hover { background: #f1f5f9; }
    .dark .contact-card:hover { background: #1e293b; }
    /* Form card */
    .form-card {
      background: #ffffff;
      border-radius: 1rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.06);
      border: 1px solid #f1f5f9;
      border-top: 4px solid #f97316;
      padding: 2rem;
    }
    .dark .form-card {
      background: #1e293b;
      border-color: #334155;
      border-top-color: #fb923c;
      box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    /* Input styles */
    .form-input {
      width: 100%;
      padding: 0.625rem 1rem;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 0.75rem;
      font-size: 0.875rem;
      color: #1e293b;
      transition: border-color 0.15s, box-shadow 0.15s;
      outline: none;
    }
    .dark .form-input { background: #0f172a; border-color: #334155; color: #f1f5f9; }
    .form-input:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.12); }
    .dark .form-input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.15); }
    .form-input::placeholder { color: #94a3b8; }
    /* Success message */
    .success-msg { display: none; }
    .success-msg.show { display: flex; }
    /* Theme toggle */
    .theme-toggle { position:relative; width:48px; height:26px; background:linear-gradient(135deg,#e2e8f0,#cbd5e1); border-radius:999px; border:none; cursor:pointer; transition:background .3s; flex-shrink:0; }
    .dark .theme-toggle { background:linear-gradient(135deg,#334155,#1e293b); }
    .theme-toggle-knob { position:absolute; top:3px; left:3px; width:20px; height:20px; border-radius:50%; background:#fff; box-shadow:0 1px 4px rgba(0,0,0,.2); transition:transform .3s cubic-bezier(.4,0,.2,1); display:flex; align-items:center; justify-content:center; font-size:11px; }
    .dark .theme-toggle-knob { transform:translateX(22px); background:#1e293b; }
    .icon-sun { color:#f59e0b; } .icon-moon { color:#60a5fa; position:absolute; opacity:0; }
    .dark .icon-sun { opacity:0; } .dark .icon-moon { opacity:1; }

    /* ====== Profile Card styling elements to match admin card ====== */
    @keyframes prof-float       { 0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(20px,-15px) scale(1.08)} }
    @keyframes prof-float-rev   { 0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(-25px,20px) scale(0.92)} }
    @keyframes prof-gradient    { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
    @keyframes prof-aurora {
      0%   { transform: translate(-10%,-10%) rotate(0deg)   scale(1.1); }
      33%  { transform: translate(8%,-6%)   rotate(120deg) scale(1.25); }
      66%  { transform: translate(-6%,10%)  rotate(240deg) scale(1.15); }
      100% { transform: translate(-10%,-10%) rotate(360deg) scale(1.1); }
    }
    @keyframes prof-conic { to { transform: rotate(360deg); } }
    @keyframes prof-grid-pan {
      0%   { background-position: 0 0, 0 0; }
      100% { background-position: 56px 56px, 56px 56px; }
    }
    @keyframes prof-particle {
      0%   { transform: translateY(0) translateX(0); opacity: 0; }
      10%  { opacity: .9; }
      90%  { opacity: .9; }
      100% { transform: translateY(-220px) translateX(var(--drift,20px)); opacity: 0; }
    }
    @keyframes prof-shoot {
      0%   { transform: translate3d(0,0,0) rotate(18deg); opacity: 0; }
      8%   { opacity: 1; }
      100% { transform: translate3d(620px,200px,0) rotate(18deg); opacity: 0; }
    }
    @keyframes prof-twinkle {
      0%,100% { opacity: .2; transform: scale(1); }
      50%     { opacity: 1;  transform: scale(1.6); }
    }

    .prof-hero {
      position: relative;
      background: linear-gradient(135deg,#0a1850 0%,#13297a 25%,#1d4ed8 55%,#2563eb 80%,#3b82f6 100%);
      background-size: 220% 220%;
      animation: prof-gradient 14s ease infinite;
      box-shadow: 0 20px 60px -15px rgba(37,99,235,.35), 0 0 0 1px rgba(255,255,255,.06) inset;
      isolation: isolate;
      overflow: hidden;
    }
    .prof-blob       { animation: prof-float 9s ease-in-out infinite; will-change: transform; filter: blur(2px); }
    .prof-blob-rev   { animation: prof-float-rev 11s ease-in-out infinite; will-change: transform; filter: blur(2px); }

    /* Aurora mesh */
    .prof-aurora {
      position:absolute; inset:-30%;
      background:
        radial-gradient(40% 35% at 20% 30%, rgba(96,165,250,.55), transparent 60%),
        radial-gradient(35% 30% at 80% 20%, rgba(167,139,250,.45), transparent 60%),
        radial-gradient(45% 40% at 60% 80%, rgba(34,211,238,.40), transparent 60%),
        radial-gradient(30% 25% at 15% 85%, rgba(244,114,182,.35), transparent 60%);
      filter: blur(40px);
      animation: prof-aurora 22s ease-in-out infinite;
      mix-blend-mode: screen;
      pointer-events:none;
    }
    /* Slow rotating conic glow */
    .prof-conic {
      position:absolute; width:520px; height:520px; left:-160px; bottom:-200px;
      background: conic-gradient(from 0deg, rgba(59,130,246,0), rgba(96,165,250,.35), rgba(167,139,250,.25), rgba(34,211,238,.30), rgba(59,130,246,0));
      border-radius:50%;
      filter: blur(30px);
      animation: prof-conic 28s linear infinite;
      opacity:.7; pointer-events:none;
    }
    .prof-conic-2 {
      position:absolute; width:380px; height:380px; right:-120px; top:-140px;
      background: conic-gradient(from 180deg, rgba(244,114,182,0), rgba(244,114,182,.30), rgba(96,165,250,.30), rgba(244,114,182,0));
      border-radius:50%;
      filter: blur(30px);
      animation: prof-conic 34s linear infinite;
      opacity:.6; pointer-events:none;
    }

    .prof-grid-bg {
      background-image:
        linear-gradient(rgba(255,255,255,.07) 1px,transparent 1px),
        linear-gradient(90deg,rgba(255,255,255,.07) 1px,transparent 1px);
      background-size: 28px 28px;
      mask-image: radial-gradient(ellipse at top right, black 30%, transparent 70%);
      animation: prof-grid-pan 18s linear infinite;
    }

    /* Floating particles */
    .prof-particles { position:absolute; inset:0; overflow:hidden; pointer-events:none; }
    .prof-particles span {
      position:absolute; bottom:-10px;
      width:6px; height:6px; border-radius:50%;
      background: radial-gradient(circle, #fff 0%, rgba(255,255,255,.2) 60%, transparent 70%);
      box-shadow: 0 0 12px rgba(255,255,255,.7);
      animation: prof-particle linear infinite;
      opacity:0;
    }

    /* Twinkling stars */
    .prof-stars { position:absolute; inset:0; pointer-events:none; }
    .prof-stars span {
      position:absolute; width:2px; height:2px; border-radius:50%;
      background:#fff !important; box-shadow:0 0 6px #fff, 0 0 12px #fff !important;
      animation: prof-twinkle 3s ease-in-out infinite;
    }

    /* Shooting star */
    .prof-shoot {
      position:absolute; top:18%; left:-20%;
      width:120px; height:2px;
      background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,.9));
      filter: drop-shadow(0 0 6px rgba(147,197,253,.9));
      border-radius:2px;
      animation: prof-shoot 7s ease-in infinite;
      animation-delay: -2s;
      pointer-events:none;
      opacity: 0;
    }
    .prof-shoot.s2 { top:55%; animation-duration: 9s; animation-delay: -5s; opacity: 0; }
  </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 antialiased">

  <!-- Navbar -->
  <header class="fixed top-0 inset-x-0 z-50 bg-white/95 dark:bg-slate-900/95 border-b border-slate-100 dark:border-slate-800 backdrop-blur-sm">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
      <a href="{{ url('/') }}" class="flex items-center">
        <img src="{{ asset('logo.png') }}" alt="PlayTest ID" class="h-10 w-auto"/>
      </a>
      <div class="flex items-center gap-3">
        <a href="{{ url('/') }}" class="text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 transition flex items-center gap-1.5">
          <i class="fa-solid fa-arrow-left text-xs"></i>
          <span class="hidden sm:inline">{{ __('Kembali') }}</span>
        </a>
        <!-- Language Switcher -->
        <div class="flex items-center gap-1 pl-3 border-l border-slate-200 dark:border-slate-700">
          <a href="#" onclick="event.preventDefault(); fetch('/language/switch/en').then(()=>window.location.reload())"
             class="w-8 h-8 flex items-center justify-center rounded-lg text-[10px] font-black transition {{ App::getLocale()=='en' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700' }}">EN</a>
          <a href="#" onclick="event.preventDefault(); fetch('/language/switch/id').then(()=>window.location.reload())"
             class="w-8 h-8 flex items-center justify-center rounded-lg text-[10px] font-black transition {{ App::getLocale()=='id' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700' }}">ID</a>
        </div>
        <!-- Theme toggle -->
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle dark mode">
          <span class="theme-toggle-knob">
            <i class="fa-solid fa-sun icon-sun"></i>
            <i class="fa-solid fa-moon icon-moon"></i>
          </span>
        </button>
      </div>
    </nav>
  </header>

  <!-- Hero -->
  <div class="pt-24 max-w-5xl mx-auto px-4 sm:px-6">
    <div class="prof-hero rounded-3xl text-white py-14 px-4 relative overflow-hidden">
      <!-- Grid overlay -->
      <div class="prof-grid-bg absolute inset-0 opacity-35"></div>
      <!-- Aurora mesh -->
      <div class="prof-aurora"></div>
      <!-- Conic glow -->
      <div class="prof-conic"></div>
      <div class="prof-conic-2"></div>
      
      <!-- Twinkling stars -->
      <div class="prof-stars">
        @for($i=0;$i<18;$i++)
          <span style="top:{{ rand(2,90) }}%; left:{{ rand(2,98) }}%; animation-delay:-{{ ($i*0.23) }}s;"></span>
        @endfor
      </div>

      <!-- Floating particles -->
      <div class="prof-particles">
        @for($i=0;$i<14;$i++)
          @php $dur = rand(7,14); $delay = $i * 0.7; $left = rand(2,98); $size = rand(3,7); $drift = rand(-40,40); @endphp
          <span style="left:{{ $left }}%; width:{{ $size }}px; height:{{ $size }}px; animation-duration:{{ $dur }}s; animation-delay:{{ $delay }}s; --drift:{{ $drift }}px;"></span>
        @endfor
      </div>

      <!-- Shooting stars -->
      <div class="prof-shoot"></div>
      <div class="prof-shoot s2"></div>

      <!-- Floating decorative blobs -->
      <div class="prof-blob absolute -right-12 -top-12 w-48 h-48 rounded-full opacity-20"
           style="background:radial-gradient(circle,#60a5fa,transparent 70%);"></div>
      <div class="prof-blob-rev absolute right-20 -bottom-16 w-40 h-40 rounded-full opacity-15"
           style="background:radial-gradient(circle,#a78bfa,transparent 70%);"></div>

      <!-- Main Content -->
      <div class="relative z-10 max-w-3xl mx-auto text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-xs font-semibold px-4 py-2 rounded-full mb-4 backdrop-blur-sm">
          <i class="fa-solid fa-headset"></i> {{ __('Dukungan') }}
        </div>
        <h1 class="text-3xl sm:text-4xl font-black mb-2">{{ __('Hubungi Kami') }}</h1>
        <p class="text-orange-100 text-sm">{{ __('Tim kami siap membantu Anda 24/7.') }}</p>
      </div>
    </div>
  </div>

  <!-- Content -->
  <main class="max-w-5xl mx-auto px-4 sm:px-6 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      <!-- Contact Info (left) -->
      <div class="space-y-3">
        <!-- Email -->
        <a href="mailto:support@playtestid.com" class="contact-card flex items-start gap-3 block no-underline">
          <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#eff6ff;">
            <i class="fa-solid fa-envelope text-brand-600 text-sm"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ __('Email') }}</p>
            <p class="text-[11px] text-slate-400 dark:text-slate-500">{{ __('Respons dalam 24 jam kerja') }}</p>
            <p class="text-xs text-brand-600 dark:text-brand-400 font-medium mt-0.5 truncate">support@playtestid.com</p>
          </div>
        </a>
        <!-- WhatsApp -->
        <a href="https://wa.me/6281234567890" target="_blank" class="contact-card flex items-start gap-3 block no-underline">
          <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#f0fdf4;">
            <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">WhatsApp</p>
            <p class="text-[11px] text-slate-400 dark:text-slate-500">{{ __('Senin – Jumat, 08.00–17.00 WIB') }}</p>
            <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium mt-0.5">+62 812-3456-7890</p>
          </div>
        </a>
        <!-- Telegram -->
        <a href="https://t.me/playtestid" target="_blank" class="contact-card flex items-start gap-3 block no-underline">
          <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#eff6ff;">
            <i class="fa-brands fa-telegram text-sky-500 text-sm"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">Telegram</p>
            <p class="text-[11px] text-slate-400 dark:text-slate-500">{{ __('Grup komunitas & dukungan') }}</p>
            <p class="text-xs text-sky-500 dark:text-sky-400 font-medium mt-0.5">@playtestid</p>
          </div>
        </a>
        <!-- FAQ -->
        <a href="{{ route('faq') }}" class="contact-card flex items-start gap-3 block no-underline">
          <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#f5f3ff;">
            <i class="fa-solid fa-circle-question text-violet-600 text-sm"></i>
          </div>
          <div class="min-w-0">
            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">FAQ</p>
            <p class="text-[11px] text-slate-400 dark:text-slate-500">{{ __('Cari jawaban di sini dulu') }}</p>
            <p class="text-xs text-violet-600 dark:text-violet-400 font-medium mt-0.5">{{ __('Lihat FAQ') }} →</p>
          </div>
        </a>
      </div>

      <!-- Contact Form (right) -->
      <div class="lg:col-span-2">
        <div class="form-card">
          <div class="mb-5">
            <h2 class="text-base font-bold text-slate-800 dark:text-slate-100">{{ __('Kirim Pesan') }}</h2>
            <p class="text-slate-400 dark:text-slate-500 text-xs mt-0.5">{{ __('Isi formulir di bawah dan kami akan merespons sesegera mungkin.') }}</p>
          </div>

          <!-- Success -->
          <div id="successMsg" class="success-msg items-center gap-3 rounded-xl p-4 mb-5" style="background:#f0fdf4; border:1px solid #bbf7d0;">
            <i class="fa-solid fa-circle-check text-emerald-500 text-lg flex-shrink-0"></i>
            <div>
              <p class="font-semibold text-emerald-700 text-sm">{{ __('Pesan terkirim!') }}</p>
              <p class="text-emerald-600 text-xs">{{ __('Terima kasih. Kami akan menghubungi Anda segera.') }}</p>
            </div>
          </div>

          <form id="contactForm" onsubmit="handleSubmit(event)" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1.5">{{ __('Nama Lengkap') }} <span class="text-red-500">*</span></label>
                <input type="text" required placeholder="{{ __('Masukkan nama Anda') }}" class="form-input"/>
              </div>
              <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1.5">{{ __('Email') }} <span class="text-red-500">*</span></label>
                <input type="email" required placeholder="nama@email.com" class="form-input"/>
              </div>
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1.5">{{ __('Peran Anda') }}</label>
              <select class="form-input">
                <option value="">{{ __('Pilih peran...') }}</option>
                <option>Developer</option>
                <option>Tester</option>
                <option>{{ __('Lainnya') }}</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1.5">{{ __('Subjek') }} <span class="text-red-500">*</span></label>
              <input type="text" required placeholder="{{ __('Topik pesan Anda') }}" class="form-input"/>
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1.5">{{ __('Pesan') }} <span class="text-red-500">*</span></label>
              <textarea required rows="5" placeholder="{{ __('Tuliskan pertanyaan atau pesan Anda di sini...') }}" class="form-input resize-none"></textarea>
            </div>
            <button type="submit" id="submitBtn"
              class="w-full py-2.5 text-white font-bold rounded-xl transition flex items-center justify-center gap-2 text-sm"
              style="background:#2563eb; box-shadow:0 4px 14px rgba(37,99,235,0.3);"
              onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
              <i class="fa-solid fa-paper-plane"></i> {{ __('Kirim Pesan') }}
            </button>
          </form>
        </div>
      </div>

    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-slate-900 text-slate-500 text-center py-6 px-4 text-xs mt-4">
    <p>© 2026 <span class="text-slate-300 font-semibold">PlayTest ID</span>. {{ __('Hak cipta dilindungi undang-undang.') }}</p>
    <div class="flex flex-wrap justify-center gap-4 mt-2">
      <a href="{{ route('kebijakan-privasi') }}" class="hover:text-white transition">{{ __('Kebijakan Privasi') }}</a>
      <a href="{{ route('syarat-ketentuan') }}" class="hover:text-white transition">{{ __('Syarat & Ketentuan') }}</a>
      <a href="{{ route('faq') }}" class="hover:text-white transition">FAQ</a>
      <a href="{{ route('hubungi-kami') }}" class="hover:text-white transition">{{ __('Hubungi Kami') }}</a>
    </div>
  </footer>

  <script>
    function handleSubmit(e) {
      e.preventDefault();
      const btn = document.getElementById('submitBtn');
      btn.disabled = true;
      btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> {{ __("Mengirim...") }}';
      setTimeout(() => {
        document.getElementById('successMsg').classList.add('show');
        document.getElementById('contactForm').reset();
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> {{ __("Kirim Pesan") }}';
        document.getElementById('successMsg').scrollIntoView({ behavior: 'smooth', block: 'center' });
      }, 1500);
    }
    function toggleTheme() {
      const html = document.documentElement;
      if (html.classList.contains('dark')) { html.classList.remove('dark'); localStorage.setItem('pt-theme','light'); }
      else { html.classList.add('dark'); localStorage.setItem('pt-theme','dark'); }
    }
  </script>
</body>
</html>
