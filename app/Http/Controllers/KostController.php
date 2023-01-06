<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;
use App\Http\Requests\KostRequest;
use Illuminate\Support\Facades\Auth;

class KostController extends Controller
{
    public function updateKost(KostRequest $request) {
        $validate = $request->validated();
        Kost::where('id', $request->id)->update(
            [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'biaya_sewa_bulanan' => $request->sewa
            ]);

            return back()->with('statusBerhasil', 'Data kost berhasil diupdate!');
    }

    public function tambahKost(Request $request) {
        $validate = $request->validate([
            'nama' => 'required|max:225',
            'alamat' => 'required',
            'biaya_sewa_bulanan' => 'required|numeric'
        ]);

        Kost::insert(
            [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'biaya_sewa_bulanan' => $request->sewa,
                'id_user' => Auth::user()->id
            ]
        );

        return back()->with('statusBerhasil', 'Data kost berhasil ditambahkan!');
    }
}