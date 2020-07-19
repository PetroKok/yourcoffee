<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Order\OrderStoreRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function makeOrder(OrderStoreRequest $request)
    {
        dd($request->all(), 1);
    }
}
