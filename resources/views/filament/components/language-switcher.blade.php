@php $locale = App::getLocale(); @endphp

<div class="fi-theme-switcher">
    <button
       type="button"
       x-on:click="window.location.href = '{{ route('language.switch', 'en') }}'"
       aria-current="{{ $locale === 'en' ? 'true' : 'false' }}"
       x-data="{}"
       x-tooltip="{ content: 'English', theme: $store.theme }"
       class="fi-theme-switcher-btn {{ $locale === 'en' ? 'fi-active' : '' }}"
    >
        <span class="text-xs font-semibold">EN</span>
    </button>

    <button
       type="button"
       x-on:click="window.location.href = '{{ route('language.switch', 'id') }}'"
       aria-current="{{ $locale === 'id' ? 'true' : 'false' }}"
       x-data="{}"
       x-tooltip="{ content: 'Bahasa Indonesia', theme: $store.theme }"
       class="fi-theme-switcher-btn {{ $locale === 'id' ? 'fi-active' : '' }}"
    >
        <span class="text-xs font-semibold">ID</span>
    </button>
</div>
