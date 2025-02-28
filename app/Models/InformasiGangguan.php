<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiGangguan extends Model
{
    /** @use HasFactory<\Database\Factories\InformasiGangguanFactory> */
    use HasFactory;
    protected $fillable = [
        'hari_tanggal',
        'waktu',
        'wilayah_pemeliharaan',
        'informasi_gangguan',
        'dampak_gangguan',
    ];
}
