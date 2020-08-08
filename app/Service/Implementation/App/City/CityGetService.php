<?php


namespace App\Service\Implementation\App\City;


use App\DTO\CartDto;
use App\Http\Resources\App\Cart\CityResource;
use App\Models\City;
use App\Service\Interfaces\CartServiceInterface;
use App\Service\Interfaces\CityGetServiceInterface;
use App\Service\Interfaces\DeliveryServiceInterface;
use Illuminate\Support\Facades\Auth;

class CityGetService implements CityGetServiceInterface
{
    public $service;
    public $cart;

    public function __construct(DeliveryServiceInterface $service, CartServiceInterface $cart)
    {
        $this->service = $service;
        $this->cart = $cart;
    }

    public function show($city_id)
    {
        $city = City::find($city_id);

        if (!$city) {
            $city = new City();
        }

        $data = $this->service->index($city);

        $cartItem = new CartDto();
        $cartItem->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        [, $full_amount] = $this->cart->count($cartItem);

        $add['total_amount'] = isset($data->price_delivery) ? $full_amount + $data->price_delivery : $full_amount;

        return [collect($data), $add];
    }
}
