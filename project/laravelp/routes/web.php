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
//暴漫后台管理
Route::get('/admin/user/bimg','Admin\User\RageController@bimg');                //暴漫审核后台
Route::get('/admin/user/bimgtrue/{id}','Admin\User\RageController@bimgtrue');   //通过暴漫审核
Route::get('/admin/user/bimgfalse/{id}','Admin\User\RageController@bimgfalse'); //删除暴漫审核作品
Route::get('/amdin/user/img','Admin\User\RageController@img');                  //趣图审核
Route::get('/admin/user/imgtrue/{id}','Admin\User\RageController@imgtrue');   //通过趣图审核
Route::get('/admin/user/imgfalse/{id}','Admin\User\RageController@imgfalse'); //删除趣图审核作品
Route::get('/admin/user/works_hot','Admin\User\RageController@works_hot'); //热门排行
Route::get('/admin/user/addhot','Admin\User\RageController@addhot');       //添加视图
Route::post('/admin/user/hottrue','Admin\User\RageController@hottrue');       //热门的sql添加
Route::get('/admin/user/delhot/{id}','Admin\User\RageController@delhot');     //热门的sql删除
Route::get('/admin/user/works_up','Admin\User\RageController@works_up');   //最新排行
Route::get('/admin/user/delupbimg/{id}','Admin\User\RageController@delupbimg');    //最新排行的删除bimg
Route::get('/admin/user/delupimg/{id}','Admin\User\RageController@delupimg');    //最新排行的删除img
Route::get('/admin/user/deluptxt/{id}','Admin\User\RageController@deluptxt');    //最新排行的删除txt
Route::get('/admin/user/delupvideo/{id}','Admin\User\RageController@delupvideo');    //最新排行的删除video
Route::get('/admin/user/bimgtalks','Admin\User\RageController@bimgtalks');         //暴漫评论
Route::get('/admin/user/delbimgtalk/{id}','Admin\User\RageController@delbimgtalk');         //删除暴漫评论
Route::get('/admin/user/imgtalks','Admin\User\RageController@imgtalks');         //趣图评论
Route::get('/admin/user/delimgtalk/{id}','Admin\User\RageController@delimgtalk');         //删除趣图评论

Route::get('/admin/user/publishs','Admin\User\RageController@publishs');         //连载管理
Route::get('/admin/user/delpublish/{id}','Admin\User\RageController@delpublish');         //删除连载
//cj
//暴走app管理
Route::get('/admin/user/bao','Admin\User\SortController@bao');
Route::any('/admin/user/bao_add','Admin\User\SortController@baoadd');
Route::any('/admin/user/bao_del/{id}','Admin\User\SortController@baodel');
Route::any('/admin/user/bao_edit/{id}','Admin\User\SortController@baoedit');
//暴走app管理
//轮播图管理
Route::get('/admin/user/lbt','Admin\User\SortController@lbt');
Route::any('/admin/user/lbt_add','Admin\User\SortController@lbtadd');
Route::any('/admin/user/lbt_del/{id}','Admin\User\SortController@lbtdel');
Route::any('/admin/user/lbt_edit/{id}','Admin\User\SortController@lbtedit');

//轮播图管理
//制作器管理
Route::get('/admin/user/zzq','Admin\User\SortController@zzq');
Route::any('/admin/user/zzq_add','Admin\User\SortController@zzqadd');
Route::any('/admin/user/zzq_del/{id}','Admin\User\SortController@zzqdel');
Route::any('/admin/user/zzq_edit/{id}','Admin\User\SortController@zzqedit');

//制作器管理
//订阅管理/admin/user/manage_addd
Route::get('/admin/user/manager','Admin\User\SortController@manager');
Route::get('/admin/user/manager_add','Admin\User\SortController@manageradd');
Route::any('/admin/user/manager_addd','Admin\User\SortController@manageraddd');
Route::any('/admin/user/manager_edit/{id}','Admin\User\SortController@manageredit');

Route::any('/admin/user/manager_del/{id}','Admin\User\SortController@managerdel');

