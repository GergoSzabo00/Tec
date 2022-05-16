<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {   
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if ($user == null)
        {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', __('verification.verification-link-resent'));
    }
}
