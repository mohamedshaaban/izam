<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'App\Http\Controllers\AuthsController@login');
Route::post('register', 'App\Http\Controllers\AuthsController@register');
