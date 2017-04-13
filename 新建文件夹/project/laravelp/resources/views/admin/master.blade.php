<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
     {{--自己补充的css--}}
    @yield('c_css')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
    <script src='/js/jquery-1.8.3.min.js'></script>
    <script >
        $(function(){
            $('.c_lo1').click(function(){
                $('.lo1').toggleClass('open');
            });
            $('.c_lo2').click(function(){
                $('.lo2').toggleClass('open');
            });
        });
    </script>

</head>
<body>
{{--导航条--}}
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">暴漫管理</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">首页 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">暴走漫画</a></li>
                <li class="dropdown lo1">
                    <a href="#" class="dropdown-toggle c_lo1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理列表 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">暴漫管理</a></li>
                        <li><a href="#">趣图管理</a></li>
                        <li><a href="#">视频管理</a></li>
                        <li><a href="#">文字管理</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">用户管理</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="搜索">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">用户名</a></li>
                <li class="dropdown lo2">
                    <a href="#" class="dropdown-toggle c_lo2" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">用户列表<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">个人中心</a></li>
                        <li><a href="#">我的处理</a></li>
                        <li><a href="#">我的评论</a></li>
                        <li><a href="#">我锁定用户</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">注销</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
{{--子模版占位--}}
@yield('content')


</body>
</html>