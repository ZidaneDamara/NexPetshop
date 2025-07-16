<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'hewan_id',
        'jumlah',
        'harga_satuan',
    ];

    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the hewan that is part of the order item.
     */
    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }
}
