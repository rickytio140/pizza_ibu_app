<x-customer-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('customer.catalog') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-sm text-gray-500 hover:text-gray-900 hover:shadow-md transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                Keranjang Belanja
            </h2>
        </div>
    </x-slot>

    <div class="py-8 px-4 max-w-3xl mx-auto bg-slate-50 min-h-screen">
        @if(empty($cart))
            <div class="text-center py-16 px-6 bg-white rounded-[2rem] shadow-[0_2px_15px_rgb(0,0,0,0.03)] border border-gray-100 flex flex-col items-center">
                <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mb-6">
                    <svg class="h-12 w-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Keranjang masih kosong</h3>
                <p class="text-gray-500 mb-8 max-w-sm">Silakan tambahkan menu lezat kami ke keranjang Anda untuk mulai memesan.</p>
                <a href="{{ route('customer.catalog') }}" class="px-8 py-3 bg-red-600 text-white font-bold rounded-xl shadow-lg shadow-red-200 hover:bg-red-700 hover:-translate-y-0.5 transition-all">
                    Lihat Menu Kami
                </a>
            </div>
        @else
            <div class="space-y-4 mb-8">
                @foreach($cart as $id => $item)
                    <div class="bg-white p-4 rounded-2xl shadow-[0_2px_10px_rgb(0,0,0,0.04)] border border-gray-50 flex items-center justify-between">
                        <div class="flex items-center flex-1 gap-4">
                            <!-- Gambar -->
                            <div class="w-20 h-20 shrink-0 bg-gray-50 rounded-xl overflow-hidden flex items-center justify-center p-2 border border-gray-100">
                                @if($item['gambar'])
                                    <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" class="w-full h-full object-contain">
                                @else
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                            </div>
                            
                            <!-- Info -->
                            <div class="flex-1">
                                <h4 class="font-extrabold text-gray-900 text-lg mb-0.5">{{ $item['nama'] }}</h4>
                                @if($item['ukuran'])
                                    <span class="inline-block px-2.5 py-0.5 bg-orange-50 text-orange-600 text-xs font-bold rounded-md mb-1.5">
                                        {{ $item['ukuran'] }}
                                    </span>
                                @endif
                                <p class="text-red-600 font-black">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <!-- Kuantitas -->
                        <div class="flex items-center ml-4 bg-gray-50 p-1.5 rounded-xl border border-gray-100">
                            <form action="{{ route('customer.cart.update') }}" method="POST" class="flex items-center gap-1">
                                @csrf
                                <input type="hidden" name="cart_key" value="{{ $id }}">
                                <button type="submit" name="action" value="decrease" class="w-8 h-8 flex items-center justify-center bg-white text-gray-600 font-bold rounded-lg shadow-sm hover:text-red-600 transition-colors">
                                    -
                                </button>
                                <span class="w-8 text-center font-bold text-gray-900">{{ $item['qty'] }}</span>
                                <button type="submit" name="action" value="increase" class="w-8 h-8 flex items-center justify-center bg-white text-gray-600 font-bold rounded-lg shadow-sm hover:text-emerald-600 transition-colors">
                                    +
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Bagian Bawah: Total & Checkout -->
            <div class="bg-white p-6 rounded-[2rem] shadow-[0_4px_20px_rgb(0,0,0,0.05)] border border-gray-100">
                <div class="flex justify-between items-center mb-6 px-2">
                    <span class="text-gray-500 font-medium">Total Pembayaran</span>
                    <span class="text-2xl font-black text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <form action="{{ route('customer.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold py-4 px-6 rounded-2xl shadow-lg shadow-emerald-200 text-lg text-center transition-all hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Pesan Sekarang
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-customer-layout>
