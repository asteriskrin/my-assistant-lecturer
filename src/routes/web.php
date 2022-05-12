<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\AsistenDosenController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/test', [TestController::class, 'test']);
Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan');
Route::get('/lowongan/{lowonganId:uuid}', [LowonganController::class, 'detail'])->name('detail-lowongan');
Route::middleware('auth')->group(function() {
    Route::middleware('dosen')->group(function () {
        Route::get('/tambah-lowongan', [LowonganController::class, 'tambah'])->name('tambah-lowongan');
        Route::post('/tambah-lowongan', [LowonganController::class, 'tambahAction']);
        Route::get('/ubah-lowongan/{lowonganId:uuid}', [LowonganController::class, 'ubah'])->name('ubah-lowongan');
        Route::post('/ubah-lowongan/{lowonganId:uuid}', [LowonganController::class, 'ubahAction']);
        Route::delete('/hapus-lowongan/{lowonganId:uuid}', [LowonganController::class, 'deleteAction'])->name('hapus-lowongan');
    });
    Route::middleware('mahasiswa')->group(function () {
        Route::post('/lowongan/lamar/{lowonganId:uuid}', [AsistenDosenController::class, 'lamar'])->name('lamar');
        Route::get('/lamaranku', [AsistenDosenController::class, 'index'])->name('lamaran');
    });
    Route::post('/keluar', [LoginController::class, 'logout']);
});
Route::middleware('guest')->group(function() {
    Route::get('/daftar', [RegisterController::class, 'daftar']);
    Route::post('/daftar', [RegisterController::class, 'daftarAction']);
    Route::get('/masuk', [LoginController::class, 'masuk']);
    Route::post('/masuk', [LoginController::class, 'authenticate']);
});
