<?php

namespace App\Service\Implementation;

use App\Repository\Interfaces\CategoryRepositoryInterface;
use App\Service\Interfaces\CategoryServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryService implements CategoryServiceInterface
{

    public $category;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    public function index(): Collection
    {
        return $this->category->index();
    }

    public function store(array $attributes): Model
    {
        return $this->category->store($attributes);
    }

    public function update(array $attributes, Model $model): Model
    {
        return $this->category->update($attributes, $model);
    }

    public function fields(): array
    {
        return $this->category->fields();
    }

    public function indexPluck(array $except = []): \Illuminate\Support\Collection
    {
        return $this->category->indexPluck($except);
    }
}
