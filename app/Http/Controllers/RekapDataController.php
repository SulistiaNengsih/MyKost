<?php

namespace App\Http\Controllers;
use App\Models\KategoriPemasukan;
use App\Models\KategoriPengeluaran;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekapDataController extends Controller
{
    public function showRekapData() {
        $id_user = Auth::user()->id;
        return view ('rekapData', [
            'kategoriPemasukan' => KategoriPemasukan::where('id_user', '=', $id_user),
            'kategoriPengeluaran' => KategoriPengeluaran::where('id_user', '=', $id_user),
            'pemasukan' => Pemasukan::get(),
            'pengeluaran' => Pengeluaran::get(),
            'pemasukanJanuari' => Pemasukan::sum('nominal as januari')->get()
        ]);
    }
}
