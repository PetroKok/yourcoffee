<?php

namespace App\Service;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface CategoryServiceInterface
{
    public function index(): Collection;

    public function indexPluck(array $except = []): \Illuminate\Support\Collection;

    public function fields(): array;

    public function store(array $attributes): Model;

    public function update(array $attributes, Model $model): Model;
}