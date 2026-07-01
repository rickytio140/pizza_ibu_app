<x-customer-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-black text-slate-800 tracking-tight">Keranjang Belanja</h1>
            <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
        </div>
    </x-slot>

    <div class="px-5 py-6">
        @if(empty($cart))
            <div class="flex flex-col items-center justify-center py-20 px-4 text-center">
                <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mb-6">
                    <svg class="h-12 w-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-lg font-black text-slate-900 mb-2">Keranjang Kosong</h3>
                <p class="text-slate-500 text-sm mb-8">Wah, perut keranjang masih lapar. Yuk, pilih menu kesukaanmu sekarang!</p>
                <a href="{{ route('customer.catalog') }}" class="w-full max-w-xs py-3.5 bg-orange-500 text-white font-bold rounded-xl shadow-lg shadow-orange-200 hover:bg-orange-600 transition-colors">
                    Lihat Menu
                </a>
            </div>
        @else
            <div class="flex flex-col gap-4 mb-8">
                @foreach($cart as $id => $item)
                    <div class="bg-white p-4 rounded-3xl shadow-[0_2px_20px_rgba(0,0,0,0.03)] border border-slate-100 flex items-center gap-4">
                        <!-- Gambar -->
                        <div class="w-20 h-20 shrink-0 bg-slate-50 rounded-2xl overflow-hidden flex items-center justify-center p-2">
                            @if($item['gambar'])
                                <img src="{{ str_starts_with($item['gambar'], 'uploads/') ? asset($item['gambar']) : asset('storage/' . $item['gambar']) }}" alt="Menu" class="w-full h-full object-contain text-transparent">
                            @else
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>
                        
                        <!-- Info -->
                        <div class="flex-1">
                            <h4 class="font-bold text-slate-900 leading-tight mb-1">{{ $item['nama'] }}</h4>
                            @if($item['ukuran'])
                                <span class="inline-block px-2 py-0.5 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-md mb-1 uppercase tracking-wider">
                                    {{ $item['ukuran'] }}
                                </span>
                            @endif
                            <p class="text-orange-500 font-black text-sm">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                        </div>

                        <!-- Kuantitas -->
                        <div class="bg-slate-50 rounded-full border border-slate-100 overflow-hidden shrink-0">
                            <form action="{{ route('customer.cart.update') }}" method="POST" class="flex flex-col items-center">
                                @csrf
                                <input type="hidden" name="cart_key" value="{{ $id }}">
                                
                                <button type="submit" name="action" value="increase" class="w-8 h-8 flex items-center justify-center text-slate-500 hover:text-slate-900 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </button>
                                
                                <span class="w-8 py-0.5 text-center font-bold text-sm text-slate-900">{{ $item['qty'] }}</span>
                                
                                <button type="submit" name="action" value="decrease" class="w-8 h-8 flex items-center justify-center text-slate-500 hover:text-slate-900 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Bagian Bawah: Total & Checkout -->
            <div class="bg-white p-5 rounded-3xl shadow-[0_2px_30px_rgba(0,0,0,0.06)] border border-slate-100">
                <div class="flex justify-between items-center mb-6 px-1">
                    <span class="text-slate-500 font-bold text-sm">Total Pesanan</span>
                    <span class="text-xl font-black text-slate-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <form action="{{ route('customer.checkout') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-slate-700 font-bold text-sm mb-3 px-1">Metode Pembayaran</label>
                        <div class="flex flex-col gap-3">
                            <label class="relative flex items-center p-4 border rounded-2xl cursor-pointer transition-colors hover:bg-slate-50 has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50/50 has-[:checked]:ring-1 has-[:checked]:ring-orange-500">
                                <input type="radio" name="payment_method" value="Kasir" class="peer w-5 h-5 text-orange-500 border-slate-300 focus:ring-orange-500" required checked>
                                <div class="ml-3 flex flex-col">
                                    <span class="font-bold text-slate-800 text-sm">Bayar di Kasir</span>
                                    <span class="text-xs text-slate-500 font-medium">Tunai, Kartu Debit/Kredit</span>
                                </div>
                            </label>
                            
                            <label class="relative flex items-center p-4 border rounded-2xl cursor-pointer transition-colors hover:bg-slate-50 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                                <input type="radio" name="payment_method" value="QRIS" class="peer w-5 h-5 text-blue-500 border-slate-300 focus:ring-blue-500" required>
                                <div class="ml-3 flex flex-col flex-1">
                                    <span class="font-bold text-slate-800 text-sm">QRIS Instan</span>
                                    <span class="text-xs text-slate-500 font-medium">Bayar dari HP sekarang juga</span>
                                </div>
                                <div class="shrink-0 px-2.5 py-1 bg-blue-100 text-blue-700 text-[10px] rounded-lg font-black tracking-wide uppercase">Cepat</div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-bold py-4 px-6 rounded-2xl shadow-md transition-transform active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Konfirmasi Pesanan
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-customer-layout>
