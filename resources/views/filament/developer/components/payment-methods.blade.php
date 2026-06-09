@php
    $merchantCode = config('duitku.merchant_code');
    $apiKey = config('duitku.api_key');
    $amount = 10000;
    $datetime = date('Y-m-d H:i:s');
    $signature = hash('sha256', $merchantCode . $amount . $datetime . $apiKey);

    $methods = [];
    try {
        $response = \Illuminate\Support\Facades\Http::timeout(3)->post(
            config('duitku.base_url') . '/webapi/api/merchant/paymentmethod/getpaymentmethod',
            [
                'merchantcode' => $merchantCode,
                'amount' => $amount,
                'datetime' => $datetime,
                'signature' => $signature,
            ]
        );

        if ($response->successful()) {
            $methods = $response->json()['paymentFee'] ?? [];
        }
    } catch (\Exception $e) {
        // fallback
    }

    if (empty($methods)) {
        $methods = [
            ['paymentMethod' => 'BC', 'paymentName' => 'BCA VA',         'paymentImage' => 'https://images.duitku.com/hotlink-ok/BCA.SVG'],
            ['paymentMethod' => 'M2', 'paymentName' => 'MANDIRI VA',     'paymentImage' => 'https://images.duitku.com/hotlink-ok/MV.PNG'],
            ['paymentMethod' => 'I1', 'paymentName' => 'BNI VA',         'paymentImage' => 'https://images.duitku.com/hotlink-ok/I1.PNG'],
            ['paymentMethod' => 'BR', 'paymentName' => 'BRI VA',         'paymentImage' => 'https://images.duitku.com/hotlink-ok/BR.PNG'],
            ['paymentMethod' => 'BT', 'paymentName' => 'PERMATA VA',     'paymentImage' => 'https://images.duitku.com/hotlink-ok/PERMATA.PNG'],
            ['paymentMethod' => 'SP', 'paymentName' => 'SHOPEEPAY QRIS', 'paymentImage' => 'https://images.duitku.com/hotlink-ok/SHOPEEPAY.PNG'],
            ['paymentMethod' => 'DA', 'paymentName' => 'DANA',           'paymentImage' => 'https://images.duitku.com/hotlink-ok/DA.PNG'],
            ['paymentMethod' => 'OV', 'paymentName' => 'OVO',            'paymentImage' => 'https://images.duitku.com/hotlink-ok/OV.PNG'],
            ['paymentMethod' => 'IR', 'paymentName' => 'INDOMARET',      'paymentImage' => 'https://images.duitku.com/hotlink-ok/IR.PNG'],
        ];
    }

    $categoryMeta = [
        'Virtual Account'    => ['icon' => 'heroicon-m-building-library', 'color' => 'from-indigo-500 to-violet-500'],
        'E-Wallet / QRIS'    => ['icon' => 'heroicon-m-device-phone-mobile', 'color' => 'from-cyan-500 to-emerald-500'],
        'Retail / Gerai'     => ['icon' => 'heroicon-m-building-storefront', 'color' => 'from-amber-500 to-orange-500'],
        'Kartu Kredit'       => ['icon' => 'heroicon-m-credit-card', 'color' => 'from-fuchsia-500 to-pink-500'],
        'Lainnya'            => ['icon' => 'heroicon-m-squares-2x2', 'color' => 'from-slate-400 to-slate-500'],
    ];

    $groupedMethods = [];
    foreach ($methods as $item) {
        $code = $item['paymentMethod'];
        $name = $item['paymentName'];
        $image = $item['paymentImage'];

        $kategoriKey = 'Lainnya';
        if (str_contains(strtolower($name), 'va') || str_contains(strtolower($name), 'virtual account')) {
            $kategoriKey = 'Virtual Account';
        } elseif (in_array($code, ['OV','DA','LA','SA','SP','LQ','NQ','GQ']) || str_contains(strtolower($name), 'qris') || str_contains(strtolower($name), 'ovo') || str_contains(strtolower($name), 'dana') || str_contains(strtolower($name), 'linkaja') || str_contains(strtolower($name), 'shopeepay')) {
            $kategoriKey = 'E-Wallet / QRIS';
        } elseif (in_array($code, ['IR','FT']) || str_contains(strtolower($name), 'indomaret') || str_contains(strtolower($name), 'retail')) {
            $kategoriKey = 'Retail / Gerai';
        } elseif ($code === 'VC' || str_contains(strtolower($name), 'card') || str_contains(strtolower($name), 'kartu')) {
            $kategoriKey = 'Kartu Kredit';
        }

        $groupedMethods[$kategoriKey][] = (object)[
            'id' => $code, 'name' => $name, 'image' => $image, 'kategori' => $kategoriKey,
        ];
    }
@endphp

{{-- ══════════════════════════════════════════════════════════════
     PAYMENT METHODS — Midnight Aurora Theme
   ══════════════════════════════════════════════════════════════ --}}

