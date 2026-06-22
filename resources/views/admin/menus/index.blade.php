<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight tracking-tight flex items-center gap-2">
                <span class="text-3xl">🍕</span> {{ __('Daftar Menu Pizza Ibu') }}
            </h2>
            <a href="{{ route('admin.menus.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-orange-500 hover:bg-orange-600 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Tambah Menu Baru
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

            @if($menus->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($menus as $menu)
                        <div class="bg-white rounded-[2rem] p-5 shadow-[0_2px_15px_rgb(0,0,0,0.03)] border border-gray-100 hover:shadow-[0_10px_30px_rgb(0,0,0,0.06)] hover:-translate-y-1 transition-all duration-300 flex flex-col">
                            
                            <!-- Gambar Menu -->
                            <div class="relative w-full h-52 mb-5 rounded-2xl overflow-hidden bg-white p-4 flex items-center justify-center group border border-gray-50">
                                @if($menu->gambar)
                                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="w-full h-full object-contain drop-shadow-md group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <svg class="w-16 h-16 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                                
                                <!-- Badge Status (Absolute di atas gambar) -->
                                <div class="absolute top-3 right-3">
                                    @if($menu->is_available)
                                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-emerald-600 rounded-full text-xs font-bold shadow-sm flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Tersedia
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-red-600 rounded-full text-xs font-bold shadow-sm flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Habis
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Badge Kategori -->
                                <div class="absolute top-3 left-3">
                                    <span class="px-3 py-1 bg-orange-500/90 text-white backdrop-blur-sm rounded-full text-xs font-bold shadow-sm">
                                        {{ $menu->category->nama ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Info Menu -->
                            <div class="flex-1">
                                <h3 class="text-xl font-extrabold text-gray-900 mb-3 tracking-tight">{{ $menu->nama }}</h3>
                                
                                <!-- Harga Varian -->
                                <div class="space-y-2 mb-6">
                                    @if($menu->harga)
                                        <div class="flex justify-between items-center text-sm p-2 rounded-xl bg-orange-50/50 border border-orange-100">
                                            <span class="font-bold text-gray-600">Reguler</span>
                                            <span class="font-black text-orange-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                        </div>
                                    @elseif($menu->harga_small || $menu->harga_medium || $menu->harga_large)
                                        @if($menu->harga_small)
                                            <div class="flex justify-between items-center text-sm p-2 rounded-xl bg-orange-50/50 border border-orange-100">
                                                <span class="font-bold text-gray-600">Small</span>
                                                <span class="font-black text-orange-600">Rp {{ number_format($menu->harga_small, 0, ',', '.') }}</span>
                                            </div>
                                        @endif
                                        @if($menu->harga_medium)
                                            <div class="flex justify-between items-center text-sm p-2 rounded-xl bg-orange-50/50 border border-orange-100">
                                                <span class="font-bold text-gray-600">Medium</span>
                                                <span class="font-black text-orange-600">Rp {{ number_format($menu->harga_medium, 0, ',', '.') }}</span>
                                            </div>
                                        @endif
                                        @if($menu->harga_large)
                                            <div class="flex justify-between items-center text-sm p-2 rounded-xl bg-orange-50/50 border border-orange-100">
                                                <span class="font-bold text-gray-600">Large</span>
                                                <span class="font-black text-orange-600">Rp {{ number_format($menu->harga_large, 0, ',', '.') }}</span>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-sm text-gray-400 italic p-2">Harga belum diatur</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Aksi (Edit / Hapus) -->
                            <div class="flex gap-2 mt-auto pt-4 border-t border-gray-50">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="flex-1 inline-flex justify-center items-center gap-1 py-2.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-sm font-bold rounded-xl transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex justify-center items-center gap-1 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-sm font-bold rounded-xl transition-colors" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini secara permanen?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
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
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <span class="text-4xl">🍕</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Menu</h3>
                    <p class="text-gray-500 mb-6 max-w-md">Katalog menu Anda masih kosong. Mari mulai tambahkan hidangan andalan Pizza Ibu agar pelanggan bisa mulai memesan!</p>
                    <a href="{{ route('admin.menus.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl shadow-md transition-transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Menu Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-admin-layout>
