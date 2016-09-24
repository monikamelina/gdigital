<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', 'HomeController@index');
Route::get('/profile', 'HomeController@profile');
Route::put('/profile', 'HomeController@updateProfile');
Route::get('/campaing', 'HomeController@campaing');
Route::post('/contact', 'HomeController@store');
Route::get('/contact/{id}', 'HomeController@edit');
Route::patch('/contact/{id}', 'HomeController@update');
Route::delete('/contact/delete/{id}', 'HomeController@destroy');
Route::get('datatables/{data}', ['uses'=>'HomeController@anyData', 'as' => 'datatables.data']);

Auth::routes();

Route::get('/social/redirect/{provider}', [
	'as' 	=> 'social.redirect',
	'uses' 	=> 'Auth\AuthController@redirectToProvider'
]);

Route::get('/social/handle/{provider}', [
	'as' 	=> 'social.handle',
	'uses' 	=> 'Auth\AuthController@handleProviderCallback'
]);

Route::get('/social/verify/{code}', [
    'as' => 'confirmation',
    'uses' => 'Auth\AuthController@confirm'
]);

// Administrator Area
Route::group(['prefix' => 'admin',  'middleware' => ['auth','admin']], function () {
	Route::get('/', 'Admin\HomeController@index');
	Route::resource('users', 'Admin\HomeController', ['except' => ['index' ]]);
	
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
