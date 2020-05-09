<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use App\Service\Interfaces\CategoryServiceInterface;
use App\Service\Interfaces\FileServiceInterface;
use App\Service\Interfaces\IngredientServiceInterface;
use App\Service\Interfaces\ProductServiceInterface;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public $service;
    public $fileService;
    public $categoryService;
    public $ingredientService;

    public function __construct(
        ProductServiceInterface $productService,
        FileServiceInterface $fileService,
        CategoryServiceInterface $categoryService,
        IngredientServiceInterface $ingredientService
    )
    {
        $this->service = $productService;
        $this->fileService = $fileService;
        $this->categoryService = $categoryService;
        $this->ingredientService = $ingredientService;
    }

    public function index(Request $request)
    {
        return view('admin.pages.index');
    }

    public function collection()
    {
        $data['meta']['title'] = trans('admin.menu.products');
        $data['data'] = ProductResource::collection($this->service->index());
        $data['fields'] = $this->service->fields();
        return response($data, 200);
    }

    public function create()
    {
        $categories = $this->categoryService->indexPluck();
        $ingredients = $this->ingredientService->indexPluck();
        return view('admin::product.create', compact('categories', 'ingredients'));
    }

    public function store(ProductCreateRequest $request)
    {
        $data = $request->all();

        if ($request->has('image')) {
            $data['image'] = $this->fileService->moveImage($data['image'], config('files.products_path'));
            dd($data['image']);
        }

        $this->service->store($data);

        return redirect()->route('admin::products.index');
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryService->indexPluck();
        $ingredients = $this->ingredientService->indexPluck([$product->category_id]);
        return view('admin.product.create', compact('ingredients', 'categories', 'product'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->all();

        if ($request->has('image')) {
            $this->fileService->deleteImage($product->image);
            $data['image'] = $this->fileService->moveImage($data['image'], config('files.products_path'));
            $path = public_path(config('files.products_path').'/'.$data['image']);
            Image::make($path)->resize(600,600)->save();
        }

        $this->service->update($data, $product);

        return redirect()->route('admin::products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response($product, 200);
    }
}
