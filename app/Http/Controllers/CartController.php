<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::with('produk')->where('user_id', Auth::id())->get();
        return response()->json($cart);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $check_produk = Cart::where('produk_id', $request->produk_id)->where('user_id', Auth::id())->exists();
    $produk = Produk::find($request->produk_id);
    if(Auth::check()){
        if($check_produk){
            throw ValidationException::withMessages([
                'produk' => ["Produk sudah ada dalam keranjang"]
            ]);
        } 
        else if($produk->stok <= 0 || $produk->status == 0){
            throw ValidationException::withMessages([
                'produk' => ["Produk kosong"]
            ]);
        }
        else{
    
            $cart = Cart::create([
                'produk_id' => $request->produk_id,
                'user_id' => Auth::id(),
                'jml_produk'=> $request->jml_produk
               ]);
        
               return response()->json([
                'data'=> $cart,
                'message' => "berhasil menambahkan produk kedalam keranjang",
               ]);
    
        }


    } else{
        return response()->json([
            'message' => "Login Terlebih Dahulu"
        ]);
    }
  
   
    }

    public function jmlkeranjang(){
        $countCart = Cart::where('user_id', Auth::id())->count();

        return response()->json(['jml' => $countCart]);
    }
 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $cart = Cart::where('produk_id', $request->produk_id)->where('user_id',Auth::id())->first();
        $cart->jml_produk = $request->jml_produk;
        $cart->save();

        return response()->json([
            'data' => $cart
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        if(Cart::where('id', $request->id)->where('user_id', Auth::id())->exists())

        {
            $cart = Cart::find($id);
            $cart->delete();
            return response()->json([
                "message" => "Item berhasil dihapus"
            ]);

        } else{
            return response()->json([
                "message" => "tidak ada item untuk dihapus"
            ]);
        }
  
    }
}