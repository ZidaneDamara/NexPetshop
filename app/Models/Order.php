<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_pesanan',
        'alamat_pengiriman',
        'telepon_penerima',
        'rekening_pembayaran_id',
        'bukti_transfer',
        'total_harga',
        'status',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payment account associated with the order.
     */
    public function rekeningPembayaran()
    {
        return $this->belongsTo(RekeningPembayaran::class);
    }

    /**
     * Get the order items for the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
