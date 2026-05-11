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

        .mw-sora {
            font-family: 'Sora', sans-serif !important;
        }

        .mw-mono {
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
        .mw-stat {
            background: #fff;
            border-radius: 14px;
            padding: 18px 20px;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .mw-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
        }

        .mw-stat::after {
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

        .mw-stat:hover::after {
            left: 125%;
        }

        .mw-stat-accent {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .mw-stat-icon {
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

        .mw-stat:hover .mw-stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .mw-stat-label {
            font-size: .72rem;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .mw-stat-value {
            font-size: 1.4rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.1;
        }

        .mw-stat-sub {
            font-size: .72rem;
            color: #94a3b8;
            margin-top: 2px;
        }

        /* Stat Colors */
        .mw-grad-green {
            background: linear-gradient(90deg, #22c55e, #86efac);
        }

        .mw-grad-emerald {
            background: linear-gradient(90deg, #10b981, #34d399);
        }

        .mw-grad-orange {
            background: linear-gradient(90deg, #f59e0b, #fcd34d);
        }

        .mw-grad-red {
            background: linear-gradient(90deg, #ef4444, #fca5a5);
        }

        .mw-bg-green {
            background: #dcfce7;
            color: #16a34a;
        }

        .mw-bg-emerald {
            background: #d1fae5;
            color: #10b981;
        }

        .mw-bg-orange {
            background: #fef9c3;
            color: #f59e0b;
        }

        .mw-bg-red {
            background: #fee2e2;
            color: #dc2626;
        }

        /* ══ CHART ══ */
        .mw-chart-bar-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            gap: 4px
        }

        .mw-chart-bar-outer {
            width: 100%;
            height: 120px;
            display: flex;
            align-items: flex-end;
            justify-content: center
        }

        .mw-chart-bar {
            width: 80%;
            border-radius: 6px 6px 0 0;
            background: linear-gradient(to top, #16a34a, #86efac);
            height: 0;
            transition: height 1.2s cubic-bezier(.4, 0, .2, 1), opacity 0.2s, box-shadow 0.2s;
            position: relative;
            cursor: pointer
        }

        .mw-chart-bar:hover {
            opacity: 1;
            box-shadow: 0 0 12px rgba(34, 197, 94, 0.6);
            transform: scaleY(1.02);
            transform-origin: bottom;
        }

        .mw-chart-bar-tooltip {
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
            transition: all .2s cubic-bezier(0.16, 1, 0.3, 1)
        }

        .mw-chart-bar:hover .mw-chart-bar-tooltip {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .mw-chart-label {
            font-size: .7rem;
            color: #94a3b8;
            font-weight: 500
        }

        .mw-chart-active .mw-chart-bar {
            background: linear-gradient(to top, #f59e0b, #fcd34d) !important
        }

        .mw-chart-active .mw-chart-bar:hover {
            box-shadow: 0 0 12px rgba(245, 158, 11, 0.6) !important;
        }

        /* ══ FILTER & SEARCH BAR ══ */
        .mw-filter-bar {
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

        .mw-filter-bar:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .mw-search-wrap {
            position: relative;
            flex: 2;
            min-width: 320px;
        }

        .mw-search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.2rem;
            transition: color 0.2s;
        }

        .mw-search-wrap:focus-within .mw-search-icon {
            color: #2563eb;
        }

        .mw-search-input {
            width: 100%;
            padding-left: 42px !important;
        }

        .mw-input,
        .mw-select {
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

        .mw-input:focus,
        .mw-select:focus {
            border-color: #2563eb;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .mw-btn {
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

        .mw-btn:active {
            transform: scale(0.95);
        }

        .mw-btn-primary {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: #fff;
        }

        .mw-btn-primary:hover {
            box-shadow: 0 6px 16px rgba(34, 197, 94, 0.35);
            transform: translateY(-1px);
        }

        .mw-btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
        }

        .mw-btn-danger:hover {
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
            transform: translateY(-1px);
        }

        .mw-btn-secondary {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .mw-btn-secondary:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .mw-btn-ghost {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .mw-btn-ghost:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .mw-btn-ghost-danger {
            color: #b91c1c;
            border: 1px solid #fecaca;
            background: #fef2f2;
        }

        .mw-btn-ghost-danger:hover {
            background: #fee2e2;
        }

        .mw-btn-export {
            background: #f0fdf4;
            color: #10b981;
            border: 1px solid #10b981;
        }

        .mw-btn-export:hover {
            background: #dcfce7;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
        }

        .mw-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .mw-btn-icon {
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

        .mw-btn-icon:hover {
            background: #e2e8f0;
            color: #0f172a;
            transform: scale(1.05);
        }

        .mw-btn-icon:active {
            transform: scale(0.95);
        }

        /* ══ SORT HEADER BUTTON ══ */
        .mw-sort-btn { display: inline-flex; align-items: center; gap: 3px; background: none; border: none; cursor: pointer; font-size: .75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .07em; padding: 0; transition: color 0.2s; font-family: 'Inter', sans-serif; white-space: nowrap; }
        .mw-sort-btn:hover  { color: #2563eb; }
        .mw-sort-btn.active { color: #2563eb; }
        .mw-sort-icon { font-size: .95rem !important; line-height: 1; }

        /* ══ TABLE ══ */
        .mw-table-wrap {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .mw-table {
            width: 100%;
            border-collapse: collapse;
        }

        .mw-table thead tr {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .mw-table th {
            padding: 12px 16px;
            font-size: .75rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .07em;
            text-align: left;
            white-space: nowrap;
        }

        .mw-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            transition: background 0.2s;
        }

        .mw-table tbody tr {
            transition: all .2s;
        }

        .mw-table tbody tr td:first-child {
            border-left: 3px solid transparent;
            transition: border-color 0.2s;
        }

        .mw-table tbody tr:hover {
            background: #f8fafc;
        }

        .mw-table tbody tr:hover td:first-child {
            border-left-color: #22c55e;
        }

        .mw-table tbody tr:last-child td {
            border-bottom: none;
        }

        .mw-avatar {
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

        .mw-table tbody tr:hover .mw-avatar {
            transform: scale(1.05) rotate(-5deg);
        }

        /* Table Text Utilities */
        .mw-td-id {
            font-size: .75rem;
            color: #334155;
            font-weight: 600;
        }

        .mw-td-name {
            font-size: .85rem;
            color: #1e293b;
            font-weight: 600;
        }

        .mw-td-point {
            font-size: .85rem;
            color: #ef4444;
            font-weight: 700;
        }

        .mw-td-nom {
            font-size: .88rem;
            color: #0f172a;
            font-weight: 700;
        }

        .mw-td-metode {
            font-size: .82rem;
            color: #475569;
        }

        .mw-td-akun {
            font-size: .8rem;
            color: #475569;
        }

        .mw-td-date {
            font-size: .82rem;
            color: #334155;
        }

        .mw-td-time {
            font-size: .72rem;
            color: #94a3b8;
        }

        /* ══ BADGES & ACTIONS ══ */
        .mw-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .mw-badge-pending {
            background: #fef9c3;
            color: #a16207;
        }

        .mw-badge-success {
            background: #dcfce7;
            color: #15803d;
        }

        .mw-badge-rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        .mw-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .mw-dot-pending {
            background: #eab308;
            animation: pulse 2s infinite;
        }

        .mw-dot-success {
            background: #22c55e;
        }

        .mw-dot-rejected {
            background: #ef4444;
        }

        @keyframes pulse {
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

        .mw-action {
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

        .mw-action-detail {
            background: #eff6ff;
            color: #2563eb;
        }

        .mw-action-detail:hover {
            background: #dbeafe;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.15);
        }

        .mw-action-detail:active {
            transform: scale(0.95);
        }

        /* ══ PAGINATION ══ */
        .mw-pagi {
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

        .mw-pagi-btn {
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

        .mw-pagi-btn:hover {
            background: #eff6ff;
            border-color: #2563eb;
            color: #2563eb;
            transform: translateY(-1px);
        }

        .mw-pagi-btn:active {
            transform: scale(0.9);
        }

        .mw-pagi-btn.active {
            background: #2563eb;
            border-color: #2563eb;
            color: #fff;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
        }

        /* ══ UPLOAD AREA ══ */
        .mw-upload-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .88rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 10px;
        }

        .mw-upload-preview {
            margin-bottom: 12px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .mw-upload-preview img {
            width: 100%;
            display: block;
            max-height: 300px;
            object-fit: contain;
        }

        .mw-upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            position: relative;
        }

        .mw-upload-area:hover {
            border-color: #2563eb;
            background: #eff6ff;
        }

        .mw-upload-area.has-file {
            border-color: #22c55e;
            background: #f0fdf4;
        }

        .mw-upload-input {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
        }

        /* ══ EMPTY STATE ══ */
        .mw-empty {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .mw-empty-icon {
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

        .mw-empty:hover .mw-empty-icon {
            transform: scale(1.1) rotate(5deg);
        }

        /* ══ MODAL & SLIDE OUT ══ */
        .mw-modal-overlay {
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

        .mw-modal-box {
            background: #fff;
            border-radius: 20px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .mw-modal-header {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .mw-modal-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mw-modal-title-icon {
            font-size: 1.3rem;
            padding: 6px;
            border-radius: 8px;
        }

        .mw-modal-title-icon.success {
            color: #10b981;
            background: #ecfdf5;
        }

        .mw-modal-title-icon.danger {
            color: #ef4444;
            background: #fef2f2;
        }

        .mw-modal-body {
            padding: 24px;
        }

        .mw-modal-footer {
            padding: 18px 24px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            background: #f8fafc;
        }

        .mw-alert {
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .mw-alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        .mw-alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .mw-alert-icon {
            font-size: 1.4rem;
            margin-top: 2px;
        }

        .mw-alert-icon.success {
            color: #10b981;
        }

        .mw-alert-icon.danger {
            color: #ef4444;
        }

        .mw-alert-title {
            font-size: .9rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .mw-alert-title.success {
            color: #065f46;
        }

        .mw-alert-title.danger {
            color: #991b1b;
        }

        .mw-alert-text {
            font-size: .85rem;
            line-height: 1.5;
            opacity: .9;
        }

        .mw-alert-text.success {
            color: #064e3b;
        }

        .mw-alert-text.danger {
            color: #7f1d1d;
        }

        .mw-detail-bg {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .55);
            backdrop-filter: blur(6px);
            z-index: 9998;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
        }

        .mw-detail-panel {
            width: 420px;
            max-width: 95vw;
            height: 100vh;
            background: #fff;
            overflow-y: auto;
            box-shadow: -15px 0 50px rgba(0, 0, 0, .2);
        }

        .mw-detail-header {
            padding: 22px 24px 18px;
            border-bottom: 1px solid #e2e8f0;
            background: rgba(248, 250, 252, 0.9);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .mw-detail-body {
            padding: 22px 24px;
        }

        .mw-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: .85rem;
            transition: background 0.2s;
        }

        .mw-detail-row:hover {
            background: #f8fafc;
            padding-left: 8px;
            padding-right: 8px;
            margin-left: -8px;
            margin-right: -8px;
            border-radius: 8px;
            border-bottom-color: transparent;
        }

        .mw-detail-row:last-child {
            border-bottom: none;
        }

        .mw-detail-label {
            color: #64748b;
            font-weight: 500;
            flex-shrink: 0;
            margin-right: 16px;
        }

        .mw-detail-val {
            color: #0f172a;
            font-weight: 600;
            text-align: right;
        }

        .mw-detail-section {
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: #94a3b8;
            margin: 18px 0 8px;
        }

        .mw-detail-footer {
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            gap: 10px;
            background: #f8fafc;
            position: sticky;
            bottom: 0;
            z-index: 10;
        }

        .mw-summary-box {
            background: linear-gradient(135deg, #14532d, #0f172a);
            border-radius: 12px;
            padding: 20px;
            color: #fff;
            margin-bottom: 10px;
            box-shadow: 0 10px 25px -5px rgba(20, 83, 45, 0.3);
        }
    </style>
    @endpush

    <div class="space-y-5" x-data="withdrawAdmin()" x-init="initChart()">

        {{-- ══ HEADER ══ --}}
        <div class="flex items-center justify-between animate-fade-in-up">
            <div>
                <h1 class="mw-sora text-xl font-bold text-slate-900">Manajemen Penarikan Tester</h1>
                <p class="text-sm text-slate-500 mt-0.5">Kelola permintaan pencairan poin dari tester</p>
            </div>
            <button wire:click="exportCsv" class="mw-btn mw-btn-export">
                <span class="material-symbols-outlined">download</span>
                Export CSV
            </button>
        </div>

        {{-- ══ STAT CARDS ══ --}}
        <!-- Ubah xl:grid-cols-5 menjadi xl:grid-cols-6 -->
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4 animate-fade-in-up delay-100">
            <div class="mw-stat xl:col-span-2">
                <div class="mw-stat-accent mw-grad-green"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="mw-stat-icon mw-bg-green">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="mw-stat-label">Total Dicairkan</div>
                        <div class="mw-stat-value mw-mono">{{ $totalRupiahSuccess }}</div>
                    </div>
                </div>
            </div>

            <!-- Tambahkan xl:col-span-2 di sini -->
            <div class="mw-stat xl:col-span-2">
                <div class="mw-stat-accent mw-grad-emerald"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="mw-stat-icon mw-bg-emerald">
                        <span class="material-symbols-outlined">calendar_month</span>
                    </div>
                    <div>
                        <div class="mw-stat-label">Bulan Ini</div>
                        <div class="mw-stat-value mw-mono text-[1.1rem]">{{ $rupiahBulanIni }}</div>
                    </div>
                </div>
            </div>

            <div class="mw-stat">
                <div class="mw-stat-accent mw-grad-orange"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="mw-stat-icon mw-bg-orange">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <div>
                        <div class="mw-stat-label">Pending</div>
                        <div class="mw-stat-value text-[#d97706]">{{ $totalPending }}</div>
                        <div class="mw-stat-sub">menunggu review</div>
                    </div>
                </div>
            </div>

            <div class="mw-stat">
                <div class="mw-stat-accent mw-grad-red"></div>
                <div class="flex items-start gap-3 mt-1">
                    <div class="mw-stat-icon mw-bg-red">
                        <span class="material-symbols-outlined">cancel</span>
                    </div>
                    <div>
                        <div class="mw-stat-label">Ditolak</div>
                        <div class="mw-stat-value text-[#dc2626]">{{ $totalRejected }}</div>
                        <div class="mw-stat-sub">transaksi</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ CHART + RINGKASAN ══ --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 animate-fade-in-up delay-200">
            <div class="xl:col-span-2 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <div class="mw-sora font-bold text-slate-900 text-base">Pencairan 6 Bulan Terakhir</div>
                        <div class="text-xs text-slate-400 mt-0.5">Total withdraw yang berhasil dicairkan</div>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <span class="inline-block w-3 h-3 rounded-sm mw-grad-green"></span> Pencairan
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
                    <div class="mw-chart-bar-wrap">
                        <div class="mw-chart-bar-outer">
                            <div class="mw-chart-bar {{ $isLast ? 'mw-chart-active' : '' }}" data-target="{{ $pct }}">
                                <div class="mw-chart-bar-tooltip">{{ $valF }}</div>
                            </div>
                        </div>
                        <div class="mw-chart-label">{{ $bulan }}</div>
                        <div class="mw-mono text-slate-500 text-[0.62rem]">{{ number_format($val/1000000,1) }}jt</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <div class="bg-white border border-slate-200 rounded-2xl p-5 flex-1 shadow-sm hover:shadow-md transition-shadow">
                    <div class="mw-sora font-bold text-slate-800 text-sm mb-4">Ringkasan Status</div>
                    <div class="space-y-4">
                        @php $total = $totalSuccess + $totalPending + $totalRejected; @endphp
                        @if($total > 0)
                        @php $ringkasan = [
                        ['label'=>'Berhasil','val'=>$totalSuccess,'pct'=>round($totalSuccess/$total*100),'color'=>'#22c55e'],
                        ['label'=>'Pending','val'=>$totalPending,'pct'=>round($totalPending/$total*100),'color'=>'#f59e0b'],
                        ['label'=>'Ditolak','val'=>$totalRejected,'pct'=>round($totalRejected/$total*100),'color'=>'#ef4444'],
                        ]; @endphp
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
                            <p class="text-sm text-slate-400">Belum ada data</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-5 flex-1 shadow-sm hover:shadow-md transition-shadow">
                    <div class="mw-sora font-bold text-slate-800 text-sm mb-4">Metode Populer</div>
                    <div class="space-y-3">
                        @forelse($metodeBreakdown as $m)
                        <div class="flex items-center gap-3 group">
                            @php
                                $mLabel = strtolower($m['label']);
                                $logoUrl = null;
                                if ($mLabel === 'gopay') $logoUrl = 'https://commons.wikimedia.org/wiki/Special:FilePath/Gopay_logo.svg';
                                elseif ($mLabel === 'dana') $logoUrl = 'https://commons.wikimedia.org/wiki/Special:FilePath/Logo_dana_blue.svg';
                                elseif ($mLabel === 'shopeepay') $logoUrl = 'https://commons.wikimedia.org/wiki/Special:FilePath/Shopee.svg';
                                elseif ($mLabel === 'ovo') $logoUrl = 'https://commons.wikimedia.org/wiki/Special:FilePath/Logo_ovo_purple.svg';
                                elseif ($mLabel === 'bca') $logoUrl = 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Central_Asia.svg';
                                elseif ($mLabel === 'mandiri') $logoUrl = 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Mandiri_logo_2016.svg';
                                elseif ($mLabel === 'bni') $logoUrl = 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Negara_Indonesia_logo_(2004).svg';
                                elseif ($mLabel === 'bri') $logoUrl = 'https://commons.wikimedia.org/wiki/Special:FilePath/BRI_2020.svg';
                                elseif ($mLabel === 'bsi') $logoUrl = 'https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Syariah_Indonesia.svg';
                            @endphp
                            <div class="w-9 h-9 rounded-lg bg-slate-50 flex items-center justify-center border border-slate-100 transition-transform group-hover:scale-110 p-1">
                                @if($logoUrl)
                                    <img src="{{ $logoUrl }}" alt="{{ $m['label'] }}" class="w-full h-full object-contain" />
                                @else
                                    <span class="material-symbols-outlined text-[1.2rem] text-slate-500 group-hover:text-green-600 transition-colors">account_balance_wallet</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between text-xs mb-1.5 transition-transform group-hover:translate-x-1">
                                    <span class="text-slate-600 font-medium">{{ $m['label'] }}</span>
                                    <span class="text-slate-800 font-bold">{{ $m['pct'] }}%</span>
                                </div>
                                <div class="w-full rounded-full h-1.5 bg-slate-100 overflow-hidden">
                                    <div class="h-1.5 rounded-full bg-green-500 transition-all duration-1000 ease-out" style="width:{{ $m['pct'] }}%;"></div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <p class="text-sm text-slate-400">Belum ada data</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ FILTER BAR ══ --}}
        <div class="mw-filter-bar animate-fade-in-up delay-300">
            <div class="flex flex-wrap gap-3 items-center flex-1">
                <div class="mw-search-wrap">
                    <span class="material-symbols-outlined mw-search-icon">search</span>
                    <input type="text" placeholder="Cari nama tester, ID…" class="mw-input mw-search-input" x-model="cariTeks">
                </div>
                <select class="mw-select" x-model="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="success">Berhasil</option>
                    <option value="rejected">Ditolak</option>
                </select>
                <select class="mw-select" x-model="filterMetode">
                    <option value="">Semua Metode</option>
                    <option value="GoPay">GoPay</option>
                    <option value="DANA">DANA</option>
                    <option value="ShopeePay">ShopeePay</option>
                    <option value="OVO">OVO</option>
                    <option value="BCA">BCA</option>
                    <option value="Mandiri">Mandiri</option>
                    <option value="BNI">BNI</option>
                    <option value="BRI">BRI</option>
                    <option value="BSI">BSI</option>
                </select>
                <select class="mw-select max-w-[120px]" x-model="perPage">
                    <option value="5">5 Data</option>
                    <option value="10">10 Data</option>
                    <option value="20">20 Data</option>
                    <option value="50">50 Data</option>
                    <option value="100">100 Data</option>
                    <option value="1000">Semua</option>
                </select>
                <button class="mw-btn mw-btn-ghost" @click="resetFilter()">Reset</button>
            </div>
        </div>

        {{-- ══ TABLE ══ --}}
        <div class="mw-table-wrap animate-fade-in-up delay-400">
            <table class="mw-table">
                <thead>
                    <tr>
                        <th>
                            <button class="mw-sort-btn" :class="sortCol==='id'?'active':''" @click="setSort('id')">
                                ID Transaksi
                                <span class="material-symbols-outlined mw-sort-icon"
                                      x-text="sortCol!=='id' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="mw-sort-btn" :class="sortCol==='tester'?'active':''" @click="setSort('tester')">
                                Tester
                                <span class="material-symbols-outlined mw-sort-icon"
                                      x-text="sortCol!=='tester' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="mw-sort-btn" :class="sortCol==='point'?'active':''" @click="setSort('point')">
                                Point
                                <span class="material-symbols-outlined mw-sort-icon"
                                      x-text="sortCol!=='point' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="mw-sort-btn" :class="sortCol==='nominal'?'active':''" @click="setSort('nominal')">
                                Nominal
                                <span class="material-symbols-outlined mw-sort-icon"
                                      x-text="sortCol!=='nominal' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="mw-sort-btn" :class="sortCol==='metode'?'active':''" @click="setSort('metode')">
                                Metode
                                <span class="material-symbols-outlined mw-sort-icon"
                                      x-text="sortCol!=='metode' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="mw-sort-btn" :class="sortCol==='akun'?'active':''" @click="setSort('akun')">
                                No. Akun
                                <span class="material-symbols-outlined mw-sort-icon"
                                      x-text="sortCol!=='akun' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="mw-sort-btn" :class="sortCol==='status'?'active':''" @click="setSort('status')">
                                Status
                                <span class="material-symbols-outlined mw-sort-icon"
                                      x-text="sortCol!=='status' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th>
                            <button class="mw-sort-btn" :class="sortCol==='tanggal'?'active':''" @click="setSort('tanggal')">
                                Tanggal
                                <span class="material-symbols-outlined mw-sort-icon"
                                      x-text="sortCol!=='tanggal' ? 'unfold_more' : (sortDir==='asc' ? 'arrow_upward' : 'arrow_downward')"></span>
                            </button>
                        </th>
                        <th><span class="mw-sort-btn" style="cursor:default;pointer-events:none">Aksi</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdrawList as $idx => $w)
                    <tr data-status="{{ $w['status'] }}" data-metode="{{ $w['metode'] }}" data-nama="{{ strtolower($w['namaUser']) }}" data-id="{{ strtolower($w['withdrawId']) }}" data-point="{{ $w['point'] ?? 0 }}" data-akun="{{ strtolower($w['nomorAkun'] ?? '') }}" data-tanggal="{{ strtotime($w['tanggal'] . ' ' . $w['waktu']) }}" data-item="{{ json_encode($w) }}"
                        x-show="tampilRow($el)"
                        x-transition.opacity.duration.300ms>
                        <td>
                            <div class="mw-mono mw-td-id">{{ $w['withdrawId'] }}</div>
                        </td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="mw-avatar bg-gradient-to-br {{ $w['avatarColor'] }}">{{ $w['inisial'] }}</div>
                                <div class="mw-td-name">{{ $w['namaUser'] }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="mw-mono mw-td-point">-{{ number_format($w['point']) }} pts</div>
                        </td>
                        <td>
                            <div class="mw-mono mw-td-nom">{{ $w['rupiahF'] }}</div>
                        </td>
                        <td>
                            <div class="mw-td-metode">{{ $w['metode'] }}</div>
                        </td>
                        <td>
                            <div class="mw-mono mw-td-akun">{{ $w['nomorAkun'] }}</div>
                        </td>
                        <td>
                            <span class="mw-badge mw-badge-{{ $w['status'] }}">
                                <span class="mw-dot mw-dot-{{ $w['status'] }}"></span>
                                {{ ucfirst($w['status']) }}
                            </span>
                        </td>
                        <td>
                            <div class="mw-td-date">{{ $w['tanggal'] }}</div>
                            <div class="mw-mono mw-td-time">{{ $w['waktu'] }}</div>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <button class="mw-action mw-action-detail" @click="bukaDetail($el.closest('tr'))">Detail</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    <tr x-show="totalItems === 0" x-cloak x-transition.opacity>
                        <td colspan="9">
                            <div class="mw-empty">
                                <div class="mw-empty-icon">
                                    <span class="material-symbols-outlined text-[1.8rem]">inbox</span>
                                </div>
                                <div class="font-semibold text-slate-500">Tidak ada penarikan ditemukan</div>
                                <div class="text-sm text-slate-400 mt-1">Coba ubah filter atau kata kunci pencarian</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mw-pagi" x-show="totalItems > 0" x-cloak>
                <span>Menampilkan <strong class="text-slate-700" x-text="visibleIds.length"></strong> dari <strong class="text-slate-700" x-text="totalItems"></strong> penarikan</span>
                <div class="flex items-center gap-1.5" x-show="totalPages > 1">
                    <button class="mw-pagi-btn" @click="currentPage > 1 ? currentPage-- : null; updatePagi()">‹</button>
                    <template x-for="p in totalPages" :key="p">
                        <button class="mw-pagi-btn" :class="currentPage === p ? 'active' : ''" @click="currentPage = p; updatePagi()" x-text="p"></button>
                    </template>
                    <button class="mw-pagi-btn" @click="currentPage < totalPages ? currentPage++ : null; updatePagi()">›</button>
                </div>
            </div>
        </div>

        {{-- ══ APPROVE CONFIRMATION MODAL ══ --}}
        @if($pendingApproveId)
        <template x-teleport="body">
            <div class="mw-modal-overlay" x-data="{ open: true }" x-show="open" x-cloak
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                @click.self="open = false; $wire.cancelAction()">
                <div class="mw-modal-box"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90 translate-y-8" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                    <div class="mw-modal-header">
                        <h3 class="mw-sora mw-modal-title">
                            <span class="material-symbols-outlined mw-modal-title-icon success">verified</span>
                            Konfirmasi Persetujuan
                        </h3>
                        <button @click="open = false; $wire.cancelAction()" class="mw-btn-icon">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="mw-modal-body">
                        <div class="mw-alert mw-alert-success">
                            <span class="material-symbols-outlined mw-alert-icon success">info</span>
                            <div>
                                <p class="mw-alert-title success">Apakah Anda yakin?</p>
                                <p class="mw-alert-text success">Anda akan menyetujui withdrawal <strong>#{{ $pendingApproveId }}</strong>. Aksi ini tidak dapat dibatalkan. Pastikan Anda sudah mentransfer dana ke tester.</p>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="mw-upload-label">
                                <span class="material-symbols-outlined text-[1.1rem]">upload_file</span>
                                Upload Bukti Transfer <span class="text-red-500">*</span>
                            </label>

                            @if($previewUrl)
                            <div class="mw-upload-preview animate-fade-in-up">
                                <img src="{{ $previewUrl }}" alt="Preview Bukti Transfer">
                            </div>
                            @endif

                            <div class="mw-upload-area {{ $previewUrl ? 'has-file' : '' }}">
                                <input type="file" wire:model="buktiTransfer" accept="image/*" class="mw-upload-input">
                                <div wire:loading.remove wire:target="buktiTransfer">
                                    @if($previewUrl)
                                    <div>
                                        <span class="material-symbols-outlined text-[1.5rem] text-green-600">check_circle</span>
                                        <p class="text-[.85rem] text-green-700 mt-1 font-semibold">File berhasil dipilih</p>
                                        <p class="text-[.75rem] text-slate-500 mt-1">Klik atau seret untuk mengganti</p>
                                    </div>
                                    @else
                                    <div>
                                        <span class="material-symbols-outlined text-[2rem] text-slate-400 group-hover:text-blue-500 transition-colors">cloud_upload</span>
                                        <p class="text-[.85rem] text-slate-500 mt-2 font-medium">Klik atau seret gambar bukti transfer</p>
                                        <p class="text-[.75rem] text-slate-400 mt-1">JPG, PNG, max 2MB</p>
                                    </div>
                                    @endif
                                </div>
                                <div wire:loading wire:target="buktiTransfer">
                                    <span class="material-symbols-outlined text-[2rem] text-blue-600 animate-spin">progress_activity</span>
                                    <p class="text-[.85rem] text-blue-600 mt-2 font-medium">Mengupload...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mw-modal-footer">
                        <button class="mw-btn mw-btn-secondary" @click="open = false; $wire.cancelAction()">Batal</button>
                        <button class="mw-btn mw-btn-primary" wire:click="approveWithdraw" wire:loading.attr="disabled" wire:target="approveWithdraw">
                            <span wire:loading.remove wire:target="approveWithdraw">Ya, Setujui</span>
                            <span wire:loading wire:target="approveWithdraw">Memproses...</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>
        @endif

        {{-- ══ REJECT CONFIRMATION MODAL ══ --}}
        @if($pendingRejectId)
        <template x-teleport="body">
            <div class="mw-modal-overlay" x-data="{ open: true }" x-show="open" x-cloak
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                @click.self="open = false; $wire.cancelAction()">
                <div class="mw-modal-box"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90 translate-y-8" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                    <div class="mw-modal-header">
                        <h3 class="mw-sora mw-modal-title">
                            <span class="material-symbols-outlined mw-modal-title-icon danger">warning</span>
                            Konfirmasi Penolakan
                        </h3>
                        <button @click="open = false; $wire.cancelAction()" class="mw-btn-icon">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="mw-modal-body">
                        <div class="mw-alert mw-alert-danger">
                            <span class="material-symbols-outlined mw-alert-icon danger">info</span>
                            <div>
                                <p class="mw-alert-title danger">Apakah Anda yakin?</p>
                                <p class="mw-alert-text danger">Anda akan menolak withdrawal <strong>#{{ $pendingRejectId }}</strong>. Point akan dikembalikan ke saldo tester.</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[.85rem] font-semibold text-slate-700 mb-2">Catatan (opsional)</label>
                            <textarea wire:model="rejectCatatan" rows="3" class="mw-input w-full resize-none" placeholder="Alasan penolakan..."></textarea>
                        </div>
                    </div>
                    <div class="mw-modal-footer">
                        <button class="mw-btn mw-btn-secondary" @click="open = false; $wire.cancelAction()">Batal</button>
                        <button class="mw-btn mw-btn-danger" wire:click="rejectWithdraw" wire:loading.attr="disabled" wire:target="rejectWithdraw">
                            <span wire:loading.remove wire:target="rejectWithdraw">Ya, Tolak</span>
                            <span wire:loading wire:target="rejectWithdraw">Memproses...</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>
        @endif

        {{-- ══ DETAIL SLIDE-OUT MODAL ══ --}}
        <div class="mw-detail-bg" x-show="modalTerbuka" x-cloak style="display:none"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @click.self="tutupDetail()" @keydown.escape.window="tutupDetail()">
            <div class="mw-detail-panel" x-show="modalTerbuka"
                x-transition:enter="transition cubic-bezier(0.16, 1, 0.3, 1) duration-400" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition cubic-bezier(0.4, 0, 0.2, 1) duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                <div class="mw-detail-header">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="mw-sora font-bold text-slate-900 text-base">Detail Withdraw</div>
                            <div class="text-xs text-slate-400 mt-0.5" x-text="detail ? detail.withdrawId : ''"></div>
                        </div>
                        <button @click="tutupDetail()" class="mw-btn-icon">
                            <span class="material-symbols-outlined text-[1.2rem]">close</span>
                        </button>
                    </div>
                </div>
                <template x-if="detail">
                    <div class="mw-detail-body">
                        <div class="mw-summary-box">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-[1rem] font-bold text-white bg-white/15" x-text="detail.inisial"></div>
                                <div>
                                    <div class="font-bold text-white text-[1rem]" x-text="detail.namaUser"></div>
                                    <div class="text-emerald-300 text-xs mt-0.5" x-text="detail.metode + ' · ' + detail.nomorAkun"></div>
                                </div>
                            </div>
                            <div class="mw-mono text-white font-bold text-3xl" x-text="detail.rupiahF"></div>
                            <div class="flex items-center gap-2 mt-3">
                                <template x-if="detail.status === 'success'"><span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-500 text-white shadow-sm shadow-green-500/50">✓ Berhasil</span></template>
                                <template x-if="detail.status === 'pending'"><span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-500 text-white shadow-sm shadow-amber-500/50">⏳ Pending</span></template>
                                <template x-if="detail.status === 'rejected'"><span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-red-500 text-white shadow-sm shadow-red-500/50">✗ Ditolak</span></template>
                                <span class="text-emerald-300 text-[.75rem]" x-text="detail.tanggal + ' · ' + detail.waktu"></span>
                            </div>
                        </div>

                        <div class="mw-detail-section">Informasi Withdraw</div>
                        <div>
                            <div class="mw-detail-row"><span class="mw-detail-label">ID Withdraw</span><span class="mw-detail-val mw-mono text-xs" x-text="detail.withdrawId"></span></div>
                            <div class="mw-detail-row"><span class="mw-detail-label">Tanggal</span><span class="mw-detail-val" x-text="detail.tanggal + ' · ' + detail.waktu"></span></div>
                            <div class="mw-detail-row"><span class="mw-detail-label">Status</span><span class="mw-detail-val" x-text="detail.status === 'success' ? 'Berhasil' : (detail.status === 'pending' ? 'Pending' : 'Ditolak')"></span></div>
                            <div class="mw-detail-row"><span class="mw-detail-label">Diproses oleh</span><span class="mw-detail-val" x-text="detail.adminNama"></span></div>
                        </div>

                        <div class="mw-detail-section">Rincian Pencairan</div>
                        <div>
                            <div class="mw-detail-row"><span class="mw-detail-label">Point Ditukar</span><span class="mw-detail-val mw-mono text-xs text-red-500" x-text="'-' + detail.point.toLocaleString('id-ID') + ' pts'"></span></div>
                            <div class="mw-detail-row"><span class="mw-detail-label">Metode</span><span class="mw-detail-val" x-text="detail.metode"></span></div>
                            <div class="mw-detail-row"><span class="mw-detail-label">No. Akun</span><span class="mw-detail-val mw-mono text-xs" x-text="detail.nomorAkun"></span></div>
                            <div class="mw-detail-row bg-slate-50 -mx-1 px-1 py-3 rounded-lg mt-2">
                                <span class="mw-detail-label font-bold text-slate-800">Total Dicairkan</span>
                                <span class="mw-detail-val mw-mono font-bold text-emerald-700 text-[.95rem]" x-text="detail.rupiahF"></span>
                            </div>
                        </div>

                        <template x-if="detail.catatan">
                            <div>
                                <div class="mw-detail-section">Catatan Admin</div>
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-[.85rem] text-slate-700 leading-relaxed" x-text="detail.catatan"></div>
                            </div>
                        </template>

                        <template x-if="detail.image">
                            <div>
                                <div class="mw-detail-section">Bukti Transfer</div>
                                <div class="mw-upload-preview">
                                    <img :src="detail.image" alt="Bukti Transfer" class="transition-transform duration-300 hover:scale-105">
                                </div>
                            </div>
                        </template>

                        <template x-if="detail.updatedAt && detail.updatedAt !== '-'">
                            <div class="mt-4 text-[.75rem] text-slate-400 text-center">
                                Terakhir diperbarui: <span x-text="detail.updatedAt"></span>
                            </div>
                        </template>
                    </div>
                </template>
                <div class="mw-detail-footer">
                    <template x-if="detail && detail.status === 'pending'">
                        <div class="flex gap-2 w-full">
                            <button class="mw-btn flex-1 mw-btn-primary" @click="$wire.confirmApprove(detail.id); tutupDetail()">✓ Setujui</button>
                            <button class="mw-btn flex-1 mw-btn-ghost-danger" @click="$wire.confirmReject(detail.id); tutupDetail()">✗ Tolak</button>
                        </div>
                    </template>
                    <template x-if="detail && detail.status === 'success' && detail.image">
                        <a :href="detail.image" target="_blank" class="mw-btn mw-btn-ghost w-full block text-center">📄 Lihat Bukti Transfer</a>
                    </template>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        function withdrawAdmin() {
            return {
                cariTeks: '',
                filterStatus: '',
                filterMetode: '',
                perPage: 10,
                currentPage: 1,
                totalItems: 0,
                totalPages: 1,
                visibleIds: [],
                sortCol: 'tanggal',
                sortDir: 'desc',
                modalTerbuka: false,
                detail: null,

                init() {
                    this.updatePagi();
                    this.$watch('cariTeks', () => this.resetPagi());
                    this.$watch('filterStatus', () => this.resetPagi());
                    this.$watch('filterMetode', () => this.resetPagi());
                    this.$watch('perPage', () => this.resetPagi());
                    this.$watch('sortCol', () => this.resetPagi());
                    this.$watch('sortDir', () => this.resetPagi());
                },

                initChart() {
                    this.$nextTick(() => {
                        document.querySelectorAll('.mw-chart-bar').forEach(bar => {
                            const target = parseInt(bar.dataset.target || 0);
                            bar.style.height = '0px';
                            setTimeout(() => {
                                bar.style.height = target + 'px';
                            }, 400); // Sedikit menunda agar tidak bersamaan dengan fade in
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
                    const tbody = document.querySelector('.mw-table tbody');
                    if (!tbody) return;
                    const rows = Array.from(tbody.querySelectorAll('tr[data-status]'));

                    rows.sort((a, b) => {
                        let va, vb;
                        if (this.sortCol === 'id') { va = (a.dataset.id || ''); vb = (b.dataset.id || ''); }
                        else if (this.sortCol === 'tester') { va = (a.dataset.nama || ''); vb = (b.dataset.nama || ''); }
                        else if (this.sortCol === 'point') { va = +(a.dataset.point || 0); vb = +(b.dataset.point || 0); }
                        else if (this.sortCol === 'nominal') { va = +(a.dataset.point || 0); vb = +(b.dataset.point || 0); }
                        else if (this.sortCol === 'metode') { va = (a.dataset.metode || '').toLowerCase(); vb = (b.dataset.metode || '').toLowerCase(); }
                        else if (this.sortCol === 'akun') { va = (a.dataset.akun || '').toLowerCase(); vb = (b.dataset.akun || '').toLowerCase(); }
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
                    const metode = el.dataset.metode || '';
                    const nama = el.dataset.nama || '';
                    const id = el.dataset.id || '';
                    const q = this.cariTeks.toLowerCase().trim();

                    if (this.filterStatus && status !== this.filterStatus) return false;
                    if (this.filterMetode && metode !== this.filterMetode) return false;
                    if (q && !nama.includes(q) && !id.includes(q)) return false;

                    return true;
                },

                tampilRow(el) {
                    return this.visibleIds.includes(el.dataset.id);
                },

                bukaDetail(el) {
                    this.detail = JSON.parse(el.dataset.item);
                    this.modalTerbuka = true;
                },

                tutupDetail() {
                    this.modalTerbuka = false;
                    setTimeout(() => {
                        this.detail = null;
                    }, 300);
                },

                resetFilter() {
                    this.cariTeks = '';
                    this.filterStatus = '';
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