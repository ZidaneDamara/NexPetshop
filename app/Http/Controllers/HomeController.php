<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\KategoriHewan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $kategori = KategoriHewan::all();

        // Filter hewan berdasarkan kategori jika ada parameter 'kategori_id'
        $query = Hewan::with('kategori');

        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_hewan_id', $request->kategori_id);
        }

        $hewans = $query->get();

        return view('home', compact('kategori', 'hewans'));
    }

    public function showHewan(Hewan $hewan)
    {
        return view('customer.hewandetail', compact('hewan'));
    }
}
