<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['translations', 'products' => function($q){
            $q->with('translations');
        }])->get();

        return view('app::pages.home', compact('categories'));
    }

    public function cart(Request $request)
    {
        return view('app::pages.cart');
    }
}
