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

    public function update(Model $cat, array $attributes): Model;

    public function moveImage(UploadedFile $file, string $path);

    public function deleteImage(string $image_name);
}
