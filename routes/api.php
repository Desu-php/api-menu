<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    Route::group(['middleware' => ['auth:sanctum']], function (){
        Route::post('logout', 'logout');
        Route::get('me', 'me');
    });
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function (){
    Route::apiResources([
        'users' => 'UserController',
        'institutions' => 'InstitutionController',
        'menus' => 'MenuController',
        'categories' => 'CategoryController',
        'meals' => 'MealController',
    ]);
});
