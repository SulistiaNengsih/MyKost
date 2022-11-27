<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembukuanController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\KostController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

Route::get('/kost', [KostController::class, 'showKost']);

Route::post('/update-kost', [KostController::class, 'updateKost']);

require __DIR__.'/auth.php';
