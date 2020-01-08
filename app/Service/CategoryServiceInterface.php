<?php

namespace App\Service;

use App\Models\Category;
use Illuminate\Http\UploadedFile;

interface CategoryServiceInterface
{
    public function index(int $per_page = 10): array;

    public function store(array $attributes): array;

    public function update(Category $cat, array $attributes): array;

    public function moveImage(UploadedFile $file, string $path);

    public function deleteImage(string $image_name);
}
