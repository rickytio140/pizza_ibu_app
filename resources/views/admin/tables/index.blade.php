<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight tracking-tight flex items-center gap-2">
                <span class="text-3xl">🪑</span> {{ __('Manajemen Meja Restoran') }}
            </h2>
            <a href="{{ route('admin.tables.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-500 hover:bg-teal-600 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Tambah Meja Baru
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm animate-fade-in-down" role="alert">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            @if($tables->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($tables as $table)
                        <div class="bg-white rounded-[2rem] p-5 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col items-center group relative overflow-hidden">
                            
                            <!-- Aksen dekorasi di atas -->
                            <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-teal-400 to-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                            <!-- Mini QR Code Display -->
                            <div class="w-24 h-24 bg-white border border-gray-100 shadow-sm rounded-xl p-2 mb-4 group-hover:scale-105 transition-transform">
                                {!! QrCode::size(80)->margin(0)->generate(url('/scan/' . $table->kode_qr)) !!}
                            </div>
                            
                            <h3 class="text-xl font-black text-gray-900 mb-1 tracking-tight">{{ $table->nomor_meja }}</h3>
                            <p class="text-xs text-gray-400 font-mono mb-5 truncate w-full text-center px-2 bg-gray-50 rounded py-1 border border-gray-100">{{ $table->kode_qr }}</p>

                            <!-- Aksi -->
                            <div class="w-full grid grid-cols-2 gap-2 mt-auto pt-4 border-t border-gray-50">
                                <a href="{{ route('admin.tables.show', $table->id) }}" class="col-span-2 inline-flex justify-center items-center gap-1.5 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold rounded-xl transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    Cetak QR
                                </a>
                                <a href="{{ route('admin.tables.edit', $table->id) }}" class="inline-flex justify-center items-center py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-bold rounded-xl transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.tables.destroy', $table->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex justify-center items-center py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-xl transition-colors" onclick="return confirm('Hapus meja ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-[2rem] p-12 shadow-sm border border-gray-100 text-center flex flex-col items-center justify-center">
                    <div class="w-24 h-24 bg-teal-50 rounded-full flex items-center justify-center mb-6">
                        <span class="text-4xl">🪑</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Meja Terdaftar</h3>
                    <p class="text-gray-500 mb-6 max-w-md">Katalog meja Anda masih kosong. Daftarkan meja agar pelanggan bisa melakukan scan QR Code untuk mulai memesan!</p>
                    <a href="{{ route('admin.tables.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-teal-500 hover:bg-teal-600 text-white font-bold rounded-xl shadow-md transition-transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        Daftarkan Meja Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-admin-layout>
