<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 leading-tight tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Modern Premium Banner - Pizza Theme -->
            <div class="relative bg-slate-900 rounded-[2.5rem] p-8 md:p-12 shadow-2xl overflow-hidden border border-slate-800">
                <!-- Abstract Pizza Theme Glows -->
                <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-orange-500/20 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-[30rem] h-[30rem] bg-red-500/20 rounded-full blur-[100px] translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>
                
                <!-- Pattern Overlay -->
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fb923c 1px, transparent 1px); background-size: 24px 24px;"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="w-full md:w-2/3">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-500/20 border border-orange-500/30 text-orange-400 text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-sm">
                            <span class="relative flex h-2 w-2">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                            </span>
                            Live System Aktif
                        </div>
                        <h3 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tight leading-tight">
                            Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-500">{{ Auth::user()->name }}</span> 🍕
                        </h3>
                        <p class="text-slate-300 text-lg md:text-xl font-medium leading-relaxed max-w-2xl">
                            Selamat datang di pusat kendali <strong class="text-white font-bold">Pizza Ibu</strong>. Pantau pesanan, omzet, dan ketersediaan meja secara real-time.
                        </p>
                    </div>
                    
                    <div class="hidden md:block w-1/3 text-right relative">
                         <!-- Decorative Element -->
                         <div class="w-48 h-48 mx-auto bg-gradient-to-br from-orange-400 to-red-500 rounded-full flex items-center justify-center shadow-lg shadow-orange-500/30 animate-[spin_60s_linear_infinite]">
                             <div class="w-44 h-44 bg-slate-900 rounded-full flex items-center justify-center">
                                 <svg class="w-20 h-20 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.2 3.2.8-1.3-4.5-2.7V7z"/></svg>
                             </div>
                         </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Card 1: Pesanan -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600 group-hover:scale-110 transition-transform">
                            <!-- Pizza Slice Icon -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 21C11.5 21 4.5 11 4.5 7C4.5 3 11.5 3 11.5 3C11.5 3 18.5 3 18.5 7C18.5 11 11.5 21 11.5 21ZM11.5 8.5C11.5 8.5 11.5 8.5 11.5 8.5ZM9 12C9 12 9 12 9 12ZM14 12C14 12 14 12 14 12Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </div>
                        <span class="px-2.5 py-1 text-xs font-bold text-orange-600 bg-orange-100 rounded-lg">Hari Ini</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-500 mb-1">Total Pesanan</p>
                        <div class="flex items-baseline gap-2">
                            <p class="text-4xl font-black text-slate-900 tracking-tight">{{ $pesananHariIni }}</p>
                            <span class="text-sm font-medium text-slate-400">box</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Omzet -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-emerald-500/10 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                            <!-- Cash Icon -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="px-2.5 py-1 text-xs font-bold text-emerald-600 bg-emerald-100 rounded-lg">Real-time</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-500 mb-1">Pendapatan</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-lg font-bold text-slate-400">Rp</span>
                            <p class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($omzetHariIni, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Menu -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-rose-500/10 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-rose-100 flex items-center justify-center text-rose-600 group-hover:scale-110 transition-transform">
                            <!-- Menu Icon -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <span class="px-2.5 py-1 text-xs font-bold text-rose-600 bg-rose-100 rounded-lg">Menu Aktif</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-500 mb-1">Varian Pizza & Minuman</p>
                        <div class="flex items-baseline gap-2">
                            <p class="text-4xl font-black text-slate-900 tracking-tight">{{ $totalMenu }}</p>
                            <span class="text-sm font-medium text-slate-400">item</span>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Meja -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-blue-500/10 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                            <!-- Table Icon -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        <span class="px-2.5 py-1 text-xs font-bold text-blue-600 bg-blue-100 rounded-lg">Kapasitas</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-500 mb-1">Meja Tersedia</p>
                        <div class="flex items-baseline gap-2">
                            <p class="text-4xl font-black text-slate-900 tracking-tight">{{ $totalMeja }}</p>
                            <span class="text-sm font-medium text-slate-400">unit</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-8 py-6 flex flex-col md:flex-row justify-between items-center border-b border-slate-100 bg-slate-50/50">
                    <div>
                        <h3 class="text-xl font-black text-slate-900 tracking-tight">Antrean Pesanan Dapur</h3>
                        <p class="text-sm text-slate-500 font-medium mt-1">Daftar transaksi pelanggan terbaru</p>
                    </div>
                    <a href="{{ route('kasir.orders.index') }}" class="mt-4 md:mt-0 text-sm font-bold text-orange-600 bg-orange-100 hover:bg-orange-200 px-6 py-3 rounded-xl transition-all duration-200 inline-flex items-center gap-2">
                        Kelola Pesanan
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white text-xs text-slate-400 uppercase tracking-widest font-bold border-b border-slate-100">
                                <th class="py-5 px-8">ID Order</th>
                                <th class="py-5 px-8">Waktu</th>
                                <th class="py-5 px-8">Meja</th>
                                <th class="py-5 px-8">Total Nominal</th>
                                <th class="py-5 px-8 text-right">Status Pesanan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            @forelse($pesananTerbaru as $order)
                            <tr class="hover:bg-slate-50 transition-colors duration-200 group cursor-pointer">
                                <td class="py-5 px-8 font-black text-slate-800">
                                    <span class="text-slate-400 group-hover:text-orange-500 transition-colors">#</span>{{ $order->id }}
                                </td>
                                <td class="py-5 px-8 font-medium text-slate-500 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $order->created_at->diffForHumans() }}
                                </td>
                                <td class="py-5 px-8">
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-slate-100 rounded-lg">
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        <span class="font-bold text-slate-700">{{ $order->table->nomor_meja ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="py-5 px-8 font-black text-slate-900">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </td>
                                <td class="py-5 px-8 text-right">
                                    @if($order->status == 'Menunggu Konfirmasi')
                                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Baru
                                        </span>
                                    @elseif(str_contains($order->status, 'Lunas'))
                                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Dibayar
                                        </span>
                                    @elseif($order->status == 'Selesai')
                                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">{{ $order->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-24 px-8 text-center">
                                    <div class="inline-flex flex-col items-center justify-center text-slate-400">
                                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        </div>
                                        <span class="text-base font-bold text-slate-500 mb-1">Belum ada pesanan</span>
                                        <span class="text-sm font-medium">Pesanan dari pelanggan akan muncul di sini.</span>
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