<style>
    @keyframes pay-fadein {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes pay-shine {
        0%   { transform: translateX(-120%) skewX(-20deg); }
        100% { transform: translateX(220%)  skewX(-20deg); }
    }
    .pay-card {
        animation: pay-fadein .45s ease-out both;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
    .pay-card::after {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(110deg, transparent 30%, rgba(255,255,255,.45) 50%, transparent 70%);
        transform: translateX(-120%) skewX(-20deg);
        pointer-events: none;
        transition: none;
    }
    .pay-card:hover::after { animation: pay-shine .9s ease-out; }
    .dark .pay-card::after {
        background: linear-gradient(110deg, transparent 30%, rgba(165,180,252,.15) 50%, transparent 70%);
    }
</style>

<div x-data="{ selectedPayment: @entangle('data.payment_method') }" class="space-y-6 pt-2 md:pr-8 md:border-r border-slate-200 dark:border-slate-800">

    {{-- Page Header --}}
    <div class="mb-6">
        <h2 class="text-lg md:text-xl font-bold text-slate-800 dark:text-white flex items-center gap-2.5">
            <x-heroicon-o-credit-card class="w-6 h-6 text-indigo-500" />
            {{ __('Metode Pembayaran') }}
        </h2>
        <p class="text-sm md:text-base text-slate-500 dark:text-slate-400 mt-2">
            {{ __('Pilih metode pembayaran yang akan digunakan. Anda akan diarahkan ke halaman pembayaran Duitku setelah menekan tombol Selanjutnya.') }}
        </p>
    </div>

    @foreach($groupedMethods as $kategoriKey => $catMethods)
        @php $meta = $categoryMeta[$kategoriKey] ?? $categoryMeta['Lainnya']; @endphp

        <div x-data="{ expanded: {{ $loop->first ? 'true' : 'false' }} }" class="bg-white/40 dark:bg-slate-900/40 rounded-2xl border border-slate-200/80 dark:border-white/5 overflow-hidden transition-all duration-300">
            {{-- Category header (Clickable) --}}
            <button
                type="button"
                @click="expanded = !expanded"
                class="w-full flex items-center justify-between p-4 hover:bg-slate-50 dark:hover:bg-white/5 transition-colors"
            >
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br {{ $meta['color'] }} flex items-center justify-center shadow-sm">
                        <x-dynamic-component :component="$meta['icon']" class="w-4 h-4 text-white" />
                    </div>
                    <div class="text-left">
                        <h4 class="text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-[0.15em]">
                            {{ __($kategoriKey) }}
                        </h4>
                        <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500">{{ count($catMethods) }} {{ __('opsi tersedia') }}</span>
                    </div>
                </div>
                <div class="w-6 h-6 rounded-full bg-slate-100 dark:bg-white/10 flex items-center justify-center">
                    <x-heroicon-m-chevron-down
                        class="w-4 h-4 text-slate-500 dark:text-slate-400 transition-transform duration-300"
                        x-bind:class="expanded ? '-rotate-180' : ''"
                    />
                </div>
            </button>

            {{-- Grid --}}
            <div x-show="expanded" x-collapse>
                <div class="p-4 pt-0 grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
                @foreach($catMethods as $method)
                    @php $id = $method->id; @endphp

                    <div
                        x-on:click="selectedPayment = '{{ $id }}'"
                        class="pay-card group relative cursor-pointer rounded-2xl border-2 transition-all duration-300 ease-out flex flex-col items-center justify-center p-4 min-h-[110px] overflow-hidden"
                        :class="selectedPayment == '{{ $id }}'
                            ? 'border-transparent bg-gradient-to-br from-indigo-50 via-white to-cyan-50 dark:from-indigo-500/20 dark:via-slate-900/60 dark:to-cyan-500/15 shadow-[0_8px_30px_-8px_rgba(99,102,241,0.35)] ring-2 ring-indigo-400/40 dark:ring-indigo-400/30 -translate-y-0.5'
                            : 'border-slate-200/70 dark:border-white/10 bg-white/70 dark:bg-white/5 hover:border-indigo-300 dark:hover:border-indigo-400/50 hover:shadow-lg hover:-translate-y-0.5'"
                    >
                        {{-- Check badge --}}
                        <div
                            class="absolute top-2 right-2 w-6 h-6 rounded-full flex items-center justify-center transition-all duration-300 z-10"
                            :class="selectedPayment == '{{ $id }}'
                                ? 'bg-gradient-to-br from-indigo-500 to-violet-500 scale-100 shadow-md shadow-indigo-500/40'
                                : 'scale-0'"
                        >
                            <x-heroicon-m-check class="w-3.5 h-3.5 text-white stroke-[3]" />
                        </div>

                        {{-- Logo wrapper --}}
                        <div class="relative w-full h-12 flex items-center justify-center mb-2">
                            <div class="absolute inset-1 rounded-lg transition-opacity duration-300 opacity-0 dark:opacity-100 z-0 shadow-sm" style="background-color: #ffffff;"></div>
                            <img
                                src="{{ str_starts_with($method->image, 'http') ? $method->image : asset('storage/' . $method->image) }}"
                                alt="{{ $method->name }}"
                                class="max-h-8 max-w-[80%] object-contain transition-all duration-500 z-10"
                                :class="selectedPayment == '{{ $id }}'
                                    ? 'grayscale-0 opacity-100 scale-110'
                                    : 'grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105'"
                            >
                        </div>

                        {{-- Name --}}
                        <span
                            class="text-[11px] font-bold text-center mt-1 transition-colors duration-300 z-10"
                            :class="selectedPayment == '{{ $id }}'
                                ? 'text-indigo-700 dark:text-indigo-300'
                                : 'text-slate-500 dark:text-slate-400 group-hover:text-slate-800 dark:group-hover:text-slate-200'"
                        >
                            {{ $method->name }}
                        </span>

                        {{-- Bottom aurora bar --}}
                        <div
                            class="absolute bottom-0 inset-x-3 h-[2px] rounded-full transition-all duration-500"
                            :class="selectedPayment == '{{ $id }}'
                                ? 'bg-gradient-to-r from-indigo-500 via-violet-500 to-cyan-400 opacity-100'
                                : 'opacity-0'"
                        ></div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
