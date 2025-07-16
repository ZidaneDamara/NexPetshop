<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriHewan;

class KategoriHewanController extends Controller
{
    public function index()
    {
        $kategori = KategoriHewan::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriHewan::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori-hewan.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriHewan $kategori_hewan)
    {
        return view('admin.kategori.edit', compact('kategori_hewan'));
    }

    public function update(Request $request, KategoriHewan $kategori_hewan)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori_hewan->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori-hewan.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriHewan $kategori_hewan)
    {
        $kategori_hewan->delete();

        return redirect()->route('kategori-hewan.index')->with('success', 'Kategori berhasil dihapus.');
    }
}