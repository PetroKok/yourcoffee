<?php

use Illuminate\Support\Facades\Route;

Route::auth();

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::resource("/categories", 'CategoryController');
Route::post("/categories/collection", 'CategoryController@collection');

Route::resource("/ingredients", 'IngredientController');
Route::post("/ingredients/collection", 'IngredientController@collection');

Route::resource("/products", 'ProductController');
Route::post("/products/collection", 'ProductController@collection');
