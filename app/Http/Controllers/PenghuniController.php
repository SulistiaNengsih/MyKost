<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;
use App\Models\Pemasukan;
use App\Models\StatusPembayaran;
use Illuminate\Support\Facades\DB;

class PenghuniController extends Controller
{
    public function showPenghuni(Request $request) {
        return view ('penghuni', [
            'penghuni' => Penghuni::get(),
            'statusPembayaran' => StatusPembayaran::get()
        ]);
    }

    public function tambahPenghuni( Request $request) {
        if (is_numeric($request->no_telepon) && strlen($request->no_telepon) >= 10) {
            Penghuni::insert([
                'nama' => $request->nama,
                'no_telepon' => $request->no_telepon,
                'status' => $request->status,
                'no_kamar' => $request->no_kamar
            ]);
    
            foreach (Penghuni::get() as $p) {
                StatusPembayaran::updateOrInsert(
                    ['id_penghuni' => $p->id],
                    ['id_tahun' => 1]
                );
            }
    
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

    public function updateStatusPembayaran(Request $request) {
            DB::table('status_pembayaran')->where('id_penghuni', $request->id)->update([
                'jan' => $request->jan,
                'feb' => $request->feb,
                'mar' => $request->mar,
                'apr' => $request->apr,
                'mei' => $request->mei,
                'jun' => $request->jun,
                'jul' => $request->jul,
                'agu' => $request->agu,
                'sep' => $request->sep,
                'okt' => $request->okt,
                'nov' => $request->nov,
                'des' => $request->des
            ]); 
            
            return back()->with('statusRiwayatBerhasil', 'Status pembayaran '.$request->nama.' berhasil diupdate!');
    }
}
