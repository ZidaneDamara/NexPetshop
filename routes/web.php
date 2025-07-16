<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriHewanController;
use App\Http\Controllers\RekeningPembayaranController;
use App\Http\Controllers\KeranjangController; // Import KeranjangController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rute untuk halaman depan (homepage)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/hewan/{hewan}', [HomeController::class, 'showHewan'])->name('hewan.customer.show');

// Rute yang memerlukan otentikasi (untuk pelanggan)
Route::middleware('auth')->group(function () {
    // Rute Keranjang
    Route::resource('keranjang', KeranjangController::class)->except(['show']); // Tidak perlu show untuk keranjang
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Route Master Data
    Route::prefix('admin')->group(function () {
        Route::resource('kategori', KategoriHewanController::class);
        Route::resource('hewan', HewanController::class);
        Route::resource('rekening-pembayaran', RekeningPembayaranController::class);
    });
});

require __DIR__ . '/auth.php';
