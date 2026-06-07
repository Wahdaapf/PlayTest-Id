{{--
    PlayTest ID — Enhanced Filament Topbar (v3)
    Adds: animated gradient line, scroll progress bar, brand glow,
          greeting widget, ⌘K hint on global search.
    Keep this file at: resources/views/vendor/filament-panels/components/topbar/index.blade.php
--}}
<div class="fi-topbar-ctn">
    @php
    $isRtl = __('filament-panels::layout.direction') === 'rtl';
    $isSidebarCollapsibleOnDesktop = filament()->isSidebarCollapsibleOnDesktop();
    $isSidebarFullyCollapsibleOnDesktop = filament()->isSidebarFullyCollapsibleOnDesktop();
    $hasTopNavigation = filament()->hasTopNavigation();
    $hasNavigation = filament()->hasNavigation();
    $hasTenancy = filament()->hasTenancy();

    $hour = (int) now()->format('H');
    if (\Illuminate\Support\Facades\App::getLocale() === 'en') {
        $greeting = $hour < 4 ? 'Good Night' : ($hour < 12 ? 'Good Morning' : ($hour < 17 ? 'Good Afternoon' : ($hour < 21 ? 'Good Evening' : 'Good Night')));
    } else {
        $greeting = $hour < 2 ? 'Selamat Malam' : ($hour < 11 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 19 ? 'Selamat Sore' : 'Selamat Malam')));
    }
    $userName = filament()->auth()->check() ? (filament()->auth()->user()->name ?? 'Admin') : 'Admin';
        @endphp

        <nav class="fi-topbar"
            x-data="{ scroll: 0 }"
            x-init="
            const update = () => {
                const h = document.documentElement;
                const max = (h.scrollHeight - h.clientHeight) || 1;
                scroll = Math.min(100, (h.scrollTop || window.scrollY) / max * 100);
                $el.style.setProperty('--scroll', scroll + '%');
            };
            update();
            window.addEventListener('scroll', update, { passive: true });
            window.addEventListener('resize', update);
         ">
            {{-- Animated decorations --}}
            <div class="topbar-gradient-line"></div>
            <div class="topbar-scroll-progress" aria-hidden="true"></div>

            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_START) }}

            @if ($hasNavigation)
            <x-filament::icon-button
                color="gray"
                :icon="\Filament\Support\Icons\Heroicon::OutlinedBars3"
                :icon-alias="\Filament\View\PanelsIconAlias::TOPBAR_OPEN_SIDEBAR_BUTTON"
                icon-size="lg"
                :label="__('filament-panels::layout.actions.sidebar.expand.label')"
                x-cloak
                x-data="{}"
                x-on:click="$store.sidebar.open()"
                x-show="! $store.sidebar.isOpen"
                class="fi-topbar-open-sidebar-btn" />

            <x-filament::icon-button
                color="gray"
                :icon="\Filament\Support\Icons\Heroicon::OutlinedXMark"
                :icon-alias="\Filament\View\PanelsIconAlias::TOPBAR_CLOSE_SIDEBAR_BUTTON"
                icon-size="lg"
                :label="__('filament-panels::layout.actions.sidebar.collapse.label')"
                x-cloak
                x-data="{}"
                x-on:click="$store.sidebar.close()"
                x-show="$store.sidebar.isOpen"
                class="fi-topbar-close-sidebar-btn" />
            @endif

            <div class="fi-topbar-start">
                @if ($isSidebarCollapsibleOnDesktop || $isSidebarFullyCollapsibleOnDesktop)
                <div
                    x-show="$store.sidebar.isOpen || @js($isSidebarCollapsibleOnDesktop)"
                    class="fi-topbar-collapse-sidebar-btn-ctn">
                    @if ($isSidebarCollapsibleOnDesktop)
                    <x-filament::icon-button
                        color="gray"
                        :icon="$isRtl ? \Filament\Support\Icons\Heroicon::OutlinedChevronLeft : \Filament\Support\Icons\Heroicon::OutlinedChevronRight"
                        :icon-alias="$isRtl
                                ? [\Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON_RTL, \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON]
                                : \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON"
                        icon-size="lg"
                        :label="__('filament-panels::layout.actions.sidebar.expand.label')"
                        x-cloak
                        x-data="{}"
                        x-on:click="$store.sidebar.open()"
                        x-show="! $store.sidebar.isOpen"
                        class="fi-topbar-open-collapse-sidebar-btn" />
                    @endif

                    @if ($isSidebarCollapsibleOnDesktop || $isSidebarFullyCollapsibleOnDesktop)
                    <x-filament::icon-button
                        color="gray"
                        :icon="$isRtl ? \Filament\Support\Icons\Heroicon::OutlinedChevronRight : \Filament\Support\Icons\Heroicon::OutlinedChevronLeft"
                        :icon-alias="$isRtl
                                ? [\Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON_RTL, \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON]
                                : \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON"
                        icon-size="lg"
                        :label="__('filament-panels::layout.actions.sidebar.collapse.label')"
                        x-cloak
                        x-data="{}"
                        x-on:click="$store.sidebar.close()"
                        x-show="$store.sidebar.isOpen"
                        class="fi-topbar-close-collapse-sidebar-btn" />
                    @endif
                </div>
                @endif

                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_LOGO_BEFORE) }}

                <div class="relative group flex items-center justify-center">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500/40 to-purple-500/40 blur-2xl rounded-full opacity-0 group-hover:opacity-100 transition-all duration-700 pointer-events-none"></div>
                    @if ($homeUrl = filament()->getHomeUrl())
                    <a {{ \Filament\Support\generate_href_html($homeUrl) }} class="relative z-10 transform transition-all duration-300 group-hover:scale-105 group-hover:rotate-1">
                        <x-filament-panels::logo />
                    </a>
                    @else
                    <div class="relative z-10 transform transition-all duration-300 group-hover:scale-105 group-hover:rotate-1">
                        <x-filament-panels::logo />
                    </div>
                    @endif
                </div>

                {{-- Greeting & Custom Widgets --}}
                @auth
                @php
                $timeIcon = $hour >= 4 && $hour < 11 ? '🌤️' : ($hour>= 11 && $hour < 15 ? '☀️' : ($hour>= 15 && $hour < 19 ? '⛅' : '🌙' ));
                            @endphp

                            {{-- Live Clock (uses ":" separator) --}}
                            <div class="hidden lg:flex items-center gap-2 px-3 py-1.5 ml-4 bg-gradient-to-r from-white/50 to-gray-50/50 dark:from-gray-800/50 dark:to-gray-900/50 rounded-full border border-gray-200/50 dark:border-gray-700/50 backdrop-blur-md shadow-sm hover:shadow-md hover:scale-105 transition-all duration-300 text-xs font-semibold text-gray-700 dark:text-gray-200 cursor-default ring-1 ring-primary-500/10 hover:ring-primary-500/30"
                            x-data="{
                        time: '',
                        fmt() {
                            const d = new Date();
                            const p = n => String(n).padStart(2,'0');
                            this.time = p(d.getHours())+':'+p(d.getMinutes())+':'+p(d.getSeconds());
                        }
                     }"
                            x-init="fmt(); setInterval(() => fmt(), 1000)">
                            <svg class="w-4 h-4 text-primary-500 origin-center animate-[spin_4s_linear_infinite]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span x-text="time" class="tracking-widest font-mono drop-shadow-sm"></span>
            </div>

            {{-- Network Status (moved here, next to clock / left side) --}}
            <div class="fi-topbar-network hidden md:flex items-center gap-1.5 ml-2 px-2.5 py-1 rounded-full border border-gray-200/50 dark:border-gray-700/50 bg-white/40 dark:bg-gray-800/40 backdrop-blur-md shadow-sm transition-all hover:scale-105 hover:bg-white/60 dark:hover:bg-gray-800/60 cursor-default"
                x-data="{ online: navigator.onLine }"
                @online.window="online = true"
                @offline.window="online = false">
                <span class="relative flex h-2.5 w-2.5">
                    <span x-show="online" class="topbar-net-ping"></span>
                    <span class="topbar-net-dot" :class="online ? 'is-online' : 'is-offline'"></span>
                </span>
                <span class="text-[10px] font-bold uppercase tracking-wider text-gray-600 dark:text-gray-300" x-text="online ? 'Online' : 'Offline'"></span>
            </div>
            @endauth

            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_LOGO_AFTER) }}
