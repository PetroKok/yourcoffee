<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('app::pages.home');
    }

    public function cart(Request $request)
    {
        return view('app::pages.cart');
    }
}
