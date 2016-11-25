<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', ['as' => 'getLogin', 'uses' => 'LoginController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'LoginController@postLogin']);
//Route::get('admin', ['as' => 'admin', function () {
//    return view('admin.dashboard.main');
//}]);
Route::get('logout', ['as' => 'getLogout', 'uses' => 'LoginController@getLogout']);
Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::get('/', function () {
            return view('admin.module.dashboard.main');
        });
        Route::group(['prefix' => 'category'], function () {
            Route::get('add', ['as' => 'getCateAdd', 'uses' => 'CateController@getCateAdd']);
            Route::post('add', ['as' => 'postCateAdd', 'uses' => 'CateController@postCateAdd']);
            Route::get('list', ['as' => 'getCateList', 'uses' => 'CateController@getCateList']);
            Route::get('edit/{id}', ['as' => 'getCateEdit', 'uses' => 'CateController@getCateEdit'])->where('id', '[0-9]+');
            Route::post('edit/{id}', ['as' => 'postCateEdit', 'uses' => 'CateController@postCateEdit'])->where('id', '[0-9]+');
            Route::get('delete/{id}', ['as' => 'getCateDelete', 'uses' => 'CateController@getCateDelete'])->where('id', '[0-9]+');
        });
        Route::group(['prefix' => 'user'], function () {
            Route::get('add', ['as' => 'getUserAdd', 'uses' => 'UserController@getUserAdd']);
            Route::post('add', ['as' => 'postUserAdd', 'uses' => 'UserController@postUserAdd']);
            Route::get('list', ['as' => 'getUserList', 'uses' => 'UserController@getUserList']);
            Route::get('delete/{id}', ['as' => 'getUserDelete', 'uses' => 'UserController@getUserDelete'])->where('id', '[0-9]+');
            Route::get('edit/{id}', ['as' => 'getUserEdit', 'uses' => 'UserController@getUserEdit'])->where('id', '[0-9]+');
            Route::post('edit/{id}', ['as' => 'postUserEdit', 'uses' => 'UserController@postUserEdit'])->where('id', '[0-9]+');
        });
        Route::group(['prefix' => 'news'], function () {

        });
    });
});
