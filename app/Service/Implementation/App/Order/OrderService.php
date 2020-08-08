<?php

namespace App\Service\Implementation\App\Order;

use App\DTO\CartDto;
use App\DTO\User\UserDTO;
use App\Models\Order;
use App\Service\Interfaces\CartServiceInterface;
use App\Service\Interfaces\OrderServiceInterface;
use App\Service\Interfaces\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{

    public $order;
    public $userService;
    public $cartService;

    public function __construct(Order $order, UserServiceInterface $userService, CartServiceInterface $cartService)
    {
        $this->order = $order;
        $this->userService = $userService;
        $this->cartService = $cartService;
    }


    public function makeOrder(array $data): Model
    {
        $userDTO = new UserDTO();
        $userDTO->setName($data['name']);
        $userDTO->setPhone($data['phone']);

        tap($this->userService->getOrCreate($userDTO), function ($user) use (&$data) {
            try {
                $data['customer_id'] = $user->id;
            } catch (\Throwable $e) {
                throw $e;
            }
        });

        if ((int)$data['city_id'] === 0) {
            $data['city'] = $data['city_id'];
            $data['city_id'] = null;
        }

        $data['status'] = $this->order::STATUS['CREATED'];
        $data['type'] = $this->order::ORDER_TYPE[mb_strtoupper($data['order'])];

        $order = $this->order->create($data);

        $cart = new CartDto();
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $carts = $this->cartService->rawCart($cart);

        $this->cartService->clearCart($cart);

        $order = $this->storeOrderLines($order, $carts);

        $order->load('lines.product.translation');

        return $order;
    }

    private function storeOrderLines(Order $order, $items)
    {
        $carts = [];

        foreach ($items as $item) {
            $carts[] = [
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
            ];
        }

        DB::table('order_lines')->insert($carts);

        return $order;
    }
}
