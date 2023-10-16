<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LocalizationController extends Controller
{
    public function setLocale($locale)
    {
        if(array_key_exists($locale, config('app.available_locales')))
        {
            // Set expiration to a year 
            // (laravel expects minutes, so: minutes * hours * days)
            $localeCookie = Cookie::make('locale', $locale, 60 * 24 * 365);
            return redirect()->back()->withCookie($localeCookie);
        }
        return redirect()->back();
    }
}
