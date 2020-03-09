<?php

namespace App\Providers;

use App\Models\Category;
use App\Repository\CategoryRepository;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\IngredientRepository;
use App\Repository\IngredientRepositoryInterface;
use App\Repository\LabelRepository;
use App\Repository\LabelRepositoryInterface;
use App\Repository\ProductRepository;
use App\Repository\ProductRepositoryInterface;
use App\Service\CategoryService;
use App\Service\CategoryServiceInterface;
use App\Service\FileService;
use App\Service\FileServiceInterface;
use App\Service\IngredientService;
use App\Service\IngredientServiceInterface;
use App\Service\LabelService;
use App\Service\LabelServiceInterface;
use App\Service\ProductService;
use App\Service\ProductServiceInterface;
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
