<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pembukuan;
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

/*
| We can put all of our HTTP method here. 
| We can return view or response (content, status number, header).
| dd means die dump, ada juga ddd yang lebih lengkap.
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pembukuan-pengeluaran', [Pembukuan::class, 'showPengeluaran']);

Route::get('/pembukuan-pemasukan', [Pembukuan::class, 'showPemasukan']);

Route::post('/delete-data', [Pembukuan::class, 'deleteData']);

Route::post('/store-data', [Pembukuan::class, 'storeData']);

Route::post('/update-data', [Pembukuan::class, 'updateData']);

Route::post('/add-kategori', [Pembukuan::class, 'addKategori']);

Route::get('/kelola-kategori', [Pembukuan::class, 'kelolaKategori']);

Route::post('/delete-kategori', [Pembukuan::class, 'deleteKategori']);

Route::post('/update-kategori', [Pembukuan::class, 'updateKategori']);



