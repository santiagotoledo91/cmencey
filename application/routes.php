<?php

/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

//temporally direct access allowed

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
	Route::any('/','admin.home@index');
	Route::any('admin','admin.home@index');
	
	Route::get('admin/docs/manage','admin.docs@manage');
	Route::get('admin/docs/add','admin.docs@add');
	Route::post('admin/docs/add','admin.docs@add');
	Route::get('admin/docs/edit/(:num)','admin.docs@edit');
	Route::post('admin/docs/edit/(:num)','admin.docs@edit');
	Route::get('admin/docs/pending','admin.docs@pending');
	Route::get('admin/docs/expired','admin.docs@expired');

	Route::get('admin/employees/add','admin.employees@add');
	Route::post('admin/employees/add','admin.employees@add');
	Route::get('admin/employees/manage','admin.employees@manage');
	Route::get('admin/employees/edit/(:num)','admin.employees@edit');
	Route::post('admin/employees/edit/(:num)','admin.employees@edit');

	Route::get('admin/paysheets/pre','admin.paysheets@pre');
	Route::post('admin/paysheets/view','admin.paysheets@view');
	Route::post('admin/paysheets/save','admin.paysheets@save');
	Route::get('admin/paysheets/list','admin.paysheets@list');

	Route::post('admin/print/receipt','admin.print@receipts');
	Route::get('admin/print/paysheet/(:num)','admin.print@paysheet');
	Route::get('admin/print/attendance','admin.print@attendance');
	Route::get('admin/print/employees','admin.print@employees');
	Route::get('admin/print/socialbeneficts/(:num)','admin.print@socialbeneficts');

	Route::get('admin/socialbeneficts/employeeslist','admin.socialbeneficts@employeeslist');
	Route::get('admin/socialbeneficts/pre/(:num)','admin.socialbeneficts@pre');
	Route::post('admin/socialbeneficts/view','admin.socialbeneficts@view');
	Route::post('admin/socialbeneficts/save','admin.socialbeneficts@save');
	Route::get('admin/socialbeneficts/list','admin.socialbeneficts@list');

	
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