<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function index(){
        return view('razorpay');
    }

    public function payment(Request $request){
        $amount = $request->input('amount');
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $orderData = [
            'receipt' => 'order_'.rand(100,9999),
            'amount' => $amount * 100,
            'currency' => 'INR',
            'payment_capture'=>1
        ];
        $order = $api->order->create($orderData);
        // echo $order['id'];
        return view('payment', ['orderId'=>$order['id'], 'amount'=> $amount * 100]);
    }

    public function callback(Request $request){
        $payid = $request->payid;
        $orderid = $request->orderid;
        $sign = $request->sign;

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try{
            $attr = [
                'razorpay_order_id'=> $orderid,
                'razorpay_payment_id'=> $payid,
                'razorpay_signature'=> $sign
            ];

            $api->utility->verifyPaymentSignature($attr);
            echo "Payment Verified : ".$payid;

        }catch(\Exception $e){
            echo "Payment Verification failed";
        }
    }
}
