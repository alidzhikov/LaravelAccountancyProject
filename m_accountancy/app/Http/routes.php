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

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('transaction/trash', 'createNewRecordController@trashed');
Route::patch('transaction/{id}/restore', ['as' => 'transaction.restore','uses' => 'createNewRecordController@restore']);

Route::resource('transaction', 'createNewRecordController');
Route::post('transaction/store', 'createNewRecordController@store');

Route::resource('clients','clientsController');

Route::resource('products','ProductsController');

Route::resource('prices', 'PricesController');

Route::get('stats/getClientAmounts', ['as' => 'stats/getClientAmounts' , 'uses' => 'StatsController@getClientAmounts']);
Route::get('stats/getTotalSums', ['as' => 'stats/getTotalSums' , 'uses' => 'StatsController@getTotalSums']);
Route::get('stats/clientsProducts', ['as' => 'stats/clientsProducts' , 'uses' => 'StatsController@clientsProducts']);
Route::get('stats/productSales', ['as' => 'stats/productSales' , 'uses' => 'StatsController@productSales']);
Route::get('stats', 'StatsController@index');


Route::get('gainz',['middleware' => 'manager',function(){
   return 'This page can only be viewed by managers who are managers because they have all kinds of gainzZzZz';
}]);