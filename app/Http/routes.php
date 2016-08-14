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



Route::get('login', 'LoginController@login');
Route::post('doLogin', 'LoginController@doLogin');
Route::get('logout', 'LoginController@logout');

//这里是需要鉴权为sa的
Route::group([
    'middleware' => 'auth:sa',
    'prefix'     => 'sa',
], function (){
    Route::get('home', 'Sa\HomeController@index');
    Route::group(['prefix' => 'admins'], function () {
        Route::get('/', 'Sa\AdminController@index');
        Route::post('get', 'Sa\AdminController@getAdmin');
        Route::post('add', 'Sa\AdminController@add');
        Route::get('delete', 'Sa\AdminController@delete');
        Route::post('edit', 'Sa\AdminController@edit');
    });
});


//这里是需要鉴权为user的
Route::group([
    'middleware' => 'auth:user',
    'prefix'     => 'user',
], function (){

});

//这里是需要鉴权为admin的
Route::group([
    'middleware' => 'auth:admin',
    'prefix'     => 'admin',
], function () {
    Route::group(['prefix' => 'home'], function (){
        Route::get('/', 'Admin\HomeController@home');
    });
});