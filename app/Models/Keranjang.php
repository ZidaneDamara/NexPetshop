<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $fillable = [
        'user_id',
        'hewan_id',
        'jumlah'
    ];

    /**
     * Get the user that owns the cart item
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that is in the cart
     */
    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }

    /**
     * Calculate subtotal for this cart item
     */
    public function getSubtotalAttribute()
    {
        return $this->hewan->harga * $this->jumlah;
    }
}
