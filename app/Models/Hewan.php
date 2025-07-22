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
        'gambar', // Pastikan 'gambar' tetap fillable
        'berat',
        'warna',
        'kategori_hewan_id',
        'pemasok_id', // Tambahkan baris ini
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     // 'gambar' => 'array', // Hapus baris ini
    //     'sudah_vaksin' => 'boolean',
    // ];

    /**
     * Get the kategori that owns the hewan.
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriHewan::class, 'kategori_hewan_id');
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }
}
