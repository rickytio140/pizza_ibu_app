<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $categories = MenuCategory::all();
        return view('admin.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $category = MenuCategory::find($request->menu_category_id);
        $isPizza = $category && strtolower($category->nama) === 'pizza';

        $rules = [
            'menu_category_id' => 'required|exists:menu_categories,id',
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048',
            'is_available' => 'boolean',
        ];

        if ($isPizza) {
            $rules['harga_small'] = 'nullable|numeric|min:0';
            $rules['harga_medium'] = 'nullable|numeric|min:0';
            $rules['harga_large'] = 'nullable|numeric|min:0';
        } else {
            $rules['harga'] = 'required|numeric|min:0';
        }

        $request->validate($rules);

        $data = $request->except('gambar');
        $data['is_available'] = $request->has('is_available');
        
        if ($isPizza) {
            $data['harga'] = null;
        } else {
            $data['harga_small'] = null;
            $data['harga_medium'] = null;
            $data['harga_large'] = null;
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $categories = MenuCategory::all();
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $category = MenuCategory::find($request->menu_category_id);
        $isPizza = $category && strtolower($category->nama) === 'pizza';

        $rules = [
            'menu_category_id' => 'required|exists:menu_categories,id',
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048',
            'is_available' => 'boolean',
        ];

        if ($isPizza) {
            $rules['harga_small'] = 'nullable|numeric|min:0';
            $rules['harga_medium'] = 'nullable|numeric|min:0';
            $rules['harga_large'] = 'nullable|numeric|min:0';
        } else {
            $rules['harga'] = 'required|numeric|min:0';
        }

        $request->validate($rules);

        $data = $request->except('gambar');
        $data['is_available'] = $request->has('is_available');
        
        if ($isPizza) {
            $data['harga'] = null;
        } else {
            $data['harga_small'] = null;
            $data['harga_medium'] = null;
            $data['harga_large'] = null;
        }

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
