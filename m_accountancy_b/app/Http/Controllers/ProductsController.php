<?php

namespace App\Http\Controllers;

use App\Price;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use Auth;
use DB;
use Carbon\Carbon;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $products = DB::table('products')
            ->get();
        $data = array(
            'user' => $user,
            'products' => $products
        );
        return view('products.products')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newProduct = $request->all();

        $product = new Product();
        $product->type = $newProduct['type'];
        $product->user_id = Auth::user()->id;
        $product->save();

//        $price = new Price();
//        $price->product_id = $product->id;
//        $price->price = $newProduct['price'];
//        $price->start = Carbon::now();
//        $price->save();

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productS = Product::where('products.id',$id)
            ->join('prices','products.id','=','prices.product_id')
            ->select('products.*','prices.price')
            ->get();
        $product = Product::findOrFail($id);
        //$price= DB::table('prices')->where('prices.product_id','=',$id)->first();
        //$product->price = $price->price;

        return view('products.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newProduct = $request->all();

        $product = Product::find($id);
        $product->type = $newProduct['type'];
        $product->user_id = Auth::user()->id;
        $product->save();

//        $price = Price::find($id);
//        $price->product_id = $product->id;
//        $price1 = $newProduct['price'] ? $newProduct['price'] : 0;
//        //$price->price = $price1;
//        $price->start = Carbon::now();
//        $price->save();

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
