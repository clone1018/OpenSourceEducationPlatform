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

Route::get('/', function() {
	return View::make('layouts.master');
});

Route::controller('account', 'AccountController');

Route::get('forum', 'TopicController@index');
Route::get('topic/{slug}/{id}', 'TopicController@show');
Route::resource('topic/reply', 'ReplyController');

Route::resource('topic', 'TopicController');
