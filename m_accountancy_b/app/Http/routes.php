<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'createNewRecordController@index');
Route::get('home', 'createNewRecordController@index');
//Route::post('order/store','createNewRecordController@store');
//Route::get('order/create', 'createNewRecordController@create');
//Route::post('order/show','createNewRecordController@show');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::resource('transaction', 'createNewRecordController');
Route::post('transaction/store', 'createNewRecordController@store');
Route::get('transaction/printView/{transaction}', 'createNewRecordController@printView');
Route::get('transaction/{transaction}/resend', 'createNewRecordController@resend');

Route::resource('clients','clientsController');

Route::resource('products','ProductsController');

Route::get('gainz',['middleware' => 'manager',function(){
   return 'This page can only be viewed by managers who are managers because they have all kinds of gainzZzZz';
}]);