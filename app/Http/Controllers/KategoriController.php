<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(){
        $kategori = Kategori::all();

        return response()->json([
            'data'=>$kategori
        ]);
     }


     public function addKategori(Request $request){

        $kategori =  Kategori::create([
            'name'=> $request->name,
            'image'=> $request->image,
        ]);


        return response()->json([
            'data' => $kategori
        ]);
     }

     public function updateKategori(Request $request, $id){
        $kategori = Kategori::find($id);

        $kategori->name = $request->name;
        $kategori->image = $request->image;
        $kategori->save();

        return response()->json([
            'data' => $kategori,
            'message' => 'kategori berhasil diperbarui'
        ]);
     }
     public function deleteKategori($id){
        $kategori = Kategori::find($id);
        $kategori->delete();

        return response()->json([
            'message' => "kategori berhasil dihapus"
        ]);
     }
}