<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Product;

class ProductController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {

    }

    public function show(Product $product)
    {

    }

    public function edit(Product $product)
    {
        
    }

    public function destroy(Product $product)
    {

    }

}
