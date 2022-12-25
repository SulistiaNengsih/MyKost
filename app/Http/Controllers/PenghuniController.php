<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;
use App\Models\Kost;
use App\Models\Bulan;
use App\Models\Tahun;
use App\Models\StatusPembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenghuniController extends Controller
{
    public function showPenghuni() {
        $id_user = Auth::user()->id;
        $kost = Kost::get()->where('id_user', '=', $id_user)->first();
        $penghuni = Penghuni::where('id_kost', '=', $kost->id)->get();

        if (DB::table('kost')->where('id_user', '=', $id_user)->count() > 0) {
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

    public function tambahPenghuni( Request $request) {
        $id_user = Auth::user()->id;
        $kost = DB::table('kost')->where('id_user', '=', $id_user)->first();
        if (is_numeric($request->no_telepon) && strlen($request->no_telepon) >= 10) {
            Penghuni::insert([
                'nama' => $request->nama,
                'no_telepon' => $request->no_telepon,
                'status' => $request->status,
                'no_kamar' => $request->no_kamar,
                'id_kost' => $kost->id
            ]);
    
            return back()->with('statusPenghuniBerhasil', $request->nama.' berhasil ditambahkan!');
        } else {
            return back()->with('statusPenghuniGagal', $request->nama.' gagal ditambahkan! Nomor telepon tidak valid.');
        }   
    }

    public function updatePenghuni(Request $request) {
        DB::table('penghuni')->where('id', $request->id)->update([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'status' => $request->status,
            'no_kamar' => $request->no_kamar
        ]);

        return back()->with('statusPenghuniBerhasil', $request->nama.' berhasil diupdate!');
    }

    public function hapusPenghuni(Request $request) {
        StatusPembayaran::where('id_penghuni', $request->id)->delete();
        Penghuni::where('id', $request->id)->delete();

        return back()->with('statusPenghuniBerhasil', $request->nama.' berhasil dihapus!');
    }

    public function tambahRiwayatBayar(Request $request) {
        $validated = $request->validate([
            'idPenghuni' => 'required',
            'idTahun' => 'required',
            'idBulan' => 'required',
            'tanggal' => 'required',
            'fotoBuktiBayar' => 'bail|mimes:jpg,png,jpeg|image|max:2048'
        ]);

        if ($request->hasFile('fotoBuktiBayar')) {
            $path = $request->file('fotoBuktiBayar')->store('uploads');
        } else {
            $path = '';
        }

        StatusPembayaran::insert([
            'id_penghuni' => $request->idPenghuni,
            'id_tahun' => $request->idTahun,
            'id_bulan' => $request->idBulan,
            'tanggal_bayar' => $request->tanggal,
            'foto_bukti_bayar' => $path
        ]);
        
        return back()->with('statusRiwayatBerhasil', 'riwayat pembayaran berhasil ditambahkan!');
    }

    public function hapusRiwayatBayar(Request $request) {
        StatusPembayaran::find($request->id)->delete();

        return back()->with('statusPenghuniBerhasil',' riwayat pembayaran berhasil dihapus!');
    }

    public function updateRiwayatBayar(Request $request) {
        $validated = $request->validate([
            'idPenghuni' => 'required',
            'idTahun' => 'required',
            'idBulan' => 'required',
            'tanggal' => 'required',
            'fotoBuktiBayar' => 'bail|mimes:jpg,png,jpeg|image|max:2048'
        ]);

        if ($request->hasFile('fotoBuktiBayar')) {
            $path = $request->file('fotoBuktiBayar')->store('uploads');
        } else {
            $path = '';
        }

        DB::table('status_pembayaran')
        ->where('id', $request->id)
        ->update([
            'id_penghuni' => $request->idPenghuni,
            'id_tahun' => $request->idTahun,
            'id_bulan' => $request->idBulan,
            'tanggal_bayar' => $request->tanggal,
            'foto_bukti_bayar' => $path
        ]);
        
        return back()->with('statusRiwayatBerhasil', 'riwayat pembayaran berhasil diupdate!');
    }
}
