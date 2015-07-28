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

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1'], function()
{
    Route::get('faucets', 'ApiController@faucets');
    Route::get('faucets/{id}', 'ApiController@faucet');
});

Route::get('/', 'RotatorController@index');
Route::get('faucets/{slug}/edit', 'FaucetsController@edit');
Route::resource('faucets', 'FaucetsController');
Route::resource('main_meta', 'MainMetaController');
Route::get('admin/admin', 'AdminController@index');
Route::get('admin/overview', 'AdminController@overview');
Route::resource('payment_processors', 'PaymentProcessorsController');

Route::get('payment_processors', 'PaymentProcessorsController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
