<?php

namespace App\Http\Controllers\App;

use App\DTO\CartDto;
use App\Http\Controllers\Controller;
use App\Memory\Redis\IRedisStorage;
use App\Poster\Decorator\Product\IProductDecorator;
use App\Poster\Menu\IRCategory;
use App\Poster\Menu\IRProduct;
use App\Poster\Spot\IRSpot;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public IRCategory $category;
    public IProductDecorator $product;
    public IRProduct $ir_product;
    public IRSpot $spot;
    public IRedisStorage $storage;

    public function __construct(IRCategory $category, IProductDecorator $product, IRProduct $ir_product, IRSpot $spot, IRedisStorage $storage)
    {
        $this->category = $category;
        $this->product = $product;
        $this->spot = $spot;
        $this->storage = $storage;
        $this->ir_product = $ir_product;
    }

    public function index()
    {
        $categories = $this->storage->get(config('cache_keys.categories.key'));
        if (is_null($categories)) {
            $categories = $this->category->all();
            $this->storage->set(config('cache_keys.categories.key'), $categories->toArray(), config('cache_keys.categories.time'));
        }

        $all_products = $this->product->all();

        $products = $this->ir_product->groupByCategory($all_products, $categories);

        $cartItem = new CartDto();
        $cartItem->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        return view('app::pages.home', compact('products'));
    }
}
