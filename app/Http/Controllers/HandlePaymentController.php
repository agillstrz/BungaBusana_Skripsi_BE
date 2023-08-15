<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HandlePaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $payload = $request->all();
        Log::info('incoming midtrans',[
            'payload' => $payload
        ]);

        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];
        $reqSignature = $payload['signature_key'];

        $signature = hash('sha512',$orderId.$statusCode.$grossAmount.env('SERVER_KEY '));

        if($signature !== $reqSignature){
            return response()->json([
                'message' => "invalid signature"
            ],401);
        }

        $transactionStatus =   $payload['transaction_status'];

        $order = Pemesan::find($orderId);
        if(!$order){
            return response()->json([
                'message' => "invalid order"
            ],400);
        }


        if($transactionStatus == 'settlement'){
            $order->status_pembayaran = 1;
            $order->save();
        } else if ($transactionStatus == 'expire'){
            $order->status_pembayaran = 0;
            $order->save();
        }

        return response()->json(['message' => 'berhasil']);
    }
}