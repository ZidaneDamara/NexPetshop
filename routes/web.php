<?php

use App\Models\User;
use App\Models\Hewan;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\KategoriHewanController;
use App\Http\Controllers\RekeningPembayaranController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController; // Alias untuk Admin OrderController
use App\Http\Controllers\Customer\OrderController as CustomerOrderController; // Alias untuk Customer OrderController

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
    Route::resource('keranjang', KeranjangController::class)->except(['show']);

    // Rute Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Rute Riwayat Pesanan Pelanggan
    Route::get('/my-orders', [CustomerOrderController::class, 'index'])->name('customer.orders.index');
    Route::get('/my-orders/{order}', [CustomerOrderController::class, 'show'])->name('customer.orders.show');

    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/dashboard', function () {
    $totalCustomers = User::where('role', 'customer')->count();
    $totalAnimals = Hewan::count();
    $totalSales = Order::where('status', 'selesai')->sum('total_harga');
    $pendingOrders = Order::where('status', 'pending')->count();
    $recentCustomers = User::where('role', 'customer')->orderBy('created_at', 'desc')->take(5)->get();
    $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();
    return view('dashboard', compact(
        'totalCustomers',
        'totalAnimals',
        'totalSales',
        'pendingOrders',
        'recentCustomers',
        'recentOrders'
    ));
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    //Route Master Data
    Route::prefix('admin')->group(function () {
        Route::resource('kategori', KategoriHewanController::class);
        Route::resource('hewan', HewanController::class);
        Route::resource('rekening-pembayaran', RekeningPembayaranController::class);

        // Rute Manajemen Pesanan (Admin)
        Route::resource('orders', AdminOrderController::class)->except(['create', 'store', 'edit']);
        Route::put('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    });
});

require __DIR__ . '/auth.php';
