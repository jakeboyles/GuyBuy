<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Category;

View::composer('partials.sidebar', function ($view)
{
    $categories = Category::all();
    $view->with('categories', $categories);
});

View::composer('partials.nav', function ($view)
{
    $categories = Category::all();
    $view->with('categories', $categories);
});


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('community/{community}', 'CommunityController@showPosts');
Route::get('{community}/category/{category}', 'CategoryController@showPosts');


Route::group(['middleware' => 'auth'], function() {
	Route::get('/post/create','PostController@create');
	Route::post('/post/store','PostController@store');
	Route::post('/comment/store','CommentController@store');
	Route::post('/offer/store','OfferController@store');
});

Route::get('/{community}/post/{id}','PostController@show');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
	Route::get('dashboard', 'HomeController@dashboard');
});








