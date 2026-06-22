<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight tracking-tight flex items-center gap-2">
                <span class="text-3xl">📈</span> {{ __('Laporan Penjualan') }}
            </h2>
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-sm font-bold rounded-xl shadow-sm transition-all duration-200 print:hidden">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan
            </button>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Card 1: Total Transaksi -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-6 group hover:-translate-y-1 transition-transform">
                    <div class="w-20 h-20 rounded-[1.5rem] bg-gradient-to-br from-blue-100 to-indigo-100 text-indigo-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Transaksi Selesai</p>
                        <h3 class="text-4xl font-black text-gray-900">{{ $orders->count() }} <span class="text-lg font-bold text-gray-400">Order</span></h3>
                    </div>
                </div>

                <!-- Card 2: Total Pendapatan -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-6 group hover:-translate-y-1 transition-transform">
                    <div class="w-20 h-20 rounded-[1.5rem] bg-gradient-to-br from-emerald-100 to-teal-100 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Total Pendapatan</p>
                        <h3 class="text-4xl font-black text-emerald-500 tracking-tight">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white p-5 rounded-[2rem] shadow-sm border border-gray-100 mb-8 print:hidden">
                <form action="{{ route('admin.reports.index') }}" method="GET" class="flex flex-col md:flex-row md:items-end gap-5">
                    <div class="flex-1">
                        <label for="start_date" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="w-full bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all sm:text-sm font-medium text-gray-900 py-3 px-4">
                    </div>
                    <div class="flex-1">
                        <label for="end_date" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="w-full bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all sm:text-sm font-medium text-gray-900 py-3 px-4">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-sm transition-colors">Terapkan Filter</button>
                        <a href="{{ route('admin.reports.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-6 rounded-xl transition-colors">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Data Table -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 pb-4 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">Rincian Transaksi Selesai</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="py-4 px-8 font-bold text-xs text-gray-400 uppercase tracking-wider">Order ID</th>
                                <th class="py-4 px-8 font-bold text-xs text-gray-400 uppercase tracking-wider">Waktu Selesai</th>
                                <th class="py-4 px-8 font-bold text-xs text-gray-400 uppercase tracking-wider">Meja</th>
                                <th class="py-4 px-8 font-bold text-xs text-gray-400 uppercase tracking-wider">Metode</th>
                                <th class="py-4 px-8 font-bold text-xs text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="py-4 px-8 font-bold text-xs text-gray-400 uppercase tracking-wider text-right">Total Transaksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($orders as $order)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="py-4 px-8 font-bold text-gray-900">#{{ $order->id }}</td>
                                <td class="py-4 px-8 text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                <td class="py-4 px-8">
                                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-lg bg-gray-100 text-gray-700 font-bold text-xs">
                                        {{ $order->table->nomor_meja ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-4 px-8">
                                    @if($order->payment && $order->payment->metode == 'QRIS')
                                        <span class="inline-flex items-center gap-1 text-indigo-600 font-bold text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                            QRIS
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-emerald-600 font-bold text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            Cash
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-8">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> {{ $order->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-8 text-right font-black text-gray-900 group-hover:text-emerald-600 transition-colors">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-16 px-4 text-center">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">Tidak ada data transaksi yang ditemukan pada rentang waktu ini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <style>
        @media print {
            body { background-color: white !important; }
            .bg-slate-50 { background-color: white !important; }
            .shadow-sm, .border { box-shadow: none !important; border-color: #e5e7eb !important; }
        }
    </style>
</x-admin-layout>
