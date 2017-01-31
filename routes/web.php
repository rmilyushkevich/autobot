<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index');

    Route::get('/filters/new', ['as' => 'filter.new', 'uses' => 'FilterController@create']);
    Route::get('/filter/{id}/edit', ['as' => 'filter.edit', 'uses' => 'FilterController@edit']);
    Route::put('/filters', ['as' => 'filter.update', 'uses' => 'FilterController@update']);
    Route::post('/filters', ['as' => 'filter.save', 'uses' => 'FilterController@save']);
    Route::delete('/filter/{id}', ['as' => 'filter.delete', 'uses' => 'FilterController@delete']);

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/users', ['as' => 'users', 'uses' => 'UserController@index']);
        Route::get('/user/{id}/messages', ['as' => 'user.messages', 'uses' => 'MessageController@show']);
        Route::post('/user/{id}/message/test', ['as' => 'message.test', 'uses' => 'MessageController@test']);
        Route::delete('/user/{id}', ['as' => 'user.delete', 'uses' => 'UserController@delete']);

        Route::get('/subscribers', ['as' => 'subscribers', 'uses' => 'MessageController@setChatId']);
        Route::get('/parse', ['as' => 'parse', 'uses' => 'MessageController@parse']);
    });
});

Auth::routes();

Route::get('/mark/{id}/models', 'ModelsController@showByMark');
