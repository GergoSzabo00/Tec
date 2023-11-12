<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Country;
use App\Models\CustomerInfo;
use App\Models\Address;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::all();
        return view('auth.register')->with(compact('countries'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'alpha', 'max:255'],
            'lastname' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
            'country' => ['required', 'exists:countries,id'],
            'city' => ['required', 'alpha'],
            'state' => ['required', 'alpha'],
            'zip_code' => ['required', 'integer', 'min:0', 'digits_between:3,10'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'max:15'],
            'terms' => ['required'],
        ]);

        return DB::transaction(function () use ($request) 
        {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $country_name = Country::find($request->country)->name;

            $address = Address::create([
                'country' => $country_name,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'city' => $request->city,
                'address' => $request->address,
            ]);

            $address->save();
            $user->save();

            $user->customer_addresses()->attach($address);

            CustomerInfo::create([
                'user_id' => $user->id,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
            ]);

            event(new Registered($user));

            session()->put('email', $user->email);

            return redirect()->route('verification.notice')->with('status', __('verification.verification-link-sent'));
        });
    }
}
