<?php

namespace App\Service\Implementation\App\Order;

use App\DTO\User\UserDTO;
use App\Models\Order;
use App\Service\Interfaces\OrderServiceInterface;
use App\Service\Interfaces\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;

class OrderService implements OrderServiceInterface
{

    public $order;
    public $userService;

    public function __construct(Order $order, UserServiceInterface $userService)
    {
        $this->order = $order;
        $this->userService = $userService;
    }


    public function makeOrder(array $data): Model
    {
        $userDTO = new UserDTO();
        $userDTO->setName($data['name']);
        $userDTO->setPhone($data['phone']);

        tap($this->userService->getOrCreate($userDTO), function ($user) use (&$data) {
            $data['customer_id'] = $user->id;
        });

        $data['status'] = $this->order::STATUS['CREATED'];
        $data['type'] = $this->order::ORDER_TYPE[mb_strtoupper($data['order'])];

        $order = $this->order->create($data);
        dd($order);
    }
}
