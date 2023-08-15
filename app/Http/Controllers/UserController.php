<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pemesan;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function produkUser(Request $request){

        $produk = Produk::with(['kategori'=> function($query){
            $query->select('id','name');
        }])->when($request->filled('search'), function ($query) use ($request) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    })->when($request->filled('kategori'), function ($query) use ($request) {
        $query->where('kategori_id', $request->kategori);
    })->when($request->filled('harga_min'), function ($query) use ($request) {
        $query->where('harga', '>=', $request->harga_min);
    })
    ->when($request->filled('harga_max'), function ($query) use ($request) {
        $query->where('harga', '<=', $request->harga_max);
    })->when($request->filled('rating'), function ($query) use ($request) {
        $query->where('rating', '=', $request->rating);
    })->
  
        select('id','nama','foto','deskripsi','rating','harga','kategori_id')->latest()->take($request->limit)->skip($request->skip)->get();
        return response()->json([
            'products'=>$produk,
        ]);
     }
     
     public function checkoutBarang(){
        $keranjang = Cart::where('user_id', Auth::id())->get();
        $total = 0;

        foreach ($keranjang as $carts) {
                $total += $carts->produk->harga * $carts->jml_produk;
        }
        
       return response()->json([
        'total' => $total,
        'keranjang' => $keranjang
       ]);
     }

     
    public function historyProduk(){
        $history = Pemesan::with('transaksi')->where('user_id', Auth::id())->latest()->get();

        return response()->json(['data' => $history]);
    }

    public function produkHome(){
        $produk = Produk::latest()->take(5)->get();

        return response()->json(['data' => $produk]);
     }

     
    public function detailPesananUser($id){
        $produk = Pesanan::with('produk')->where('pemesan_id', $id)->get();

        return response()->json(['data' => $produk]);
     }

    public function detailProdukUser($id){
        $produk = Produk::where('id', $id)->with('kategori')->first();
        $ulasan = Rating::with(['user'=> function($query){
            $query->select('id','name');
        }])->where('produk_id', $id)->get();
  

        return response()->json([
            'produk' => $produk,
            'ulasan' => $ulasan
        ]);
     }
}