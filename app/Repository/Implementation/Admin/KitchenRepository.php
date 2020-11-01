<?php

namespace App\Repository\Implementation\Admin;

use App\Abstracts\RepositoryAbstract;
use App\Models\Kitchen;
use App\Repository\Interfaces\KitchenRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class KitchenRepository extends RepositoryAbstract implements KitchenRepositoryInterface
{
    public $model;

    public function __construct(Kitchen $model)
    {
        $this->model = $model;
    }

    public function index(): Collection
    {
        return $this->model->orderBy('id', 'ASC')->with('city_relation.translation')->get();
    }

    public function store(array $attributes): Model
    {
        $model = parent::store($attributes);
        $model->saveDeliveryPrice($attributes);
        return $model;
    }

    public function update(array $attributes, Model $model): Model
    {
        $model = parent::update($attributes, $model);
        $model->saveDeliveryPrice($attributes);
        return $model;
    }

    public function indexPluck(array $except): \Illuminate\Support\Collection
    {
        return $this->model->all()->except($except)->pluck('title', 'id');
    }
}
