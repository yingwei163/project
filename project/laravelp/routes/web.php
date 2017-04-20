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
//后台
Route::get('/admin/loginout','Admin\IndexController@loginout');
Route::get('/admin/login','Admin\IndexController@login');
Route::post('/admin/login','Admin\IndexController@loginp');
Route::group(['prefix'=>'admin','middleware'=>'Rbac'],function(){
    Route::get('index','Admin\IndexController@index');
    Route::group(['prefix'=>'user','namespace'=>'Admin\User'],function(){
        Route::get('/power_list','PowerController@powerlist');
        Route::get('/power_edit/{id}','PowerController@poweredit');
        Route::post('/power_editp','PowerController@powereditp');
        Route::any('/power_add','PowerController@poweradd');
        Route::get('/power_del/{id}','PowerController@powerdel');
        Route::any('/power_assign/{id}','PowerController@powerassign');
        Route::get('/attach_list','AttachController@attachlist');
        Route::any('/attach_add','AttachController@attachadd');
        Route::any('/attach_edit/{id}','AttachController@attachedit');
        Route::get('/attach_del/{id}','AttachController@attachdel');
        Route::get('/role_list','RoleController@rolelist');
        Route::any('/role_add','RoleController@roleadd');
        Route::any('/role_edit/{id}','RoleController@roleedit');
        Route::get('/role_del/{id}','RoleController@roledel');
        Route::any('/role_assign/{id}','RoleController@roleassign');
    });
});
Route::get('/',function (){
    return redirect('/index');
});

Route::get('/index',function(){
    return view('/index')->with('show','')->with('bodycolor','');
});
Route::get('/index/{show?}/{bodycolor?}', function ($show='',$bodycolor='') {
    return view('index')->with('show',$show)->with('bodycolor',$bodycolor);
});
Route::post('/home/user/regist','Home\User\UserController@regist');
Route::post('/home/user/login','Home\User\UserController@login');

Route::group(['prefix'=>'home','middleware'=>'homelogin'],function(){
    Route::group(['prefix'=>'user','namespace'=>'Home\User'],function(){
        Route::get('/c-index', 'UserController@userindex');
        Route::get('/loginout','UserController@userloginout');
        Route::get('myzone','UserController@myzone');
        Route::get('addgod','UserController@addgod');
        Route::get('addcomic','UserController@addcomic');
        Route::get('usercon','UserController@usercon');
        Route::post('ucnrename','UserController@ucnrename');
        Route::post('ucnrefile','UserController@ucnrefile');
        Route::get('addr/{upid?}','UserController@addrin');
        Route::post('userinfoup','UserController@infoup');
        Route::post('/email','UserController@inemail');
        Route::get('/verify/{confirmed_code}','UserController@emailConfirm');
//        Route::get('/upemail','UserController@upemail');
        Route::get('/addcomic','UserController@addcomic'); //添加暴漫和趣图（控制器->addcomic方法）
        Route::post('/addrage','UserController@addrage');  //添加的验证（控制器->addrage方法）
        Route::get('/trueadd','UserController@trueadd');  //添加成功后跳转到添加成功页面 (控制器->trueadd)
        Route::get('/addgod','UserController@addgod');  //添加神作的连载(控制器->addgod)
        Route::get('/addgod','UserController@addgod');  //个人中心->我的神作(控制器->mygod)//个人中心的分组
        Route::get('/mygod','UserController@mygod');//个人中心 我的神作
        Route::get('/bbgoddel/{id}','UserController@bbgoddel');  //删除神作->暴漫
        Route::get('/iigoddel/{id}','UserController@iigoddel');  //删除神作->趣图

    });
});
























