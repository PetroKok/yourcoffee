<?php

use Illuminate\Support\Facades\Route;

Route::auth();

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::resource("/categories", 'CategoryController')->except(['show']);
Route::post("/categories/collection", 'CategoryController@collection');

Route::resource("/ingredients", 'IngredientController')->except(['show']);
Route::post("/ingredients/collection", 'IngredientController@collection');

Route::resource("/products", 'ProductController')->except(['show']);
Route::post("/products/collection", 'ProductController@collection');

Route::resource("/label", 'LabelController')->except(['show']);
Route::post("/label/collection", 'LabelController@collection');

Route::resource("/cities", 'CityController')->except(['show']);
Route::post("/cities/collection", 'CityController@collection');

Route::resource("/kitchens", 'KitchenController')->except(['show']);
Route::post("/kitchens/collection", 'KitchenController@collection');
