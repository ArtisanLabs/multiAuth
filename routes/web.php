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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * All the admin routes go here
 * @prefix admin
*/
Route::prefix('admin')->group(function (){
	Route::get('/login', [
		'uses' => 'PageController@getAdminLogin',
		'as' => 'admin.login'
	]);

	Route::post('/login', [
		'uses' => 'PageController@authAdmin',
		'as' => 'admin.login'
	]);

	// Route to admins dashboard
	Route::get('/home', [
		'uses' => 'AdminController@index',
		'as' => 'admin.home'
	]);
});

