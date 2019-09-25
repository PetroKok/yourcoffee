<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app::welcome');
});

Route::get('/test', function () {
    return 'test';
});

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');
