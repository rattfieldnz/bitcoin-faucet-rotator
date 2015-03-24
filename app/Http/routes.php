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

Route::get('/', 'FaucetsController@index');
Route::resource('faucets', 'FaucetsController');
Route::get('admin/admin', 'AdminController@index');
Route::get('admin/overview', 'AdminController@overview');
Route::resource('payment_processors', 'PaymentProcessorsController');

Route::get('payment_processors', 'PaymentProcessorsController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
