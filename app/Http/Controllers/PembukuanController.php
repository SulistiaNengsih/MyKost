<?php
namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\KategoriPemasukan;
use App\Http\Requests\StoreRequest;
use App\Models\KategoriPengeluaran;
use Illuminate\Support\Facades\Auth;

class PembukuanController extends Controller
{
    public function showPengeluaran(Request $request) {
        $id_user = Auth::user()->id;

        if (empty($request->filter)) {
            $pengeluaran = Pengeluaran::get();
        } else {
            $id_kategori = KategoriPengeluaran::where('jenis_pengeluaran', '=', $request->filter)
                ->first()->id;
            $pengeluaran = Pengeluaran::where('id_kategori_pengeluaran', '=', $id_kategori)->get();
        }

        return view('pembukuan-pengeluaran',
        [
            'pengeluaran' => $pengeluaran,
            'kategoriPengeluaran' => KategoriPengeluaran::where('id_user', '=', $id_user)->get(),
            'filter' => $request->filter,
            'id_user' => $id_user
        ]);    
    }

    public function showPemasukan(Request $request) {
        $id_user = Auth::user()->id;

        if (empty($request->filter)) {
            $pemasukan = Pemasukan::get();
        } else {
            $id_kategori = KategoriPemasukan::where('jenis_pemasukan', '=', $request->filter)
                ->first()->id;
            $pemasukan = Pemasukan::where('id_kategori_pemasukan', '=', $id_kategori)->get();
        }

        return view('pembukuan-pemasukan',
        [
            'pemasukan' => $pemasukan,
            'kategoriPemasukan' => KategoriPemasukan::where('id_user', '=', $id_user)->get(),
            'filter' => $request->filter,
            'id_user' => $id_user
        ]);   
    }

    public function storeData(StoreRequest $request) {
        $validated = $request->validated();
        $kategori = $this->getKategori($request->jenis);

        if ($request->storeJenis === 'pengeluaran') {
            Pengeluaran::insert([
                'id_kategori_pengeluaran' => $kategori,
                'ket_pengeluaran' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'foto' => $this->getFilePath($request)
            ]);
        } else {
            Pemasukan::insert([
                'id_kategori_pemasukan' => $kategori,
                'ket_pemasukan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'foto' => $this->getFilePath($request)
            ]);
        } 
        return back()->with('statusBerhasil', 'Data '.$request->storeJenis.' berhasil ditambahkan!');  
    }

    public function updateData(StoreRequest $request) {
        $validated = $request->validated();
        $kategori = $this->getKategori($request->jenis);

        if ($request->jenisUpdate === 'Pengeluaran') {
            Pengeluaran::where('id', $request->idUpdate)->update([
                'id_kategori_pengeluaran' => $kategori,
                'ket_pengeluaran' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'foto' => $this->getFilePath($request)
            ]);

        } else {
            Pemasukan::where('id', $request->idUpdate)->update([
                'id_kategori_pemasukan' => $kategori,
                'ket_pemasukan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'nominal' => $request->nominal,
                'foto' => $this->getFilePath($request)
            ]);
        }
        return back()->with('statusBerhasil', 'Data '.$request->storeJenis.' berhasil diupdate!');  
    }

    public function deleteData(Request $request) {
        $validate = $request->validate([
            'jenis' => 'required',
            'id' => 'required'
        ]);

        if ($request->jenis === "pengeluaran") {
            Pengeluaran::where('id', '=', $request->id)->delete();
        } else {
            Pemasukan::where('id', '=', $request->id)->delete();
        }

        return back()->with('statusBerhasil', 'Data berhasil dihapus!');
    }

    public function getFilePath($request) {
        if ($request->hasFile('foto')) {
            return $path = $request->file('foto')->store('uploads');
        } else {
            return $path = '';
        }
    }
    
    public function getKategori($jenis) {
        $pos = strpos($jenis, '-');
        return $kategori = substr($jenis, 0, $pos);
    }
}