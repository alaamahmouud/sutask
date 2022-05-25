<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Validator;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    use ResponseTrait;
    //
    public $successStatus = 200;
    public $successNodataStatus = 204;
    public function __construct(Request $request)
    {

    }

    //get all products

    public function index(): \Illuminate\Http\JsonResponse
    {
        $products = Product::all();
        return $this->returnData('this is all products',  ProductResource::collection($products));
    }

    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::find($id);
        if($product) {
            return $this->returnData('this is the product', new ProductResource($product));
        } else {
            return $this->returnError('not found');
        }
    }

    public function rate(Request $request,int $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::find($id);
        if($product) {
            $product->rateOnce($request->rating, $request->comment);
            return $this->returnSuccess('rating added successfully');
        } else {
            return $this->returnError('not found');
        }
    }

}
