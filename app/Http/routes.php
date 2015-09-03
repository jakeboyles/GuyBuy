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
use App\Offer;

View::composer('partials.sidebar', function ($view)
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

Route::get('community/{community}/category/{category}', 'CategoryController@showPosts');

Route::get('city/{city}', 'CityController@showPosts');
Route::get('city/{city}/category/{category}', 'CategoryController@showCityPosts');
Route::post('city/filter','CityController@filter');
Route::post('city/choose','CommunityController@city');

Route::post('category/filter', 'CategoryController@filter');

Route::post('city/category/filter', 'CategoryController@cityFilter');

Route::post('user/update','HomeController@updateUser');

Route::get('user/profile/{id}','UserController@showProfile');

Route::get('feedback/{id}','UserController@leaveFeedback');
Route::post('feedback/store','UserController@storeFeedback');

Route::get('/facebook/login', 'FacebookController@redirectToProvider');
Route::get('/facebook/callback','FacebookController@handleProviderCallback');



Route::post('post/search','PostController@search');
Route::post('community/filter','CommunityController@filter');
Route::post('community/choose','CommunityController@choose');



Route::post('offer/accept/{id}','OfferController@accept');
Route::post('offer/deny/{id}','OfferController@deny');

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









