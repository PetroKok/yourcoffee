<?php

namespace App\Service\Interfaces;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderServiceInterface
{
    public function makeOrder(array $data): Order;

    public function getOrder(int $id): Order;

    public function getOrders(array $ids): Collection;
}
