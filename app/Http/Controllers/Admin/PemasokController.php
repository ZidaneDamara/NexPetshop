<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function index()
    {
        $pemasoks = Pemasok::all();
        return view('admin.pemasok.index', compact('pemasoks'));
    }

    public function create()
    {
        return view('admin.pemasok.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemasok' => 'required|string|max:255|unique:pemasoks,nama_pemasok',
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:20',
        ]);

        Pemasok::create($request->all());

        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil ditambahkan.');
    }

    public function show(Pemasok $pemasok)
    {
        return view('admin.pemasok.show', compact('pemasok'));
    }

    public function edit(Pemasok $pemasok)
    {
        return view('admin.pemasok.edit', compact('pemasok'));
    }

    public function update(Request $request, Pemasok $pemasok)
    {
        $request->validate([
            'nama_pemasok' => 'required|string|max:255|unique:pemasoks,nama_pemasok,' . $pemasok->id,
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:20',
        ]);

        $pemasok->update($request->all());

        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil diperbarui.');
    }

    public function destroy(Pemasok $pemasok)
    {
        $pemasok->delete();
        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil dihapus.');
    }
}
