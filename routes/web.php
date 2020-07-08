<?php

use Illuminate\Support\Facades\Route;

Route::auth();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/cart', 'CartController');
Route::post('/cart/increase', 'CartController@increase');
Route::post('/cart/decrease', 'CartController@decrease');

Route::post('/cart/order', 'OrderController@makeOrder');

Route::get('/city/delivery_amount/{city?}', 'CityController@show');
