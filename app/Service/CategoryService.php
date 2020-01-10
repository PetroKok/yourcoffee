<?php

namespace App\Service;

use App\Models\Category;
use App\Repository\CategoryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CategoryService implements CategoryServiceInterface
{

    public $category;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    public function index(int $per_page = 10): array
    {
        return $this->category->index($per_page);
    }

    public function store(array $attributes): array
    {
        return $this->category->store($attributes);
    }

    public function moveImage(UploadedFile $file, string $image_path)
    {
        $image_name = Carbon::today()->format('Y-m-d') . '-' . $file->getClientOriginalName();
        $file->move(public_path($image_path), $image_name);
        return $image_name;
    }

    public function deleteImage(string $image_name)
    {
        $full_path = public_path($image_name);
        if (\File::exists($full_path)) {
            try {
                \File::delete($full_path);
            } catch (\Throwable $e) {
                throw $e;
            }
        }
    }

    public function update(Category $cat, array $attributes): array
    {
        return (array)$cat->update($attributes);
    }

    public function fields(): array
    {
        return $this->category->fields();
    }

    public function indexPluck(array $except = []): array
    {
        return $this->category->indexPluck($except);
    }
}
