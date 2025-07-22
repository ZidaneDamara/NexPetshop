<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'hewan_id',
        'jumlah',
        'tipe_mutasi',
        'referensi_id',
        'referensi_type',
        'deskripsi',
    ];

    /**
     * Get the hewan that the mutation belongs to.
     */
    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }

    /**
     * Get the parent referensi model (e.g., Order).
     */
    public function referensi()
    {
        return $this->morphTo();
    }
}
