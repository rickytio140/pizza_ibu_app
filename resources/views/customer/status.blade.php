<x-customer-layout>
    <div class="px-5 py-8 flex flex-col items-center">
        <!-- Success Animation/Icon -->
        <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center mb-6 relative">
            <div class="absolute inset-0 bg-emerald-400 rounded-full animate-ping opacity-20"></div>
            <svg class="w-12 h-12 text-emerald-500 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
        </div>
        
        <h2 class="text-2xl font-black text-slate-900 mb-2 text-center tracking-tight">Pesanan Berhasil!</h2>
        <p class="text-slate-500 mb-8 text-center text-sm">Order ID: <span class="font-bold text-slate-800">#{{ $order->id }}</span></p>
        
        <!-- Order Details Card -->
        <div class="w-full bg-white rounded-3xl shadow-[0_2px_20px_rgba(0,0,0,0.03)] border border-slate-100 p-6 mb-8 relative overflow-hidden">
            <!-- Decorative receipt edge -->
            <div class="absolute -top-3 left-0 w-full h-4" style="background-image: radial-gradient(circle, #f8fafc 4px, transparent 4px); background-size: 16px 16px; background-position: -4px 4px;"></div>
            
            <h4 class="font-black text-slate-800 mb-4 pb-4 border-b border-dashed border-slate-200">Rincian Pesanan</h4>
            <ul class="space-y-4 mb-4">
                @foreach($order->details as $detail)
                    <li class="flex justify-between items-start text-sm">
                        <div class="flex gap-3">
                            <span class="font-black text-slate-800">{{ $detail->qty }}x</span>
                            <div>
                                <span class="font-bold text-slate-700 block">{{ $detail->menu->nama }}</span>
                                @if($detail->ukuran)
                                    <span class="text-[10px] uppercase font-bold text-slate-400 bg-slate-50 px-1.5 py-0.5 rounded mt-1 inline-block">{{ $detail->ukuran }}</span>
                                @endif
                            </div>
                        </div>
                        <span class="font-black text-slate-900 shrink-0">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="flex justify-between items-center pt-5 border-t border-dashed border-slate-200">
                <span class="font-bold text-slate-500 text-sm">Total Tagihan</span>
                <span class="text-xl font-black text-orange-500">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Payment Instructions -->
        @if($order->status === 'Menunggu Pembayaran QRIS')
            <div class="w-full flex flex-col items-center bg-white p-6 rounded-3xl shadow-[0_2px_20px_rgba(0,0,0,0.03)] border border-blue-100 mb-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-bl-full -z-0"></div>
                
                <h4 class="font-black text-blue-900 mb-2 relative z-10 text-center">Scan QRIS untuk Membayar</h4>
                <p class="text-slate-500 text-xs mb-6 text-center relative z-10 max-w-[200px]">Buka aplikasi mobile banking atau e-wallet Anda untuk memindai.</p>
                
                <div class="bg-white p-3 rounded-2xl shadow-sm border border-slate-100 inline-block mb-6 relative z-10">
                    <!-- Demo QR Code -->
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=DUMMY_QRIS_PAYMENT_PIZZA_IBU_APP_ORDER_{{ $order->id }}" alt="QRIS Code" class="w-48 h-48 rounded-xl">
                </div>
                
                <div class="w-full p-4 bg-blue-50 border border-blue-100 rounded-2xl flex gap-3 items-start relative z-10">
                    <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-blue-800 text-xs font-medium leading-relaxed">Setelah membayar, beritahu Kasir untuk konfirmasi pesanan Anda agar segera dimasak.</p>
                </div>
            </div>
        @else
            <div class="w-full p-5 bg-amber-50 border border-amber-100 rounded-3xl mb-8 flex items-start gap-4 shadow-sm">
                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="font-black text-amber-900 text-sm mb-1">Menunggu Pembayaran</h4>
                    <p class="text-amber-700 text-xs font-medium leading-relaxed">Silakan menuju Kasir untuk membayar agar pesanan Anda dapat segera kami proses.</p>
                </div>
            </div>
        @endif

        <a href="{{ route('customer.catalog') }}" class="w-full py-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-2xl text-center transition-colors shadow-sm text-sm">
            Kembali ke Menu
        </a>
    </div>
</x-customer-layout>
