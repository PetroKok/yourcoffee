<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\App\Cart\CityResource;
use App\Models\City;
use App\Service\Interfaces\DeliveryServiceInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public $service;

    public function __construct(DeliveryServiceInterface $service)
    {
        $this->service = $service;
    }

    public function show(Request $request, City $city)
    {
        return new CityResource(collect($this->service->index($city)));
    }
}
