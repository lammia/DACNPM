<?php

use Illuminate\Http\Request;

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

Route::get('/get-districts', 'AccountController@getDistrictByProvinceId');
Route::get('/get-villages', 'AccountController@getVillageByDistrictId');
Route::get('/get-events', 'TourController@getEventByPlaceId');
Route::get('/events', 'ApiController@getEvents');
Route::get('/places', 'ApiController@getPlaces');
