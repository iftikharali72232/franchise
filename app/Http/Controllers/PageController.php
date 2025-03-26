<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }
    public function aboutUs()
    {
        return view('about_us');
    }

}
