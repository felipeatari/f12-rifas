<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function termOfUse()
    {
        return view('home.term-of-use');
    }

    public function privacyPolicy()
    {
        return view('home.privacy-policy');
    }
}
