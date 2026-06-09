{{--
Misi Detail — PlayTest ID
Panel : Tester (/tester)
Page : MisiDetail.php
Fonts : Plus Jakarta Sans (heading), JetBrains Mono (angka), Inter (body)
--}}

<x-filament-panels::page>

    @push('styles')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"
            rel="stylesheet">

        <style>
            /* ══════════════════ FONTS ══════════════════ */
            .md-page,
            .md-page * {
                font-family: 'Inter', sans-serif;
            }

            .font-heading {
                font-family: 'Plus Jakarta Sans', sans-serif !important;
            }

            .font-mono-num {
                font-family: 'JetBrains Mono', monospace !important;
            }

            /* ══════════════════ LAYOUT ══════════════════ */
            .md-page {
                max-width: 860px;
                margin: 0 auto;
                padding: 0 0 2rem 0;
            }

            /* ══════════════════ HERO BANNER ══════════════════ */
            .md-hero {
                background: linear-gradient(135deg, #0a1850 0%, #13297a 30%, #1d4ed8 65%, #3b82f6 100%);
                background-size: 200% 200%;
                animation: md-gradient 12s ease infinite;
                border-radius: 1.5rem;
                padding: 2rem 2rem 2.5rem 2rem;
                position: relative;
                overflow: hidden;
                margin-bottom: 1.5rem;
            }

            @keyframes md-gradient {

                0%,
                100% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }
            }

            .md-hero-grid {
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(255, 255, 255, .06) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255, 255, 255, .06) 1px, transparent 1px);
                background-size: 28px 28px;
                pointer-events: none;
            }

            .md-hero-aurora {
                position: absolute;
                inset: -30%;
                background:
                    radial-gradient(40% 35% at 20% 30%, rgba(96, 165, 250, .4), transparent 60%),
                    radial-gradient(35% 30% at 80% 20%, rgba(167, 139, 250, .35), transparent 60%),
                    radial-gradient(45% 40% at 60% 80%, rgba(34, 211, 238, .3), transparent 60%);
                filter: blur(40px);
                animation: md-aurora 20s ease-in-out infinite;
                pointer-events: none;
            }

            @keyframes md-aurora {

                0%,
                100% {
                    transform: translate(-10%, -10%) rotate(0deg) scale(1.1);
                }

                50% {
                    transform: translate(8%, -6%) rotate(180deg) scale(1.2);
                }
            }

            /* ══════════════════ LOGO CARD ══════════════════ */
            .md-logo {
                width: 72px;
                height: 72px;
                border-radius: 1.25rem;
                object-fit: cover;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
                border: 3px solid rgba(255, 255, 255, 0.3);
                flex-shrink: 0;
            }

            .md-logo-placeholder {
                width: 72px;
                height: 72px;
                border-radius: 1.25rem;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                font-weight: 800;
                color: #fff;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
                border: 3px solid rgba(255, 255, 255, 0.3);
                flex-shrink: 0;
            }

            /* ══════════════════ BADGE PILL ══════════════════ */
            .md-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 4px 12px;
                border-radius: 999px;
                font-size: 0.75rem;
                font-weight: 600;
                backdrop-filter: blur(12px);
            }

            /* ══════════════════ STAT CARDS ══════════════════ */
            .md-stats-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            @media (max-width: 600px) {
                .md-stats-grid {
                    grid-template-columns: 1fr 1fr;
                }
            }

            .md-stat-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 1rem;
                padding: 1rem 1.25rem;
                text-align: center;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
                transition: box-shadow 0.2s ease, transform 0.2s ease;
            }

            .md-stat-card:hover {
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
                transform: translateY(-2px);
            }

            .md-stat-value {
                font-size: 1.5rem;
                font-weight: 700;
                color: #1e293b;
                font-family: 'JetBrains Mono', monospace;
                line-height: 1;
            }

            .md-stat-label {
                font-size: 0.7rem;
                color: #94a3b8;
                font-weight: 500;
                margin-top: 4px;
                text-transform: uppercase;
                letter-spacing: 0.07em;
            }

            .md-stat-icon {
                width: 36px;
                height: 36px;
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 8px auto;
            }

            /* ══════════════════ SECTION CARD ══════════════════ */
            .md-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 1.25rem;
                padding: 1.5rem;
                margin-bottom: 1.25rem;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            }

            .md-card-title {
                font-size: 0.75rem;
                font-weight: 700;
                color: #64748b;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                margin-bottom: 0.75rem;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .md-card-title-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                flex-shrink: 0;
            }

            /* ══════════════════ INSTRUKSI CONTENT ══════════════════ */
            .md-instruksi {
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 1rem;
                padding: 1.25rem;
                font-size: 0.875rem;
                color: #334155;
                line-height: 1.75;
            }

            .md-instruksi p {
                margin-bottom: 0.5rem;
            }

            .md-instruksi ul {
                list-style: disc;
                padding-left: 1.25rem;
                margin-bottom: 0.5rem;
            }

            .md-instruksi ol {
                list-style: decimal;
                padding-left: 1.25rem;
                margin-bottom: 0.5rem;
            }

            .md-instruksi h1,
            .md-instruksi h2,
            .md-instruksi h3 {
                font-weight: 700;
                color: #1e293b;
                margin-bottom: 0.5rem;
                font-family: 'Plus Jakarta Sans', sans-serif;
            }

            /* ══════════════════ PROGRESS BAR ══════════════════ */
            .md-progress-track {
                height: 8px;
                background: #e2e8f0;
                border-radius: 9999px;
                overflow: hidden;
            }

            .md-progress-fill {
                height: 100%;
                border-radius: 9999px;
                background: linear-gradient(90deg, #2563eb, #3b82f6);
                transition: width 1s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            /* ══════════════════ CTA SECTION ══════════════════ */
            .md-cta-joined {
                background: linear-gradient(135deg, #eff6ff, #dbeafe);
                border: 1px solid #bfdbfe;
                border-radius: 1.25rem;
                padding: 1.5rem;
            }

            .md-cta-waiting {
                background: linear-gradient(135deg, #fffbeb, #fef3c7);
                border: 1px solid #fde68a;
                border-radius: 1.25rem;
                padding: 1.5rem;
            }

            .md-btn-primary {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 20px;
                border-radius: 0.875rem;
                font-size: 0.875rem;
                font-weight: 700;
                color: #fff;
                background: linear-gradient(135deg, #2563eb, #1d4ed8);
                box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
                transition: all 0.2s ease;
                text-decoration: none;
                border: none;
                cursor: pointer;
                white-space: nowrap;
            }

            .md-btn-primary:hover {
                background: linear-gradient(135deg, #1d4ed8, #1e40af);
                transform: translateY(-1px);
                box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
            }

            .md-btn-outline {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 20px;
                border-radius: 0.875rem;
                font-size: 0.875rem;
                font-weight: 700;
                color: #2563eb;
                background: #fff;
                border: 1.5px solid #bfdbfe;
                transition: all 0.2s ease;
                text-decoration: none;
                cursor: pointer;
                white-space: nowrap;
            }

            .md-btn-outline:hover {
                background: #eff6ff;
                border-color: #93c5fd;
            }

            .md-btn-apply {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 12px 28px;
                border-radius: 0.875rem;
                font-size: 0.9rem;
                font-weight: 700;
                color: #fff;
                background: linear-gradient(135deg, #2563eb, #7c3aed);
                box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
                transition: all 0.2s ease;
                text-decoration: none;
                border: none;
                cursor: pointer;
            }

            .md-btn-apply:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 28px rgba(37, 99, 235, 0.45);
            }

            .md-btn-disabled {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 12px 28px;
                border-radius: 0.875rem;
                font-size: 0.9rem;
                font-weight: 700;
                color: #94a3b8;
                background: #f1f5f9;
                border: 1.5px solid #e2e8f0;
                cursor: not-allowed;
            }

            /* ══════════════════ BACK BUTTON ══════════════════ */
            .md-back-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 14px;
                border-radius: 0.75rem;
                font-size: 0.8125rem;
                font-weight: 600;
                color: #64748b;
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                text-decoration: none;
                transition: all 0.15s ease;
                margin-bottom: 1.25rem;
            }

            .md-back-btn:hover {
                background: #f1f5f9;
                color: #334155;
            }

            /* ══════════════════ PAKET BADGE ══════════════════ */
            .md-paket-premium {
                background: linear-gradient(135deg, #fef3c7, #fde68a);
                color: #92400e;
                border: 1px solid #fbbf24;
                padding: 6px 14px;
                border-radius: 999px;
                font-size: 0.75rem;
                font-weight: 700;
            }

            .md-paket-basic {
                background: linear-gradient(135deg, #eff6ff, #dbeafe);
                color: #1d4ed8;
                border: 1px solid #93c5fd;
                padding: 6px 14px;
                border-radius: 999px;
                font-size: 0.75rem;
                font-weight: 700;
            }

            /* ══════════════════ DAY TRACKER ══════════════════ */
            .md-day-track {
                display: flex;
                gap: 4px;
                flex-wrap: wrap;
            }

            .md-day-box {
                width: 28px;
                height: 28px;
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.65rem;
                font-weight: 700;
                background: #f1f5f9;
                color: #94a3b8;
                transition: all 0.2s ease;
            }

            .md-day-box.done {
                background: #dbeafe;
                color: #2563eb;
            }

            .md-day-box.today {
                background: #2563eb;
                color: #fff;
            }

            @media (prefers-reduced-motion: reduce) {

                .md-hero,
                .md-hero-aurora {
                    animation: none !important;
                }
            }
        </style>
    @endpush

    @php
        $misi = $misi ?? null;
        $alreadyJoined = $alreadyJoined ?? false;
        $misiAnggota = $misiAnggota ?? null;

        // Kategori berdasarkan id
        $categories = [
            ['bg' => '#eff6ff', 'color' => '#2563eb', 'label' => 'Functional Testing'],
            ['bg' => '#f5f3ff', 'color' => '#7c3aed', 'label' => 'UX Research'],
            ['bg' => '#ecfdf5', 'color' => '#059669', 'label' => 'Bug Reporting'],
            ['bg' => '#fff7ed', 'color' => '#c2410c', 'label' => 'Performance Testing'],
        ];
        $cat = $misi ? $categories[$misi->id % count($categories)] : $categories[0];

        $gradients = [
            'linear-gradient(135deg,#f59e0b,#f97316)',
            'linear-gradient(135deg,#6366f1,#8b5cf6)',
            'linear-gradient(135deg,#0ea5e9,#10b981)',
            'linear-gradient(135deg,#ef4444,#f97316)',
        ];
        $gradient = $misi ? $gradients[$misi->id % count($gradients)] : $gradients[0];

        $inisial = $misi ? strtoupper(substr($misi->nama_aplikasi, 0, 2)) : '??';
        $maxCapacity = config('missions.max_capacity', 20);
        $kapasitasPersen = $misi ? round(($misi->kapasitas / $maxCapacity) * 100) : 0;
        $isFull = $misi && ($misi->kapasitas >= $maxCapacity || $misi->status === 'closed');

        // Status tester untuk misi ini
        $maStatus = $misiAnggota?->status ?? null;
        $isRunning = $misi?->status === 'running';
        $isTrusted = $misi?->paket?->trusted_badge ?? false;
    @endphp

    <div class="md-page">

        {{-- BACK BUTTON --}}
        <a href="{{ url()->previous() }}" class="md-back-btn">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        @if(!$misi)
            <div class="md-card text-center py-10">
                <svg class="w-14 h-14 mx-auto mb-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <p class="text-slate-500 font-medium">Misi tidak ditemukan.</p>
                <a href="/tester" class="md-btn-primary mt-4 inline-flex">Ke Dashboard</a>
            </div>
        @else

            {{-- ═══════════════════════════
            HERO SECTION
            ═══════════════════════════ --}}
            <div class="md-hero">
                <div class="md-hero-grid"></div>
                <div class="md-hero-aurora"></div>

                <div class="relative z-10">
                    {{-- Logo + Nama + Badges --}}
                    <div class="flex items-start gap-4 mb-4">
                        @if($misi->logo)
                            <img src="/storage/{{ $misi->logo }}" alt="Logo" class="md-logo">
                        @else
                            <div class="md-logo-placeholder" style="background: {{ $gradient }};">
                                {{ $inisial }}
                            </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <h1 class="text-xl sm:text-2xl font-bold text-white font-heading mb-1 truncate">
                                {{ $misi->nama_aplikasi }}
                            </h1>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="md-badge"
                                    style="background:{{ $cat['bg'] }}22;color:#e0f2fe;border:1px solid rgba(255,255,255,0.2);">
                                    {{ $cat['label'] }}
                                </span>
                                @if($misi->paket)
                                    <span class="md-badge"
                                        style="background:rgba(251,191,36,0.2);color:#fef3c7;border:1px solid rgba(251,191,36,0.4);">
                                        ⭐ {{ $misi->paket->name }}
                                    </span>
                                @endif
                                @if($isTrusted)
                                    <span class="md-badge"
                                        style="background:rgba(139,92,246,0.25);color:#ddd6fe;border:1px solid rgba(139,92,246,0.4);">
                                        🔒 Trusted Badge
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Reward --}}
                        <div class="text-right flex-shrink-0">
                            <div class="font-mono-num font-bold text-2xl text-white">+{{ $misi->point }}</div>
                            <div class="text-xs text-blue-200">pts reward</div>
                        </div>
                    </div>

                    {{-- Status misi --}}
                    <div class="flex items-center gap-3">
                        @php
                            $statusColor = match ($misi->status) {
                                'open' => ['bg' => 'rgba(16,185,129,0.2)', 'border' => 'rgba(16,185,129,0.4)', 'text' => '#a7f3d0', 'dot' => '#10b981', 'label' => 'Menerima Tester'],
                                'running' => ['bg' => 'rgba(59,130,246,0.2)', 'border' => 'rgba(59,130,246,0.4)', 'text' => '#bfdbfe', 'dot' => '#60a5fa', 'label' => 'Sedang Berjalan'],
                                'closed' => ['bg' => 'rgba(239,68,68,0.2)', 'border' => 'rgba(239,68,68,0.4)', 'text' => '#fecaca', 'dot' => '#ef4444', 'label' => 'Penuh / Tertutup'],
                                default => ['bg' => 'rgba(148,163,184,0.2)', 'border' => 'rgba(148,163,184,0.4)', 'text' => '#cbd5e1', 'dot' => '#94a3b8', 'label' => ucfirst($misi->status)],
                            };
                        @endphp
                        <span class="md-badge"
                            style="background:{{ $statusColor['bg'] }};color:{{ $statusColor['text'] }};border:1px solid {{ $statusColor['border'] }};">
                            <span class="w-1.5 h-1.5 rounded-full inline-block flex-shrink-0"
                                style="background:{{ $statusColor['dot'] }};"></span>
                            {{ $statusColor['label'] }}
                        </span>
                        @if($alreadyJoined)
                            <span class="md-badge"
                                style="background:rgba(16,185,129,0.2);color:#a7f3d0;border:1px solid rgba(16,185,129,0.4);">
                                ✓ Sudah Bergabung
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ═══════════════════════════
            STAT CARDS
            ═══════════════════════════ --}}
            <div class="md-stats-grid">
                {{-- Durasi --}}
                <div class="md-stat-card">
                    <div class="md-stat-icon" style="background:#eff6ff;">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="md-stat-value">14</div>
                    <div class="md-stat-label">Hari Pengujian</div>
                </div>

                {{-- Tester --}}
                <div class="md-stat-card">
                    <div class="md-stat-icon" style="background:#f5f3ff;">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="md-stat-value">{{ $misi->kapasitas }}<span
                            class="text-base text-slate-400">/{{ $maxCapacity }}</span></div>
                    <div class="md-stat-label">Tester</div>
                </div>

                {{-- Reward --}}
                <div class="md-stat-card">
                    <div class="md-stat-icon" style="background:#f0fdf4;">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" style="color:#10b981;">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div class="md-stat-value" style="color:#10b981;">{{ $misi->point }}</div>
                    <div class="md-stat-label">Poin Reward</div>
                </div>
            </div>

            {{-- ═══════════════════════════
            KAPASITAS PROGRESS
            ═══════════════════════════ --}}
            <div class="md-card">
                <div class="md-card-title">
                    <span class="md-card-title-dot" style="background:#7c3aed;"></span>
                    Kapasitas Slot
                </div>
                <div class="flex items-center justify-between text-sm mb-2">
                    <span class="font-semibold" style="color:#334155;">
                        <span class="font-mono-num font-bold" style="color:#1e293b;">{{ $misi->kapasitas }}</span> dari
                        <span class="font-mono-num font-bold" style="color:#1e293b;">{{ $maxCapacity }}</span> tester
                    </span>
                    <span class="font-mono-num font-bold text-xs"
                        style="color:{{ $kapasitasPersen >= 80 ? '#ef4444' : '#2563eb' }};">{{ $kapasitasPersen }}%</span>
                </div>
                <div class="md-progress-track">
                    <div class="md-progress-fill" id="kapasitas-bar" data-target="{{ $kapasitasPersen }}%"
                        style="width:0%;background:linear-gradient(90deg,{{ $kapasitasPersen >= 80 ? '#ef4444,#f97316' : '#2563eb,#7c3aed' }});">
                    </div>
                </div>
                @if($isFull)
                    <p class="text-xs mt-2" style="color:#ef4444;font-weight:600;">⚠ Kapasitas penuh — misi ini tidak menerima
                        tester baru.</p>
                @else
                    <p class="text-xs mt-2" style="color:#64748b;">{{ $maxCapacity - $misi->kapasitas }} slot tersisa</p>
                @endif
            </div>

            {{-- ═══════════════════════════
            PAKET INFO
            ═══════════════════════════ --}}
            @if($misi->paket)
                <div class="md-card">
                    <div class="md-card-title">
                        <span class="md-card-title-dot" style="background:#f59e0b;"></span>
                        Paket Misi
                    </div>
                    <div class="flex items-center gap-3 mb-3">
                        @if(str_contains(strtolower($misi->paket->name ?? ''), 'premium'))
                            <span class="md-paket-premium">⭐ {{ $misi->paket->name }}</span>
                        @else
                            <span class="md-paket-basic">📦 {{ $misi->paket->name }}</span>
                        @endif
                        @if($isTrusted)
                            <span class="text-xs font-semibold px-3 py-1.5 rounded-full"
                                style="background:#f5f3ff;color:#7c3aed;border:1px solid #ddd6fe;">
                                🔒 Memerlukan Trusted Badge
                            </span>
                        @endif
                    </div>
                    @if($misi->paket->desc)
                        <div class="text-sm" style="color:#475569;line-height:1.6;">
                            {!! $misi->paket->desc !!}
                        </div>
                    @endif
                </div>
            @endif

            {{-- ═══════════════════════════
            INSTRUKSI PENGUJIAN
            ═══════════════════════════ --}}
            <div class="md-card">
                <div class="md-card-title">
                    <span class="md-card-title-dot" style="background:#2563eb;"></span>
                    Instruksi Pengujian
                </div>
                @if($misi->instruksi)
                    <div class="md-instruksi">
                        {!! $misi->instruksi !!}
                    </div>
                @else
                    <p class="text-sm" style="color:#94a3b8;">Belum ada instruksi dari developer.</p>
                @endif
            </div>

            {{-- ═══════════════════════════
            TIMELINE 14 HARI
            ═══════════════════════════ --}}
            <div class="md-card">
                <div class="md-card-title">
                    <span class="md-card-title-dot" style="background:#10b981;"></span>
                    {{ __('Pelacak') }} 14 {{ __('Hari') }}
                </div>
                <div class="md-day-track mb-2">
                    @for($d = 1; $d <= 14; $d++)
                        <div class="md-day-box" title="Hari {{ $d }}">{{ $d }}</div>
                    @endfor
                </div>
                <p class="text-xs" style="color:#94a3b8;">Selesaikan 14 hari penuh untuk mendapatkan reward penuh.</p>
            </div>

            {{-- ═══════════════════════════
            CTA — STATUS TESTER
            ═══════════════════════════ --}}
            <div class="mt-2">

                {{-- Sudah bergabung + misi running --}}
                @if($alreadyJoined && $isRunning && $misi->link_aplikasi)
                    <div class="md-cta-joined">
                        <div class="flex items-start gap-3 mb-4">
                            <div style="background:#dbeafe;border-radius:0.75rem;padding:10px;flex-shrink:0;">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-800 font-heading text-base">Misi Sudah Dimulai!</h3>
                                <p class="text-sm text-blue-700 mt-1">
                                    Developer telah memulai misi ini. Download aplikasinya, uji sesuai instruksi, lalu kumpulkan
                                    laporan harian selama 14 hari.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <a href="{{ $misi->link_aplikasi }}" target="_blank" class="md-btn-outline">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download Aplikasi
                            </a>
                            <a href="/tester/misi-saya" class="md-btn-primary">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                                Submit Task Harian
                            </a>
                        </div>
                    </div>

                    {{-- Sudah bergabung + misi belum mulai --}}
                @elseif($alreadyJoined && !$isRunning)
                    <div class="md-cta-waiting">
                        <div class="flex items-start gap-3">
                            <div style="background:#fde68a;border-radius:0.75rem;padding:10px;flex-shrink:0;">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#92400e" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold font-heading text-base" style="color:#92400e;">Menunggu Misi Dimulai</h3>
                                <p class="text-sm mt-1" style="color:#a16207;">
                                    @if($maStatus === 'pending')
                                        Pendaftaran Anda sedang menunggu persetujuan developer. Anda akan mendapat notifikasi saat
                                        diterima.
                                    @else
                                        Anda sudah terdaftar. Tunggu developer memulai misi dan menyediakan link aplikasi.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Belum bergabung --}}
                @elseif(!$alreadyJoined)
                    <div class="md-card"
                        style="border:none;background:linear-gradient(135deg,#f8fafc,#f1f5f9);text-align:center;padding:2rem;">
                        @if($isFull)
                            <div class="mb-3" style="background:#fee2e2;border-radius:0.875rem;padding:10px;display:inline-flex;">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01M5.07 19H19a2 2 0 001.75-2.98L13.75 4a2 2 0 00-3.5 0L3.25 16.02A2 2 0 005.07 19z" />
                                </svg>
                            </div>
                            <p class="font-bold font-heading text-lg mb-1" style="color:#1e293b;">Misi Penuh</p>
                            <p class="text-sm mb-4" style="color:#64748b;">Kapasitas tester sudah terpenuhi. Coba misi lainnya.</p>
                            <a href="/tester" class="md-btn-primary">Lihat Misi Lain</a>
                        @else
                            <div class="mb-3" style="background:#dbeafe;border-radius:0.875rem;padding:10px;display:inline-flex;">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="font-bold font-heading text-lg mb-1" style="color:#1e293b;">Tertarik Bergabung?</p>
                            <p class="text-sm mb-5" style="color:#64748b;">
                                @if($isTrusted)
                                    Misi ini membutuhkan <strong>Trusted Badge</strong> untuk bergabung.
                                @else
                                    Selesaikan 14 hari penuh dan dapatkan <strong>+{{ $misi->point }} poin</strong> reward.
                                @endif
                            </p>
                            <button wire:click="takeMission" class="md-btn-apply" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="takeMission">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    {{ $isTrusted ? 'Daftar (Perlu Verifikasi)' : 'Apply Sekarang' }}
                                </span>
                                <span wire:loading wire:target="takeMission">Memproses...</span>
                            </button>
                        @endif
                    </div>
                @endif

            </div>

        @endif

    </div>{{-- end md-page --}}

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Animate kapasitas bar
                const bar = document.getElementById('kapasitas-bar');
                if (bar) {
                    const target = bar.dataset.target || '0%';
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.transition = 'width 1s cubic-bezier(0.34, 1.56, 0.64, 1)';
                        bar.style.width = target;
                    }, 300);
                }
            });
        </script>
    @endpush

</x-filament-panels::page>