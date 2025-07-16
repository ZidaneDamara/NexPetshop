<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningPembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bank',
        'nama_pemilik',
        'nomor_rekening',
        'logo',
        'status',
    ];
}