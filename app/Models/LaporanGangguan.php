<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanGangguan extends Model
{
    /** @use HasFactory<\Database\Factories\LaporanGangguanFactory> */
    use HasFactory;
    protected $fillable = [
        'no_hp',
        'no_id',
        'lokasi_gangguan',
        'deskripsi_laporan',
    ];

    public function informasiGangguan()
    {
        return $this->hasOne(InformasiGangguan::class, 'laporan_gangguan_id');
    }
}
