<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight tracking-tight">
            {{ __('Overview') }}
        </h2>
    </x-slot>

    <!-- Main Background: Sangat bersih, abu-abu super muda -->
    <div class="py-8 bg-[#f8fafc] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Modern Premium Banner -->
            <div class="relative bg-white rounded-[2rem] p-8 md:p-12 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/80 overflow-hidden">
                <!-- Soft Glowing Orbs (Sleek Glassmorphism effect) -->
                <div class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-orange-400/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-[20rem] h-[20rem] bg-rose-400/10 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="w-full md:w-2/3">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-100 text-orange-600 text-xs font-semibold uppercase tracking-widest mb-6">
                            <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                            Live Dashboard
                        </div>
                        <h3 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight leading-tight">
                            Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-rose-500">{{ Auth::user()->name }}</span>
                        </h3>
                        <p class="text-gray-500 text-lg md:text-xl font-medium leading-relaxed max-w-2xl">
                            Pantau performa bisnis <strong class="text-gray-800 font-bold">Pizza Ibu</strong> hari ini secara real-time. Semua metrik penting tersaji di ujung jari Anda.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stats Grid: Sleek & Minimalist -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Card 1: Pesanan -->
                <div class="bg-white rounded-3xl p-6 shadow-[0_2px_15px_rgb(0,0,0,0.02)] border border-gray-100 hover:shadow-[0_8px_25px_rgb(0,0,0,0.06)] hover:-translate-y-0.5 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400">Pesanan Hari Ini</p>
                            <p class="text-xs font-medium text-orange-500">Real-time</p>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <p class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $pesananHariIni }}</p>
                        <span class="text-sm font-medium text-gray-400">order</span>
                    </div>
                </div>

                <!-- Card 2: Omzet -->
                <div class="bg-white rounded-3xl p-6 shadow-[0_2px_15px_rgb(0,0,0,0.02)] border border-gray-100 hover:shadow-[0_8px_25px_rgb(0,0,0,0.06)] hover:-translate-y-0.5 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400">Total Omzet</p>
                            <p class="text-xs font-medium text-emerald-500">Hari Ini</p>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-1">
                        <span class="text-lg font-bold text-gray-400">Rp</span>
                        <p class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($omzetHariIni, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Card 3: Menu -->
                <div class="bg-white rounded-3xl p-6 shadow-[0_2px_15px_rgb(0,0,0,0.02)] border border-gray-100 hover:shadow-[0_8px_25px_rgb(0,0,0,0.06)] hover:-translate-y-0.5 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400">Varian Menu</p>
                            <p class="text-xs font-medium text-rose-500">Aktif</p>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <p class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $totalMenu }}</p>
                        <span class="text-sm font-medium text-gray-400">item</span>
                    </div>
                </div>

                <!-- Card 4: Meja -->
                <div class="bg-white rounded-3xl p-6 shadow-[0_2px_15px_rgb(0,0,0,0.02)] border border-gray-100 hover:shadow-[0_8px_25px_rgb(0,0,0,0.06)] hover:-translate-y-0.5 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400">Kapasitas Meja</p>
                            <p class="text-xs font-medium text-indigo-500">Tersedia</p>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <p class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $totalMeja }}</p>
                        <span class="text-sm font-medium text-gray-400">unit</span>
                    </div>
                </div>

            </div>

            <!-- Recent Orders Section (Sleek Minimalist) -->
            <div class="bg-white rounded-[2rem] shadow-[0_4px_25px_rgb(0,0,0,0.03)] border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 flex flex-col md:flex-row justify-between items-center border-b border-gray-50/50">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 tracking-tight">Pesanan Terbaru</h3>
                        <p class="text-sm text-gray-400 font-medium mt-1">Daftar transaksi yang baru saja diproses</p>
                    </div>
                    <a href="{{ route('kasir.orders.index') }}" class="mt-4 md:mt-0 text-sm font-semibold text-gray-700 bg-gray-50 hover:bg-gray-100 border border-gray-200 px-5 py-2.5 rounded-xl transition-all duration-200">
                        Lihat Semua Transaksi
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white text-xs text-gray-400 uppercase tracking-widest font-semibold border-b border-gray-100">
                                <th class="py-5 px-8">ID Order</th>
                                <th class="py-5 px-8">Waktu</th>
                                <th class="py-5 px-8">Meja</th>
                                <th class="py-5 px-8">Nominal</th>
                                <th class="py-5 px-8 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 divide-y divide-gray-50/80">
                            @forelse($pesananTerbaru as $order)
                            <tr class="hover:bg-gray-50/50 transition-colors duration-200 group">
                                <td class="py-5 px-8 font-bold text-gray-900">#{{ $order->id }}</td>
                                <td class="py-5 px-8 font-medium text-gray-500">{{ $order->created_at->diffForHumans() }}</td>
                                <td class="py-5 px-8">
                                    <div class="inline-flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-orange-400 transition-colors"></div>
                                        <span class="font-bold text-gray-700">{{ $order->table->nomor_meja ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="py-5 px-8 font-extrabold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td class="py-5 px-8 text-right">
                                    @if($order->status == 'Menunggu Konfirmasi')
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-amber-50 text-amber-600 border border-amber-100">Baru Masuk</span>
                                    @elseif(str_contains($order->status, 'Lunas'))
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">Dibayar</span>
                                    @elseif($order->status == 'Selesai')
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">Selesai</span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-gray-50 text-gray-600 border border-gray-200">{{ $order->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 px-8 text-center">
                                    <div class="inline-flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-16 h-16 mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        <span class="text-sm font-medium">Belum ada pesanan yang masuk.</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
