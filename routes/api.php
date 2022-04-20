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
 //laravel route basical two prameter pass
 //required parameter
 Route::get('user/{name}',function($name) {
    return 'hi '.$name;
});
 //options parameter
 Route::get('users/{name?}', function($name=null) {
    return 'hi' .$name;
});

 //laravel constric onliy accept alphabet not numaric
 Route::get('checkalphabet/{name?}', function($name=null) {
    return 'hi' .$name;
})->where('name','[a-zA-Z]+');

//laravel constric onliy accept numaric not alphabet
Route::get('checknumaric/{id?}', function($id=null) {
    return 'Product id is ' .$id;
})->where('id','[0-9]+');

 //laravel Global Validation
 Route::get('product/{name?}', function($name=null) {
    return 'product name Is ' .$name;
});
///user provider on add two line
//Route::pattern('id', '[0-9]+');
//Route::pattern('name','[a-zA-Z]+');
 //laravel Global Validation
 Route::get('Proudcts/{id?}', function($id=null) {
    return 'Product id is ' .$id;
});

Route::match(['get', 'post'], '/user/profile', function () {
    return 'Product id is ' .$id;
});
Route::any('users/{id}', function ($id) {

});