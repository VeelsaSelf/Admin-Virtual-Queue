<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mau Kopi — @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F1EC] font-sans" x-data="appLayout()">

<!-- ── Overlay for modals ── -->
<div
    x-show="showSignOut || showNotifications"
    x-transition:enter="transition duration-150"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="showSignOut = false; showNotifications = false"
    class="fixed inset-0 bg-black/20 backdrop-blur-[2px] z-30"
    style="display:none;"
></div>

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-[238px] flex-shrink-0 bg-[#FAFAF8] border-r border-[#EDE0C8] flex flex-col">

        <div class="flex items-center gap-2.5 px-6 pt-7 pb-8">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="28" height="28" rx="7" fill="#8B5E1A"/>
                <path d="M14 6C10.134 6 7 9.134 7 13C7 16.866 10.134 20 14 20C17.866 20 21 16.866 21 13C21 9.134 17.866 6 14 6ZM14 8C16.761 8 19 10.239 19 13C19 15.761 16.761 18 14 18C11.239 18 9 15.761 9 13C9 10.239 11.239 8 14 8Z" fill="white"/>
                <path d="M14 10C14 10 12 11.5 12 13C12 14.105 12.895 15 14 15C15.105 15 16 14.105 16 13C16 11.5 14 10 14 10Z" fill="white"/>
            </svg>
            <span class="font-display font-bold text-[18px] tracking-tight text-[#3d2609]">MAU KOPI</span>
        </div>

        <nav class="flex-1 px-3 space-y-0.5">
            @php
                $currentRoute = request()->routeIs('dashboard') ? 'dashboard'
                    : (request()->routeIs('orders') ? 'orders'
                    : (request()->routeIs('payments') ? 'payments'
                    : (request()->routeIs('menu-management') ? 'menu-management'
                    : ((request()->routeIs('staff-management') || request()->routeIs('staff-edit') || request()->routeIs('staff-add')) ? 'staff-management'
                    : (request()->routeIs('sales-report') ? 'sales-report' : 'dashboard')))));
            @endphp

            <x-nav-item route="dashboard" :active="$currentRoute === 'dashboard'" label="Dashboard">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><rect x="2" y="2" width="7" height="7" rx="2" fill="currentColor"/><rect x="11" y="2" width="7" height="7" rx="2" fill="currentColor"/><rect x="2" y="11" width="7" height="7" rx="2" fill="currentColor"/><rect x="11" y="11" width="7" height="7" rx="2" fill="currentColor"/></svg>
            </x-nav-item>
            <x-nav-item route="orders" :active="$currentRoute === 'orders'" label="Orders">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.6"/><path d="M6.5 10h7M10 6.5v7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            </x-nav-item>
            <x-nav-item route="payments" :active="$currentRoute === 'payments'" label="Payments">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><rect x="2" y="5" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M2 9h16" stroke="currentColor" stroke-width="1.6"/><rect x="5" y="12" width="4" height="2" rx="0.5" fill="currentColor"/></svg>
            </x-nav-item>
            <x-nav-item route="menu-management" :active="$currentRoute === 'menu-management'" label="Menu Management">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="6" r="3" stroke="currentColor" stroke-width="1.6"/><path d="M4 17c0-3.314 2.686-6 6-6s6 2.686 6 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            </x-nav-item>
            <x-nav-item route="staff-management" :active="$currentRoute === 'staff-management'" label="Staff Management">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><circle cx="7.5" cy="6" r="2.5" stroke="currentColor" stroke-width="1.6"/><circle cx="13" cy="6" r="2.5" stroke="currentColor" stroke-width="1.6"/><path d="M2 17c0-3.038 2.462-5.5 5.5-5.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M9 17c0-2.761 1.79-5.118 4.25-5.43C16.134 11.853 18 14.21 18 17" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            </x-nav-item>
            <x-nav-item route="sales-report" :active="$currentRoute === 'sales-report'" label="Sales Report">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><rect x="3" y="3" width="14" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M6 13l3-3 2 2 3-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </x-nav-item>
        </nav>

        <div class="px-3 pb-6">
            <button
                @click="showSignOut = true"
                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-[#c0392b] hover:bg-red-50 transition-colors text-sm font-medium"
            >
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none"><path d="M7 3H4a1 1 0 00-1 1v12a1 1 0 001 1h3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M13 14l3-4-3-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 10H8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                Sign Out
            </button>
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- TOP HEADER -->
        <header class="h-[80px] bg-[#FAFAF8] border-b border-[#EDE0C8] flex items-center justify-between px-8 flex-shrink-0">
            <div>
                <h1 class="font-display font-bold text-[26px] text-[#2c1a06] leading-tight">@yield('page-title', 'Dashboard')</h1>
                <p class="text-sm text-gray-400 font-normal mt-0.5">@yield('page-subtitle', 'View and download sales summary by period')</p>
            </div>

            <div class="flex items-center gap-4">
                <!-- Bell -->
                <div class="relative">
                    <button
                        @click.stop="showNotifications = !showNotifications; showSignOut = false"
                        class="relative w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#F0DEC8] transition-colors"
                    >
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 2a6 6 0 00-6 6v3l-1.5 2.5h15L16 11V8a6 6 0 00-6-6z" stroke="#555" stroke-width="1.5"/><path d="M8 15a2 2 0 004 0" stroke="#555" stroke-width="1.5"/></svg>
                        <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-[#3B82F6] rounded-full border-2 border-[#FAFAF8]"></span>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div
                        x-show="showNotifications"
                        x-transition:enter="transition duration-150 ease-out"
                        x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition duration-100 ease-in"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                        @click.stop
                        class="absolute right-0 top-[calc(100%+8px)] w-[340px] bg-white rounded-2xl shadow-modal z-40 overflow-hidden"
                        style="display:none;"
                    >
                        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                            <span class="font-semibold text-[15px] text-gray-800">All Notification</span>
                            <button @click="showNotifications = false" class="w-6 h-6 flex items-center justify-center text-gray-400 hover:text-gray-600 rounded">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 2l10 10M12 2L2 12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                            </button>
                        </div>
                        <div class="divide-y divide-gray-50">
                            @include('components.notification-item', ['icon'=>'clock','title'=>'Shift Ending Soon','desc'=>'Your shift will end in 15 minutes. Please finish any pending tasks.','unread'=>true])
                            @include('components.notification-item', ['icon'=>'chef','title'=>'Item Out of Stock','desc'=>'Chicken Teriyaki Bowl is currently out of stock and cannot be added to the order.','unread'=>true])
                            @include('components.notification-item', ['icon'=>'order','title'=>'New Order Received','desc'=>'A new order has been placed and is waiting to be processed.','unread'=>true])
                            @include('components.notification-item', ['icon'=>'payment','title'=>'Payment Confirmation Required','desc'=>'A payment has been submitted and needs verification.','unread'=>true])
                        </div>
                    </div>
                </div>

                <!-- ✅ USER CHIP — click langsung ke Edit Profile -->
                <a href="{{ route('edit-profile') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-2xl border border-[#EDE0C8] bg-[#FAFAF8] hover:bg-[#F0DEC8] transition-colors"
                   style="text-decoration:none; cursor:pointer;">
                    <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0 ring-2 ring-[#EDE0C8]">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8YXZhdGFyfGVufDB8fDB8fHww"
                             alt="Miguela" class="w-full h-full object-cover">
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-800 leading-none">Miguela Veloso</p>
                        <p class="text-xs text-gray-400 mt-0.5">Cashier</p>
                    </div>
                </a>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 overflow-y-auto scrollbar-thin p-6">
            @yield('content')
        </main>
    </div>
</div>

<!-- SIGN OUT MODAL -->
<div
    x-show="showSignOut"
    x-transition:enter="transition duration-150 ease-out"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition duration-100 ease-in"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    @click.stop
    class="fixed inset-0 flex items-center justify-center z-50 pointer-events-none"
    style="display:none;"
>
    <div class="bg-white rounded-2xl shadow-modal w-[400px] p-8 pointer-events-auto text-center">
        <div class="w-14 h-14 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
            <svg width="24" height="24" viewBox="0 0 20 20" fill="none"><path d="M7 3H4a1 1 0 00-1 1v12a1 1 0 001 1h3" stroke="#e74c3c" stroke-width="1.8" stroke-linecap="round"/><path d="M13 14l3-4-3-4" stroke="#e74c3c" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 10H8" stroke="#e74c3c" stroke-width="1.8" stroke-linecap="round"/></svg>
        </div>
        <h2 class="font-display font-bold text-[20px] text-gray-800 mb-2">Sign Out</h2>
        <p class="text-sm text-gray-500 leading-relaxed mb-6">Are you sure you want to sign out of your account?<br>You can sign back in anytime.</p>
        <div class="flex gap-3">
            <button @click="showSignOut = false"
                class="flex-1 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition-colors"
            >Cancel</button>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit"
                    class="w-full py-2.5 rounded-xl bg-[#c0392b] text-white text-sm font-semibold hover:bg-red-700 transition-colors"
                >Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script>
function appLayout() {
    return {
        showNotifications: false,
        showSignOut: false,
    }
}
</script>
</body>
</html>