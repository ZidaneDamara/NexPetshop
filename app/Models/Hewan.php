<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'ras',
        'jenis_kelamin',
        'umur',
        'deskripsi',
        'harga',
        'stok',
        'status_kesehatan',
        'sudah_vaksin',
        'gambar',
        'berat',
        'warna',
        'kategori_hewan_id',
    ];

    // protected $casts = [
    //     'gambar' => 'array',
    //     'sudah_vaksin' => 'boolean',
    // ];

    public function kategori()
    {
        return $this->belongsTo(KategoriHewan::class, 'kategori_hewan_id');
    }
}