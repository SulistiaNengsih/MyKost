<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriPengeluaran;
use App\Models\KategoriPemasukan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class Pembukuan extends Controller
{
    public function showPengeluaran(Request $request) {
        if (empty($request->filter)) {
            return view('pembukuan-pengeluaran', [
                'pengeluaran' => Pengeluaran::join('kategori_pengeluaran', 'pengeluaran.id_kategori_pengeluaran', '=', 'kategori_pengeluaran.id')
                ->select('pengeluaran.*', 'kategori_pengeluaran.jenis_pengeluaran')
                ->get(),
    
                'filter' => $request->filter
            ],
            [
                'kategoriPengeluaran' => KategoriPengeluaran::get()
            ]
            );
        } else {
            return view('pembukuan-pengeluaran', [
                'pengeluaran' => Pengeluaran::join('kategori_pengeluaran', 'pengeluaran.id_kategori_pengeluaran', '=', 'kategori_pengeluaran.id')
                ->select('pengeluaran.*', 'kategori_pengeluaran.jenis_pengeluaran')
                ->where('jenis_pengeluaran', '=', $request->filter)
                ->get(),
    
                'filter' => $request->filter
            ],
            [
                'kategoriPengeluaran' => KategoriPengeluaran::get()
            ]
            );
        }     
    }

    public function showPemasukan(Request $request) {
        if (empty($request->filter)) {
            return view('pembukuan-pemasukan', [
                'pemasukan' => Pemasukan::join('kategori_pemasukan', 'pemasukan.id_kategori_pemasukan', '=', 'kategori_pemasukan.id')
                            ->select('pemasukan.*', 'kategori_pemasukan.jenis_pemasukan')
                            ->get(),
                            
                'filter' => $request->filter
            ],
            [
                'kategoriPemasukan' => KategoriPemasukan::get()
            ]
            );
        } else {
            return view('pembukuan-pemasukan', [
                'pemasukan' => Pemasukan::join('kategori_pemasukan', 'pemasukan.id_kategori_pemasukan', '=', 'kategori_pemasukan.id')
                            ->select('pemasukan.*', 'kategori_pemasukan.jenis_pemasukan')
                            ->where('jenis_pemasukan', '=', $request->filter)
                            ->get(),
                            
                'filter' => $request->filter
            ],
            [
                'kategoriPemasukan' => KategoriPemasukan::get()
            ]
            );
        } 
    }

    public function storeData(Request $request) {
        $pos = strpos($request->jenis, '-');
        $kategori = substr($request->jenis, 0, $pos);

        if ($request->storeJenis === 'pengeluaran') {
            Pengeluaran::insert([
                'id_kategori_pengeluaran' => $kategori,
                'ket_pengeluaran' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal
            ]);
            
        } else {
            Pemasukan::insert([
                'id_kategori_pemasukan' => $kategori,
                'ket_pemasukan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal
            ]);
        }  
        return back();  
    }

    public function deleteData(Request $request) {
        if ($request->jenis === "pengeluaran") {
            Pengeluaran::where('id', '=', $request->id)->delete();
        } else {
            Pemasukan::where('id', '=', $request->id)->delete();
        }

        return back();
    }

    public function addKategori(Request $request) {
        $tabel = 'kategori_'.$request->jenis;
        $kolom = 'jenis_'.$request->jenis;
        $returnUrl = '/pembukuan-'.$request->jenis;

        DB::table($tabel)->insert([
            $kolom => $request->namaKategori
        ]);

        return back();
    }
        
    public function updateData(Request $request) {
        if ($request->jenisUpdate === 'Pengeluaran') {
            $pos = strpos($request->jenis, '-');
            $kategori = substr($request->jenis, 0, $pos);

            DB::table('Pengeluaran')
            ->where('id', $request->idUpdate)
            ->update([
                'id_kategori_pengeluaran' => $kategori,
                'ket_pengeluaran' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal
            ]);

            // return redirect('/pembukuan-pengeluaran');
        } else {
            $pos = strpos($request->jenis, '-');
            $kategori = substr($request->jenis, 0, $pos);

            DB::table('Pemasukan')
            ->where('id', $request->idUpdate)
            ->update([
                'id_kategori_pemasukan' => $kategori,
                'ket_pemasukan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal
            ]);

            // return redirect('/pembukuan-pemasukan');
        }
        return back();
    }
}
