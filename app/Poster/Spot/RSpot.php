<?php

namespace App\Poster\Spot;

use App\Poster\Poster;

class RSpot extends Poster implements IRSpot
{
    private $spot;
    private $hall;

    public function all(int $spot_id = null, int $hall_id = null)
    {
        $routeTree = ['spots', 'getTableHallTables'];

        $this->setRoute($routeTree);

//        $this->setSpot($spot_id);
//        $this->setHall($hall_id);

        $res = $this->request();

        $res = collect(json_decode($res->getBody()->getContents())->response);

        return $res;
    }

    public function find()
    {
        // TODO: Implement find() method.
    }

    public function setSpot(int $id = null)
    {
        $this->spot = $id;
        $this->setOnUrl($this->spot, 'spot_id');
    }

    public function setHall(int $id = null)
    {
        $this->hall = $id;
        $this->setOnUrl($this->hall, 'hall_id');
    }
}
