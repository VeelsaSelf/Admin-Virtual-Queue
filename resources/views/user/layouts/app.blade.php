<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Mau Kopi' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: {
                            bg:     '#1C1917',
                            card:   '#252220',
                            border: '#3A3733',
                            accent: '#DDB892',
                            muted:  '#7A7570',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: #1C1917; color: #F0EDE8; font-family: 'Inter', sans-serif; min-height: 100vh; overflow-x: hidden; }
        .beans-bg { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
        .bean { position: absolute; border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%; background: radial-gradient(ellipse at 38% 35%, #7A5030 0%, #4A2E14 55%, #2E1A08 100%); opacity: 0.6; animation: floatBean ease-in-out infinite; }
        .bean::after { content: ''; position: absolute; top: 48%; left: 12%; right: 12%; height: 2px; background: rgba(0,0,0,0.35); border-radius: 50%; transform: translateY(-50%) rotate(-8deg); }
        @keyframes floatBean {
            0%   { transform: translateY(0px)   rotate(0deg); }
            30%  { transform: translateY(-14px) rotate(8deg); }
            60%  { transform: translateY(-6px)  rotate(16deg); }
            80%  { transform: translateY(-20px) rotate(10deg); }
            100% { transform: translateY(0px)   rotate(0deg); }
        }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #1C1917; }
        ::-webkit-scrollbar-thumb { background: #3A3733; border-radius: 4px; }
        input[type="radio"]    { accent-color: #DDB892; cursor: pointer; }
        input[type="checkbox"] { accent-color: #DDB892; cursor: pointer; }
        .page-content { position: relative; z-index: 1; }
        .navbar { position: relative; z-index: 10; display: flex; align-items: center; justify-content: space-between; padding: 0 28px; height: 64px; background: #1C1917; border-bottom: 1px solid rgba(58,55,51,0.6); }
        .btn-accent { background: #DDB892; color: #1C1917; font-weight: 700; border-radius: 14px; cursor: pointer; transition: opacity 0.15s; }
        .btn-accent:hover { opacity: 0.88; }
        .btn-outline-accent { border: 1.5px solid #DDB892; color: #DDB892; border-radius: 50px; font-weight: 600; cursor: pointer; transition: all 0.15s; }
        .btn-outline-accent:hover { background: #DDB892; color: #1C1917; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="beans-bg">
        <div class="bean" style="width:62px;height:44px;left:1.5%;top:17%;animation-duration:7.2s;"></div>
        <div class="bean" style="width:46px;height:32px;left:3.5%;top:52%;animation-duration:9.1s;animation-delay:0.8s;"></div>
        <div class="bean" style="width:54px;height:38px;left:2.5%;top:74%;animation-duration:8.3s;animation-delay:1.9s;"></div>
        <div class="bean" style="width:72px;height:52px;right:1.5%;top:14%;animation-duration:10.2s;animation-delay:0.3s;"></div>
        <div class="bean" style="width:50px;height:36px;right:2.5%;top:38%;animation-duration:7.8s;animation-delay:1.4s;"></div>
        <div class="bean" style="width:58px;height:42px;right:1.8%;top:63%;animation-duration:9.4s;animation-delay:2.7s;"></div>
        <div class="bean" style="width:42px;height:30px;right:3.5%;top:81%;animation-duration:8.6s;animation-delay:0.6s;"></div>
    </div>

    <nav class="navbar">
        <a href="{{ route('user.menu.index') }}" class="flex items-center gap-2.5">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                <path d="M18 3C11.4 3 6.5 7.8 6.5 14.2C6.5 17 7.6 19.3 9.4 21.1L8.5 31H27.5L26.6 21.1C28.4 19.3 29.5 17 29.5 14.2C29.5 7.8 24.6 3 18 3Z" fill="white"/>
                <path d="M13.5 7C13.5 7 11.8 10.5 13.5 13C15.2 15.5 13.5 19 13.5 19" stroke="#1C1917" stroke-width="1.4" stroke-linecap="round"/>
                <path d="M18 5.5C18 5.5 16.3 9 18 11.5C19.7 14 18 17.5 18 17.5" stroke="#1C1917" stroke-width="1.4" stroke-linecap="round"/>
                <path d="M22.5 7C22.5 7 20.8 10.5 22.5 13C24.2 15.5 22.5 19 22.5 19" stroke="#1C1917" stroke-width="1.4" stroke-linecap="round"/>
                <path d="M8.5 31H27.5L27 32.8C27 33.8 26.1 34.5 25.1 34.5H10.9C9.9 34.5 9 33.8 9 32.8L8.5 31Z" fill="white"/>
            </svg>
            <span class="text-white font-bold tracking-[0.18em] text-[15px] uppercase">Mau Kopi</span>
        </a>
        <div class="flex items-center gap-1">
            <button class="w-10 h-10 flex items-center justify-center text-white/60 hover:text-white transition-colors rounded-full">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </button>
            <a href="{{ route('user.cart.index') }}" class="relative w-10 h-10 flex items-center justify-center text-white/60 hover:text-white transition-colors rounded-full">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                @php $cnt = $cartCount ?? 0; @endphp
                @if($cnt > 0)
                    <span class="absolute top-0.5 right-0.5 w-4 h-4 rounded-full text-[10px] font-bold flex items-center justify-center" style="background:#DDB892;color:#1C1917;">{{ $cnt }}</span>
                @endif
            </a>
        </div>
    </nav>

    <main class="page-content">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>