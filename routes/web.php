<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembukuanController;
use App\Http\Controllers\PenghuniController;

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

/*
| We can put all of our HTTP method here. 
| We can return view or response (content, status number, header).
| dd means die dump, ada juga ddd yang lebih lengkap.
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pembukuan-pengeluaran', [PembukuanController::class, 'showPengeluaran']);

Route::get('/pembukuan-pemasukan', [PembukuanController::class, 'showPemasukan']);

Route::post('/delete-data', [PembukuanController::class, 'deleteData']);

Route::post('/store-data', [PembukuanController::class, 'storeData']);

Route::post('/update-data', [PembukuanController::class, 'updateData']);

Route::post('/add-kategori', [PembukuanController::class, 'addKategori']);

Route::get('/kelola-kategori', [PembukuanController::class, 'kelolaKategori']);

Route::post('/delete-kategori', [PembukuanController::class, 'deleteKategori']);

Route::post('/update-kategori', [PembukuanController::class, 'updateKategori']);

Route::get('/penghuni', [PenghuniController::class, 'showPenghuni']);

Route::post('/tambah-penghuni', [PenghuniController::class, 'tambahPenghuni']);

Route::post('/update-penghuni', [PenghuniController::class, 'updatePenghuni']);

Route::post('/hapus-penghuni', [PenghuniController::class, 'hapusPenghuni']);

Route::post('/update-pembayaran', [PenghuniController::class, 'updateStatusPembayaran']);



