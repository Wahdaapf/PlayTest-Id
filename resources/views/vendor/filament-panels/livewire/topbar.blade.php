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
    $greeting = $hour < 2 ? 'Selamat Malam' : ($hour < 11 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 19 ? 'Selamat Sore' : 'Selamat Malam' )));
        $userName=filament()->auth()->check() ? (filament()->auth()->user()->name ?? 'Admin') : 'Admin';
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
                    <h3 class="logout-modal-title">Konfirmasi Logout</h3>
                    <p class="logout-modal-desc">Apakah Anda yakin ingin keluar dari akun ini?</p>
                </div>

                <div class="logout-modal-actions">
                    <button type="button" class="logout-modal-btn logout-modal-btn--cancel" @click="showLogoutModal = false">
                        Batal
                    </button>
                    <form method="POST" action="{{ filament()->getLogoutUrl() }}"
                        x-ref="logoutForm"
                        @submit.prevent="
                              showLogoutModal = false;
                              window.dispatchEvent(new CustomEvent('show-logout-toast', { detail: { message: 'Berhasil logout. Sampai jumpa kembali!', type: 'success' } }));
                              setTimeout(() => $refs.logoutForm.submit(), 900);
                          ">
                        @csrf
                        <button type="submit" class="logout-modal-btn logout-modal-btn--confirm" style="width:100%">
                            Ya, Logout
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
        toasts.push({ id, message: $event.detail.message || 'Logout berhasil', type: $event.detail.type || 'info' });
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
</div>