<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'PlayTest ID – Closed Testing Partner')</title>
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
              '0%': { opacity: '0', transform: 'translateY(24px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            floatY: {
              '0%,100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-10px)' }
            },
            pulseDot: {
              '0%,100%': { opacity: '1' },
              '50%': { opacity: '0.4' }
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
    * { font-family: 'Inter', sans-serif; }
    html { scroll-behavior: smooth; }

    #navbar.scrolled {
      box-shadow: 0 4px 24px 0 rgba(37, 99, 235, 0.08);
      background: rgba(255, 255, 255, 0.97);
    }
    .dark #navbar.scrolled {
      box-shadow: 0 4px 24px 0 rgba(0, 0, 0, 0.3);
      background: rgba(15, 23, 42, 0.97);
    }

    .ham-line {
      display: block; width: 24px; height: 2px;
      background: #1e40af; border-radius: 2px;
      transition: all 0.3s ease; transform-origin: center;
    }
    .dark .ham-line { background: #93c5fd; }

    #hamburger.open .ham-line:nth-child(1) { transform: translateY(8px) rotate(45deg); }
    #hamburger.open .ham-line:nth-child(2) { opacity: 0; transform: scaleX(0); }
    #hamburger.open .ham-line:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

    #mobile-menu {
      max-height: 0; overflow: hidden;
      transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    #mobile-menu.open { max-height: 500px; }

    .theme-toggle {
      position: relative; width: 52px; height: 28px;
      border-radius: 9999px; cursor: pointer; border: none; outline: none;
      transition: background 0.3s ease;
      background: linear-gradient(135deg, #bfdbfe, #93c5fd);
      box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
    }
    .dark .theme-toggle { background: linear-gradient(135deg, #1e293b, #334155); }
    .theme-toggle-knob {
      position: absolute; top: 3px; left: 3px; width: 22px; height: 22px;
      border-radius: 50%; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.2);
      transition: transform 0.3s cubic-bezier(.4,0,.2,1);
      display: flex; align-items: center; justify-content: center; font-size: 12px;
    }
    .dark .theme-toggle-knob { transform: translateX(24px); background: #1e293b; }
    .theme-toggle-knob .icon-sun, .theme-toggle-knob .icon-moon { transition: opacity 0.2s; }
    .theme-toggle-knob .icon-sun { color: #f59e0b; }
    .theme-toggle-knob .icon-moon { color: #60a5fa; position: absolute; }
    .dark .theme-toggle-knob .icon-sun { opacity: 0; }
    .theme-toggle-knob .icon-moon { opacity: 0; }
    .dark .theme-toggle-knob .icon-moon { opacity: 1; }

    body, #navbar, .pricing-card > div, .glass-card {
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
  </style>
  @yield('styles')
</head>

<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased">

  <!-- ════════════════════════════════════════════
     NAVBAR
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
          <li><a href="/{{ App::getLocale() }}#how-it-works" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Cara Kerja') }}</a></li>
          <li><a href="/{{ App::getLocale() }}#benefits" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Manfaat') }}</a></li>
          <li><a href="/{{ App::getLocale() }}#pricing" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Harga') }}</a></li>
          <li><a href="/{{ App::getLocale() }}#hero" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Dasbor') }}</a></li>
          <li><a href="/{{ App::getLocale() }}#testi" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Blog') }}</a></li>
          
          <!-- Dropdown Legal & Support -->
          <li class="relative">
            <button id="legal-dropdown-btn" class="flex items-center gap-1.5 hover:text-brand-600 dark:hover:text-brand-400 transition duration-200 focus:outline-none">
              {{ __('Legal & Dukungan') }}
              <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" id="legal-dropdown-arrow"></i>
            </button>
            <!-- Dropdown Menu -->
            <ul id="legal-dropdown-menu" class="absolute left-0 mt-3 w-52 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-xl py-2 hidden z-50 transform scale-95 opacity-0 transition-all duration-200 origin-top-left">
              <li><a href="{{ route('privacy-policy', ['locale' => App::getLocale()]) }}" class="block px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Kebijakan Privasi') }}</a></li>
              <li><a href="{{ route('terms-conditions', ['locale' => App::getLocale()]) }}" class="block px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Syarat & Ketentuan') }}</a></li>
              <li><a href="{{ route('faq', ['locale' => App::getLocale()]) }}" class="block px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('FAQ') }}</a></li>
              <li><a href="{{ route('contact-us', ['locale' => App::getLocale()]) }}" class="block px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Hubungi Kami') }}</a></li>
            </ul>
          </li>
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
          <li><a href="/{{ App::getLocale() }}#how-it-works" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Cara Kerja') }}</a></li>
          <li><a href="/{{ App::getLocale() }}#benefits" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Manfaat') }}</a></li>
          <li><a href="/{{ App::getLocale() }}#pricing" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Harga') }}</a></li>
          <li><a href="/{{ App::getLocale() }}#hero" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Dasbor') }}</a></li>
          <li><a href="/{{ App::getLocale() }}#testi" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Blog') }}</a></li>
          
          <!-- Mobile Accordion Legal & Support -->
          <li class="border-b border-slate-100 dark:border-slate-800 pb-1">
            <button id="legal-mobile-btn" class="flex w-full items-center justify-between px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition focus:outline-none">
              <span>{{ __('Legal & Dukungan') }}</span>
              <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" id="legal-mobile-arrow"></i>
            </button>
            <ul id="legal-mobile-menu" class="hidden pl-4 pr-3 py-1.5 flex-col gap-1 text-sm">
              <li><a href="{{ route('privacy-policy', ['locale' => App::getLocale()]) }}" class="block py-2 text-slate-500 dark:text-slate-400 hover:text-brand-600 transition">{{ __('Kebijakan Privasi') }}</a></li>
              <li><a href="{{ route('terms-conditions', ['locale' => App::getLocale()]) }}" class="block py-2 text-slate-500 dark:text-slate-400 hover:text-brand-600 transition">{{ __('Syarat & Ketentuan') }}</a></li>
              <li><a href="{{ route('faq', ['locale' => App::getLocale()]) }}" class="block py-2 text-slate-500 dark:text-slate-400 hover:text-brand-600 transition">{{ __('FAQ') }}</a></li>
              <li><a href="{{ route('contact-us', ['locale' => App::getLocale()]) }}" class="block py-2 text-slate-500 dark:text-slate-400 hover:text-brand-600 transition">{{ __('Hubungi Kami') }}</a></li>
            </ul>
          </li>

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
     MAIN CONTENT
     ════════════════════════════════════════════ -->
  <main class="min-h-screen">
    @yield('content')
  </main>

  <!-- ════════════════════════════════════════════
     FOOTER
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
            <li><a href="/{{ App::getLocale() }}#how-it-works" class="hover:text-white transition">{{ __('Cara Kerja') }}</a></li>
            <li><a href="/{{ App::getLocale() }}#benefits" class="hover:text-white transition">{{ __('Manfaat') }}</a></li>
            <li><a href="/{{ App::getLocale() }}#pricing" class="hover:text-white transition">{{ __('Harga') }}</a></li>
            <li><a href="/{{ App::getLocale() }}#hero" class="hover:text-white transition">{{ __('Dasbor') }}</a></li>
            <li><a href="/{{ App::getLocale() }}#testi" class="hover:text-white transition">{{ __('Blog') }}</a></li>
          </ul>
        </div>

        <!-- Legal links -->
        <div>
          <h5 class="text-white font-bold text-sm mb-4">{{ __('Legal & Dukungan') }}</h5>
          <ul class="space-y-2.5 text-sm">
            <li><a href="{{ route('privacy-policy', ['locale' => App::getLocale()]) }}" class="hover:text-white transition">{{ __('Kebijakan Privasi') }}</a></li>
            <li><a href="{{ route('terms-conditions', ['locale' => App::getLocale()]) }}" class="hover:text-white transition">{{ __('Syarat & Ketentuan') }}</a></li>
            <li><a href="{{ route('faq', ['locale' => App::getLocale()]) }}" class="hover:text-white transition">{{ __('FAQ') }}</a></li>
            <li><a href="{{ route('contact-us', ['locale' => App::getLocale()]) }}" class="hover:text-white transition">{{ __('Hubungi Kami') }}</a></li>
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
     AUTH MODAL
     ════════════════════════════════════════════ -->
  <div id="authModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeAuthModal()"></div>
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

  <!-- ─── Theme Toggle ─── -->
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

  <!-- ─── Core Scripts ─── -->
  <script>
    $(function() {
      // Sticky scroll shadow
      $(window).on('scroll', function() {
        if ($(this).scrollTop() > 10) {
          $('#navbar').addClass('scrolled');
        } else {
          $('#navbar').removeClass('scrolled');
        }
      });

      // Hamburger menu toggle
      $('#hamburger').on('click', function() {
        $(this).toggleClass('open');
        $('#mobile-menu').toggleClass('open');
      });

      $('#mobile-menu a').on('click', function() {
        $('#hamburger').removeClass('open');
        $('#mobile-menu').removeClass('open');
      });

      // Smooth scroll for anchor links
      $('a[href^="#"], a[href^="/id#"], a[href^="/en#"]').on('click', function(e) {
        var href = this.getAttribute('href');
        var hash = href.substring(href.indexOf('#'));
        var target = $(hash);
        if (target.length) {
          e.preventDefault();
          $('html, body').stop().animate({
            scrollTop: target.offset().top - 64
          }, 600, 'swing');
        }
      });

      /* ── 8. LEGAL DROPDOWN (Navbar) ── */
      $('#legal-dropdown-btn').on('click', function(e) {
        e.stopPropagation();
        var menu = $('#legal-dropdown-menu');
        var arrow = $('#legal-dropdown-arrow');
        
        if (menu.hasClass('hidden')) {
          menu.removeClass('hidden');
          setTimeout(function() {
            menu.removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
          }, 10);
          arrow.addClass('rotate-180');
        } else {
          menu.removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
          setTimeout(function() {
            menu.addClass('hidden');
          }, 200);
          arrow.removeClass('rotate-180');
        }
      });
      
      $(document).on('click', function() {
        var menu = $('#legal-dropdown-menu');
        if (!menu.hasClass('hidden')) {
          menu.removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
          setTimeout(function() {
            menu.addClass('hidden');
          }, 200);
          $('#legal-dropdown-arrow').removeClass('rotate-180');
        }
      });

      /* ── 9. LEGAL MOBILE ACCORDION ── */
      $('#legal-mobile-btn').on('click', function() {
        var menu = $('#legal-mobile-menu');
        var arrow = $('#legal-mobile-arrow');
        
        if (menu.hasClass('hidden')) {
          menu.removeClass('hidden').addClass('flex');
          arrow.addClass('rotate-180');
        } else {
          menu.removeClass('flex').addClass('hidden');
          arrow.removeClass('rotate-180');
        }
      });
    });
  </script>
  @yield('scripts')
</body>

</html>
