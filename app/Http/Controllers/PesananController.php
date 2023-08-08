<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Ongkir;
use App\Models\Pemesan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan = Pesanan::all();
        return response()->json([
            'data' => $pesanan
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


            $checkCart = Cart::where('user_id', Auth::id())->exists();
            $id_buyone = $request->produk;
            $jml_buyone = $request->jml_buyone;
            
            // $ongkir = new Ongkir();
            // $ongkir->nama = $request->nama_ongkir;
            // $ongkir->kota = $request->kota;
            // $ongkir->provinsi = $request->provinsi;
            // $ongkir->harga_ongkir = $request->harga_ongkir;
            // $ongkir->save();
        
            $pemesan = new Pemesan();
            $pemesan->user_id = Auth::id();
            $pemesan->nama = $request->nama;
            $pemesan->email = $request->email;
            $pemesan->nohp = $request->nohp;
            $pemesan->provinsi = $request->provinsi;
            $pemesan->kota = $request->kota;
            $pemesan->alamat = $request->alamat;
            $pemesan->kodepos = $request->kodepos;
            $pemesan->tanggal_pemesanan = $request->tanggal_pemesanan;
            $pemesan->status_pembayaran = true;
            $pemesan->metode_pembayaran = $request->metode_pembayaran;

       if($id_buyone){
        
        $produk = Produk::where('id',$id_buyone)->first();
        $total = $produk->harga;
        $pemesan->harga_pesanan = $total;
        $pemesan->save();
        Pesanan::create([
            'pemesan_id'=> $pemesan->id,
            'produk_id'=>$id_buyone,
            'jml_pesanan'=> $jml_buyone,
            'total_harga'=> $produk->harga,
        ]);
        $produk->stok -= $jml_buyone;
        $produk->update();

        return response()->json([
            'message' => "berhasil melakukan pembelian"
        ]);
       }
       else
       {

        $keranjang_total =  Cart::where('user_id', Auth::id())->with('produk')->get();
        $total = 0;
        foreach ($keranjang_total as $item){
          $total +=  $item->produk->harga * $item->jml_produk;
        }
        $pemesan->harga_pesanan = $total + $request->harga_ongkir;
        $pemesan->save();


        $cart = Cart::where('user_id', Auth::id())->get();
        foreach ($cart as $item) {
            Pesanan::create([
                'pemesan_id'=> $pemesan->id,
                'produk_id'=>$item->produk_id,
                'jml_pesanan'=> $item->jml_produk,
                'total_harga'=> $item->produk->harga * $item->jml_produk,
            ]);
         
            $produk = Produk::where('id', $item->produk_id)->first();
            $produk->stok -= $item->jml_produk;
            $produk->update(); 
        }

        $cart = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cart);

        return response()->json([
            'message' => "berhasil melakukan pembelian"
        ]);
       
       }

    


       
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }

    // public function bankTransfer(Request $request)
    // {
    //     // Set Midtrans API credentials from the .env file
    //     Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    //     Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
    //     Config::$isProduction = true; // Set to false for sandbox mode

    //     // Transaction details
    //     $transactionDetails = [
    //         'order_id' => 'YOUR_ORDER_ID',
    //         'gross_amount' => 100000, // Replace this with the actual amount
    //     ];

    //     // Customer details
    //     $customerDetails = [
    //         'first_name' => 'John',
    //         'last_name' => 'Doe',
    //         'email' => 'john.doe@example.com',
    //         'phone' => '081234567890',
    //     ];

    //     // Bank transfer payment data
    //     $bankTransferParams = [
    //         'bank_transfer' => [
    //             'bank' => 'mandiri', // Replace with the desired bank (e.g., bca, bni, permata, etc.)
    //         ],
    //     ];

    //     // Transaction options
    //     $transactionOptions = [
    //         'finish_redirect_url' => route('payment.finish'), // Replace with your desired redirect URL after payment completion
    //     ];

    //     try {
    //         // Create a new transaction
    //         $snapToken = Transaction::snapToken($transactionDetails, $customerDetails, $bankTransferParams, $transactionOptions);

    //         // Return the snapToken to the frontend
    //         return response()->json(['snap_token' => $snapToken]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
}