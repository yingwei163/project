@extends('bootmodel')
@section('head')
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/jquery-1.8.3.min.js"></script>
    <script>
        $(function(){
            $(window).scroll(function ()
            {
                if($(this).scrollTop() >= 162){
                    $('#topnav').addClass('navbar-fixed-top');
                    $("#navbar").animate({left: '-88px'}, "slow");
                    $('#top-ld').show();

                }else{
                    $('#topnav').removeClass('navbar-fixed-top');
                    $("#navbar").animate({left: '0px'}, "slow");
                    $("#navbar").stop();
                    $('#top-ld').hide();
                }
                $("#big").hover(
                    function () {
                        $('#big').animate({width:'300px'},150);
                    },
                    function () {
                        $('#big').animate({width:'288px'},150);
                    }
                );
                $(window).scroll(function (){

                    if($(this).scrollTop() >= 480){
                        $('#fallsleftc').addClass('fallsleftc');
                    }else{
                        $('#fallsleftc').removeClass('fallsleftc');
                    }
                })

            });
            $('#iad').click(function(){
                $('#addComic').slideToggle();
            });
            $('#c-left').click(function(){
                $('#addcontent').css('display','block');
                $('#addtxt').css('display','none');
                $('#left-t').html('漫画上传');
                $('#right-t').html('漫画制作');
                $('#content-t').html('【漫画】');
                $('#content-c').html('只要细心观察，生活到处是梗！没有画工也能当漫画大神！');
                $('#c-left').css({'border-bottom':'none','border-top':'3px solid #FFA700'});
                $('#c-center').css({'border-bottom':'','border-top':''});
                $('#c-right').css({'border-bottom':'','border-top':''});
            });
            $('#c-center').click(function(){
                $('#addcontent').css('display','block');
                $('#addtxt').css('display','none');
                $('#left-t').html('趣图上传');
                $('#right-t').html('趣图制作');
                $('#content-t').html('【趣图】');
                $('#content-c').html('脑残对话、神吐槽、暴走体、短信、图表、名言，只有你想不到的没有你做不到的！');
                $('#c-left').css({'border-bottom':'','border-top':''});
                $('#c-center').css({'border-bottom':'none','border-top':'3px solid #FFA700'});
                $('#c-right').css({'border-bottom':'','border-top':''});
            });
            $('#c-right').click(function(){
                $('#addcontent').css('display','none');
                $('#addtxt').css('display','block');
                $('#c-left').css({'border-bottom':'','border-top':''});
                $('#c-center').css({'border-bottom':'','border-top':''});
                $('#c-right').css({'border-bottom':'none','border-top':'3px solid #FFA700'});
            });
                $('#addcontent').css('display','block');
                $('#addtxt').css('display','none');
                $('#left-t').html('漫画上传');
                $('#right-t').html('漫画制作');
                $('#content-t').html('【漫画】');
                $('#content-c').html('只要细心观察，生活到处是梗！没有画工也能当漫画大神！');
                $('#c-left').css({'border-bottom':'none','border-top':'3px solid #FFA700'});
                $('#c-center').css({'border-bottom':'','border-top':''});
                $('#c-right').css({'border-bottom':'','border-top':''});
        })
    </script>
@endsection
@yield('heads')
@section('body')
<!--顶导-->
    <div class="container top-nav">
        <ul>
            <li><a href="">关于我们</a></li>
            <li><a href="">客户端</a></li>
            <li><a href="">日报</a></li>
            <li><a href="">周边</a></li>
            <li><a href="">游戏中心</a></li>
        </ul>
        <div  class="top-right">
            <a href="home/user/myzone"><div class="glyphicon glyphicon-user">用户名</div></a>
            <a href=""><div class="glyphicon glyphicon-envelope"></div></a>
        </div>
    </div>
<!--顶导-->
<!--顶图-->
<div class="top-img ">
    <div class=" top-img-l">
        <div  class="logo"><img src="/images/logo.png" alt="" ></div>
    </div>
