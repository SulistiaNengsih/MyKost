<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembukuanController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\RekapDataController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [PembukuanController::class, 'showPengeluaran'])->middleware('auth');

Route::get('/pembukuan-pengeluaran', [PembukuanController::class, 'showPengeluaran'])->middleware('auth');

Route::get('/pembukuan-pemasukan', [PembukuanController::class, 'showPemasukan'])->middleware('auth');

Route::post('/delete-data', [PembukuanController::class, 'deleteData'])->middleware('auth');

Route::post('/store-data', [PembukuanController::class, 'storeData'])->middleware('auth');

Route::post('/update-data', [PembukuanController::class, 'updateData'])->middleware('auth');

Route::post('/add-kategori', [KategoriController::class, 'addKategori'])->middleware('auth');

Route::get('/kelola-kategori', [KategoriController::class, 'kelolaKategori'])->middleware('auth');

Route::post('/delete-kategori', [KategoriController::class, 'deleteKategori'])->middleware('auth');

Route::post('/update-kategori', [KategoriController::class, 'updateKategori'])->middleware('auth');

Route::get('/penghuni', [PenghuniController::class, 'showPenghuni'])->middleware('auth');

Route::post('/tambah-penghuni', [PenghuniController::class, 'tambahPenghuni'])->middleware('auth');

Route::post('/update-penghuni', [PenghuniController::class, 'updatePenghuni'])->middleware('auth');

Route::post('/hapus-penghuni', [PenghuniController::class, 'hapusPenghuni'])->middleware('auth');

Route::post('/tambah-riwayat-bayar', [PenghuniController::class, 'tambahRiwayatBayar'])->middleware('auth');

Route::post('/hapus-riwayat-bayar', [PenghuniController::class, 'hapusRiwayatBayar'])->middleware('auth');

Route::post('/update-riwayat-bayar', [PenghuniController::class, 'updateRiwayatBayar'])->middleware('auth');

Route::post('/update-kost', [KostController::class, 'updateKost'])->middleware('auth');

Route::post('/tambah-kost', [KostController::class, 'tambahKost'])->middleware('auth');

Route::get('/profile-pemilik', function() {
    return view ('profilePemilik');
})->middleware('auth');

require __DIR__.'/auth.php';
