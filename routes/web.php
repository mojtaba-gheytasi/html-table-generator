<?php

use Illuminate\Support\Facades\Route;

Route::get('/users', 'HomeController@users');

Route::get('/employees', 'HomeController@employees');

Route::get('/companies', 'HomeController@companies');
