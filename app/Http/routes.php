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

Route::get('/upload/{folder}/{width}x{height}/{image}', ['as' => 'image.adaptiveResize', 'uses' => 'ImageController@adaptiveResize']);

Route::get('/', function () { return view('frontend.index'); });
Route::get('nosotros', function () { return view('frontend.nosotros'); });
Route::get('servicios', function () { return view('frontend.servicios'); });
Route::get('galerias', function () { return view('frontend.galeria'); });
Route::get('testimonios', function () { return view('frontend.testimonios'); });
Route::get('contacto', function () { return view('frontend.contacto'); });

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
