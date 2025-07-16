<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource (cart contents).
     */
    public function index()
    {
        $keranjangItems = Auth::user()->keranjang()->with('hewan')->get();
        $totalHarga = $keranjangItems->sum(function ($item) {
            return $item->hewan->harga * $item->jumlah;
        });
        return view('customer.keranjang', compact('keranjangItems', 'totalHarga'));
    }

    /**
     * Store a newly created resource in storage (add to cart).
     */
    public function store(Request $request)
    {
        $request->validate([
            'hewan_id' => 'required|exists:hewans,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $hewan = Hewan::find($request->hewan_id);

        if (!$hewan) {
            return back()->with('error', 'Hewan tidak ditemukan.');
        }

        if ($request->jumlah > $hewan->stok) {
            return back()->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
        }

        $keranjangItem = Keranjang::where('user_id', Auth::id())
            ->where('hewan_id', $request->hewan_id)
            ->first();

        if ($keranjangItem) {
            // Update quantity if item already exists
            $newJumlah = $keranjangItem->jumlah + $request->jumlah;
            if ($newJumlah > $hewan->stok) {
                return back()->with('error', 'Penambahan jumlah melebihi stok yang tersedia.');
            }
            $keranjangItem->jumlah = $newJumlah;
            $keranjangItem->save();
        } else {
            // Add new item to cart
            Keranjang::create([
                'user_id' => Auth::id(),
                'hewan_id' => $request->hewan_id,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Hewan berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update the specified resource in storage (update cart item quantity).
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        if ($request->jumlah > $keranjang->hewan->stok) {
            return back()->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
        }

        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();

        return redirect()->route('keranjang.index')->with('success', 'Jumlah item keranjang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage (remove from cart).
     */
    public function destroy(Keranjang $keranjang)
    {
        $keranjang->delete();
        return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
