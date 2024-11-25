<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\QuizController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResultController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//Route::middleware(['auth:sanctum'])->group(['prefix' => 'v1'], function () {

 //   Route::apiResource('users', UserController::class);
  //  });

  Route::group(
    ['prefix' => 'v1', 'middleware' => 'jwt.auth'], function() {
        Route::get('/user', function (Request $request) {
            return auth()->user();
        });

        Route::apiResource('users',  UserController::class)->middleware('jwt.auth');
        Route::apiResource('quizzes',  QuizController::class)->middleware('jwt.auth');
        Route::apiResource('results',  ResultController::class)->middleware('jwt.auth');

      ;});


        Route::group([

            'middleware' => 'api',
            'prefix' => 'auth'

        ], function ($router) {

            Route::post('login', [AuthController::class, 'login']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::post('me', [AuthController::class, 'me']);

        });

 //  Route::middleware(['auth:sanctum'])->group(function () {

 //   Route::prefix('v1')->group(function(){
 //       Route::resource('users',  UserController::class);
 //   });
  //  });

