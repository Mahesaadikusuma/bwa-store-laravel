<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cart;
use App\Transaction;
use App\TransactionDetail;

use Exception; // untuk midtransnya

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class CheckoutController extends Controller
{

    public function process(Request $request ) {
        // save user data
        $user = Auth::user();

        
        $user->update($request->except('total_price'));
        
        // PROSES CHECKOUT
        $code = 'STORE-' . mt_rand(000000, 999999);
        $carts = Cart::with(['product', 'user'])
                    // fungsi ini untuk user yang sedang login
                ->where('users_id', Auth::user()->id)->get();

        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'inscurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code,
        ]);

        foreach ($carts as $cart) {
            // ini sama seperti $code cuma diganti nama var
            $trx = 'TRX-' . mt_rand(000000, 999999);

            TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_id' => $cart->product->id,
            'price' => $cart->product->price,
            'shipping_status' => 'PENDING',
            'resi' => '',
            'code' => $trx,
            ]);
        }

        // DELETE CART DATA
        // bisa pakai data yang dibawah ini
        /* Cart::where('users_id', Auth::user()->id)
            ->delete(); */

        // atau ini 
        Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id)
            ->delete();


        // return dd($transaction); ini tes dulu

        // KONFIRGURASI MIDTRANS
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds  = config('services.midtrans.is3ds');
        
        // membuat array untuk midtrans

        $midtrans = [
                "transaction_details" => [
                    "order_id" => $code,
                    "gross_amount" => (int) $request->total_price,
                ],

                'customer_details' => array(
                'first_name'    => Auth::user()->name,
                'email'         => Auth::user()->email,
                ),
                
                "enabled_payments" => array('gopay','bank_transfer'),
                'vtweb' => array()
            ];
        
        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }

        catch (Exception $e) 
        {
            echo $e->getMessage();
        }

    }

    public function callback(Request $request ) 
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');


        // Buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        
        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction->status = 'PENDING';
                }
                else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }

        else if ($status == 'settlement'){
            $transaction->status = 'SUCCESS';
        }
        else if($status == 'pending'){
            $transaction->status = 'PENDING';
        }
        else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
        }
        else if ($status == 'expire') {
            $transaction->status = 'CANCELLED';
        }
        else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }

        // Simpan transaksi
        $transaction->save();

         // Kirimkan email
        if ($transaction) 
        {
            if($status == 'capture' && $fraud == 'accept' )
            {
                //
            }

            else if ($status == 'settlement')
            {
                //
            }

            else if ($status == 'success')
            {
                //
            }
            else if($status == 'capture' && $fraud == 'challenge' ) 
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challenge'
                    ]
                ]);
            }

            else 
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment not Settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Success'
                ]
            ]);
        }


        
    }
}
