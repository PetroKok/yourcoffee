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

class ConstructorController extends Controller
{
    public function __invoke()
    {
        return view('app::pages.constructor');
    }
}
