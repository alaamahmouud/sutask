<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Traits\ResponseTrait;
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
//        $TapPay = new Payment(['secret_api_Key'=> $secret_api_Key]);

//        $redirect = false; // return response as json , you can use it form mobile web view application

//        return $TapPay->charge([
//            'amount' => 200,
//            'currency' => 'AED',
//            'threeDSecure' => 'true',
//            'description' => 'test description',
//            'statement_descriptor' => 'sample',
//            'customer' => [
//                'first_name' => 'customer',
//                'email' => 'customer@gmail.com',
//            ],
//            'source' => [
//                'id' => 'src_card'
//            ],
//            'post' => [
//                'url' => null
//            ],
//            'redirect' => [
//                'url' => url('check_payment.php')
//            ]
//        ],$redirect);
        return $this->returnSuccess('success');

    }
}
