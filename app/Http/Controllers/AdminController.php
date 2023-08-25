<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function pemesan(Request $request){
        $pemesan = Pemesan::with('transaksi')->when($request->filled('search'), function ($query) use ($request) {
            $query->where('nama_depan', 'like', '%' . $request->search . '%');
        })->latest()->get();
        return response()->json([
            'data' => $pemesan
        ]);
    }

    public function pembelianDashboard(){
        $pemesan = Pemesan::with('transaksi')->latest()->get();
        return response()->json([
            'data' => $pemesan
        ]);
    }
    public function pengguna(){
        $user = User::latest()->get();
        return response()->json([
            'data' => $user
        ]);
    }
    public function detailPesananAdmin($id){
        $pesanan = Pesanan::with('produk')->where('pemesan_id', $id)->get();
        $jml = Pesanan::with('produk')->where('pemesan_id', $id)->count();
        return response()->json([
            'data' => $pesanan,
            'jumlah'=> $jml
        ]);
    }
    public function dashboard(){
        $me = User::find(Auth::id());
        $produk_terjual = Pesanan::count();
        $pengguna = User::count();
        $pendapatan = Transaksi::where('status_pembayaran', true)->sum('harga_pesanan');
        $pembeli = Transaksi::where('status_pembayaran', 'Berhasil')->count();
        return response()->json([
            'terjual' => $produk_terjual,
            'pengguna' => $pengguna,
            'pendapatan' => $pendapatan,
            'pembeli' => $pembeli,
            'me' => $me->name
        ]);
    }
}