<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengembalianAsset extends Model
{
    protected $fillable = ['karyawan_detail_asset_id', 'tanggal_kembali', 'keterangan'];

    public function karyawanDetailAsset()
    {
        return $this->belongsTo(KaryawanDetailAsset::class);
    }
}
