@extends('bootmodel')
@section('head')
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/addcomic.css">
    <script src="/js/jquery-1.8.3.min.js"></script>
    <script>
    $(function() {
    $('#top-ld').show().css({'left':'475px'});
    $('#navbar').css('margin-right','200px');

    });
    </script>
    @yield('addjs')
    {{--图片预览功能--}}
    <script type="text/javascript" src="/js/jquery.uploadView.js"></script>
    <script>
        $(".js_upFile").uploadView({
            uploadBox: '.js_uploadBox',//设置上传框容器
            showBox : '.js_showBox',//设置显示预览图片的容器
            width :  680, //预览图片的宽度，单位px
            height : 850, //预览图片的高度，单位px
            allowType: ["gif", "jpeg", "jpg", "bmp", "png"], //允许上传图片的类型
            maxSize :2, //允许上传图片的最大尺寸，单位M
            success:function(e){
                $('.zon-file-p').slideToggle();
                alert('图片上传成功');
            }
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
    @if(count($errors)>0)
        <div class="alert alert-danger">
           <ul>
               @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
               @endforeach
           </ul>
        </div>
    @endif
<form action="/home/user/addrage" method="post" enctype="multipart/form-data">
{{csrf_field()}}
@section('header-xx')
  <p class="wrapper-h2 ">填写信息准备提交作品</p>
    <div class="works-wrapper">
        <strong>频道 (<b style="font-size:12px;">默认暴漫</b>):</strong>
        <select class="works-select" name="channel" id="channel" >
            <option value="1">暴漫</option>
            <option value="2">趣图</option>
        </select>
    </div>
@show
    <div class="wrapper-txt  js_uploadBox">
@section('file-xx')
        <div class="wrapper-title">
            {{--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<--}}
            <span style="color:red;">*</span><span >真相：</span><input name="content" class="txt-file js_upFile" id="txt-file" type="file" value="图片上传"><p>图片大小必须小于5M</p>
        </div>
@show
        <div class="wrapper-zone clearfix">
           <div class="zone-left js_showBox">
               @section('images')
               <img class="js_logoBox" src="" alt="">
               <p class="zone-file-p">请选择图片</p>
               @show
           </div>
      @section('zone-right')
           <div class="zone-right clearfix">
              <div class="zr-title">
                  <span style="color:red;float:left;line-height:25px;">*</span>
                  <p class="title-left">内容(必填) :</p>
                  <p class="title-right">0/240</p>
              </div>
              <textarea style="resize:none;" name="title" id="" cols="30" rows="10"></textarea>

               <div class="txt-button">
                  <input type="submit" id="c_input" class="btn btn-warning"  value="提交审核">
               </div>
           </div>
      @show
        </div>
    </div>
</div>
</form>
