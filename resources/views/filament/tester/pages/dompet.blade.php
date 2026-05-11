{{--
    Dompet / Wallet — PlayTest ID
    Panel  : Tester (path /tester)
    Page   : Dompet.php
--}}

<x-filament-panels::page>

    @push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />

    <style>
        /* ══ FONTS ══ */
        .wlt-page {
            font-family: 'Inter', sans-serif;
        }

        .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .font-mono-num {
            font-family: 'JetBrains Mono', monospace !important;
        }

        /* WAJIB: Mencegah font teks menimpa font ikon */
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined' !important;
            font-weight: normal;
            font-style: normal;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }

        /* ══ ANIMATIONS ══ */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .wlt-floating {
            animation: float 4s ease-in-out infinite;
        }

        .wlt-floating-delayed {
            animation: float 5s ease-in-out infinite 2s;
        }

        /* ══ SIDEBAR OVERRIDES — now centralized in filament-sidebar.css ══ */

        /* ══ TOPBAR & PAGE — now centralized in filament-sidebar.css ══ */

        [x-cloak] {
            display: none !important;
        }

        /* ══ SEGMENTED TABS (E-WALLET VS BANK) ══ */
        .wlt-tabs-container {
            display: flex;
            background: #f1f5f9;
            border-radius: 1rem;
            padding: 0.35rem;
            gap: 0.35rem;
            margin-bottom: 1.5rem;
        }

        .wlt-tab {
            flex: 1;
            text-align: center;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 0.75rem;
            cursor: pointer;
            color: #64748b;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .wlt-tab:hover:not(.active) {
            color: #334155;
        }

        .wlt-tab.active {
            background: #ffffff;
            color: #0ea5e9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        /* ══ METHOD CARD ══ */
        .wlt-method {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.25rem 1rem;
            border-radius: 1rem;
            cursor: pointer;
            border: 2px solid #e2e8f0;
            background: #ffffff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            gap: 10px;
        }

        .wlt-method:hover {
            border-color: rgba(14, 165, 233, 0.4);
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.05);
        }

        .wlt-method.active {
            border-color: #0ea5e9;
            background: #f0f9ff;
            box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.1);
            transform: translateY(-2px);
        }

        .wlt-method-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .wlt-method:hover .wlt-method-icon {
            transform: scale(1.1);
        }

        .wlt-method-icon span {
            font-size: 1.8rem;
        }

        .wlt-method-check {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #0ea5e9;
            font-size: 1.2rem;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
        }

        .wlt-method.active .wlt-method-check {
            opacity: 1;
            transform: scale(1) rotate(360deg);
        }

        /* ══ DENOM CARD ══ */
        .wlt-denom {
            padding: 1.25rem;
            border-radius: 1rem;
            cursor: pointer;
            border: 2px solid #e2e8f0;
            background: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
        }

        .wlt-denom:hover {
            border-color: rgba(14, 165, 233, 0.4);
            transform: translateY(-2px);
        }

        .wlt-denom.active {
            border-color: #0ea5e9;
            background: #f0f9ff;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
            transform: translateY(-2px);
        }

        .wlt-denom-check {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #fff;
            border-radius: 50%;
            color: #0ea5e9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            opacity: 0;
            transform: scale(0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .wlt-denom.active .wlt-denom-check {
            opacity: 1;
            transform: scale(1);
        }

        /* ══ BUTTONS ══ */
        .wlt-btn-submit {
            width: 100%;
            padding: 16px 24px;
            border-radius: 1rem;
            font-size: 1.05rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 16px rgba(14, 165, 233, 0.3);
            transition: all 0.3s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .wlt-btn-submit::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.5s ease;
        }

        .wlt-btn-submit:hover::after {
            left: 100%;
        }

        .wlt-btn-submit:hover {
            box-shadow: 0 6px 24px rgba(14, 165, 233, 0.45);
            transform: translateY(-2px);
        }

        .wlt-btn-submit:active {
            transform: translateY(0);
        }

        .wlt-btn-submit:disabled {
            background: #cbd5e1 !important;
            box-shadow: none !important;
            cursor: not-allowed;
            color: #64748b;
            transform: none;
        }

        /* ══ HISTORY FILTERS & TABLE ══ */
        .wlt-filter-ctrl {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.65rem 1rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: #475569;
            outline: none;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .wlt-filter-ctrl:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        .wlt-search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.2rem;
            pointer-events: none;
        }

        .wlt-btn-reset {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.65rem 1rem;
            transition: all 0.2s;
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
        }

        .wlt-btn-reset:hover {
            background: #e2e8f0;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        .wlt-btn-reset:active {
            transform: scale(0.95);
        }

        .wlt-history-row {
            display: flex;
            align-items: center;
            gap: 0.75rem; /* Gap diperkecil untuk mobile */
            padding: 1rem 0.75rem; /* Padding diperkecil untuk mobile */
            border-bottom: 1px solid #f1f5f9;
            border-left: 3px solid transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (min-width: 640px) {
            .wlt-history-row {
                gap: 1rem;
                padding: 1rem 1.25rem;
            }
        }

        .wlt-history-row:hover {
            background: #f8fafc;
            border-left: 3px solid #0ea5e9;
            transform: translateX(4px);
        }

        .wlt-history-row:last-child {
            border-bottom: none;
        }

        /* ══ STATUS BADGE ══ */
        .wlt-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
            font-family: 'Inter', sans-serif;
        }

        .wlt-badge-pending {
            background: #fef9c3;
            color: #a16207;
        }

        .wlt-badge-success {
            background: #dcfce7;
            color: #15803d;
        }

        .wlt-badge-rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        .wlt-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .wlt-dot-pending {
            background: #eab308;
        }

        .wlt-dot-success {
            background: #22c55e;
        }

        .wlt-dot-rejected {
            background: #ef4444;
        }

        /* ══ WARNING BOX ══ */
        .wlt-warning {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            border-radius: 12px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ══ INPUT ══ */
        .wlt-input-group {
            position: relative;
        }

        .wlt-input-icon {
            position: absolute;
            inset-y: 0;
            left: 0;
            padding-left: 1rem;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .wlt-input {
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 1rem;
            background: #ffffff;
            color: #0f172a;
            font-size: 1rem;
            font-weight: 500;
            outline: none;
            transition: all 0.3s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .wlt-input:focus {
            border-color: #0ea5e9;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
            transform: translateY(-1px);
        }

        .wlt-input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .wlt-step-badge {
            background: #eff6ff;
            color: #2563eb;
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 8px;
        }
    </style>
    @endpush

    {{-- Data Dummy Provider --}}
    @php
    $ewallets = [
    'gopay' => ['label' => 'GoPay', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Gopay_logo.svg'],
    'dana' => ['label' => 'DANA', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Logo_dana_blue.svg'],
    'shopeepay' => ['label' => 'ShopeePay', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Shopee.svg'],
    'ovo' => ['label' => 'OVO', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Logo_ovo_purple.svg'],
    ];
    $banks = [
    'bca' => ['label' => 'BCA', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Central_Asia.svg'],
    'mandiri' => ['label' => 'Mandiri', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Mandiri_logo_2016.svg'],
    'bni' => ['label' => 'BNI', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Negara_Indonesia_logo_(2004).svg'],
    'bri' => ['label' => 'BRI', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/BRI_2020.svg'],
    'bsi' => ['label' => 'BSI', 'img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Syariah_Indonesia.svg'],
    ];
    @endphp

    <div class="wlt-page" x-data="walletPage()">
        <div class="px-4 sm:px-6 py-6 max-w-3xl mx-auto">

            {{-- ══ HERO — SALDO POIN ══ --}}
            <div class="w-full rounded-2xl p-6 mb-8 relative overflow-hidden"
                style="background:linear-gradient(135deg,#0ea5e9 0%,#06b6d4 40%,#2563eb 100%);
                    box-shadow:0 8px 32px rgba(14,165,233,0.25);">
                <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full opacity-10 wlt-floating" style="background:#ffffff;"></div>
                <div class="absolute right-16 -bottom-10 w-28 h-28 rounded-full opacity-10 wlt-floating-delayed" style="background:#ffffff;"></div>

                <div class="relative z-10 text-center">
                    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#e0f2fe;letter-spacing:0.12em;">SALDO POIN ANDA</p>
                    <div class="flex items-baseline justify-center gap-2 mb-1">
                        <span class="font-mono-num font-bold text-white" style="font-size:48px;line-height:1;">{{ number_format($totalPoin ?? 0) }}</span>
                        <span class="text-xl font-semibold" style="color:#bae6fd;opacity:0.85;">pts</span>
                    </div>
                    <p class="text-sm font-medium" style="color:#bae6fd;">Setara dengan <span class="font-bold text-white">{{ $estimasiRupiah ?? 'Rp 0' }}</span></p>
                </div>
            </div>

            {{-- ══ FORM WITHDRAWAL ══ --}}
            <div class="space-y-10">

                {{-- 1. Metode Pembayaran --}}
                <section>
                    <h3 class="font-heading text-lg font-bold mb-4" style="color:#1e293b;">
                        <span class="wlt-step-badge">1</span> Pilih Metode Penarikan
                    </h3>

                    {{-- TABS CATEGORY --}}
                    <div class="wlt-tabs-container">
                        <div class="wlt-tab" :class="{ 'active': category === 'ewallet' }" @click="category = 'ewallet'; $wire.selectedMethod = null;">
                            <span class="material-symbols-outlined" style="font-size: 1.2rem; transition: transform 0.3s;" :style="category === 'ewallet' && 'transform: scale(1.1);'">account_balance_wallet</span> E-Wallet
                        </div>
                        <div class="wlt-tab" :class="{ 'active': category === 'bank' }" @click="category = 'bank'; $wire.selectedMethod = null;">
                            <span class="material-symbols-outlined" style="font-size: 1.2rem; transition: transform 0.3s;" :style="category === 'bank' && 'transform: scale(1.1);'">account_balance</span> Transfer Bank
                        </div>
                    </div>

                    {{-- E-WALLET GRID --}}
                    <div x-show="category === 'ewallet'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @foreach($ewallets as $key => $data)
                            <div class="wlt-method" :class="{ 'active': $wire.selectedMethod === '{{ $key }}' }" wire:click="$set('selectedMethod', '{{ $key }}')">
                                <span class="wlt-method-check material-symbols-outlined">check_circle</span>
                                <div class="wlt-method-icon" style="background:#f8fafc; border:1px solid #f1f5f9; padding: 4px;">
                                    <img src="{{ $data['img'] }}" alt="{{ $data['label'] }}" class="w-full h-full object-contain" />
                                </div>
                                <p class="text-sm font-bold font-heading" style="color:#1e293b;">{{ $data['label'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- BANK GRID --}}
                    <div x-show="category === 'bank'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                            @foreach($banks as $key => $data)
                            <div class="wlt-method" :class="{ 'active': $wire.selectedMethod === '{{ $key }}' }" wire:click="$set('selectedMethod', '{{ $key }}')">
                                <span class="wlt-method-check material-symbols-outlined">check_circle</span>
                                <div class="wlt-method-icon" style="background:#f8fafc; border:1px solid #f1f5f9; padding: 4px;">
                                    <img src="{{ $data['img'] }}" alt="{{ $data['label'] }}" class="w-full h-full object-contain" />
                                </div>
                                <p class="text-sm font-bold font-heading" style="color:#1e293b;">{{ $data['label'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- 2. Pilih Nominal --}}
                <section x-show="$wire.selectedMethod" x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                    <h3 class="font-heading text-lg font-bold mb-4" style="color:#1e293b;">
                        <span class="wlt-step-badge">2</span> Pilih Nominal Saldo
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if(isset($denominations))
                        @foreach($denominations as $idx => $d)
                        <div class="wlt-denom" :class="{ 'active': $wire.selectedDenom === {{ $idx }} }" wire:click="$set('selectedDenom', {{ $idx }})">
                            <span class="text-xl font-bold font-heading" style="color:#0f172a;">{{ $d['rupiahF'] }}</span>
                            <span class="text-xs font-semibold font-mono-num px-3 py-1.5 rounded-lg transition-colors" :style="$wire.selectedDenom === {{ $idx }} ? 'background:#e0f2fe; color:#0284c7; border-color:#bae6fd;' : 'background:#f1f5f9; color:#475569; border: 1px solid #e2e8f0;'">
                                Cost: {{ $d['pointLabel'] }}
                            </span>
                            <span class="wlt-denom-check material-symbols-outlined">check_circle</span>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </section>

                {{-- 3. Nomor Akun --}}
                <section x-show="$wire.selectedMethod && $wire.selectedDenom !== null" x-transition:enter="transition ease-out duration-400 delay-75" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                    <h3 class="font-heading text-lg font-bold mb-4" style="color:#1e293b;">
                        <span class="wlt-step-badge">3</span> <span x-text="category === 'ewallet' ? 'Nomor HP (E-Wallet)' : 'Nomor Rekening Bank'">Nomor Akun</span>
                    </h3>
                    <div class="wlt-input-group">
                        <div class="wlt-input-icon">
                            <span class="material-symbols-outlined text-slate-400" style="font-size: 1.4rem;" x-text="category === 'ewallet' ? 'phone_iphone' : 'credit_card'"></span>
                        </div>
                        <input type="text"
                            class="wlt-input font-mono-num"
                            :placeholder="category === 'ewallet' ? 'Contoh: 081234567890' : 'Masukkan nomor rekening Anda'"
                            wire:model="nomorAkun">
                    </div>
                </section>

                {{-- Warning + Submit --}}
                <div x-show="$wire.selectedMethod && $wire.selectedDenom !== null" class="space-y-6 pt-4" style="border-top:1px dashed #cbd5e1; display: none;" x-transition:enter="transition ease-out duration-500 delay-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <div class="wlt-warning">
                        <span class="material-symbols-outlined" style="color:#2563eb; font-size:1.5rem; margin-top:2px;">info</span>
                        <div>
                            <p class="text-sm font-bold font-heading text-blue-900 mb-1">Informasi Penarikan</p>
                            <p class="text-sm font-medium" style="color:#1e3a8a; line-height:1.5; opacity: 0.85;">
                                Proses withdrawal membutuhkan waktu maksimal <strong>24 jam kerja</strong>. Pastikan nomor yang dimasukkan sudah benar karena transaksi tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>

                    <button class="wlt-btn-submit group"
                        wire:click="submitWithdraw"
                        wire:loading.attr="disabled"
                        wire:target="submitWithdraw">
                        <span wire:loading.remove wire:target="submitWithdraw">Tarik Saldo Sekarang</span>
                        <span wire:loading wire:target="submitWithdraw">Memproses Transaksi...</span>
                        <span class="material-symbols-outlined transition-transform group-hover:translate-x-1" style="font-size:1.4rem;" wire:loading.remove wire:target="submitWithdraw">arrow_forward</span>
                    </button>
                </div>
            </div>

            {{-- ══ RIWAYAT WITHDRAWAL (WITH FILTER & PAGINATION) ══ --}}
            @if(isset($riwayat) && count($riwayat) > 0)
            <div class="mt-16" x-data="{
            search: '',
            perPage: '5',
            filterStatus: 'all',
            filterMethod: 'all',
            historyData: @js($riwayat),
            get filteredHistory() {
                let result = this.historyData;

                // Status Filter
                if (this.filterStatus !== 'all') {
                    result = result.filter(r => r.status === this.filterStatus);
                }

                // Method Filter
                if (this.filterMethod !== 'all') {
                    result = result.filter(r => r.metode && r.metode.toLowerCase() === this.filterMethod.toLowerCase());
                }

                // Search Filter
                if (this.search.trim() !== '') {
                    const q = this.search.toLowerCase();
                    result = result.filter(r => 
                        (r.rupiahF && r.rupiahF.toLowerCase().includes(q)) || 
                        (r.nomorAkun && r.nomorAkun.toLowerCase().includes(q)) || 
                        (r.metode && r.metode.toLowerCase().includes(q))
                    );
                }

                // Pagination / Limit
                if (this.perPage !== 'all') {
                    result = result.slice(0, parseInt(this.perPage));
                }

                return result;
            },
            get uniqueMethods() {
                // Mendapatkan list unik metode untuk dropdown
                const methods = this.historyData.map(r => r.metode).filter(m => m);
                return [...new Set(methods)];
            }
        }">

                {{-- Header --}}
                <div class="mb-4">
                    <h2 class="text-xl font-bold font-heading" style="color:#1e293b;">Riwayat Penarikan</h2>
                    <p class="text-sm mt-1" style="color:#64748b;">Menampilkan riwayat transaksi penarikan saldo</p>
                </div>

                {{-- Toolbar Control (Search, Filters, Reset) --}}
                <div class="flex flex-col gap-3 mb-6">

                    {{-- Search Box (Full Width) --}}
                    <div class="relative w-full">
                        <span class="material-symbols-outlined wlt-search-icon">search</span>
                        <input type="text" x-model="search" placeholder="Cari nominal, nomor tujuan, atau metode..."
                            class="wlt-filter-ctrl w-full" style="padding-left:2.5rem;">
                    </div>

                    {{-- Filters & Reset Button --}}
                    <div class="flex flex-wrap gap-2">
                        <select x-model="filterStatus" class="wlt-filter-ctrl flex-1 sm:flex-none">
                            <option value="all">Semua Status</option>
                            <option value="success">Berhasil</option>
                            <option value="pending">Pending</option>
                            <option value="rejected">Ditolak</option>
                        </select>

                        <select x-model="filterMethod" class="wlt-filter-ctrl flex-1 sm:flex-none">
                            <option value="all">Semua Metode</option>
                            <template x-for="m in uniqueMethods" :key="m">
                                <option :value="m" x-text="m.toUpperCase()"></option>
                            </template>
                        </select>

                        <select x-model="perPage" class="wlt-filter-ctrl flex-1 sm:flex-none">
                            <option value="5">5 Data</option>
                            <option value="10">10 Data</option>
                            <option value="20">20 Data</option>
                            <option value="all">Semua Data</option>
                        </select>

                        <button @click="search = ''; filterStatus = 'all'; filterMethod = 'all'; perPage = '5'"
                            class="wlt-btn-reset flex-1 sm:flex-none" title="Reset filter">
                            <span class="material-symbols-outlined" style="font-size: 1.1rem;">restart_alt</span> Reset
                        </button>
                    </div>
                </div>

                {{-- Table List --}}
                <div class="bg-white rounded-2xl shadow-sm" style="border: 1px solid #e2e8f0; overflow: hidden; min-height: 100px;">

                    {{-- Data Render --}}
                    <template x-for="r in filteredHistory" :key="r.id">
                        <div class="wlt-history-row cursor-pointer group" @click="$wire.showInvoice(r.id)">

                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110"
                                :style="r.status === 'success' ? 'background:#dcfce7;' : (r.status === 'pending' ? 'background:#fefce8;' : 'background:#fee2e2;')">
                                <span class="material-symbols-outlined" style="font-size: 1.3rem;"
                                    :style="r.status === 'success' ? 'color:#16a34a;' : (r.status === 'pending' ? 'color:#d97706;' : 'color:#dc2626;')"
                                    x-text="r.status === 'success' ? 'check_circle' : (r.status === 'pending' ? 'schedule' : 'cancel')">
                                </span>
                            </div>

                            <div class="flex-1 min-w-0 ml-1 sm:ml-2">
                                <div class="flex flex-wrap items-center gap-1.5 sm:gap-3 mb-1 sm:mb-1.5">
                                    <p class="text-sm sm:text-base font-bold font-heading" style="color:#0f172a;" x-text="r.rupiahF"></p>
                                    <span :class="'wlt-badge wlt-badge-' + r.status">
                                        <span :class="'wlt-dot wlt-dot-' + r.status"></span>
                                        <span x-text="r.status.charAt(0).toUpperCase() + r.status.slice(1)"></span>
                                    </span>
                                </div>
                                <p class="text-xs sm:text-sm font-medium leading-tight" style="color:#64748b;">
                                    <span class="uppercase font-bold text-slate-700" x-text="r.metode"></span> • <span x-text="r.nomorAkun"></span>
                                </p>
                            </div>

                            <div class="text-right flex-shrink-0 flex items-center gap-2 sm:gap-3">
                                <div>
                                    <p class="text-xs sm:text-sm font-bold font-mono-num mb-0.5 sm:mb-1" style="color:#ef4444;" x-text="'-' + Number(r.point).toLocaleString('id-ID') + ' pts'"></p>
                                    <p class="text-[10px] sm:text-xs font-medium" style="color:#94a3b8;" x-text="r.tanggal"></p>
                                </div>
                                <span class="material-symbols-outlined transition-transform group-hover:translate-x-1 hidden sm:block" style="color:#0ea5e9; font-size:1.2rem;">arrow_forward</span>
                            </div>

                        </div>
                    </template>

                    {{-- Empty State (Jika hasil filter kosong) --}}
                    <div x-show="filteredHistory.length === 0" x-cloak class="p-10 text-center flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-slate-300" style="font-size: 3rem; margin-bottom: 10px;">search_off</span>
                        <p class="text-slate-500 font-medium text-sm">Tidak ada transaksi yang cocok dengan filter pencarian.</p>
                    </div>

                </div>
            </div>
            @endif

        </div>

        {{-- ══ INVOICE DETAIL DRAWER (RIGHT SIDE FIX) ══ --}}
        @if($invoiceDetail)
        <template x-teleport="body">
            <div class="wlt-modal-overlay" x-data="{ open: true }"
                x-show="open" x-cloak
                @keydown.window.escape="open = false; setTimeout(() => $wire.closeInvoice(), 300)"
                style="position:fixed; inset:0; z-index:99999;">

                {{-- Dark Overlay --}}
                <div style="position:absolute; inset:0; background:rgba(15, 23, 42, 0.4); backdrop-filter: blur(2px);"
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click="open = false; setTimeout(() => $wire.closeInvoice(), 300)">
                </div>

                {{-- Sliding Drawer Content --}}
                <div class="wlt-modal-content"
                    x-show="open"
                    x-transition:enter="transform transition ease-out duration-300 sm:duration-400"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in duration-300"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    style="background:#fff; width:100%; max-width:420px; height:100vh; overflow-y:auto; position:absolute; right:0; top:0; z-index:100; box-shadow:-10px 0 30px rgba(0,0,0,0.1); display:flex; flex-direction:column;">

                    {{-- Header --}}
                    <div style="padding:24px; display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #f1f5f9; background:#f8fafc;">
                        <h3 class="font-heading" style="font-size:1.1rem; font-weight:800; color:#0f172a; margin:0;">
                            <span class="material-symbols-outlined" style="font-size:1.2rem; vertical-align:middle; margin-right:6px; color:#2563eb;">receipt_long</span>
                            Detail Transaksi
                        </h3>
                        <button @click="open = false; setTimeout(() => $wire.closeInvoice(), 300)" style="background:#e2e8f0; border-radius:50%; border:none; cursor:pointer; width:32px; height:32px; display:flex; align-items:center; justify-content:center; transition:background 0.2s;">
                            <span class="material-symbols-outlined" style="color:#475569;font-size:1.2rem;">close</span>
                        </button>
                    </div>

                    <div style="padding:24px; flex-grow:1;">
                        <p style="color:#64748b; font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px;">ID Invoice #{{ $invoiceDetail['id'] }}</p>

                        {{-- Nominal Besar --}}
                        <div style="margin-bottom:24px;">
                            <h2 class="font-heading" style="font-size:2rem; font-weight:800; color:#0f172a; line-height:1; margin:0;">{{ $invoiceDetail['rupiahF'] }}</h2>
                            <p class="font-mono-num" style="color:#ef4444; font-weight:700; margin-top:6px; margin-bottom:0;">-{{ number_format($invoiceDetail['point']) }} pts</p>
                        </div>

                        {{-- Status Banner --}}
                        <div style="margin-bottom:24px; padding:12px 16px; border-radius:12px;
                         background:{{ $invoiceDetail['status'] === 'success' ? '#dcfce7' : ($invoiceDetail['status'] === 'pending' ? '#fef9c3' : '#fee2e2') }};">
                            <div style="display:flex;align-items:center;gap:8px;">
                                <span class="material-symbols-outlined" style="font-size:1.3rem;color:{{ $invoiceDetail['status'] === 'success' ? '#16a34a' : ($invoiceDetail['status'] === 'pending' ? '#d97706' : '#dc2626') }};">
                                    {{ $invoiceDetail['status'] === 'success' ? 'check_circle' : ($invoiceDetail['status'] === 'pending' ? 'schedule' : 'cancel') }}
                                </span>
                                <span class="font-heading" style="font-weight:700;font-size:.9rem;color:{{ $invoiceDetail['status'] === 'success' ? '#15803d' : ($invoiceDetail['status'] === 'pending' ? '#a16207' : '#b91c1c') }};">
                                    {{ $invoiceDetail['status'] === 'success' ? 'Withdrawal Berhasil' : ($invoiceDetail['status'] === 'pending' ? 'Menunggu Proses' : 'Withdrawal Ditolak') }}
                                </span>
                            </div>
                        </div>

                        {{-- Detail Info --}}
                        <div style="display:flex;flex-direction:column;gap:16px;">
                            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px dashed #e2e8f0;">
                                <span style="color:#64748b;font-size:.85rem;font-weight:500;">Metode Penarikan</span>
                                <span style="font-weight:700;font-size:.85rem;color:#0f172a; text-transform:uppercase;">{{ $invoiceDetail['metode'] }}</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px dashed #e2e8f0;">
                                <span style="color:#64748b;font-size:.85rem;font-weight:500;">Nomor Tujuan</span>
                                <span class="font-mono-num" style="font-weight:700;font-size:.9rem;color:#0ea5e9;">{{ $invoiceDetail['nomorAkun'] }}</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px dashed #e2e8f0;">
                                <span style="color:#64748b;font-size:.85rem;font-weight:500;">Waktu Pengajuan</span>
                                <div style="text-align:right;">
                                    <span style="font-weight:600;font-size:.85rem;color:#334155; display:block;">{{ $invoiceDetail['tanggal'] }}</span>
                                    <span style="font-weight:500;font-size:.75rem;color:#94a3b8;">{{ $invoiceDetail['waktu'] }}</span>
                                </div>
                            </div>
                            @if($invoiceDetail['status'] !== 'pending')
                            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px dashed #e2e8f0;">
                                <span style="color:#64748b;font-size:.85rem;font-weight:500;">Diproses oleh</span>
                                <span style="font-weight:600;font-size:.85rem;color:#334155;">{{ $invoiceDetail['adminNama'] }}</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:12px;border-bottom:1px dashed #e2e8f0;">
                                <span style="color:#64748b;font-size:.85rem;font-weight:500;">Waktu Selesai</span>
                                <span style="font-weight:600;font-size:.85rem;color:#334155;">{{ $invoiceDetail['updatedAt'] }}</span>
                            </div>
                            @endif
                        </div>

                        @if($invoiceDetail['catatan'])
                        <div style="margin-top:20px; padding:16px; background:#f8fafc; border-radius:12px; border:1px solid #e2e8f0;">
                            <span style="color:#64748b;font-size:.8rem;font-weight:700;display:block;margin-bottom:6px;text-transform:uppercase;">Catatan Admin</span>
                            <span style="font-weight:500;font-size:.9rem;color:#334155;line-height:1.5;">{{ $invoiceDetail['catatan'] }}</span>
                        </div>
                        @endif

                        {{-- Bukti Transfer dari Admin --}}
                        @if($invoiceDetail['image'])
                        <div style="margin-top:24px;">
                            <p class="font-heading" style="font-weight:700;font-size:.9rem;color:#0f172a;margin-bottom:12px;">
                                <span class="material-symbols-outlined" style="font-size:1.1rem;vertical-align:middle;margin-right:4px;color:#16a34a;">verified</span>
                                Bukti Transfer
                            </p>
                            <div style="border-radius:16px; overflow:hidden; border:2px solid #e2e8f0; box-shadow:0 4px 6px rgba(0,0,0,0.05);">
                                <img src="{{ $invoiceDetail['image'] }}" alt="Bukti Transfer" style="width:100%;display:block;transition:transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Footer Action --}}
                    <div style="padding:24px; border-top:1px solid #f1f5f9; background:#fff; position:sticky; bottom:0;">
                        <button @click="open = false; setTimeout(() => $wire.closeInvoice(), 300)"
                            class="wlt-btn-submit" style="box-shadow:none; padding:14px;">
                            Selesai
                        </button>
                    </div>
                </div>
            </div>
        </template>
        @endif

    </div>

    @push('scripts')
    <script>
        function walletPage() {
            return {
                category: 'ewallet',
            };
        }
    </script>
    @endpush

</x-filament-panels::page>