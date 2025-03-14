<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiGangguan extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'laporan_gangguan_id',
        'hari_tanggal',
        'waktu',
        'wilayah_pemeliharaan',
        'informasi_gangguan',
        'dampak_gangguan',
    ];

    // public function laporanGangguan()
    // {
    //     return $this->belongsTo(LaporanGangguan::class, 'laporan_gangguan_id');
    // }
}
