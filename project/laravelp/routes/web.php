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
Route::get('/index',function(){
    return view('/index')->with('show','')->with('bodycolor','');
});
Route::get('/index/{show?}/{bodycolor?}', function ($show='',$bodycolor='') {
    return view('index')->with('show',$show)->with('bodycolor',$bodycolor);
});

Route::group(['prefix'=>'home'],function(){
    Route::group(['prefix'=>'user','namespace'=>'Home\User'],function(){
        Route::get('/c-index', function () {return view('home/user/c-index');});
        Route::get('/login',function(){return view('home/user/login');});
        Route::post('/regist','UserController@regist');
        Route::post('/login','UserController@login');
        Route::post('/loginout','UserController@loginout');
    });
});
























