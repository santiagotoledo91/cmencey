<?php

/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

Route::any('/','home@index');

/*
|--------------------------------------------------------------------------
| Management system Routes
|--------------------------------------------------------------------------
*/

// User authentication

Route::get('admin/login','admin.auth@login');
Route::post('admin/login','admin.auth@login');

Route::get('admin/logout','admin.auth@logout');

// Restricted areas

Route::group(array('before' => 'auth'), function() 
{ 
	Route::any('admin','admin.home@index');
	Route::get('admin/docs','admin.docs@index');
	Route::get('admin/docs/add','admin.docs@add');
	Route::post('admin/docs/add','admin.docs@add');

	// all other restricted routes goes here

});

/*
--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) { return Redirect::to('admin/login'); }
});