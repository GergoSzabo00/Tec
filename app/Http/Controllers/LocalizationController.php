<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function setLocale($locale)
    {
        if(array_key_exists($locale, config('app.available_locales')))
        {
            session()->put('locale', $locale);
        }
        return redirect()->back();
    }
}
