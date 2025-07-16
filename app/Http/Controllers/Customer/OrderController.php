<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('orderItems.hewan')->orderBy('created_at', 'desc')->get();
        return view('customer.order-history', compact('orders'));
    }

    public function show(Order $order)
    {
        // Pastikan pesanan ini milik user yang sedang login
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $order->load('orderItems.hewan', 'rekeningPembayaran');
        return view('customer.order-detail', compact('order'));
    }
}
