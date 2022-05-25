<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ResponseTrait;

    public function index(): \Illuminate\Http\JsonResponse
    {
        $carts = Cart::with('user', 'product')->where('user_id', Auth::id())->get();
        return $this->returnData('user cart', CartResource::collection($carts));
    }

    public function store(int $id) {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('product_id', $id)->first();
        if ($cart) {
            return $this->returnError('This product is already added to cart');
        } else {
            Cart::create([
               'user_id'     => $user->id,
               'product_id'  => $id
            ]);

            return $this->returnSuccess('Product is added to cart successfully');
        }
    }
}
