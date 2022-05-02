<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentOption;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $paymentOptions = PaymentOption::all();
        return view('checkout')->with(compact('countries','paymentOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems))
        {
            return redirect('checkout');
        }

        return DB::transaction(function () use ($request, $cartItems)
        { 
            $customer_name = $request->firstname.' '.$request->lastname;
            $shipping_address = $request->country;

            $order_status = OrderStatus::where('name', 'Processing')->first();

            $payment_option = PaymentOption::find($request->payment_option);

            $totalPrice = 0;

            foreach($cartItems as $key => $cartItem)
            {
                $product = Product::find($key);

                if($product != null)
                {
                    $totalPrice += $product->price * $cartItem['quantity'];
                }
            }

            $order = Order::create([
                'customer_name' => $customer_name,
                'shipping_address' => $shipping_address,
                'phone' => $request->phone,
                'order_status' => $order_status->id,
                'payment_option' => $payment_option,
                'total_price' => $totalPrice
            ]);

            $order->save();
        });
    }
}
