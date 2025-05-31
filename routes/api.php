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

/**
 * Route untuk Admin
 */
// Route::prefix('admin')->group(function () {
//     Route::post('/register', [AdminController::class, 'register']);
//     Route::post('/login', [AdminController::class, 'login']);

//     Route::middleware(['auth:sanctum', 'user.type:admin'])->group(function () {
//         Route::post('logout', [AdminController::class, 'logout']);
//         Route::get('list', [AdminController::class, 'listUsers']);
//         Route::get('profile', [AdminController::class, 'profile']);
//         Route::get('users/search', [AdminController::class, 'searchUsers']);
//         Route::get('users/{id}', [AdminController::class, 'getUser']);
//         Route::put('users/{id}', [AdminController::class, 'updateUser']);
//         Route::delete('users/{id}', [AdminController::class, 'deleteUser']);

//         // Informasi Pemadaman
//         Route::get('informasi-pemadaman', [InformasiPemadamanController::class, 'index']);
//         Route::get('informasi-pemadaman/create', [InformasiPemadamanController::class, 'create']);
//         Route::post('informasi-pemadaman', [InformasiPemadamanController::class, 'store']);
//         Route::get('informasi-pemadaman/{id}', [InformasiPemadamanController::class, 'show']);


//         // Informasi Gangguan (Admin hanya bisa mengelola)
//         Route::apiResource('informasi-gangguan', InformasiGangguanController::class)->except(['update', 'destroy']);
//         Route::get('informasi-gangguan/laporan/{laporan_gangguan_id}', [InformasiGangguanController::class, 'getByLaporanGangguan']);

//         // Laporan Gangguan (Admin hanya bisa melihat)
//         Route::get('laporan-gangguan', [LaporanGangguanController::class, 'index']);
//         Route::get('laporan-gangguan/{id}', [LaporanGangguanController::class, 'show']);
//     });
// });

/**
 * Route untuk User
 */
Route::prefix('user')->group(function () {
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/forgot-password', [UserAuthController::class, 'resetPassword']);
    Route::post('/send-reset-otp', [UserAuthController::class, 'sendResetOtp']);


    Route::get('informasi-pemadaman', [InformasiPemadamanController::class, 'getInformasiPemadaman']);

    Route::get('informasi-gangguan', [InformasiGangguanController::class, 'getByInformasiGangguan']);

    Route::get('laporan-gangguan', [LaporanGangguanController::class, 'indexLaporan']); // Ambil semua laporan
    Route::post('laporan-gangguan', [LaporanGangguanController::class, 'store']); // Kirim laporan baru
    Route::get('laporan-gangguan/{id}', [LaporanGangguanController::class, 'show']); // Ambil detail laporan

    Route::get('/{id}', [UserAuthController::class, 'getUserById']);

    Route::middleware(['auth:sanctum', 'user.type:user'])->group(function () {
        Route::post('logout', [UserAuthController::class, 'logout']);

        // Route::get('profile', [UserController::class, 'profile']);
        // Route::put('profile', [UserController::class, 'updateProfile']);

        // // Informasi Pemadaman
        // Route::get('informasi-pemadaman', [InformasiPemadamanController::class, 'index']);
        // Route::get('informasi-pemadaman/{id}', [InformasiPemadamanController::class, 'show']);

        // // Laporan Gangguan (User bisa membuat & melihat laporan miliknya)
        // Route::apiResource('laporan-gangguan', LaporanGangguanController::class)->except(['update', 'destroy']);
        // Route::post('laporan-gangguan/{id}/update', [LaporanGangguanController::class, 'update']);
    });
});




// Route::apiResource('/informasi-pemadaman', InformasiPemadamanController::class);
// Route::apiResource('/informasi-gangguan', InformasiGangguanController::class);
// Route::apiResource('/laporan-gangguan', LaporanGangguanController::class);
// Route::post('/laporan-gangguan/{id}', [LaporanGangguanController::class, 'update']);
