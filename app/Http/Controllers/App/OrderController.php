<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Order\OrderStoreRequest;
use App\Service\Interfaces\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function makeOrder(OrderStoreRequest $request)
    {
        $this->orderService->makeOrder($request->validated());
    }
}
