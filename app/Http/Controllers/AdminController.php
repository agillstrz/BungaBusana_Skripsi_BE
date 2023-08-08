<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function pemesan(){
        $pemesan = Pemesan::all();
        return response()->json([
            'data' => $pemesan
        ]);
    }
    public function detailPesananAdmin($id){
        $pesanan = Pesanan::with('produk')->where('pemesan_id', $id)->get();
        return response()->json([
            'data' => $pesanan
        ]);
    }
    public function dashboard(){
        $me = User::find(Auth::id());
        $produk_terjual = Pesanan::count();
        $pengguna = User::count();
        $pendapatan = Pemesan::where('status_pembayaran', true)->sum('harga_pesanan');
        $pembeli = Pemesan::where('status_pembayaran', true)->count();
        return response()->json([
            'terjual' => $produk_terjual,
            'pengguna' => $pengguna,
            'pendapatan' => $pendapatan,
            'pembeli' => $pembeli,
            'me' => $me->name
        ]);
    }
}