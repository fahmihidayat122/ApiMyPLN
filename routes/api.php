<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\UserAuthController;

use App\Http\Controllers\InformasiPemadamanController;
use App\Http\Controllers\InformasiGangguanController;
use App\Http\Controllers\LaporanGangguanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('user')->group(function () {
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/forgot-password', [UserAuthController::class, 'resetPassword']);
    //Route::post('/send-reset-otp', [UserAuthController::class, 'sendResetOtp']);


    Route::get('informasi-pemadaman', [InformasiPemadamanController::class, 'getInformasiPemadaman']);

    Route::get('informasi-gangguan', [InformasiGangguanController::class, 'getByInformasiGangguan']);

    Route::get('laporan-gangguan', [LaporanGangguanController::class, 'indexLaporan']); // Ambil semua laporan
    Route::post('laporan-gangguan', [LaporanGangguanController::class, 'store']); // Kirim laporan baru
    Route::get('laporan-gangguan/{id}', [LaporanGangguanController::class, 'show']); // Ambil detail laporan

    Route::get('/{id}', [UserAuthController::class, 'getUserById']);

    Route::middleware(['auth:sanctum', 'user.type:user'])->group(function () {
        Route::post('logout', [UserAuthController::class, 'logout']);
    });
});
