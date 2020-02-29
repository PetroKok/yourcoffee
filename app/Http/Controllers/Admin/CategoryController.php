<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use App\Service\CategoryServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
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

        $data['image'] = $this->categoryService->moveImage($data['image'], config('files.categories_path'));

        $this->categoryService->store($data);

        return redirect()->route('admin::categories.index');
    }

    public function show(Category $category)
    {
        $category->load('category');
        return view('admin::category.show', compact('category'));
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
            $this->categoryService->deleteImage($category->image);
            $data['image'] = $this->categoryService->moveImage($data['image'], config('files.categories_path'));
        }

        $this->categoryService->update($category, $data);

        return redirect()->route('admin::categories.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return new CategoryResource($category);
    }
}
