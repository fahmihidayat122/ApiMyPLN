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
        Schema::create('informasi_gangguans', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('laporan_gangguan_id')
            //     ->constrained('laporan_gangguans')
            //     ->onDelete('cascade'); // Foreign key yang benar
            $table->date('hari_tanggal');
            $table->time('waktu');
            $table->string('wilayah_pemeliharaan');
            $table->string('informasi_gangguan');
            $table->string('dampak_gangguan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_gangguans');
    }
};
