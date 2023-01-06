<?php
namespace App\Http\Controllers;

use App\Http\Requests\RiwayatBayarRequest;
use App\Http\Requests\PenghuniRequest;
use App\Models\Penghuni;
use App\Models\Kost;
use App\Models\Bulan;
use App\Models\Tahun;
use App\Models\StatusPembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    // PENGHUNI
    public function showPenghuni() {
        $id_user = Auth::user()->id;
        $kost = Kost::get()->where('id_user', '=', $id_user)->first();
        $penghuni = Penghuni::where('id_kost', '=', $kost->id)->get();

        if (Kost::where('id_user', '=', $id_user)->count() > 0) {
            return view ('penghuni', [
                'penghuni' => $penghuni,
                'statusPembayaran' => StatusPembayaran::get(),
                'kost' => $kost,
                'id_kost' => $kost->id,
                'tahun' => Tahun::get(),
                'bulan' => Bulan::get()
            ]);
        } else {
            return view ('tambah-kost');
        }
    }

    public function tambahPenghuni(PenghuniRequest $request) {
        $validated = $request->validated();

        $id_user = Auth::user()->id;
        $kost = Kost::get()->where('id_user', '=', $id_user)->first();

        Penghuni::insert([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'status' => $request->status,
            'no_kamar' => $request->no_kamar,
            'id_kost' => $kost->id
        ]);

        return back()->with('statusPenghuniBerhasil', 'Penghuni '.$request->nama.' berhasil ditambahkan!');
    }

    public function updatePenghuni(PenghuniRequest $request) {
        $validated = $request->validated();

        Penghuni::where('id', $request->id)->update([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'status' => $request->status,
            'no_kamar' => $request->no_kamar
        ]);

        return back()->with('statusPenghuniBerhasil', 'Penghuni '.$request->nama.' berhasil diupdate!');
    }

    public function hapusPenghuni(Request $request) {
        $validated = $request->validated([
            'nama' => 'required|max:250',
            'id' => 'required'
        ]);

        StatusPembayaran::where('id_penghuni', $request->id)->delete();
        Penghuni::where('id', $request->id)->delete();

        return back()->with('statusPenghuniBerhasil', 'Penghuni '.$request->nama.' berhasil dihapus!');
    }

    // RIWAYAT BAYAR PENGHUNI
    public function tambahRiwayatBayar(RiwayatBayarRequest $request) {
        $validated = $request->validated();

        StatusPembayaran::insert([
            'id_penghuni' => $request->idPenghuni,
            'id_tahun' => $request->idTahun,
            'id_bulan' => $request->idBulan,
            'tanggal_bayar' => $request->tanggal,
            'foto_bukti_bayar' => $this->getFilePath($request)
        ]);
        
        return back()->with('statusRiwayatBerhasil', 'Riwayat pembayaran berhasil ditambahkan!');
    }

    public function hapusRiwayatBayar(Request $request) {
        $validate = $request->validate([
            'id' => 'required'
        ]);

        StatusPembayaran::find($request->id)->delete();

        return back()->with('statusRiwayatBerhasil', 'Riwayat pembayaran berhasil dihapus!');
    }

    public function updateRiwayatBayar(RiwayatBayarRequest $request) {
        $validate = $request->validated();

        StatusPembayaran::where('id', $request->id)->update([
            'id_penghuni' => $request->idPenghuni,
            'id_tahun' => $request->idTahun,
            'id_bulan' => $request->idBulan,
            'tanggal_bayar' => $request->tanggal,
            'foto_bukti_bayar' => $this->getFilePath($request)
        ]);
        
        return back()->with('statusRiwayatBerhasil', 'Riwayat pembayaran berhasil diupdate!');
    }

    public function getFilePath($request) {
        if ($request->hasFile('fotoBuktiBayar')) {
            return $path = $request->file('fotoBuktiBayar')->store('uploads');
        } else {
            return $path = '';
        }
    }
}