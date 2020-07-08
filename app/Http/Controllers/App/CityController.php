<?php

namespace App\Http\Controllers\App;

use App\DTO\CartDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\App\Cart\CityResource;
use App\Models\City;
use App\Service\Interfaces\CartServiceInterface;
use App\Service\Interfaces\DeliveryServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public $service;
    public $cart;

    public function __construct(DeliveryServiceInterface $service, CartServiceInterface $cart)
    {
        $this->service = $service;
        $this->cart = $cart;
    }

    public function show(Request $request, ?City $city)
    {
        $data = $this->service->index($city);

        $cartItem = new CartDto();
        $cartItem->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        [, $full_amount] = $this->cart->count($cartItem);

        $res = new CityResource(collect($data));

        $add['total_amount'] = isset($data->price_delivery) ? $full_amount + $data->price_delivery : $full_amount;

        return $res->additional($add);
    }
}
