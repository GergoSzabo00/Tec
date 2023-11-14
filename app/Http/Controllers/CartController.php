<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StoreInfo;
use App\Models\Coupon;

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
     * Gets the discount for the cart.
     *
     * @return int
     */
    private function getDiscount($cart, $total) {

        if (!isset($cart['coupon_code']))
        {
            return 0;
        }

        $coupon = Coupon::where('code', $cart['coupon_code'])->first();

        if (!$coupon) {
            unset($cart['coupon_code']);
            return 0;
        }

        if ($coupon->type == 'numeric') {
            return $coupon->coupon_value;
        } else {
            return ($total * $coupon->coupon_value) / 100;
        }
    }

    /**
     * Calculates the value of the items in the cart.
     * 
     * @return int
     */
    private function calculateSubtotal($cartItems)
    {
        $subtotal = 0;

        foreach($cartItems as $item)
        {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return $subtotal;
    }

    /**
     * Calculates the number of the items present in the cart.
     * 
     * @return int
     */
    private function calculateNumOfItems($cartItems)
    {
        $numberOfItems = 0;

        foreach($cartItems as $item)
        {
            $numberOfItems += $item['quantity'];
        }

        return $numberOfItems;
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
        
        $couponDiscount = 0;
        $cartItemCount = 0;
        $subtotal = 0;
        $totalPrice = 0;
        $cart = session()->get('cart', []);
        $couponCode = '';

        $cartItems = [];

        if (!isset($cart['items'])) {
            $cart['items'] = [];
        }

        $cartItems = $cart['items'];

        $subtotal = $this->calculateSubtotal($cartItems);

        $cartItemCount = $this->calculateNumOfItems($cartItems);

        if(!empty($cartItems))
        {
            $totalPrice = $subtotal + $shippingCost;
        } else {
            unset($cart['coupon_code']);
            session()->put('cart', $cart);
        }

        if(isset($cart['coupon_code'])) {
            $couponCode = $cart['coupon_code'];
        }
        
        $couponDiscount = $this->getDiscount($cart, $totalPrice);

        $totalPrice -= $couponDiscount;
        
        return response()->json([
            'cartItemCount' => $cartItemCount,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shippingCost' => $shippingCost,
            'totalPrice' => $totalPrice,
            'couponCode' => $couponCode,
            'couponDiscount' => $couponDiscount,
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

        $cart = session()->get('cart', []);

        if (!isset($cart['items'])) {
            $cart['items'] = [];
        }

        if(isset($cart['items'][$request->id]))
        {
            $cart['items'][$request->id]['quantity']++;
        }
        else
        {
            $cart['items'][$request->id] = 
            [
                'product_name' => $product->product_name,
                'quantity' => 1,
                'product_image' => $product->product_image,
                'price' => $product->price
            ];
        }

        session()->put('cart', $cart);

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

        $cart = session()->get('cart', []);

        if(!isset($cart['items'])) {
            $cart['items'] = [];
        }

        $cart['items'][$request->id]['quantity'] = $request->quantity;

        session()->put('cart', $cart);

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
        $cart = session()->get('cart', []);

        if(isset($cart['items'][$request->id])) 
        {
            unset($cart['items'][$request->id]);
            session()->put('cart', $cart);
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

    /**
     * Applies coupon for the cart if the coupon code is valid
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function applyCoupon(Request $request) 
    {
        $cart = session()->get('cart', []);

        if (!isset($cart['items']))
        {
            return response()->json(['status'=>422, 'error'=>__('Cannot apply coupon code while cart is empty!'), 422]);
        }

        if (empty($cart['items'])) {
            return response()->json(['status'=>422, 'error'=>__('Cannot apply coupon code while cart is empty!'), 422]);
        }

        $coupon = Coupon::where('code', $request->code)->first();

        if(!$coupon) {
            return response()->json(['status'=>404, 'error'=>__('Invalid coupon code!')], 404);
        }

        if($coupon->expires_at < date("Y-m-d")) 
        {
            return response()->json(['status'=>410, 'error'=>__('Coupon expired.'), 410]);
        }

        $shippingCost = StoreInfo::first()->shipping_cost;
        $cartValue = $this->calculateSubtotal($cart['items']);
        $totalCartValue = $cartValue + $shippingCost;

        if($totalCartValue < $coupon->minimum_cart_amount)
        {
            $amountNeeded = $coupon->minimum_cart_amount - $totalCartValue;
            return response()->json(['status'=>422,
                'error'=>__('In order to use this coupon, you have to buy more items.') . ' ' . __('You are missing: ') . '$' . number_format($amountNeeded, 2, ',', ' '),
                422]);
        }

        $cart['coupon_code'] = $coupon->code;

        session()->put('cart', $cart);

        return response()->json(['status'=>200, 'data'=>'success']);
    }

    /**
     * Removes coupon from the cart if there is a coupon applied
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function removeCoupon() 
    {
        $cart = session()->get('cart', []);

        if(!isset($cart['coupon_code'])) {
            return;
        }

        unset($cart['coupon_code']);

        session()->put('cart', $cart);

        return response()->json(['status'=>200, 'data'=>'Success']);

    }

}
