<?php

namespace App\Service\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface OrderServiceInterface
{
    public function makeOrder(array $data): Model;
}
