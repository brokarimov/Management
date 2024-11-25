<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Main;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TerritoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Check;
use Illuminate\Foundation\Console\RouteCacheCommand;
use Illuminate\Support\Facades\Route;


Route::get('/', [Main::class, 'main']);
// Pages
Route::middleware([Check::class . ':admin'])->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('user', UserController::class);
    Route::resource('territory', TerritoryController::class);
    Route::get('/task/{status}', [TaskController::class, 'index'])->name('TaskIndex');
    Route::resource('task', TaskController::class);

    // Answer
    Route::get('answer', [AnswerController::class, 'index']);
    Route::get('/incomingAnswer', [AnswerController::class, 'incomingAnswer']);
    Route::post('/acceptAnswer/{answer}', [AnswerController::class, 'acceptAnswer']);
    Route::post('/reject/{answer}', [AnswerController::class, 'reject']);

    // Management
    Route::get('/management/{status}', [TaskController::class, 'management']);
    Route::post('/onetask', [TaskController::class, 'onetask']);

    // Search
    Route::get('/category-search', [CategoryController::class, 'search']);
    Route::get('/user-search', [UserController::class, 'search']);
    Route::get('/territory-search', [TerritoryController::class, 'search']);
    Route::post('/filter', [TaskController::class, 'filter']);
    Route::post('/filterReport', [TaskController::class, 'filterReport']);

    //Report
    Route::get('/report1', [TaskController::class, 'report1']);
    Route::get('/report2', [TaskController::class, 'report2']);

});

Route::middleware([Check::class . ':user'])->group(function () {
    Route::get('/taskUser/{status}', [TaskController::class, 'indexUser']);
    Route::post('/filterUser', [TaskController::class, 'filterUser']);
    Route::post('/accept/{task}', [TaskController::class, 'accept']);
    Route::post('/answerStore', [AnswerController::class, 'store']);
    Route::post('/reanswer/{task}', [AnswerController::class, 'reanswer']);
});
Route::middleware([Check::class . ':user,admin'])->group(function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('profile', [AuthController::class, 'profileChange']);
    Route::get('/verifyPage', [AuthController::class, 'verifyPage']);
    Route::post('/password', [AuthController::class, 'PasswordChange']);
    Route::post('/passwordUpdate', [AuthController::class, 'PasswordUpdate']);
});

// Login
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


