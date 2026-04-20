<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PlayTest ID – Closed Testing Partner untuk Developer & Tester Indonesia</title>

  <!-- ─── Google Fonts: Inter ─── -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- ─── Tailwind CSS CDN ─── -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- ─── Font Awesome 6 CDN ─── -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

  <!-- ─── jQuery 3.7.1 CDN ─── -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- ─── Tailwind Config Extension ─── -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'sans-serif'] },
          colors: {
            brand: {
              50:  '#eff6ff',
              100: '#dbeafe',
              200: '#bfdbfe',
              400: '#60a5fa',
              500: '#3b82f6',
              600: '#2563eb',
              700: '#1d4ed8',
              800: '#1e40af',
              900: '#1e3a8a',
            }
          },
          keyframes: {
            fadeUp: { '0%': { opacity: '0', transform: 'translateY(24px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
            floatY: { '0%,100%': { transform: 'translateY(0px)' }, '50%': { transform: 'translateY(-10px)' } },
            pulseDot: { '0%,100%': { opacity: '1' }, '50%': { opacity: '0.4' } },
          },
          animation: {
            fadeUp:   'fadeUp 0.7s ease forwards',
            floatY:   'floatY 4s ease-in-out infinite',
            pulseDot: 'pulseDot 1.5s ease-in-out infinite',
          }
        }
      }
    }
  </script>

  <!-- ─── Custom CSS ─── -->
  <style>
    /* Base font */
    * { font-family: 'Inter', sans-serif; }

    /* Smooth scroll */
    html { scroll-behavior: smooth; }

    /* ── Navbar scroll shadow ── */
    #navbar.scrolled {
      box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
      background: rgba(255,255,255,0.97);
    }

    /* ── Hamburger animated icon ── */
    .ham-line {
      display: block;
      width: 24px; height: 2px;
      background: #1e40af;
      border-radius: 2px;
      transition: all 0.3s ease;
      transform-origin: center;
    }
    #hamburger.open .ham-line:nth-child(1) { transform: translateY(8px) rotate(45deg); }
    #hamburger.open .ham-line:nth-child(2) { opacity: 0; transform: scaleX(0); }
    #hamburger.open .ham-line:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

    /* ── Mobile menu slide ── */
    #mobile-menu {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    #mobile-menu.open { max-height: 360px; }

    /* ── Glassmorphism card ── */
    .glass-card {
      background: rgba(255,255,255,0.18);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255,255,255,0.35);
    }

    /* ── Gradient hero background ── */
    .hero-bg {
      background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 40%, #2563eb 70%, #3b82f6 100%);
    }

    /* ── Tab underline indicator ── */
    .tab-btn { position: relative; transition: color 0.2s; }
    .tab-btn::after {
      content: '';
      position: absolute; bottom: -2px; left: 0; right: 0;
      height: 3px; border-radius: 2px;
      background: #2563eb;
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }
    .tab-btn.active { color: #1d4ed8; font-weight: 700; }
    .tab-btn.active::after { transform: scaleX(1); }

    /* ── Tab content ── */
    .tab-content { display: none; }
    .tab-content.active { display: block; }

    /* ── Benefit icon bubble ── */
    .icon-bubble {
      width: 56px; height: 56px;
      display: flex; align-items: center; justify-content: center;
      border-radius: 16px;
      flex-shrink: 0;
    }

    /* ── Pricing card hover lift ── */
    .pricing-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .pricing-card:hover { transform: translateY(-6px); }

    /* ── Progress bar animation ── */
    .progress-fill {
      animation: fillBar 2s ease-in-out forwards;
      width: 0;
    }
    @keyframes fillBar { to { width: var(--fill); } }

    /* ── CTA section gradient ── */
    .cta-bg {
      background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 60%, #60a5fa 100%);
    }

    /* ── Scroll-reveal helper ── */
    .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    /* ── Checkmark list ── */
    .check-list li { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 10px; }
    .check-list li i { margin-top: 3px; flex-shrink: 0; }

    /* ── Badge ── */
    .badge-popular {
      background: linear-gradient(90deg, #2563eb, #60a5fa);
      color: #fff;
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.07em;
      padding: 4px 14px;
      border-radius: 999px;
      box-shadow: 0 2px 10px rgba(37,99,235,0.35);
    }
  </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

<!-- ════════════════════════════════════════════
     1. NAVBAR – Sticky, responsive dengan hamburger menu (jQuery)
     ════════════════════════════════════════════ -->
<header id="navbar" class="fixed top-0 inset-x-0 z-50 bg-white/95 border-b border-slate-100 transition-all duration-300">
  <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      <!-- Logo -->
      <a href="#" class="flex items-center gap-2 select-none">
        <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center shadow-md">
          <i class="fa-solid fa-gamepad text-white text-sm"></i>
        </div>
        <span class="text-xl font-800 font-black text-slate-800">
          Play<span class="text-brand-600">Test</span> <span class="text-slate-500 font-semibold">ID</span>
        </span>
      </a>

      <!-- Desktop Menu -->
      <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
        <li><a href="#cara-kerja"  class="hover:text-brand-600 transition duration-200">Cara Kerja</a></li>
        <li><a href="#manfaat"     class="hover:text-brand-600 transition duration-200">Manfaat</a></li>
        <li><a href="#harga"       class="hover:text-brand-600 transition duration-200">Harga</a></li>
      </ul>

      <!-- Desktop CTA -->
      <div class="hidden md:flex items-center gap-3">
        <a href="#" class="px-4 py-2 text-sm font-semibold text-brand-600 border-2 border-brand-600 rounded-xl hover:bg-brand-50 transition duration-200">
          Masuk
        </a>
        <a href="#" class="px-4 py-2 text-sm font-semibold text-white bg-brand-600 rounded-xl shadow-md hover:bg-brand-700 transition duration-200">
          Daftar
        </a>
      </div>

      <!-- Hamburger (Mobile) -->
      <button id="hamburger" aria-label="Toggle menu" class="md:hidden flex flex-col gap-[6px] p-2 rounded-lg hover:bg-brand-50 transition">
        <span class="ham-line"></span>
        <span class="ham-line"></span>
        <span class="ham-line"></span>
      </button>
    </div>

    <!-- Mobile Menu (collapsible, jQuery controlled) -->
    <div id="mobile-menu" class="md:hidden border-t border-slate-100">
      <ul class="flex flex-col py-4 gap-1 text-sm font-medium text-slate-700">
        <li><a href="#cara-kerja" class="block px-3 py-2 rounded-lg hover:bg-brand-50 hover:text-brand-600 transition">Cara Kerja</a></li>
        <li><a href="#manfaat"    class="block px-3 py-2 rounded-lg hover:bg-brand-50 hover:text-brand-600 transition">Manfaat</a></li>
        <li><a href="#harga"      class="block px-3 py-2 rounded-lg hover:bg-brand-50 hover:text-brand-600 transition">Harga</a></li>
        <li class="border-t border-slate-100 mt-2 pt-3 flex gap-2">
          <a href="#" class="flex-1 text-center px-4 py-2 font-semibold text-brand-600 border-2 border-brand-600 rounded-xl hover:bg-brand-50 transition">Masuk</a>
          <a href="#" class="flex-1 text-center px-4 py-2 font-semibold text-white bg-brand-600 rounded-xl shadow hover:bg-brand-700 transition">Daftar</a>
        </li>
      </ul>
    </div>
  </nav>
</header>


<!-- ════════════════════════════════════════════
     2. HERO SECTION – Split layout (copy + visual card)
     ════════════════════════════════════════════ -->
<section id="hero" class="hero-bg min-h-screen pt-28 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden relative">

  <!-- Background decoration blobs -->
  <div class="absolute top-20 right-0 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute bottom-10 left-0 w-72 h-72 bg-brand-400/15 rounded-full blur-3xl pointer-events-none"></div>

  <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

    <!-- ── Left: Copywriting ── -->
    <div class="text-white space-y-6" style="animation: fadeUp 0.8s ease forwards;">

      <!-- Badge -->
      <div class="inline-flex items-center gap-2 bg-white/10 border border-white/25 text-white text-xs font-semibold px-4 py-2 rounded-full">
        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulseDot"></span>
        Platform #1 Closed Testing Indonesia
      </div>

      <!-- Headline -->
      <h1 class="text-4xl sm:text-5xl lg:text-5xl font-black leading-tight tracking-tight">
        Lulus 14 Hari<br />
        <span class="text-brand-200">Closed Testing</span><br />
        Google Play Tanpa Ribet
      </h1>

      <!-- Sub-headline -->
      <p class="text-lg text-blue-100 leading-relaxed max-w-lg">
        PlayTest ID adalah platform kolaborasi antara <strong class="text-white">Developer</strong> yang butuh tester aktif dan <strong class="text-white">Tester</strong> yang ingin berkontribusi sambil belajar — berbasis konsep <em>Project Based Learning</em>.
      </p>

      <!-- Dual CTA -->
      <div class="flex flex-col sm:flex-row gap-3 pt-2">
        <a href="#harga" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white text-brand-700 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:bg-brand-50 transition duration-300 text-sm">
          <i class="fa-solid fa-rocket"></i>
          Saya Butuh Tester
        </a>
        <a href="#manfaat" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white/10 border border-white/40 text-white font-semibold rounded-2xl hover:bg-white/20 transition duration-300 text-sm backdrop-blur-sm">
          <i class="fa-solid fa-hand-pointer"></i>
          Saya Ingin Jadi Tester
        </a>
      </div>

      <!-- Social proof counters -->
      <div class="flex gap-8 pt-4 border-t border-white/20">
        <div>
          <p class="text-3xl font-black">1.200+</p>
          <p class="text-blue-200 text-xs font-medium mt-0.5">Tester Aktif</p>
        </div>
        <div class="w-px bg-white/20"></div>
        <div>
          <p class="text-3xl font-black">340+</p>
          <p class="text-blue-200 text-xs font-medium mt-0.5">Aplikasi Lulus Testing</p>
        </div>
        <div class="w-px bg-white/20"></div>
        <div>
          <p class="text-3xl font-black">98%</p>
          <p class="text-blue-200 text-xs font-medium mt-0.5">Tingkat Keberhasilan</p>
        </div>
      </div>
    </div>

    <!-- ── Right: Glassmorphism Dashboard Card ── -->
    <div class="flex justify-center lg:justify-end animate-floatY">
      <div class="glass-card rounded-3xl p-6 w-full max-w-sm shadow-2xl text-white">

        <!-- Card header -->
        <div class="flex items-center justify-between mb-5">
          <div>
            <p class="text-xs text-blue-200 font-medium uppercase tracking-widest">Campaign Aktif</p>
            <p class="text-lg font-bold mt-0.5">MyApp – Closed Testing</p>
          </div>
          <div class="w-10 h-10 bg-green-400/20 rounded-xl flex items-center justify-center">
            <i class="fa-solid fa-circle-check text-green-400 text-lg"></i>
          </div>
        </div>

        <!-- 14 Days Progress -->
        <div class="bg-white/10 rounded-2xl p-4 mb-4">
          <div class="flex justify-between text-xs font-semibold mb-2">
            <span class="text-blue-100">14 Days Progress</span>
            <span class="text-white">Hari 9 / 14</span>
          </div>
          <div class="w-full h-3 bg-white/20 rounded-full overflow-hidden">
            <div class="h-3 bg-gradient-to-r from-green-400 to-emerald-300 rounded-full progress-fill" style="--fill: 64%;"></div>
          </div>
          <p class="text-xs text-blue-200 mt-2">64% selesai · estimasi lulus <strong class="text-white">5 hari lagi</strong></p>
        </div>

        <!-- Tester count -->
        <div class="bg-white/10 rounded-2xl p-4 mb-4">
          <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-blue-100 font-semibold uppercase tracking-widest">Tester Aktif</span>
            <span class="text-green-400 font-black text-xl">20 / 20</span>
          </div>
          <!-- Avatar row -->
          <div class="flex items-center">
            <div class="flex -space-x-2">
              <div class="w-7 h-7 rounded-full bg-pink-400    border-2 border-white/30 flex items-center justify-center text-xs font-bold">A</div>
              <div class="w-7 h-7 rounded-full bg-yellow-400  border-2 border-white/30 flex items-center justify-center text-xs font-bold">B</div>
              <div class="w-7 h-7 rounded-full bg-green-400   border-2 border-white/30 flex items-center justify-center text-xs font-bold">C</div>
              <div class="w-7 h-7 rounded-full bg-purple-400  border-2 border-white/30 flex items-center justify-center text-xs font-bold">D</div>
              <div class="w-7 h-7 rounded-full bg-blue-300    border-2 border-white/30 flex items-center justify-center text-xs font-bold">+16</div>
            </div>
            <span class="ml-3 text-xs text-blue-200">Semua tester memenuhi syarat Google</span>
          </div>
        </div>

        <!-- Daily chart mini -->
        <div class="bg-white/10 rounded-2xl p-4">
          <p class="text-xs text-blue-100 font-semibold uppercase tracking-widest mb-3">Aktivitas Harian</p>
          <div class="flex items-end gap-1.5 h-14">
            <!-- 14 bar mini chart – all active -->
            <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:60%;" title="Hari 1"></div>
            <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:80%;" title="Hari 2"></div>
            <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:55%;" title="Hari 3"></div>
            <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:90%;" title="Hari 4"></div>
            <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:70%;" title="Hari 5"></div>
            <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:85%;" title="Hari 6"></div>
            <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:65%;" title="Hari 7"></div>
            <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:75%;" title="Hari 8"></div>
            <div class="flex-1 bg-white/50   rounded-t-sm" style="height:100%;" title="Hari 9 – Hari ini"></div>
            <div class="flex-1 bg-white/20   rounded-t-sm" style="height:30%;" title="Hari 10 – Mendatang"></div>
            <div class="flex-1 bg-white/20   rounded-t-sm" style="height:20%;"></div>
            <div class="flex-1 bg-white/20   rounded-t-sm" style="height:20%;"></div>
            <div class="flex-1 bg-white/20   rounded-t-sm" style="height:20%;"></div>
            <div class="flex-1 bg-white/20   rounded-t-sm" style="height:20%;"></div>
          </div>
          <div class="flex justify-between text-xs text-blue-300 mt-2 font-medium">
            <span>Hari 1</span><span>Hari 9 ← Anda di sini</span><span>Hari 14</span>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Wave divider -->
  <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
    <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-14 fill-slate-50">
      <path d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z"/>
    </svg>
  </div>
</section>


<!-- ════════════════════════════════════════════
     3. CARA KERJA – How it works (steps)
     ════════════════════════════════════════════ -->
<section id="cara-kerja" class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50">
  <div class="max-w-7xl mx-auto">

    <div class="text-center mb-14 reveal">
      <span class="text-brand-600 font-semibold text-sm uppercase tracking-widest">Cara Kerja</span>
      <h2 class="text-3xl sm:text-4xl font-black text-slate-800 mt-2">Tiga Langkah Mudah</h2>
      <p class="text-slate-500 mt-3 max-w-xl mx-auto">Proses yang sederhana, transparan, dan sepenuhnya dipantau untuk memastikan aplikasi Anda berhasil lulus closed testing.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Step 1 -->
      <div class="reveal bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition duration-300 relative text-center">
        <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-brand-600 text-white rounded-full flex items-center justify-center font-black text-sm shadow-lg">1</div>
        <div class="w-16 h-16 bg-brand-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
          <i class="fa-solid fa-upload text-brand-600 text-2xl"></i>
        </div>
        <h3 class="font-bold text-lg text-slate-800 mb-2">Daftar &amp; Upload Aplikasi</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Developer mendaftar, memilih paket, dan mengunggah link aplikasi Google Play untuk uji tertutup.</p>
      </div>

      <!-- Step 2 -->
      <div class="reveal bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition duration-300 relative text-center" style="transition-delay: 0.15s;">
        <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-brand-600 text-white rounded-full flex items-center justify-center font-black text-sm shadow-lg">2</div>
        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
          <i class="fa-solid fa-users text-green-600 text-2xl"></i>
        </div>
        <h3 class="font-bold text-lg text-slate-800 mb-2">20 Tester Bergabung</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Platform kami secara otomatis menghubungkan 20 tester aktif yang terverifikasi ke sesi pengujian aplikasi Anda.</p>
      </div>

      <!-- Step 3 -->
      <div class="reveal bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition duration-300 relative text-center" style="transition-delay: 0.3s;">
        <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-brand-600 text-white rounded-full flex items-center justify-center font-black text-sm shadow-lg">3</div>
        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
          <i class="fa-solid fa-trophy text-purple-600 text-2xl"></i>
        </div>
        <h3 class="font-bold text-lg text-slate-800 mb-2">Lulus &amp; Rilis ke Play Store</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Setelah 14 hari berturut-turut dengan 20 tester aktif, aplikasi Anda siap rilis ke Google Play Store.</p>
      </div>

    </div>
  </div>
</section>


<!-- ════════════════════════════════════════════
     4. DUAL INFO SECTION – Tabbed layout (jQuery)
     ════════════════════════════════════════════ -->
<section id="manfaat" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
  <div class="max-w-5xl mx-auto">

    <div class="text-center mb-10 reveal">
      <span class="text-brand-600 font-semibold text-sm uppercase tracking-widest">Manfaat</span>
      <h2 class="text-3xl sm:text-4xl font-black text-slate-800 mt-2">Platform untuk Semua Pihak</h2>
      <p class="text-slate-500 mt-3 max-w-xl mx-auto">Pilih perspektif Anda dan temukan bagaimana PlayTest ID memberi nilai nyata.</p>
    </div>

    <!-- ── Tab Switcher ── -->
    <div class="flex justify-center mb-10 reveal">
      <div class="inline-flex bg-slate-100 p-1.5 rounded-2xl gap-1">
        <button class="tab-btn active px-6 py-2.5 rounded-xl text-sm font-semibold transition duration-200 hover:bg-white focus:outline-none" data-tab="developer">
          <i class="fa-solid fa-code mr-2 text-brand-500"></i>Untuk Developer
        </button>
        <button class="tab-btn px-6 py-2.5 rounded-xl text-sm font-semibold text-slate-500 transition duration-200 hover:bg-white focus:outline-none" data-tab="tester">
          <i class="fa-solid fa-mobile-screen-button mr-2 text-slate-400"></i>Untuk Tester
        </button>
      </div>
    </div>

    <!-- ── Tab Contents ── -->
    <div id="tab-developer" class="tab-content active reveal">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Benefit 1 -->
        <div class="bg-slate-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
          <div class="icon-bubble bg-brand-100 mb-4">
            <i class="fa-solid fa-magnifying-glass text-brand-600 text-xl"></i>
          </div>
          <h4 class="font-bold text-slate-800 mb-2">Mudah Cari Tester</h4>
          <p class="text-slate-500 text-sm leading-relaxed">Tidak perlu repot mencari secara manual. Sistem kami langsung menghubungkan Anda dengan 20 tester aktif yang sudah terverifikasi.</p>
        </div>

        <!-- Benefit 2 -->
        <div class="bg-slate-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
          <div class="icon-bubble bg-green-100 mb-4">
            <i class="fa-solid fa-calendar-check text-green-600 text-xl"></i>
          </div>
          <h4 class="font-bold text-slate-800 mb-2">Validasi Otomatis 14 Hari</h4>
          <p class="text-slate-500 text-sm leading-relaxed">Dashboard real-time memantau keaktifan setiap tester selama 14 hari berturut-turut sesuai persyaratan Google Play Console.</p>
        </div>

        <!-- Benefit 3 -->
        <div class="bg-slate-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
          <div class="icon-bubble bg-red-100 mb-4">
            <i class="fa-solid fa-shield-halved text-red-500 text-xl"></i>
          </div>
          <h4 class="font-bold text-slate-800 mb-2">Terhindar dari Penolakan Google</h4>
          <p class="text-slate-500 text-sm leading-relaxed">Proses terstruktur kami memastikan semua syarat teknis Google terpenuhi sehingga aplikasi Anda tidak ditolak saat mengajukan rilis.</p>
        </div>

      </div>
    </div>

    <div id="tab-tester" class="tab-content reveal">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Benefit 1 -->
        <div class="bg-slate-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
          <div class="icon-bubble bg-yellow-100 mb-4">
            <i class="fa-solid fa-star text-yellow-500 text-xl"></i>
          </div>
          <h4 class="font-bold text-slate-800 mb-2">Akses Aplikasi Baru</h4>
          <p class="text-slate-500 text-sm leading-relaxed">Jadilah yang pertama mencoba aplikasi-aplikasi inovatif karya developer Indonesia sebelum resmi dirilis ke publik.</p>
        </div>

        <!-- Benefit 2 -->
        <div class="bg-slate-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
          <div class="icon-bubble bg-purple-100 mb-4">
            <i class="fa-solid fa-graduation-cap text-purple-600 text-xl"></i>
          </div>
          <h4 class="font-bold text-slate-800 mb-2">Pengalaman Project Based Learning</h4>
          <p class="text-slate-500 text-sm leading-relaxed">Tingkatkan kemampuan QA dan software testing Anda melalui proyek nyata — pengalaman yang bisa langsung dicantumkan di portofolio.</p>
        </div>

        <!-- Benefit 3 -->
        <div class="bg-slate-50 rounded-2xl p-6 hover:shadow-lg transition duration-300">
          <div class="icon-bubble bg-brand-100 mb-4">
            <i class="fa-solid fa-people-group text-brand-600 text-xl"></i>
          </div>
          <h4 class="font-bold text-slate-800 mb-2">Komunitas Aktif</h4>
          <p class="text-slate-500 text-sm leading-relaxed">Bergabung dengan ribuan tester dan developer di komunitas PlayTest ID — saling berbagi ilmu, diskusi, dan peluang kolaborasi.</p>
        </div>

      </div>
    </div>

  </div>
</section>


<!-- ════════════════════════════════════════════
     5. PRICING TABLE – Dua card berdampingan
     ════════════════════════════════════════════ -->
<section id="harga" class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 relative overflow-hidden">

  <!-- Decoration -->
  <div class="absolute inset-0 bg-gradient-to-br from-brand-50/60 via-slate-50 to-slate-50 pointer-events-none"></div>

  <div class="max-w-5xl mx-auto relative">

    <div class="text-center mb-14 reveal">
      <span class="text-brand-600 font-semibold text-sm uppercase tracking-widest">Harga</span>
      <h2 class="text-3xl sm:text-4xl font-black text-slate-800 mt-2">Pilih Paket Pengujian Anda</h2>
      <p class="text-slate-500 mt-3 max-w-xl mx-auto">Investasi sekali bayar untuk memastikan aplikasi Anda berhasil lulus closed testing dan siap rilis ke jutaan pengguna.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

      <!-- ── Card 1: Starter ── -->
      <div class="pricing-card reveal bg-white rounded-2xl p-8 shadow-lg border border-slate-100">

        <div class="mb-6">
          <div class="inline-flex items-center gap-2 bg-slate-100 text-slate-600 text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-4">
            <i class="fa-solid fa-seedling text-green-500"></i> Paket Starter
          </div>
          <p class="text-slate-500 text-sm leading-relaxed">Solusi dasar untuk memenuhi syarat Google Play Closed Testing.</p>
        </div>

        <!-- Price -->
        <div class="mb-6 pb-6 border-b border-slate-100">
          <div class="flex items-baseline gap-1">
            <span class="text-slate-400 text-sm font-medium">Rp</span>
            <span class="text-5xl font-black text-slate-800">300</span>
            <span class="text-slate-400 text-lg font-medium">.000</span>
          </div>
          <p class="text-slate-400 text-xs mt-1">Pembayaran sekali · akses 14 hari penuh</p>
        </div>

        <!-- Features -->
        <ul class="check-list text-sm text-slate-600 mb-8 space-y-0">
          <li><i class="fa-solid fa-circle-check text-green-500"></i><span>Akses 20 Tester Aktif &amp; Terverifikasi</span></li>
          <li><i class="fa-solid fa-circle-check text-green-500"></i><span>Pengujian 14 Hari Penuh Berturut-turut</span></li>
          <li><i class="fa-solid fa-circle-check text-green-500"></i><span>Laporan Pengujian Standar</span></li>
          <li><i class="fa-solid fa-circle-check text-green-500"></i><span>Dukungan Komunitas PlayTest ID</span></li>
        </ul>

        <a href="#" class="block w-full text-center py-3.5 rounded-xl font-bold text-brand-700 border-2 border-brand-600 hover:bg-brand-600 hover:text-white transition duration-300 text-sm">
          Pilih Starter
        </a>
      </div>

      <!-- ── Card 2: Pro (Best Value) ── -->
      <div class="pricing-card reveal relative" style="transition-delay: 0.15s;">

        <!-- Popular badge floating above card -->
        <div class="flex justify-center mb-3">
          <span class="badge-popular">
            <i class="fa-solid fa-fire mr-1"></i> Paling Populer
          </span>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-2xl border-2 border-brand-600 relative overflow-hidden">

          <!-- Corner ribbon glow -->
          <div class="absolute -top-10 -right-10 w-36 h-36 bg-brand-500/10 rounded-full blur-2xl"></div>

          <div class="mb-6 relative">
            <div class="inline-flex items-center gap-2 bg-brand-600 text-white text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-4">
              <i class="fa-solid fa-gem"></i> Paket Pro
            </div>
            <p class="text-slate-500 text-sm leading-relaxed">Solusi premium untuk optimasi menyeluruh sebelum aplikasi Anda rilis ke publik.</p>
          </div>

          <!-- Price -->
          <div class="mb-6 pb-6 border-b border-slate-100 relative">
            <div class="flex items-baseline gap-1">
              <span class="text-brand-400 text-sm font-medium">Rp</span>
              <span class="text-5xl font-black text-brand-700">500</span>
              <span class="text-brand-400 text-lg font-medium">.000</span>
            </div>
            <p class="text-slate-400 text-xs mt-1">Pembayaran sekali · akses prioritas penuh</p>
          </div>

          <!-- Features -->
          <ul class="check-list text-sm text-slate-600 mb-8 relative space-y-0">
            <li><i class="fa-solid fa-circle-check text-brand-500"></i><span>Semua Fitur Paket Starter</span></li>
            <li><i class="fa-solid fa-circle-check text-brand-500"></i><span>Laporan Bug &amp; UX Mendalam per Tester</span></li>
            <li><i class="fa-solid fa-circle-check text-brand-500"></i><span>Prioritas Antrean (Mulai Lebih Cepat)</span></li>
            <li><i class="fa-solid fa-circle-check text-brand-500"></i><span>Review Komprehensif dari Setiap Tester</span></li>
            <li><i class="fa-solid fa-circle-check text-brand-500"></i><span>Dukungan Prioritas via Chat Langsung</span></li>
          </ul>

          <a href="#" class="relative block w-full text-center py-3.5 rounded-xl font-bold text-white bg-gradient-to-r from-brand-600 to-brand-500 shadow-lg shadow-brand-200 hover:shadow-brand-300 hover:from-brand-700 hover:to-brand-600 transition duration-300 text-sm">
            <i class="fa-solid fa-bolt mr-1"></i> Pilih Pro – Mulai Sekarang
          </a>

          <p class="text-center text-xs text-slate-400 mt-3">
            <i class="fa-solid fa-lock text-xs mr-1"></i>Pembayaran aman · Garansi 7 hari
          </p>

        </div>
      </div>

    </div>

    <!-- Comparison note -->
    <div class="mt-10 text-center reveal">
      <p class="text-slate-400 text-sm">
        <i class="fa-solid fa-circle-info text-brand-400 mr-1"></i>
        Semua paket sudah mencakup akses dashboard monitoring real-time 14 hari.
        <a href="#" class="text-brand-600 font-semibold hover:underline ml-1">Lihat perbandingan lengkap →</a>
      </p>
    </div>

  </div>
</section>


<!-- ════════════════════════════════════════════
     6. TESTIMONIAL (bonus) – Social proof
     ════════════════════════════════════════════ -->
<section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
  <div class="max-w-6xl mx-auto">

    <div class="text-center mb-10 reveal">
      <span class="text-brand-600 font-semibold text-sm uppercase tracking-widest">Testimoni</span>
      <h2 class="text-2xl sm:text-3xl font-black text-slate-800 mt-2">Dipercaya Developer &amp; Tester Indonesia</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <div class="reveal bg-slate-50 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-300">
        <div class="flex gap-1 text-yellow-400 mb-3 text-sm">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </div>
        <p class="text-slate-600 text-sm leading-relaxed mb-4">"Saya sudah mencoba platform lain dan gagal. Dengan PlayTest ID, dalam 14 hari aplikasi saya langsung lulus dan sekarang sudah ada di Play Store!"</p>
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 bg-brand-200 rounded-full flex items-center justify-center font-bold text-brand-700 text-sm">RD</div>
          <div>
            <p class="font-semibold text-slate-800 text-sm">Rizky D.</p>
            <p class="text-slate-400 text-xs">Developer – Jakarta</p>
          </div>
        </div>
      </div>

      <div class="reveal bg-slate-50 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-300" style="transition-delay:0.1s;">
        <div class="flex gap-1 text-yellow-400 mb-3 text-sm">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </div>
        <p class="text-slate-600 text-sm leading-relaxed mb-4">"Sebagai tester, saya dapat pengalaman QA nyata dan bisa menambahkan ini ke CV saya. Komunitas PlayTest ID juga sangat supportif!"</p>
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 bg-green-200 rounded-full flex items-center justify-center font-bold text-green-700 text-sm">AN</div>
          <div>
            <p class="font-semibold text-slate-800 text-sm">Ari N.</p>
            <p class="text-slate-400 text-xs">Tester – Surabaya</p>
          </div>
        </div>
      </div>

      <div class="reveal bg-slate-50 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-300" style="transition-delay:0.2s;">
        <div class="flex gap-1 text-yellow-400 mb-3 text-sm">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </div>
        <p class="text-slate-600 text-sm leading-relaxed mb-4">"Dashboard monitoring-nya sangat membantu. Saya bisa pantau progres 14 hari secara real-time. Paket Pro worth it banget!"</p>
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 bg-purple-200 rounded-full flex items-center justify-center font-bold text-purple-700 text-sm">FH</div>
          <div>
            <p class="font-semibold text-slate-800 text-sm">Fajar H.</p>
            <p class="text-slate-400 text-xs">Developer – Bandung</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ════════════════════════════════════════════
     7. CTA BANNER – Bottom call to action
     ════════════════════════════════════════════ -->
<section class="py-20 px-4 sm:px-6 lg:px-8 cta-bg relative overflow-hidden">

  <div class="absolute top-0 right-0 w-80 h-80 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>

  <div class="max-w-3xl mx-auto text-center relative reveal">

    <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full mb-6">
      <i class="fa-solid fa-rocket"></i> Mulai perjalanan Anda hari ini
    </div>

    <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-4">
      Siap Merilis Aplikasi Anda ke Play Store?
    </h2>

    <p class="text-blue-100 text-lg leading-relaxed mb-8 max-w-2xl mx-auto">
      Atau ingin mulai membantu developer lain sambil menambah pengalaman QA Anda? Bergabung dengan <strong class="text-white">PlayTest ID</strong> sekarang dan jadilah bagian dari ekosistem pengujian terbaik Indonesia.
    </p>

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="#harga" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-brand-700 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition duration-300">
        <i class="fa-solid fa-rocket"></i> Mulai Sebagai Developer
      </a>
      <a href="#manfaat" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 border border-white/30 text-white font-semibold rounded-2xl hover:bg-white/20 transition duration-300 backdrop-blur-sm">
        <i class="fa-solid fa-hand-pointer"></i> Daftar Sebagai Tester
      </a>
    </div>

    <!-- Trust indicators -->
    <div class="flex justify-center gap-8 mt-10 flex-wrap">
      <div class="flex items-center gap-2 text-blue-200 text-xs font-medium">
        <i class="fa-solid fa-shield-halved text-green-400"></i> Pembayaran Aman
      </div>
      <div class="flex items-center gap-2 text-blue-200 text-xs font-medium">
        <i class="fa-solid fa-rotate-left text-yellow-400"></i> Garansi 7 Hari
      </div>
      <div class="flex items-center gap-2 text-blue-200 text-xs font-medium">
        <i class="fa-solid fa-headset text-blue-300"></i> Dukungan 24/7
      </div>
    </div>

  </div>
</section>


<!-- ════════════════════════════════════════════
     8. FOOTER
     ════════════════════════════════════════════ -->
<footer class="bg-slate-900 text-slate-400 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-7xl mx-auto">

    <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-10 border-b border-slate-800">

      <!-- Brand -->
      <div class="md:col-span-2">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center shadow">
            <i class="fa-solid fa-gamepad text-white text-sm"></i>
          </div>
          <span class="text-white text-xl font-black">Play<span class="text-brand-400">Test</span> <span class="text-slate-400 font-semibold text-base">ID</span></span>
        </div>
        <p class="text-sm leading-relaxed max-w-xs">Platform kolaborasi Developer dan Tester Indonesia berbasis Project Based Learning untuk memenuhi syarat Closed Testing Google Play.</p>
        <div class="flex gap-3 mt-5">
          <a href="#" class="w-9 h-9 bg-slate-800 rounded-xl flex items-center justify-center hover:bg-brand-600 transition duration-200" aria-label="Instagram">
            <i class="fa-brands fa-instagram text-sm"></i>
          </a>
          <a href="#" class="w-9 h-9 bg-slate-800 rounded-xl flex items-center justify-center hover:bg-brand-600 transition duration-200" aria-label="Twitter/X">
            <i class="fa-brands fa-x-twitter text-sm"></i>
          </a>
          <a href="#" class="w-9 h-9 bg-slate-800 rounded-xl flex items-center justify-center hover:bg-brand-600 transition duration-200" aria-label="LinkedIn">
            <i class="fa-brands fa-linkedin-in text-sm"></i>
          </a>
          <a href="#" class="w-9 h-9 bg-slate-800 rounded-xl flex items-center justify-center hover:bg-brand-600 transition duration-200" aria-label="Telegram">
            <i class="fa-brands fa-telegram text-sm"></i>
          </a>
        </div>
      </div>

      <!-- Platform links -->
      <div>
        <h5 class="text-white font-bold text-sm mb-4">Platform</h5>
        <ul class="space-y-2.5 text-sm">
          <li><a href="#cara-kerja" class="hover:text-white transition">Cara Kerja</a></li>
          <li><a href="#manfaat"    class="hover:text-white transition">Manfaat</a></li>
          <li><a href="#harga"      class="hover:text-white transition">Harga</a></li>
          <li><a href="#"           class="hover:text-white transition">Dashboard</a></li>
          <li><a href="#"           class="hover:text-white transition">Blog</a></li>
        </ul>
      </div>

      <!-- Legal links -->
      <div>
        <h5 class="text-white font-bold text-sm mb-4">Legal &amp; Bantuan</h5>
        <ul class="space-y-2.5 text-sm">
          <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
          <li><a href="#" class="hover:text-white transition">Syarat &amp; Ketentuan</a></li>
          <li><a href="#" class="hover:text-white transition">FAQ</a></li>
          <li><a href="#" class="hover:text-white transition">Hubungi Kami</a></li>
        </ul>
      </div>

    </div>

    <!-- Bottom bar -->
    <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
      <p>© 2025 <span class="text-slate-400 font-semibold">PlayTest ID</span>. Hak cipta dilindungi undang-undang.</p>
      <p>Dibuat dengan <i class="fa-solid fa-heart text-red-500 mx-1"></i> untuk Developer &amp; Tester Indonesia.</p>
    </div>

  </div>
</footer>


<!-- ════════════════════════════════════════════
     SCRIPTS – jQuery 3.7.1 Interactions
     ════════════════════════════════════════════ -->
<script>
$(function () {

  /* ── 1. NAVBAR: Sticky scroll shadow ── */
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 10) {
      $('#navbar').addClass('scrolled');
    } else {
      $('#navbar').removeClass('scrolled');
    }
  });

  /* ── 2. HAMBURGER MENU: Toggle mobile menu ── */
  $('#hamburger').on('click', function () {
    $(this).toggleClass('open');
    $('#mobile-menu').toggleClass('open');
  });

  /* Close mobile menu when a link is clicked */
  $('#mobile-menu a').on('click', function () {
    $('#hamburger').removeClass('open');
    $('#mobile-menu').removeClass('open');
  });

  /* ── 3. SMOOTH SCROLLING: All anchor links ── */
  $('a[href^="#"]').on('click', function (e) {
    var target = $(this.getAttribute('href'));
    if (target.length) {
      e.preventDefault();
      $('html, body').stop().animate({
        scrollTop: target.offset().top - 64  // 64px navbar offset
      }, 600, 'swing');
    }
  });

  /* ── 4. TAB SWITCHING: Developer / Tester ── */
  $('.tab-btn').on('click', function () {
    var tabId = $(this).data('tab');

    // Update button styles
    $('.tab-btn').removeClass('active bg-white shadow-sm text-slate-800').addClass('text-slate-500');
    $(this).addClass('active bg-white shadow-sm text-slate-800').removeClass('text-slate-500');

    // Switch tab content with fade
    $('.tab-content').removeClass('active').hide();
    $('#tab-' + tabId).addClass('active').hide().fadeIn(300);
  });

  /* ── 5. SCROLL REVEAL: Animate elements on scroll ── */
  function revealOnScroll() {
    var scrollTop = $(window).scrollTop();
    var windowHeight = $(window).height();

    $('.reveal').each(function () {
      var elemTop = $(this).offset().top;
      if (elemTop < scrollTop + windowHeight - 60) {
        $(this).addClass('visible');
      }
    });
  }

  $(window).on('scroll', revealOnScroll);
  revealOnScroll(); // run once on load

  /* ── 6. PROGRESS BAR: Animate on first scroll into view ── */
  var progressAnimated = false;
  $(window).on('scroll', function () {
    if (progressAnimated) return;
    var bar = $('.progress-fill');
    if (bar.length) {
      var barTop = bar.offset().top;
      if (barTop < $(window).scrollTop() + $(window).height() - 40) {
        progressAnimated = true;
        bar.css('width', bar.css('--fill') || '64%');
      }
    }
  });

  /* ── 7. NAVBAR LINK ACTIVE STATE on scroll ── */
  var sections = ['cara-kerja', 'manfaat', 'harga'];
  $(window).on('scroll', function () {
    var scrollPos = $(this).scrollTop() + 80;
    sections.forEach(function (id) {
      var section = $('#' + id);
      if (section.length) {
        if (scrollPos >= section.offset().top && scrollPos < section.offset().top + section.outerHeight()) {
          $('nav a[href="#' + id + '"]').addClass('text-brand-600 font-semibold');
        } else {
          $('nav a[href="#' + id + '"]').removeClass('text-brand-600 font-semibold');
        }
      }
    });
  });

});
</script>

</body>
</html>