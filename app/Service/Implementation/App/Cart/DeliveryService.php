<?php

namespace App\Service\Implementation\App\Cart;

use App\Models\City;
use App\Models\Kitchen;
use App\Service\Interfaces\DeliveryServiceInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DeliveryService implements DeliveryServiceInterface
{
    public function index(City $city)
    {
        return DB::table('kitchen_city')
            ->selectRaw('kitchens.*, cities_l10n.name as city, kitchen_city.*')
            ->where('kitchen_city.city_id', $city->id)
            ->whereRaw('kitchen_city.price_delivery =
                (SELECT MIN(price_delivery) from kitchen_city where city_id = ?)', [$city->id])
            ->join('kitchens', 'kitchen_city.kitchen_id', 'kitchens.id')
            ->join('cities', 'kitchens.city_id', 'cities.id')
            ->join('cities_l10n', 'cities_l10n.city_id', 'cities.id')
            ->where('cities_l10n.locale', '=', App::getLocale())
            ->where('kitchens.is_open', '<>', Kitchen::CLOSED)
            ->first();
    }
}
