<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\KategoriPemasukan;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriPengeluaran;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function kelolaKategori() {
        $id_user = Auth::user()->id;

        return view('kelolaKategori', [
            'kategoriPengeluaran' => KategoriPengeluaran::get()->where('id_user', '=', $id_user),
            'kategoriPemasukan' => KategoriPemasukan::get()->where('id_user', '=', $id_user)
        ]);
    }

    public function addKategori(Request $request) {
        $validate = $request->validate([
            'jenis' => 'required',
            'namaKategori' => 'required|max:50'
        ]);

        $tabel = 'kategori_'.$request->jenis;
        $kolom = 'jenis_'.$request->jenis;
        $id_user = Auth::user()->id;

        DB::table($tabel)->insert([
            $kolom => $request->namaKategori,
            'id_user' => $id_user
        ]);

        return back()->with('statusBerhasil', 'Kategori '.$request->namaKategori.' berhasil ditambahkan!');
    }

    public function updateKategori(Request $request) {
        $validate = $request->validate([
            'idUpdate' => 'required',
            'jenisUpdate' => 'required',
            'nama' => 'required|max:50'
        ]);

        if ($request->jenisUpdate === "Pengeluaran") {
            KategoriPengeluaran::where('id', $request->idUpdate)
            ->update([
                'jenis_pengeluaran' => $request->nama
            ]);
        } else {
            KategoriPemasukan::where('id', $request->idUpdate)
            ->update([
                'jenis_pemasukan' => $request->nama
            ]);
        }
        
        return back()->with('statusBerhasil', 'Kategori berhasil diupdate!');
    }

    public function deleteKategori(Request $request) {
        if ($request->jenis === "Pengeluaran") {
            foreach (Pengeluaran::get() as $p) {
                Pengeluaran::where('id_kategori_pengeluaran', '=', $request->id)->delete();
            }
            KategoriPengeluaran::where('id', '=', $request->id)->delete();
        } else {
            foreach (Pemasukan::get() as $p) {
                Pemasukan::where('id_kategori_pemasukan', '=', $request->id)->delete();
            }
            KategoriPemasukan::where('id', '=', $request->id)->delete();
        }

        return back()->with('statusBerhasil', 'Kategori berhasil dihapus!');
    }
}
