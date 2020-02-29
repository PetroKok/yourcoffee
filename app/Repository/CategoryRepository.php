<?php

namespace App\Repository;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function index(int $per_page = 10): array
    {
        return $this->model->orderBy('position', 'ASC')->get()->toArray();
    }

    public function store(array $attributes): array
    {
        return (array)$this->model->create($attributes);
    }

    public function fields(): array
    {
        return $this->model::fields();
    }

    public function indexPluck(array $except): array
    {
        return $this->model->all()->except($except)->pluck('title', 'id')->toArray();
    }
}
