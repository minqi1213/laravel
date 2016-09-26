<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::any('engineer/login', 'Engineer\LoginController@login');
    Route::get('engineer/code', 'Engineer\LoginController@code');
    Route::get('engineer/getcode', 'Engineer\LoginController@getcode');
    Route::get('engineer/crypt', 'Engineer\LoginController@crypt');

    Route::any('cp/login', 'Cp\LoginController@login');
    Route::get('cp/code', 'Cp\LoginController@code');
});

Route::group(['middleware' => ['web', 'engineer.login'], 'prefix' => 'engineer', 'namespace' => 'Engineer'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');

    Route::get('bug', 'BugController@index');
    Route::post('getbug', 'BugController@getbug');
    Route::post('savebug', 'BugController@savebug');
    Route::post('savechange', 'BugController@savechange');

    Route::get('case', 'CaseController@index');
    Route::post('getcase', 'CaseController@getcase');
    Route::post('updatestatus', 'CaseController@updatestatus');
    Route::post('getbugdetail', 'CaseController@getbugdetail');

    Route::get('mission', 'MissionController@index');
    Route::post('getmission', 'MissionController@getmission');
    Route::any('acceptmission', 'MissionController@acceptmission');

    Route::any('upload', 'CommonController@upload');
});

Route::group(['middleware' => ['web', 'cp.login'], 'prefix' => 'cp', 'namespace' => 'Cp'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');

    Route::get('bug', 'BugController@index');
    Route::post('getbug', 'BugController@getbug');

    Route::get('mission', 'MissionController@index');
    Route::post('getmission', 'MissionController@getmission');
    Route::any('savemission', 'MissionController@savemission');
    Route::any('savechange', 'MissionController@savechange');

    Route::any('upload', 'CommonController@upload');
});
