<<<<<<< HEAD
@extends('index')
=======
@extends('master')
>>>>>>> a834791b12e41dc0acf5b98e6d119d0ad9a2dae6
@section('heads')
    <link rel="stylesheet" href="/css/item_cj.css">
    <link rel="stylesheet" href="/css/item_index.css">

    @endsection
@section('mid')
<body class="body_cj ">
   <div class="header"></div>
   <div class="user_banner">
       <div class="protect_tag clearfix" style='background-image: url("{{asset('home/image/top_i.png')}}") '>
           <div class="circular">
               <img class="img-circle img-cj" src="{{asset('home/image/cj_1.jpg')}}" alt="zzz">
           </div>
           <div class="user_circular">
                <span class="userTitleName">zhengcj</span>
           </div>
       </div>
       <div class="relation clearfix">
           <a href="">关注(0)</a>
           <a href="">粉丝(0)</a>
           <input class="input_text" type="text" placeholder="说点什么吧...">
           <ul class="user_list">
               <li class="user_li">
                   <a href="">
                       <span>0</span>
                       <p>神作</p>
                   </a>
               </li>
               <li>
                   <a href="">
                       <span>0</span>
                       <p>尼玛币</p>
                   </a>
               </li>
               <li>
                   <a href="">
                       <span>0</span>
                       <p>总评论</p>
                   </a>
               </li>
               <li>
                   <a href="">
                       <span>0</span>
                       <p>总顶数</p>
                   </a>
               </li>
               <li>
                   <a href="">
                       <span>0</span>
                       <p>参与值</p>
                   </a>
               </li>
               <li>
                   <a href="">
                       <span>0</span>
                       <p>创意值</p>
                   </a>
               </li>
           </ul>
       </div>
   </div>
   <div class="wrapper-cj">
       <div class="wrapper-left">
          <ul class="wLeft-list  clearfix">
              <li>
                  <a href="###"><span class="glyphicon glyphicon-thumbs-up"></span> 我的神作</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-heart"></span> 关注神作</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-comment"></span> 评论</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-send"></span> 小纸条</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-user"></span> 关注/粉丝</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-star"></span> 我的收藏</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-refresh"></span> 订阅更新</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-cog"></span> 帐号设置</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-picture"></span> 表情组</a>
              </li>
          </ul>
       </div>
       <div class="wrapper-center">
           @section('add-god');
           <div class="user-nodata">
               <p class="user-flaunt">没有神作可炫耀了~</p>
           </div>
           @show
       </div>
       <div class="wrapper-right">
           <div class="user_channel">
               <h4>我的频道</h4>
               <div class="right-body">
                  <p>暂无频道</p>
               </div>
           </div>
           <div class="user_channel">
               <h4>我的连载</h4>
               <div class="right-body">
                   <p>暂无连载</p>
               </div>
               <div class="publish">
<<<<<<< HEAD
                   <a href="/home/user/addgod"><p><span class="glyphicon glyphicon-plus">创建连载</span></p></a>
=======
                   <a href="/addGod"><p><span class="glyphicon glyphicon-plus">创建连载</span></p></a>
>>>>>>> a834791b12e41dc0acf5b98e6d119d0ad9a2dae6
               </div>
           </div>
           <div class="user_channel">
               <h4>我的勋章</h4>
               <div class="right-body">
                   <p>暂无勋章</p>
               </div>
           </div>
           <div class="user_channel">
               <h4>最近来访</h4>
               <div class="right-body">
                   <p>被遗忘很久了o(╯□╰)o</p>
               </div>
           </div>
       </div>
   </div>
@endsection