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


Route::post("/posts" , [\App\Http\Controllers\Api\PostController::class , 'all'])->withoutMiddleware("throttle:api");

Route::post("/posts/last" , [\App\Http\Controllers\Api\PostController::class , 'last'])->withoutMiddleware("throttle:api");

Route::post("/post/{post:slug}" , [\App\Http\Controllers\Api\PostController::class , 'get'])->withoutMiddleware("throttle:api");

Route::post("/tags" , [\App\Http\Controllers\Api\TagController::class , 'all'])->withoutMiddleware("throttle:api");

Route::post("/tag/{tag:name}" , [\App\Http\Controllers\Api\TagController::class , 'get'])->withoutMiddleware("throttle:api");
