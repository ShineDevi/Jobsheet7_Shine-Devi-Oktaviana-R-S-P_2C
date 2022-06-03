<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Http\Request;

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
Route::prefix('mahasiswa')->group(function () {
    Route::get('nilai/{nim}', [MahasiswaController::class, 'tampil_khs'])->name('mahasiswa.khs');
    Route::get('cetak_khs/{nim}', [MahasiswaController::class, 'cetak_khs'])->name('mahasiswa.cetak_khs');
});
Route::resource('mahasiswa', MahasiswaController::class);
Route::post('search', [MahasiswaController::class, 'searchMhs'])->name('mahasiswa.search');
