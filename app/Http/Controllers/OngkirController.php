<?php

namespace App\Http\Controllers;

use App\Models\Ongkir;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OngkirController extends Controller
{
    public function addOngkir(Request $request){
        $ongkir = new Ongkir;
        $ongkir->nama = $request->nama_ongkir;
        $ongkir->provinsi = $request->provinsi;
        $ongkir->kota = $request->kota;
        $ongkir->save();

        return response()->json($ongkir->id);
    }

    public function getPesanan($id){
        $ongkir = Pesanan::where('id', $id)->with('ongkir')->get();
        return response()->json($ongkir);
    }
}