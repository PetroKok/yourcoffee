<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryRepositoryInterface
{

    public $model;

    public function __construct(Model $model)
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
}
