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

Route::get('login', 'LoginController@getForm');
Route::post('login', 'LoginController@postForm');
Route::get('logout', 'LoginController@logout');

Route::get('index', function () {
    return view('index');
});
Route::group(['middleware'=>'adminLogin'],function() { 
		Route::get('/user', ['as' => 'home', 'uses' => 'AccountController@index']);
		Route::get('/DeleteUser/{menu}', 'AccountController@delete');
		Route::get('/EditUser/{menu}', 'AccountController@edit');
		Route::post('/updateUser/{menu}', 'AccountController@update');
		Route::post('/editpass/{menu}', 'AccountController@editpass');
		Route::get('/adduser', 'AccountController@adduser');
		Route::post('/newuser', 'AccountController@insert');

		Route::get('/place', 'PlaceController@index');
		Route::get('/DeletePlace/{menu}', 'PlaceController@delete');
		Route::get('/EditPlace/{menu}', 'PlaceController@edit');
		Route::post('/updatePlace/{menu}', 'PlaceController@update');
		Route::get('/addplace', 'PlaceController@addplace');
		Route::post('/newplace', 'PlaceController@insert');

		Route::get('/event', 'EventController@index');
		Route::get('/DeleteEvent/{menu}', 'EventController@delete');
		Route::get('/EditEvent/{menu}', 'EventController@edit');
		Route::post('/updateEvent/{menu}', 'EventController@update');
		Route::get('/addevent', 'EventController@addevent');
		Route::post('/newevent', 'EventController@insert');

		Route::get('/festival', 'FestivalController@index');
		Route::get('/DeleteFestival/{menu}', 'FestivalController@delete');
		Route::get('/EditFestival/{menu}', 'FestivalController@edit');
		Route::post('/updateFestival/{menu}', 'FestivalController@update');
		Route::get('/addfestival', 'FestivalController@addfestival');
		Route::post('/newfestival', 'FestivalController@insert');
});