</div>

@if ($hasTopNavigation || (! $hasNavigation))
@if ($hasTenancy && filament()->hasTenantMenu())
<x-filament-panels::tenant-menu teleport />
@endif

@if ($hasNavigation)
@php $navigation = filament()->getNavigation(); @endphp
<ul class="fi-topbar-nav-groups">
    @foreach ($navigation as $group)
    @php
    $groupLabel = $group->getLabel();
    $groupExtraTopbarAttributeBag = $group->getExtraTopbarAttributeBag();
    $isGroupActive = $group->isActive();
    $groupIcon = $group->getIcon();
    @endphp

    @if ($groupLabel)
    <x-filament::dropdown placement="bottom-start" teleport
        :attributes="\Filament\Support\prepare_inherited_attributes($groupExtraTopbarAttributeBag)">
        <x-slot name="trigger">
            <x-filament-panels::topbar.item :active="$isGroupActive" :icon="$groupIcon">
                {{ $groupLabel }}
            </x-filament-panels::topbar.item>
        </x-slot>

        @php
        $lists = [];
        foreach ($group->getItems() as $item) {
        if ($childItems = $item->getChildItems()) {
        $lists[] = [$item, ...$childItems];
        $lists[] = [];
        continue;
        }
        if (empty($lists)) { $lists[] = [$item]; continue; }
        $lists[count($lists) - 1][] = $item;
        }
        if (empty($lists[count($lists) - 1])) { array_pop($lists); }
        @endphp

        @foreach ($lists as $list)
        <x-filament::dropdown.list>
            @foreach ($list as $item)
            @php
            $isItemActive = $item->isActive();
            $itemBadge = $item->getBadge();
            $itemBadgeColor = $item->getBadgeColor();
            $itemBadgeTooltip = $item->getBadgeTooltip();
            $itemUrl = $item->getUrl();
            $itemIcon = $isItemActive ? ($item->getActiveIcon() ?? $item->getIcon()) : $item->getIcon();
            $shouldItemOpenUrlInNewTab = $item->shouldOpenUrlInNewTab();
            $itemExtraAttributes = $item->getExtraAttributeBag();
            @endphp
            <x-filament::dropdown.list.item
                :badge="$itemBadge" :badge-color="$itemBadgeColor" :badge-tooltip="$itemBadgeTooltip"
                :color="$isItemActive ? 'primary' : 'gray'"
                :href="$itemUrl" :icon="$itemIcon" tag="a"
                :target="$shouldItemOpenUrlInNewTab ? '_blank' : null"
                :attributes="\Filament\Support\prepare_inherited_attributes($itemExtraAttributes)">
                {{ $item->getLabel() }}
            </x-filament::dropdown.list.item>
            @endforeach
        </x-filament::dropdown.list>
        @endforeach
    </x-filament::dropdown>
    @else
    @foreach ($group->getItems() as $item)
    @php
    $isItemActive = $item->isActive();
    $itemActiveIcon = $item->getActiveIcon();
    $itemBadge = $item->getBadge();
    $itemBadgeColor = $item->getBadgeColor();
    $itemBadgeTooltip = $item->getBadgeTooltip();
    $itemIcon = $item->getIcon();
    $shouldItemOpenUrlInNewTab = $item->shouldOpenUrlInNewTab();
    $itemUrl = $item->getUrl();
    $itemExtraAttributes = $item->getExtraAttributeBag();
    @endphp
    <x-filament-panels::topbar.item
        :active="$isItemActive" :active-icon="$itemActiveIcon"
        :badge="$itemBadge" :badge-color="$itemBadgeColor" :badge-tooltip="$itemBadgeTooltip"
        :icon="$itemIcon" :should-open-url-in-new-tab="$shouldItemOpenUrlInNewTab" :url="$itemUrl"
        :attributes="\Filament\Support\prepare_inherited_attributes($itemExtraAttributes)">
        {{ $item->getLabel() }}
    </x-filament-panels::topbar.item>
    @endforeach
    @endif
    @endforeach
