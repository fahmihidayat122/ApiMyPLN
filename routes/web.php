<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InformasiPemadamanController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\InformasiGangguanController;
use App\Http\Controllers\LaporanGangguanController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/register', [AdminAuthController::class, 'register']);
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('informasi-pemadaman', InformasiPemadamanController::class);
    Route::resource('informasi-gangguan', InformasiGangguanController::class);
    Route::resource('laporan-gangguan', LaporanGangguanController::class);
    Route::resource('pengguna', UserController::class);
});
