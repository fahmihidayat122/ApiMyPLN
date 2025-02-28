<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPemadaman extends Model
{
    /** @use HasFactory<\Database\Factories\InformasiPemadamanFactory> */
    use HasFactory;
    protected $fillable = [
        'hari_tanggal',
        'waktu',
        'wilayah_pemeliharaan',
        'pekerjaan',
    ];
}
