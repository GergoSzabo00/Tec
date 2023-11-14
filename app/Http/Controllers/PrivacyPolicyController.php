<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PrivacyPolicyController extends Controller
{
    function index()
    {
        return view('privacy_policy');
    }
}
