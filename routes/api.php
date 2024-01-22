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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/posts" , [\App\Http\Controllers\Api\PostController::class , 'all']);

Route::get("/posts/last" , [\App\Http\Controllers\Api\PostController::class , 'last']);

Route::get("/post/{post:slug}" , [\App\Http\Controllers\Api\PostController::class , 'get']);

Route::get("/tags" , [\App\Http\Controllers\Api\TagController::class , 'all']);

Route::get("/tag/{tag:name}" , [\App\Http\Controllers\Api\TagController::class , 'get']);
