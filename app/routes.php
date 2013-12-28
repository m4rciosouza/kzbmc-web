<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::pattern( 'id', '[0-9]+' );

// Route for the Canvas RestFul API
Route::group( array( 'prefix' => 'canvas' ), function()
{
	Route::get('/list', 'CanvasController@listAll' );
	Route::get('/view/{id}', 'CanvasController@view' );
	Route::post('/create', 'CanvasController@create' );
	Route::post('/update', 'CanvasController@update' );
	Route::post('/delete', 'CanvasController@delete' );
});

// Route for the Item RestFul API
Route::group( array( 'prefix' => 'item' ), function()
{
	Route::get('/list/{id}', 'ItemController@listAll' );
	Route::get('/view/{id}', 'ItemController@view' );
	Route::post('/create', 'ItemController@create' );
	Route::post('/update', 'ItemController@update' );
	Route::post('/delete', 'ItemController@delete' );
});