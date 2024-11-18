<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TerritoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Check;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.main');
});
// Pages
Route::middleware([Check::class . ':admin'])->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('user', UserController::class);
    Route::resource('territory', TerritoryController::class);
    Route::resource('task', TaskController::class);

    // Search
    Route::get('/category-search', [CategoryController::class, 'search']);
    Route::get('/user-search', [UserController::class, 'search']);
    Route::get('/territory-search', [TerritoryController::class, 'search']);
    Route::post('/filter', [TaskController::class, 'filter']);
});

Route::middleware([Check::class . ':user'])->group(function () {
    Route::get('/taskUser', [TaskController::class, 'indexUser']);
    Route::post('/filterUser', [TaskController::class, 'filterUser']);
});

// Login
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


