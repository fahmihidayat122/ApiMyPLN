<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informasi_pemadamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users (admin)
            $table->date('hari_tanggal');
            $table->time('waktu');
            $table->string('wilayah_pemeliharaan');
            $table->string('pekerjaan');
            $table->timestamps(); // Kolom untuk waktu pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_pemadamen');
    }
};
