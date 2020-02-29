<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryRepositoryInterface
{
    public $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function index(): Collection
    {
        return $this->model->orderBy('position', 'ASC')->with('translations')->get();
    }

    public function store(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function fields(): array
    {
        return $this->model::fields();
    }

    public function indexPluck(array $except): \Illuminate\Support\Collection
    {
        return $this->model->all()->except($except)->pluck('title', 'id');
    }
}
