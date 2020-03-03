<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ingredient\IngredientCreateRequest;
use App\Http\Resources\Admin\IngredientResource;
use App\Models\Ingredients;
use App\Service\FileServiceInterface;
use App\Service\IngredientServiceInterface;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public $service;
    public $fileService;

    public function __construct(IngredientServiceInterface $ingredientService, FileServiceInterface $fileService)
    {
        $this->service = $ingredientService;
        $this->fileService = $fileService;
    }

    public function index(Request $request)
    {
        return view('admin.pages.index');
    }

    public function collection()
    {
        $data['meta']['title'] = trans('admin.menu.ingredients');
        $data['data'] = IngredientResource::collection($this->service->index());
        $data['fields'] = $this->service->fields();
        return response($data, 200);
    }

    public function create()
    {
        return view('admin::ingredient.create');
    }

    public function store(IngredientCreateRequest $request)
    {
        $data = $request->all();

        $data['image'] = $this->fileService->moveImage($data['image'], config('files.ingredients_path'));
        $data['pic'] = $this->fileService->moveImage($data['pic'], config('files.ingredients_path'));

        $this->service->store($data);

        return redirect()->route('admin::ingredients.index');
    }

    public function show(Ingredients $ingredient)
    {
        return view('admin.ingredient.show', compact('ingredient'));
    }

    public function edit(Ingredients $ingredient)
    {

        return view('admin.ingredient.create', compact('ingredient'));
    }

    public function update(Request $request, Ingredients $ingredient)
    {
        $data = $request->all();


        //костиль, я знаю, часу нема щоб робити нормальний файловий менеджер. =))
        if ($request->has('image')) {
            $this->fileService->deleteImage($ingredient->image);
            $data['image'] = $this->fileService->moveImage($data['image'], config('files.ingredients_path'));
        }

        if ($request->has('pic')) {
            $this->fileService->deleteImage($ingredient->pic);
            $data['pic'] = $this->fileService->moveImage($data['pic'], config('files.ingredients_path'));
        }

        $this->service->update($data, $ingredient);

        return redirect()->route('admin::ingredients.index');
    }

    public function destroy(Ingredients $ingredient)
    {
        $ingredient->delete();
        return response($ingredient, 200);
    }
}
