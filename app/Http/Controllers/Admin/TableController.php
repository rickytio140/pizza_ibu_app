<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|string|unique:tables,nomor_meja',
        ]);

        Table::create([
            'nomor_meja' => $request->nomor_meja,
            'kode_qr' => Str::slug($request->nomor_meja) . '-' . Str::random(5),
        ]);

        return redirect()->route('admin.tables.index')->with('success', 'Meja berhasil ditambahkan.');
    }

    public function show(Table $table)
    {
        return view('admin.tables.show', compact('table'));
    }

    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    public function update(Request $request, Table $table)
    {
        $request->validate([
            'nomor_meja' => 'required|string|unique:tables,nomor_meja,' . $table->id,
        ]);

        $table->update([
            'nomor_meja' => $request->nomor_meja,
        ]);

        return redirect()->route('admin.tables.index')->with('success', 'Meja berhasil diperbarui.');
    }

    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->route('admin.tables.index')->with('success', 'Meja berhasil dihapus.');
    }
}
