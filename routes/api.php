<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InformasiPemadamanController;
use App\Http\Controllers\InformasiGangguanController;
use App\Http\Controllers\LaporanGangguanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/informasi-pemadaman', InformasiPemadamanController::class);
Route::apiResource('/informasi-gangguan', InformasiGangguanController::class);
Route::apiResource('/laporan-gangguan', LaporanGangguanController::class);
