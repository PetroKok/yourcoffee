<?php

namespace App\Providers;

use App\Models\Category;
use App\Repository\Implementation\CategoryRepository;
use App\Repository\Implementation\IngredientRepository;
use App\Repository\Implementation\LabelRepository;
use App\Repository\Implementation\ProductRepository;
use App\Repository\Interfaces\CategoryRepositoryInterface;
use App\Repository\Interfaces\IngredientRepositoryInterface;
use App\Repository\Interfaces\LabelRepositoryInterface;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\Service\Implementation\CategoryService;
use App\Service\Implementation\FileService;
use App\Service\Implementation\IngredientService;
use App\Service\Implementation\LabelService;
use App\Service\Implementation\ProductService;
use App\Service\Interfaces\CategoryServiceInterface;
use App\Service\Interfaces\FileServiceInterface;
use App\Service\Interfaces\IngredientServiceInterface;
use App\Service\Interfaces\LabelServiceInterface;
use App\Service\Interfaces\ProductServiceInterface;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{

    public $bindings = [
        CategoryServiceInterface::class => CategoryService::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        FileServiceInterface::class => FileService::class,
        IngredientRepositoryInterface::class => IngredientRepository::class,
        IngredientServiceInterface::class => IngredientService::class,
        ProductServiceInterface::class => ProductService::class,
        ProductRepositoryInterface::class => ProductRepository::class,
        LabelServiceInterface::class => LabelService::class,
        LabelRepositoryInterface::class => LabelRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
