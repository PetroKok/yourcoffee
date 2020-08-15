<?php

namespace App\Http\Controllers\App;

use App\DTO\CartDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\Cart\CartCreateRequest;
use App\Http\Resources\App\Cart\CityResource;
use App\Models\City;
use App\Service\Interfaces\CartServiceInterface;
use App\Service\Interfaces\CityServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public $cart;
    public $city;

    public function __construct(CartServiceInterface $cart, CityServiceInterface $city)
    {
        $this->cart = $cart;
        $this->city = $city;
    }

    public function index(Request $request)
    {
        $cart = new CartDto();
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $carts = $this->cart->index($cart)->toArray(true);

        $cities = $this->city->indexPluck();

        return view('app::pages.cart', compact('carts', 'cities'));
    }

    public function store(CartCreateRequest $request)
    {
        $cart = new CartDto();
        $cart->setProductId($request->get('id'));
        $cart->setQty($request->get('qty') ?? 1);
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $response = $this->cart->store($cart);

        return response()->json(['data' => $response]);
    }

    public function increase(CartCreateRequest $request)
    {
        $cart = new CartDto();
        $cart->setProductId($request->get('id'));
        $cart->setQty($request->get('qty') ?? 1);
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $response = $this->cart->store($cart);

        return response()->json(['data' => $response]);
    }

    public function decrease(CartCreateRequest $request)
    {
        $cart = new CartDto();
        $cart->setProductId($request->get('id'));
        $cart->setQty($request->get('qty') ?? -1);
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $response = $this->cart->store($cart);

        return response()->json(['data' => $response]);
    }

    public function delete(Request $request)
    {
        $cart = new CartDto();
        $cart->setProductId($request->get('id'));
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $response = $this->cart->delete($cart);

        return response()->json(['data' => $response]);
    }
}
