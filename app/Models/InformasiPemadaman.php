<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPemadaman extends Model
{
    /** @use HasFactory<\Database\Factories\InformasiPemadamanFactory> */
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'hari_tanggal',
        'waktu',
        'wilayah_pemeliharaan',
        'pekerjaan',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