</div>
<!--顶图-->
<!--中导航 JQ未添加-->
<nav id='topnav' class="navbar navbar-inverse mid-nav">
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
                {{--<div class="form-group">--}}
                    <input type="password" placeholder="举个栗子" id='mid-input' class="form-control ">
                {{--</div>--}}
                <button type="submit" class="btn btn-success " id="mid-btn">搜索</button>
            </form>

        </div>
        <div id='top-ld' class="top-right">
            <a href="home/user/myzone"><div class="glyphicon glyphicon-user">用户名</div></a>
            <a href=""><div class="glyphicon glyphicon-envelope"></div></a>
        </div><!--/.navbar-collapse -->
    </div>
</nav>
<!--中导航-->
@section('mid')
<!--中全部-->
<div  id="midden">
    <!-- 中导图 -->
    <div class="container mid-row">
    <div class="row">
        <div class="col-md-4 mid-img remain">
            <img id='big' src="/images/tit.jpg" alt="">
            <div class="mid-img-tit">
                <span><a href="" class="mid-img-font">【淫荡的一天又开始啦】 谁淫荡啊，谁...</a></span>
            </div>
        </div>
        <div class="col-md-4 mid-img">
            <img src="/images/tit.jpg" alt="">
            <div class="mid-img-tit">
                <span><a href="" class="mid-img-font">【淫荡的一天又开始啦】 谁淫荡啊，谁...</a></span>
            </div>
        </div>
        <div class="col-md-4 mid-img">
            <img src="/images/tit.jpg" alt="">
            <div class="mid-img-tit">
                <span><a href="" class="mid-img-font">【淫荡的一天又开始啦】 谁淫荡啊，谁...</a></span>
            </div>
        </div>
        <div class="col-md-4 mid-img">
            <img src="/images/tit.jpg" alt="">
            <div class="mid-img-tit">
                <span><a href="" class="mid-img-font">【淫荡的一天又开始啦】 谁淫荡啊，谁...</a></span>
            </div>
        </div>
    </div>
    </div>
    <!--中导图-->
    <div class="container">
        <img class='mid-img-ggt' src="/images/ggt.jpg" alt="">
    </div>
    <!--中瀑布-->
    <div id="falls" class="container">
        <div id="fallsleft" class="falls-left">
            <div id="fallsleftc">
            <img src="/images/home-wnm.gif" alt="" width="128" height="106">
            <ul>
                <li><a id="iad"><span class="glyphicon glyphicon-cog"></span>制作器</a></li>
                <li><a href=""><span class="glyphicon glyphicon-cog"></span>全部频道</a></li>
                <li><a href=""><span class="glyphicon glyphicon-cog"></span>全部作者</a></li>
                <li><a href=""><span class="glyphicon glyphicon-cog"></span>订阅频道</a></li>
                <li><a href=""><span class="glyphicon glyphicon-cog"></span>关注作者</a></li>
            </ul>
            </div>
        </div>
        <div class="falls-midden">
            {{--增加的添加素材模块           <<<<<<<<<<<<<<<<<<<<<--}}
            <div class="addComic" id="addComic">
                <div class="Comic-title clearfix">
                    <div class="Comic-left " id="c-left"><span class="glyphicon glyphicon-film"></span>暴漫</div>
                    <div class="Comic-center" id="c-center"><span class="glyphicon glyphicon-picture"></span>趣图</div>
                    <div class="Comic-right" id="c-right"><span class="glyphicon glyphicon-pencil"></span>文字</div>
                </div>

                <div class="addcontent" id="addcontent">
                    <div class="content-left">
                        <a href="/home/user/addcomic" class="left-title" id="left-t">漫画上传</a>
                        <a href="###" class="right-title" id="right-t">漫画制作</a>
                    </div>
                    <div class="content-right">
                        <p class="content-t" id="content-t">【漫画】</p>
                        <p class="content-c" id="content-c">只要细心观察，生活到处是梗！没有画工也能当漫画大神！</p>
                    </div>
                </div>
                <div class="addtxt" id="addtxt">
                <textarea class="conictxt" id="comictxt" cols="89" rows="4" placeholder="您的投稿经过审核才能发布，色情暴力、广告、政治相关的违规帖是不行的哦~"></textarea>
                 <div class="txt-bottom">
                   <span>频道：</span>
                   <select class="channel-c" id="channel-c">
                       <option value ="volvo">暴走漫画</option>
                       <option value ="saab">GIF怪兽</option>
                       <option value="opel">神吐槽</option>
                       <option value="audi">脑残对话</option>
                   </select>
                     <button type="button" class="btn btn-default cj-bu">发布</button>
                     <p class="cj-p">0/240</p>
                 </div>
                </div>
            </div>

            <div class="falls-midden-top">
            <div class="falls-hot"><a href="">热门<span class="glyphicon glyphicon-arrow-down"></span></a></div>
                <div class="falls-hott"><a href="">最新<span class="glyphicon glyphicon-arrow-down"></span></a></div>
                <div id="falls-mi-nav">
                    <form class="navbar-form navbar-right">
                        {{--<div class="form-group">--}}
                       频道检索: <input type="password" placeholder="请输入频道进行检索" id='mid-input' class="form-control ">
                        {{--</div>--}}
                        <button type="submit" class="btn btn-success " id="mid-btn">确定</button>
                    </form>
                </div>
            </div>
            <div class="falls-midden-mid">
                <div class="falls-midden-mid-tit">
                   <div class="tit-left"> <img src="/images/wnm.jpg" alt="..." class="img-circle" width="55" height="55"></div>
                    <div class="falls-midden-mid-tit-bt"><div class="tit-left">暴走大事件</div><div id="bzji"><span class="glyphicon glyphicon-blackboard"></span>暴走大事件第五季</div></div>
                    <div class="falls-midden-mid-tit-btt"><div class="tit-left jgz"><span class="glyphicon glyphicon-plus"></span>关注</div><div class="tit-right tit-time">4月7日 03时58分</div></div>
                </div>
                <div class="falls-midden-mid-con">
                    <div class="falls-con-tit">
                        <h4>大事件特别篇..</h4>
                        <div class="falls-con-img">
                            <img src="/images/mrbg.png" alt="">
                        </div>
                        <div>分享收藏</div>
                        <hr>
                        <div class="gdpl">更多评论</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="falls-right">
            <div class="falls-right-tit">
                <div class="tit-left channel">频道</div>
                <div class="tit-right"><a href="">推荐</a> | <a href="">最佳</a></div>
                <img src="/images/line.png" alt="" class="tit-line">
            </div>
            <div class="falls-right-channel">
                <div>数据库的频道</div>
            </div>

        </div>
    </div>
    <!--中瀑布-->


