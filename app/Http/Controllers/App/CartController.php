<?php

namespace App\Http\Controllers\App;

use App\DTO\CartDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\Cart\CartCreateRequest;
use App\Service\Interfaces\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public $cart;
    public function __construct(CartServiceInterface $cart)
    {
        $this->cart = $cart;
    }

    public function index(Request $request)
    {
        $cart = new CartDto();
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $response = $this->cart->index($cart);
        return response()->json(['data' => $response, 'carts_count' => count($response)]);
    }

    public function store(CartCreateRequest $request)
    {
        $cart = new CartDto();
        $cart->setProductId($request->get('id'));
        $cart->setQty($request->get('qty') ?? 1);
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $response = $this->cart->store($cart);
        return response()->json(['data' => $response, 'carts_count' => count($response)]);
    }

    public function delete(Request $request)
    {
        $cart = new CartDto();
        $cart->setProductId($request->get('id'));
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $response = $this->cart->delete($cart);
        return response()->json(['data' => $response, 'carts_count' => count($response)]);
    }
}