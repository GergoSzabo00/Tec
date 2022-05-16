<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use App\Http\Requests\Auth\EmailVerificationRequest;
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \App\Http\Requests\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        $user = User::findOrfail($request->route('id'));

        if ($user == null)
        {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('login').'?verified=1');
        }

        

        if($this->verify($user))
        {
            event(new Verified($user));
        }

        return redirect()->intended(route('login').'?verified=1');
    }

    private function verify($user)
    {
        return $user->forceFill([
            'is_verified' => 1,
        ])->save();
    }

}
