<?php

namespace App\Service\Implementation\App\Order;

use App\DTO\CartDto;
use App\DTO\User\UserDTO;
use App\Models\Order;
use App\Poster\Decorator\Product\IProductDecorator;
use App\Service\Interfaces\CartServiceInterface;
use App\Service\Interfaces\OrderServiceInterface;
use App\Service\Interfaces\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{

    public $order;
    public $userService;
    public $cartService;
    public $productDecorator;

    public function __construct(
        Order $order,
        UserServiceInterface $userService,
        CartServiceInterface $cartService,
        IProductDecorator $productDecorator
    )
    {
        $this->order = $order;
        $this->userService = $userService;
        $this->cartService = $cartService;
        $this->productDecorator = $productDecorator;
    }


    public function makeOrder(array $data): Order
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

        $cart = new CartDto();
        $cart->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);

        $carts = $this->cartService->rawCart($cart);

        if ($carts->count()) {
            $order = DB::transaction(function () use ($data, $cart, $carts) {
                $order = $this->order->create($data);

                $this->cartService->clearCart($cart);

                $order = $this->storeOrderLines($order, $carts);

                $order->load('lines.product.translation');

                return $order;
            });

            return $order;
        }
        abort(404);
    }

    public function getOrder(int $ids): Order
    {
        $order = $this->order->with('lines')->findOrFail($ids);
        foreach ($order->lines as $key => $line) {
            $p_id = $order->lines[$key]['product_id'];
            $order->lines[$key]['product'] = $this->productDecorator->find($p_id);
        }
        return $order;
    }

    public function getOrders(array $ids): Collection
    {
        $orders = [];
        foreach ($ids as $id) {
            $order = $this->order->with('lines')->findOrFail($id);
            foreach ($order->lines as $key => $line) {
                $p_id = $order->lines[$key]['product_id'];
                $order->lines[$key]['product'] = $this->productDecorator->find($p_id);
            }
            $orders[] = $order;
        }
        return Collection::make($orders);
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
