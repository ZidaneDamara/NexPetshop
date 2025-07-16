<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriHewanController;
use App\Http\Controllers\RekeningPembayaranController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Route Master Data
    route::resource('kategori-hewan', KategoriHewanController::class);
    Route::resource('hewan', HewanController::class);
    Route::resource('rekening-pembayaran', RekeningPembayaranController::class);
});

require __DIR__.'/auth.php';