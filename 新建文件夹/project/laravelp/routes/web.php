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

Route::get('/','Home\User\UserController@index');

Route::group(['prefix'=>'home'],function(){
   Route::group(['prefix'=>'user','namespace'=>'Home\User'],function(){
       Route::get('myzone','UserController@myzone');
       Route::get('addgod','UserController@addgod');
       Route::get('addcomic','UserController@addcomic');
   });
});



//后台
Route::group(['prefix'=>'admin'],function(){
    Route::group(['prefix'=>'user','namespace'=>'Admin\User'],function(){
        Route::get('/index','IndexController@index');

        Route::get('/login','IndexController@login');

        Route::post('/login','IndexController@seteing');
    });
});
























