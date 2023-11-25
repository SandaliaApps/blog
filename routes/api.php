<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => config('app.apiversion'), 'as' => config('app.apiversion')], function () {
    
    Route::middleware('auth:sanctum')->group(function(){
        // Api Resources
        Route::apiResource('users', UserController::class);
        Route::apiResource('blogs', BlogController::class);
    });

    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::get('login', 'login');
        Route::get('register', 'register');
        Route::post('logout', 'logout')->middleware('auth:sanctum');
    });
    
});
