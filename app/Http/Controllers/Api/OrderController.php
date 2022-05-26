<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Traits\ResponseTrait;
use Essam\TapPayment\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use ResponseTrait;
    public function store() {
        $user =Auth::user();
        $order = Order::create([
            'user_id'       => $user->id
        ]);
        $total_price = 0;
        foreach ($user->carts as $cart) {
            $total_price += $cart->product->price;
            OrderDetail::create([
                'order_id'  => $order->id,
                'product_id' => $cart->product_id
            ]);
        }

        $order->total_price = $total_price;
        $order->save();
        // TODO payment gateway
        $TapPay = new Payment(['secret_api_Key'=> 'sk_test_Sva0m2GZMhAwC8eFnVX9uWLy']);

        $redirect = false; // return response as json , you can use it form mobile web view application

        $json_data =  $TapPay->charge([
            'amount' => $total_price,
            'currency' => 'EGP',
            'threeDSecure' => 'true',
            'description' => 'test description',
            'statement_descriptor' => $order->id,
            'customer' => [
                'first_name' => 'customer',
                'email' => 'customer@gmail.com',
//                'merchant' => 2,
            ],
            'source' => [
                'id' => 'src_card'
            ],
            'post' => [
                'url' => null
            ],
            'redirect' => [
                'url' => route('payment.callback')
            ]
        ],$redirect);

        return $this->returnData('this is payment link', $json_data->transaction->url);

    }

    public function callback(Request $request): \Illuminate\Http\JsonResponse
    {
        $TapPay = new Payment(['secret_api_Key'=> 'sk_test_Sva0m2GZMhAwC8eFnVX9uWLy']);
        $charge =  $TapPay->getCharge($request->tap_id);
        $order = Order::find($charge->statement_descriptor);
        if ($charge->status != "DECLINED") {
            $order->payment_status = 'done';
            $order->save();
            foreach (Cart::where('user_id', $order->user_id) as $item) {
                $item->delete();
            }
            return $this->returnSuccess('payment done successfully');
        } else {
            $order->payment_status = 'failed';
            $order->save();
            return $this->returnError('payment failed, try again');
        }
    }
}
