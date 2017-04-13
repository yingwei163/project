@extends('bootmodel')
@section('head')
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/addcomic.css">
    <script src="/js/jquery-1.8.3.min.js"></script>
    <script>
        $(function() {
            $('#top-ld').show().css({'left':'475px'});
            $('#navbar').css('margin-right','200px')
        });
    </script>
@endsection
<nav id='topnav' class="navbar navbar-inverse navbar-fixed-top mid-nav">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id='mid-a1' class="navbar-brand" href="/">首页</a>
            <a id='mid-a' class="navbar-brand" href="#">暴漫</a>
            <a id='mid-a' class="navbar-brand" href="#">趣图</a>
            <a id='mid-a' class="navbar-brand" href="#">视频</a>
            <a id='mid-a' class="navbar-brand" href="#">文字</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-right">
                <div class="form-group">
                <input type="password" placeholder="举个栗子" id='mid-input' class="form-control ">
                </div>
                <button type="submit" class="btn btn-success " id="mid-btn">搜索</button>
            </form>
        </div>

        <div id='top-ld' class="top-right clearfix">
            @if(Auth::check())
                <a href="/home/user/c-index"><div  class="glyphicon glyphicon-user">{{Auth::user()->name}}</div></a>
                <a href="/home/user/logingout"><div class="glyphicon ">注销</div></a>
            @else
                <a href="javascript:void(0)"><div  class="logintxt">登录</div></a>
                <a href="javascript:void(0)"><div class="registtxt">注册</div></a>
            @endif
        </div><!--/.navbar-collapse -->
    </div>
</nav>
<div class="wrapper clearfix">
  <p class="wrapper-h2 ">填写信息准备提交作品</p>
    <div class="works-wrapper">
        <strong>频道 (可选):</strong>
        <select class="works-select" name="" id="" >
            <option value="0">请选择频道</option>
            <option value="1">暴漫</option>
            <option value="2">趣图</option>
        </select>
    </div>
    <div class="wrapper-txt">
        <div class="wrapper-title">
            <span style="color:red;">*</span><span >真相：</span><input class="txt-file" type="file" value="选择图片"><p>图片大小必须小于5</p>
        </div>
        <div class="wrapper-zone">
           <div class="zone-left">
               <p>请选择图片</p>
           </div>
           <div class="zone-right clearfix">
              <div class="zr-title">
                  <span style="color:red;float:left;line-height:25px;">*</span>
                  <p class="title-left">内容(必填) :</p>
                  <p class="title-right">0/240</p>
              </div>
              <textarea  name="" id="" cols="30" rows="10"></textarea>
               <div class="zr-title">
                   <p class="title-left">标签(可选) :</p>
               </div>
               <input type="text" name="">
               <div class="txt-button">
                  <button type="button" class="btn btn-warning" >提交审核</button>
               </div>
           </div>
        </div>
    </div>
</div>