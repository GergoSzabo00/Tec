<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentOption;
use App\Models\Coupon;
use App\Models\StoreInfo;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        $cart = session()->get('cart', []);

        if (!isset($cart['items'])) {
            return redirect('cart');
        }

        $cartItems = $cart['items'];

        if (empty($cartItems))
        {
            return redirect('cart');
        }

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
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CheckoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart['items'])) {
            return redirect('cart');
        }

        $cartItems = $cart['items'];

        if (empty($cartItems))
        {
            return redirect('cart');
        }

        return DB::transaction(function () use ($request, $cart, $cartItems)
        { 
            $customer_name = $request->firstname.' '.$request->lastname;

            $country = Country::find($request->country);

            $shippingCost = StoreInfo::first()->shipping_cost;
            
            $shipping_address = null;

            $user_id = null;

            $email = $request->email;

            if(auth()->check())
            {
                $user = Auth::user();
                $user_id = $user->id;

                if($request->address == "Newaddress")
                {
                    $country = Country::find($request->country);

                    if($request->save_address == 1)
                    {
                        $address = Address::create([
                            'country' => $country->name,
                            'state' => $request->state,
                            'zip_code'=> $request->zip_code,
                            'city' => $request->city,
                            'address' => $request->new_address
                        ]);

                        $user->customer_addresses()->attach($address);

                    }

                    $shipping_address = $country->name.' '.$request->zip_code.' '.$request->state.' '.$request->city.' '.$request->new_address;
                }
                else
                {
                    $address = Address::find($request->address);
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

            $subtotal = 0;

            $discount = 0;

            foreach($cartItems as $cartItem)
            {
                $subtotal += $cartItem['price'] * $cartItem['quantity'];
            }

            $totalPrice += $subtotal + $shippingCost;

            $discount = $this->getDiscount($cart, $totalPrice);

            $totalPrice -= $discount;

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

            foreach($cartItems as $cartItem)
            {
                $price = $cartItem['price'] * $cartItem['quantity'];
                $quantity = $cartItem['quantity'];
                $orderDetail = OrderDetail::create([
                    'order_id' => $order->id,
                    'product_name' => $cartItem['product_name'],
                    'bought_quantity' => $quantity,
                    'price' => $price
                ]);
            }

            Mail::to($email)->queue(new OrderPlaced($order, $subtotal, $shippingCost, $discount));

            session()->forget('cart');

            // TODO: return to a page where the invoice or some summary can be seen
            return redirect('checkout')->with('success', __('Order placed successfully!'));
        });
    }
}
