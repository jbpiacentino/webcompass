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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cards', 'CardsController' );
Route::post('/cards/{card}/note', 'NotesController@store');

Route::resource('notes', 'NotesController');

Route::get('/places', 'PlacesController@index');
Route::post('/places/upload', ['as' => 'places.upload', 'uses' => 'PlacesController@upload']);

Route::post('/firefox/upload', ['as' => 'firefox.upload', 'uses' => 'FirefoxController@upload']);
Route::get('/firefox/import', 'FirefoxController@import');
Route::get('/firefox/uploadStatus', function() { return view ('firefox.uploadStatus'); });
Route::get('/firefox/importMozPlaces', 'FirefoxController@importMozPlaces');
Route::get('/firefox/importProgress', 'FirefoxController@importProgress');
Route::resource('firefox', 'FirefoxController');

Route::resource('hosts', 'HostsController');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('fileUpload', function () {
        return view('fileUpload');
});
Route::post('fileUpload', ['as'=>'fileUpload','uses'=>'HomeController@fileUpload']);
