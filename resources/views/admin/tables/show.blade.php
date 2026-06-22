<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Meja & QR Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center p-10">
                <h3 class="text-2xl font-bold mb-4">{{ $table->nomor_meja }}</h3>
                <p class="text-gray-600 mb-8">Scan QR Code di bawah ini untuk memesan makanan dari meja ini.</p>
                
                <div class="flex justify-center mb-8">
                    <!-- URL yang digenerate adalah URL aplikasi + kode qr meja -->
                    {!! QrCode::size(300)->generate(url('/meja/' . $table->kode_qr)) !!}
                </div>
                
                <p class="text-sm text-gray-500 mb-4">URL: {{ url('/meja/' . $table->kode_qr) }}</p>

                <div class="mt-6">
                    <a href="{{ route('admin.tables.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Kembali</a>
                    <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 ml-2">Cetak QR</button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
