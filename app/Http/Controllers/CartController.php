<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StoreInfo;

class CartController extends Controller
{
    /**
     * Show cart page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Gets number of items in cart, the items themselves from the cart
     * and the total price of the items in the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCartInfo()
    {
        $shippingCost = StoreInfo::first()->shipping_cost;
        
        $cartItemCount = 0;
        $totalPrice = 0;
        $cartItems = session()->get('cart', []); 

        foreach($cartItems as $item)
        {
            $cartItemCount += $item['quantity'];
            $totalPrice += $item['price'] * $item['quantity'];
        }

        if(!empty($cart))
        {
            $totalPrice += $shippingCost;
        }
        
        return response()->json(['cartItemCount' => $cartItemCount, 'cartItems' => $cartItems, 'totalPrice' => $totalPrice]);
    }

    /**
     * Add an item to the cart.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);   

        if($product == null)
        {
            return;
        }

        $cartItems = session()->get('cart', []);

        if(isset($cartItems[$request->id]))
        {
            $cartItems[$request->id]['quantity']++;
        }
        else
        {
            $cartItems[$request->id] = 
            [
                'product_name' => $product->product_name,
                'quantity' => 1,
                'product_image' => $product->product_image,
                'price' => $product->price
            ];
        }

        session()->put('cart', $cartItems);

        return response()->json(['data'=>'success']);
    }

    /**
     * Updates item quantity in cart.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function updateCartQuantity(Request $request)
    {

    }

    /**
     * Removes an item from the cart.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart(Request $request)
    {

    }

     /**
     * Removes all the items from the cart.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function removeAllFromCart(Request $request)
    {

    }

}
