<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\LowonganController;

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
