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

Route::get('/', array('as' => 'home', 'uses' => 'home@index'));

//    GET ROUTES
Route::get('api/v1/user', array('as' => 'api.user', 'uses' => 'api.user@index'));
Route::get('api/v1/user/(:num)', array('uses' => 'api.user@view'));
Route::get('home/signup', array('as' => 'signup', 'uses' => 'home@signup'));
Route::get('api/v1/specialist', array('uses' => 'api.specialist@index'));
Route::get('api/v1/specialist/(:num)/(:num?)', array('uses' => 'api.specialist@view'));
Route::get('api/v1/specialist/map/(:any)/(:num)/(:num?)', array('uses' => 'api.specialist@map'));
Route::get('api/v1/disease', array('uses' => 'api.disease@index'));
Route::get('api/v1/disease/(:num)/(:num?)', array('uses' => 'api.disease@view'));
Route::get('api/v1/tip', array('uses' => 'api.tip@index'));
Route::get('api/v1/tip/(:num)/(:num)', array('uses' => 'api.tip@view'));
Route::get('api/v1/tip/single/(:num)', array('uses' => 'api.tip@single_tip'));
Route::get('api/v1/tip/category', array('uses' => 'api.tip@category'));
Route::get('api/v1/bp/(:num)/(:num)/(:num?)/', array('uses' => 'api.bp@index'));

//    POST ROUTES
Route::post('api/v1/user', array('uses' => 'api.user@index'));
Route::post('api/v1/user/update/(:num)', array('uses' => 'api.user@update'));
Route::post('api/v1/authenticate', array('uses' => 'api.authenticate@index'));
Route::post('home/lga_list/(:num)', array('uses' => 'home@lga_list'));

Route::post('home/json_demo', array('uses' => 'home@json_demo'));


//    PUT ROUTES
//Route::put('api/v1/user', array('uses' => 'api.user@index'));

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
|		Route::get('/', array('before' => 'filter', function()
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