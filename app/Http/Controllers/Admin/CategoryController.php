<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use App\Service\Interfaces\CategoryServiceInterface;
use App\Service\Interfaces\FileServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public $categoryService;
    public $fileService;

    public function __construct(CategoryServiceInterface $categoryService, FileServiceInterface $fileService)
    {
        $this->categoryService = $categoryService;
        $this->fileService = $fileService;
    }

    public function index(Request $request)
    {
        return view('admin.pages.index');
    }

    public function collection()
    {
        $data['meta']['title'] = trans('admin.menu.categories');
        $data['data'] = new CategoryResource($this->categoryService->index());
        $data['fields'] = $this->categoryService->fields();
        return response($data, 200);
    }

    public function create()
    {
        $categories = $this->categoryService->indexPluck();
        return view('admin.category.create', compact('categories'));
    }


    public function store(CategoryStoreRequest $request)
    {
        $data = $request->all();

        if ($request->has('image')) {
            $data['image'] = $this->fileService->moveImage($data['image'], config('files.categories_path'));
        }

        $this->categoryService->store($data);

        return redirect()->route('admin::categories.index');
    }

    public function edit(Category $category)
    {
        $categories = $this->categoryService->indexPluck([$category->id]);
        return view('admin.category.create', compact('category', 'categories'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->all();

        if ($request->has('image')) {
            $this->fileService->deleteImage($category->image);
            $data['image'] = $this->fileService->moveImage($data['image'], config('files.categories_path'));
        }

        $this->categoryService->update($data, $category);

        return redirect()->route('admin::categories.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $this->fileService->deleteImage($category->image);
        $category->delete();
        return new CategoryResource($category);
    }
}
