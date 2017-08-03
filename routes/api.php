<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){
	
	Route::post('register', 'Auth\RegisterController@register');

	Route::post('login', 'Auth\LoginController@authenticate');

	Route::group(['middleware' => 'jwt.auth'], function(){
		
		Route::resource('post', 'PostController', ['except' => [
			'create', 'edit'
		]]);

		Route::post('post/{id}/addComment', 'PostController@addComment');
		Route::get('post/{id}/comments', 'PostController@showComments');
		Route::delete('post/{id}/deleteComment/{comment_id}', 'PostController@deleteComment');
		Route::get('post/{id}/totalLikes', 'PostController@showTotalLikes');
		Route::post('post/{id}/like', 'PostController@like');
		Route::post('follow/{user_id}', 'UserFollowerController@userDoFollow');
		Route::get('following', 'UserFollowerController@showFollowing');
		Route::get('followers', 'UserFollowerController@showFollowers');
		Route::get('followers/{user_id}', 'UserFollowerController@userFollowers');
		Route::get('following/{user_id}', 'UserFollowerController@userFollowing');

		Route::get('post/{id}/report', 'PostController@report');
		Route::post('post/{id}/report/{report_id}', 'PostController@postReport');

		Route::get('/{id}', 'ProfileController@index');

		Route::group(['middleware' => 'admin', 'prefix' => 'food'], function(){

			Route::resource('title', 'TitleController', ['except' => [
				'create', 'edit'
			]]);

			Route::resource('category', 'CategoryController', ['except' => [
				'create', 'edit'
			]]);

			Route::resource('reportcategory', 'ReportCategoryController', ['except' => [
				'create', 'edit'
			]]);

			Route::resource('coupon', 'CouponController', ['except' => [
				'create', 'edit'
			]]);

			Route::resource('admin', 'AdminController', ['except' => [
				'create', 'edit'
			]]);
			
		});
		
	});

});
