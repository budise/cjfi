<?php

// app/Models/KaryawanDetailAsset.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanDetailAsset extends Model
{
    use HasFactory;
    protected $table = 'karyawan_detail_asset'; 

    protected $fillable = [
        'karyawan_id',
        'detail_asset_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'keterangan',
        'status',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function detailAsset()
    {
        return $this->belongsTo(DetailAsset::class);
    }
}
