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
        Schema::create('laporan_gangguans', function (Blueprint $table) {
            $table->id();
            $table->string('no_hp');
            $table->string('no_id');
            $table->string('lokasi_gangguan');
            $table->text('deskripsi_laporan');
            $table->timestamps(); // Kolom untuk waktu pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_gangguans');
    }
};
