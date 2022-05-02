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
        $subtotal = 0;
        $totalPrice = 0;
        $cartItems = session()->get('cart', []); 

        foreach($cartItems as $item)
        {
            $cartItemCount += $item['quantity'];
            $subtotal += $item['price'] * $item['quantity'];
        }

        if(!empty($cartItems))
        {
            $totalPrice = $subtotal + $shippingCost;
        }
        
        return response()->json([
            'cartItemCount' => $cartItemCount,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shippingCost' => $shippingCost,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Add an item to the cart.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        if(!$request->id)
        {
            return;
        }

        $request->validate(['id' => 'exists:products,id']);

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
        if(!$request->id || !$request->quantity)
        {
            return;
        }

        $cartItems = session()->get('cart', []);

        $cartItems[$request->id]['quantity'] = $request->quantity;

        session()->put('cart', $cartItems);

        return response()->json(['data'=>'success']);
    }

    /**
     * Removes an item from the cart.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart(Request $request)
    {
        $cartItems = session()->get('cart', []);

        if(isset($cartItems[$request->id])) 
        {
            unset($cartItems[$request->id]);
            session()->put('cart', $cartItems);
        }

        return response()->json(['data'=>'success']);
    }

     /**
     * Removes all the items from the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function removeAllFromCart()
    {
        session()->forget('cart');

        return response()->json(['data'=>'success']);
    }

}
