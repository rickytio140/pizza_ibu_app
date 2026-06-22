<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight tracking-tight flex items-center gap-2">
                <span class="text-3xl">📑</span> {{ __('Kategori Menu Pizza Ibu') }}
            </h2>
            <a href="{{ route('admin.menu-categories.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kategori
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

            @if($categories->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                        @php
                            // Auto-generate a beautiful gradient based on category name length to make them look distinct
                            $gradients = [
                                'bg-gradient-to-br from-amber-100 to-orange-100 text-orange-600 border-orange-200',
                                'bg-gradient-to-br from-blue-100 to-cyan-100 text-blue-600 border-blue-200',
                                'bg-gradient-to-br from-emerald-100 to-teal-100 text-emerald-600 border-emerald-200',
                                'bg-gradient-to-br from-rose-100 to-pink-100 text-rose-600 border-rose-200',
                                'bg-gradient-to-br from-purple-100 to-fuchsia-100 text-purple-600 border-purple-200',
                            ];
                            $style = $gradients[strlen($category->nama) % count($gradients)];
                        @endphp
                        
                        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col relative overflow-hidden group">
                            
                            <!-- Hiasan background lingkaran -->
                            <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full opacity-50 transition-transform group-hover:scale-150 {{ explode(' ', $style)[0] }} {{ explode(' ', $style)[1] }} {{ explode(' ', $style)[2] }}"></div>
                            
                            <div class="relative z-10 flex-1">
                                <!-- Ikon Bulat -->
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 font-black text-2xl border shadow-sm {{ $style }}">
                                    {{ substr($category->nama, 0, 1) }}
                                </div>
                                
                                <h3 class="text-xl font-extrabold text-gray-900 mb-2 tracking-tight">{{ $category->nama }}</h3>
                                <p class="text-gray-500 text-sm leading-relaxed mb-6">{{ Str::limit($category->deskripsi, 80) ?: 'Tidak ada deskripsi' }}</p>
                            </div>
                            
                            <!-- Aksi (Edit / Hapus) -->
                            <div class="flex gap-2 relative z-10 border-t border-gray-50 pt-4">
                                <a href="{{ route('admin.menu-categories.edit', $category->id) }}" class="flex-1 inline-flex justify-center items-center gap-1 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-sm font-bold rounded-xl transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.menu-categories.destroy', $category->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex justify-center items-center gap-1 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 text-sm font-bold rounded-xl transition-colors" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
                    <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mb-6">
                        <span class="text-4xl">📑</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Kategori</h3>
                    <p class="text-gray-500 mb-6 max-w-md">Anda belum membuat kategori apapun. Buat kategori pertama seperti "Pizza" atau "Minuman" untuk mulai mengelompokkan menu Anda.</p>
                    <a href="{{ route('admin.menu-categories.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white font-bold rounded-xl shadow-md transition-transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        Buat Kategori Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-admin-layout>
