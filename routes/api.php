<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// auth routes
Route::group(['prefix' => 'auth'], function() {
    Route::post('/register', 'API\RegisterController@register');
    Route::post('/login', 'API\LoginController@login');
});

// Protected routes
Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function() {
    Route::get('/logout', 'API\LogoutController@logout');
});

//hotels crud routes
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('hotels', 'API\HotelsController@getAllHotels');
	Route::get('hotels/{id}', 'API\HotelsController@getHotel');
	Route::post('hotels', 'API\HotelsController@createHotel');
	Route::put('hotels/{id}', 'API\HotelsController@updateHotel');
	Route::delete('hotels/{id}','API\HotelsController@deleteHotel');
});

// Documentation
Route::get('/', 'API\DocumentationController@index');



