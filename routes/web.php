<?php

use Illuminate\Support\Facades\Route;

Route::auth();


Route::get('auth/{provider}', 'Auth\SocialLoginController@redirectTo')->name('auth.provider');
Route::get('auth/{provider}/callback', 'Auth\SocialLoginController@handleCallback');

Route::get('/assets/poster/{search}', 'PosterAssetController@index')->where('search', '.*');;

Route::group(['middleware' => 'cart_info'], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('/cart', 'CartController')->except(['show']);

    Route::post('/cart/increase', 'CartController@increase');
    Route::post('/cart/decrease', 'CartController@decrease');

    Route::post('/cart/order', 'OrderController@makeOrder');

    Route::get('/cart/order/{order_id}', 'OrderController@getSuccess')
        ->where(['order_id' => '[0-9]+'])
        ->name('success_order');

    Route::get('/city/delivery_amount/{city?}', 'CityController@show');
    Route::get('/city/all', 'CityController@allCities');
    Route::get('/city/kitchenCities', 'CityController@kitchenCities');

    Route::get('/about_us', 'AboutUsController')->name('about_us');

    Route::get('/constructor', 'ConstructorController')->name('constructor');


    Route::group(['middleware' => 'auth:customer', 'prefix' => 'profile', 'namespace' => 'Profile'], function () {
        Route::get('/', 'ProfileController@index')->name('profile.index');
        Route::get('/history', 'ProfileController@history')->name('profile.history');
        Route::put('/address', 'ProfileController@address')->name('profile.address');
    });
});
