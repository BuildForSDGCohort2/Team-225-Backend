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