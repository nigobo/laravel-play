<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

// Add the blog-controller


Route::get('/','customer@index');

# Report
Route::get('reports',array('as' => 'reports', 'uses' => 'report@index'));
Route::get('reports/create/(:num)', array('as' => 'create_report', 'uses' => 'report@create'));
Route::post('reports/create/(:num)','report@do_create');
Route::get('reports/update/(:num)',array('as' => 'update_report', 'uses' => 'report@update'));
Route::post('reports/update/(:num)','report@do_update');

# todos
Route::get('todos',array('as' => 'todos', 'uses' => 'todo@index'));
Route::get('todos/(:num)',array('as' => 'read_todo', 'uses' => 'todo@read'));
Route::get('todos/create/(:num)', array('as' => 'create_todo', 'uses' => 'todo@create'));
Route::post('todos/create','todo@do_create');
Route::get('todos/update/(:num)',array('as' => 'update_todo', 'uses' => 'todo@update'));
Route::post('todos/update','todo@do_update');

# Customer
Route::get('customers',array('as' => 'customers', 'uses' => 'customer@index'));
Route::get('customers/(:num)',array('as' => 'read_customer', 'uses' => 'customer@read'));
Route::get('customers/create',array('as' => 'create_customer', 'uses' => 'customer@create'));
Route::post('customers/create','customer@do_create');

# Project
Route::get('projects',array('as' => 'projects', 'uses' => 'project@index'));
Route::get('projects/create/(:num)',array('as' => 'create_project', 'uses' => 'project@create'));
Route::get('projects/(:num)',array('as' => 'read_project', 'uses' => 'project@view'));
Route::post('projects/create/(:num)','project@do_create');

# Login
Route::get('login',array('as' => 'login', 'uses' => 'login@login'));
Route::post('login',array('as' => 'do_login', 'uses' => 'login@do_login'));
Route::get('logout',array('as' => 'logout', 'uses' => 'login@logout'));


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
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
	if (Auth::guest()) return Redirect::to('login');
});