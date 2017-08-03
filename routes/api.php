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
		
		Route::resource('title', 'TitleController', ['except' => [
			'create', 'edit'
		]]);

		Route::resource('category', 'CategoryController', ['except' => [
			'create', 'edit'
		]]);

		Route::resource('reportcategory', 'ReportCategoryController', ['except' => [
			'create', 'edit'
		]]);
		Route::post('post/{id}/addComment', 'PostController@addComment');
		Route::get('post/{id}/comments', 'PostController@showComments');
		Route::delete('post/{id}/deleteComment/{comment_id}', 'PostController@deleteComment');
		Route::get('post/{id}/totalLikes', 'PostController@showTotalLikes');
		Route::post('post/{id}/like', 'PostController@like');
		Route::get('post/{id}/report', 'PostController@report');
		Route::post('post/{id}/report/{report_id}', 'PostController@postReport');
	});

});
