<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdatePersonalInfoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $customerInfo = $user->customer_info;

        if(!session()->has('tab'))
        {
            session()->flash('tab', 'personal-info'); 
        }
        

        return view('profile')->with(compact('user', 'customerInfo'));
    }


    /**
     * Update the personal information of the logged in user.
     *
     * @param  \App\Http\UpdatePersonalInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePersonalInfo(UpdatePersonalInfoRequest $request)
    {
        $user = Auth::user();
        $customerInfo = $user->customer_info;

        $customerInfo->update($request->except('_token'));

        return redirect()->route('profile')
        ->with('success', __('Successfully updated personal information!'))
        ->with('tab', 'personal-info');;
    }

    /**
     * Change the password of the logged in user.
     *
     * @param  \App\Http\ChangePasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile')
        ->with('success', __('Successfully changed password!'))
        ->with('tab', 'security');
    }

}
