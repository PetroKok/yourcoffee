<?php

namespace App\Service\Interfaces;

use App\Models\City;

interface DeliveryServiceInterface
{
    public function index(City $city);
}
