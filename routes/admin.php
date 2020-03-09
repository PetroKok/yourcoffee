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

Route::resource("/labels", 'LabelController')->except(['show']);
Route::post("/labels/collection", 'LabelController@collection');
