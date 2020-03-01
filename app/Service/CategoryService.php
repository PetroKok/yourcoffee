<?php

namespace App\Service;

use App\Models\Category;
use App\Repository\CategoryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
