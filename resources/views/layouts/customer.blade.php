<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Pizza Ibu App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            /* Hide scrollbar for mobile app feel */
            ::-webkit-scrollbar { width: 0px; background: transparent; }
            .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        </style>
    </head>
    <body class="font-['Inter'] antialiased text-slate-900 bg-slate-200 selection:bg-orange-500 selection:text-white">
        <!-- Mobile App Container -->
        <div class="max-w-md mx-auto min-h-screen bg-slate-50 shadow-2xl relative flex flex-col overflow-x-hidden">
            
            <!-- Sticky App Header -->
            @isset($header)
                <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm">
                    <div class="px-5 py-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Main Scrollable Content -->
            <main class="flex-1 pb-28">
                {{ $slot }}
            </main>

            <!-- Bottom Navigation Bar (App like) -->
            <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white border-t border-slate-100 pb-safe z-50 rounded-t-3xl shadow-[0_-10px_40px_rgba(0,0,0,0.05)]">
                <div class="flex justify-around items-center h-20 px-6">
                    <a href="{{ route('customer.catalog') }}" class="flex flex-col items-center justify-center w-16 h-full gap-1.5 transition-colors {{ request()->routeIs('customer.catalog') ? 'text-orange-500' : 'text-slate-400 hover:text-slate-600' }}">
                        <svg class="w-6 h-6" fill="{{ request()->routeIs('customer.catalog') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span class="text-[11px] font-bold">Menu</span>
                    </a>
                    
                    <a href="{{ route('customer.cart') }}" class="flex flex-col items-center justify-center w-16 h-full gap-1.5 relative transition-colors {{ request()->routeIs('customer.cart') || request()->routeIs('customer.checkout') ? 'text-orange-500' : 'text-slate-400 hover:text-slate-600' }}">
                        <svg class="w-6 h-6" fill="{{ request()->routeIs('customer.cart') || request()->routeIs('customer.checkout') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span class="text-[11px] font-bold">Pesanan</span>
                        @if(session()->has('cart') && collect(session('cart'))->sum('qty') > 0)
                            <span class="absolute top-3 right-3 flex h-3 w-3">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-white"></span>
                            </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
