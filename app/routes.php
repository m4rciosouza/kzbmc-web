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
	Route::get('/', 'CanvasController@listAll' );
	Route::get('/{id}', 'CanvasController@view' );
	Route::post('/', 'CanvasController@create' );
	Route::post('/{id}', 'CanvasController@update' );
	Route::delete('/{id}', 'CanvasController@delete' );
});

// Route for the Item RestFul API
Route::group( array( 'prefix' => 'item' ), function()
{
	Route::get('/canvas/{id}', 'ItemController@listAll' );
	Route::get('/{id}', 'ItemController@view' );
	Route::post('/', 'ItemController@create' );
	Route::post('/{id}', 'ItemController@update' );
	Route::delete('/{id}', 'ItemController@delete' );
	/*
	 * params: canvasId, type, posIni, posEnd 
	 */
	Route::post('/reorder', 'ItemController@reorder' );
});

// Route for the Authentication RestFul API
Route::group( array( 'prefix' => 'auth' ), function()
{
	Route::post('/login', 'AuthenticationController@login' );
	Route::get('/logout', 'AuthenticationController@logout' );
	Route::get('/{id}', 'AuthenticationController@view' );
	Route::post('/', 'AuthenticationController@create' );
	Route::post('/{id}', 'AuthenticationController@update' );
	Route::delete('/{id}', 'AuthenticationController@delete' );
});