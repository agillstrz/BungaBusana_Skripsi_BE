<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Rating;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
     public function index(){
    
        $produk = Produk::with(['kategori'=> function($query){
            $query->select('id','name');
        }])->latest()->paginate(10);

         return response()->json([
            'data'=>$produk
        ]);
     }
    

     public function addProduk(Request $request){
        $produk =  Produk::create([
            'kategori_id'=> $request->kategori_id,
            'nama'=> $request->nama,
            'deskripsi'=> $request->deskripsi,
            'harga'=> $request->harga,
            'foto'=> $request->foto,
            'foto2'=> $request->foto2,
            'foto3'=> $request->foto3,
        ]);
        return response()->json([
            'data' => $produk,
            'message' => "berhasil menambahkan produk"
        ]);
     }

     public function updateProduk(Request $request, $id){
        $produk = Produk::find($id);

        $produk->kategori_id = $request->kategori_id;
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->status = $request->status;
        $produk->stok = $request->stok;
        $produk->foto = $request->foto;
        $produk->foto2 = $request->foto2;
        $produk->foto3 = $request->foto3;
        $produk->ukuran_XL = $request->ukuran_XL;
        $produk->ukuran_S = $request->ukuran_S;
        $produk->ukuran_L = $request->ukuran_L;
        $produk->ukuran_M = $request->ukuran_M;
        $produk->save();

        return response()->json([
            'data' => $produk,
            'message' => "berhasil memperbarui produk"
        ]);
     }
     public function deleteProduk($id){
        $produk = Produk::find($id);
        $produk->delete();
        
        return response()->json([
            'message' => "produk berhasil dihapus"
        ]);
     }
}