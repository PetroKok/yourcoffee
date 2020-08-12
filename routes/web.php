<?php

use Illuminate\Support\Facades\Route;

Route::auth();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/cart', 'CartController')->except(['show']);

Route::post('/cart/increase', 'CartController@increase');
Route::post('/cart/decrease', 'CartController@decrease');

Route::post('/cart/order', 'OrderController@makeOrder');

Route::get('/cart/order/{order_id}', 'OrderController@getSuccess')
    ->where(['order_id' => '[0-9]+'])
    ->name('success_order');

Route::get('/city/delivery_amount/{city?}', 'CityController@show');


Route::group(['middleware' => 'auth:customer', 'prefix' => 'profile'], function () {
    Route::get('/', 'ProfileController@show');
});
