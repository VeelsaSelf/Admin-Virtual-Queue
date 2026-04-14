@extends('user.layouts.app')
@section('title','Menu – Mau Kopi')

@push('styles')
<style>
/* ===================== HERO ===================== */
.hero-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 60px 80px 50px 80px;
    gap: 32px;
    max-width: 1280px;
    margin: 0 auto;
}
.hero-title {
    font-size: 56px;
    font-weight: 800;
    line-height: 1.1;
    color: #F0EDE8;
    margin-bottom: 20px;
    letter-spacing: -0.5px;
}
.hero-title .accent { color: #DDB892; }
.hero-sub {
    font-size: 13.5px;
    color: rgba(240,237,232,0.42);
    line-height: 1.65;
    max-width: 280px;
    margin-bottom: 34px;
}
.hero-btn {
    display: inline-block;
    padding: 13px 30px;
    border: 1.5px solid #DDB892;
    border-radius: 10px;
    color: #1C1917;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.18s;
    background: #DDB892;
}

/* Coffee bean circle */
.bean-circle-wrap {
    position: relative;
    width: 370px;
    height: 370px;
    flex-shrink: 0;
}
.bean-circle {
    width: 370px;
    height: 370px;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    background: radial-gradient(ellipse at center, #5A3418 0%, #321C0A 45%, #1A0E05 80%, #0D0905 100%);
}
.rbean {
    position: absolute;
    border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
}
.rbean::after {
    content: '';
    position: absolute;
    top: 47%;
    left: 15%;
    right: 15%;
    height: 1.5px;
    background: rgba(0,0,0,0.55);
    border-radius: 50%;
    transform: translateY(-50%) rotate(-7deg);
}
.center-img {
    position: absolute;
    width: 222px;
    height: 222px;
    border-radius: 50%;
    overflow: hidden;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 4;
    box-shadow: 0 8px 48px rgba(0,0,0,0.6);
}
.center-img img { width:100%;height:100%;object-fit:cover; }

/* Floating beans outside */
.fbean {
    position: absolute;
    border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
    background: radial-gradient(ellipse at 38% 32%, #7A5028 0%, #4E3018 50%, #2A1A0A 100%);
    animation: fbFloat ease-in-out infinite;
}
.fbean::after {
    content: '';
    position: absolute;
    top: 47%;
    left: 15%;
    right: 15%;
    height: 1.5px;
    background: rgba(0,0,0,0.45);
    border-radius: 50%;
    transform: translateY(-50%) rotate(-7deg);
}
@keyframes fbFloat {
    0%,100% { transform: translateY(0px) rotate(var(--rot,0deg)); }
    45%      { transform: translateY(-16px) rotate(var(--rot2,12deg)); }
}

.circle-badge {
    position: absolute;
    background: white;
    color: #1C1917;
    font-weight: 700;
    font-size: 13px;
    padding: 8px 22px;
    border-radius: 50px;
    z-index: 6;
    box-shadow: 0 4px 20px rgba(0,0,0,0.22);
    white-space: nowrap;
    letter-spacing: 0.01em;
}

/* ===================== MENU SECTION ===================== */
.menu-section {
    max-width: 1280px;
    margin: 0 auto;
    padding: 10px 80px 88px;
}
.menu-section-title {
    text-align: center;
    font-size: 36px;
    font-weight: 800;
    color: #F0EDE8;
    margin-bottom: 8px;
}
.menu-section-sub {
    text-align: center;
    font-size: 13px;
    color: rgba(240,237,232,0.35);
    margin-bottom: 32px;
}
.cat-tabs {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 36px;
    flex-wrap: wrap;
}
.cat-tab {
    display: inline-block;
    padding: 8px 24px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    border: 1.5px solid rgba(240,237,232,0.22);
    color: rgba(240,237,232,0.58);
    transition: all 0.15s;
}
.cat-tab:hover { border-color:rgba(240,237,232,0.5);color:rgba(240,237,232,0.85); }
.cat-tab.active { background:white;color:#1C1917;border-color:white;font-weight:600; }

.menu-grid {
    display: grid;
    grid-template-columns: repeat(4,1fr);
    gap: 18px;
    position: relative;
    left: -60px;
}
.mcard {
    background: #1E1C19;
    border-radius: 18px;
    overflow: hidden;
    text-decoration: none;
    display: block;
    border: 1px solid #2C2A26;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    width: 302px;
    height: 412px;
}
.mcard:hover { transform:translateY(-5px);box-shadow:0 14px 36px rgba(0,0,0,0.35); }
.mcard-img { width:100%;aspect-ratio:1/1;overflow:hidden; }
.mcard-img img { width:100%;height:100%;object-fit:cover;transition:transform 0.35s ease; }
.mcard:hover .mcard-img img { transform:scale(1.07); }
.mcard-body { padding:16px 16px 20px; }
.mcard-name { font-size:15px;font-weight:700;color:#F0EDE8;margin-bottom:5px;line-height:1.25; }
.mcard-desc { font-size:12px;color:rgba(240,237,232,0.38);margin-bottom:12px;line-height:1.45; }
.mcard-price { font-size:14px;font-weight:700;color:#DDB892; }

/* ===================== FOOTER ===================== */
.footer-wave { overflow:hidden;line-height:0; }
.footer-body { background:#DDB892;padding:40px 80px 0; }
.footer-inner { max-width:1100px;margin:0 auto;display:flex;justify-content:space-between;align-items:flex-start;gap:40px; }
.footer-logo-text { font-size:16px;font-weight:900;color:#1C1917;letter-spacing:0.16em; }
.si { width:36px;height:36px;border-radius:50%;background:rgba(28,26,23,0.14);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background 0.15s; }
.si:hover { background:rgba(28,26,23,0.26); }
.footer-bottom { max-width:1100px;margin:28px auto 0;padding:16px 0 22px;border-top:1px solid rgba(28,26,23,0.15);display:flex;justify-content:space-between;align-items:center; }
</style>
@endpush

@section('content')

{{-- =================== HERO =================== --}}
<section>
<div class="hero-wrap">

    {{-- Left text --}}
    <div style="flex:1;max-width:440px;">
        <h1 class="hero-title">
            A <span class="accent">Calmer</span><br>
            Space to Order<br>
            and <span class="accent">Linger</span>
        </h1>
        <p class="hero-sub">
            Everything stays gentle and unhurried, leaving more room
            for comfort, conversation, and coffee.
        </p>
        <a href="#menu" class="hero-btn">Order Now</a>
    </div>

    {{-- Right: bean circle --}}
    <div class="bean-circle-wrap">

        {{-- Floating beans outside --}}
        <div class="fbean" style="width:26px;height:17px;top:-6px;right:68px;animation-duration:6.8s;--rot:20deg;--rot2:34deg;"></div>
        <div class="fbean" style="width:18px;height:12px;top:28px;right:-8px;animation-duration:8.5s;animation-delay:1.1s;--rot:58deg;--rot2:72deg;"></div>
        <div class="fbean" style="width:22px;height:15px;top:120px;right:-22px;animation-duration:7.2s;animation-delay:0.4s;--rot:95deg;--rot2:110deg;"></div>
        <div class="fbean" style="width:25px;height:17px;bottom:38px;right:-14px;animation-duration:9.1s;animation-delay:2.2s;--rot:140deg;--rot2:154deg;"></div>
        <div class="fbean" style="width:20px;height:13px;bottom:-4px;right:90px;animation-duration:7.8s;animation-delay:0.9s;--rot:200deg;--rot2:214deg;"></div>
        <div class="fbean" style="width:16px;height:11px;top:14px;left:-8px;animation-duration:8s;animation-delay:1.8s;--rot:305deg;--rot2:318deg;"></div>

        {{-- Main circle --}}
        <div class="bean-circle">
            @php
                // Render beans filling the circle in rings
                $cx = 185; $cy = 185;

                // Ring 1 (outermost) - right at edge
                $r1 = 158; $n1 = 26;
                // Ring 2
                $r2 = 120; $n2 = 20;
                // Ring 3
                $r3 = 80;  $n3 = 13;

                $allBeans = [];
                foreach([[$r1,$n1,30,20,0],[$r2,$n2,24,16,7],[$r3,$n3,18,12,14]] as [$r,$n,$maxSz,$minSz,$off]){
                    for($i=0;$i<$n;$i++){
                        $angle = ($i/$n)*360 + $off;
                        $rad = deg2rad($angle);
                        $bx = $cx + $r * cos($rad);
                        $by = $cy + $r * sin($rad);
                        $sz = rand($minSz,$maxSz);
                        // Vary brown shades
                        $browns = [
                            'radial-gradient(ellipse at 38% 32%, #8B5E30 0%, #5A3518 45%, #3A2010 80%)',
                            'radial-gradient(ellipse at 38% 32%, #7A5028 0%, #4E3018 50%, #2C1A0A 80%)',
                            'radial-gradient(ellipse at 38% 32%, #6B4420 0%, #422810 50%, #261408 80%)',
                            'radial-gradient(ellipse at 38% 32%, #5A3818 0%, #381E08 50%, #1E1006 80%)',
                        ];
                        $bg = $browns[array_rand($browns)];
                        $allBeans[] = compact('bx','by','sz','angle','bg');
                    }
                }
            @endphp

            @foreach($allBeans as $b)
                @php
                    $w = $b['sz'];
                    $h = round($b['sz'] * 0.65);
                    $l = round($b['bx'] - $w/2);
                    $t = round($b['by'] - $h/2);
                @endphp
                <div class="rbean" style="
                    width:{{$w}}px;height:{{$h}}px;
                    left:{{$l}}px;top:{{$t}}px;
                    transform:rotate({{round($b['angle'])}}deg);
                    background:{{$b['bg']}};
                    z-index:1;
                "></div>
            @endforeach

            {{-- Center cappuccino photo --}}
            <div class="center-img">
                <img src="https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=600&q=90" alt="Cappuccino">
            </div>
        </div>

        {{-- Badges --}}
        <div class="circle-badge" style="top:-15px;left:50%;transform:translateX(-50%);">Cappuccino</div>
        <div class="circle-badge" style="bottom:-14px;right:46px;">28K</div>

    </div>

</div>
</section>

{{-- =================== MENU =================== --}}
<section id="menu">
<div class="menu-section">
    <h2 class="menu-section-title">What's on the Menu</h2>
    <p class="menu-section-sub">Good things are worth lingering over.</p>

    <div class="cat-tabs">
        @foreach($categories as $cat)
            <a href="{{ route('user.menu.index', ['category'=>$cat]) }}"
               class="cat-tab {{ $active===$cat?'active':'' }}">{{ $cat }}</a>
        @endforeach
    </div>

    <div class="menu-grid">
        @foreach($items as $item)
        <a href="{{ route('user.menu.show', $item['slug']) }}" class="mcard">
            <div class="mcard-img">
                <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}">
            </div>
            <div class="mcard-body">
                <div class="mcard-name">{{ $item['name'] }}</div>
                <div class="mcard-desc">{{ $item['desc'] }}</div>
                <div class="mcard-price">Rp {{ number_format($item['price'],0,',','.') }}</div>
            </div>
        </a>
        @endforeach
    </div>
</div>
</section>

{{-- =================== FOOTER =================== --}}
<footer>

    {{-- Wave --}}
    <div style="line-height:0;overflow:hidden;background:#DDB892;">
        <svg viewBox="0 0 1440 90" preserveAspectRatio="none"
             style="width:100%;height:90px;display:block;"
             xmlns="http://www.w3.org/2000/svg">
            <path d="
                M0,45
                C120,90 240,0  400,40
                C520,70 600,10 720,45
                C840,80 960,5  1100,38
                C1220,65 1340,15 1440,45
                L1440,0 L0,0 Z
            " fill="#1C1A17"/>
        </svg>
    </div>

    {{-- Footer body --}}
    <div style="background:#DDB892;padding:40px 80px 0;">
        <div style="max-width:1200px;margin:0 auto;display:flex;align-items:flex-start;justify-content:space-between;">

            {{-- LEFT: Logo + socials --}}
            <div>
                {{-- Logo --}}
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:22px;">
                    <svg width="42" height="42" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Cup body -->
                        <path d="M20 4C13 4 7.5 9 7.5 15.5C7.5 18.5 8.7 21.2 10.8 23.2L9.5 34H30.5L29.2 23.2C31.3 21.2 32.5 18.5 32.5 15.5C32.5 9 27 4 20 4Z" fill="#1C1A17"/>
                        <!-- Steam lines -->
                        <path d="M15 8.5C15 8.5 13 12.5 15 15.5C17 18.5 15 22 15 22" stroke="#C8956A" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M20 6.5C20 6.5 18 10.5 20 13.5C22 16.5 20 20 20 20" stroke="#C8956A" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M25 8.5C25 8.5 23 12.5 25 15.5C27 18.5 25 22 25 22" stroke="#C8956A" stroke-width="1.5" stroke-linecap="round"/>
                        <!-- Cup base -->
                        <path d="M9.5 34H30.5L30 36.2C30 37.3 29 38.2 27.9 38.2H12.1C11 38.2 10 37.3 10 36.2L9.5 34Z" fill="#1C1A17"/>
                        <!-- Heart on cup -->
                        <path d="M17.5 17C17.5 17 16 15.5 16 14.5C16 13.5 16.8 12.8 17.5 13.5C18.2 12.8 19 13.5 19 14.5C19 15.5 17.5 17 17.5 17Z" fill="#C8956A"/>
                    </svg>
                    <span style="font-size:17px;font-weight:900;color:#1C1A17;letter-spacing:0.14em;font-family:'Inter',sans-serif;">MAU KOPI</span>
                </div>

                {{-- Social icons --}}
                <div style="display:flex;gap:10px;">

                    {{-- Instagram --}}
                    <div style="width:38px;height:38px;border-radius:50%;background:rgba(28,26,23,0.12);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background 0.15s;"
                         onmouseover="this.style.background='rgba(28,26,23,0.22)'"
                         onmouseout="this.style.background='rgba(28,26,23,0.12)'">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                             stroke="#1C1A17" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </div>

                    {{-- WhatsApp --}}
                    <div style="width:38px;height:38px;border-radius:50%;background:rgba(28,26,23,0.12);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background 0.15s;"
                         onmouseover="this.style.background='rgba(28,26,23,0.22)'"
                         onmouseout="this.style.background='rgba(28,26,23,0.12)'">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                             stroke="#1C1A17" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                        </svg>
                    </div>

                    {{-- X (Twitter) --}}
                    <div style="width:38px;height:38px;border-radius:50%;background:rgba(28,26,23,0.12);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background 0.15s;"
                         onmouseover="this.style.background='rgba(28,26,23,0.22)'"
                         onmouseout="this.style.background='rgba(28,26,23,0.12)'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#1C1A17">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.253 5.622 5.912-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </div>

                    {{-- TikTok --}}
                    <div style="width:38px;height:38px;border-radius:50%;background:rgba(28,26,23,0.12);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background 0.15s;"
                         onmouseover="this.style.background='rgba(28,26,23,0.22)'"
                         onmouseout="this.style.background='rgba(28,26,23,0.12)'">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="#1C1A17">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.96a8.19 8.19 0 0 0 4.79 1.52V7.01a4.85 4.85 0 0 1-1.02-.32z"/>
                        </svg>
                    </div>

                </div>
            </div>

            {{-- RIGHT: Address + Hours --}}
            <div style="display:flex;gap:80px;padding-top:4px;">

                <div>
                    <div style="font-size:15px;font-weight:700;color:#1C1A17;margin-bottom:14px;font-family:'Inter',sans-serif;">Address</div>
                    <div style="font-size:14px;color:rgba(28,26,23,0.65);line-height:1.75;font-family:'Inter',sans-serif;">
                        22 Jalan Tanimbar, Malang,<br>
                        East Java, Indonesia
                    </div>
                </div>

                <div>
                    <div style="font-size:15px;font-weight:700;color:#1C1A17;margin-bottom:14px;font-family:'Inter',sans-serif;">Hours</div>
                    <div style="font-size:14px;color:rgba(28,26,23,0.65);line-height:1.75;font-family:'Inter',sans-serif;">
                        Monday – Saturday<br>
                        09.00 - 17.00
                    </div>
                </div>

            </div>
        </div>

        {{-- Divider + bottom bar --}}
        <div style="max-width:1200px;margin:36px auto 0;padding:18px 0 24px;border-top:1px solid rgba(28,26,23,0.18);display:flex;align-items:center;justify-content:space-between;">
            <span style="font-size:12px;color:rgba(28,26,23,0.5);font-family:'Inter',sans-serif;">
                Copyright © 2025. All rights reserved.
            </span>
            <div style="display:flex;gap:24px;">
                <a href="#" style="font-size:12px;color:rgba(28,26,23,0.5);text-decoration:none;font-family:'Inter',sans-serif;transition:color 0.15s;"
                   onmouseover="this.style.color='#1C1A17'"
                   onmouseout="this.style.color='rgba(28,26,23,0.5)'">Terms & Conditions</a>
                <a href="#" style="font-size:12px;color:rgba(28,26,23,0.5);text-decoration:none;font-family:'Inter',sans-serif;transition:color 0.15s;"
                   onmouseover="this.style.color='#1C1A17'"
                   onmouseout="this.style.color='rgba(28,26,23,0.5)'">Privacy Policy</a>
            </div>
        </div>
    </div>

</footer>


@endsection
