<?php

namespace App\Http\Controllers\App;

use App\DTO\CartDto;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Service\Interfaces\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $cartService;

    public function __construct(CartServiceInterface $cart)
    {
        $this->cartService = $cart;
    }

    public function index()
    {
        $categories = Category::with(['translations', 'products' => function ($q) {
            $q->with('translations');
        }])->get();

        $cartItem = new CartDto();
        $cartItem->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $carts_count = $this->cartService->count($cartItem);

        return view('app::pages.home', compact('categories', 'carts_count'));
    }
}
