<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('category_name')->get();
        $manufacturers = Manufacturer::orderBy('name')->get();
        $productQuery = Product::query();

        $categoryQueryParam = null;
        $manufacturerQueryParam = null;

        if ($request->query('category') != null) 
        {
            $categoryQueryParam = $request->query('category');
            $productIds = Product::whereHas('categories', function ($query) use($request) {
                $query->where('category_id', $request->query('category'));
            })->pluck('id');
            $productQuery->whereIn('id', $productIds);
        }

        if ($request->query('manufacturer') !== null) 
        {
            $manufacturerQueryParam = $request->query('manufacturer');
            $productQuery->where('manufacturer_id', $request->query('manufacturer'));
        }

        $productQuery->get();
        $products = $productQuery->paginate(10);

        return view('home')->with(compact('products', 'categories', 'manufacturers', 'categoryQueryParam', 'manufacturerQueryParam'));
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