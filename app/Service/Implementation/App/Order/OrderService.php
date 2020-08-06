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

        $data['status'] = $this->order::STATUS['CREATED'];
        $data['type'] = $this->order::ORDER_TYPE[mb_strtoupper($data['order'])];

        $order = $this->order->create($data);

        $cart = new CartDto();
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $carts = $this->cartService->rawCart($cart);

        $res = $this->storeOrderLines($order, $carts);

        dd($res);
        return $res;
    }

    private function storeOrderLines(Order $order, $carts)
    {
        dd($order, $carts);
        return 0;
    }
}
