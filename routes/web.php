<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middlewae\LevelChecker;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\HistoryPembayaranController;
use App\Http\Controllers\Auth\KelasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PembayaranController;
use App\Http\Controllers\Auth\PetugasController;
use App\Http\Controllers\Auth\SiswaController;
use App\Http\Controllers\Auth\SppController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('login', LoginController::class);
Route::post('logout', [LogoutController::class, 'store'])->name('logout');

Route::middleware(['auth', 'level.checker:admin'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('history-pembayaran', HistoryPembayaranController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('spp', SppController::class);
});

Route::middleware(['auth', 'level.checker:admin, petugas'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('history-pembayaran', HistoryPembayaranController::class);
    Route::resource('pembayaran', PembayaranController::class);
});

Route::middleware(['auth', 'level.checker:admin, petugas, siswa'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('history-pembayaran', HistoryPembayaranController::class);
});

// Route::middleware(['auth', 'level.checker:admin'])->group(function () {
//     Route::resource('dashboard', DashboardController::class);
//     Route::resource('history-pembayaran', HistoryPembayaranController::class);
//     Route::resource('kelas', KelasController::class);
//     Route::resource('pembayaran', PembayaranController::class);
//     Route::resource('petugas', PetugasController::class);
//     Route::resource('siswa', SiswaController::class);
//     Route::resource('spp', SppController::class);
// });