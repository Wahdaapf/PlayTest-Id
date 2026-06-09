<style>
    /* ====== Profile Theme CSS ====== */
    @keyframes prof-gradient    { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
    @keyframes prof-aurora {
        0%   { transform: translate(-10%,-10%) rotate(0deg)   scale(1.1); }
        33%  { transform: translate(8%,-6%)   rotate(120deg) scale(1.25); }
        66%  { transform: translate(-6%,10%)  rotate(240deg) scale(1.15); }
        100% { transform: translate(-10%,-10%) rotate(360deg) scale(1.1); }
    }
    @keyframes prof-conic { to { transform: rotate(360deg); } }
    @keyframes prof-spin-rev { from{transform:rotate(360deg)} to{transform:rotate(0)} }
    @keyframes prof-grid-pan {
        0%   { background-position: 0 0, 0 0; }
        100% { background-position: 56px 56px, 56px 56px; }
    }
    @keyframes prof-particle {
        0%   { transform: translateY(0) translateX(0); opacity: 0; }
        10%  { opacity: .9; }
        90%  { opacity: .9; }
        100% { transform: translateY(-220px) translateX(var(--drift,20px)); opacity: 0; }
    }
    @keyframes prof-shoot {
        0%   { transform: translate3d(0,0,0) rotate(18deg); opacity: 0; }
        8%   { opacity: 1; }
        100% { transform: translate3d(620px,200px,0) rotate(18deg); opacity: 0; }
    }
    @keyframes prof-twinkle {
        0%,100% { opacity: .2; transform: scale(1); }
        50%     { opacity: 1;  transform: scale(1.6); }
    }

    .mobile-bg-anim {
        position: absolute;
        inset: 0;
        overflow: hidden;
        z-index: 0;
        pointer-events: none;
        background: linear-gradient(135deg,#0a1850 0%,#13297a 25%,#1d4ed8 55%,#2563eb 80%,#3b82f6 100%);
        background-size: 220% 220%;
        animation: prof-gradient 14s ease infinite;
    }
    .prof-aurora {
        position:absolute; inset:-30%;
        background:
            radial-gradient(40% 35% at 20% 30%, rgba(96,165,250,.55), transparent 60%),
            radial-gradient(35% 30% at 80% 20%, rgba(167,139,250,.45), transparent 60%),
            radial-gradient(45% 40% at 60% 80%, rgba(34,211,238,.40), transparent 60%),
            radial-gradient(30% 25% at 15% 85%, rgba(244,114,182,.35), transparent 60%);
        filter: blur(40px);
        animation: prof-aurora 22s ease-in-out infinite;
        mix-blend-mode: screen;
        pointer-events:none;
    }
    .prof-conic {
        position:absolute; width:520px; height:520px; left:-160px; bottom:-200px;
        background: conic-gradient(from 0deg, rgba(59,130,246,0), rgba(96,165,250,.35), rgba(167,139,250,.25), rgba(34,211,238,.30), rgba(59,130,246,0));
        border-radius:50%; filter: blur(30px); animation: prof-conic 28s linear infinite;
        opacity:.7; pointer-events:none;
    }
    .prof-conic-2 {
        position:absolute; width:380px; height:380px; right:-120px; top:-140px;
        background: conic-gradient(from 180deg, rgba(244,114,182,0), rgba(244,114,182,.30), rgba(96,165,250,.30), rgba(244,114,182,0));
        border-radius:50%; filter: blur(30px); animation: prof-spin-rev 34s linear infinite;
        opacity:.6; pointer-events:none;
    }
    .prof-grid-bg {
        background-image:
            linear-gradient(rgba(255,255,255,.07) 1px,transparent 1px),
            linear-gradient(90deg,rgba(255,255,255,.07) 1px,transparent 1px);
        background-size: 28px 28px;
        mask-image: radial-gradient(ellipse at top right, black 30%, transparent 70%);
        animation: prof-grid-pan 18s linear infinite;
    }
    .prof-particles { position:absolute; inset:0; overflow:hidden; pointer-events:none; }
    .prof-particles span {
        position:absolute; bottom:-10px; width:6px; height:6px; border-radius:50%;
        background: radial-gradient(circle, #fff 0%, rgba(255,255,255,.2) 60%, transparent 70%);
        box-shadow: 0 0 12px rgba(255,255,255,.7);
        animation: prof-particle linear infinite; opacity:0;
    }
    .prof-stars { position:absolute; inset:0; pointer-events:none; }
    .prof-stars span {
        position:absolute; width:2px; height:2px; border-radius:50%;
        background:#fff !important; box-shadow:0 0 6px #fff, 0 0 12px #fff !important;
        animation: prof-twinkle 3s ease-in-out infinite;
    }
    .prof-shoot {
        position:absolute; top:18%; left:-20%; width:120px; height:2px;
        background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,.9));
        filter: drop-shadow(0 0 6px rgba(147,197,253,.9)); border-radius:2px;
        animation: prof-shoot 7s ease-in infinite; animation-delay: -2s;
        pointer-events:none; opacity: 0;
    }
    .prof-shoot.s2 { top:55%; animation-duration: 9s; animation-delay: -5s; opacity: 0; }
    .prof-scan {
        position:absolute; left:0; right:0; top:0; height:25%;
        background: linear-gradient(180deg, transparent, rgba(147,197,253,.18), transparent);
        animation: prof-scan 9s ease-in-out infinite; pointer-events:none;
    }
    @media (prefers-reduced-motion: reduce) {
        .mobile-bg-anim, .prof-aurora, .prof-conic, .prof-conic-2, .prof-grid-bg,
        .prof-particles span, .prof-shoot, .prof-scan, .prof-stars span { animation: none !important; }
    }
    
    @media (min-width: 1024px) {
        .mobile-bg-anim { display: none !important; }
    }
</style>

<div class="mobile-bg-anim">
    {{-- Aurora mesh gradient --}}
    <div class="prof-aurora"></div>
    {{-- Rotating conic glows --}}
    <div class="prof-conic"></div>
    <div class="prof-conic-2"></div>
    {{-- Grid texture --}}
    <div class="absolute inset-0 prof-grid-bg pointer-events-none"></div>
    {{-- Scanline sweep --}}
    <div class="prof-scan"></div>
    {{-- Twinkling stars --}}
    <div class="prof-stars">
        @for($i=0;$i<18;$i++)
        <span style="top:{{ rand(2,90) }}%; left:{{ rand(2,98) }}%; animation-delay:-{{ ($i*0.23) }}s;"></span>
        @endfor
    </div>
    {{-- Floating particles --}}
    <div class="prof-particles">
        @for($i=0;$i<14;$i++)
        @php $dur = rand(7,14); $delay = $i * 0.7; $left = rand(2,98); $size = rand(3,7); $drift = rand(-40,40); @endphp
        <span style="left:{{ $left }}%; width:{{ $size }}px; height:{{ $size }}px; animation-duration:{{ $dur }}s; animation-delay:{{ $delay }}s; --drift:{{ $drift }}px;"></span>
        @endfor
    </div>
    {{-- Shooting stars --}}
    <div class="prof-shoot"></div>
    <div class="prof-shoot s2"></div>
</div>
