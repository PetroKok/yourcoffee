<?php

namespace App\Http\Controllers\App;

use App\DTO\CartDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\App\Cart\CityResource;
use App\Models\City;
use App\Models\Kitchen;
use App\Service\Interfaces\CartServiceInterface;
use App\Service\Interfaces\CityGetServiceInterface;
use App\Service\Interfaces\CityServiceInterface;
use App\Service\Interfaces\DeliveryServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public $cityGet;
    public $kitchen;
    public $city;

    public function __construct(CityGetServiceInterface $cityGet, CityServiceInterface $city, Kitchen $kitchen)
    {
        $this->cityGet = $cityGet;
        $this->city = $city;
        $this->kitchen = $kitchen;
    }

    public function allCities()
    {
        return $this->city->indexPluck()->toArray();
    }

    public function kitchenCities()
    {
        $kitchensWithCities = $this->kitchen->with('city_relation.translation')->get();

        $cities = [];

        foreach ($kitchensWithCities as $k) {
            $cities[$k->city_relation->id] = $k->city_relation->name;
        }

        return $cities;
    }

    public function show(Request $request, $city = null)
    {
        [$data, $add] = $this->cityGet->show($city);

        $res = new CityResource($data);

        return $res->additional($add);
    }
}
