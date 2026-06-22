<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Menu</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $menu->nama) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @error('nama')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="menu_category_id" class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                            <select name="menu_category_id" id="menu_category_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" data-nama="{{ strtolower($category->nama) }}" {{ (old('menu_category_id', $menu->menu_category_id) == $category->id) ? 'selected' : '' }}>{{ $category->nama }}</option>
                                @endforeach
                            </select>
                            @error('menu_category_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Regular Price (For Non-Pizza) -->
                        <div class="mb-4" id="regular_price_container" style="display: none;">
                            <label for="harga" class="block text-gray-700 text-sm font-bold mb-2">Harga Reguler (Rp)</label>
                            <input type="number" name="harga" id="harga" min="0" value="{{ old('harga', $menu->harga) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <p class="text-xs text-gray-500 mt-1">Harga untuk menu tunggal (Minuman, Snack, dsb).</p>
                            @error('harga')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Size Prices (For Pizza) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4" id="size_prices_container" style="display: none;">
                            <div>
                                <label for="harga_small" class="block text-gray-700 text-sm font-bold mb-2">Harga Small (Rp)</label>
                                <input type="number" name="harga_small" id="harga_small" min="0" value="{{ old('harga_small', $menu->harga_small) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('harga_small')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="harga_medium" class="block text-gray-700 text-sm font-bold mb-2">Harga Medium (Rp)</label>
                                <input type="number" name="harga_medium" id="harga_medium" min="0" value="{{ old('harga_medium', $menu->harga_medium) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('harga_medium')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="harga_large" class="block text-gray-700 text-sm font-bold mb-2">Harga Large (Rp)</label>
                                <input type="number" name="harga_large" id="harga_large" min="0" value="{{ old('harga_large', $menu->harga_large) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('harga_large')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <p class="text-xs text-gray-500 col-span-1 md:col-span-3 mt-1">Isi ukuran yang tersedia saja. Kosongkan jika tidak ada ukuran tersebut.</p>
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar Menu</label>
                            @if($menu->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="Current Image" class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="gambar" id="gambar" accept="image/*" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <p class="text-gray-500 text-xs mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                            @error('gambar')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_available" value="1" {{ old('is_available', $menu->is_available) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-blue-600">
                                <span class="ml-2 text-gray-700">Tersedia</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update
                            </button>
                            <a href="{{ route('admin.menus.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('menu_category_id');
            const sizeContainer = document.getElementById('size_prices_container');
            const regularContainer = document.getElementById('regular_price_container');

            function togglePriceInputs() {
                const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                if (!selectedOption.value) {
                    sizeContainer.style.display = 'none';
                    regularContainer.style.display = 'none';
                    return;
                }

                const categoryName = selectedOption.getAttribute('data-nama');
                
                if (categoryName === 'pizza') {
                    sizeContainer.style.display = 'grid';
                    regularContainer.style.display = 'none';
                } else {
                    sizeContainer.style.display = 'none';
                    regularContainer.style.display = 'block';
                }
            }

            categorySelect.addEventListener('change', togglePriceInputs);
            
            // Run on load in case of old input
            togglePriceInputs();
        });
    </script>
</x-admin-layout>
