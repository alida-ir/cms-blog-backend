<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminPanelController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/alida/admin/login" , [AdminLoginController::class , 'login']);
Route::get("/alida/admin/logout" , [AdminLoginController::class , 'logout'])->name('logout-admin');
Route::post("/alida/admin/login" , [AdminLoginController::class , 'store'])->name('login-admin');

Route::get("/alida/admin/panel" , [AdminPanelController::class , 'index'])->name('panel-admin');

Route::post('/alida/admin/upload' , [AdminPanelController::class , 'upload'])->name('upload.file');

Route::get('/alida/admin/post/create' , [AdminPanelController::class , 'createNewPost'])->name('panel-createNewPost');
Route::post('/alida/admin/post/create' , [AdminPanelController::class , 'saveNewPost'])->name('panel-saveNewPost');

Route::get('/alida/admin/post/edit/{post:id}' , [AdminPanelController::class , 'editPost'])->name('panel-editPost');
Route::post('/alida/admin/post/edit/{post:id}' , [AdminPanelController::class , 'updatePost'])->name('panel-updatePost');
Route::delete('/alida/admin/post/delete/{post:id}' , [AdminPanelController::class , 'deletePost'])->name('panel-deletePost');

Route::get('/alida/admin/tag/create' , [AdminPanelController::class , 'createNewTag'])->name('panel-createNewTag');
Route::post('/alida/admin/tag/create' , [AdminPanelController::class , 'saveNewTag'])->name('panel-saveNewTag');
Route::delete('/alida/admin/tag/delete/{tag:id}' , [AdminPanelController::class , 'deleteTag'])->name('panel-deleteTag');

Route::get('/alida/admin/tag/edit/{tag:id}' , [AdminPanelController::class , 'editTag'])->name('panel-editTag');
Route::post('/alida/admin/tag/edit/{tag:id}' , [AdminPanelController::class , 'updateTag'])->name('panel-updateTag');


