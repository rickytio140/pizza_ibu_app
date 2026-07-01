<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pizza Ibu - Aplikasi Pemesanan</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,600,700,900&display=swap" rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-slate-50 text-slate-800 selection:bg-emerald-500 selection:text-white font-['Inter']">
        
        <div class="min-h-screen flex flex-col">
            <!-- Navbar -->
            <nav class="p-6 flex items-center justify-between z-10 relative max-w-7xl mx-auto w-full">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-emerald-200">
                        P
                    </div>
                    <span class="font-black text-2xl tracking-tight text-slate-800">Pizza Ibu</span>
                </div>
                
                @if (Route::has('login'))
                    <div class="flex gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-slate-600 hover:text-emerald-500 transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-emerald-500 transition-colors">Log in Admin</a>
                        @endauth
                    </div>
                @endif
            </nav>

            <!-- Hero Section -->
            <main class="flex-1 flex flex-col items-center justify-center p-6 text-center z-10 relative mt-[-80px]">
                
                <!-- Decor circles -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-300/30 rounded-full blur-[100px] -z-10"></div>
                <div class="absolute top-1/2 left-1/3 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-amber-300/30 rounded-full blur-[80px] -z-10"></div>

                <span class="px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 font-bold text-sm tracking-wide mb-6 inline-block ring-1 ring-emerald-200 shadow-sm">
                    🚀 Sistem Pemesanan Restoran
                </span>

                <h1 class="text-6xl md:text-7xl font-black tracking-tight text-slate-900 mb-6 max-w-4xl leading-tight">
                    Nikmati Pizza Lezat <br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-amber-500">Tanpa Antre</span>
                </h1>
                
                <p class="text-lg md:text-xl text-slate-600 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Aplikasi kasir dan pemesanan mandiri untuk pelanggan Pizza Ibu. Silakan pilih portal masuk Anda di bawah ini untuk memulai.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 w-full max-w-2xl justify-center">
                    
                    <!-- Customer Demo Card -->
                    <div class="flex-1 bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 group hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-slate-800">Pelanggan</h3>
                        <p class="text-slate-500 mb-6 text-sm">Simulasikan proses scan QR Code di meja pelanggan untuk memesan.</p>
                        <a href="{{ route('customer.scan', 'MEJA-01') }}" class="block w-full py-3.5 px-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow-md shadow-emerald-200 transition-colors">
                            Scan QR Meja 01
                        </a>
                    </div>

                    <!-- Admin Card -->
                    <div class="flex-1 bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 group hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-slate-800">Kasir / Admin</h3>
                        <p class="text-slate-500 mb-6 text-sm">Masuk sebagai kasir atau admin untuk mengelola menu dan pesanan.</p>
                        <a href="{{ route('login') }}" class="block w-full py-3.5 px-4 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-xl shadow-md transition-colors">
                            Login Portal
                        </a>
                    </div>

                </div>
            </main>
        </div>
        
    </body>
</html>
