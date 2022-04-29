<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\LowonganController;
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
    return view('welcome');
});
Route::get('/test', [TestController::class, 'test']);
Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan');
Route::get('/lowongan/tambah-lowongan', [LowonganController::class, 'tambah'])->name('tambah-lowongan');
Route::post('/lowongan/tambah-lowongan', [LowonganController::class, 'tambahAction']);
Route::get('/lowongan/ubah-lowongan/{lowonganId:uuid}', [LowonganController::class, 'ubah'])->name('ubah-lowongan');
Route::post('/lowongan/ubah-lowongan/{lowonganId:uuid}', [LowonganController::class, 'ubahAction']);
Route::delete('/lowongan/hapus-lowongan/{lowonganId:uuid}', [LowonganController::class, 'deleteAction'])->name('hapus-lowongan');

Route::get('/daftar', [RegisterController::class, 'daftar']);
Route::post('/daftar', [RegisterController::class, 'daftarAction']);

Route::get('/masuk', function () {
    return view('user.masuk');
});
Route::post('/masuk', function (Request $request) {
    dd($request->all());
});
