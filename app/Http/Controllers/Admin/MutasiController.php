<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mutasi;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasis = Mutasi::with('hewan')->orderBy('created_at', 'desc')->get();
        return view('admin.mutasi.index', compact('mutasis'));
    }

    // Mutasi records are created by other controllers (HewanController, OrderController),
    // so no create, store, edit, update, destroy methods are needed here.
}
