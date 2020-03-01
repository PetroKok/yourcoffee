<?php

namespace App\Repository;

use App\Abstracts\RepositoryAbstract;
use App\Models\Ingredients;
use Illuminate\Database\Eloquent\Collection;

class IngredientRepository extends RepositoryAbstract implements IngredientRepositoryInterface
{
    public $model;

    public function __construct(Ingredients $ingredients)
    {
        $this->model = $ingredients;
    }

    public function index(): Collection
    {
        return $this->model->with('translations')->get();
    }

    public function indexPluck(array $except): \Illuminate\Support\Collection
    {
        return $this->model->all()->except($except)->pluck('name', 'id');
    }
}
