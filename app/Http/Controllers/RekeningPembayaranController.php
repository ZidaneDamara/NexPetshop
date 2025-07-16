<?php

namespace App\Http\Controllers;

use App\Models\RekeningPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RekeningPembayaranController extends Controller
{
    public function index()
    {
        $rekenings = RekeningPembayaran::all();
        return view('admin.rekening.index', compact('rekenings'));
    }

    public function create()
    {
        return view('admin.rekening.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:150',
            'nama_pemilik' => 'required|string|max:150',
            'nomor_rekening' => 'required|string|max:100|unique:rekening_pembayarans,nomor_rekening',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        RekeningPembayaran::create([
            'nama_bank' => $request->nama_bank,
            'nama_pemilik' => $request->nama_pemilik,
            'nomor_rekening' => $request->nomor_rekening,
            'logo' => $logoPath,
            'status' => $request->status,
        ]);

        return redirect()->route('rekening-pembayaran.index')->with('success', 'Rekening berhasil ditambahkan.');
    }

    public function edit(RekeningPembayaran $rekening_pembayaran)
    {
        return view('admin.rekening.edit', compact('rekening_pembayaran'));
    }

    public function update(Request $request, RekeningPembayaran $rekening_pembayaran)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:150',
            'nama_pemilik' => 'required|string|max:150',
            'nomor_rekening' => 'required|string|max:100|unique:rekening_pembayarans,nomor_rekening,' . $rekening_pembayaran->id,
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $logoPath = $rekening_pembayaran->logo;

        if ($request->hasFile('logo')) {
            // Optional: delete existing logo
            if ($logoPath) {
                Storage::disk('public')->delete($logoPath);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $rekening_pembayaran->update([
            'nama_bank' => $request->nama_bank,
            'nama_pemilik' => $request->nama_pemilik,
            'nomor_rekening' => $request->nomor_rekening,
            'logo' => $logoPath,
            'status' => $request->status,
        ]);

        return redirect()->route('rekening-pembayaran.index')->with('success', 'Rekening berhasil diperbarui.');
    }

    public function destroy(RekeningPembayaran $rekening_pembayaran)
    {
        if ($rekening_pembayaran->logo) {
            Storage::disk('public')->delete($rekening_pembayaran->logo);
        }

        $rekening_pembayaran->delete();
        return redirect()->route('rekening-pembayaran.index')->with('success', 'Rekening berhasil dihapus.');
    }
}