<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\KategoriHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HewanController extends Controller
{
    public function index()
    {
        $hewans = Hewan::with('kategori')->get();
        return view('admin.hewan.index', compact('hewans'));
    }

    public function create()
    {
        $kategori = KategoriHewan::all();
        return view('admin.hewan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ras' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:jantan,betina',
            'umur' => 'required|integer',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'kategori_hewan_id' => 'required|exists:kategori_hewans,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi untuk satu gambar
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('hewans', 'public'); // Simpan satu gambar
        }

        Hewan::create([
            'nama' => $request->nama,
            'ras' => $request->ras,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'status_kesehatan' => $request->status_kesehatan,
            'sudah_vaksin' => $request->sudah_vaksin ?? false,
            'gambar' => $gambarPath, // Simpan path gambar tunggal
            'berat' => $request->berat,
            'warna' => $request->warna,
            'kategori_hewan_id' => $request->kategori_hewan_id,
        ]);

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil ditambahkan.');
    }

    public function show(Hewan $hewan)
    {
        return view('admin.hewan.show', compact('hewan'));
    }

    public function edit(Hewan $hewan)
    {
        $kategori = KategoriHewan::all();
        return view('admin.hewan.edit', compact('hewan', 'kategori'));
    }

    public function update(Request $request, Hewan $hewan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ras' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:jantan,betina',
            'umur' => 'required|integer',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'kategori_hewan_id' => 'required|exists:kategori_hewans,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi untuk satu gambar
        ]);

        $gambarPath = $hewan->gambar; // Ambil path gambar yang sudah ada

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('hewans', 'public'); // Simpan gambar baru
        }

        $hewan->update([
            'nama' => $request->nama,
            'ras' => $request->ras,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'status_kesehatan' => $request->status_kesehatan,
            'sudah_vaksin' => $request->sudah_vaksin ?? false,
            'gambar' => $gambarPath, // Perbarui dengan path gambar tunggal
            'berat' => $request->berat,
            'warna' => $request->warna,
            'kategori_hewan_id' => $request->kategori_hewan_id,
        ]);

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil diperbarui.');
    }

    public function destroy(Hewan $hewan)
    {
        // Hapus gambar terkait jika ada
        if ($hewan->gambar && Storage::disk('public')->exists($hewan->gambar)) {
            Storage::disk('public')->delete($hewan->gambar);
        }
        $hewan->delete();
        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil dihapus.');
    }
}