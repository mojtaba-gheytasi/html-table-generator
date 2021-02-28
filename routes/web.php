<?php

use Illuminate\Support\Facades\Route;

Route::get('/users', 'UserController@index')->name('users.index');
