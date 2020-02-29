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

    public function update(Model $cat, array $attributes): Model
    {
        $cat->update($attributes);
        return $cat;
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
