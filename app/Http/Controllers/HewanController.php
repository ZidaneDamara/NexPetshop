<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\KategoriHewan;
use App\Models\Pemasok;
use App\Models\Mutasi;
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
        $pemasoks = Pemasok::all(); // Tambahkan baris ini
        return view('admin.hewan.create', compact('kategori', 'pemasoks')); // Perbarui compact
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ras' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:jantan,betina',
            'umur' => 'required|integer',
            'harga' => 'required|integer',
            'stok' => 'required|integer|min:0', // Pastikan stok tidak negatif
            'kategori_hewan_id' => 'required|exists:kategori_hewans,id',
            'pemasok_id' => 'nullable|exists:pemasoks,id', // Tambahkan validasi ini
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('hewans', 'public');
        }

        $hewan = Hewan::create([ // Ubah menjadi $hewan = Hewan::create(...)
            'nama' => $request->nama,
            'ras' => $request->ras,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'status_kesehatan' => $request->status_kesehatan,
            'sudah_vaksin' => $request->sudah_vaksin ?? false,
            'gambar' => $gambarPath,
            'berat' => $request->berat,
            'warna' => $request->warna,
            'kategori_hewan_id' => $request->kategori_hewan_id,
            'pemasok_id' => $request->pemasok_id, // Tambahkan baris ini
        ]);

        // Catat mutasi 'masuk'
        if ($hewan->stok > 0) {
            Mutasi::create([
                'hewan_id' => $hewan->id,
                'jumlah' => $hewan->stok,
                'tipe_mutasi' => 'masuk',
                'referensi_id' => $hewan->id,
                'referensi_type' => 'App\Models\Hewan', // Atau 'HewanAdd' jika ingin lebih spesifik
                'deskripsi' => 'Penambahan stok hewan baru dari pemasok.',
            ]);
        }

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil ditambahkan.');
    }

    public function show(Hewan $hewan)
    {
        return view('admin.hewan.show', compact('hewan'));
    }

    public function edit(Hewan $hewan)
    {
        $kategori = KategoriHewan::all();
        $pemasoks = Pemasok::all(); // Tambahkan baris ini
        return view('admin.hewan.edit', compact('hewan', 'kategori', 'pemasoks')); // Perbarui compact
    }

    public function update(Request $request, Hewan $hewan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ras' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:jantan,betina',
            'umur' => 'required|integer',
            'harga' => 'required|integer',
            'stok' => 'required|integer|min:0',
            'kategori_hewan_id' => 'required|exists:kategori_hewans,id',
            'pemasok_id' => 'nullable|exists:pemasoks,id', // Tambahkan validasi ini
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $oldStok = $hewan->stok; // Simpan stok lama
        $gambarPath = $hewan->gambar;

        if ($request->hasFile('gambar')) {
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('hewans', 'public');
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
            'gambar' => $gambarPath,
            'berat' => $request->berat,
            'warna' => $request->warna,
            'kategori_hewan_id' => $request->kategori_hewan_id,
            'pemasok_id' => $request->pemasok_id, // Tambahkan baris ini
        ]);

        // Catat mutasi jika ada perubahan stok
        $newStok = $hewan->stok;
        if ($newStok > $oldStok) {
            Mutasi::create([
                'hewan_id' => $hewan->id,
                'jumlah' => $newStok - $oldStok,
                'tipe_mutasi' => 'masuk',
                'referensi_id' => $hewan->id,
                'referensi_type' => 'App\Models\Hewan', // Atau 'HewanUpdate'
                'deskripsi' => 'Penambahan stok hewan (update data).',
            ]);
        } elseif ($newStok < $oldStok) {
            Mutasi::create([
                'hewan_id' => $hewan->id,
                'jumlah' => $oldStok - $newStok,
                'tipe_mutasi' => 'keluar',
                'referensi_id' => $hewan->id,
                'referensi_type' => 'App\Models\Hewan', // Atau 'HewanUpdate'
                'deskripsi' => 'Pengurangan stok hewan (update data).',
            ]);
        }

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil diperbarui.');
    }

    public function destroy(Hewan $hewan)
    {
        // Catat mutasi 'keluar' jika hewan dihapus dan memiliki stok
        if ($hewan->stok > 0) {
            Mutasi::create([
                'hewan_id' => $hewan->id,
                'jumlah' => $hewan->stok,
                'tipe_mutasi' => 'keluar',
                'referensi_id' => $hewan->id,
                'referensi_type' => 'App\Models\Hewan', // Atau 'HewanDelete'
                'deskripsi' => 'Penghapusan hewan dari sistem (stok dianggap keluar).',
            ]);
        }

        if ($hewan->gambar && Storage::disk('public')->exists($hewan->gambar)) {
            Storage::disk('public')->delete($hewan->gambar);
        }
        $hewan->delete();
        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil dihapus.');
    }
}
