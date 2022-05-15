<?php

namespace App\Http\Controllers;

use App\Models\StoreInfo;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $storeInfo = StoreInfo::first();
        return view('contact')->with(compact('storeInfo'));
    }
}
