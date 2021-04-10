<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middlewae\LevelChecker;
use App\Http\Controllers\Auth\KelasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PembayaranController;
use App\Http\Controllers\Auth\PetugasController;
use App\Http\Controllers\Auth\SiswaController;
use App\Http\Controllers\Auth\SppController;
use App\Http\Controllers\Auth\UsersController;

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
Route::get('/', function () {
    return view('index');
});

Route::resource('login', LoginController::class);
Route::post('logout', [LogoutController::class, 'store'])->name('logout');

Route::middleware(['auth', 'levelchecker:admin'])->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('spp', SppController::class);
});

Route::middleware(['auth', 'levelchecker:admin,petugas'])->group(function () {
    Route::get('export-pdf', [PembayaranController::class, 'exportPdf'])->name('pembayaran.export');
});

Route::middleware(['auth', 'levelchecker:admin,petugas,siswa'])->group(function () {
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('detail/{id}', [PembayaranController::class, 'detail'])->name('pembayaran.detail');
    Route::resource('users', UsersController::class);
});
