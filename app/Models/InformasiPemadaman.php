<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPemadaman extends Model
{
    use HasFactory;

    protected $table = 'informasi_pemadamans';

    protected $fillable = [
        'admin_id',
        'hari_tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi_pemeliharaan',
        'pekerjaan',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