//订阅管理
//订阅详情
Route::get('/admin/user/managerdetails','Admin\User\SortController@managerdetails');
Route::get('/admin/user/managerdetails_add','Admin\User\SortController@managerdetailsadd');
Route::any('/admin/user/managerdetails_addd','Admin\User\SortController@managerdetailsaddd');
Route::any('/admin/user/managerdetails_edit/{id}','Admin\User\SortController@managerdetailsedit');
Route::any('/admin/user/managerdetails_del/{id}','Admin\User\SortController@managerdetailsdel');

//订阅详情
//文字详情
Route::get('/admin/user/txt','Admin\User\SortController@txtindex');
Route::any('admin/user/txt_add','Admin\User\SortController@txtadd');
Route::any('admin/user/txt_del/{id}','Admin\User\SortController@txtdel');
Route::any('admin/user/txt_edit/{id}','Admin\User\SortController@txtedit');

//文字详情
//文字审核
Route::any('/admin/user/txtaudit','Admin\User\SortController@txtauditindex');
Route::any('/admin/user/txtauditgod','Admin\User\SortController@txtgod');
Route::any('/admin/user/txtauditon','Admin\User\SortController@txton');
Route::any('/admin/user/txtaudit_edit/{id}','Admin\User\SortController@txtauditedit');
//文字审核
//友情链接管理
Route::any('/admin/link','Admin\User\SortController@linkindex');
Route::any('/admin/link_add','Admin\User\SortController@linkadd');
Route::any('/admin/link_del/{id}','Admin\User\SortController@linkdel');
Route::any('/admin/link_edit/{id}','Admin\User\SortController@linkedit');

//分类标题
Route::get('/admin/user/sort_list','Admin\User\SortController@index');
Route::any('/admin/user/sort_add','Admin\User\SortController@add');
Route::any('/admin/user/sort_addd','Admin\User\SortController@addd');
Route::any('admin/user/sort_del/{id}','Admin\User\SortController@del');
Route::any('admin/user/sort_edit/{id}','Admin\User\SortController@edit');

//视频路由
Route::get('/admin/user/paper_list','Admin\User\SortController@paperlist');
Route::any('/admin/user/paper_add','Admin\User\SortController@paperadd');
Route::any('/admin/user/paper_edit/{id}','Admin\User\SortController@paperedit');
Route::any('/admin/user/paper_del/{id}','Admin\User\SortController@paperdel');
Route::get('/admin/user/feedback_list','Admin\User\SortController@feedbacklist');
Route::any('/admin/user/feedback_edit/{id}','Admin\User\SortController@feedbackedit');






//cj
Route::get('/admin/user/video_list','Admin\User\VideoController@videolist');
Route::any('/admin/user/video_add','Admin\User\VideoController@videoadd');
Route::any('/admin/user/video_del/{id}','Admin\User\VideoController@videodel');
Route::any('/admin/user/video_edit/{id}','Admin\User\VideoController@videoedit');
//Route::get('/admin/user/video_list','RoleController@rolelist');

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

Route::get('/index','Home\User\UserController@sort'
//    function(){
//    return view('/index')->with('show','')->with('bodycolor','');}
);
//暴漫频道
Route::get('/home/user/ragecomic','Home\User\UserController@ragecomic');
//趣图频道
Route::get('/home/user/cuteimg','Home\User\UserController@cuteimg');
//文字频道
Route::get('/home/user/txt','Home\User\home@index');
Route::get('/home/user/txtx','Home\User\home@cs');
//搜索
Route::get('/home/user/nav/{search?}','Home\User\UserController@nav');
Route::get('/index/{show?}/{bodycolor?}','Home\User\UserController@sorts');

Route::post('/home/user/regist','Home\User\UserController@regist');
Route::post('/home/user/login','Home\User\UserController@login');
Route::get('/home/user/video/{id}','Admin\User\SortController@videoshow');
Route::get('/home/user/videoload/{id}','Admin\User\SortController@videoload');
Route::get('/home/user/video','Admin\User\SortController@video');
Route::get('/home/user/works_hot','Home\User\UserController@works_hot');//热门
Route::get('/home/user/works_up','Home\User\UserController@works_up');//最新


