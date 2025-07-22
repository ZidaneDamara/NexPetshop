<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Mutasi; // Import the Mutasi model

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user', 'rekeningPembayaran');

        if ($request->has('status') && in_array($request->status, ['pending', 'diproses', 'selesai', 'dibatalkan'])) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'rekeningPembayaran', 'orderItems.hewan');
        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,dibatalkan',
        ]);

        $oldStatus = $order->status; // Simpan status lama
        $order->status = $request->status;
        $order->load('orderItems'); // Load orderItems relationship
        $order->save();

        // Catat mutasi 'keluar' jika status berubah menjadi 'selesai'
        if ($oldStatus !== 'selesai' && $order->status === 'selesai') {
            foreach ($order->orderItems as $item) {
                Mutasi::create([
                    'hewan_id' => $item->hewan_id,
                    'jumlah' => $item->jumlah,
                    'tipe_mutasi' => 'keluar',
                    'referensi_id' => $order->id,
                    'referensi_type' => 'App\Models\Order',
                    'deskripsi' => 'Penjualan hewan melalui pesanan selesai.',
                ]);
            }
        }

        return redirect()->route('orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    // Optional: Delete order (if needed, but usually orders are not deleted)
    public function destroy(Order $order)
    {
        // Hapus bukti transfer jika ada
        if ($order->bukti_transfer && Storage::disk('public')->exists($order->bukti_transfer)) {
            Storage::disk('public')->delete($order->bukti_transfer);
        }
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
