<?php

namespace App\Http\Controllers\App;

use App\DTO\CartDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\Order\OrderStoreRequest;
use App\Models\Order;
use App\Service\Interfaces\CartServiceInterface;
use App\Service\Interfaces\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private $orderService;
    private $cart;

    public function __construct(CartServiceInterface $cart, OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
        $this->cart = $cart;
    }

    public function makeOrder(OrderStoreRequest $request)
    {
        $order = $this->orderService->makeOrder($request->validated());
        return redirect()->route('success_order', $order->id);
    }

    public function getSuccess($order)
    {
        $order = Order::with('lines.product.translation')->findOrFail($order);

        $cart = new CartDto();
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);
        [$carts_count, $full_amount] = $this->cart->count($cart);

        return view('app::pages.order_success', compact('order', 'carts_count', 'full_amount'));
    }
}
