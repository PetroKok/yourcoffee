<?php

namespace App\Http\Controllers\App;

use App\Events\OrderShipped;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\Order\OrderStoreRequest;
use App\Models\Order;
use App\Service\Interfaces\CityGetServiceInterface;
use App\Service\Interfaces\OrderServiceInterface;

class OrderController extends Controller
{
    private $cityGetService;
    private $orderService;

    public function __construct(
        OrderServiceInterface $orderService,
        CityGetServiceInterface $cityGetService
    )
    {
        $this->cityGetService = $cityGetService;
        $this->orderService = $orderService;
    }

    public function makeOrder(OrderStoreRequest $request)
    {
        $order = $this->orderService->makeOrder($request->validated());

        event(new OrderShipped($order));

        return redirect()->route('success_order', $order->id);
    }

    public function getSuccess($order)
    {
        $order = $this->orderService->getOrder($order);

        [$city,] = $this->cityGetService->show($order->city_id);

        return view('app::pages.order_success', compact(
            'order',
            'city'
        ));
    }
}
