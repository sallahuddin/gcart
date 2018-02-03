<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('product', 'ProductController');

Route::get('products', 'ProductController@index');
Route::post('products/create', 'ProductController@store');
Route::post('products/update', 'ProductController@update');
Route::post('products/delete', 'ProductController@destroy');