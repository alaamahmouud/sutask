<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class ProductsController extends Controller
{
    //


    function __construct() {

    }
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.products.single');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'des'=>  'required|min:3|max:255',
            'title'=>  'required|min:3|max:255',
            'price'=>  'required',
        ]);
      //  dd($request->all());
            Product::create($request->all());
            return redirect('products')->with('success', 'تم اضافة قسم بنجاح ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.single',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


            $this->validate($request,[
            'des'=>  'required|min:3|max:255',
            'title'=>  'required|min:3|max:255',
            'price'=>  'required',
            ]);
            $product = Product::findOrFail($id);
            $product->update($request->all());

            return redirect('products')->with('success', 'تم تعديل بيانات القسم بنجاح .');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product= Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', ' تم حذف القسم  .');
    }
}
