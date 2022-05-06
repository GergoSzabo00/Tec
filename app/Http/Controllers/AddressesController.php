<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $addresses = Auth::user()->customer_addresses;

        if($request->ajax())
        {
            return response()->json($addresses);
        }

        return view('addresses.index')->with(compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('addresses.create')->with(compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\AddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        return DB::transaction(function () use ($request)
        { 
            $country = Country::find($request->country);
            $address = Address::create([
                'country' => $country->name,
                'state' => $request->state,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'address' => $request->address
            ]);

            Auth::user()->customer_addresses()->attach($address);

            return redirect()->route('address.create')->with('success', __('Address saved successfully!'));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        if($address->customers->first()->id != Auth::user()->id)
        {
            return redirect()->route('addresses');
        }
        $countries = Country::all();
        return view('addresses.edit')->with(compact('address', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\AddressRequest  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, Address $address)
    {
        if($address->customers->first()->id != Auth::user()->id)
        {
            return redirect()->route('addresses');
        }

        $country = Country::find($request->country);
        $address->update([
            'country' => $country->name,
            'state' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'address' => $request->address
        ]);

        return redirect()->route('address.edit', $address)->with('success', __('Address updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $address = Address::find($id);

        if($address == null)
        {
            return;
        }

        if($address->customers->first()->id != Auth::user()->id)
        {
            return;
        }
        
        Address::find($id)->delete();
        return response()->json(['data'=>'success']);
    }
}
