<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pemesan;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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

   
    public function beli(Request $request)
    {

      $beli = $request->beli;

        $this->validate($request, [
            'nama_depan' => "required",
            'nama_belakang' => "required",
            'email' => "required",
            'nohp' => "required",
            'provinsi' => "required",
            'kota' => "required",
            'alamat' => "required",
            'tanggal_pemesanan' => "required",
        ]);

          $pemesan = new Pemesan();
            
            $pemesan->user_id = Auth::id();
            $pemesan->nama_depan = $request->nama_depan;
            $pemesan->nama_belakang = $request->nama_belakang;
            $pemesan->email = $request->email;
            $pemesan->nohp = $request->nohp;
            $pemesan->provinsi = $request->provinsi;
            $pemesan->kota = $request->kota;
            $pemesan->alamat = $request->alamat;
            $pemesan->kodepos = $request->kodepos;
            $pemesan->catatan = $request->catatan;
            $pemesan->save();
        
            $user = User::find(Auth::id());
            $user->nama_depan = $request->nama_depan;
            $user->nama_belakang = $request->nama_belakang;
            $user->provinsi = $request->provinsi;
            $user->kota = $request->kota;
            $user->alamat = $request->alamat;
            $user->kode_pos = $request->kodepos;
            $user->save();
            $total = 0;

            
        if($beli){
            $itemDetails[] = [
                'price' => $beli['harga'],
                'quantity' => 1,
                'name' => $beli['nama']
            ];

            $total = $beli['harga'];

        } else{

            $cart =  Cart::where('user_id', Auth::id())->with('produk')->get();

            $itemDetails = [];
    
            foreach ($cart as $item){
                $total +=  $item->produk->harga * $item->jml_produk;
              }
    
            foreach ($cart as $item) {
                 $itemDetails[] = [
                    'price' => $item->produk->harga,
                    'quantity' =>  $item->jml_produk,
                    'name' => $item->produk->nama,
                ];
            }
         
        }


            $server_key = env('SERVER_KEY');
            $response = Http::withBasicAuth($server_key,'')
          ->post('https://app.sandbox.midtrans.com/snap/v1/transactions',[
                'transaction_details' => [
                    "order_id"=> $pemesan->id,
                    'gross_amount' => $total
                ],
                'item_details' =>$itemDetails, 
                "customer_details" => [
                    "first_name" => $request->nama_depan,
                    "last_name" => $request->nama_belakang,
                    "email" => $request->email,
                    "phone" => $request->nohp,
                ],
                'enabled_payments' => array('bca_va','bni_va','bri_va','dana','gopay')
            ]);



          if ($response->successful()) {
           $response = json_decode($response->body());

            $transaksi = new Transaksi();
            $transaksi->pemesan_id = $pemesan->id;
            $transaksi->status_pembayaran = 'pending';
            $transaksi->url_midtrans = $response->redirect_url;
            $transaksi->tanggal_pemesanan = $request->tanggal_pemesanan;
            
           
            $transaksi->harga_pesanan = $total + $request->harga_ongkir;
            $transaksi->save();
    
            if($beli){
                Pesanan::create([
                    'pemesan_id'=> $pemesan->id,
                    'produk_id'=>$beli['id'],
                    'jml_pesanan'=> 1,
                    'total_harga'=> $beli['harga'],
                ]);
            } else{

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

            }
      

            return response()->json($response);


            } else {
                // The response is not successful, handle the error here
                $response = json_decode($response->body());
             
                return response()->json($response);
                // Perform error handling, logging, or other appropriate actions
            }
          
    }
    // public function beli(Request $request)
    // {

    //     // $validator = Validator::make($request->all(),[
    //     //     'nama' => "required",
    //     //     'email' => "required",
    //     //     'nphp' => "required",
    //     //     'provinsi' => "required",
    //     //     'kota' => "required",
    //     //     'alamat' => "required",
    //     //     'tanggal_pemesanan' => "required",
    //     //     'metode_pembayaran' => "required",
    //     // ]);

    //     // if($validator->fails()){
    //     //     return response()->json(['message' => 'invalid','data' => $validator->errors()]);
    //     // }

    //     $items = [
    //         ['price' => 200000, 'quantity' => 1, 'name' => 'baju lama'],
    //         ['price' => 200000, 'quantity' => 1, 'name' => 'baju baru'],
    //     ];
        
    //     $itemDetails = [];
    //     foreach ($items as $item) {
    //         $itemDetails[] = [
    //             'price' => $item['price'],
    //             'quantity' => $item['quantity'],
    //             'name' => $item['name'],
    //         ];
    //     }

    //     try {


    //         DB::beginTransaction();
    //         $server_key = env('SERVER_KEY');
    //         $orderId = Str::uuid()->toString();
    //       $response = Http::withBasicAuth($server_key,'')
    //       ->post('https://app.sandbox.midtrans.com/snap/v1/transactions',[
    //             'transaction_details' => [
    //                 "order_id"=>$orderId,
    //                 'gross_amount' => 400000
    //             ],
    //             'item_details' =>$itemDetails, 
    //             'enabled_paymentsx' => array('bca_va','bni_va','gopay')
    //         ]);
           
    //         $response = json_decode($response->body());

    //         DB::commit();

    //         return response()->json($response);
    //     } catch (\Exception $e) {
    //         //throw $th;
    //         DB::rollBack();
    //         return response()->json(['message' => $e->getMessage()],500);
    //     }
    // }

    public function webhook(Request $request){
        $server_key = env('SERVER_KEY');
           
      $response =   Http::withBasicAuth($server_key,'')->get('https://api.sandbox.midtrans.com/v2/'.$request->order_id.'/status');

      $response = json_decode($response->body());

      $transaksi = Transaksi::where('pemesan_id', $response->order_id)->first();
      $transaksi->metode_pembayaran = $response->payment_type . " " . $response->va_numbers[0]->bank;
      $transaksi->tanggal_pemesanan = $response->transaction_time;
     

      if($transaksi->status_pembayaran == 'berhasil'){
        return response()->json('Pembayaran sedang diproses');
      }
      
      if($response->transaction_status == 'capture'){
        $transaksi->status_pembayaran = "Berhasil";
        $transaksi->status_pemesanan = "Menunggu Kurir";
      }
      else if($response->transaction_status == 'settlement'){
        $transaksi->status_pembayaran = "Berhasil";
        $transaksi->status_pemesanan = "Menunggu Kurir";
   
      }
      else if($response->transaction_status == 'pending'){
        $transaksi->status_pembayaran = "pending";
      }
      else if($response->transaction_status == 'deny'){
        $transaksi->status_pembayaran = "gagal";
      }
      else if($response->transaction_status == 'expire'){
        $transaksi->status_pembayaran = "kedaluwarsa";
      }
  
      $transaksi->save();

      return response()->json('sukses');
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


  
        //   $response =   Http::withBasicAuth($server_key,'')
        //   ->post('https://api.sandbox.midtrans.com/v2/charge',[
        //         'payment_type' => 'bank_transfer',
        //         'transaction_details' => [
        //             'order_id' => 4444,
        //             'gross_amount' => 200000
        //         ],
        //         'bank_transfer' => [
        //             'bank' => "bca"
        //         ]
        //     ]);
}