</div>
<!--中全部-->
@show
    <div id="footer" class="footmar">
    <div class="footmar-top">
        <dl>
            <dt>企业</dt>
            <dd>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
            </dd>
        </dl>
        <dl>
            <dt>企业</dt>
            <dd>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
            </dd>
        </dl>
        <dl>
            <dt>企业</dt>
            <dd>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
            </dd>
        </dl>
        <dl>
            <dt>企业</dt>
            <dd>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
                <a href="">关于我们</a> <a href="">关于我们</a><br>
            </dd>
        </dl>
        <dl>
            <dt>更多</dt>
            <dd id="bzzb">
                <a href="">暴走周边</a>
            </dd>
        </dl>
        <div class="bzmhapp">
            <p>暴走漫画app</p>
            <img src="/images/bzmh.gif" alt="">
        </div>
        <div class="bzrbapp">
            <p>暴走日报app</p>
            <img src="/images/bzrb.gif" alt="">
        </div>
    </div>
        <div class="footmar-bot container">
            <p>友情链接：计算机信息网络国际联网安全保护管理办法（公安部令第33号）</p>

            <p>商务合作：hezuo@baozou.com</p>

            <p>西安摩摩信息技术有限公司 沪ICP备14004983号-15</p>

            <p>Beianicon 陕公网安备 61019002000313号</p>

            <p>由达观数据提供部分技术支持</p>
        </div>
    </div>
@endsection