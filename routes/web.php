<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TerritoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.main');
});

Route::resource('category', CategoryController::class);
Route::resource('user', UserController::class);
Route::resource('territory', TerritoryController::class);