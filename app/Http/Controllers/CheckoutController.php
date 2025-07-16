<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\RekeningPembayaran;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $keranjangItems = $user->keranjang()->with('hewan')->get();

        if ($keranjangItems->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong, tidak dapat melanjutkan ke checkout.');
        }

        $totalHarga = $keranjangItems->sum(function ($item) {
            return $item->hewan->harga * $item->jumlah;
        });

        $rekeningPembayaran = RekeningPembayaran::where('status', 'aktif')->get();

        // Anda bisa mengambil alamat dan telepon dari model User jika sudah ada
        // $alamatUser = $user->address;
        // $teleponUser = $user->phone;

        return view('customer.checkout', compact('keranjangItems', 'totalHarga', 'rekeningPembayaran', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string|max:500',
            'telepon_penerima' => 'required|string|max:20',
            'rekening_pembayaran_id' => 'required|exists:rekening_pembayarans,id',
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
        ]);

        $user = Auth::user();
        $keranjangItems = $user->keranjang()->with('hewan')->get();

        if ($keranjangItems->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong, tidak dapat melanjutkan ke checkout.');
        }

        $totalHarga = $keranjangItems->sum(function ($item) {
            return $item->hewan->harga * $item->jumlah;
        });

        DB::beginTransaction();
        try {
            // Upload bukti transfer
            $buktiTransferPath = null;
            if ($request->hasFile('bukti_transfer')) {
                $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            }

            // Generate unique order number
            $nomorPesanan = 'ORD-' . date('YmdHis') . '-' . uniqid();

            // Create new order
            $order = Order::create([
                'user_id' => $user->id,
                'nomor_pesanan' => $nomorPesanan,
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'telepon_penerima' => $request->telepon_penerima,
                'rekening_pembayaran_id' => $request->rekening_pembayaran_id,
                'bukti_transfer' => $buktiTransferPath,
                'total_harga' => $totalHarga,
                'status' => 'pending', // Initial status
            ]);

            // Move items from cart to order_items and update hewan stok
            foreach ($keranjangItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'hewan_id' => $item->hewan_id,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->hewan->harga,
                ]);

                // Update hewan stok
                $hewan = $item->hewan;
                $hewan->stok -= $item->jumlah;
                $hewan->save();
            }

            // Clear user's cart
            $user->keranjang()->delete();

            DB::commit();
            return redirect()->route('checkout.success', $order->id)->with('success', 'Pesanan Anda berhasil dibuat! Menunggu konfirmasi pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Hapus bukti transfer jika terjadi error
            if ($buktiTransferPath && Storage::disk('public')->exists($buktiTransferPath)) {
                Storage::disk('public')->delete($buktiTransferPath);
            }
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan Anda: ' . $e->getMessage())->withInput();
        }
    }

    public function success($orderId)
    {
        $order = Order::with('orderItems.hewan', 'rekeningPembayaran')->findOrFail($orderId);
        return view('customer.checkout-succes', compact('order'));
    }
}
