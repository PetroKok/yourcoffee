<?php

namespace App\Http\Controllers\App;

use App\DTO\CartDto;
use App\Http\Controllers\Controller;
use App\Memory\Redis\IRedisStorage;
use App\Poster\Decorator\Category\ICategoryDecorator;
use App\Poster\Decorator\Product\IProductDecorator;
use App\Poster\Menu\IRCategory;
use App\Poster\Menu\IRProduct;
use App\Poster\Spot\IRSpot;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public ICategoryDecorator $category;
    public IProductDecorator $product;
    public IRProduct $ir_product;

    public function __construct(ICategoryDecorator $category, IProductDecorator $product, IRProduct $ir_product)
    {
        $this->category = $category;
        $this->product = $product;
        $this->ir_product = $ir_product;
    }

    public function index()
    {
        $categories = $this->category->all();

        $all_products = $this->product->all();

        $products = $this->ir_product->groupByCategory($all_products, $categories);

        $cartItem = new CartDto();
        $cartItem->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        return view('app::pages.home', compact('products'));
    }
}
