<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('pt-theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FAQ – {{ __('Pertanyaan Umum') }} – PlayTest ID</title>
  <link rel="icon" href="{{ asset('logoheader.png') }}" type="image/png" />
  <meta name="description" content="{{ __('Temukan jawaban atas pertanyaan umum seputar PlayTest ID, cara kerja platform, pembayaran, dan misi testing.') }}">
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
    /* Admin-style card */
    .page-card {
      background: #ffffff;
      border-radius: 1rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.06);
      border: 1px solid #f1f5f9;
      overflow: hidden;
    }
    .dark .page-card {
      background: #1e293b;
      border-color: #334155;
      box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    .card-accent-green  { border-top: 4px solid #10b981; }
    .card-accent-blue   { border-top: 4px solid #2563eb; }
    .card-accent-orange { border-top: 4px solid #f59e0b; }
    /* FAQ accordion */
    .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(.4,0,.2,1); }
    .faq-answer.open { max-height: 300px; }
    .faq-icon { transition: transform 0.3s cubic-bezier(.4,0,.2,1); }
    .faq-item.open .faq-icon { transform: rotate(180deg); }
    /* FAQ dividers */
    .faq-item + .faq-item { border-top: 1px solid #f1f5f9; }
    .dark .faq-item + .faq-item { border-top-color: #334155; }
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
    .prof-stars i {
      position:absolute; width:2px; height:2px; border-radius:50%;
      background:#fff; box-shadow:0 0 6px #fff;
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
      animation-delay: 2s;
      pointer-events:none;
    }
    .prof-shoot.s2 { top:55%; animation-duration: 9s; animation-delay: 5s; opacity:.7; }
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
  <div class="pt-24 max-w-3xl mx-auto px-4 sm:px-6">
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
          <i style="top:{{ rand(2,90) }}%; left:{{ rand(2,98) }}%; animation-delay:{{ ($i*0.23) }}s;"></i>
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
          <i class="fa-solid fa-circle-question"></i> {{ __('Bantuan') }}
        </div>
        <h1 class="text-3xl sm:text-4xl font-black mb-2">{{ __('Pertanyaan yang Sering Diajukan') }}</h1>
        <p class="text-emerald-100 text-sm">{{ __('Temukan jawaban atas pertanyaan umum Anda di sini.') }}</p>
      </div>
    </div>
  </div>

  <!-- Content -->
  <main class="max-w-3xl mx-auto px-4 sm:px-6 py-10 space-y-8">

    <!-- Umum -->
    <div>
      <div class="flex items-center gap-2 mb-3">
        <div class="w-6 h-6 rounded-lg flex items-center justify-center" style="background:#eff6ff;">
          <i class="fa-solid fa-globe text-brand-600 text-xs"></i>
        </div>
        <h2 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">{{ __('Umum') }}</h2>
      </div>
      <div class="page-card card-accent-blue">
        @php $faqs_umum = [
          [__('Apa itu PlayTest ID?'), __('PlayTest ID adalah platform kolaborasi yang menghubungkan developer aplikasi Android dengan tester berkualitas di Indonesia. Platform ini membantu developer memenuhi persyaratan Google Play Closed Testing dengan lebih mudah dan efisien.')],
          [__('Apakah PlayTest ID gratis?'), __('PlayTest ID menawarkan berbagai paket, mulai dari paket gratis dengan fitur terbatas hingga paket premium untuk kebutuhan testing yang lebih besar. Lihat halaman Harga untuk detail lengkap.')],
          [__('Bagaimana cara mendaftar?'), __('Klik tombol "Daftar" di pojok kanan atas, pilih peran Anda (Developer atau Tester), isi formulir pendaftaran, dan verifikasi email Anda. Proses ini hanya membutuhkan beberapa menit.')],
        ]; @endphp
        @foreach($faqs_umum as $i => $faq)
        <div class="faq-item" id="faq-u-{{ $i }}">
          <button onclick="toggleFaq('faq-u-{{ $i }}')" class="w-full text-left px-5 py-4 flex items-center justify-between gap-4 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
            <span class="font-semibold text-slate-800 dark:text-slate-100 text-sm">{{ $faq[0] }}</span>
            <i class="fa-solid fa-chevron-down faq-icon text-slate-400 text-xs flex-shrink-0"></i>
          </button>
          <div class="faq-answer" id="faq-u-{{ $i }}-ans">
            <p class="px-5 pb-4 text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ $faq[1] }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Developer -->
    <div>
      <div class="flex items-center gap-2 mb-3">
        <div class="w-6 h-6 rounded-lg flex items-center justify-center" style="background:#eff6ff;">
          <i class="fa-solid fa-code text-brand-600 text-xs"></i>
        </div>
        <h2 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">{{ __('Untuk Developer') }}</h2>
      </div>
      <div class="page-card card-accent-blue">
        @php $faqs_dev = [
          [__('Bagaimana cara membuat kampanye testing?'), __('Setelah login sebagai Developer, masuk ke menu "Kampanye" dan klik "Buat Kampanye Baru". Isi detail aplikasi Anda, termasuk link Play Store, jumlah tester yang dibutuhkan, dan durasi pengujian.')],
          [__('Berapa lama proses Closed Testing berlangsung?'), __('Google mensyaratkan setidaknya 20 tester aktif selama minimal 14 hari. Platform kami membantu Anda mencapai target tersebut dengan menghubungkan Anda ke tester yang tepat.')],
          [__('Bagaimana jika tester tidak menyelesaikan misi?'), __('Sistem kami memiliki mekanisme pengecekan otomatis. Tester yang tidak menyelesaikan misi dalam batas waktu tidak akan mendapatkan reward, dan Anda akan mendapatkan pengganti.')],
          [__('Apakah saya bisa memilih tester tertentu?'), __('Untuk paket premium, Anda dapat menyaring tester berdasarkan kriteria tertentu seperti jenis perangkat, versi Android, dan riwayat testing.')],
        ]; @endphp
        @foreach($faqs_dev as $i => $faq)
        <div class="faq-item" id="faq-d-{{ $i }}">
          <button onclick="toggleFaq('faq-d-{{ $i }}')" class="w-full text-left px-5 py-4 flex items-center justify-between gap-4 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
            <span class="font-semibold text-slate-800 dark:text-slate-100 text-sm">{{ $faq[0] }}</span>
            <i class="fa-solid fa-chevron-down faq-icon text-slate-400 text-xs flex-shrink-0"></i>
          </button>
          <div class="faq-answer" id="faq-d-{{ $i }}-ans">
            <p class="px-5 pb-4 text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ $faq[1] }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Tester -->
    <div>
      <div class="flex items-center gap-2 mb-3">
        <div class="w-6 h-6 rounded-lg flex items-center justify-center" style="background:#f0fdf4;">
          <i class="fa-solid fa-mobile-screen-button text-emerald-600 text-xs"></i>
        </div>
        <h2 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">{{ __('Untuk Tester') }}</h2>
      </div>
      <div class="page-card card-accent-green">
        @php $faqs_tester = [
          [__('Bagaimana cara mendapatkan reward sebagai Tester?'), __('Setelah bergabung ke misi dan menyelesaikan semua langkah yang diminta (unduh aplikasi, buka, dan beri ulasan di Play Store), reward Anda akan diproses dalam 1-3 hari kerja.')],
          [__('Berapa reward yang bisa saya dapatkan per misi?'), __('Besaran reward bervariasi tergantung jenis misi dan developer. Rata-rata reward berkisar antara Rp 5.000 – Rp 50.000 per misi.')],
          [__('Apakah saya perlu memiliki perangkat Android tertentu?'), __('Sebagian besar misi bisa dilakukan di perangkat Android versi 8.0 ke atas. Beberapa misi mungkin memerlukan spesifikasi tertentu yang akan dicantumkan di deskripsi misi.')],
          [__('Bagaimana cara mencairkan reward saya?'), __('Reward yang terkumpul di dompet Anda bisa dicairkan melalui menu "Dompet" ke rekening bank atau e-wallet (GoPay, OVO, DANA) dengan minimum penarikan Rp 25.000.')],
        ]; @endphp
        @foreach($faqs_tester as $i => $faq)
        <div class="faq-item" id="faq-t-{{ $i }}">
          <button onclick="toggleFaq('faq-t-{{ $i }}')" class="w-full text-left px-5 py-4 flex items-center justify-between gap-4 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
            <span class="font-semibold text-slate-800 dark:text-slate-100 text-sm">{{ $faq[0] }}</span>
            <i class="fa-solid fa-chevron-down faq-icon text-slate-400 text-xs flex-shrink-0"></i>
          </button>
          <div class="faq-answer" id="faq-t-{{ $i }}-ans">
            <p class="px-5 pb-4 text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ $faq[1] }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Still need help? -->
    <div class="page-card card-accent-orange p-6 text-center">
      <div class="w-10 h-10 rounded-xl mx-auto mb-3 flex items-center justify-center" style="background:#fffbeb;">
        <i class="fa-solid fa-headset text-amber-500"></i>
      </div>
      <h3 class="font-bold text-slate-800 dark:text-slate-100 mb-1 text-sm">{{ __('Masih punya pertanyaan?') }}</h3>
      <p class="text-slate-500 dark:text-slate-400 text-xs mb-4">{{ __('Tim kami siap membantu Anda 24/7.') }}</p>
      <a href="{{ route('hubungi-kami') }}" class="inline-flex items-center gap-2 bg-brand-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-brand-700 transition shadow-sm" style="box-shadow:0 4px 14px rgba(37,99,235,0.25);">
        <i class="fa-solid fa-envelope"></i> {{ __('Hubungi Kami') }}
      </a>
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
    function toggleFaq(id) {
      const item = document.getElementById(id);
      const ans  = document.getElementById(id + '-ans');
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('open'));
      document.querySelectorAll('.faq-answer').forEach(el => el.classList.remove('open'));
      if (!isOpen) { item.classList.add('open'); ans.classList.add('open'); }
    }
    function toggleTheme() {
      const html = document.documentElement;
      if (html.classList.contains('dark')) { html.classList.remove('dark'); localStorage.setItem('pt-theme','light'); }
      else { html.classList.add('dark'); localStorage.setItem('pt-theme','dark'); }
    }
  </script>
</body>
</html>
