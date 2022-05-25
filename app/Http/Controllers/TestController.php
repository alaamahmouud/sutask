<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Admin;
use App\Models\Teacher;
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
        for ($i = 1; $i <= 20; $i++) {
            Product::create([
               'price'  => rand(0, 200),
               'title'  => 'product number ' . $i,
               'des'    => 'description from product number ' . $i
            ]);
        }
        dd('done');

    }

}

