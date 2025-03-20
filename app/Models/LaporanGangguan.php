<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanGangguan extends Model
{
    use HasFactory;

    protected $table = 'laporan_gangguans'; // Nama tabel sesuai migrasi

    protected $fillable = [
        'no_hp',
        'no_id',
        'lokasi_gangguan',
        'deskripsi_laporan',
    ];

    // // Relasi ke InformasiGangguan
    // public function informasiGangguan()
    // {
    //     return $this->hasOne(InformasiGangguan::class, 'laporan_gangguan_id');
    // }
}