</ul>
@endif
@endif

<div
    @if ($hasTenancy)
    x-persist="topbar.end.panel-{{ filament()->getId() }}.tenant-{{ filament()->getTenant()?->getKey() }}"
    @else
    x-persist="topbar.end.panel-{{ filament()->getId() }}"
    @endif
    class="fi-topbar-end">
    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::GLOBAL_SEARCH_BEFORE) }}

    @if (filament()->isGlobalSearchEnabled() && filament()->getGlobalSearchPosition() === \Filament\Enums\GlobalSearchPosition::Topbar)
    <div class="relative w-full topbar-search-wrap"
        x-data="{}"
        x-init="
                        window.addEventListener('keydown', e => {
                            if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
                                e.preventDefault();
                                const i = $el.querySelector('input'); if (i) i.focus();
                            }
                        });
                     ">
        @livewire(Filament\Livewire\GlobalSearch::class)
        {{-- Decorative sparkles inside search --}}
        <span class="topbar-search-spark topbar-search-spark--1" aria-hidden="true"></span>
        <span class="topbar-search-spark topbar-search-spark--2" aria-hidden="true"></span>
        <span class="topbar-search-spark topbar-search-spark--3" aria-hidden="true"></span>
    </div>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::GLOBAL_SEARCH_AFTER) }}

    @if (filament()->auth()->check())
    @php
    $timeIcon = $hour >= 4 && $hour < 11 ? '🌤️' : ($hour>= 11 && $hour < 15 ? '☀️' : ($hour>= 15 && $hour < 19 ? '⛅' : '🌙' ));
                @endphp
                @if (filament()->hasDatabaseNotifications() && filament()->getDatabaseNotificationsPosition() === \Filament\Enums\DatabaseNotificationsPosition::Topbar)
                @livewire(filament()->getDatabaseNotificationsLivewireComponent(), [
                'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
                ])
                @endif

                {{-- Combined Greeting + User Menu pill --}}
                @if (filament()->hasUserMenu() && filament()->getUserMenuPosition() === \Filament\Enums\UserMenuPosition::Topbar)
                <div class="topbar-user-combined" title="{{ now()->format('l, d M Y H:i') }}" style="cursor:pointer;position:relative;">
                    {{-- Greeting text side --}}
                    <span class="topbar-greeting topbar-greeting--merged">
                        <span class="inline-block animate-bounce" style="animation-duration: 3s; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">{{ $timeIcon }}</span>
                        <span class="topbar-greeting-text">{{ $greeting }}, <strong class="topbar-greeting-name bg-gradient-to-r from-primary-600 to-fuchsia-500 dark:from-primary-400 dark:to-fuchsia-400 bg-clip-text text-transparent drop-shadow-sm">{{ $userName }}</strong></span>
                    </span>
                    {{-- Avatar / dropdown side --}}
                    <div class="fi-topbar-user-menu-wrap fi-topbar-user-menu-wrap--merged" x-data>
                        <x-filament-panels::user-menu />
                    </div>
                </div>
                @endif
                @endif
</div>

{{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_END) }}
</nav>

