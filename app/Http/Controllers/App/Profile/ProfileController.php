<?php

namespace App\Http\Controllers\App\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\App\Profile\Order\OrderHistoryResource;
use App\Models\Address;
use App\Models\City;
use App\Service\Interfaces\CityServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public $city;

    public function __construct(CityServiceInterface $city)
    {
        $this->city = $city;
    }

    public function index(Request $request)
    {
        $addresses = Auth::guard('customer')->user()->addresses()->with('city.translations')->get();
        $cities = $this->city->indexPluck();
        return view('app::pages.profile.profile_index', compact('addresses', 'cities'));
    }

    public function history(Request $request)
    {
        $orders = Auth::guard('customer')
            ->user()
            ->orders()
            ->with('lines.product')
            ->orderBy('orders.updated_at', 'desc')
            ->get();

        $orders = OrderHistoryResource::collection($orders);
        return view('app::pages.profile.profile_history', compact('orders'));
    }

    public function address(Request $request)
    {
        $user = Auth::guard('customer')
            ->user();
        $id = $request->get('id');
        $user->addresses()->where('id', '<>', $id)->update(['main' => false]);
        $user->addresses()->where('id', $id)->update(['main' => true]);
    }
}
