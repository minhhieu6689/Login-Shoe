<?php

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('frontend.layout');
});

Route::get('/cc', function () {
    return view('frontend.cc');
});

Auth::routes();

Route::get('/google/redirect', 'SocialAuthFacebookController@redirectGoogle');
Route::get('/google/callback', 'SocialAuthFacebookController@callbackGoogle');

Route::get('/facebook/redirect', 'SocialAuthFacebookController@redirectFacebook');
Route::get('/facebook/callback', 'SocialAuthFacebookController@callbackFacebook');

Route::get('/home', 'HomeController@index')->name('home');
