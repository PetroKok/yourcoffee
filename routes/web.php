<?php

use Illuminate\Support\Facades\Route;

Route::auth();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/cart', 'HomeController@cart')->name('cart');
