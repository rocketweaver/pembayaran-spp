<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PetugasController;
use App\Http\Controllers\Auth\KelasController;
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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
// Route::get('petugas', [PetugasController::class, 'index'])->name('petugas');
// Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
// Route::post('/petugas/create/store', [PetugasController::class, 'store'])->name('petugas.create.store');
Route::resource('petugas', PetugasController::class);
Route::resource('kelas', KelasController::class);
Route::resource('spp', SppController::class);