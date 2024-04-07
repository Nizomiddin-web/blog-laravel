<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[MainPageController::class,"index"])->name('main');
Route::get('/biz-haqimizda',[MainPageController::class,"about"])->name('about');
Route::get('/hizmatlarimiz',[MainPageController::class,"service"])->name('service');
Route::get('/loyihalar',[MainPageController::class,"project"])->name('project');
Route::get('/contact',[MainPageController::class,"contact"])->name("contact");

// Route::get('posts',[PostController::class,'index'])->name('posts.index');
// Route::get('posts/{post}',[PostController::class,'show'])->name('posts.show');
// Route::get('posts/create',[PostController::class,'create'])->name('posts.create');
// Route::post('posts/create',[PostController::class,'store'])->name('posts.store');
// Route::get('posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');
// Route::put('posts/{post}/edit',[PostController::class,'update'])->name('posts.update');
// Route::delete('posts/{post}/delete',[PostController::class,'destroy'])->name('posts.delete');

Route::get("login",[AuthController::class,'login'])->name('login');
Route::post('authenticate',[AuthController::class,'authenticate'])->name('authenticate');
Route::post('logout',[AuthController::class,'logout'])->name('logout');
Route::get('register',[AuthController::class,'register'])->name('register');
Route::post('register',[AuthController::class,'register_store'])->name('register.store');

Route::resources([
    "posts"=>PostController::class,
    "comments"=>CommentController::class,
]);





