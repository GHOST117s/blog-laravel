<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CommentController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[UserController::class,'register']);

Route::post('/login',[UserController::class,'login']);


Route::post('/store-comment', [UserController::class,'comment']);

Route::put('/editpost/{id}', [UserController::class,'editpost']);

Route::put('/delete/{id}', [UserController::class,'deletepost']);



// Route::middleware(['auth:api'])->group(function(){

    // Route::get('/user/{id}',[UserController::class,'getUser'])
// });

Route::get('/user/{id}',[UserController::class,'getUser'])->middleware('auth:api');