<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FluentController;
use App\Http\Controllers\LoginController;


use Illuminate\Support\Facades\Route;

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

Route::get('/',[ProductController::class,'index'])->name('product.index');

Route::get('Fluent',[FluentController::class, 'index'])->name('Fluent.index');

Route::get('/home/{name}',[HomeController::class,'index'])->name('home.index');

Route::get('/user',[UserController::class,'index'])->name('user.index');

Route::get('/post',[PostController::class,'getAllPost'])->name('post.getAllPost');

Route::get('/login', [LoginController::Class, 'index'])->name('login.index')->middleware('checkusers');

Route::post('/login', [LoginController::Class, 'loginSubmit'])->name('login.submit');
Route::post('/post',[PostController::class,'postSubmit'])->name('post.submit');