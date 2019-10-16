<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app::welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');
