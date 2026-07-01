<x-customer-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-black text-slate-800 tracking-tight">Pizza Ibu</h1>
                <p class="text-xs font-semibold text-orange-500">Meja {{ session('nomor_meja') }}</p>
            </div>
            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
            </div>
        </div>
    </x-slot>

    <div class="px-5 py-6">
        <!-- Notifikasi -->
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-2xl flex gap-3 items-center shadow-sm">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-2xl flex gap-3 items-center shadow-sm">
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm font-semibold">{{ session('error') }}</span>
            </div>
        @endif

        @foreach($categories as $category)
            @if($category->menus->count() > 0)
                <div class="mb-8 last:mb-0">
                    <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                        {{ $category->nama }}
                        <span class="h-px flex-1 bg-slate-200"></span>
                    </h3>
                    
                    <div class="flex flex-col gap-4">
                        @foreach($category->menus as $menu)
                            <div class="bg-white rounded-3xl shadow-[0_2px_20px_rgba(0,0,0,0.03)] border border-slate-100 overflow-hidden flex flex-col p-2">
                                <div class="flex gap-4 p-2">
                                    <!-- Gambar Menu -->
                                    <div class="w-24 h-24 shrink-0 rounded-2xl overflow-hidden bg-slate-100">
                                        @if($menu->gambar)
                                            <img src="{{ str_starts_with($menu->gambar, 'uploads/') ? asset($menu->gambar) : asset('storage/' . $menu->gambar) }}" alt="Menu" class="w-full h-full object-cover text-transparent">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Info Menu -->
                                    <div class="flex-1 py-1">
                                        <h4 class="font-bold text-slate-900 leading-tight mb-1">{{ $menu->nama }}</h4>
                                        @if($menu->harga)
                                            <div class="font-black text-orange-500 text-sm mt-1">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Form Tambah ke Keranjang -->
                                <form action="{{ route('customer.cart.add') }}" method="POST" class="mt-2 bg-slate-50 p-3 rounded-2xl">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    
                                    @if(strtolower($category->nama) === 'pizza')
                                        <div class="flex justify-between items-center bg-white p-1 rounded-xl shadow-sm border border-slate-200 mb-3 overflow-hidden">
                                            @php $hasChecked = false; @endphp
                                            @if($menu->harga_small)
                                            <label class="flex-1 cursor-pointer">
                                                <input type="radio" name="ukuran" value="Small" class="peer sr-only" required {{ !$hasChecked ? 'checked' : '' }}>
                                                @php $hasChecked = true; @endphp
                                                <div class="text-center py-2 text-[10px] font-bold text-slate-500 rounded-lg peer-checked:bg-orange-500 peer-checked:text-white transition-colors">
                                                    S<br><span class="opacity-80 font-normal">Rp{{ number_format($menu->harga_small/1000, 0) }}k</span>
                                                </div>
                                            </label>
                                            @endif
                                            @if($menu->harga_medium)
                                            <label class="flex-1 cursor-pointer">
                                                <input type="radio" name="ukuran" value="Medium" class="peer sr-only" required {{ !$hasChecked ? 'checked' : '' }}>
                                                @php $hasChecked = true; @endphp
                                                <div class="text-center py-2 text-[10px] font-bold text-slate-500 rounded-lg peer-checked:bg-orange-500 peer-checked:text-white transition-colors">
                                                    M<br><span class="opacity-80 font-normal">Rp{{ number_format($menu->harga_medium/1000, 0) }}k</span>
                                                </div>
                                            </label>
                                            @endif
                                            @if($menu->harga_large)
                                            <label class="flex-1 cursor-pointer">
                                                <input type="radio" name="ukuran" value="Large" class="peer sr-only" required {{ !$hasChecked ? 'checked' : '' }}>
                                                @php $hasChecked = true; @endphp
                                                <div class="text-center py-2 text-[10px] font-bold text-slate-500 rounded-lg peer-checked:bg-orange-500 peer-checked:text-white transition-colors">
                                                    L<br><span class="opacity-80 font-normal">Rp{{ number_format($menu->harga_large/1000, 0) }}k</span>
                                                </div>
                                            </label>
                                            @endif
                                        </div>
                                        
                                        @if($menu->harga_small || $menu->harga_medium || $menu->harga_large)
                                            <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-bold py-3 px-4 rounded-xl text-sm shadow-md transition-transform active:scale-95 flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                Tambah
                                            </button>
                                        @else
                                            <button type="button" disabled class="w-full bg-slate-200 text-slate-400 font-bold py-3 px-4 rounded-xl text-sm cursor-not-allowed">Habis</button>
                                        @endif
                                    @else
                                        <!-- Non Pizza Item -->
                                        @if($menu->harga)
                                            <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-bold py-3 px-4 rounded-xl text-sm shadow-md transition-transform active:scale-95 flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                Tambah
                                            </button>
                                        @else
                                            <button type="button" disabled class="w-full bg-slate-200 text-slate-400 font-bold py-3 px-4 rounded-xl text-sm cursor-not-allowed">Habis</button>
                                        @endif
                                    @endif
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-customer-layout>
