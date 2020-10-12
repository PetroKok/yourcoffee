<?php


namespace App\Poster\Decorator;


use Illuminate\Database\Eloquent\Collection;

class Decorator
{
    public $es;

    public function all()
    {
        $this->loadEntitiesInMemory();
        return $this->es;
    }

    public function find($ids)
    {
        $this->loadEntitiesInMemory();

        $data = null;

        if (is_array($ids)) {
            $data = [];
            foreach ($ids as $id) {
                if (is_numeric($id)) {
                    $data[$id] = $this->es[$id];
                }
            }
            $data = Collection::make($data);
        }
        if (is_numeric($ids)) {
            $data = $this->es[$ids];
            $data = Collection::make($data);
        }

        return $data;
    }
}
