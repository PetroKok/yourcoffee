<?php

namespace App\Http\Controllers\App;

use App\DTO\CartDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\App\Cart\CityResource;
use App\Models\City;
use App\Service\Interfaces\CartServiceInterface;
use App\Service\Interfaces\CityGetServiceInterface;
use App\Service\Interfaces\DeliveryServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public $city;

    public function __construct(CityGetServiceInterface $city)
    {
        $this->city = $city;
    }

    public function show(Request $request, $city = null)
    {
        [$data, $add] = $this->city->show($city);

        $res = new CityResource($data);

        return $res->additional($add);
    }
}
