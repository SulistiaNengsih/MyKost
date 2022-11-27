<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\Penghuni;
use Illuminate\Support\Facades\DB;

class KostController extends Controller
{
    public function showKost() {
        return view ('kost', [
            'kost' => Kost::get(),
            'penghuni' => Penghuni::get()
        ]);
    }

    public function updateKost(Request $request) {
        DB::table('kost')->where('id', $request->id)->update(
            [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'biaya_sewa_bulanan' => $request->sewa
            ]);

            return back()->with('statusBerhasil', 'Data kost berhasil diupdate!');
    }
}
