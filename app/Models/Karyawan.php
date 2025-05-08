<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    // Tambahkan field yang boleh diisi (bukan _token)
    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'unit_kerja',
        // tambahkan kolom lain yang sesuai dengan tabel karyawans
    ];
}
