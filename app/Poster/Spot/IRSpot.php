<?php

namespace App\Poster\Spot;

interface IRSpot
{
    public function all(int $spot_id = null, int $hall_id = null);

    public function find();

    public function setSpot(int $id);

    public function setHall(int $id);
}
