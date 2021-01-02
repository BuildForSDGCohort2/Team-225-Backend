<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// auth routes
Route::group(['prefix' => 'auth'], function() {
    Route::post('/register', 'API\RegisterController@register');
    Route::post('/login', 'API\LoginController@login')->name('login');
    Route::get('/login_required', 'API\LoginController@loginRequired')->name('login_required');
});

// Protected routes
Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function() {
    Route::get('/logout', 'API\LogoutController@logout');
});

//hotels crud routes
Route::get('hotels', 'API\HotelsController@getAllHotels');
Route::get('hotels/{id}', 'API\HotelsController@getHotel');

Route::group(['middleware' => 'auth:api'], function() {
	Route::post('hotels', 'API\HotelsController@createHotel');
	Route::put('hotels/{id}', 'API\HotelsController@updateHotel');
	Route::delete('hotels/{id}','API\HotelsController@deleteHotel');

    // Images operations
    Route::post('/hotels/add-images/{hotel}', 'API\ImageController@addHotelImages');

    //rooms crud routes
    Route::post('/hotels/room/{room}', 'API\RoomsController@addHotelsRooms');
    Route::get('/rooms', 'API\RoomsController@getAllRooms');
    Route::get('rooms/{id}', 'API\RoomsController@getRoom');
    Route::delete('rooms/{id}', 'API\RoomsController@deleteRoom');
    Route::put('/hotels/room/{room}', 'API\RoomsController@UpdateRoom');

    // booking  CRUD routes
    Route::post('/hotels/booking', 'API\BookingsController@makeBooking');
    Route::get('/hotels/booking/{id}', 'API\BookingsController@getABooking');

});

// Documentation
Route::get('/', 'API\DocumentationController@index');
