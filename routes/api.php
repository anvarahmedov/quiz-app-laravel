<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\QuizController;
use App\Http\Controllers\ResultController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//Route::middleware(['auth:sanctum'])->group(['prefix' => 'v1'], function () {

 //   Route::apiResource('users', UserController::class);
  //  });

  Route::group(
    ['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function() {
        Route::get('/user', function (Request $request) {
            return auth()->user();
        });

        Route::apiResource('users',  UserController::class);
        Route::apiResource('quizzes',  QuizController::class);
        Route::apiResource('results',  ResultController::class);
   });

 //  Route::middleware(['auth:sanctum'])->group(function () {

 //   Route::prefix('v1')->group(function(){
 //       Route::resource('users',  UserController::class);
 //   });
  //  });

