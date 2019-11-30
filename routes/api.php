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
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {

    Route::get('products', 'API\ProductController@index');

    Route::get('products/{id}', 'API\ProductController@show');

    Route::post('cart', 'API\CartController@store');

    Route::get('mee', 'API\CartController@mee');

    Route::get('cart', 'API\CartController@showCurrentCart');

    Route::get('customer', 'API\CustomerController@showCurrent');

    Route::post('order', 'API\CustomerController@store');

    Route::post('cart_order', 'API\OrderController@storeFromCart');

    Route::post('register', 'API\AuthController@register');

    Route::post('login', 'API\AuthController@login');

    Route::post('googleLogin', 'API\AuthController@googleLogin');

    Route::get('me', 'API\AuthController@me');

    Route::get('logout', 'API\AuthController@logout');

    Route::get('setCookie', 'API\CustomerController@setCookie');

    Route::get('getCookie', 'API\CustomerController@getCookie');

    Route::get('search', 'API\ProductController@search');

    Route::get('category', 'API\ProductCategoryController@getAllCategory');

    Route::get('size', 'API\ProductDetailController@getSize');
});
