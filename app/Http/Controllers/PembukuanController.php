<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriPengeluaran;
use App\Models\KategoriPemasukan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class PembukuanController extends Controller
{
    public function showPengeluaran(Request $request) {
        $id_user = Auth::user()->id;
        if (empty($request->filter)) {
            return view('pembukuan-pengeluaran', [
                'pengeluaran' => Pengeluaran::join('kategori_pengeluaran', 'pengeluaran.id_kategori_pengeluaran', '=', 'kategori_pengeluaran.id')
                ->select('pengeluaran.*', 'kategori_pengeluaran.jenis_pengeluaran')
                ->where('kategori_pengeluaran.id_user', '=', $id_user)
                ->get(),
    
                'filter' => $request->filter,
                'id_user' => $id_user
            ],
            [
                'kategoriPengeluaran' => KategoriPengeluaran::get()->where('id_user', '=', $id_user)
            ]
            );
        } else {
            return view('pembukuan-pengeluaran', [
                'pengeluaran' => Pengeluaran::join('kategori_pengeluaran', 'pengeluaran.id_kategori_pengeluaran', '=', 'kategori_pengeluaran.id')
                ->select('pengeluaran.*', 'kategori_pengeluaran.jenis_pengeluaran')
                ->where('jenis_pengeluaran', '=', $request->filter)
                ->get(),
    
                'filter' => $request->filter,
                'id_user' => $id_user
            ],
            [
                'kategoriPengeluaran' => KategoriPengeluaran::get()->where('id_user', '=', $id_user)
            ]
            );
        }     
    }

    public function showPemasukan(Request $request) {
        $id_user = Auth::user()->id;
        if (empty($request->filter)) {
            return view('pembukuan-pemasukan', [
                'pemasukan' => Pemasukan::join('kategori_pemasukan', 'pemasukan.id_kategori_pemasukan', '=', 'kategori_pemasukan.id')
                            ->select('pemasukan.*', 'kategori_pemasukan.jenis_pemasukan')
                            ->where('kategori_pemasukan.id_user', '=', $id_user)
                            ->get(),
                            
                'filter' => $request->filter,
                'id_user' => $id_user
            ],
            [
                'kategoriPemasukan' => KategoriPemasukan::get()->where('id_user', '=', $id_user)
            ]
            );
        } else {
            return view('pembukuan-pemasukan', [
                'pemasukan' => Pemasukan::join('kategori_pemasukan', 'pemasukan.id_kategori_pemasukan', '=', 'kategori_pemasukan.id')
                            ->select('pemasukan.*', 'kategori_pemasukan.jenis_pemasukan')
                            ->where('jenis_pemasukan', '=', $request->filter)
                            ->get(),
                            
                'filter' => $request->filter,
                'id_user' => $id_user
            ],
            [
                'kategoriPemasukan' => KategoriPemasukan::get()->where('id_user', '=', $id_user)
            ]
            );
        } 
    }

    public function storeData(Request $request) {
        $validated = $request->validate([
            'jenis' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
            'foto' => 'bail|mimes:jpg,png,jpeg|image|max:2048'
        ]);

        $pos = strpos($request->jenis, '-');
        $kategori = substr($request->jenis, 0, $pos);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('uploads');
        } else {
            $path = '';
        }

        if ($request->storeJenis === 'pengeluaran') {
            Pengeluaran::insert([
                'id_kategori_pengeluaran' => $kategori,
                'ket_pengeluaran' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'foto' => $path
            ]);
        } else {
            Pemasukan::insert([
                'id_kategori_pemasukan' => $kategori,
                'ket_pemasukan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'foto' => $path
            ]);
        }  
        return back()->with('statusBerhasil', 'Data '.$request->storeJenis.' berhasil ditambahkan!');  
    }

    public function deleteData(Request $request) {
        if ($request->jenis === "pengeluaran") {
            Pengeluaran::where('id', '=', $request->id)->delete();
        } else {
            Pemasukan::where('id', '=', $request->id)->delete();
        }

        return back()->with('statusBerhasil', 'Data berhasil dihapus!');
    }

    public function addKategori(Request $request) {
        $tabel = 'kategori_'.$request->jenis;
        $kolom = 'jenis_'.$request->jenis;
        $id_user = Auth::user()->id;

        DB::table($tabel)->insert([
            $kolom => $request->namaKategori,
            'id_user' => $id_user
        ]);

        return back()->with('statusBerhasil', 'Kategori '.$request->namaKategori.' berhasil ditambahkan!');
    }

    public function kelolaKategori() {
        $id_user = Auth::user()->id;
        return view('kelolaKategori', [
            'kategoriPengeluaran' => KategoriPengeluaran::get()->where('id_user', '=', $id_user),
            'kategoriPemasukan' => KategoriPemasukan::get()->where('id_user', '=', $id_user)
        ]);
    }

    public function updateKategori(Request $request) {
        if ($request->jenisUpdate === "Pengeluaran") {
            DB::table('kategori_pengeluaran')
            ->where('id', $request->idUpdate)
            ->update([
                'jenis_pengeluaran' => $request->nama
            ]);
        } else {
            DB::table('kategori_pemasukan')
            ->where('id', $request->idUpdate)
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
        
    public function updateData(Request $request) {
        $validated = $request->validate([
            'jenis' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
            'foto' => 'bail|mimes:jpg,png,jpeg|image|max:2048'
        ]);
        
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('uploads');
        } else {
            $path = '';
        }

        if ($request->jenisUpdate === 'Pengeluaran') {
            $pos = strpos($request->jenis, '-');
            $kategori = substr($request->jenis, 0, $pos);

            DB::table('Pengeluaran')
            ->where('id', $request->idUpdate)
            ->update([
                'id_kategori_pengeluaran' => $kategori,
                'ket_pengeluaran' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'foto' => $path
            ]);

        } else {
            $pos = strpos($request->jenis, '-');
            $kategori = substr($request->jenis, 0, $pos);

            DB::table('Pemasukan')
            ->where('id', $request->idUpdate)
            ->update([
                'id_kategori_pemasukan' => $kategori,
                'ket_pemasukan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'foto' => $path
            ]);
        }
        return back()->with('statusBerhasil', 'Data '.$request->storeJenis.' berhasil diupdate!');  
    }
}
