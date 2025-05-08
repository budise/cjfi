<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    // Nama tabel jika tidak mengikuti konvensi jamak
    // protected $table = 'assets';

    // Kolom yang boleh diisi secara mass assignment
    protected $fillable = [
        'nama_asset',
        'deskripsi',
    ];

    /**
     * Relasi ke DetailAsset
     * Setiap Asset bisa memiliki banyak DetailAsset
     */
    public function detailAssets()
    {
        return $this->hasMany(DetailAsset::class);
    }
}
