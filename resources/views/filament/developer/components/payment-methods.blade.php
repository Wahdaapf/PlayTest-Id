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
        // Fallback to static below
    }

    if (empty($methods)) {
        $methods = [
            [
                'paymentMethod' => 'BC',
                'paymentName' => 'BCA VA',
                'paymentImage' => 'https://images.duitku.com/hotlink-ok/BCA.SVG',
            ],
            [
                'paymentMethod' => 'M2',
                'paymentName' => 'MANDIRI VA',
                'paymentImage' => 'https://images.duitku.com/hotlink-ok/MV.PNG',
            ],
            [
                'paymentMethod' => 'I1',
                'paymentName' => 'BNI VA',
                'paymentImage' => 'https://images.duitku.com/hotlink-ok/I1.PNG',
            ],
            [
                'paymentMethod' => 'BR',
                'paymentName' => 'BRI VA',
                'paymentImage' => 'https://images.duitku.com/hotlink-ok/BR.PNG',
            ],
            [
                'paymentMethod' => 'BT',
                'paymentName' => 'PERMATA VA',
                'paymentImage' => 'https://images.duitku.com/hotlink-ok/PERMATA.PNG',
            ],
            [
                'paymentMethod' => 'SP',
                'paymentName' => 'SHOPEEPAY QRIS',
                'paymentImage' => 'https://images.duitku.com/hotlink-ok/SHOPEEPAY.PNG',
            ],
            [
                'paymentMethod' => 'DA',
                'paymentName' => 'DANA',
                'paymentImage' => 'https://images.duitku.com/hotlink-ok/DA.PNG',
            ],
            [
                'paymentMethod' => 'OV',
                'paymentName' => 'OVO',
                'paymentImage' => 'https://images.duitku.com/hotlink-ok/OV.PNG',
            ],
            [
                'paymentMethod' => 'IR',
                'paymentName' => 'INDOMARET',
                'paymentImage' => 'https://images.duitku.com/hotlink-ok/IR.PNG',
            ],
        ];
    }

    // Kelompokkan
    $groupedMethods = [];
    foreach ($methods as $item) {
        $code = $item['paymentMethod'];
        $name = $item['paymentName'];
        $image = $item['paymentImage'];
        
        $kategori = 'Lainnya';
        if (str_contains(strtolower($name), 'va') || str_contains(strtolower($name), 'virtual account')) {
            $kategori = 'Virtual Account';
        } elseif (in_array($code, ['OV', 'DA', 'LA', 'SA', 'SP', 'LQ', 'NQ', 'GQ']) || str_contains(strtolower($name), 'qris') || str_contains(strtolower($name), 'ovo') || str_contains(strtolower($name), 'dana') || str_contains(strtolower($name), 'linkaja') || str_contains(strtolower($name), 'shopeepay')) {
            $kategori = 'E-Wallet / QRIS';
        } elseif (in_array($code, ['IR', 'FT']) || str_contains(strtolower($name), 'indomaret') || str_contains(strtolower($name), 'retail')) {
            $kategori = 'Retail / Gerai';
        } elseif ($code === 'VC' || str_contains(strtolower($name), 'card') || str_contains(strtolower($name), 'kartu')) {
            $kategori = 'Kartu Kredit';
        }
        
        $groupedMethods[$kategori][] = (object) [
            'id' => $code,
            'name' => $name,
            'image' => $image,
            'kategori' => $kategori
        ];
    }
@endphp

{{-- ── Wrapper utama diberi space-y-12 agar jarak ANTAR KATEGORI sangat lega ── --}}
<div x-data="{ selectedPayment: @entangle('data.payment_method') }" class="space-y-12 pt-2">
    
    @foreach($groupedMethods as $kategori => $methods)
        <div class="space-y-6"> {{-- Jarak antara judul kategori dengan kotak-kotak di bawahnya --}}
            
            {{-- ── Judul Kategori & Garis Pemisah ── --}}
            <div class="flex items-center">
                <h4 class="text-sm font-black text-slate-500 dark:text-gray-400 uppercase tracking-widest shrink-0 pr-4">
                    {{ $kategori }}
                </h4>
                <div class="flex-1 border-t-2 border-slate-100 dark:border-white/10"></div>
            </div>

            {{-- ── Grid Payment Methods ── --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-5">
                @foreach($methods as $method)
                    @php $id = $method->id; @endphp
                    
                    <div 
                        x-on:click="selectedPayment = '{{ $id }}'"
                        class="group relative cursor-pointer rounded-2xl border-2 transition-all duration-300 ease-out flex flex-col items-center justify-center p-4 min-h-[100px] overflow-hidden"
                        :class="selectedPayment == '{{ $id }}' 
                            ? 'border-red-500 bg-red-50/30 dark:bg-red-500/10 shadow-[0_4px_20px_rgb(239,68,68,0.1)] ring-2 ring-red-500/20' 
                            : 'border-slate-200 dark:border-white/10 bg-white dark:bg-white/5 hover:border-red-300 dark:hover:border-red-500/50 hover:shadow-md hover:-translate-y-0.5'"
                    >
                        {{-- Icon Checklist (Pojok Kanan Atas) saat dipilih --}}
                        <div 
                            class="absolute top-2 right-2 w-5 h-5 rounded-full flex items-center justify-center transition-all duration-300 z-10"
                            :class="selectedPayment == '{{ $id }}' ? 'bg-red-500 scale-100' : 'scale-0'"
                        >
                            <x-heroicon-m-check class="w-3.5 h-3.5 text-white stroke-[3]" />
                        </div>

                        {{-- Wrapper Logo --}}
                        <div class="relative w-full h-12 flex items-center justify-center mb-2">
                            {{-- 
                                Menggunakan div putih di dark mode agar logo payment 
                                (yang biasanya transparan/teks hitam) tetap terlihat jelas!
                            --}}
                            <div class="absolute inset-0 bg-white rounded-lg transition-opacity duration-300 dark:opacity-100 opacity-0 z-0"></div>
                            
                            <img 
                                src="{{ str_starts_with($method->image, 'http') ? $method->image : asset('storage/' . $method->image) }}" 
                                alt="{{ $method->name }}"
                                class="max-h-10 max-w-[80%] object-contain transition-all duration-500 z-10"
                                :class="selectedPayment == '{{ $id }}' ? 'grayscale-0 opacity-100 scale-110' : 'grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100'"
                            >
                        </div>

                        {{-- Nama Payment Method --}}
                        <span 
                            class="text-xs font-bold text-center mt-1 transition-colors duration-300 z-10"
                            :class="selectedPayment == '{{ $id }}' ? 'text-red-600 dark:text-red-400' : 'text-slate-500 dark:text-gray-400 group-hover:text-slate-800 dark:group-hover:text-gray-200'"
                        >
                            {{ $method->name }}
                        </span>
                        
                        {{-- Bottom accent bar (Garis tipis di bawah saat dipilih) --}}
                        <div 
                            class="absolute bottom-0 inset-x-0 h-1 transition-all duration-300"
                            :class="selectedPayment == '{{ $id }}' ? 'bg-red-500' : 'bg-transparent'"
                        ></div>
                    </div>
                @endforeach
            </div>
            
        </div>
    @endforeach
</div>