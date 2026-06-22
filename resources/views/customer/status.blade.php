<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 text-center w-full">
            Status Pesanan
        </h2>
    </x-slot>

    <div class="py-12 px-4 max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden text-center p-8">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Pesanan Berhasil Dicatat!</h3>
            <p class="text-gray-600 mb-6">Nomor Pesanan: <span class="font-bold text-black">#{{ $order->id }}</span></p>
            
            <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                <h4 class="font-bold text-gray-800 mb-4 border-b pb-2">Rincian Pesanan</h4>
                <ul class="space-y-3 mb-4">
                    @foreach($order->details as $detail)
                        <li class="flex justify-between text-sm">
                            <span class="text-gray-700">{{ $detail->qty }}x {{ $detail->menu->nama }} 
                                @if($detail->ukuran)
                                    <span class="text-xs text-gray-500">({{ $detail->ukuran }})</span>
                                @endif
                            </span>
                            <span class="font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="flex justify-between items-center pt-4 border-t border-gray-200 font-bold text-lg">
                    <span>Total Tagihan:</span>
                    <span class="text-red-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg mb-8 text-yellow-800 text-sm">
                <strong>Penting:</strong> Silakan menuju ke Kasir untuk melakukan pembayaran dan konfirmasi pesanan Anda agar segera diproses.
            </div>

            <a href="{{ route('customer.catalog') }}" class="text-blue-600 hover:underline font-medium">Pesan Tambahan Lagi?</a>
        </div>
    </div>
</x-customer-layout>
