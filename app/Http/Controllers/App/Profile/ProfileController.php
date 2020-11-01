<?php

namespace App\Http\Controllers\App\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\App\Profile\Order\OrderHistoryResource;
use App\Models\Address;
use App\Models\City;
use App\Service\Interfaces\CityServiceInterface;
use App\Service\Interfaces\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public CityServiceInterface $city;
    public OrderServiceInterface $orderService;

    public function __construct(CityServiceInterface $city, OrderServiceInterface $orderService)
    {
        $this->city = $city;
        $this->orderService = $orderService;
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
            ->orderBy('orders.updated_at', 'desc')
            ->pluck('id');

        $orders = $this->orderService->getOrders($orders->toArray());

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
