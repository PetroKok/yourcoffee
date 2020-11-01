<?php

namespace App\Poster\IncomingOrder;

use App\Poster\Poster;

class IncOrder extends Poster implements IIncOrder
{
    public int $spot_id;

    public function store(array $data)
    {
        $routeTree = ['incomingOrders', 'createIncomingOrder'];

        $this->setRoute($routeTree);

        $this->setBody($data);

        $res = $this->request();

        $res = collect(json_decode($res->getBody()->getContents())->response);

        return $res;
    }

}