Route::group(['prefix'=>'home','middleware'=>'homelogin'],function(){
    Route::group(['prefix'=>'user','namespace'=>'Home\User'],function(){
        Route::get('/c-index', 'UserController@userindex');
        Route::get('/loginout','UserController@userloginout');
        Route::get('myzone','UserController@myzone');
        Route::get('/addgod','UserController@addgod');
        Route::get('addcomic','UserController@addcomic');
        Route::get('usercon','UserController@usercon');
        Route::post('ucnrename','UserController@ucnrename');
        Route::post('ucnrefile','UserController@ucnrefile');
        Route::get('addr/{upid?}','UserController@addrin');
        Route::post('userinfoup','UserController@infoup');
        Route::post('/email','UserController@inemail');
        Route::get('/verify/{confirmed_code}','UserController@emailConfirm');
        Route::post('/upphone','UserController@upphone');
        Route::post('/upcode','UserController@upcode');
        Route::get('/paper','UserController@paper');
        Route::post('/feedback','UserController@feedback');
//        Route::get('/upemail','UserController@upemail');
        Route::get('/addcomic','UserController@addcomic'); //添加暴漫和趣图（控制器->addcomic方法）
        Route::post('/addrage','UserController@addrage');  //添加的验证（控制器->addrage方法）
        Route::get('/trueadd','UserController@trueadd');  //添加成功后跳转到添加成功页面 (控制器->trueadd)
        Route::get('/addgod','UserController@addgod');  //添加神作的连载(控制器->addgod)
        Route::get('/addgod','UserController@addgod');  //个人中心->我的神作(控制器->mygod)//个人中心的分组
        Route::get('/mygod','UserController@mygod');//个人中心 我的神作
        Route::post('/publish','UserController@publish');  //添加连载至数据库
        Route::get('/bbgoddel/{id}','UserController@bbgoddel');  //删除神作->暴漫
        Route::get('/iigoddel/{id}','UserController@iigoddel');  //删除神作->趣图
 Route::get('/praise_bimg/{id}','UserController@praise_bimg');  //暴漫点赞
        Route::get('/praise_img/{id}','UserController@praise_img');  //趣图点赞
        Route::get('/rotten_bimg/{id}','UserController@rotten_bimg');  //暴漫差评
        Route::get('/rotten_img/{id}','UserController@rotten_img');  //趣图差评

        Route::post('/bimgtalk','UserController@bimgtalk');       //暴漫的评论模块
        Route::post('/loadbimgtalks','UserController@loadbimgtalks');       //加载暴漫的评论
        Route::post('/imgtalk','UserController@imgtalk');       //趣图的评论模块
        Route::post('/loadimgtalks','UserController@loadimgtalks');//载趣图的评论

        //个人信息评论区
        Route::get('/mytalks','UserController@mytalks');
        //个人信息 我的连载
        Route::get('/mypublish','UserController@mypublish');
        //访问他人空间
        Route::get('/youzone/{id}','YouController@enter');
        //收藏
        Route::post('/crop','YouCOntroller@crop');
        Route::get('/crops','YouController@crops');
        //cj
         //cj
        Route::post('wen','home@ajax');
        Route::get('wen/txt','home@latest');
        Route::get('txt/guan','home@guan');
        Route::get('txt/buguan','home@buguan');
        Route::get('txt/zan','home@zan');
        Route::get('txt/quzan','home@quzan');
        Route::get('txt/ding','home@ding');
        Route::get('txt/buding','home@buding');
        Route::get('txt/dinglod','home@dinglod');
        //订阅
        Route::get('txt/yue/{id}','home@yue');
        Route::get('txt/yue/guan','home@yueguan');
        Route::get('txt/yue/quguan','home@c');

        //暴漫
        Route::get('bao','home@baoindex');
        Route::get('bao/man','home@baoman');
        //全部作者
        Route::get('author','home@author');

    });
});
























