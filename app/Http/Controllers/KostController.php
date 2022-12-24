<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\Penghuni;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KostController extends Controller
{

    public function updateKost(Request $request) {
        DB::table('kost')->where('id', $request->id)->update(
            [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'biaya_sewa_bulanan' => $request->sewa
            ]);

            return back()->with('statusBerhasil', 'Data kost berhasil diupdate!');
    }

    public function tambahKost(Request $request) {
        $id_user = Auth::user()->id;
        DB::table('kost')->insert(
            [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'biaya_sewa_bulanan' => $request->sewa,
                'id_user' => $id_user
            ]
        );
    }
}