{{-- ── Logout Confirmation Modal ─────────────────────────────────── --}}
<div x-data="{ showLogoutModal: false }"
    x-on:open-logout-modal.window="showLogoutModal = true"
    x-on:keydown.escape.window="showLogoutModal = false">

    {{-- Intercept all sign-out form submissions in the topbar --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function interceptLogoutForms() {
                // Target semua form dengan action mengandung "logout" di seluruh body
                // (termasuk yang di-teleport oleh Filament ke luar .fi-topbar)
                document.querySelectorAll('form[action*="logout"]').forEach(form => {
                    if (form.dataset.logoutIntercepted) return;
                    form.dataset.logoutIntercepted = 'true';
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        window.dispatchEvent(new CustomEvent('open-logout-modal'));
                    });
                });
            }

            const observer = new MutationObserver(interceptLogoutForms);
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
            interceptLogoutForms(); // jalankan juga langsung saat load
        });
    </script>

    {{-- Modal --}}
    <template x-teleport="body">
        <div x-show="showLogoutModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="logout-modal-backdrop"
            x-cloak
            @click.self="showLogoutModal = false">

            <div class="logout-modal-panel"
                x-show="showLogoutModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                @click.stop>

                <div class="logout-modal-body">
                    <div class="logout-modal-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                    </div>
                    <h3 class="logout-modal-title">{{ __('Konfirmasi Logout') }}</h3>
                    <p class="logout-modal-desc">{{ __('Apakah Anda yakin ingin keluar dari akun ini?') }}</p>
                </div>

                <div class="logout-modal-actions">
                    <button type="button" class="logout-modal-btn logout-modal-btn--cancel" @click="showLogoutModal = false">
                        {{ __('Batal') }}
                    </button>
                    <form method="POST" action="{{ filament()->getLogoutUrl() }}"
                        x-ref="logoutForm"
                        @submit.prevent="
                              showLogoutModal = false;
                              window.dispatchEvent(new CustomEvent('show-logout-toast', { detail: { message: '{{ __('Berhasil logout. Sampai jumpa kembali!') }}', type: 'success' } }));
                              setTimeout(() => $refs.logoutForm.submit(), 900);
                          ">
                        @csrf
                        <button type="submit" class="logout-modal-btn logout-modal-btn--confirm" style="width:100%">
                            {{ __('Ya, Logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>

{{-- ── Logout Toast Notification ──────────────────────────────── --}}
<div x-data="{ toasts: [] }"
    x-on:show-logout-toast.window="
        const id = Date.now();
        toasts.push({ id, message: $event.detail.message || '{{ __('Logout berhasil') }}', type: $event.detail.type || 'info' });
        setTimeout(() => { toasts = toasts.filter(t => t.id !== id); }, 2400);
     ">
    <template x-teleport="body">
        <div style="position:fixed;top:0;right:0;z-index:99999;pointer-events:none;">
            <template x-for="toast in toasts" :key="toast.id">
                <div :class="['logout-toast', 'logout-toast-enter', toast.type === 'success' ? 'logout-toast--success' : 'logout-toast--info']"
                    style="pointer-events:auto;margin:16px;position:relative;overflow:hidden;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span x-text="toast.message"></span>
                    <div class="logout-toast-progress"></div>
                </div>
            </template>
        </div>
    </template>
</div>

<x-filament-actions::modals />

{{-- ── Tips & Bantuan — Floating Help Tooltips Panel ──────────────── --}}
<div x-data="tipsBantuanPanel()" x-on:open-tips-bantuan.window="open()" x-on:keydown.escape.window="close()">
    <template x-teleport="body">
        {{-- Backdrop --}}
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="tips-backdrop" x-cloak @click.self="close()">

            {{-- Panel --}}
            <div class="tips-panel"
                 x-show="isOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 @click.stop>

                {{-- Header --}}
                <div class="tips-header">
                    <div class="tips-header-content">
                        <div class="tips-header-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="tips-title">Tips & Bantuan</h3>
                            <p class="tips-subtitle" x-text="roleLabel"></p>
                        </div>
                    </div>
                    <button @click="close()" class="tips-close-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Search --}}
                <div class="tips-search-wrap">
                    <svg class="tips-search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input type="text" x-model="search" placeholder="Cari tips..." class="tips-search-input" />
                </div>

                {{-- Category Tabs --}}
                <div class="tips-tabs">
                    <template x-for="cat in categories" :key="cat.id">
                        <button @click="activeCategory = cat.id"
                                :class="activeCategory === cat.id ? 'tips-tab-active' : 'tips-tab-inactive'"
                                class="tips-tab"
                                x-text="cat.label">
                        </button>
                    </template>
                </div>

                {{-- Tips List --}}
                <div class="tips-list">
                    <template x-for="(tip, index) in filteredTips" :key="index">
                        <div class="tips-card" @click="toggleTip(index)"
                             :class="expandedTip === index ? 'tips-card-expanded' : ''">
                            <div class="tips-card-header">
                                <div class="tips-card-icon" :style="'background:' + tip.iconBg">
                                    <span x-text="tip.emoji" style="font-size:1.1rem;"></span>
                                </div>
                                <div class="tips-card-title-wrap">
                                    <h4 class="tips-card-title" x-text="tip.title"></h4>
                                    <span class="tips-card-category" x-text="tip.categoryLabel"></span>
                                </div>
                                <svg class="tips-card-chevron" :class="expandedTip === index ? 'rotate-180' : ''"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            <div x-show="expandedTip === index" x-collapse.duration.200ms class="tips-card-body">
                                <p x-text="tip.desc" class="tips-card-desc"></p>
                                <div class="tips-card-steps" x-show="tip.steps && tip.steps.length > 0">
                                    <template x-for="(step, si) in (tip.steps || [])" :key="si">
                                        <div class="tips-step">
                                            <span class="tips-step-num" x-text="si + 1"></span>
                                            <span class="tips-step-text" x-text="step"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div x-show="filteredTips.length === 0" class="tips-empty">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-3" style="color:#94a3b8;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <p>Tidak ada tips yang cocok</p>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="tips-footer">
                    <div class="tips-footer-info">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                        </svg>
                        <span x-text="filteredTips.length + ' tips tersedia'"></span>
                    </div>
                    <div style="display:flex;gap:6px;align-items:center;">
                        <button @click="close(); $nextTick(() => window.dispatchEvent(new CustomEvent('start-guided-tour')))" class="tips-tour-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:14px;height:14px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
                            </svg>
                            Mulai Tur
                        </button>
                        <span class="tips-footer-kbd">ESC untuk tutup</span>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

<script>
function tipsBantuanPanel() {
    // Detect panel
    const path = window.location.pathname;
    let role = 'admin';
    if (path.startsWith('/developer')) role = 'developer';
    else if (path.startsWith('/tester')) role = 'tester';

    const roleLabels = {
        admin: 'Panduan untuk Administrator',
        developer: 'Panduan untuk Developer',
        tester: 'Panduan untuk Tester'
    };

    const tipsData = {
        admin: [
            { title: 'Navigasi Dashboard', emoji: '📊', iconBg: 'rgba(37,99,235,0.12)', category: 'navigasi', categoryLabel: 'Navigasi', desc: 'Dashboard Admin menampilkan ringkasan seluruh platform PlayTest ID. Anda bisa melihat statistik developer, tester, kampanye aktif, dan pendapatan secara real-time.', steps: ['Buka menu "Dashboard" di sidebar', 'Lihat kartu statistik di bagian atas', 'Scroll ke bawah untuk melihat grafik dan tabel'] },
            { title: 'Kelola Pengguna', emoji: '👥', iconBg: 'rgba(16,185,129,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Manajemen Pengguna memungkinkan Anda untuk approve, suspend, atau menolak pendaftaran Developer dan Tester.', steps: ['Buka menu "Pengguna" di sidebar', 'Gunakan filter untuk mencari user', 'Klik tombol aksi di setiap baris untuk mengelola'] },
            { title: 'Manajemen Kampanye', emoji: '🚀', iconBg: 'rgba(245,158,11,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Kelola semua kampanye testing yang ada di platform. Anda bisa memantau progres dan status setiap kampanye.', steps: ['Buka menu "Kampanye" di sidebar', 'Lihat daftar kampanye yang aktif', 'Klik detail untuk melihat informasi lengkap'] },
            { title: 'Verifikasi Pembayaran', emoji: '💳', iconBg: 'rgba(139,92,246,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Review dan verifikasi bukti pembayaran dari Developer. Anda bisa menyetujui atau menolak pembayaran.', steps: ['Buka menu "Pembayaran Developer"', 'Lihat daftar pembayaran pending', 'Klik detail untuk melihat bukti transfer', 'Approve atau tolak pembayaran'] },
            { title: 'Manajemen Withdraw', emoji: '🏦', iconBg: 'rgba(236,72,153,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Kelola permintaan penarikan saldo dari Tester. Pastikan data rekening benar sebelum memproses.', steps: ['Buka menu "Penarikan Tester"', 'Review permintaan withdraw', 'Verifikasi data rekening tujuan', 'Proses atau tolak penarikan'] },
            { title: 'Manajemen Paket', emoji: '📦', iconBg: 'rgba(59,130,246,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Atur paket-paket testing yang tersedia. Anda bisa menambah, mengedit, atau menonaktifkan paket.', steps: ['Buka menu "Paket" di sidebar', 'Klik "Tambah Paket" untuk membuat paket baru', 'Edit paket yang ada melalui tombol aksi'] },
            { title: 'Dark Mode', emoji: '🌙', iconBg: 'rgba(71,85,105,0.12)', category: 'umum', categoryLabel: 'Umum', desc: 'Aktifkan mode gelap untuk pengalaman yang lebih nyaman di malam hari. Semua halaman mendukung dark mode.', steps: ['Klik nama Anda di pojok kanan atas', 'Pilih ikon bulan untuk mode gelap', 'Pilih ikon matahari untuk mode terang'] },
            { title: 'Keyboard Shortcuts', emoji: '⌨️', iconBg: 'rgba(34,211,238,0.12)', category: 'umum', categoryLabel: 'Umum', desc: 'Gunakan pintasan keyboard untuk navigasi lebih cepat.', steps: ['Ctrl/⌘ + K untuk membuka pencarian global', 'ESC untuk menutup modal atau panel', 'Tab untuk navigasi antar elemen form'] },
        ],
        developer: [
            { title: 'Dashboard Developer', emoji: '🏠', iconBg: 'rgba(37,99,235,0.12)', category: 'navigasi', categoryLabel: 'Navigasi', desc: 'Dashboard Developer menampilkan ringkasan aplikasi Anda, progres testing, dan statistik kampanye.', steps: ['Buka menu "Home" di sidebar', 'Lihat kartu statistik di bagian atas', 'Periksa notifikasi dan update terbaru'] },
            { title: 'Buat Test Case Baru', emoji: '📝', iconBg: 'rgba(16,185,129,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Buat kampanye testing baru untuk aplikasi Anda. Tentukan langkah-langkah testing yang perlu dilakukan tester.', steps: ['Klik menu "New Test Case"', 'Isi nama dan deskripsi kampanye', 'Tentukan langkah-langkah testing', 'Submit dan tunggu tester bergabung'] },
            { title: 'Pantau Progress', emoji: '📈', iconBg: 'rgba(245,158,11,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Monitor progres testing aplikasi Anda secara real-time. Lihat berapa tester yang sudah menyelesaikan tugas.', steps: ['Buka menu "Pantau Progress"', 'Pilih kampanye yang ingin dilihat', 'Lihat grafik dan statistik progres'] },
            { title: 'Pembayaran Paket', emoji: '💰', iconBg: 'rgba(139,92,246,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Pilih dan bayar paket testing untuk aplikasi Anda. Upload bukti transfer untuk verifikasi.', steps: ['Pilih paket testing yang sesuai', 'Lakukan pembayaran sesuai nominal', 'Upload bukti transfer', 'Tunggu verifikasi dari Admin'] },
            { title: 'Profil Developer', emoji: '👤', iconBg: 'rgba(236,72,153,0.12)', category: 'navigasi', categoryLabel: 'Navigasi', desc: 'Kelola profil dan informasi akun Developer Anda.', steps: ['Buka menu "Profil Saya"', 'Edit informasi yang ingin diubah', 'Klik simpan untuk menyimpan perubahan'] },
            { title: 'Dark Mode', emoji: '🌙', iconBg: 'rgba(71,85,105,0.12)', category: 'umum', categoryLabel: 'Umum', desc: 'Aktifkan mode gelap untuk kenyamanan mata Anda.', steps: ['Klik nama Anda di pojok kanan atas', 'Pilih ikon tema yang diinginkan'] },
            { title: 'Keyboard Shortcuts', emoji: '⌨️', iconBg: 'rgba(34,211,238,0.12)', category: 'umum', categoryLabel: 'Umum', desc: 'Gunakan pintasan keyboard untuk produktivitas lebih tinggi.', steps: ['Ctrl/⌘ + K untuk pencarian global', 'ESC untuk menutup modal'] },
        ],
        tester: [
            { title: 'Dashboard Tester', emoji: '🏠', iconBg: 'rgba(14,165,233,0.12)', category: 'navigasi', categoryLabel: 'Navigasi', desc: 'Dashboard Tester menampilkan misi yang tersedia, progres pengujian, dan saldo dompet Anda.', steps: ['Buka menu "Home" di sidebar', 'Lihat misi baru yang tersedia', 'Periksa saldo dan progres Anda'] },
            { title: 'Ambil & Selesaikan Misi', emoji: '🎯', iconBg: 'rgba(16,185,129,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Ambil misi testing yang tersedia dan selesaikan sesuai langkah-langkah yang ditentukan untuk mendapatkan reward.', steps: ['Buka menu "Misi Saya"', 'Lihat misi yang tersedia', 'Klik misi untuk melihat detail', 'Ikuti langkah testing yang diminta', 'Submit hasil testing Anda'] },
            { title: 'Dompet & Penghasilan', emoji: '💰', iconBg: 'rgba(245,158,11,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Kelola saldo dan lakukan penarikan penghasilan dari misi testing yang telah Anda selesaikan.', steps: ['Buka menu "Dompet"', 'Lihat saldo dan riwayat transaksi', 'Klik "Withdraw" untuk menarik saldo', 'Masukkan jumlah dan data rekening', 'Tunggu proses oleh Admin'] },
            { title: 'Laporkan Bug', emoji: '🐛', iconBg: 'rgba(239,68,68,0.12)', category: 'fitur', categoryLabel: 'Fitur', desc: 'Laporkan bug yang ditemukan saat testing. Laporan yang detail akan membantu developer memperbaiki aplikasi.', steps: ['Saat mengerjakan misi, klik "Laporkan Bug"', 'Jelaskan bug secara detail', 'Sertakan screenshot jika ada', 'Submit laporan'] },
            { title: 'Profil Tester', emoji: '👤', iconBg: 'rgba(139,92,246,0.12)', category: 'navigasi', categoryLabel: 'Navigasi', desc: 'Kelola profil dan informasi akun Tester Anda.', steps: ['Buka menu "Profil" di sidebar', 'Edit data diri Anda', 'Pastikan data rekening benar untuk withdraw'] },
            { title: 'Tips Mendapat Misi', emoji: '💡', iconBg: 'rgba(34,211,238,0.12)', category: 'umum', categoryLabel: 'Umum', desc: 'Beberapa tips untuk mendapatkan lebih banyak misi testing.', steps: ['Selalu cek dashboard secara berkala', 'Selesaikan misi tepat waktu', 'Berikan laporan yang detail dan berkualitas', 'Jaga rating akun Anda tetap tinggi'] },
            { title: 'Dark Mode', emoji: '🌙', iconBg: 'rgba(71,85,105,0.12)', category: 'umum', categoryLabel: 'Umum', desc: 'Aktifkan mode gelap untuk kenyamanan mata Anda.', steps: ['Klik nama Anda di pojok kanan atas', 'Pilih ikon tema yang diinginkan'] },
        ]
    };

    return {
        isOpen: false,
        search: '',
        activeCategory: 'semua',
        expandedTip: null,
        role: role,
        roleLabel: roleLabels[role],
        tips: tipsData[role] || tipsData.admin,
        categories: [
            { id: 'semua', label: 'Semua' },
            { id: 'navigasi', label: 'Navigasi' },
            { id: 'fitur', label: 'Fitur' },
            { id: 'umum', label: 'Umum' },
        ],
        get filteredTips() {
            let result = this.tips;
            if (this.activeCategory !== 'semua') {
                result = result.filter(t => t.category === this.activeCategory);
            }
            if (this.search.trim()) {
                const q = this.search.toLowerCase();
                result = result.filter(t =>
                    t.title.toLowerCase().includes(q) ||
                    t.desc.toLowerCase().includes(q)
                );
            }
            return result;
        },
        open() {
            this.isOpen = true;
            this.search = '';
            this.expandedTip = null;
            this.activeCategory = 'semua';
            document.body.style.overflow = 'hidden';
        },
        close() {
            this.isOpen = false;
            document.body.style.overflow = '';
        },
        toggleTip(index) {
            this.expandedTip = this.expandedTip === index ? null : index;
        }
    };
}
</script>

{{-- Intercept sidebar "Tips & Bantuan" / "Bantuan" / "Support" clicks --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    function interceptHelpLinks() {
        document.querySelectorAll('.fi-sidebar-item a[href="#"], .fi-sidebar-item a[href$="#"]').forEach(link => {
            if (link.dataset.tipsIntercepted) return;
            const label = (link.textContent || '').trim().toLowerCase();
            if (label.includes('tips') || label.includes('bantuan') || label.includes('support') || label.includes('help')) {
                link.dataset.tipsIntercepted = 'true';
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    window.dispatchEvent(new CustomEvent('open-tips-bantuan'));
                    if (window.matchMedia('(max-width: 1024px)').matches && window.Alpine) {
                        Alpine.store('sidebar')?.close();
                    }
                });
            }
        });
    }
    const observer = new MutationObserver(interceptHelpLinks);
    observer.observe(document.body, { childList: true, subtree: true });
    interceptHelpLinks();
});
</script>

{{-- ── Floating Help FAB ──────────────────────────────────────────── --}}
<div x-data="{ fabOpen: false, fabHover: false }" class="ht-fab-wrap">
    <template x-teleport="body">
        {{-- Mini menu --}}
        <div class="ht-fab-menu" x-show="fabOpen" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
             @click.outside="fabOpen = false">
            <button class="ht-fab-menu-item" @click="fabOpen=false; window.dispatchEvent(new CustomEvent('open-tips-bantuan'))">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                <span>Panduan Lengkap</span>
            </button>
            <button class="ht-fab-menu-item" @click="fabOpen=false; window.dispatchEvent(new CustomEvent('start-guided-tour'))">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/></svg>
                <span>Mulai Tur Halaman</span>
            </button>
        </div>
        {{-- FAB --}}
        <button class="ht-fab-btn" :class="fabOpen ? 'ht-fab-btn--active' : ''"
                @click="fabOpen = !fabOpen"
                @mouseenter="fabHover = true" @mouseleave="fabHover = false"
                title="Tips & Bantuan">
            <svg x-show="!fabOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="ht-fab-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>
            </svg>
            <svg x-show="fabOpen" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="ht-fab-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
            </svg>
        </button>
    </template>
</div>

{{-- ── Guided Tour Tooltips System ────────────────────────────────── --}}
<div x-data="guidedTourSystem()" x-on:start-guided-tour.window="startTour()" x-on:keydown.escape.window="if(touring) endTour()">
    <template x-teleport="body">
        {{-- Overlay --}}
        <div x-show="touring" x-cloak class="gt-overlay" @click="endTour()"></div>
        {{-- Highlight --}}
        <div x-show="touring && highlightStyle" x-cloak class="gt-highlight" :style="highlightStyle"></div>
        {{-- Tooltip --}}
        <div x-show="touring" x-cloak class="gt-tooltip" :style="tooltipStyle"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="gt-tooltip-arrow" :style="arrowStyle"></div>
            <div class="gt-tooltip-header">
                <span class="gt-tooltip-step" x-text="'Langkah ' + (currentStep+1) + ' dari ' + totalSteps"></span>
                <button @click="endTour()" class="gt-tooltip-close">&times;</button>
            </div>
            <div class="gt-tooltip-emoji" x-text="currentTip.emoji"></div>
            <h4 class="gt-tooltip-title" x-text="currentTip.title"></h4>
            <p class="gt-tooltip-desc" x-text="currentTip.desc"></p>
            <div class="gt-tooltip-actions">
                <button x-show="currentStep > 0" @click="prevStep()" class="gt-btn gt-btn--prev">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/></svg>
                    Kembali
                </button>
                <button @click="nextStep()" class="gt-btn gt-btn--next">
                    <span x-text="currentStep < totalSteps - 1 ? 'Lanjut' : 'Selesai'"></span>
                    <svg x-show="currentStep < totalSteps - 1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                    <svg x-show="currentStep >= totalSteps - 1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                </button>
            </div>
            <div class="gt-tooltip-progress">
                <template x-for="(_, i) in steps" :key="i">
                    <span class="gt-dot" :class="i <= currentStep ? 'gt-dot--active' : ''"></span>
                </template>
            </div>
        </div>
    </template>
</div>

<script>
function guidedTourSystem() {
    const path = window.location.pathname;
    let role = 'admin';
    if (path.startsWith('/developer')) role = 'developer';
    else if (path.startsWith('/tester')) role = 'tester';

    const tourSteps = {
        admin: [
            { selector: '.fi-topbar', emoji: '🎯', title: 'Topbar Navigasi', desc: 'Ini adalah topbar utama. Di sini Anda bisa melihat jam, status jaringan, dan mengakses menu profil.' },
            { selector: '.fi-sidebar-nav', emoji: '📋', title: 'Sidebar Menu', desc: 'Menu navigasi utama ada di sidebar ini. Klik menu untuk berpindah halaman.' },
            { selector: '.fi-sidebar-item:first-child', emoji: '📊', title: 'Dashboard', desc: 'Halaman Dashboard menampilkan ringkasan statistik platform secara real-time.' },
            { selector: '.fi-topbar-end', emoji: '👤', title: 'Profil & Pengaturan', desc: 'Klik avatar Anda untuk mengakses profil, tema, dan opsi logout.' },
            { selector: '.fi-main', emoji: '📄', title: 'Area Konten', desc: 'Area utama ini menampilkan konten halaman yang sedang Anda buka. Gunakan sidebar untuk navigasi.' },
        ],
        developer: [
            { selector: '.fi-topbar', emoji: '🎯', title: 'Topbar Navigasi', desc: 'Topbar menampilkan informasi penting seperti jam, status jaringan, dan menu profil.' },
            { selector: '.fi-sidebar-nav', emoji: '📋', title: 'Sidebar Menu', desc: 'Gunakan sidebar untuk navigasi ke berbagai fitur developer.' },
            { selector: '.fi-topbar-end', emoji: '👤', title: 'Profil Developer', desc: 'Akses profil dan pengaturan akun Anda di sini.' },
            { selector: '.fi-main', emoji: '📄', title: 'Area Konten', desc: 'Di sini Anda bisa mengelola test case, melihat progress, dan mengatur aplikasi.' },
        ],
        tester: [
            { selector: '.fi-topbar', emoji: '🎯', title: 'Topbar Navigasi', desc: 'Topbar berisi informasi waktu, status jaringan, dan akses cepat ke profil.' },
            { selector: '.fi-sidebar-nav', emoji: '📋', title: 'Sidebar Menu', desc: 'Navigasi ke misi, dompet, dan pengaturan melalui sidebar.' },
            { selector: '.fi-topbar-end', emoji: '👤', title: 'Profil Tester', desc: 'Kelola profil dan pengaturan akun Anda.' },
            { selector: '.fi-main', emoji: '📄', title: 'Area Konten', desc: 'Lihat misi yang tersedia, riwayat, dan kelola dompet Anda di area ini.' },
        ]
    };

    return {
        touring: false,
        currentStep: 0,
        highlightStyle: '',
        tooltipStyle: '',
        arrowStyle: '',
        steps: tourSteps[role] || tourSteps.admin,
        get totalSteps() { return this.steps.length; },
        get currentTip() { return this.steps[this.currentStep] || this.steps[0]; },
        startTour() {
            this.currentStep = 0;
            this.touring = true;
            document.body.style.overflow = 'hidden';
            setTimeout(() => this.positionTooltip(), 200);
        },
        endTour() {
            this.touring = false;
            document.body.style.overflow = '';
            this.highlightStyle = '';
            if (window.matchMedia('(max-width: 1024px)').matches && window.Alpine) {
                window.Alpine.store('sidebar')?.close();
            }
        },
        nextStep() {
            if (this.currentStep < this.totalSteps - 1) {
                this.currentStep++;
                setTimeout(() => this.positionTooltip(), 100);
            } else { this.endTour(); }
        },
        prevStep() {
            if (this.currentStep > 0) {
                this.currentStep--;
                setTimeout(() => this.positionTooltip(), 100);
            }
        },
        positionTooltip() {
            if (window.matchMedia('(max-width: 1024px)').matches && window.Alpine) {
                const needsSidebar = this.currentTip.selector && (
                    this.currentTip.selector.includes('.fi-sidebar') || 
                    this.currentTip.selector.includes('sidebar')
                );
                const isSidebarOpen = window.Alpine.store('sidebar')?.isOpen;
                if (needsSidebar && !isSidebarOpen) {
                    window.Alpine.store('sidebar')?.open();
                    setTimeout(() => this.positionTooltip(), 300);
                    return;
                } else if (!needsSidebar && isSidebarOpen) {
                    window.Alpine.store('sidebar')?.close();
                    setTimeout(() => this.positionTooltip(), 300);
                    return;
                }
            }

            const el = document.querySelector(this.currentTip.selector);
            if (!el) {
                this.highlightStyle = '';
                this.tooltipStyle = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);';
                this.arrowStyle = 'display:none;';
                return;
            }
            const r = el.getBoundingClientRect();
            const pad = 8;
            this.highlightStyle = `position:fixed;top:${r.top-pad}px;left:${r.left-pad}px;width:${r.width+pad*2}px;height:${r.height+pad*2}px;`;
            const tw = 340, th = 220;
            let top, left, aTop, aLeft;
            if (r.bottom + th + 20 < window.innerHeight) {
                top = r.bottom + 16; left = Math.max(16, Math.min(r.left + r.width/2 - tw/2, window.innerWidth - tw - 16));
                aTop = '-8px'; aLeft = Math.min(Math.max(20, r.left + r.width/2 - left), tw - 20) + 'px';
                this.arrowStyle = `position:absolute;top:${aTop};left:${aLeft};width:16px;height:16px;background:inherit;transform:rotate(45deg);border-radius:3px;`;
            } else {
                top = r.top - th - 16; left = Math.max(16, Math.min(r.left + r.width/2 - tw/2, window.innerWidth - tw - 16));
                aLeft = Math.min(Math.max(20, r.left + r.width/2 - left), tw - 20) + 'px';
                this.arrowStyle = `position:absolute;bottom:-8px;left:${aLeft};width:16px;height:16px;background:inherit;transform:rotate(45deg);border-radius:3px;`;
            }
            this.tooltipStyle = `position:fixed;top:${top}px;left:${left}px;width:${tw}px;`;
        }
    };
}
</script>

</div>