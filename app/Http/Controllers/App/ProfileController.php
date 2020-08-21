<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\App\Profile\Order\OrderHistoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('app::pages.profile.profile_index');
    }

    public function history(Request $request)
    {
        $orders = Auth::user()->orders()->with('lines.product')->orderBy('orders.updated_at', 'desc')->get();
        $orders = OrderHistoryResource::collection($orders);
        return view('app::pages.profile.profile_history', compact('orders'));
    }
}
