<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight tracking-tight flex items-center gap-2">
                <span class="text-3xl">💻</span> {{ __('Dashboard Kasir / POS') }}
            </h2>
            <div class="flex items-center gap-2 text-sm font-medium text-gray-500 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Auto-Refresh Aktif
            </div>
        </div>
    </x-slot>

    <!-- Auto Refresh setiap 10 detik agar pesanan baru otomatis muncul -->
    <meta http-equiv="refresh" content="10">

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm animate-fade-in-down" role="alert">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Pencarian & Filter -->
            <div class="mb-8 bg-white p-5 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-4">
                <form action="{{ route('kasir.orders.index') }}" method="GET" class="w-full flex items-center gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="nomor_meja" id="nomor_meja" value="{{ request('nomor_meja') }}" placeholder="Cari berdasarkan Nomor Meja..." class="w-full pl-11 pr-4 py-3 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all sm:text-sm font-medium text-gray-900 placeholder-gray-400">
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-xl shadow-sm transition-colors">
                        Cari
                    </button>
                    @if(request('nomor_meja'))
                        <a href="{{ route('kasir.orders.index') }}" class="py-3 px-4 text-gray-500 hover:text-gray-800 font-medium hover:bg-gray-100 rounded-xl transition-colors">Reset</a>
                    @endif
                </form>
            </div>

            <!-- Grid Order Tickets -->
            @if($orders->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-[2rem] p-6 shadow-sm border {{ $order->status == 'Menunggu Konfirmasi' ? 'border-amber-200 shadow-[0_0_15px_rgba(251,191,36,0.1)]' : 'border-gray-100' }} hover:-translate-y-1 hover:shadow-md transition-all duration-300 flex flex-col relative overflow-hidden group">
                            
                            <!-- Aksen warna atas -->
                            <div class="absolute top-0 left-0 w-full h-1.5 {{ $order->status == 'Menunggu Konfirmasi' ? 'bg-amber-400' : 'bg-emerald-400' }}"></div>

                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Order ID</span>
                                    <span class="text-xl font-black text-gray-900">#{{ $order->id }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Meja</span>
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-50 text-indigo-700 font-bold text-sm">
                                        {{ $order->table->nomor_meja ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-5">
                                @if($order->status == 'Menunggu Konfirmasi')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-xs font-bold border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Perlu Pembayaran
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> {{ $order->status }}
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-3 mb-6 flex-1">
                                <div class="flex items-center gap-3 text-sm text-gray-600">
                                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-400">Waktu Masuk</span>
                                        <span class="font-semibold text-gray-800">{{ $order->created_at->format('H:i') }} <span class="text-xs font-normal">WIB</span></span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-3 text-sm text-gray-600">
                                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-400">Total Tagihan</span>
                                        <span class="font-black text-rose-600 text-lg leading-none mt-0.5">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('kasir.orders.show', $order->id) }}" class="w-full inline-flex justify-center items-center gap-2 py-3 mt-auto bg-indigo-50 hover:bg-indigo-600 text-indigo-700 hover:text-white text-sm font-bold rounded-xl transition-colors group-hover:shadow-md">
                                @if($order->status == 'Menunggu Konfirmasi')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Proses Pembayaran
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    Selesaikan Pesanan
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-[2rem] p-12 shadow-sm border border-gray-100 text-center flex flex-col items-center justify-center">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <span class="text-4xl">😴</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Kasir Sedang Sepi</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Saat ini tidak ada pesanan aktif dari meja manapun. Pesanan baru akan otomatis muncul di sini begitu pelanggan menekan tombol checkout.</p>
                </div>
            @endif

        </div>
    </div>
</x-admin-layout>
