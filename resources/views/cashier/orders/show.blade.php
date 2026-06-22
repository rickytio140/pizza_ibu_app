<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan #') }}{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">
            
            <!-- Kolom Kiri: Rincian Pesanan -->
            <div class="w-full md:w-2/3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 border-b">
                        <h3 class="text-lg font-bold mb-2 border-b pb-2">Informasi Meja</h3>
                        <p class="text-gray-700 text-xl font-semibold mb-1">Meja: {{ $order->table->nomor_meja ?? '-' }}</p>
                        <p class="text-sm text-gray-500">Waktu Pesan: {{ $order->created_at->format('d M Y, H:i:s') }}</p>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Daftar Menu</h3>
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-y">
                                    <th class="py-2 px-4">Menu</th>
                                    <th class="py-2 px-4 text-center">Qty</th>
                                    <th class="py-2 px-4 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->details as $detail)
                                <tr class="border-b">
                                    <td class="py-3 px-4">
                                        {{ $detail->menu->nama }} 
                                        @if($detail->ukuran)
                                            <span class="text-xs text-gray-500 block">Ukuran: {{ $detail->ukuran }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center font-semibold">{{ $detail->qty }}</td>
                                    <td class="py-3 px-4 text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-between items-center mt-6 text-xl font-bold">
                            <span>Total Tagihan:</span>
                            <span class="text-red-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Aksi Pembayaran / Penyelesaian -->
            <div class="w-full md:w-1/3">
                
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sticky top-6">
                    <h3 class="text-lg font-bold mb-4 border-b pb-2">Status & Aksi</h3>
                    
                    <div class="mb-6">
                        Status Saat Ini: 
                        <span class="ml-2 px-3 py-1 rounded-full text-sm font-bold 
                            {{ $order->status == 'Menunggu Konfirmasi' ? 'bg-yellow-200 text-yellow-800' : 
                               ($order->status == 'Selesai' ? 'bg-gray-200 text-gray-800' : 'bg-green-200 text-green-800') }}">
                            {{ $order->status }}
                        </span>
                    </div>

                    @if($order->status == 'Menunggu Konfirmasi')
                        <!-- Form Pembayaran -->
                        <form action="{{ route('kasir.orders.pay', $order->id) }}" method="POST" id="paymentForm">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Metode Pembayaran</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="metode" value="Cash" class="form-radio text-indigo-600" required onchange="toggleQris(false)">
                                        <span class="ml-2">Cash (Tunai)</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="metode" value="QRIS" class="form-radio text-indigo-600" required onchange="toggleQris(true)">
                                        <span class="ml-2">QRIS</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Area Cash Dinamis -->
                            <div id="cash-area" class="hidden mb-6 p-4 rounded bg-gray-50 border">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Nominal Uang (Rp)</label>
                                <input type="number" name="nominal_bayar" id="nominal_bayar" min="{{ $order->total }}" class="w-full shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2" onkeyup="calculateKembalian()" onchange="calculateKembalian()">
                                
                                <div class="text-sm flex justify-between">
                                    <span class="text-gray-600">Total Tagihan:</span>
                                    <span class="font-bold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                </div>
                                <div class="text-sm mt-1 flex justify-between">
                                    <span class="text-gray-600">Kembalian:</span>
                                    <span id="kembalian-text" class="font-bold text-green-600">Rp 0</span>
                                </div>
                            </div>

                            <!-- Area QRIS Dinamis -->
                            <div id="qris-area" class="hidden mb-6 text-center border p-4 rounded bg-gray-50">
                                <p class="text-sm text-gray-600 mb-2">Tunjukkan QRIS ini ke pelanggan:</p>
                                <div class="flex justify-center bg-white p-2 mb-2">
                                    {!! QrCode::size(200)->generate('DUMMY-QRIS-PAYMENT-' . $order->id) !!}
                                </div>
                                <p class="font-bold text-lg text-red-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            </div>

                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded text-center transition">
                                Konfirmasi Pembayaran
                            </button>
                        </form>

                        <script>
                            const totalTagihan = {{ $order->total }};
                            
                            function toggleQris(isQris) {
                                document.getElementById('qris-area').style.display = isQris ? 'block' : 'none';
                                document.getElementById('cash-area').style.display = isQris ? 'none' : 'block';
                                
                                const nominalInput = document.getElementById('nominal_bayar');
                                if (isQris) {
                                    nominalInput.required = false;
                                } else {
                                    nominalInput.required = true;
                                }
                            }

                            function calculateKembalian() {
                                const nominal = parseInt(document.getElementById('nominal_bayar').value) || 0;
                                const kembalian = nominal - totalTagihan;
                                const kembalianText = document.getElementById('kembalian-text');
                                
                                if (kembalian >= 0) {
                                    kembalianText.textContent = 'Rp ' + kembalian.toLocaleString('id-ID');
                                    kembalianText.className = 'font-bold text-green-600';
                                } else {
                                    kembalianText.textContent = 'Uang Kurang!';
                                    kembalianText.className = 'font-bold text-red-600';
                                }
                            }
                        </script>

                    @elseif(in_array($order->status, ['Lunas (QRIS)', 'Lunas (Cash)']))
                        <!-- Tombol Penyelesaian Pesanan -->
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded">
                            <p class="text-sm text-green-800 mb-2"><strong>Pesanan Lunas via {{ $order->payment->metode ?? 'Unknown' }}</strong></p>
                            @if(($order->payment->metode ?? '') == 'Cash' && $order->payment->nominal_bayar)
                                <p class="text-sm text-green-700 mb-1">Nominal: Rp {{ number_format($order->payment->nominal_bayar, 0, ',', '.') }}</p>
                                <p class="text-sm text-green-700 mb-2">Kembalian: Rp {{ number_format($order->payment->kembalian, 0, ',', '.') }}</p>
                            @endif
                            <p class="text-xs text-green-600">Waktu Bayar: {{ \Carbon\Carbon::parse($order->payment->waktu_bayar)->format('H:i:s') }}</p>
                        </div>
                        
                        <form action="{{ route('kasir.orders.complete', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded shadow text-center transition">
                                Tandai Selesai & Antar Pesanan
                            </button>
                        </form>

                    @else
                        <!-- Selesai -->
                        <div class="p-4 bg-gray-100 rounded text-center text-gray-500 font-bold">
                            Pesanan ini sudah selesai.
                        </div>
                    @endif

                    <div class="mt-6 text-center">
                        <a href="{{ route('kasir.orders.index') }}" class="text-sm text-blue-600 hover:underline">Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
