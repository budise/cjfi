<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAsset extends Model
{
    use HasFactory;

    const STATUS_GUDANG = 1;
    const STATUS_DIPINJAM = 2;

    protected $fillable = [
        'asset_id',
        'kode_asset',
        'lokasi',
        'tanggal_perolehan',
        'nilai_perolehan',
    ];

    /**
     * Relasi ke Asset
     * Setiap DetailAsset dimiliki oleh satu Asset
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
