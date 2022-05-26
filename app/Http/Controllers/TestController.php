<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Admin;
use App\Models\Teacher;
use Essam\TapPayment\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    //
    public function test(){

        // dd('test');
//        $user = User::create([
//           'last_name' => 'admin' ,
//           'first_name' => 'admin' ,
//           'type' => 'admin' ,
//           'phone' => '12345' ,
//           'email' => 'admin@email.com' ,
//           'password' => Hash::make('123456')
//        ]);

//        foreach (Product::all() as $item) {
//            $item->delete();
//        }
        $TapPay = new Payment(['secret_api_Key'=> 'sk_test_Sva0m2GZMhAwC8eFnVX9uWLy']);

        $redirect = false; // return response as json , you can use it form mobile web view application

        $json_data =  $TapPay->charge([
            'amount' => 200,
            'currency' => 'EGP',
            'threeDSecure' => 'true',
            'description' => 'test description',
            'statement_descriptor' => 1,
            'merchant_id' =>1,
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
        dd($json_data, $json_data->transaction->url);
        $Charge =  $TapPay->getCharge('chg_TS021720222249h6HM2605997');
        dd($Charge);
        dd('done');

    }

}

