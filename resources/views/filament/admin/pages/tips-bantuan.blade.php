<x-filament-panels::page>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.3.1/dist/driver.css"/>
<style>
  /* ══════════════════════════════════════
     BASE
  ══════════════════════════════════════ */
  .tb-page, .tb-page * { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; }
  .tb-mono { font-family: 'JetBrains Mono', monospace !important; }

  /* ══════════════════════════════════════
     ANIMATIONS
  ══════════════════════════════════════ */
  @keyframes tb-gradient    { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
  @keyframes tb-float       { 0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(20px,-15px) scale(1.08)} }
  @keyframes tb-float-rev   { 0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(-25px,20px) scale(0.92)} }
  @keyframes tb-shimmer     { 0%{transform:translateX(-100%)} 100%{transform:translateX(200%)} }
  @keyframes tb-fade-up     { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
  @keyframes tb-pulse-ring  { 0%{box-shadow:0 0 0 0 rgba(52,211,153,.6)} 70%{box-shadow:0 0 0 10px rgba(52,211,153,0)} 100%{box-shadow:0 0 0 0 rgba(52,211,153,0)} }
  @keyframes tb-bounce-soft { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-4px)} }
  @keyframes tb-spin-slow   { from{transform:rotate(0)} to{transform:rotate(360deg)} }
  @keyframes tb-spin-rev    { from{transform:rotate(360deg)} to{transform:rotate(0)} }

  @keyframes tb-aurora {
    0%   { transform: translate(-10%,-10%) rotate(0deg)   scale(1.1); }
    33%  { transform: translate(8%,-6%)   rotate(120deg) scale(1.25); }
    66%  { transform: translate(-6%,10%)  rotate(240deg) scale(1.15); }
    100% { transform: translate(-10%,-10%) rotate(360deg) scale(1.1); }
  }
  @keyframes tb-conic { to { transform: rotate(360deg); } }
  @keyframes tb-grid-pan {
    0%   { background-position: 0 0, 0 0; }
    100% { background-position: 56px 56px, 56px 56px; }
  }
  @keyframes tb-particle {
    0%   { transform: translateY(0) translateX(0); opacity: 0; }
    10%  { opacity: .9; }
    90%  { opacity: .9; }
    100% { transform: translateY(-220px) translateX(var(--drift,20px)); opacity: 0; }
  }
  @keyframes tb-shoot {
    0%   { transform: translate3d(0,0,0) rotate(18deg); opacity: 0; }
    8%   { opacity: 1; }
    100% { transform: translate3d(620px,200px,0) rotate(18deg); opacity: 0; }
  }
  @keyframes tb-wave {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-50%); }
  }
  @keyframes tb-scan {
    0%   { transform: translateY(-100%); opacity: 0; }
    20%  { opacity: .55; }
    80%  { opacity: .55; }
    100% { transform: translateY(420%); opacity: 0; }
  }
  @keyframes tb-twinkle {
    0%,100% { opacity: .2; transform: scale(1); }
    50%     { opacity: 1;  transform: scale(1.6); }
  }
  @keyframes tb-emoji-float {
    0%,100% { transform: translateY(0) rotate(0deg); }
    50%     { transform: translateY(-6px) rotate(5deg); }
  }

  /* ══════════════════════════════════════
     HERO BANNER
  ══════════════════════════════════════ */
  .tb-hero {
    position: relative;
    background: linear-gradient(135deg,#0a1850 0%,#13297a 25%,#1d4ed8 55%,#2563eb 80%,#3b82f6 100%);
    background-size: 220% 220%;
    animation: tb-gradient 14s ease infinite;
    border-radius: 1.5rem;
    padding: 2rem 2.5rem;
    margin-bottom: 1.5rem;
    overflow: hidden;
    isolation: isolate;
    box-shadow: 0 20px 60px -15px rgba(37,99,235,.5), 0 0 0 1px rgba(255,255,255,.06) inset;
  }

  /* Aurora mesh */
  .tb-aurora {
    position:absolute; inset:-30%;
    background:
      radial-gradient(40% 35% at 20% 30%, rgba(96,165,250,.55), transparent 60%),
      radial-gradient(35% 30% at 80% 20%, rgba(167,139,250,.45), transparent 60%),
      radial-gradient(45% 40% at 60% 80%, rgba(34,211,238,.40), transparent 60%),
      radial-gradient(30% 25% at 15% 85%, rgba(244,114,182,.35), transparent 60%);
    filter: blur(40px);
    animation: tb-aurora 22s ease-in-out infinite;
    mix-blend-mode: screen;
    pointer-events:none;
  }

  /* Rotating conic glows */
  .tb-conic {
    position:absolute; width:520px; height:520px; left:-160px; bottom:-200px;
    background: conic-gradient(from 0deg, rgba(59,130,246,0), rgba(96,165,250,.35), rgba(167,139,250,.25), rgba(34,211,238,.30), rgba(59,130,246,0));
    border-radius:50%;
    filter: blur(30px);
    animation: tb-conic 28s linear infinite;
    opacity:.7; pointer-events:none;
  }
  .tb-conic-2 {
    position:absolute; width:380px; height:380px; right:-120px; top:-140px;
    background: conic-gradient(from 180deg, rgba(244,114,182,0), rgba(244,114,182,.30), rgba(96,165,250,.30), rgba(244,114,182,0));
    border-radius:50%;
    filter: blur(30px);
    animation: tb-spin-rev 34s linear infinite;
    opacity:.6; pointer-events:none;
  }

  .tb-grid-bg {
    position: absolute; inset: 0;
    background-image:
      linear-gradient(rgba(255,255,255,.07) 1px,transparent 1px),
      linear-gradient(90deg,rgba(255,255,255,.07) 1px,transparent 1px);
    background-size: 28px 28px;
    mask-image: radial-gradient(ellipse at top right, black 30%, transparent 70%);
    animation: tb-grid-pan 18s linear infinite;
    pointer-events: none;
  }

  /* Floating particles */
  .tb-particles { position:absolute; inset:0; overflow:hidden; pointer-events:none; }
  .tb-particles span {
    position:absolute; bottom:-10px;
    width:6px; height:6px; border-radius:50%;
    background: radial-gradient(circle, #fff 0%, rgba(255,255,255,.2) 60%, transparent 70%);
    box-shadow: 0 0 12px rgba(255,255,255,.7);
    animation: tb-particle linear infinite;
    opacity:0;
  }

  /* Twinkling stars */
  .tb-stars { position:absolute; inset:0; pointer-events:none; }
  .tb-stars i {
    position:absolute; width:2px; height:2px; border-radius:50%;
    background:#fff; box-shadow:0 0 6px #fff;
    animation: tb-twinkle 3s ease-in-out infinite;
    font-style: normal;
  }

  /* Shooting star */
  .tb-shoot {
    position:absolute; top:18%; left:-20%;
    width:120px; height:2px;
    background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,.9));
    filter: drop-shadow(0 0 6px rgba(147,197,253,.9));
    border-radius:2px;
    animation: tb-shoot 7s ease-in infinite;
    animation-delay: 2s;
    pointer-events:none;
  }
  .tb-shoot.s2 { top:55%; animation-duration: 9s; animation-delay: 5s; opacity:.7; }

  /* Wave bottom */
  .tb-waves {
    position:absolute; left:0; right:0; bottom:0; height:80px;
    overflow:hidden; pointer-events:none; opacity:.35;
    mask-image: linear-gradient(180deg, transparent, #000 60%);
  }
  .tb-waves svg { width:200%; height:100%; display:block; animation: tb-wave 14s linear infinite; }
  .tb-waves.w2 svg { animation-duration: 22s; opacity:.6; }

  /* Scanline sweep */
  .tb-scan {
    position:absolute; left:0; right:0; top:0; height:25%;
    background: linear-gradient(180deg, transparent, rgba(147,197,253,.18), transparent);
    animation: tb-scan 9s ease-in-out infinite;
    pointer-events:none;
  }

  /* Floating blobs */
  .tb-blob     { animation: tb-float 9s ease-in-out infinite; will-change: transform; filter: blur(2px); }
  .tb-blob-rev { animation: tb-float-rev 11s ease-in-out infinite; will-change: transform; filter: blur(2px); }

  .tb-hero-content {
    position: relative;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1.5rem;
  }

  .tb-hero-left {
    display: flex;
    align-items: center;
    gap: 1.25rem;
  }

  .tb-hero-icon-wrap {
    width: 64px; height: 64px;
    border-radius: 1.125rem;
    background: linear-gradient(135deg, rgba(255,255,255,.15), rgba(255,255,255,.05));
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,.2);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 8px 32px rgba(0,0,0,.15);
    transition: transform .3s ease;
  }
  .tb-hero-icon-wrap:hover { transform: rotate(-8deg) scale(1.1); }
  .tb-hero-icon-wrap svg { width: 32px; height: 32px; color: #fff; }

  .tb-hero-label {
    font-size: 11px; font-weight: 700; text-transform: uppercase;
    letter-spacing: .18em; color: #bfdbfe;
    display: flex; align-items: center; gap: 8px;
    margin-bottom: 6px;
  }
  .tb-hero-label span { width: 24px; height: 1px; background: #bfdbfe; }

  .tb-hero-title {
    font-size: 1.875rem; font-weight: 800; color: #fff;
    margin: 0; line-height: 1.1; letter-spacing: -0.02em;
  }

  .tb-hero-sub {
    font-size: .85rem; color: #dbeafe; margin-top: 6px;
    font-weight: 500;
    display: flex; align-items: center; gap: 8px;
  }
  .tb-hero-sub .tb-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: #34d399;
    animation: tb-pulse-ring 2s infinite;
  }

  /* Stat pills in hero */
  .tb-hero-stats {
    display: flex; gap: 12px; flex-wrap: wrap;
    position: relative; z-index: 10;
    margin-top: 1.25rem;
    padding-top: 1.25rem;
    border-top: 1px solid rgba(255,255,255,.15);
  }
  .tb-stat-pill {
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 1rem;
    padding: 10px 20px;
    text-align: center;
    min-width: 100px;
    transition: all .3s cubic-bezier(.4,0,.2,1);
    position: relative;
    overflow: hidden;
  }
  .tb-stat-pill:hover {
    background: rgba(255,255,255,.15);
    transform: translateY(-3px);
    border-color: rgba(255,255,255,.3);
  }
  .tb-stat-pill::after {
    content:''; position:absolute; top:0; left:0; width:40%; height:100%;
    background: linear-gradient(90deg,transparent,rgba(255,255,255,.2),transparent);
    transform: translateX(-100%);
  }
  .tb-stat-pill:hover::after { animation: tb-shimmer 1.2s ease forwards; }
  .tb-stat-val { font-family: 'JetBrains Mono', monospace; font-size: 1.5rem; font-weight: 700; color: #fff; }
  .tb-stat-label { font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: .12em; color: #dbeafe; margin-top: 2px; }

  /* Tour button */
  .tb-btn-tour {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 24px; border-radius: 1rem;
    border: 1px solid rgba(255,255,255,.2);
    background: rgba(255,255,255,.1);
    backdrop-filter: blur(12px);
    color: #fff; font-size: .8125rem; font-weight: 700;
    cursor: pointer; transition: all .3s ease;
    box-shadow: 0 4px 14px rgba(0,0,0,.15);
    position: relative; overflow: hidden;
  }
  .tb-btn-tour:hover {
    background: rgba(255,255,255,.2);
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,.25);
    border-color: rgba(255,255,255,.35);
  }
  .tb-btn-tour::before {
    content:''; position:absolute; inset:0;
    background: linear-gradient(90deg,transparent,rgba(255,255,255,.25),transparent);
    transform: translateX(-100%);
  }
  .tb-btn-tour:hover::before { animation: tb-shimmer .8s ease; }
  .tb-btn-tour svg { width: 18px; height: 18px; }

  /* ══════════════════════════════════════
     TOOLBAR (Search + Tabs)
  ══════════════════════════════════════ */
  .tb-toolbar {
    display: flex; gap: 16px; align-items: center;
    margin-bottom: 20px; flex-wrap: wrap;
  }

  .tb-search-wrap {
    position: relative; flex: 1; min-width: 240px;
  }
  .tb-search-icon {
    position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
    width: 18px; height: 18px; color: #94a3b8; pointer-events: none;
    z-index: 10;
  }
  .tb-search-input {
    width: 100%; padding: 12px 18px 12px 46px;
    border-radius: 1rem;
    border: 1px solid rgba(226,232,240,.6);
    background: rgba(255,255,255,.85);
    backdrop-filter: blur(12px);
    color: #1e293b; font-size: .85rem; font-weight: 500;
    outline: none; transition: all .25s;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
  }
  .tb-search-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37,99,235,.1), 0 4px 16px rgba(37,99,235,.08);
    background: #fff;
  }
  .dark .tb-search-input {
    background: rgba(15,23,42,.6); border-color: rgba(71,85,105,.4); color: #f1f5f9;
  }
  .dark .tb-search-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59,130,246,.12), 0 4px 16px rgba(59,130,246,.08);
    background: rgba(15,23,42,.85);
  }
  .dark .tb-search-input::placeholder { color: #64748b; }

  .tb-tabs { display: flex; gap: 6px; flex-wrap: wrap; }
  .tb-tab {
    padding: 8px 18px; border-radius: 9999px;
    font-size: .75rem; font-weight: 700; cursor: pointer;
    border: 1px solid transparent; transition: all .25s;
    white-space: nowrap;
  }
  .tb-tab--active {
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #fff;
    box-shadow: 0 4px 14px -4px rgba(37,99,235,.4);
  }
  .tb-tab--inactive {
    background: rgba(255,255,255,.85); color: #64748b;
    border-color: rgba(226,232,240,.6);
    backdrop-filter: blur(8px);
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
  }
  .tb-tab--inactive:hover { background: #fff; color: #1e293b; border-color: rgba(37,99,235,.2); }
  .dark .tb-tab--inactive {
    background: rgba(30,41,59,.6); color: #94a3b8; border-color: rgba(71,85,105,.3);
  }
  .dark .tb-tab--inactive:hover { background: rgba(51,65,85,.8); color: #f1f5f9; }

  /* ══════════════════════════════════════
     TIPS GRID
  ══════════════════════════════════════ */
  .tb-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 14px;
  }
  @media (max-width: 480px) {
    .tb-grid { grid-template-columns: 1fr; }
  }

  .tb-card {
    background: rgba(255,255,255,.92);
    border: 1px solid rgba(226,232,240,.5);
    border-radius: 1.125rem;
    cursor: pointer;
    transition: all .3s cubic-bezier(.4,0,.2,1);
    overflow: hidden;
    backdrop-filter: blur(12px);
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    animation: tb-fade-up .5s ease both;
  }
  .tb-card:hover {
    border-color: rgba(37,99,235,.2);
    transform: translateY(-3px);
    box-shadow: 0 12px 40px -12px rgba(37,99,235,.15);
  }
  .tb-card--expanded {
    border-color: rgba(37,99,235,.3) !important;
    box-shadow: 0 16px 48px -12px rgba(37,99,235,.18) !important;
    background: #fff !important;
  }

  .dark .tb-card {
    background: rgba(30,41,59,.55);
    border-color: rgba(71,85,105,.35);
    backdrop-filter: blur(12px);
  }
  .dark .tb-card:hover {
    background: rgba(30,41,59,.75);
    border-color: rgba(59,130,246,.25);
  }
  .dark .tb-card--expanded {
    background: rgba(30,41,59,.9) !important;
    border-color: rgba(59,130,246,.35) !important;
  }

  .tb-card-head {
    display: flex; align-items: center; gap: 14px;
    padding: 18px 22px;
  }
  .tb-card-emoji {
    width: 46px; height: 46px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; flex-shrink: 0;
    transition: transform .3s;
    box-shadow: 0 4px 12px rgba(0,0,0,.06);
  }
  .tb-card:hover .tb-card-emoji {
    animation: tb-emoji-float 1s ease infinite;
  }
  .tb-card-info { flex: 1; min-width: 0; }
  .tb-card-title {
    font-size: .9rem; font-weight: 700; color: #1e293b;
    margin: 0; line-height: 1.3;
  }
  .dark .tb-card-title { color: #f1f5f9; }
  .tb-card-cat {
    font-size: .68rem; font-weight: 700; color: #94a3b8;
    text-transform: uppercase; letter-spacing: .06em;
  }
  .dark .tb-card-cat { color: #64748b; }
  .tb-card-chev {
    width: 20px; height: 20px; color: #94a3b8;
    flex-shrink: 0;
    transition: transform .3s cubic-bezier(.4,0,.2,1);
  }
  .tb-chev-open { transform: rotate(180deg); }

  .tb-card-body {
    padding: 0 22px 22px;
    border-top: 1px solid rgba(226,232,240,.4);
  }
  .dark .tb-card-body { border-top-color: rgba(71,85,105,.3); }
  .tb-card-desc {
    font-size: .85rem; line-height: 1.7; color: #475569;
    padding-top: 16px; margin: 0;
  }
  .dark .tb-card-desc { color: #94a3b8; }

  .tb-steps { margin-top: 16px; display: flex; flex-direction: column; gap: 10px; }
  .tb-step { display: flex; align-items: flex-start; gap: 12px; }
  .tb-step-num {
    width: 26px; height: 26px; border-radius: 50%;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #fff; font-size: .7rem; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 1px;
    box-shadow: 0 2px 8px rgba(37,99,235,.3);
  }
  .tb-step-txt { font-size: .82rem; color: #475569; line-height: 1.6; }
  .dark .tb-step-txt { color: #cbd5e1; }

  /* ══════════════════════════════════════
     QUICK ACCESS GRID
  ══════════════════════════════════════ */
  .tb-quick-section {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
  }
  .tb-quick-title {
    font-size: .8rem; font-weight: 700; color: #94a3b8;
    text-transform: uppercase; letter-spacing: .1em;
    margin-bottom: 14px;
    display: flex; align-items: center; gap: 8px;
  }
  .tb-quick-title::after {
    content: ''; flex: 1; height: 1px;
    background: linear-gradient(90deg, rgba(148,163,184,.3), transparent);
  }
  .dark .tb-quick-title { color: #64748b; }

  .tb-quick-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 10px;
  }
  .tb-quick-card {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 16px;
    background: rgba(255,255,255,.85);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(226,232,240,.5);
    border-radius: 14px;
    text-decoration: none;
    transition: all .25s cubic-bezier(.4,0,.2,1);
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
  }
  .tb-quick-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px -8px rgba(37,99,235,.12);
    border-color: rgba(37,99,235,.2);
  }
  .dark .tb-quick-card {
    background: rgba(30,41,59,.55);
    border-color: rgba(71,85,105,.35);
  }
  .dark .tb-quick-card:hover {
    background: rgba(30,41,59,.75);
    border-color: rgba(59,130,246,.25);
  }
  .tb-quick-icon {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 1rem;
  }
  .tb-quick-label {
    font-size: .8rem; font-weight: 600; color: #334155;
  }
  .dark .tb-quick-label { color: #e2e8f0; }
  .tb-quick-sublabel {
    font-size: .68rem; color: #94a3b8; margin-top: 1px;
  }
  .dark .tb-quick-sublabel { color: #64748b; }

  /* ══════════════════════════════════════
     EMPTY & STATS
  ══════════════════════════════════════ */
  .tb-empty {
    text-align: center; padding: 48px 16px;
    color: #94a3b8; font-size: .9rem;
  }
  .dark .tb-empty { color: #64748b; }

  .tb-stats-bar {
    display: flex; align-items: center; justify-content: center;
    gap: 24px; padding: 20px 0 4px;
    flex-wrap: wrap;
  }
  .tb-stats-item {
    display: flex; align-items: center; gap: 8px;
    font-size: .75rem; color: #94a3b8; font-weight: 500;
  }
  .dark .tb-stats-item { color: #64748b; }
  .tb-stats-num {
    font-family: 'JetBrains Mono', monospace;
    font-size: .85rem; font-weight: 700;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  .dark .tb-stats-num {
    background: linear-gradient(135deg, #60a5fa, #a78bfa);
    -webkit-background-clip: text;
    background-clip: text;
  }

  /* ══════════════════════════════════════
     DRIVER.JS CUSTOM THEME
  ══════════════════════════════════════ */
  .driver-popover.tb-driver-theme {
    background: linear-gradient(135deg, #ffffff, #f8fafc) !important;
    border-radius: 1rem !important;
    padding: 20px 24px !important;
    box-shadow: 0 25px 60px -12px rgba(37,99,235,.3), 0 0 0 1px rgba(37,99,235,.1) !important;
    max-width: 360px !important;
    border: 1px solid rgba(37,99,235,.15) !important;
  }
  .dark .driver-popover.tb-driver-theme {
    background: linear-gradient(135deg, #1e293b, #0f172a) !important;
    border-color: rgba(59,130,246,.25) !important;
    box-shadow: 0 25px 60px -12px rgba(0,0,0,.5), 0 0 0 1px rgba(59,130,246,.15) !important;
  }
  .driver-popover.tb-driver-theme .driver-popover-title {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: 1rem !important;
    font-weight: 800 !important;
    color: #1e293b !important;
    line-height: 1.3 !important;
  }
  .dark .driver-popover.tb-driver-theme .driver-popover-title {
    color: #f1f5f9 !important;
  }
  .driver-popover.tb-driver-theme .driver-popover-description {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: .85rem !important;
    color: #64748b !important;
    line-height: 1.6 !important;
  }
  .dark .driver-popover.tb-driver-theme .driver-popover-description {
    color: #94a3b8 !important;
  }
  .driver-popover.tb-driver-theme .driver-popover-progress-text {
    font-family: 'JetBrains Mono', monospace !important;
    font-size: .7rem !important;
    font-weight: 600 !important;
    color: #94a3b8 !important;
  }
  .driver-popover.tb-driver-theme button.driver-popover-next-btn,
  .driver-popover.tb-driver-theme button.driver-popover-prev-btn {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-weight: 700 !important;
    border-radius: 10px !important;
    padding: 6px 16px !important;
    font-size: .8rem !important;
    transition: all .2s !important;
    border: none !important;
  }
  .driver-popover.tb-driver-theme button.driver-popover-next-btn {
    background: linear-gradient(135deg, #2563eb, #7c3aed) !important;
    color: #fff !important;
    box-shadow: 0 4px 12px rgba(37,99,235,.3) !important;
  }
  .driver-popover.tb-driver-theme button.driver-popover-next-btn:hover {
    box-shadow: 0 6px 20px rgba(37,99,235,.4) !important;
  }
  .driver-popover.tb-driver-theme button.driver-popover-prev-btn {
    background: rgba(241,245,249,.8) !important;
    color: #475569 !important;
    border: 1px solid rgba(226,232,240,.6) !important;
  }
  .dark .driver-popover.tb-driver-theme button.driver-popover-prev-btn {
    background: rgba(30,41,59,.8) !important;
    color: #94a3b8 !important;
    border-color: rgba(71,85,105,.4) !important;
  }
  .driver-popover.tb-driver-theme .driver-popover-close-btn {
    color: #94a3b8 !important;
  }
  .driver-popover.tb-driver-theme .driver-popover-close-btn:hover {
    color: #1e293b !important;
  }
  .dark .driver-popover.tb-driver-theme .driver-popover-close-btn:hover {
    color: #f1f5f9 !important;
  }
  .driver-popover.tb-driver-theme .driver-popover-arrow {
    border: 5px solid #fff !important;
  }
  .dark .driver-popover.tb-driver-theme .driver-popover-arrow {
    border-color: #1e293b !important;
  }

  /* ══════════════════════════════════════
     DRIVER.JS LAYOUT FIX
     Prevent driver.js from adding overflow:hidden
     to Filament layout containers which breaks the UI
  ══════════════════════════════════════ */
  .driver-active .fi-layout,
  .driver-active .fi-main-ctn,
  .driver-active .fi-main,
  .driver-active .fi-sidebar,
  .driver-active .fi-sidebar-nav,
  .driver-active .fi-topbar,
  .driver-active .fi-page,
  .driver-active .fi-body,
  .driver-active .fi-layout > *,
  .driver-active [class*="fi-"] {
    overflow: visible !important;
  }

  /* ══════════════════════════════════════
     RESPONSIVE
  ══════════════════════════════════════ */
  @media (max-width: 640px) {
    .tb-hero { padding: 1.5rem; border-radius: 1.25rem; }
    .tb-hero-content { flex-direction: column; align-items: flex-start; }
    .tb-hero-title { font-size: 1.5rem; }
    .tb-toolbar { flex-direction: column; }
    .tb-quick-grid { grid-template-columns: 1fr 1fr; }
  }

  /* ══════════════════════════════════════
     REDUCED MOTION
  ══════════════════════════════════════ */
  @media (prefers-reduced-motion: reduce) {
    .tb-hero, .tb-blob, .tb-blob-rev, .tb-aurora, .tb-conic, .tb-conic-2,
    .tb-grid-bg, .tb-particles span, .tb-shoot, .tb-waves svg, .tb-scan,
    .tb-stars i, .tb-card, .tb-card-emoji, .tb-stat-pill { animation: none !important; }
  }
</style>
@endpush

<div x-data="tipsBantuanPage()" class="tb-page">

  {{-- ═══════════ HERO BANNER ═══════════ --}}
  <div class="tb-hero" id="tb-hero">

    {{-- Aurora mesh gradient --}}
    <div class="tb-aurora"></div>

    {{-- Rotating conic glows --}}
    <div class="tb-conic"></div>
    <div class="tb-conic-2"></div>

    {{-- Grid texture --}}
    <div class="tb-grid-bg"></div>

    {{-- Scanline sweep --}}
    <div class="tb-scan"></div>

    {{-- Twinkling stars --}}
    <div class="tb-stars">
      @for($i=0;$i<16;$i++)
        <i style="top:{{ rand(2,90) }}%; left:{{ rand(2,98) }}%; animation-delay:{{ ($i*0.23) }}s;"></i>
      @endfor
    </div>

    {{-- Floating particles --}}
    <div class="tb-particles">
      @for($i=0;$i<12;$i++)
        @php $dur = rand(7,14); $delay = $i * 0.7; $left = rand(2,98); $size = rand(3,7); $drift = rand(-40,40); @endphp
        <span style="left:{{ $left }}%; width:{{ $size }}px; height:{{ $size }}px; animation-duration:{{ $dur }}s; animation-delay:{{ $delay }}s; --drift:{{ $drift }}px;"></span>
      @endfor
    </div>

    {{-- Shooting stars --}}
    <div class="tb-shoot"></div>
    <div class="tb-shoot s2"></div>

    {{-- Decorative blobs --}}
    <div class="tb-blob" style="position:absolute;right:-48px;top:-48px;width:192px;height:192px;border-radius:50%;opacity:.2;background:radial-gradient(circle,#60a5fa,transparent 70%);"></div>
    <div class="tb-blob-rev" style="position:absolute;right:80px;bottom:-64px;width:160px;height:160px;border-radius:50%;opacity:.15;background:radial-gradient(circle,#a78bfa,transparent 70%);"></div>

    {{-- Main content --}}
    <div class="tb-hero-content">
      <div class="tb-hero-left">
        <div class="tb-hero-icon-wrap">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
          </svg>
        </div>
        <div>
          <div class="tb-hero-label">
            <span></span>
            {{ __('PUSAT BANTUAN') }}
          </div>
          <h1 class="tb-hero-title">{{ __('Tips & Bantuan') }}</h1>
          <div class="tb-hero-sub">
            <span class="tb-dot"></span>
            <span x-text="roleLabel"></span>
          </div>
        </div>
      </div>
      <button @click="startTour()" class="tb-btn-tour" id="tb-tour-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456Z" />
        </svg>
        {{ __('Mulai Tur Halaman') }}
      </button>
    </div>

    {{-- Animated waves --}}
    <div class="tb-waves">
      <svg viewBox="0 0 2400 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,40 C150,80 350,0 600,40 C850,80 1050,0 1200,40 C1350,80 1550,0 1800,40 C2050,80 2250,0 2400,40 L2400,80 L0,80 Z" fill="rgba(255,255,255,0.18)"/>
      </svg>
    </div>
    <div class="tb-waves w2">
      <svg viewBox="0 0 2400 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,50 C200,20 400,70 600,50 C800,30 1000,70 1200,50 C1400,20 1600,70 1800,50 C2000,30 2200,70 2400,50 L2400,80 L0,80 Z" fill="rgba(147,197,253,0.22)"/>
      </svg>
    </div>
  </div>

  {{-- ═══════════ SEARCH & FILTER ═══════════ --}}
  <div class="tb-toolbar" id="tb-toolbar">
    <div class="tb-search-wrap" id="tb-search">
      <svg class="tb-search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
      </svg>
      <input type="text" x-model="search" placeholder="{{ __('Cari tips, panduan, atau bantuan...') }}" class="tb-search-input" />
    </div>
    <div class="tb-tabs" id="tb-tabs">
      <template x-for="cat in categories" :key="cat.id">
        <button @click="activeCategory = cat.id" :class="activeCategory === cat.id ? 'tb-tab--active' : 'tb-tab--inactive'" class="tb-tab" x-text="cat.label"></button>
      </template>
    </div>
  </div>

  {{-- ═══════════ TIPS GRID ═══════════ --}}
  <div class="tb-grid" id="tb-grid">
    <template x-for="(tip, index) in filteredTips" :key="tip.title">
      <div class="tb-card" :class="expandedTip === index ? 'tb-card--expanded' : ''"
           :style="'animation-delay:' + (index * 0.05) + 's'"
           @click="toggleTip(index)">
        <div class="tb-card-head">
          <div class="tb-card-emoji" :style="'background:' + tip.iconBg">
            <span x-text="tip.emoji"></span>
          </div>
          <div class="tb-card-info">
            <h3 class="tb-card-title" x-text="tip.title"></h3>
            <span class="tb-card-cat" x-text="tip.categoryLabel"></span>
          </div>
          <svg class="tb-card-chev" :class="expandedTip === index ? 'tb-chev-open' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
          </svg>
        </div>
        <div x-show="expandedTip === index" x-collapse.duration.200ms class="tb-card-body">
          <p class="tb-card-desc" x-text="tip.desc"></p>
          <div x-show="tip.steps && tip.steps.length > 0" class="tb-steps">
            <template x-for="(step, si) in (tip.steps || [])" :key="si">
              <div class="tb-step">
                <span class="tb-step-num" x-text="si + 1"></span>
                <span class="tb-step-txt" x-text="step"></span>
              </div>
            </template>
          </div>
        </div>
      </div>
    </template>
  </div>

  {{-- ═══════════ EMPTY STATE ═══════════ --}}
  <div x-show="filteredTips.length === 0" class="tb-empty">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:48px;height:48px;color:#94a3b8;margin:0 auto 12px;display:block">
      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
    </svg>
    <p style="font-weight:600;margin-bottom:4px;">{{ __('Tidak ditemukan') }}</p>
    <p style="font-size:.8rem;">{{ __('Coba kata kunci lain atau ganti filter kategori.') }}</p>
  </div>

  {{-- ═══════════ QUICK ACCESS ═══════════ --}}
  <div class="tb-quick-section" id="tb-quick-access">
    <div class="tb-quick-title">⚡ {{ __('Akses Cepat Admin') }}</div>
    <div class="tb-quick-grid">
      <a href="/admin" class="tb-quick-card">
        <div class="tb-quick-icon" style="background:rgba(37,99,235,.1);">📊</div>
        <div>
          <div class="tb-quick-label">{{ __('Dashboard') }}</div>
          <div class="tb-quick-sublabel">{{ __('Ringkasan platform') }}</div>
        </div>
      </a>
      <a href="/admin/manajemen-pengguna" class="tb-quick-card">
        <div class="tb-quick-icon" style="background:rgba(16,185,129,.1);">👥</div>
        <div>
          <div class="tb-quick-label">{{ __('Pengguna') }}</div>
          <div class="tb-quick-sublabel">{{ __('Kelola akun') }}</div>
        </div>
      </a>
      <a href="/admin/manajemen-kampanye" class="tb-quick-card">
        <div class="tb-quick-icon" style="background:rgba(245,158,11,.1);">🚀</div>
        <div>
          <div class="tb-quick-label">{{ __('Kampanye') }}</div>
          <div class="tb-quick-sublabel">{{ __('Monitor testing') }}</div>
        </div>
      </a>
      <a href="/admin/manajemen-pembayaran" class="tb-quick-card">
        <div class="tb-quick-icon" style="background:rgba(139,92,246,.1);">💳</div>
        <div>
          <div class="tb-quick-label">{{ __('Pembayaran') }}</div>
          <div class="tb-quick-sublabel">{{ __('Verifikasi transfer') }}</div>
        </div>
      </a>
      <a href="/admin/manajemen-withdraw" class="tb-quick-card">
        <div class="tb-quick-icon" style="background:rgba(236,72,153,.1);">🏦</div>
        <div>
          <div class="tb-quick-label">{{ __('Withdraw') }}</div>
          <div class="tb-quick-sublabel">{{ __('Proses penarikan') }}</div>
        </div>
      </a>
      <a href="/admin/manajemen-paket" class="tb-quick-card">
        <div class="tb-quick-icon" style="background:rgba(59,130,246,.1);">📦</div>
        <div>
          <div class="tb-quick-label">{{ __('Paket') }}</div>
          <div class="tb-quick-sublabel">{{ __('Kelola paket') }}</div>
        </div>
      </a>
      <a href="/admin/profile" class="tb-quick-card">
        <div class="tb-quick-icon" style="background:rgba(20,184,166,.1);">👤</div>
        <div>
          <div class="tb-quick-label">{{ __('Profil') }}</div>
          <div class="tb-quick-sublabel">{{ __('Edit profil Anda') }}</div>
        </div>
      </a>
    </div>
  </div>

  {{-- ═══════════ STATS BAR ═══════════ --}}
  <div class="tb-stats-bar">
    <div class="tb-stats-item">
      <span class="tb-stats-num" x-text="filteredTips.length"></span>
      <span>{{ __('tips ditampilkan') }}</span>
    </div>
    <div class="tb-stats-item">
      <span>{{ __('dari') }}</span>
      <span class="tb-stats-num" x-text="tips.length"></span>
      <span>{{ __('total tips') }}</span>
    </div>
    <div class="tb-stats-item">
      <span style="opacity:.5;">•</span>
      <span>{{ __('Tekan') }} <kbd style="background:rgba(241,245,249,.8);padding:2px 8px;border-radius:5px;border:1px solid rgba(226,232,240,.6);font-size:.7rem;font-weight:600;font-family:'JetBrains Mono',monospace;">Ctrl+K</kbd> {{ __('untuk pencarian global') }}</span>
    </div>
  </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/driver.js@1.3.1/dist/driver.js.iife.js"></script>
<script>
  function tipsBantuanPage() {
    const path = window.location.pathname;
    let role = 'admin';
    if (path.startsWith('/developer')) role = 'developer';
    else if (path.startsWith('/tester')) role = 'tester';

    const roleLabels = {
      admin: {!! json_encode(__('Panduan lengkap untuk Administrator')) !!},
      developer: {!! json_encode(__('Panduan untuk Developer')) !!},
      tester: {!! json_encode(__('Panduan untuk Tester')) !!}
    };

    const tipsData = {
      admin: [
        {
          title: {!! json_encode(__('Navigasi Dashboard')) !!},
          emoji: '📊',
          iconBg: 'rgba(37,99,235,0.12)',
          category: 'navigasi',
          categoryLabel: {!! json_encode(__('Navigasi')) !!},
          desc: {!! json_encode(__('Dashboard Admin menampilkan ringkasan seluruh platform PlayTest ID. Anda bisa melihat statistik developer, tester, kampanye aktif, dan pendapatan secara real-time. Dashboard dilengkapi chart aktivitas mingguan dan daftar pendaftaran terbaru.')) !!},
          steps: [{!! json_encode(__('Buka menu "Dashboard" di sidebar kiri')) !!}, {!! json_encode(__('Lihat 6 kartu statistik utama di bagian atas (Developer, Tester, Kampanye Aktif, Selesai, Pendapatan, Pending)')) !!}, {!! json_encode(__('Scroll ke bawah untuk melihat chart aktivitas mingguan dan tabel pendaftaran terbaru')) !!}, {!! json_encode(__('Gunakan tombol "Refresh Data" untuk memperbarui data secara manual')) !!}]
        },
        {
          title: {!! json_encode(__('Monitoring Statistik Real-time')) !!},
          emoji: '📈',
          iconBg: 'rgba(16,185,129,0.12)',
          category: 'navigasi',
          categoryLabel: {!! json_encode(__('Navigasi')) !!},
          desc: {!! json_encode(__('Dashboard menyediakan monitoring real-time dengan auto-refresh setiap 3 detik. Anda bisa memantau tren registrasi, rasio developer vs tester, dan hari paling aktif.')) !!},
          steps: [{!! json_encode(__('Perhatikan bar chart "Aktivitas Mingguan" yang menampilkan registrasi 7 hari terakhir')) !!}, {!! json_encode(__('Lihat statistik ringkasan di bawah chart: total dev/tester minggu ini, rasio, dan hari paling aktif')) !!}, {!! json_encode(__('Klik "Quick Actions" untuk akses cepat ke fitur-fitur admin')) !!}, {!! json_encode(__('Data di dashboard otomatis diperbarui setiap 3 detik')) !!}]
        },
        {
          title: {!! json_encode(__('Kelola Pengguna')) !!},
          emoji: '👥',
          iconBg: 'rgba(16,185,129,0.12)',
          category: 'fitur',
          categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Manajemen Pengguna memungkinkan Anda untuk melihat, mengelola, dan mengatur semua akun Developer dan Tester yang terdaftar di platform.')) !!},
          steps: [{!! json_encode(__('Buka menu "Pengguna" di sidebar kiri')) !!}, {!! json_encode(__('Gunakan filter dan pencarian untuk menemukan user tertentu')) !!}, {!! json_encode(__('Klik tombol aksi di setiap baris untuk melihat detail atau mengelola akun')) !!}, {!! json_encode(__('Sortir data berdasarkan nama, role, tanggal, atau status')) !!}]
        },
        {
          title: {!! json_encode(__('Approval Pendaftaran User')) !!},
          emoji: '✅',
          iconBg: 'rgba(34,197,94,0.12)',
          category: 'fitur',
          categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Sebagai admin, Anda bertanggung jawab menyetujui atau menolak pendaftaran baru. Pastikan untuk mereview setiap pendaftaran dengan teliti.')) !!},
          steps: [{!! json_encode(__('Perhatikan badge "Pending" di Dashboard untuk mengetahui jumlah yang menunggu')) !!}, {!! json_encode(__('Buka halaman "Pengguna" dan filter berdasarkan status "Pending"')) !!}, {!! json_encode(__('Review profil dan data pendaftar')) !!}, {!! json_encode(__('Klik tombol "Approve" untuk menyetujui atau "Reject" untuk menolak pendaftaran')) !!}]
        },
        {
          title: {!! json_encode(__('Manajemen Kampanye')) !!},
          emoji: '🚀',
          iconBg: 'rgba(245,158,11,0.12)',
          category: 'fitur',
          categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Kelola semua kampanye testing yang ada di platform. Anda bisa memantau progres, jumlah tester, durasi, dan status setiap kampanye secara detail.')) !!},
          steps: [{!! json_encode(__('Buka menu "Kampanye" di sidebar kiri')) !!}, {!! json_encode(__('Lihat daftar kampanye beserta status (Aktif, Selesai, Ditinjau)')) !!}, {!! json_encode(__('Klik detail untuk melihat informasi lengkap kampanye')) !!}, {!! json_encode(__('Monitor progress tester dan durasi kampanye melalui progress bar')) !!}]
        },
        {
          title: {!! json_encode(__('Verifikasi Pembayaran Developer')) !!},
          emoji: '💳',
          iconBg: 'rgba(139,92,246,0.12)',
          category: 'fitur',
          categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Review dan verifikasi bukti pembayaran dari Developer. Pastikan nominal dan bukti transfer valid sebelum menyetujui pembayaran.')) !!},
          steps: [{!! json_encode(__('Buka menu "Pembayaran Developer" di sidebar')) !!}, {!! json_encode(__('Filter berdasarkan status: Pending, Accepted, atau Rejected')) !!}, {!! json_encode(__('Klik detail untuk melihat bukti transfer yang diunggah developer')) !!}, {!! json_encode(__('Verifikasi nominal pembayaran sesuai paket yang dipilih')) !!}, {!! json_encode(__('Approve jika valid atau tolak dengan memberikan alasan')) !!}]
        },
        {
          title: {!! json_encode(__('Manajemen Withdraw Tester')) !!},
          emoji: '🏦',
          iconBg: 'rgba(236,72,153,0.12)',
          category: 'fitur',
          categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Kelola permintaan penarikan saldo dari Tester. Pastikan data rekening tujuan sudah benar sebelum memproses transfer.')) !!},
          steps: [{!! json_encode(__('Buka menu "Withdraw Tester" di sidebar')) !!}, {!! json_encode(__('Review permintaan withdraw yang masuk')) !!}, {!! json_encode(__('Verifikasi data rekening tujuan (nama, bank, nomor rekening)')) !!}, {!! json_encode(__('Proses transfer dan update status menjadi "Berhasil"')) !!}, {!! json_encode(__('Tolak jika data tidak valid dengan memberikan catatan')) !!}]
        },
        {
          title: {!! json_encode(__('Manajemen Paket Testing')) !!},
          emoji: '📦',
          iconBg: 'rgba(59,130,246,0.12)',
          category: 'fitur',
          categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Atur paket-paket testing yang tersedia di platform. Anda bisa menambah paket baru, mengedit harga, atau menonaktifkan paket yang sudah tidak diperlukan.')) !!},
          steps: [{!! json_encode(__('Buka menu "Paket" di sidebar kiri')) !!}, {!! json_encode(__('Klik "Tambah Paket" untuk membuat paket testing baru')) !!}, {!! json_encode(__('Isi nama paket, deskripsi, harga, dan kapasitas tester')) !!}, {!! json_encode(__('Edit paket yang ada melalui tombol aksi di setiap baris')) !!}, {!! json_encode(__('Nonaktifkan paket yang tidak lagi tersedia')) !!}]
        },
        {
          title: {!! json_encode(__('Export & Laporan Data')) !!},
          emoji: '📄',
          iconBg: 'rgba(99,102,241,0.12)',
          category: 'fitur',
          categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Export data platform untuk keperluan laporan dan analisis. Data bisa diekspor dalam format CSV atau Excel untuk dokumentasi.')) !!},
          steps: [{!! json_encode(__('Buka Dashboard admin dan klik tombol "Export" di kanan atas')) !!}, {!! json_encode(__('Pilih format export: CSV atau Excel')) !!}, {!! json_encode(__('Data yang diexport mencakup statistik pengguna, kampanye, dan transaksi')) !!}, {!! json_encode(__('Gunakan data export untuk membuat laporan bulanan atau tahunan')) !!}]
        },
        {
          title: {!! json_encode(__('Notifikasi & Broadcast')) !!},
          emoji: '🔔',
          iconBg: 'rgba(168,85,247,0.12)',
          category: 'fitur',
          categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Kirim notifikasi broadcast ke seluruh pengguna platform. Gunakan untuk pengumuman penting, update fitur, atau maintenance schedule.')) !!},
          steps: [{!! json_encode(__('Buka Dashboard admin dan lihat bagian "Quick Actions"')) !!}, {!! json_encode(__('Klik tombol "Broadcast Notif" untuk mengirim notifikasi massal')) !!}, {!! json_encode(__('Tulis pesan broadcast yang jelas dan informatif')) !!}, {!! json_encode(__('Pilih target penerima: semua user, developer saja, atau tester saja')) !!}, {!! json_encode(__('Konfirmasi dan kirim broadcast')) !!}]
        },
        {
          title: {!! json_encode(__('Profil & Pengaturan Akun')) !!},
          emoji: '👤',
          iconBg: 'rgba(20,184,166,0.12)',
          category: 'fitur',
          categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Edit informasi profil admin Anda termasuk nama, email, dan password. Halaman profil juga menampilkan statistik ringkasan platform.')) !!},
          steps: [{!! json_encode(__('Klik nama Anda di pojok kanan atas atau buka menu "Profil"')) !!}, {!! json_encode(__('Lihat ringkasan statistik di hero banner profil')) !!}, {!! json_encode(__('Edit nama dan email pada form yang tersedia')) !!}, {!! json_encode(__('Ubah password di bagian keamanan akun')) !!}, {!! json_encode(__('Klik "Simpan Perubahan" untuk menyimpan')) !!}]
        },
        {
          title: {!! json_encode(__('Menggunakan Halaman Tips')) !!},
          emoji: '💡',
          iconBg: 'rgba(251,191,36,0.12)',
          category: 'navigasi',
          categoryLabel: {!! json_encode(__('Navigasi')) !!},
          desc: {!! json_encode(__('Halaman Tips & Bantuan ini berisi panduan lengkap untuk semua fitur admin. Gunakan fitur pencarian dan filter untuk menemukan tips yang Anda butuhkan.')) !!},
          steps: [{!! json_encode(__('Gunakan kolom pencarian untuk mencari tips berdasarkan kata kunci')) !!}, {!! json_encode(__('Klik tab kategori untuk memfilter tips: Navigasi, Fitur, Umum, atau Keamanan')) !!}, {!! json_encode(__('Klik kartu tips untuk membuka detail dan langkah-langkah')) !!}, {!! json_encode(__('Gunakan "Akses Cepat" di bawah untuk langsung ke halaman yang dituju')) !!}, {!! json_encode(__('Klik "Mulai Tur Halaman" untuk panduan interaktif')) !!}]
        },
        {
          title: {!! json_encode(__('Dark Mode & Tema')) !!},
          emoji: '🌙',
          iconBg: 'rgba(71,85,105,0.12)',
          category: 'umum',
          categoryLabel: {!! json_encode(__('Umum')) !!},
          desc: {!! json_encode(__('Aktifkan mode gelap untuk pengalaman yang lebih nyaman, terutama saat bekerja di malam hari. Semua halaman admin mendukung dark mode sepenuhnya.')) !!},
          steps: [{!! json_encode(__('Klik nama Anda di pojok kanan atas sidebar')) !!}, {!! json_encode(__('Pilih ikon bulan (🌙) untuk mengaktifkan mode gelap')) !!}, {!! json_encode(__('Pilih ikon matahari (☀️) untuk kembali ke mode terang')) !!}, {!! json_encode(__('Pengaturan tema akan disimpan otomatis untuk sesi berikutnya')) !!}]
        },
        {
          title: {!! json_encode(__('Keyboard Shortcuts')) !!},
          emoji: '⌨️',
          iconBg: 'rgba(34,211,238,0.12)',
          category: 'umum',
          categoryLabel: {!! json_encode(__('Umum')) !!},
          desc: {!! json_encode(__('Gunakan pintasan keyboard untuk navigasi lebih cepat dan meningkatkan produktivitas Anda sebagai admin.')) !!},
          steps: [{!! json_encode(__('Ctrl/⌘ + K untuk membuka pencarian global Filament')) !!}, {!! json_encode(__('ESC untuk menutup modal, panel, atau dialog aktif')) !!}, {!! json_encode(__('Tab untuk navigasi antar elemen form')) !!}, {!! json_encode(__('Enter untuk mengonfirmasi aksi yang sedang aktif')) !!}]
        },
        {
          title: {!! json_encode(__('Keamanan Akun Admin')) !!},
          emoji: '🔐',
          iconBg: 'rgba(239,68,68,0.12)',
          category: 'keamanan',
          categoryLabel: {!! json_encode(__('Keamanan')) !!},
          desc: {!! json_encode(__('Jaga keamanan akun admin Anda dengan mengikuti praktik terbaik keamanan. Akun admin memiliki akses penuh ke semua data platform.')) !!},
          steps: [{!! json_encode(__('Gunakan password yang kuat (minimal 8 karakter, kombinasi huruf, angka, dan simbol)')) !!}, {!! json_encode(__('Jangan bagikan kredensial login admin ke siapapun')) !!}, {!! json_encode(__('Logout setelah selesai menggunakan panel admin, terutama di komputer bersama')) !!}, {!! json_encode(__('Periksa aktivitas login secara berkala untuk mendeteksi akses tidak sah')) !!}, {!! json_encode(__('Ganti password secara rutin minimal setiap 3 bulan')) !!}]
        },
        {
          title: {!! json_encode(__('Ganti Bahasa')) !!},
          emoji: '🌐',
          iconBg: 'rgba(59,130,246,0.12)',
          category: 'umum',
          categoryLabel: {!! json_encode(__('Umum')) !!},
          desc: {!! json_encode(__('Ubah bahasa antarmuka panel admin sesuai preferensi Anda. Tersedia pilihan Bahasa Indonesia dan Bahasa Inggris.')) !!},
          steps: [{!! json_encode(__('Klik card akun pada kanan atas')) !!}, {!! json_encode(__('Klik EN untuk mengubah ke bahasa Inggris')) !!}, {!! json_encode(__('Klik ID untuk kembali ke bahasa Indonesia')) !!}, {!! json_encode(__('Sistem akan menyimpan preferensi bahasa Anda untuk kunjungan berikutnya')) !!}]
        },
      ],
      developer: [
        {
          title: {!! json_encode(__('Dashboard Developer')) !!}, emoji: '🏠', iconBg: 'rgba(37,99,235,0.12)',
          category: 'navigasi', categoryLabel: {!! json_encode(__('Navigasi')) !!},
          desc: {!! json_encode(__('Dashboard Developer menampilkan ringkasan aplikasi Anda, progres testing, dan statistik kampanye.')) !!},
          steps: [{!! json_encode(__('Buka menu "Home" di sidebar')) !!}, {!! json_encode(__('Lihat kartu statistik di bagian atas')) !!}, {!! json_encode(__('Periksa notifikasi dan update terbaru')) !!}]
        },
        {
          title: {!! json_encode(__('Buat Test Case Baru')) !!}, emoji: '📝', iconBg: 'rgba(16,185,129,0.12)',
          category: 'fitur', categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Buat kampanye testing baru untuk aplikasi Anda. Tentukan langkah-langkah testing yang perlu dilakukan tester.')) !!},
          steps: [{!! json_encode(__('Klik menu "New Test Case"')) !!}, {!! json_encode(__('Isi nama dan deskripsi kampanye')) !!}, {!! json_encode(__('Tentukan langkah-langkah testing')) !!}, {!! json_encode(__('Submit dan tunggu tester bergabung')) !!}]
        },
        {
          title: {!! json_encode(__('Pantau Progress')) !!}, emoji: '📈', iconBg: 'rgba(245,158,11,0.12)',
          category: 'fitur', categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Monitor progres testing aplikasi Anda secara real-time.')) !!},
          steps: [{!! json_encode(__('Buka menu "Pantau Progress"')) !!}, {!! json_encode(__('Pilih kampanye yang ingin dilihat')) !!}, {!! json_encode(__('Lihat grafik dan statistik progres')) !!}]
        },
        {
          title: {!! json_encode(__('Dark Mode')) !!}, emoji: '🌙', iconBg: 'rgba(71,85,105,0.12)',
          category: 'umum', categoryLabel: {!! json_encode(__('Umum')) !!},
          desc: {!! json_encode(__('Aktifkan mode gelap untuk kenyamanan mata Anda.')) !!},
          steps: [{!! json_encode(__('Klik nama Anda di pojok kanan atas')) !!}, {!! json_encode(__('Pilih ikon tema yang diinginkan')) !!}]
        },
      ],
      tester: [
        {
          title: {!! json_encode(__('Dashboard Tester')) !!}, emoji: '🏠', iconBg: 'rgba(14,165,233,0.12)',
          category: 'navigasi', categoryLabel: {!! json_encode(__('Navigasi')) !!},
          desc: {!! json_encode(__('Dashboard Tester menampilkan misi yang tersedia, progres pengujian, dan saldo dompet Anda.')) !!},
          steps: [{!! json_encode(__('Buka menu "Home" di sidebar')) !!}, {!! json_encode(__('Lihat misi baru yang tersedia')) !!}, {!! json_encode(__('Periksa saldo dan progres Anda')) !!}]
        },
        {
          title: {!! json_encode(__('Ambil & Selesaikan Misi')) !!}, emoji: '🎯', iconBg: 'rgba(16,185,129,0.12)',
          category: 'fitur', categoryLabel: {!! json_encode(__('Fitur')) !!},
          desc: {!! json_encode(__('Ambil misi testing yang tersedia dan selesaikan sesuai langkah-langkah yang ditentukan.')) !!},
          steps: [{!! json_encode(__('Buka menu "Misi Saya"')) !!}, {!! json_encode(__('Lihat misi yang tersedia')) !!}, {!! json_encode(__('Klik misi untuk melihat detail')) !!}, {!! json_encode(__('Submit hasil testing Anda')) !!}]
        },
        {
          title: {!! json_encode(__('Dark Mode')) !!}, emoji: '🌙', iconBg: 'rgba(71,85,105,0.12)',
          category: 'umum', categoryLabel: {!! json_encode(__('Umum')) !!},
          desc: {!! json_encode(__('Aktifkan mode gelap untuk kenyamanan mata Anda.')) !!},
          steps: [{!! json_encode(__('Klik nama Anda di pojok kanan atas')) !!}, {!! json_encode(__('Pilih ikon tema yang diinginkan')) !!}]
        },
      ]
    };

    return {
      search: '',
      activeCategory: 'semua',
      expandedTip: null,
      role,
      roleLabel: roleLabels[role],
      tips: tipsData[role] || tipsData.admin,
      categories: [
        { id: 'semua', label: '🏷️ ' + {!! json_encode(__('Semua')) !!} },
        { id: 'navigasi', label: '🧭 ' + {!! json_encode(__('Navigasi')) !!} },
        { id: 'fitur', label: '⚙️ ' + {!! json_encode(__('Fitur')) !!} },
        { id: 'umum', label: '📌 ' + {!! json_encode(__('Umum')) !!} },
        { id: 'keamanan', label: '🔐 ' + {!! json_encode(__('Keamanan')) !!} },
      ],
      get filteredTips() {
        let r = this.tips;
        if (this.activeCategory !== 'semua') r = r.filter(t => t.category === this.activeCategory);
        if (this.search.trim()) {
          const q = this.search.toLowerCase();
          r = r.filter(t => t.title.toLowerCase().includes(q) || t.desc.toLowerCase().includes(q));
        }
        return r;
      },
      toggleTip(i) {
        this.expandedTip = this.expandedTip === i ? null : i;
      },
      startTour() {
        if (typeof window.driver === 'undefined') {
          console.warn('Driver.js belum dimuat.');
          return;
        }

        // Build steps dynamically — only include sidebar items that exist in the DOM
        const steps = [];

        // Step 1: Welcome (no element - modal)
        steps.push({
          popover: {
            title: {!! json_encode(__('👋 Selamat Datang di Panel Admin!')) !!},
            description: {!! json_encode(__('Tur ini akan memandu Anda mengenal <strong>seluruh fitur admin</strong> PlayTest ID. Mari kita mulai!')) !!},
          }
        });

        // Step 2: Sidebar navigation
        const sidebar = document.querySelector('.fi-sidebar-nav');
        if (sidebar) {
          steps.push({
            element: '.fi-sidebar-nav',
            popover: {
              title: {!! json_encode(__('📋 Sidebar Navigasi')) !!},
              description: {!! json_encode(__('Ini adalah <strong>menu utama</strong> panel admin. Semua fitur admin bisa diakses dari sidebar ini.')) !!},
              side: 'right',
              align: 'start'
            }
          });
        }

        // Step 3: Dashboard
        const dashItem = document.querySelector('.fi-sidebar-item a[href*="/admin"][href$="/admin"], .fi-sidebar-item a[href="/admin"]');
        if (!dashItem) {
          // try broader match
          const allLinks = document.querySelectorAll('.fi-sidebar-item a');
          for (const link of allLinks) {
            if (link.getAttribute('href') === '/admin' || link.textContent.trim().toLowerCase().includes('dashboard')) {
              steps.push({
                element: link.closest('.fi-sidebar-item') || link,
                popover: {
                  title: {!! json_encode(__('📊 Dashboard')) !!},
                  description: {!! json_encode(__('Halaman utama admin. Lihat <strong>statistik real-time</strong>: jumlah developer, tester, kampanye aktif, pendapatan, dan grafik aktivitas mingguan.')) !!},
                  side: 'right',
                  align: 'start'
                }
              });
              break;
            }
          }
        } else {
          steps.push({
            element: dashItem.closest('.fi-sidebar-item') || dashItem,
            popover: {
              title: {!! json_encode(__('📊 Dashboard')) !!},
              description: {!! json_encode(__('Halaman utama admin. Lihat <strong>statistik real-time</strong>: jumlah developer, tester, kampanye aktif, pendapatan, dan grafik aktivitas mingguan.')) !!},
              side: 'right',
              align: 'start'
            }
          });
        }

        // Helper: find sidebar item by href keyword or label text
        const findSidebarItem = (keywords) => {
          const links = document.querySelectorAll('.fi-sidebar-item a[href], .fi-sidebar-item button');
          for (const link of links) {
            const href = (link.getAttribute('href') || '').toLowerCase();
            const text = (link.textContent || '').toLowerCase().trim();
            for (const kw of keywords) {
              if (href.includes(kw) || text.includes(kw)) {
                return link.closest('.fi-sidebar-item') || link;
              }
            }
          }
          return null;
        };

        // Step 4: Manajemen Pengguna
        const pengguna = findSidebarItem(['pengguna']);
        if (pengguna) {
          steps.push({
            element: pengguna,
            popover: {
              title: {!! json_encode(__('👥 Manajemen Pengguna')) !!},
              description: {!! json_encode(__('Kelola semua akun <strong>Developer</strong> dan <strong>Tester</strong>. Approve pendaftaran baru, suspend akun, atau lihat detail profil pengguna.')) !!},
              side: 'right',
              align: 'start'
            }
          });
        }

        // Step 5: Manajemen Kampanye
        const kampanye = findSidebarItem(['kampanye']);
        if (kampanye) {
          steps.push({
            element: kampanye,
            popover: {
              title: {!! json_encode(__('🚀 Manajemen Kampanye')) !!},
              description: {!! json_encode(__('Monitor seluruh <strong>kampanye testing</strong> di platform. Lihat status, progress tester, durasi, dan detail setiap kampanye.')) !!},
              side: 'right',
              align: 'start'
            }
          });
        }

        // Step 6: Manajemen Paket
        const paket = findSidebarItem(['paket']);
        if (paket) {
          steps.push({
            element: paket,
            popover: {
              title: {!! json_encode(__('📦 Manajemen Paket')) !!},
              description: {!! json_encode(__('Atur <strong>paket testing</strong> yang tersedia. Tambah paket baru, edit harga, atau nonaktifkan paket.')) !!},
              side: 'right',
              align: 'start'
            }
          });
        }

        // Step 7: Pembayaran Developer
        const pembayaran = findSidebarItem(['pembayaran']);
        if (pembayaran) {
          steps.push({
            element: pembayaran,
            popover: {
              title: {!! json_encode(__('💳 Pembayaran Developer')) !!},
              description: {!! json_encode(__('Review dan <strong>verifikasi bukti pembayaran</strong> dari Developer. Approve jika valid atau tolak dengan alasan.')) !!},
              side: 'right',
              align: 'start'
            }
          });
        }

        // Step 8: Withdraw Tester
        const withdraw = findSidebarItem(['withdraw', 'penarikan']);
        if (withdraw) {
          steps.push({
            element: withdraw,
            popover: {
              title: {!! json_encode(__('🏦 Withdraw Tester')) !!},
              description: {!! json_encode(__('Proses <strong>penarikan saldo</strong> tester. Verifikasi data rekening tujuan sebelum melakukan transfer.')) !!},
              side: 'right',
              align: 'start'
            }
          });
        }

        // Step 9: Topbar
        const topbar = document.querySelector('.fi-topbar');
        if (topbar) {
          steps.push({
            element: '.fi-topbar',
            popover: {
              title: {!! json_encode(__('🔝 Topbar Admin')) !!},
              description: {!! json_encode(__('Area atas panel admin. Akses <strong>pencarian global</strong> (Ctrl+K), pengaturan <strong>tema dark/light</strong>, dan <strong>menu profil</strong> Anda.')) !!},
              side: 'bottom',
              align: 'center'
            }
          });
        }

        // Step 10: User menu
        const userMenu = document.querySelector('.fi-user-menu-trigger') || document.querySelector('.topbar-user-combined');
        if (userMenu) {
          steps.push({
            element: userMenu,
            popover: {
              title: {!! json_encode(__('👤 Menu Pengguna')) !!},
              description: {!! json_encode(__('Klik untuk akses <strong>profil akun</strong>, ganti <strong>tema dark/light mode</strong>, <strong>bahasa (ID/EN)</strong>, atau <strong>logout</strong> dari panel admin.')) !!},
              side: 'bottom',
              align: 'end'
            }
          });
        }

        // Step 12: Tips page hero
        steps.push({
          element: '#tb-hero',
          popover: {
            title: {!! json_encode(__('💡 Halaman Tips & Bantuan')) !!},
            description: {!! json_encode(__('Anda sedang berada di halaman ini! Cari tips, filter berdasarkan kategori, dan gunakan <strong>Akses Cepat</strong> untuk navigasi langsung ke fitur admin.')) !!},
            side: 'bottom',
            align: 'center'
          }
        });

        // Step 12: Quick access grid
        const quickAccess = document.querySelector('#tb-quick-access');
        if (quickAccess) {
          steps.push({
            element: '#tb-quick-access',
            popover: {
              title: {!! json_encode(__('⚡ Akses Cepat')) !!},
              description: {!! json_encode(__('Shortcut ke semua halaman admin tanpa perlu kembali ke sidebar. Klik untuk langsung membuka halaman yang dituju.')) !!},
              side: 'top',
              align: 'center'
            }
          });
        }

        // Step 13: Finish
        steps.push({
          popover: {
            title: {!! json_encode(__('🎉 Tur Selesai!')) !!},
            description: {!! json_encode(__('Anda sudah mengenal <strong>seluruh fitur panel admin</strong> PlayTest ID!<br><br>📊 Dashboard — 👥 Pengguna — 🚀 Kampanye<br>💳 Pembayaran — 🏦 Withdraw — 📦 Paket<br><br>Kembali ke halaman ini kapanpun Anda butuh bantuan.')) !!},
          }
        });

        const driverObj = window.driver.js.driver({
          showProgress: true,
          animate: true,
          smoothScroll: true,
          overlayOpacity: 0.55,
          stagePadding: 10,
          stageRadius: 12,
          popoverClass: 'tb-driver-theme',
          popoverOffset: 14,
          nextBtnText: {!! json_encode(__('Lanjut')) !!} + ' →',
          prevBtnText: '← ' + {!! json_encode(__('Kembali')) !!},
          doneBtnText: {!! json_encode(__('Selesai')) !!} + ' ✓',
          progressText: '@{{current}} / @{{total}}',
          allowClose: true,
          steps: steps,
          onHighlightStarted: (element, step, { config, state, driver }) => {
            if (window.matchMedia('(max-width: 1024px)').matches && window.Alpine) {
              const isSidebar = element && (
                element.closest('.fi-sidebar') ||
                element.closest('.fi-sidebar-nav') ||
                element.classList.contains('fi-sidebar-nav') ||
                element.classList.contains('fi-sidebar-item') ||
                element.closest('.fi-sidebar-item')
              );
              const isSidebarOpen = window.Alpine.store('sidebar')?.isOpen;
              if (isSidebar && !isSidebarOpen) {
                window.Alpine.store('sidebar')?.open();
                setTimeout(() => {
                  driver.refresh();
                }, 300);
              } else if (!isSidebar && isSidebarOpen) {
                window.Alpine.store('sidebar')?.close();
                setTimeout(() => {
                  driver.refresh();
                }, 300);
              }
            }
          },
          onDestroyed: () => {
            if (window.matchMedia('(max-width: 1024px)').matches && window.Alpine) {
              window.Alpine.store('sidebar')?.close();
            }
          }
        });

        driverObj.drive();
      }
    };
  }
</script>
@endpush

</x-filament-panels::page>