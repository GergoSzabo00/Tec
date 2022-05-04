<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentOption;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;
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
        $customerInfo = null;
        $customerAddresses = null;
        if (Auth::user())
        {
            $customerInfo = Auth::user()->customer_info;
            $customerAddresses = Auth::user()->customer_addresses;
        }
        $countries = Country::all();
        $paymentOptions = PaymentOption::all();
        return view('checkout')->with(compact('customerInfo', 'customerAddresses', 'countries', 'paymentOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CheckoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems))
        {
            return redirect('checkout')->with('error', __('No items in cart!'));
        }

        return DB::transaction(function () use ($request, $cartItems)
        { 

            $customer_name = $request->firstname.' '.$request->lastname;

            $country = Country::find($request->country);
            
            $shipping_address = null;

            $user_id = null;

            if(auth()->check())
            {
                $user = Auth::user();
                $user_id = $user->id;

                if($request->addresses == "newAddress")
                {
                    $newAddressCountry = Country::find($request->newAddressCountry);

                    if($request->save_address == 1)
                    {
                        $address = Address::create([
                            'country' => $newAddressCountry->name,
                            'state' => $request->newAddressState,
                            'zip_code'=> $request->newAddressZip_code,
                            'city' => $request->newAddressCity,
                            'address' => $request->newAddressAddress
                        ]);

                        $user->customer_addresses()->attach($address);

                    }
                    

                    $shipping_address = $newAddressCountry->name.' '.$request->newAddressZip_code.' '.$request->newAddressState.' '.$request->newAddressCity.' '.$request->newAddressAddress;
                }
                else
                {
                    $address = Address::find($request->addresses);
                    $shipping_address = $address->country.' '.$address->zip_code.' '.$address->state.' '.$address->city.' '.$address->address;
                }
            }
            else
            {
                $shipping_address = $country->name.' '.$request->zip_code.' '.$request->state.' '.$request->city.' '.$request->address;
            }
    
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
                'user_id' => $user_id,
                'customer_name' => $customer_name,
                'shipping_address' => $shipping_address,
                'phone' => $request->phone,
                'order_status' => $order_status->id,
                'payment_option' => $payment_option->id,
                'total_price' => $totalPrice
            ]);

            $order->save();

            foreach($cartItems as $key => $cartItem)
            {
                $product = Product::find($key);

                if($product != null)
                {
                    $price = $product->price * $cartItem['quantity'];
                    $quantity = $cartItem['quantity'];
                    $orderDetail = OrderDetail::create([
                        'order_id' => $order->id,
                        'product_name' => $product->product_name,
                        'bought_quantity' => $quantity,
                        'price' => $price
                    ]);
                    $totalPrice += $product->price * $cartItem['quantity'];
                }
            }

            session()->forget('cart');

            return redirect('checkout')->with('success', __('Order placed successfully!'));

        });
    }
}
