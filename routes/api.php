<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\{
    UserController,
    InstitutionController,
    MenuController,
    CategoryController,
    MealController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'controller' => 'LoginController'], function (){
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function (){
    Route::apiResources([
        'users' => UserController::class,
        'institutions' => InstitutionController::class,
        'menus' => MenuController::class,
        'categories' => CategoryController::class,
        'meals' => MealController::class,
    ]);
});
