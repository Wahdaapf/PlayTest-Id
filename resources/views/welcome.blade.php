<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PlayTest ID – Closed Testing Partner for Indonesian Developers & Testers</title>
  <link rel="icon" href="{{ asset('logoheader.png') }}" type="image/png" />

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
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif']
          },
          colors: {
            brand: {
              50: '#eff6ff',
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
            fadeUp: {
              '0%': {
                opacity: '0',
                transform: 'translateY(24px)'
              },
              '100%': {
                opacity: '1',
                transform: 'translateY(0)'
              }
            },
            floatY: {
              '0%,100%': {
                transform: 'translateY(0px)'
              },
              '50%': {
                transform: 'translateY(-10px)'
              }
            },
            pulseDot: {
              '0%,100%': {
                opacity: '1'
              },
              '50%': {
                opacity: '0.4'
              }
            },
          },
          animation: {
            fadeUp: 'fadeUp 0.7s ease forwards',
            floatY: 'floatY 4s ease-in-out infinite',
            pulseDot: 'pulseDot 1.5s ease-in-out infinite',
          }
        }
      }
    }
  </script>

  <!-- ─── Dark mode init (prevent flash) ─── -->
  <script>
    (function() {
      const saved = localStorage.getItem('pt-theme');
      if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      }
    })();
  </script>

  <!-- ─── Custom CSS ─── -->
  <style>
    /* Base font */
    * {
      font-family: 'Inter', sans-serif;
    }

    /* Smooth scroll */
    html {
      scroll-behavior: smooth;
    }

    /* ── Navbar scroll shadow ── */
    #navbar.scrolled {
      box-shadow: 0 4px 24px 0 rgba(37, 99, 235, 0.08);
      background: rgba(255, 255, 255, 0.97);
    }
    .dark #navbar.scrolled {
      box-shadow: 0 4px 24px 0 rgba(0, 0, 0, 0.3);
      background: rgba(15, 23, 42, 0.97);
    }

    /* ── Hamburger animated icon ── */
    .ham-line {
      display: block;
      width: 24px;
      height: 2px;
      background: #1e40af;
      border-radius: 2px;
      transition: all 0.3s ease;
      transform-origin: center;
    }
    .dark .ham-line {
      background: #93c5fd;
    }

    #hamburger.open .ham-line:nth-child(1) {
      transform: translateY(8px) rotate(45deg);
    }

    #hamburger.open .ham-line:nth-child(2) {
      opacity: 0;
      transform: scaleX(0);
    }

    #hamburger.open .ham-line:nth-child(3) {
      transform: translateY(-8px) rotate(-45deg);
    }

    /* ── Mobile menu slide ── */
    #mobile-menu {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    #mobile-menu.open {
      max-height: 420px;
    }

    /* ── Glassmorphism card ── */
    .glass-card {
      background: rgba(255, 255, 255, 0.18);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.35);
    }

    /* ── Gradient hero background ── */
    .hero-bg {
      background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 40%, #2563eb 70%, #3b82f6 100%);
    }
    .dark .hero-bg {
      background: linear-gradient(135deg, #0a1628 0%, #0f1d3a 40%, #162a56 70%, #1a3470 100%);
    }

    /* ── Tab underline indicator ── */
    .tab-btn {
      position: relative;
      transition: color 0.2s;
    }

    .tab-btn::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      right: 0;
      height: 3px;
      border-radius: 2px;
      background: #2563eb;
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .tab-btn.active {
      color: #1d4ed8;
      font-weight: 700;
    }
    .dark .tab-btn.active {
      color: #60a5fa;
    }

    .tab-btn.active::after {
      transform: scaleX(1);
    }

    /* ── Tab content ── */
    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    /* ── Benefit icon bubble ── */
    .icon-bubble {
      width: 56px;
      height: 56px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 16px;
      flex-shrink: 0;
    }

    /* ── Pricing card hover lift ── */
    .pricing-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pricing-card:hover {
      transform: translateY(-6px);
    }

    /* ── Progress bar animation ── */
    .progress-fill {
      animation: fillBar 2s ease-in-out forwards;
      width: 0;
    }

    @keyframes fillBar {
      to {
        width: var(--fill);
      }
    }

    /* ── CTA section gradient ── */
    .cta-bg {
      background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 60%, #60a5fa 100%);
    }
    .dark .cta-bg {
      background: linear-gradient(135deg, #0a1628 0%, #162a56 60%, #1a3470 100%);
    }

    /* ── Scroll-reveal helper ── */
    .reveal {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* ── Checkmark list ── */
    .check-list li {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin-bottom: 10px;
    }

    .check-list li i {
      margin-top: 3px;
      flex-shrink: 0;
    }

    /* ── Badge ── */
    .badge-popular {
      background: linear-gradient(90deg, #2563eb, #60a5fa);
      color: #fff;
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.07em;
      padding: 4px 14px;
      border-radius: 999px;
      box-shadow: 0 2px 10px rgba(37, 99, 235, 0.35);
    }

    /* ── Theme toggle ── */
    .theme-toggle {
      position: relative;
      width: 52px;
      height: 28px;
      border-radius: 9999px;
      cursor: pointer;
      border: none;
      outline: none;
      transition: background 0.3s ease;
      background: linear-gradient(135deg, #bfdbfe, #93c5fd);
      box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
    }
    .dark .theme-toggle {
      background: linear-gradient(135deg, #1e293b, #334155);
    }
    .theme-toggle-knob {
      position: absolute;
      top: 3px;
      left: 3px;
      width: 22px;
      height: 22px;
      border-radius: 50%;
      background: #fff;
      box-shadow: 0 1px 4px rgba(0,0,0,.2);
      transition: transform 0.3s cubic-bezier(.4,0,.2,1);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
    }
    .dark .theme-toggle-knob {
      transform: translateX(24px);
      background: #1e293b;
    }
    .theme-toggle-knob .icon-sun,
    .theme-toggle-knob .icon-moon { transition: opacity 0.2s; }
    .theme-toggle-knob .icon-sun { color: #f59e0b; }
    .theme-toggle-knob .icon-moon { color: #60a5fa; position: absolute; }
    .dark .theme-toggle-knob .icon-sun { opacity: 0; }
    .theme-toggle-knob .icon-moon { opacity: 0; }
    .dark .theme-toggle-knob .icon-moon { opacity: 1; }

    /* ── Smooth body transition ── */
    body, #navbar, .pricing-card > div, .glass-card {
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
  </style>
</head>

<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased">

  <!-- ════════════════════════════════════════════
     1. NAVBAR – Sticky, responsive with hamburger menu (jQuery)
     ════════════════════════════════════════════ -->
  <header id="navbar" class="fixed top-0 inset-x-0 z-50 bg-white/95 dark:bg-slate-900/95 border-b border-slate-100 dark:border-slate-800 transition-all duration-300">
    <nav class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">

        <!-- Logo -->
        <a href="/" class="flex items-center select-none animate-fadeUp">
          <img src="{{ asset('logo.png') }}" alt="PlayTest ID" class="h-12 w-auto object-contain" />
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600 dark:text-slate-400">
          <li><a href="#how-it-works" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Cara Kerja') }}</a></li>
          <li><a href="#benefits" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Manfaat') }}</a></li>
          <li><a href="#pricing" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Harga') }}</a></li>
        </ul>

        <!-- Desktop CTA -->
        <div class="hidden md:flex items-center gap-3">
          <button onclick="openAuthModal('login')" class="px-4 py-2 text-sm font-semibold text-brand-600 dark:text-brand-400 border-2 border-brand-600 dark:border-brand-500 rounded-xl hover:bg-brand-50 dark:hover:bg-brand-950 transition duration-200">
            {{ __('Masuk') }}
          </button>
          <button onclick="openAuthModal('register')" class="px-4 py-2 text-sm font-semibold text-white bg-brand-600 rounded-xl shadow-md hover:bg-brand-700 transition duration-200">
            {{ __('Daftar') }}
          </button>

          <!-- Theme Toggle -->
          <button class="theme-toggle ml-1" onclick="toggleTheme()" aria-label="Toggle dark mode">
            <span class="theme-toggle-knob">
              <i class="fa-solid fa-sun icon-sun"></i>
              <i class="fa-solid fa-moon icon-moon"></i>
            </span>
          </button>

          <!-- Language Switcher -->
          @php
            $currentRoute = Route::currentRouteName();
            $params = Route::current() ? Route::current()->parameters() : [];
            $enUrl = $currentRoute ? route($currentRoute, array_merge($params, ['locale' => 'en'])) : url('/en');
            $idUrl = $currentRoute ? route($currentRoute, array_merge($params, ['locale' => 'id'])) : url('/id');
          @endphp
          <div class="flex items-center gap-1.5 ml-2 pl-4 border-l border-slate-200 dark:border-slate-700">
            <a href="{{ $enUrl }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-[10px] font-black transition {{ App::getLocale() == 'en' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 hover:text-slate-600 dark:hover:text-slate-300' }}">EN</a>
            <a href="{{ $idUrl }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-[10px] font-black transition {{ App::getLocale() == 'id' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 hover:text-slate-600 dark:hover:text-slate-300' }}">ID</a>
          </div>
        </div>

        <!-- Hamburger (Mobile) -->
        <div class="md:hidden flex items-center gap-2">
          <!-- Mobile Theme Toggle -->
          <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle dark mode" style="width:44px;height:24px;">
            <span class="theme-toggle-knob" style="width:18px;height:18px;font-size:10px;">
              <i class="fa-solid fa-sun icon-sun"></i>
              <i class="fa-solid fa-moon icon-moon"></i>
            </span>
          </button>
          <button id="hamburger" aria-label="Toggle menu" class="flex flex-col gap-[6px] p-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 transition">
            <span class="ham-line"></span>
            <span class="ham-line"></span>
            <span class="ham-line"></span>
          </button>
        </div>
      </div>

      <!-- Mobile Menu (collapsible, jQuery controlled) -->
      <div id="mobile-menu" class="md:hidden border-t border-slate-100 dark:border-slate-800">
        <ul class="flex flex-col py-4 gap-1 text-sm font-medium text-slate-700 dark:text-slate-300">
          <li><a href="#how-it-works" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Cara Kerja') }}</a></li>
          <li><a href="#benefits" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Manfaat') }}</a></li>
          <li><a href="#pricing" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Harga') }}</a></li>
          <li class="border-t border-slate-100 dark:border-slate-800 mt-2 pt-3 flex gap-2">
            <button onclick="openAuthModal('login')" class="flex-1 text-center px-4 py-2 font-semibold text-brand-600 dark:text-brand-400 border-2 border-brand-600 dark:border-brand-500 rounded-xl hover:bg-brand-50 dark:hover:bg-brand-950 transition">{{ __('Masuk') }}</button>
            <button onclick="openAuthModal('register')" class="flex-1 text-center px-4 py-2 font-semibold text-white bg-brand-600 rounded-xl shadow hover:bg-brand-700 transition">{{ __('Daftar') }}</button>
          </li>
          <li class="mt-2 flex justify-center gap-4">
            <a href="{{ $enUrl }}" class="text-xs font-bold {{ App::getLocale() == 'en' ? 'text-brand-600 underline' : 'text-slate-400' }}">English (EN)</a>
            <a href="{{ $idUrl }}" class="text-xs font-bold {{ App::getLocale() == 'id' ? 'text-brand-600 underline' : 'text-slate-400' }}">Bahasa Indonesia (ID)</a>
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
          {{ __("Platform Closed Testing #1 di Indonesia") }}
        </div>

        <!-- Headline -->
        <h1 class="text-4xl sm:text-5xl lg:text-5xl font-black leading-tight tracking-tight">
          {{ __('Lulus Uji Coba 14 Hari') }}<br />
          <span class="text-brand-200">{{ __('Closed Testing') }}</span><br />
          {{ __('di Google Play Tanpa Ribet') }}
        </h1>

        <!-- Sub-headline -->
        <p class="text-lg text-blue-100 leading-relaxed max-w-lg">
          {{ __('PlayTest ID adalah platform kolaborasi antara') }} <strong class="text-white">Developers</strong> {{ __('yang membutuhkan tester aktif dan') }} <strong class="text-white">Testers</strong> {{ __('yang ingin berkontribusi sambil belajar — dibangun di atas konsep') }} <em>{{ __('Project Based Learning') }}</em>.
        </p>

        <!-- Dual CTA -->
        <div class="flex flex-col sm:flex-row gap-3 pt-2">
          <button onclick="window.location.href='{{ route('filament.developer.auth.login') }}'" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white text-brand-700 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:bg-brand-50 transition duration-300 text-sm">
            <i class="fa-solid fa-rocket"></i>
            {{ __('Saya Butuh Tester') }}
          </button>
          <button onclick="window.location.href='{{ route('filament.tester.auth.login') }}'" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white/10 border border-white/40 text-white font-semibold rounded-2xl hover:bg-white/20 transition duration-300 text-sm backdrop-blur-sm">
            <i class="fa-solid fa-hand-pointer"></i>
            {{ __('Saya Ingin Jadi Tester') }}
          </button>
        </div>

        <!-- Social proof counters -->
        <div class="flex gap-8 pt-4 border-t border-white/20">
          <div>
            <p class="text-3xl font-black">1,200+</p>
            <p class="text-blue-200 text-xs font-medium mt-0.5">{{ __('Tester Aktif') }}</p>
          </div>
          <div class="w-px bg-white/20"></div>
          <div>
            <p class="text-3xl font-black">340+</p>
            <p class="text-blue-200 text-xs font-medium mt-0.5">{{ __('Aplikasi Lulus Uji') }}</p>
          </div>
          <div class="w-px bg-white/20"></div>
          <div>
            <p class="text-3xl font-black">98%</p>
            <p class="text-blue-200 text-xs font-medium mt-0.5">{{ __('Tingkat Keberhasilan') }}</p>
          </div>
        </div>
      </div>

      <!-- ── Right: Glassmorphism Dashboard Card ── -->
      <div class="flex justify-center lg:justify-end animate-floatY">
        <div class="glass-card rounded-3xl p-6 w-full max-w-sm shadow-2xl text-white">

          <!-- Card header -->
          <div class="flex items-center justify-between mb-5">
            <div>
              <p class="text-xs text-blue-200 font-medium uppercase tracking-widest">{{ __('Kampanye Aktif') }}</p>
              <p class="text-lg font-bold mt-0.5">{{ __('MyApp – Closed Testing') }}</p>
            </div>
            <div class="w-10 h-10 bg-green-400/20 rounded-xl flex items-center justify-center">
              <i class="fa-solid fa-circle-check text-green-400 text-lg"></i>
            </div>
          </div>

          <!-- 14 Days Progress -->
          <div class="bg-white/10 rounded-2xl p-4 mb-4">
            <div class="flex justify-between text-xs font-semibold mb-2">
              <span class="text-blue-100">{{ __('Progres 14 Hari') }}</span>
              <span class="text-white">{{ __('Hari') }} 9 / 14</span>
            </div>
            <div class="w-full h-3 bg-white/20 rounded-full overflow-hidden">
              <div class="h-3 bg-gradient-to-r from-green-400 to-emerald-300 rounded-full progress-fill" style="--fill: 64%;"></div>
            </div>
            <p class="text-xs text-blue-200 mt-2">{{ __('64% selesai · diperkirakan lulus dalam') }} <strong class="text-white">5 {{ __('hari lagi') }}</strong></p>
          </div>

          <!-- Tester count -->
          <div class="bg-white/10 rounded-2xl p-4 mb-4">
            <div class="flex items-center justify-between mb-3">
              <span class="text-xs text-blue-100 font-semibold uppercase tracking-widest">{{ __('Tester Aktif') }}</span>
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
              <span class="ml-3 text-xs text-blue-200">{{ __("Semua tester memenuhi syarat Google") }}</span>
            </div>
          </div>

          <!-- Daily chart mini -->
          <div class="bg-white/10 rounded-2xl p-4">
            <p class="text-xs text-blue-100 font-semibold uppercase tracking-widest mb-3">{{ __('Aktivitas Harian') }}</p>
            <div class="flex items-end gap-1.5 h-14">
              <!-- 14 bar mini chart – all active -->
              <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:60%;" title="Day 1"></div>
              <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:80%;" title="Day 2"></div>
              <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:55%;" title="Day 3"></div>
              <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:90%;" title="Day 4"></div>
              <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:70%;" title="Day 5"></div>
              <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:85%;" title="Day 6"></div>
              <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:65%;" title="Day 7"></div>
              <div class="flex-1 bg-green-400/60 rounded-t-sm" style="height:75%;" title="Day 8"></div>
              <div class="flex-1 bg-white/50   rounded-t-sm" style="height:100%;" title="Day 9 – Today"></div>
              <div class="flex-1 bg-white/20   rounded-t-sm" style="height:30%;" title="Day 10 – Upcoming"></div>
              <div class="flex-1 bg-white/20   rounded-t-sm" style="height:20%;"></div>
              <div class="flex-1 bg-white/20   rounded-t-sm" style="height:20%;"></div>
              <div class="flex-1 bg-white/20   rounded-t-sm" style="height:20%;"></div>
              <div class="flex-1 bg-white/20   rounded-t-sm" style="height:20%;"></div>
            </div>
            <div class="flex justify-between text-xs text-blue-300 mt-2 font-medium">
              <span>{{ __('Hari') }} 1</span><span>{{ __('Hari') }} 9 ← {{ __('Anda di sini') }}</span><span>{{ __('Hari') }} 14</span>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Wave divider -->
    <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
      <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-14 fill-slate-50 dark:fill-slate-950">
        <path d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z" />
      </svg>
    </div>
  </section>


  <!-- ════════════════════════════════════════════
     3. HOW IT WORKS – Steps
     ════════════════════════════════════════════ -->
  <section id="how-it-works" class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 dark:bg-slate-950">
    <div class="max-w-7xl mx-auto">

      <div class="text-center mb-14 reveal">
        <span class="text-brand-600 font-semibold text-sm uppercase tracking-widest">{{ __('Cara Kerja') }}</span>
        <h2 class="text-3xl sm:text-4xl font-black text-slate-800 dark:text-white mt-2">{{ __('Tiga Langkah Mudah') }}</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-3 max-w-xl mx-auto">{{ __('Proses yang sederhana, transparan, dan terpantau sepenuhnya untuk memastikan aplikasi Anda lulus closed testing dengan sukses.') }}</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Step 1 -->
        <div class="reveal bg-white dark:bg-slate-900 rounded-2xl p-8 shadow-lg hover:shadow-xl dark:shadow-slate-900/50 transition duration-300 relative text-center border border-transparent dark:border-slate-800">
          <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-brand-600 text-white rounded-full flex items-center justify-center font-black text-sm shadow-lg">1</div>
          <div class="w-16 h-16 bg-brand-100 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <i class="fa-solid fa-upload text-brand-600 dark:text-brand-400 text-2xl"></i>
          </div>
          <h3 class="font-bold text-lg text-slate-800 dark:text-white mb-2">{{ __('Daftar & Unggah Aplikasi') }}</h3>
          <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Developer mendaftar, memilih paket, dan mengirimkan tautan aplikasi Google Play untuk closed testing.') }}</p>
        </div>

        <!-- Step 2 -->
        <div class="reveal bg-white dark:bg-slate-900 rounded-2xl p-8 shadow-lg hover:shadow-xl dark:shadow-slate-900/50 transition duration-300 relative text-center border border-transparent dark:border-slate-800" style="transition-delay: 0.15s;">
          <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-brand-600 text-white rounded-full flex items-center justify-center font-black text-sm shadow-lg">2</div>
          <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <i class="fa-solid fa-users text-green-600 dark:text-green-400 text-2xl"></i>
          </div>
          <h3 class="font-bold text-lg text-slate-800 dark:text-white mb-2">{{ __('20 Tester Bergabung') }}</h3>
          <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Our platform automatically connects 20 verified active testers to your app\'s testing session.') }}</p>
        </div>

        <!-- Step 3 -->
        <div class="reveal bg-white dark:bg-slate-900 rounded-2xl p-8 shadow-lg hover:shadow-xl dark:shadow-slate-900/50 transition duration-300 relative text-center border border-transparent dark:border-slate-800" style="transition-delay: 0.3s;">
          <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-brand-600 text-white rounded-full flex items-center justify-center font-black text-sm shadow-lg">3</div>
          <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <i class="fa-solid fa-trophy text-purple-600 dark:text-purple-400 text-2xl"></i>
          </div>
          <h3 class="font-bold text-lg text-slate-800 dark:text-white mb-2">{{ __('Lulus & Rilis ke Play Store') }}</h3>
          <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Setelah 14 hari berturut-turut dengan 20 tester aktif, aplikasi Anda siap diluncurkan di Google Play Store.') }}</p>
        </div>

      </div>
    </div>
  </section>


  <!-- ════════════════════════════════════════════
     4. DUAL INFO SECTION – Tabbed layout (jQuery)
     ════════════════════════════════════════════ -->
  <section id="benefits" class="py-20 px-4 sm:px-6 lg:px-8 bg-white dark:bg-slate-900">
    <div class="max-w-5xl mx-auto">

      <div class="text-center mb-10 reveal">
        <span class="text-brand-600 dark:text-brand-400 font-semibold text-sm uppercase tracking-widest">{{ __('Manfaat') }}</span>
        <h2 class="text-3xl sm:text-4xl font-black text-slate-800 dark:text-white mt-2">{{ __('Platform untuk Semua Orang') }}</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-3 max-w-xl mx-auto">{{ __('Pilih perspektif Anda dan temukan bagaimana PlayTest ID memberikan nilai nyata.') }}</p>
      </div>

      <!-- ── Tab Switcher ── -->
      <div class="flex justify-center mb-10 reveal">
        <div class="inline-flex bg-slate-100 dark:bg-slate-800 p-1.5 rounded-2xl gap-1">
          <button class="tab-btn active px-6 py-2.5 rounded-xl text-sm font-semibold transition duration-200 hover:bg-white dark:hover:bg-slate-700 focus:outline-none" data-tab="developer">
            <i class="fa-solid fa-code mr-2 text-brand-500"></i>{{ __('Untuk Developer') }}
          </button>
          <button class="tab-btn px-6 py-2.5 rounded-xl text-sm font-semibold text-slate-500 dark:text-slate-400 transition duration-200 hover:bg-white dark:hover:bg-slate-700 focus:outline-none" data-tab="tester">
            <i class="fa-solid fa-mobile-screen-button mr-2 text-slate-400"></i>{{ __('Untuk Tester') }}
          </button>
        </div>
      </div>

      <!-- ── Tab Contents ── -->
      <div id="tab-developer" class="tab-content active reveal">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

          <!-- Benefit 1 -->
          <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 hover:shadow-lg dark:hover:shadow-slate-900/30 transition duration-300">
            <div class="icon-bubble bg-brand-100 dark:bg-brand-900/30 mb-4">
              <i class="fa-solid fa-magnifying-glass text-brand-600 dark:text-brand-400 text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-800 dark:text-white mb-2">{{ __('Cari Tester dengan Mudah') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Tidak perlu mencari manual. Sistem kami secara instan menghubungkan Anda dengan 20 tester aktif terverifikasi.') }}</p>
          </div>

          <!-- Benefit 2 -->
          <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 hover:shadow-lg dark:hover:shadow-slate-900/30 transition duration-300">
            <div class="icon-bubble bg-green-100 dark:bg-green-900/30 mb-4">
              <i class="fa-solid fa-calendar-check text-green-600 dark:text-green-400 text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-800 dark:text-white mb-2">{{ __('Validasi 14 Hari Otomatis') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('A real-time dashboard monitors each tester\'s activity for 14 consecutive days as required by Google Play Console.') }}</p>
          </div>

          <!-- Benefit 3 -->
          <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 hover:shadow-lg dark:hover:shadow-slate-900/30 transition duration-300">
            <div class="icon-bubble bg-red-100 dark:bg-red-900/30 mb-4">
              <i class="fa-solid fa-shield-halved text-red-500 dark:text-red-400 text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-800 dark:text-white mb-2">{{ __('Hindari Penolakan Google') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Our structured process ensures all of Google\'s technical requirements are met so your app won\'t be rejected at launch.') }}</p>
          </div>

        </div>
      </div>

      <div id="tab-tester" class="tab-content reveal">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

          <!-- Benefit 1 -->
          <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 hover:shadow-lg dark:hover:shadow-slate-900/30 transition duration-300">
            <div class="icon-bubble bg-yellow-100 dark:bg-yellow-900/30 mb-4">
              <i class="fa-solid fa-star text-yellow-500 dark:text-yellow-400 text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-800 dark:text-white mb-2">{{ __('Akses Awal Aplikasi') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Jadilah yang pertama mencoba aplikasi inovatif dari developer Indonesia sebelum resmi diluncurkan ke publik.') }}</p>
          </div>

          <!-- Benefit 2 -->
          <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 hover:shadow-lg dark:hover:shadow-slate-900/30 transition duration-300">
            <div class="icon-bubble bg-purple-100 dark:bg-purple-900/30 mb-4">
              <i class="fa-solid fa-graduation-cap text-purple-600 dark:text-purple-400 text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-800 dark:text-white mb-2">{{ __('Pengalaman Belajar Berbasis Proyek') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Tingkatkan keterampilan QA dan pengujian perangkat lunak Anda melalui proyek nyata — pengalaman yang dapat Anda tambahkan langsung ke portofolio.') }}</p>
          </div>

          <!-- Benefit 3 -->
          <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 hover:shadow-lg dark:hover:shadow-slate-900/30 transition duration-300">
            <div class="icon-bubble bg-brand-100 dark:bg-brand-900/30 mb-4">
              <i class="fa-solid fa-people-group text-brand-600 dark:text-brand-400 text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-800 dark:text-white mb-2">{{ __('Komunitas Aktif') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Bergabunglah dengan ribuan tester dan developer di komunitas PlayTest ID — berbagi pengetahuan, berdiskusi, dan temukan peluang kolaborasi.') }}</p>
          </div>

        </div>
      </div>

    </div>
  </section>


  <!-- ════════════════════════════════════════════
     5. PRICING TABLE – Two cards side by side
     ════════════════════════════════════════════ -->
  <section id="pricing" class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 dark:bg-slate-950 relative overflow-hidden">

    <!-- Decoration -->
    <div class="absolute inset-0 bg-gradient-to-br from-brand-50/60 via-slate-50 to-slate-50 dark:from-brand-950/20 dark:via-slate-950 dark:to-slate-950 pointer-events-none"></div>

    <div class="max-w-5xl mx-auto relative">

      <div class="text-center mb-14 reveal">
        <span class="text-brand-600 dark:text-brand-400 font-semibold text-sm uppercase tracking-widest">{{ __('Harga') }}</span>
        <h2 class="text-3xl sm:text-4xl font-black text-slate-800 dark:text-white mt-2">{{ __('Pilih Paket Pengujian Anda') }}</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-3 max-w-xl mx-auto">{{ __('Investasi sekali bayar untuk memastikan aplikasi Anda lulus closed testing dengan sukses dan siap diluncurkan ke jutaan pengguna.') }}</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

        <!-- ── Card 1: Starter ── -->
        <div class="pricing-card reveal bg-white dark:bg-slate-900 rounded-2xl p-8 shadow-lg border border-slate-100 dark:border-slate-800">

          <div class="mb-6">
            <div class="inline-flex items-center gap-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-4">
              <i class="fa-solid fa-seedling text-green-500"></i> {{ __('Paket Starter') }}
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Solusi dasar untuk memenuhi persyaratan Google Play Closed Testing.') }}</p>
          </div>

          <!-- Price -->
          <div class="mb-6 pb-6 border-b border-slate-100 dark:border-slate-800">
            <div class="flex items-baseline gap-1">
              <span class="text-slate-400 text-sm font-medium">Rp</span>
              <span class="text-5xl font-black text-slate-800 dark:text-white">300</span>
              <span class="text-slate-400 text-lg font-medium">.000</span>
            </div>
            <p class="text-slate-400 text-xs mt-1">{{ __('Sekali bayar · akses penuh 14 hari') }}</p>
          </div>

          <!-- Features -->
          <ul class="check-list text-sm text-slate-600 dark:text-slate-300 mb-8 space-y-0">
            <li><i class="fa-solid fa-circle-check text-green-500"></i><span>{{ __('Akses ke 20 Tester Aktif & Terverifikasi') }}</span></li>
            <li><i class="fa-solid fa-circle-check text-green-500"></i><span>{{ __('14 Hari Pengujian Penuh Berturut-turut') }}</span></li>
            <li><i class="fa-solid fa-circle-check text-green-500"></i><span>{{ __('Laporan Pengujian Standar') }}</span></li>
            <li><i class="fa-solid fa-circle-check text-green-500"></i><span>{{ __('Dukungan Komunitas PlayTest ID') }}</span></li>
          </ul>

          <a href="#" class="block w-full text-center py-3.5 rounded-xl font-bold text-brand-700 dark:text-brand-400 border-2 border-brand-600 dark:border-brand-500 hover:bg-brand-600 hover:text-white transition duration-300 text-sm">
            {{ __('Pilih Starter') }}
          </a>
        </div>

        <!-- ── Card 2: Pro (Best Value) ── -->
        <div class="pricing-card reveal relative" style="transition-delay: 0.15s;">

          <!-- Popular badge floating above card -->
          <div class="flex justify-center mb-3">
            <span class="badge-popular">
              <i class="fa-solid fa-fire mr-1"></i> {{ __('Paling Populer') }}
            </span>
          </div>

          <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 shadow-2xl border-2 border-brand-600 relative overflow-hidden">

            <!-- Corner ribbon glow -->
            <div class="absolute -top-10 -right-10 w-36 h-36 bg-brand-500/10 rounded-full blur-2xl"></div>

            <div class="mb-6 relative">
              <div class="inline-flex items-center gap-2 bg-brand-600 text-white text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-4">
                <i class="fa-solid fa-gem"></i> {{ __('Paket Pro') }}
              </div>
              <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Solusi premium untuk optimasi lengkap sebelum aplikasi Anda dipublikasikan.') }}</p>
            </div>

            <!-- Price -->
            <div class="mb-6 pb-6 border-b border-slate-100 dark:border-slate-800 relative">
              <div class="flex items-baseline gap-1">
                <span class="text-brand-400 text-sm font-medium">Rp</span>
                <span class="text-5xl font-black text-brand-700 dark:text-brand-400">500</span>
                <span class="text-brand-400 text-lg font-medium">.000</span>
              </div>
              <p class="text-slate-400 text-xs mt-1">{{ __('Sekali bayar · akses prioritas penuh') }}</p>
            </div>

            <!-- Features -->
            <ul class="check-list text-sm text-slate-600 dark:text-slate-300 mb-8 relative space-y-0">
              <li><i class="fa-solid fa-circle-check text-brand-500"></i><span>{{ __('Semua Fitur Paket Starter') }}</span></li>
              <li><i class="fa-solid fa-circle-check text-brand-500"></i><span>{{ __('Laporan Bug & UX Mendalam per Tester') }}</span></li>
              <li><i class="fa-solid fa-circle-check text-brand-500"></i><span>{{ __('Antrean Prioritas (Mulai Lebih Cepat)') }}</span></li>
              <li><i class="fa-solid fa-circle-check text-brand-500"></i><span>{{ __('Review Komprehensif dari Setiap Tester') }}</span></li>
              <li><i class="fa-solid fa-circle-check text-brand-500"></i><span>{{ __('Dukungan Prioritas via Live Chat') }}</span></li>
            </ul>

            <a href="#" class="relative block w-full text-center py-3.5 rounded-xl font-bold text-white bg-gradient-to-r from-brand-600 to-brand-500 shadow-lg shadow-brand-200 dark:shadow-brand-900/50 hover:shadow-brand-300 hover:from-brand-700 hover:to-brand-600 transition duration-300 text-sm">
              <i class="fa-solid fa-bolt mr-1"></i> {{ __('Pilih Pro – Mulai Sekarang') }}
            </a>

            <p class="text-center text-xs text-slate-400 mt-3">
              <i class="fa-solid fa-lock text-xs mr-1"></i>{{ __('Pembayaran aman · garansi 7 hari') }}
            </p>

          </div>
        </div>

      </div>

      <!-- Comparison note -->
      <div class="mt-10 text-center reveal">
        <p class="text-slate-400 text-sm">
          <i class="fa-solid fa-circle-info text-brand-400 mr-1"></i>
          {{ __('Semua paket termasuk akses ke dasbor pemantauan real-time 14 hari.') }}
          <a href="#" class="text-brand-600 dark:text-brand-400 font-semibold hover:underline ml-1">{{ __('Lihat perbandingan lengkap →') }}</a>
        </p>
      </div>

    </div>
  </section>


  <!-- ════════════════════════════════════════════
     6. TESTIMONIAL (bonus) – Social proof
     ════════════════════════════════════════════ -->
  <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white dark:bg-slate-900">
    <div class="max-w-6xl mx-auto">

      <div class="text-center mb-10 reveal">
        <span class="text-brand-600 dark:text-brand-400 font-semibold text-sm uppercase tracking-widest">{{ __('Testimoni') }}</span>
        <h2 class="text-2xl sm:text-3xl font-black text-slate-800 dark:text-white mt-2">{{ __('Dipercaya oleh Developer & Tester Indonesia') }}</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="reveal bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 shadow-sm hover:shadow-md dark:hover:shadow-slate-900/30 transition duration-300">
          <div class="flex gap-1 text-yellow-400 mb-3 text-sm">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">"{{ __('Saya pernah mencoba platform lain dan gagal. Dengan PlayTest ID, aplikasi saya lulus dalam 14 hari dan sekarang sudah live di Play Store!') }}"</p>
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-brand-200 dark:bg-brand-900/50 rounded-full flex items-center justify-center font-bold text-brand-700 dark:text-brand-300 text-sm">RD</div>
            <div>
              <p class="font-semibold text-slate-800 dark:text-white text-sm">Rizky D.</p>
              <p class="text-slate-400 text-xs">Developer – Jakarta</p>
            </div>
          </div>
        </div>

        <div class="reveal bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 shadow-sm hover:shadow-md dark:hover:shadow-slate-900/30 transition duration-300" style="transition-delay:0.1s;">
          <div class="flex gap-1 text-yellow-400 mb-3 text-sm">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">"{{ __('Sebagai tester, saya mendapatkan pengalaman QA nyata dan bisa menambahkannya ke CV saya. Komunitas PlayTest ID sangat mendukung!') }}"</p>
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-green-200 dark:bg-green-900/50 rounded-full flex items-center justify-center font-bold text-green-700 dark:text-green-300 text-sm">AN</div>
            <div>
              <p class="font-semibold text-slate-800 dark:text-white text-sm">Ari N.</p>
              <p class="text-slate-400 text-xs">Tester – Surabaya</p>
            </div>
          </div>
        </div>

        <div class="reveal bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 shadow-sm hover:shadow-md dark:hover:shadow-slate-900/30 transition duration-300" style="transition-delay:0.2s;">
          <div class="flex gap-1 text-yellow-400 mb-3 text-sm">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">"{{ __('Dasbor pemantauannya sangat membantu. Saya bisa melacak progres 14 hari secara real-time. Paket Pro sangat layak!') }}"</p>
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-purple-200 dark:bg-purple-900/50 rounded-full flex items-center justify-center font-bold text-purple-700 dark:text-purple-300 text-sm">FH</div>
            <div>
              <p class="font-semibold text-slate-800 dark:text-white text-sm">Fajar H.</p>
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
        <i class="fa-solid fa-rocket"></i> {{ __('Mulai perjalanan Anda hari ini') }}
      </div>

      <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-4">
        {{ __('Siap Meluncurkan Aplikasi Anda di Play Store?') }}
      </h2>

      <p class="text-blue-100 text-lg leading-relaxed mb-8 max-w-2xl mx-auto">
        {{ __('Atau Anda ingin mulai membantu developer lain sambil membangun pengalaman QA Anda? Bergabunglah dengan') }} <strong class="text-white">PlayTest ID</strong> {{ __('now and become part of Indonesia\'s best testing ecosystem.') }}
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <button onclick="window.location.href='{{ route('filament.developer.auth.register') }}'" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-brand-700 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition duration-300">
          <i class="fa-solid fa-rocket"></i> {{ __('Mulai sebagai Developer') }}
        </button>
        <button onclick="window.location.href='{{ route('filament.tester.auth.register') }}'" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 border border-white/30 text-white font-semibold rounded-2xl hover:bg-white/20 transition duration-300 backdrop-blur-sm">
          <i class="fa-solid fa-hand-pointer"></i> {{ __('Daftar sebagai Tester') }}
        </button>
      </div>

      <!-- Trust indicators -->
      <div class="flex justify-center gap-8 mt-10 flex-wrap">
        <div class="flex items-center gap-2 text-blue-200 text-xs font-medium">
          <i class="fa-solid fa-shield-halved text-green-400"></i> {{ __('Pembayaran Aman') }}
        </div>
        <div class="flex items-center gap-2 text-blue-200 text-xs font-medium">
          <i class="fa-solid fa-rotate-left text-yellow-400"></i> {{ __('Garansi 7 Hari') }}
        </div>
        <div class="flex items-center gap-2 text-blue-200 text-xs font-medium">
          <i class="fa-solid fa-headset text-blue-300"></i> {{ __('Dukungan 24/7') }}
        </div>
      </div>

    </div>
  </section>


  <!-- ════════════════════════════════════════════
     8. FOOTER
     ════════════════════════════════════════════ -->
  <footer class="bg-slate-900 dark:bg-slate-950 text-slate-400 py-12 px-4 sm:px-6 lg:px-8 border-t border-transparent dark:border-slate-800">
    <div class="max-w-7xl mx-auto">

      <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-10 border-b border-slate-800 dark:border-slate-800">

        <!-- Brand -->
        <div class="md:col-span-2">
          <div class="flex items-center mb-4">
            <img src="{{ asset('logo.png') }}" alt="PlayTest ID" class="h-12 w-auto object-contain" />
          </div>
          <p class="text-sm leading-relaxed max-w-xs">{{ __('Platform kolaborasi untuk Developer dan Tester Indonesia berbasis Project Based Learning untuk memenuhi persyaratan Google Play Closed Testing.') }}</p>
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
          <h5 class="text-white font-bold text-sm mb-4">{{ __('Platform') }}</h5>
          <ul class="space-y-2.5 text-sm">
            <li><a href="#how-it-works" class="hover:text-white transition">{{ __('Cara Kerja') }}</a></li>
            <li><a href="#benefits" class="hover:text-white transition">{{ __('Manfaat') }}</a></li>
            <li><a href="#pricing" class="hover:text-white transition">{{ __('Harga') }}</a></li>
            <li><a href="#" class="hover:text-white transition">{{ __('Dasbor') }}</a></li>
            <li><a href="#" class="hover:text-white transition">{{ __('Blog') }}</a></li>
          </ul>
        </div>

        <!-- Legal links -->
        <div>
          <h5 class="text-white font-bold text-sm mb-4">{{ __('Legal & Dukungan') }}</h5>
          <ul class="space-y-2.5 text-sm">
            <li><a href="#" class="hover:text-white transition">{{ __('Kebijakan Privasi') }}</a></li>
            <li><a href="#" class="hover:text-white transition">{{ __('Syarat & Ketentuan') }}</a></li>
            <li><a href="#" class="hover:text-white transition">{{ __('FAQ') }}</a></li>
            <li><a href="#" class="hover:text-white transition">{{ __('Hubungi Kami') }}</a></li>
          </ul>
        </div>

      </div>

      <!-- Bottom bar -->
      <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
        <p>© 2026 <span class="text-slate-400 font-semibold">PlayTest ID</span>. {{ __('Hak cipta dilindungi undang-undang.') }}</p>
        <p>{{ __('Dibuat dengan') }} <i class="fa-solid fa-heart text-red-500 mx-1"></i> {{ __('untuk Developer & Tester Indonesia.') }}</p>
      </div>

    </div>
  </footer>


  <!-- ════════════════════════════════════════════
     9. AUTH MODAL (Login/Register Selection)
     ════════════════════════════════════════════ -->
  <div id="authModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeAuthModal()"></div>

    <!-- Modal Content -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md relative z-10 shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 border border-transparent dark:border-slate-800" id="authModalContent">
      <button onclick="closeAuthModal()" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 hover:text-slate-800 dark:hover:text-white transition">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <div class="p-8">
        <div class="text-center mb-8">
          <div class="w-12 h-12 bg-brand-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <i id="authModalIcon" class="fa-solid fa-user-lock text-brand-600 text-xl"></i>
          </div>
          <h3 id="authModalTitle" class="text-2xl font-black text-slate-800">{{ __('Pilih Akun') }}</h3>
          <p id="authModalDesc" class="text-slate-500 text-sm mt-2">{{ __('Silakan pilih peran Anda untuk melanjutkan.') }}</p>
        </div>
        <div class="space-y-4">
          <!-- Developer -->
          <a id="btnAuthDeveloper" href="#" class="group flex items-center p-4 border-2 border-slate-100 dark:border-slate-800 rounded-2xl hover:border-brand-500 hover:bg-brand-50 dark:hover:bg-brand-950 transition duration-300">
            <div class="w-12 h-12 bg-slate-100 dark:bg-slate-800 group-hover:bg-brand-100 dark:group-hover:bg-brand-900/30 rounded-xl flex items-center justify-center transition duration-300">
              <i class="fa-solid fa-code text-slate-500 dark:text-slate-400 group-hover:text-brand-600 dark:group-hover:text-brand-400"></i>
            </div>
            <div class="ml-4 flex-1">
              <h4 class="font-bold text-slate-800 dark:text-white group-hover:text-brand-700 dark:group-hover:text-brand-400 transition">{{ __('Developer') }}</h4>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ __('Pemilik aplikasi yang butuh tester') }}</p>
            </div>
            <i class="fa-solid fa-chevron-right text-slate-300 dark:text-slate-600 group-hover:text-brand-500 transition"></i>
          </a>
          <!-- Tester -->
          <a id="btnAuthTester" href="#" class="group flex items-center p-4 border-2 border-slate-100 dark:border-slate-800 rounded-2xl hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-950 transition duration-300">
            <div class="w-12 h-12 bg-slate-100 dark:bg-slate-800 group-hover:bg-green-100 dark:group-hover:bg-green-900/30 rounded-xl flex items-center justify-center transition duration-300">
              <i class="fa-solid fa-mobile-screen-button text-slate-500 dark:text-slate-400 group-hover:text-green-600 dark:group-hover:text-green-400"></i>
            </div>
            <div class="ml-4 flex-1">
              <h4 class="font-bold text-slate-800 dark:text-white group-hover:text-green-700 dark:group-hover:text-green-400 transition">{{ __('Tester') }}</h4>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ __('Penguji aplikasi untuk Google Play') }}</p>
            </div>
            <i class="fa-solid fa-chevron-right text-slate-300 dark:text-slate-600 group-hover:text-green-500 transition"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    const authRoutes = {
      login: {
        developer: "{{ route('filament.developer.auth.login') }}",
        tester: "{{ route('filament.tester.auth.login') }}"
      },
      register: {
        developer: "{{ route('filament.developer.auth.register') }}",
        tester: "{{ route('filament.tester.auth.register') }}"
      }
    };

    function openAuthModal(type) {
      const modal = document.getElementById('authModal');
      const content = document.getElementById('authModalContent');
      const title = document.getElementById('authModalTitle');
      const desc = document.getElementById('authModalDesc');
      const icon = document.getElementById('authModalIcon');
      const btnDev = document.getElementById('btnAuthDeveloper');
      const btnTester = document.getElementById('btnAuthTester');

      // Close mobile menu if open
      document.getElementById('hamburger').classList.remove('open');
      document.getElementById('mobile-menu').classList.remove('open');

      if (type === 'login') {
        title.innerText = '{{ __("Masuk Sebagai") }}';
        desc.innerText = '{{ __("Pilih akun untuk mengakses dasbor Anda.") }}';
        icon.className = 'fa-solid fa-right-to-bracket text-brand-600 text-xl';
        btnDev.href = authRoutes.login.developer;
        btnTester.href = authRoutes.login.tester;
      } else {
        title.innerText = '{{ __("Daftar Sebagai") }}';
        desc.innerText = '{{ __("Pilih peran yang sesuai dengan tujuan Anda.") }}';
        icon.className = 'fa-solid fa-user-plus text-brand-600 text-xl';
        btnDev.href = authRoutes.register.developer;
        btnTester.href = authRoutes.register.tester;
      }

      modal.classList.remove('hidden');
      modal.classList.add('flex');
      setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
      }, 10);
    }

    function closeAuthModal() {
      const modal = document.getElementById('authModal');
      const content = document.getElementById('authModalContent');
      content.classList.remove('scale-100', 'opacity-100');
      content.classList.add('scale-95', 'opacity-0');
      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }, 300);
    }
  </script>

  <!-- ════════════════════════════════════════════
     THEME TOGGLE FUNCTION
     ════════════════════════════════════════════ -->
  <script>
    function toggleTheme() {
      const html = document.documentElement;
      if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.setItem('pt-theme', 'light');
      } else {
        html.classList.add('dark');
        localStorage.setItem('pt-theme', 'dark');
      }
    }
  </script>


  <!-- ════════════════════════════════════════════
     SCRIPTS – jQuery 3.7.1 Interactions
     ════════════════════════════════════════════ -->
  <script>
    $(function() {

      /* ── 1. NAVBAR: Sticky scroll shadow ── */
      $(window).on('scroll', function() {
        if ($(this).scrollTop() > 10) {
          $('#navbar').addClass('scrolled');
        } else {
          $('#navbar').removeClass('scrolled');
        }
      });

      /* ── 2. HAMBURGER MENU: Toggle mobile menu ── */
      $('#hamburger').on('click', function() {
        $(this).toggleClass('open');
        $('#mobile-menu').toggleClass('open');
      });

      /* Close mobile menu when a link is clicked */
      $('#mobile-menu a').on('click', function() {
        $('#hamburger').removeClass('open');
        $('#mobile-menu').removeClass('open');
      });

      /* ── 3. SMOOTH SCROLLING: All anchor links ── */
      $('a[href^="#"]').on('click', function(e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
          e.preventDefault();
          $('html, body').stop().animate({
            scrollTop: target.offset().top - 64 // 64px navbar offset
          }, 600, 'swing');
        }
      });

      /* ── 4. TAB SWITCHING: Developer / Tester ── */
      $('.tab-btn').on('click', function() {
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

        $('.reveal').each(function() {
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
      $(window).on('scroll', function() {
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
      var sections = ['how-it-works', 'benefits', 'pricing'];
      $(window).on('scroll', function() {
        var scrollPos = $(this).scrollTop() + 80;
        sections.forEach(function(id) {
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