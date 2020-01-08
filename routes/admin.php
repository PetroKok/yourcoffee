<?php

use Illuminate\Support\Facades\Route;

Route::auth();

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::resource("/categories", 'CategoryController');
Route::post("/categories/collection", 'CategoryController@collection');
