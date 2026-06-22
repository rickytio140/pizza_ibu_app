<x-customer-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800">
                Menu Kami - {{ session('nomor_meja') }}
            </h2>
            <a href="{{ route('customer.cart') }}" class="relative inline-flex items-center p-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="sr-only">Keranjang</span>
                @if($cartCount > 0)
                <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-blue-500 border-2 border-white rounded-full -top-2 -right-2">{{ $cartCount }}</div>
                @endif
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4">
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

        @foreach($categories as $category)
            @if($category->menus->count() > 0)
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">{{ $category->nama }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($category->menus as $menu)
                            <div class="bg-white rounded-lg shadow overflow-hidden flex">
                                @if($menu->gambar)
                                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="w-32 h-32 object-cover">
                                @else
                                    <div class="w-32 h-32 bg-gray-200 flex items-center justify-center text-gray-500 text-xs">No Image</div>
                                @endif
                                <div class="p-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-bold text-lg text-gray-900">{{ $menu->nama }}</h4>
                                    </div>
                                    <form action="{{ route('customer.cart.add') }}" method="POST" class="mt-2 flex flex-col justify-end h-full">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <input type="hidden" name="qty" value="1">
                                        
                                        @if(strtolower($category->nama) === 'pizza')
                                            <div class="mb-3 text-sm flex flex-col gap-1.5">
                                                @php $hasChecked = false; @endphp
                                                @if($menu->harga_small)
                                                <label class="flex items-center gap-2 cursor-pointer bg-gray-50 hover:bg-red-50 p-1.5 rounded border border-transparent hover:border-red-200 transition-colors">
                                                    <input type="radio" name="ukuran" value="Small" class="text-red-600 focus:ring-red-500" required {{ !$hasChecked ? 'checked' : '' }}>
                                                    @php $hasChecked = true; @endphp
                                                    <span class="flex-1 text-gray-700">Small</span>
                                                    <span class="font-bold text-red-600 text-xs">Rp{{ number_format($menu->harga_small, 0, ',', '.') }}</span>
                                                </label>
                                                @endif
                                                @if($menu->harga_medium)
                                                <label class="flex items-center gap-2 cursor-pointer bg-gray-50 hover:bg-red-50 p-1.5 rounded border border-transparent hover:border-red-200 transition-colors">
                                                    <input type="radio" name="ukuran" value="Medium" class="text-red-600 focus:ring-red-500" required {{ !$hasChecked ? 'checked' : '' }}>
                                                    @php $hasChecked = true; @endphp
                                                    <span class="flex-1 text-gray-700">Medium</span>
                                                    <span class="font-bold text-red-600 text-xs">Rp{{ number_format($menu->harga_medium, 0, ',', '.') }}</span>
                                                </label>
                                                @endif
                                                @if($menu->harga_large)
                                                <label class="flex items-center gap-2 cursor-pointer bg-gray-50 hover:bg-red-50 p-1.5 rounded border border-transparent hover:border-red-200 transition-colors">
                                                    <input type="radio" name="ukuran" value="Large" class="text-red-600 focus:ring-red-500" required {{ !$hasChecked ? 'checked' : '' }}>
                                                    @php $hasChecked = true; @endphp
                                                    <span class="flex-1 text-gray-700">Large</span>
                                                    <span class="font-bold text-red-600 text-xs">Rp{{ number_format($menu->harga_large, 0, ',', '.') }}</span>
                                                </label>
                                                @endif
                                            </div>
                                            
                                            @if($menu->harga_small || $menu->harga_medium || $menu->harga_large)
                                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded text-sm transition-colors mt-auto">Tambah Keranjang</button>
                                            @else
                                                <button type="button" disabled class="w-full bg-gray-300 text-gray-500 font-bold py-2 px-3 rounded text-sm mt-auto cursor-not-allowed">Harga Belum Diatur</button>
                                            @endif
                                        @else
                                            <div class="mb-3 text-sm">
                                                @if($menu->harga)
                                                    <div class="font-bold text-red-600 text-lg">Rp{{ number_format($menu->harga, 0, ',', '.') }}</div>
                                                @endif
                                            </div>
                                            
                                            @if($menu->harga)
                                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded text-sm transition-colors mt-auto">Tambah Keranjang</button>
                                            @else
                                                <button type="button" disabled class="w-full bg-gray-300 text-gray-500 font-bold py-2 px-3 rounded text-sm mt-auto cursor-not-allowed">Harga Belum Diatur</button>
                                            @endif
                                        @endif
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-customer-layout>
