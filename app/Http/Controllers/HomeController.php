<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('home')->with(compact('products'));
    }

    /**
     * Search for a product
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchProduct(Request $request)
    {
        if($request->ajax())
        {
            if($request->search_term)
            {
                $search_term = $request->search_term;
                $products = Product::where('product_name', 'LIKE','%'.$search_term.'%')->get();
                
                return response()->json($products);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('productdetail')->with(compact('product'));
    }

}