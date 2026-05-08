<x-filament-panels::page>

    @push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        body,
        .fi-main,
        .fi-simple-main {
            font-family: 'Inter', sans-serif !important;
        }

        .tk-sora {
            font-family: 'Sora', sans-serif !important;
        }

        .tk-mono {
            font-family: 'JetBrains Mono', monospace !important;
        }

        .fi-main {
            background-color: #f8fafc !important;
        }

        [x-cloak] {
            display: none !important;
        }

        /* ══ ANIMATIONS & INTERACTIONS (NEW) ══ */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        /* ══ STAT CARDS ══ */
        .tk-stat {
            background: #fff;
            border-radius: 14px;
            padding: 18px 20px;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .tk-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, .1);
        }

        .tk-stat::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
            transform: skewX(-25deg);
            transition: 0.75s;
            z-index: 1;
            pointer-events: none;
        }

        .tk-stat:hover::after {
            left: 125%;
        }

        .tk-stat-accent {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .tk-stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .tk-stat:hover .tk-stat-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .tk-stat-label {
            font-size: .72rem;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .tk-stat-value {
            font-size: 1.4rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.1;
        }

        .tk-stat-sub {
            font-size: .72rem;
            color: #94a3b8;
            margin-top: 2px;
        }

        .tk-growth {
            font-size: .7rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 20px;
        }

        /* Stat Colors */
        .tk-grad-blue {
            background: linear-gradient(90deg, #2563eb, #60a5fa);
        }

        .tk-grad-emerald {
            background: linear-gradient(90deg, #10b981, #34d399);
        }

        .tk-grad-green {
            background: linear-gradient(90deg, #22c55e, #86efac);
        }

        .tk-grad-orange {
            background: linear-gradient(90deg, #f59e0b, #fcd34d);
        }

        .tk-bg-blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .tk-bg-emerald {
            background: #d1fae5;
            color: #10b981;
        }

        .tk-bg-green {
            background: #dcfce7;
            color: #16a34a;
        }

        .tk-bg-orange {
            background: #fef9c3;
            color: #f59e0b;
        }

        /* ══ CHART ══ */
        .tk-chart-bar-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            gap: 4px;
        }

        .tk-chart-bar-outer {
            width: 100%;
            height: 120px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .tk-chart-bar {
            width: 80%;
            border-radius: 6px 6px 0 0;
            background: linear-gradient(to top, #1d4ed8, #60a5fa);
            height: 0;
            transition: height 1.2s cubic-bezier(.4, 0, .2, 1), opacity 0.2s, box-shadow 0.2s;
            position: relative;
            cursor: pointer;
        }

        .tk-chart-bar:hover {
            opacity: 1;
            box-shadow: 0 0 12px rgba(37, 99, 235, 0.6);
            transform: scaleY(1.02);
            transform-origin: bottom;
        }

        .tk-chart-bar-tooltip {
            position: absolute;
            top: -32px;
            left: 50%;
            transform: translateX(-50%) translateY(5px);
            background: #0f172a;
            color: #fff;
            font-size: .65rem;
            padding: 3px 7px;
            border-radius: 6px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: all .2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .tk-chart-bar:hover .tk-chart-bar-tooltip {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .tk-chart-label {
            font-size: .7rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .tk-chart-active .tk-chart-bar {
            background: linear-gradient(to top, #f59e0b, #fcd34d) !important;
        }

        .tk-chart-active .tk-chart-bar:hover {
            box-shadow: 0 0 12px rgba(245, 158, 11, 0.6) !important;
        }

        /* ══ FILTER & SEARCH BAR ══ */
        .tk-filter-bar {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
            transition: box-shadow 0.3s;
        }

        .tk-filter-bar:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .tk-search-wrap {
            position: relative;
            flex: 2;
            min-width: 320px;
        }

        .tk-search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.2rem;
            transition: color 0.2s;
        }

        .tk-search-wrap:focus-within .tk-search-icon {
            color: #2563eb;
        }

        .tk-search-input {
            width: 100%;
            padding-left: 42px !important;
        }

        .tk-input,
        .tk-select {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: .85rem;
            color: #334155;
            background: #f8fafc;
            outline: none;
            transition: all .2s;
            font-family: 'Inter', sans-serif;
        }

        .tk-input:focus,
        .tk-select:focus {
            border-color: #2563eb;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .tk-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: .85rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all .15s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Inter', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            justify-content: center;
        }

        .tk-btn:active {
            transform: scale(0.95);
        }

        .tk-btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
        }

        .tk-btn-primary:hover {
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
            transform: translateY(-1px);
        }

        .tk-btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
        }

        .tk-btn-danger:hover {
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
            transform: translateY(-1px);
        }

        .tk-btn-secondary {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .tk-btn-secondary:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .tk-btn-ghost {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .tk-btn-ghost:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .tk-btn-ghost-danger {
            color: #b91c1c;
            border: 1px solid #fecaca;
            background: #fef2f2;
        }

        .tk-btn-ghost-danger:hover {
            background: #fee2e2;
        }

        .tk-btn-export {
            background: #0f172a;
            color: #fff;
            border: 1px solid #0f172a;
        }

        .tk-btn-export:hover {
            background: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
        }

        .tk-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .tk-btn-icon {
            background: #f1f5f9;
            border: none;
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .15s;
            color: #64748b;
        }

        .tk-btn-icon:hover {
            background: #e2e8f0;
            color: #0f172a;
            transform: scale(1.05);
        }

        .tk-btn-icon:active {
            transform: scale(0.95);
        }

        /* ══ SORT HEADER BUTTON ══ */
        .tk-sort-btn { display: inline-flex; align-items: center; gap: 3px; background: none; border: none; cursor: pointer; font-size: .75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .07em; padding: 0; transition: color 0.2s; font-family: 'Inter', sans-serif; white-space: nowrap; }
        .tk-sort-btn:hover  { color: #2563eb; }
        .tk-sort-btn.active { color: #2563eb; }
        .tk-sort-icon { font-size: .95rem !important; line-height: 1; }

        /* ══ TABLE ══ */
        .tk-table-wrap {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .tk-table {
            width: 100%;
            border-collapse: collapse;
        }

        .tk-table thead tr {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .tk-table th {
            padding: 12px 16px;
            font-size: .75rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .07em;
            text-align: left;
            white-space: nowrap;
        }

        .tk-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            transition: background 0.2s;
        }

        .tk-table tbody tr {
            transition: all .2s;
        }

        .tk-table tbody tr td:first-child {
            border-left: 3px solid transparent;
            transition: border-color 0.2s;
        }

        .tk-table tbody tr:hover {
            background: #f8fafc;
        }

        .tk-table tbody tr:hover td:first-child {
            border-left-color: #2563eb;
        }

        .tk-table tbody tr:last-child td {
            border-bottom: none;
        }

        .tk-avatar {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            transition: transform 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .tk-table tbody tr:hover .tk-avatar {
            transform: scale(1.05) rotate(5deg);
        }

        /* Table Text Utilities */
        .tk-td-id {
            font-size: .75rem;
            color: #334155;
            font-weight: 600;
        }

        .tk-td-subid {
            font-size: .67rem;
            color: #94a3b8;
        }

        .tk-td-name {
            font-size: .85rem;
            color: #1e293b;
            font-weight: 600;
        }

        .tk-td-campaign {
            font-size: .85rem;
            color: #334155;
            font-weight: 500;
            max-width: 180px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tk-td-nom {
            font-size: .88rem;
            color: #0f172a;
            font-weight: 700;
        }

        .tk-td-metode {
            font-size: .82rem;
            color: #475569;
        }

        .tk-td-bank {
            font-size: .72rem;
            color: #94a3b8;
        }

        .tk-td-date {
            font-size: .82rem;
            color: #334155;
        }

        .tk-td-time {
            font-size: .72rem;
            color: #94a3b8;
        }

        /* ══ BADGES & ACTIONS ══ */
        .tk-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .tk-badge-berhasil {
            background: #dcfce7;
            color: #15803d;
        }

        .tk-badge-pending {
            background: #fef9c3;
            color: #a16207;
        }

        .tk-badge-refund {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .tk-badge-gagal {
            background: #fee2e2;
            color: #b91c1c;
        }

        .tk-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .tk-dot-berhasil {
            background: #22c55e;
        }

        .tk-dot-pending {
            background: #eab308;
            animation: pulse-tk 2s infinite;
        }

        .tk-dot-refund {
            background: #3b82f6;
        }

        .tk-dot-gagal {
            background: #ef4444;
        }

        @keyframes pulse-tk {
            0% {
                box-shadow: 0 0 0 0 rgba(234, 179, 8, 0.4);
            }

            70% {
                box-shadow: 0 0 0 4px rgba(234, 179, 8, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(234, 179, 8, 0);
            }
        }

        .tk-paket {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: .72rem;
            font-weight: 600;
        }

        .tk-paket-starter {
            background: #f1f5f9;
            color: #475569;
        }

        .tk-paket-pro {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .tk-paket-business {
            background: #fdf4ff;
            color: #7e22ce;
        }

        .tk-action {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: .78rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all .15s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .tk-action-detail {
            background: #eff6ff;
            color: #2563eb;
        }

        .tk-action-detail:hover {
            background: #dbeafe;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.15);
        }

        .tk-action-detail:active {
            transform: scale(0.95);
        }

        /* ══ PAGINATION ══ */
        .tk-pagi {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
            font-size: .8rem;
            color: #64748b;
            background: #fff;
            border-radius: 0 0 14px 14px;
        }

        .tk-pagi-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            color: #475569;
            transition: all .15s;
        }

        .tk-pagi-btn:hover {
            background: #eff6ff;
            border-color: #2563eb;
            color: #2563eb;
            transform: translateY(-1px);
        }

        .tk-pagi-btn:active {
            transform: scale(0.9);
        }

        .tk-pagi-btn.active {
            background: #2563eb;
            border-color: #2563eb;
            color: #fff;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
        }

        /* ══ EMPTY STATE ══ */
        .tk-empty {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .tk-empty-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 16px;
            border-radius: 16px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s;
        }

        .tk-empty:hover .tk-empty-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        /* ══ MODAL & SLIDE OUT ══ */
        .tk-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .tk-modal-box {
            background: #fff;
            border-radius: 20px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .tk-modal-header {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .tk-modal-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tk-modal-title-icon {
            font-size: 1.3rem;
            padding: 6px;
            border-radius: 8px;
        }

        .tk-modal-title-icon.success {
            color: #10b981;
            background: #ecfdf5;
        }

        .tk-modal-title-icon.danger {
            color: #ef4444;
            background: #fef2f2;
        }

        .tk-modal-body {
            padding: 24px;
        }

        .tk-modal-footer {
            padding: 18px 24px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            background: #f8fafc;
        }

        .tk-alert {
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .tk-alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        .tk-alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .tk-alert-icon {
            font-size: 1.4rem;
            margin-top: 2px;
        }

        .tk-alert-icon.success {
            color: #10b981;
        }

        .tk-alert-icon.danger {
            color: #ef4444;
        }

        .tk-alert-title {
            font-size: .9rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .tk-alert-title.success {
            color: #065f46;
        }

        .tk-alert-title.danger {
            color: #991b1b;
        }

        .tk-alert-text {
            font-size: .85rem;
            line-height: 1.5;
            opacity: .9;
        }

        .tk-alert-text.success {
            color: #064e3b;
        }

        .tk-alert-text.danger {
            color: #7f1d1d;
        }

        .tk-detail-bg {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .55);
            backdrop-filter: blur(6px);
            z-index: 9998;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
        }

        .tk-detail-panel {
            width: 420px;
            max-width: 95vw;
            height: 100vh;
            background: #fff;
            overflow-y: auto;
            box-shadow: -15px 0 50px rgba(0, 0, 0, .2);
        }

        .tk-detail-header {
            padding: 22px 24px 18px;
            border-bottom: 1px solid #e2e8f0;
            background: rgba(248, 250, 252, 0.9);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .tk-detail-body {
            padding: 22px 24px;
        }

        .tk-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: .85rem;
            transition: background 0.2s;
        }

        .tk-detail-row:hover {
            background: #f8fafc;
            padding-left: 8px;
            padding-right: 8px;
            margin-left: -8px;
            margin-right: -8px;
            border-radius: 8px;
            border-bottom-color: transparent;
        }

        .tk-detail-row:last-child {
            border-bottom: none;
        }

        .tk-detail-label {
            color: #64748b;
            font-weight: 500;
            flex-shrink: 0;
            margin-right: 16px;
        }

        .tk-detail-val {
            color: #0f172a;
            font-weight: 600;
            text-align: right;
        }

        .tk-detail-section {
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: #94a3b8;
            margin: 18px 0 8px;
        }

        .tk-detail-footer {
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            gap: 10px;
            background: #f8fafc;
            position: sticky;
            bottom: 0;
            z-index: 10;
        }

        .tk-summary-box {
            background: linear-gradient(135deg, #1e3a5f, #0f172a);
            border-radius: 12px;
            padding: 20px;
            color: #fff;
            margin-bottom: 10px;
            box-shadow: 0 10px 25px -5px rgba(30, 58, 95, 0.3);
        }
    </style>
    @endpush

    <div class="space-y-5" x-data="transaksiKeuangan()" x-init="initChart()">

        {{-- ══ HEADER ══ --}}
        <div class="flex items-center justify-between animate-fade-in-up">
            <div>
                <h1 class="tk-sora text-xl font-bold text-slate-900">Manajemen Pembayaran Developer</h1>
                <p class="text-sm text-slate-500 mt-0.5">Rekap seluruh transaksi pembayaran paket kampanye</p>
            </div>
            <button class="tk-btn tk-btn-export">
                <span class="material-symbols-outlined text-[1.1rem]">download</span>
                Export CSV
            </button>
        </div>

        {{-- ══ STAT CARDS ══ --}}
        <!-- Ubah xl:grid-cols-5 menjadi xl:grid-cols-6 -->
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4 animate-fade-in-up delay-100">

            <div class="tk-stat xl:col-span-2">
                <div class="tk-stat-accent tk-grad-blue"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="tk-stat-icon tk-bg-blue">
                        <span class="material-symbols-outlined">account_balance_wallet</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="tk-stat-label">Total Pendapatan</div>
                        <div class="tk-stat-value tk-mono">{{ $statTotalPendapatan }}</div>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="tk-growth bg-green-100 text-green-700">{{ $growthPendapatan }}</span>
                            <span class="tk-stat-sub">vs bulan lalu</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tambahkan xl:col-span-2 di sini -->
            <div class="tk-stat xl:col-span-2">
                <div class="tk-stat-accent tk-grad-emerald"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="tk-stat-icon tk-bg-emerald">
                        <span class="material-symbols-outlined">calendar_month</span>
                    </div>
                    <div>
                        <div class="tk-stat-label">Bulan Ini</div>
                        <div class="tk-stat-value tk-mono text-[1.1rem]">{{ $statBulanIni }}</div>
                        <span class="tk-growth bg-green-100 text-green-700 inline-block mt-1">{{ $growthBulanIni }}</span>
                    </div>
                </div>
            </div>

            <div class="tk-stat">
                <div class="tk-stat-accent tk-grad-green"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="tk-stat-icon tk-bg-green">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                    <div>
                        <div class="tk-stat-label">Berhasil</div>
                        <div class="tk-stat-value">{{ $statBerhasil }}</div>
                        <div class="tk-stat-sub">transaksi</div>
                    </div>
                </div>
            </div>

            <div class="tk-stat">
                <div class="tk-stat-accent tk-grad-orange"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="tk-stat-icon tk-bg-orange">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <div>
                        <div class="tk-stat-label">Pending</div>
                        <div class="tk-stat-value text-[#d97706]">{{ $statPending }}</div>
                        <div class="tk-stat-sub">menunggu konfirmasi</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ CHART + RINGKASAN ══ --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 animate-fade-in-up delay-200">

            <div class="xl:col-span-2 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <div class="tk-sora font-bold text-slate-900 text-base">Pendapatan 6 Bulan Terakhir</div>
                        <div class="text-xs text-slate-400 mt-0.5">Berdasarkan transaksi yang berhasil dikonfirmasi</div>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <span class="inline-block w-3 h-3 rounded-sm tk-grad-blue"></span> Pendapatan
                    </div>
                </div>
                <div class="flex items-end gap-3 h-[140px]">
                    @php $maxNilai = max($chartNilai) ?: 1; @endphp
                    @foreach($chartBulan as $i => $bulan)
                    @php
                    $pct = round(($chartNilai[$i] / $maxNilai) * 120);
                    $val = $chartNilai[$i];
                    $valF = 'Rp ' . number_format($val, 0, ',', '.');
                    $isLast = $i === count($chartBulan) - 1;
                    @endphp
                    <div class="tk-chart-bar-wrap">
                        <div class="tk-chart-bar-outer">
                            <div class="tk-chart-bar {{ $isLast ? 'tk-chart-active' : '' }}" data-target="{{ $pct }}">
                                <div class="tk-chart-bar-tooltip">{{ $valF }}</div>
                            </div>
                        </div>
                        <div class="tk-chart-label">{{ $bulan }}</div>
                        <div class="tk-mono text-slate-500 text-[0.62rem]">{{ number_format($val/1000000,1) }}jt</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <div class="bg-white border border-slate-200 rounded-2xl p-5 flex-1 shadow-sm hover:shadow-md transition-shadow">
                    <div class="tk-sora font-bold text-slate-800 text-sm mb-4">Ringkasan Status</div>
                    <div class="space-y-4">
                        @php $total = $statBerhasil + $statPending + $statRefund; @endphp
                        @if($total > 0)
                        @php
                        $ringkasan = [
                        ['label'=>'Berhasil','val'=>$statBerhasil,'pct'=>round($statBerhasil/$total*100),'color'=>'#22c55e'],
                        ['label'=>'Pending', 'val'=>$statPending, 'pct'=>round($statPending/$total*100), 'color'=>'#f59e0b'],
                        ['label'=>'Refund', 'val'=>$statRefund, 'pct'=>round($statRefund/$total*100), 'color'=>'#3b82f6'],
                        ];
                        @endphp
                        @foreach($ringkasan as $r)
                        <div class="group">
                            <div class="flex justify-between items-center mb-1.5 transition-transform group-hover:translate-x-1">
                                <span class="text-xs font-semibold text-slate-600">{{ $r['label'] }}</span>
                                <span class="text-xs font-bold text-slate-800">{{ $r['val'] }} <span class="font-normal text-slate-400">({{ $r['pct'] }}%)</span></span>
                            </div>
                            <div class="w-full rounded-full h-2 bg-slate-100 overflow-hidden">
                                <div class="h-2 rounded-full transition-all duration-1000 ease-out" style="width:{{ $r['pct'] }}%;background:{{ $r['color'] }}"></div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-center py-6">
                            <p class="text-sm text-slate-400">Belum ada data transaksi</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-5 flex-1 shadow-sm hover:shadow-md transition-shadow">
                    <div class="tk-sora font-bold text-slate-800 text-sm mb-4">Metode Pembayaran</div>
                    <div class="space-y-3">
                        @php
                        $metodes = [
                        ['label'=>'Transfer Bank', 'pct'=>48,'icon'=>'account_balance'],
                        ['label'=>'QRIS', 'pct'=>33,'icon'=>'qr_code_scanner'],
                        ['label'=>'Virtual Account','pct'=>19,'icon'=>'payment'],
                        ];
                        @endphp
                        @foreach($metodes as $m)
                        <div class="flex items-center gap-3 group">
                            <div class="w-9 h-9 rounded-lg bg-slate-50 flex items-center justify-center border border-slate-100 transition-transform group-hover:scale-110 group-hover:bg-blue-50 group-hover:text-blue-600">
                                <span class="material-symbols-outlined text-[1.2rem] text-slate-500 group-hover:text-blue-600 transition-colors">{{ $m['icon'] }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between text-xs mb-1.5 transition-transform group-hover:translate-x-1">
                                    <span class="text-slate-600 font-medium">{{ $m['label'] }}</span>
                                    <span class="text-slate-800 font-bold">{{ $m['pct'] }}%</span>
                                </div>
                                <div class="w-full rounded-full h-1.5 bg-slate-100 overflow-hidden">
                                    <div class="h-1.5 rounded-full bg-blue-600 transition-all duration-1000 ease-out" style="width:{{ $m['pct'] }}%;"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ FILTER BAR ══ --}}
        <div class="tk-filter-bar animate-fade-in-up delay-300">
            <div class="flex flex-wrap gap-3 items-center flex-1">
                <div class="tk-search-wrap">
                    <span class="material-symbols-outlined tk-search-icon">search</span>
                    <input type="text" placeholder="Cari nama, ID transaksi, kampanye…" class="tk-input tk-search-input" x-model="cariTeks">
                </div>
                <select class="tk-select" x-model="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="Berhasil">Berhasil</option>
                    <option value="Pending">Pending</option>
                    <option value="Refund">Refund</option>
                    <option value="Gagal">Gagal</option>
                </select>
                <select class="tk-select" x-model="filterPaket">
                    <option value="">Semua Paket</option>
                    <option value="Starter">Starter</option>
                    <option value="Pro">Pro</option>
                    <option value="Business">Business</option>
                </select>
                <select class="tk-select" x-model="filterMetode">
                    <option value="">Semua Metode</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="QRIS">QRIS</option>
                    <option value="Virtual Account">Virtual Account</option>
                </select>
                <select class="tk-select max-w-[120px]" x-model="perPage">
                    <option value="5">5 Data</option>
                    <option value="10">10 Data</option>
                    <option value="20">20 Data</option>
                    <option value="50">50 Data</option>
                    <option value="100">100 Data</option>
                    <option value="1000">Semua</option>
                </select>
                <button class="tk-btn tk-btn-ghost" @click="resetFilter()">Reset</button>
            </div>
        </div>

        {{-- ══ TABEL ══ --}}
        <div class="tk-table-wrap animate-fade-in-up delay-400">
            <table class="tk-table">
                <thead>
                    <tr>
                        <th>
                            <button class="tk-sort-btn" :class="sortCol==='id'?'active':''" @click="setSort('id')">
                                ID Transaksi
                                <span class="material-symbols-outlined tk-sort-icon"
                                      x-text="sortCol!=='id' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="tk-sort-btn" :class="sortCol==='developer'?'active':''" @click="setSort('developer')">
                                Developer
                                <span class="material-symbols-outlined tk-sort-icon"
                                      x-text="sortCol!=='developer' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="tk-sort-btn" :class="sortCol==='kampanye'?'active':''" @click="setSort('kampanye')">
                                Kampanye
                                <span class="material-symbols-outlined tk-sort-icon"
                                      x-text="sortCol!=='kampanye' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="tk-sort-btn" :class="sortCol==='paket'?'active':''" @click="setSort('paket')">
                                Paket
                                <span class="material-symbols-outlined tk-sort-icon"
                                      x-text="sortCol!=='paket' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="tk-sort-btn" :class="sortCol==='jumlah'?'active':''" @click="setSort('jumlah')">
                                Jumlah
                                <span class="material-symbols-outlined tk-sort-icon"
                                      x-text="sortCol!=='jumlah' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="tk-sort-btn" :class="sortCol==='metode'?'active':''" @click="setSort('metode')">
                                Metode
                                <span class="material-symbols-outlined tk-sort-icon"
                                      x-text="sortCol!=='metode' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="tk-sort-btn" :class="sortCol==='status'?'active':''" @click="setSort('status')">
                                Status
                                <span class="material-symbols-outlined tk-sort-icon"
                                      x-text="sortCol!=='status' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="tk-sort-btn" :class="sortCol==='tanggal'?'active':''" @click="setSort('tanggal')">
                                Tanggal
                                <span class="material-symbols-outlined tk-sort-icon"
                                      x-text="sortCol!=='tanggal' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th><span class="tk-sort-btn" style="cursor:default;pointer-events:none">Aksi</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksiList as $idx => $t)
                    @php
                    $statusLower = strtolower($t['status']);
                    $paketLower = strtolower($t['paket']);
                    $jumlahF = 'Rp ' . number_format($t['jumlah'], 0, ',', '.');
                    @endphp
                    <tr data-status="{{ $t['status'] }}" data-paket="{{ $t['paket'] }}" data-metode="{{ $t['metode'] }}" data-nama="{{ strtolower($t['namaUser']) }}" data-id="{{ strtolower($t['id']) }}" data-kampanye="{{ strtolower($t['kampanye']) }}" data-jumlah="{{ $t['jumlah'] ?? 0 }}" data-tanggal="{{ strtotime($t['tanggal'] . ' ' . $t['waktu']) }}" data-item="{{ json_encode($t) }}"
                        x-show="tampilRow($el)"
                        x-transition.opacity.duration.300ms>
                        <td>
                            <div class="tk-mono tk-td-id">{{ $t['id'] }}</div>
                            <div class="tk-td-subid">{{ $t['invoice'] }}</div>
                        </td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="tk-avatar bg-gradient-to-br {{ $t['avatarColor'] }}">{{ $t['inisial'] }}</div>
                                <div class="tk-td-name">{{ $t['namaUser'] }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="tk-td-campaign">{{ $t['kampanye'] }}</div>
                        </td>
                        <td><span class="tk-paket tk-paket-{{ $paketLower }}">{{ $t['paket'] }}</span></td>
                        <td>
                            <div class="tk-mono tk-td-nom">{{ $jumlahF }}</div>
                        </td>
                        <td>
                            <div class="tk-td-metode">{{ $t['metode'] }}</div>
                            @if($t['bank'] !== '-')
                            <div class="tk-td-bank">{{ $t['bank'] }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="tk-badge tk-badge-{{ $statusLower }}">
                                <span class="tk-dot tk-dot-{{ $statusLower }}"></span>
                                {{ $t['status'] }}
                            </span>
                        </td>
                        <td>
                            <div class="tk-td-date">{{ $t['tanggal'] }}</div>
                            <div class="tk-mono tk-td-time">{{ $t['waktu'] }}</div>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <button class="tk-action tk-action-detail" @click="bukaModal($el.closest('tr'))">Detail</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    <tr x-show="totalItems === 0" x-cloak x-transition.opacity>
                        <td colspan="9">
                            <div class="tk-empty">
                                <div class="tk-empty-icon">
                                    <span class="material-symbols-outlined text-[1.8rem]">inbox</span>
                                </div>
                                <div class="font-semibold text-slate-500">Tidak ada transaksi ditemukan</div>
                                <div class="text-sm text-slate-400 mt-1">Coba ubah filter atau kata kunci pencarian</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="tk-pagi" x-show="totalItems > 0" x-cloak>
                <span>Menampilkan <strong class="text-slate-700" x-text="visibleIds.length"></strong> dari <strong class="text-slate-700" x-text="totalItems"></strong> transaksi</span>
                <div class="flex items-center gap-1.5" x-show="totalPages > 1">
                    <button class="tk-pagi-btn" @click="currentPage > 1 ? currentPage-- : null; updatePagi()">‹</button>
                    <template x-for="p in totalPages" :key="p">
                        <button class="tk-pagi-btn" :class="currentPage === p ? 'active' : ''" @click="currentPage = p; updatePagi()" x-text="p"></button>
                    </template>
                    <button class="tk-pagi-btn" @click="currentPage < totalPages ? currentPage++ : null; updatePagi()">›</button>
                </div>
            </div>
        </div>

        {{-- ══ APPROVE CONFIRMATION MODAL ══ --}}
        @if($pendingApproveId)
        <template x-teleport="body">
            <div class="tk-modal-overlay" x-data="{ open: true }" x-show="open" x-cloak
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                @click.self="open = false; $wire.cancelAction()">
                <div class="tk-modal-box"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90 translate-y-8" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                    <div class="tk-modal-header">
                        <h3 class="tk-sora tk-modal-title">
                            <span class="material-symbols-outlined tk-modal-title-icon success">verified</span>
                            Konfirmasi Persetujuan
                        </h3>
                        <button @click="open = false; $wire.cancelAction()" class="tk-btn-icon">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="tk-modal-body">
                        <div class="tk-alert tk-alert-success">
                            <span class="material-symbols-outlined tk-alert-icon success">info</span>
                            <div>
                                <p class="tk-alert-title success">Apakah Anda yakin?</p>
                                <p class="tk-alert-text success">Anda akan mengkonfirmasi pembayaran developer ini. Aksi ini akan membuka kunci paket fitur pada sistem mereka dan tidak dapat dibatalkan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tk-modal-footer">
                        <button class="tk-btn tk-btn-secondary" @click="open = false; $wire.cancelAction()">Batal</button>
                        <button class="tk-btn tk-btn-primary" wire:click="approvePembayaran" wire:loading.attr="disabled" wire:target="approvePembayaran">
                            <span wire:loading.remove wire:target="approvePembayaran">Ya, Konfirmasi</span>
                            <span wire:loading wire:target="approvePembayaran">Memproses...</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>
        @endif

        {{-- ══ REJECT CONFIRMATION MODAL ══ --}}
        @if($pendingRejectId)
        <template x-teleport="body">
            <div class="tk-modal-overlay" x-data="{ open: true }" x-show="open" x-cloak
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                @click.self="open = false; $wire.cancelAction()">
                <div class="tk-modal-box"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90 translate-y-8" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                    <div class="tk-modal-header">
                        <h3 class="tk-sora tk-modal-title">
                            <span class="material-symbols-outlined tk-modal-title-icon danger">warning</span>
                            Konfirmasi Penolakan
                        </h3>
                        <button @click="open = false; $wire.cancelAction()" class="tk-btn-icon">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="tk-modal-body">
                        <div class="tk-alert tk-alert-danger">
                            <span class="material-symbols-outlined tk-alert-icon danger">info</span>
                            <div>
                                <p class="tk-alert-title danger">Apakah Anda yakin?</p>
                                <p class="tk-alert-text danger">Anda akan menolak pembayaran ini. Transaksi akan dibatalkan secara permanen di sistem.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tk-modal-footer">
                        <button class="tk-btn tk-btn-secondary" @click="open = false; $wire.cancelAction()">Batal</button>
                        <button class="tk-btn tk-btn-danger" wire:click="rejectPembayaran" wire:loading.attr="disabled" wire:target="rejectPembayaran">
                            <span wire:loading.remove wire:target="rejectPembayaran">Ya, Tolak</span>
                            <span wire:loading wire:target="rejectPembayaran">Memproses...</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>
        @endif

        {{-- ══ MODAL DETAIL ══ --}}
        <div class="tk-detail-bg" x-show="modalTerbuka" x-cloak style="display:none"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @click.self="tutupModal()" @keydown.escape.window="tutupModal()">
            <div class="tk-detail-panel" x-show="modalTerbuka"
                x-transition:enter="transition cubic-bezier(0.16, 1, 0.3, 1) duration-400" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition cubic-bezier(0.4, 0, 0.2, 1) duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                <div class="tk-detail-header">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="tk-sora font-bold text-slate-900 text-base">Detail Transaksi</div>
                            <div class="text-xs text-slate-400 mt-0.5" x-text="transaksi ? transaksi.id : ''"></div>
                        </div>
                        <button @click="tutupModal()" class="tk-btn-icon">
                            <span class="material-symbols-outlined text-[1.2rem]">close</span>
                        </button>
                    </div>
                </div>

                <template x-if="transaksi">
                    <div class="tk-detail-body">
                        <div class="tk-summary-box">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-[1rem] font-bold text-white bg-white/15" x-text="transaksi.inisial"></div>
                                <div>
                                    <div class="font-bold text-white text-[1rem]" x-text="transaksi.namaUser"></div>
                                    <div class="text-blue-300 text-xs mt-0.5" x-text="transaksi.kampanye"></div>
                                </div>
                            </div>
                            <div class="tk-mono text-white font-bold text-3xl" x-text="'Rp ' + transaksi.jumlah.toLocaleString('id-ID')"></div>
                            <div class="flex items-center gap-2 mt-3">
                                <template x-if="transaksi.status === 'Berhasil'"><span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-500 text-white shadow-sm shadow-green-500/50">✓ Berhasil</span></template>
                                <template x-if="transaksi.status === 'Pending'"><span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-500 text-white shadow-sm shadow-amber-500/50">⏳ Pending</span></template>
                                <template x-if="transaksi.status === 'Refund'"><span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-blue-500 text-white shadow-sm shadow-blue-500/50">↩ Refund</span></template>
                                <template x-if="transaksi.status === 'Gagal'"><span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-red-500 text-white shadow-sm shadow-red-500/50">✗ Gagal</span></template>
                                <span class="text-blue-300 text-[.75rem]" x-text="transaksi.tanggal + ' · ' + transaksi.waktu"></span>
                            </div>
                        </div>

                        <div class="tk-detail-section">Informasi Transaksi</div>
                        <div>
                            <div class="tk-detail-row"><span class="tk-detail-label">ID Transaksi</span><span class="tk-detail-val tk-mono text-xs" x-text="transaksi.id"></span></div>
                            <div class="tk-detail-row"><span class="tk-detail-label">No. Invoice</span><span class="tk-detail-val tk-mono text-xs" x-text="transaksi.invoice"></span></div>
                            <div class="tk-detail-row"><span class="tk-detail-label">Tanggal</span><span class="tk-detail-val" x-text="transaksi.tanggal + ' · ' + transaksi.waktu"></span></div>
                            <div class="tk-detail-row"><span class="tk-detail-label">Metode</span><span class="tk-detail-val" x-text="transaksi.metode + (transaksi.bank !== '-' ? ' · ' + transaksi.bank : '')"></span></div>
                            <div class="tk-detail-row"><span class="tk-detail-label">Status</span><span class="tk-detail-val" x-text="transaksi.status"></span></div>
                        </div>

                        <div class="tk-detail-section">Paket &amp; Kampanye</div>
                        <div>
                            <div class="tk-detail-row"><span class="tk-detail-label">Developer</span><span class="tk-detail-val" x-text="transaksi.namaUser"></span></div>
                            <div class="tk-detail-row"><span class="tk-detail-label">Kampanye</span><span class="tk-detail-val max-w-[200px] text-right" x-text="transaksi.kampanye"></span></div>
                            <div class="tk-detail-row"><span class="tk-detail-label">Paket</span><span class="tk-detail-val" x-text="transaksi.paket"></span></div>
                        </div>

                        <div class="tk-detail-section">Rincian Pembayaran</div>
                        <div>
                            <div class="tk-detail-row"><span class="tk-detail-label">Harga Paket</span><span class="tk-detail-val tk-mono text-xs" x-text="'Rp ' + transaksi.jumlah.toLocaleString('id-ID')"></span></div>
                            <div class="tk-detail-row"><span class="tk-detail-label">Biaya Layanan</span><span class="tk-detail-val tk-mono text-xs">Rp 0</span></div>
                            <div class="tk-detail-row bg-slate-50 -mx-1 px-1 py-3 rounded-lg mt-2">
                                <span class="tk-detail-label font-bold text-slate-800">Total Dibayar</span>
                                <span class="tk-detail-val tk-mono font-bold text-blue-700 text-[.95rem]" x-text="'Rp ' + transaksi.jumlah.toLocaleString('id-ID')"></span>
                            </div>
                        </div>

                    </div>
                </template>

                <div class="tk-detail-footer">
                    <template x-if="transaksi && transaksi.status === 'Pending'">
                        <div class="flex gap-2 w-full">
                            <button class="tk-btn flex-1 tk-btn-primary" @click="$wire.confirmApprove(transaksi.db_id); tutupModal()">✓ Konfirmasi</button>
                            <button class="tk-btn flex-1 tk-btn-ghost-danger" @click="$wire.confirmReject(transaksi.db_id); tutupModal()">✗ Tolak</button>
                        </div>
                    </template>
                    <template x-if="transaksi && transaksi.status === 'Berhasil'">
                        <div class="flex gap-2 w-full">
                            <button class="tk-btn flex-1 tk-btn-ghost">📄 Unduh Invoice</button>
                            <button class="tk-btn flex-1 bg-amber-50 text-amber-600 border border-amber-200 hover:bg-amber-100 transition-colors">↩ Proses Refund</button>
                        </div>
                    </template>
                    <template x-if="transaksi && transaksi.status === 'Refund'">
                        <button class="tk-btn w-full tk-btn-ghost">📄 Lihat Bukti Refund</button>
                    </template>
                    <template x-if="transaksi && transaksi.status === 'Gagal'">
                        <button class="tk-btn w-full tk-btn-ghost">🔄 Cek Status Payment</button>
                    </template>
                </div>

            </div>
        </div>

    </div>{{-- end x-data --}}

    @push('scripts')
    <script>
        function transaksiKeuangan() {
            return {
                cariTeks: '',
                filterStatus: '',
                filterPaket: '',
                filterMetode: '',
                perPage: 10,
                currentPage: 1,
                totalItems: 0,
                totalPages: 1,
                visibleIds: [],
                sortCol: 'tanggal',
                sortDir: 'desc',
                modalTerbuka: false,
                transaksi: null,
                
                init() {
                    this.updatePagi();
                    this.$watch('cariTeks', () => this.resetPagi());
                    this.$watch('filterStatus', () => this.resetPagi());
                    this.$watch('filterPaket', () => this.resetPagi());
                    this.$watch('filterMetode', () => this.resetPagi());
                    this.$watch('perPage', () => this.resetPagi());
                    this.$watch('sortCol', () => this.resetPagi());
                    this.$watch('sortDir', () => this.resetPagi());
                },

                initChart() {
                    this.$nextTick(() => {
                        document.querySelectorAll('.tk-chart-bar').forEach(bar => {
                            const target = parseInt(bar.dataset.target || 0);
                            bar.style.height = '0px';
                            setTimeout(() => {
                                bar.style.height = target + 'px';
                            }, 400); // Sedikit ditunda  
                        });
                    });
                },

                resetPagi() {
                    this.currentPage = 1;
                    this.$nextTick(() => this.updatePagi());
                },

                setSort(col) {
                    if (this.sortCol === col) { this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc'; }
                    else { this.sortCol = col; this.sortDir = 'asc'; }
                },

                updatePagi() {
                    const tbody = document.querySelector('.tk-table tbody');
                    if (!tbody) return;
                    const rows = Array.from(tbody.querySelectorAll('tr[data-status]'));

                    rows.sort((a, b) => {
                        let va, vb;
                        if (this.sortCol === 'id') { va = (a.dataset.id || ''); vb = (b.dataset.id || ''); }
                        else if (this.sortCol === 'developer') { va = (a.dataset.nama || ''); vb = (b.dataset.nama || ''); }
                        else if (this.sortCol === 'kampanye') { va = (a.dataset.kampanye || ''); vb = (b.dataset.kampanye || ''); }
                        else if (this.sortCol === 'paket') { va = (a.dataset.paket || '').toLowerCase(); vb = (b.dataset.paket || '').toLowerCase(); }
                        else if (this.sortCol === 'jumlah') { va = +(a.dataset.jumlah || 0); vb = +(b.dataset.jumlah || 0); }
                        else if (this.sortCol === 'metode') { va = (a.dataset.metode || '').toLowerCase(); vb = (b.dataset.metode || '').toLowerCase(); }
                        else if (this.sortCol === 'status') { va = (a.dataset.status || '').toLowerCase(); vb = (b.dataset.status || '').toLowerCase(); }
                        else if (this.sortCol === 'tanggal') { va = +(a.dataset.tanggal || 0); vb = +(b.dataset.tanggal || 0); }
                        else return 0;
                        return va < vb ? (this.sortDir==='asc'?-1:1) : (va > vb ? (this.sortDir==='asc'?1:-1) : 0);
                    });
                    
                    rows.forEach(r => tbody.appendChild(r));
                    const emptyRow = tbody.querySelector('tr[x-show="totalItems === 0"]');
                    if (emptyRow) tbody.appendChild(emptyRow);

                    const matching = rows.filter(r => this.cocokFilter(r));
                    this.totalItems = matching.length;
                    this.totalPages = Math.ceil(this.totalItems / this.perPage) || 1;
                    if (this.currentPage > this.totalPages && this.totalPages > 0) this.currentPage = this.totalPages;
                    else if (this.currentPage < 1 && this.totalPages > 0) this.currentPage = 1;

                    const start = (this.currentPage - 1) * parseInt(this.perPage);
                    const end = start + parseInt(this.perPage);

                    this.visibleIds = matching.slice(start, end).map(r => r.dataset.id);
                },

                cocokFilter(el) {
                    const status = el.dataset.status || '';
                    const paket = el.dataset.paket || '';
                    const metode = el.dataset.metode || '';
                    const nama = el.dataset.nama || '';
                    const id = el.dataset.id || '';
                    const kampanye = el.dataset.kampanye || '';
                    const q = this.cariTeks.toLowerCase().trim();

                    if (this.filterStatus && status !== this.filterStatus) return false;
                    if (this.filterPaket && paket !== this.filterPaket) return false;
                    if (this.filterMetode && metode !== this.filterMetode) return false;
                    if (q && !nama.includes(q) && !id.includes(q) && !kampanye.includes(q)) return false;

                    return true;
                },

                tampilRow(el) {
                    return this.visibleIds.includes(el.dataset.id);
                },

                bukaModal(el) {
                    this.transaksi = JSON.parse(el.dataset.item);
                    this.modalTerbuka = true;
                },

                tutupModal() {
                    this.modalTerbuka = false;
                    setTimeout(() => {
                        this.transaksi = null;
                    }, 300);
                },

                resetFilter() {
                    this.cariTeks = '';
                    this.filterStatus = '';
                    this.filterPaket = '';
                    this.filterMetode = '';
                    this.perPage = 10;
                    this.sortCol = 'tanggal';
                    this.sortDir = 'desc';
                }
            };
        }
    </script>
    @endpush

</x-filament-panels::page>