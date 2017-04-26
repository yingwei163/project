@extends('master')

@section('heads')
    <link rel="stylesheet" href={{url("/css/y-index.css")}}>
    <link rel="stylesheet" href={{url("/css/index.css")}}>
    <link rel="stylesheet" href="{{url('/css/mygod.css')}}">
    <script src="{{url('/js/jquery-1.8.3.min.js')}}"></script>
    <script>
        {{--关注加载事件--}}
        $(document).ready(function() {
            $.ajax({

                url: '{{url('/home/user/txt/lod')}}',
                type: 'get',
                success: function (data) {
                    for ($i = 0; $i < data.length; $i++) {
                        $('#gg' + data[$i]).text('不关注');
                        $('#lid' + data[$i]).addClass('jgzz');
                        $('#lid' + data[$i]).removeClass('jgz');
                        $('#gg' + data[$i]).removeClass('glyphicon glyphicon-plus')
                    }
                },
                error: function (xhr) {
//                    document.write(xhr.responseText);
                },
                dataType: 'json',
            })

            $.ajax({
                url: '{{url('/home/user/txt/dinglod')}}',
                type: 'get',
                success: function (data) {
                    for($i=0;$i<data.length;$i++){
                        $('#dy'+data[$i]).text('不订阅');
                        $('#dyid'+data[$i]).addClass('jgzz');
                        $('#dyid'+data[$i]).removeClass('jgz');
                        $('#dy'+data[$i]).removeClass('glyphicon glyphicon-plus')
                    }
                },
                error: function (xhr) {
//                    document.write(xhr.responseText);
                },
                dataType: 'json',
            });
        })
    </script>
    <script>
      $(function(){
           $('#fabu').click(function () {
//                //得到发帖内容
                var $a=$('#comictxt').val();
                //得到标签
                $b=$("select option:selected").text();
               var $c=$('#user').text();
                          if($c=='登录')
                          {
                              $('form').on('submit', function (event) {
                                  event.preventDefault();
                              });
                              alert('请登录');
                          }
               if($b=='暴走漫画' || $b=='GIF怪兽')
               {
                   $('form').on('submit', function (event) {
                       event.preventDefault();
                   });
                   alert('类型请选择:神吐槽或者脑残对话');
               }
            })
        })
    </script>
    {{-- 点赞特效有待更新--}}

    <script>
        $(function () {

            $('.praise').one('click',function () {
                var $b=$(this).prev().text();
                alert($b);
                var $d=$(this).prev().prev().text();
                var $c=$('#user').text();
                if($c=='登录'){
                    alert('请先登录');
                    exit;
                }
                $.ajax({
                    url: '{{url('/home/user/txt/zan')}}',
                    type: 'get',
                    //data:{'username':'rose','age':'20'},
                    data: {'zid': $b},
                    success: function (data) {
                        var $yh='#yh'+data.yh;
                    $($yh).text(data.zs);

                        var $zh='#zh';
                            var $zz=$zh+data.uh;
                        $($zz).text(data.as);
                    },
                    error: function () {
                             alert('失败');
                    },
                    dataType: 'json',
                });

            });

        })
    </script>
     {{--差评赞特效有待更新--}}
    <script>

$(function(){
    $('.notpraise').one('click',function(){
        var $c=$('#user').text();
        if($c=='登录'){
            alert('请先登录');
            exit;

        }
        var $b=$(this).prev().prev().text();
        $.ajax({
            url: '{{url('/home/user/txt/quzan')}}',
            type: 'get',
            data: {'zid': $b},
            success: function (data) {
                var $zh='#zh'+data.yh;
                $($zh).text(data.zs);

                var $yh='#yh'+data.uh;
                $($yh).text(data.as);
            },
            error: function () {
                alert('失败');
            },
            dataType: 'json',
        });
    })
})
    </script>
    <script>
        {{-- 关注特效--}}
      $(function () {
            $('.gz').click(function(){
                var $a=$(this).text();
                alert($a);
               var $b=$(this).next().val();
                var $d=$(this).next().next().val();
                var $c=$('#user').text();
               if($c=='登录'){
                   alert('请先登录');
               }
               if($c==$d){
                   alert('你不能关注自己');
                   exit;
               }
                switch ($a) {
                    case '关注':
                        $.ajax({
                            url: '{{url('/home/user/txt/guan')}}',
                            type: 'get',
                            data: {'zid': $b},
                            success: function (data) {
                                alert('关注成功');
                            },
                            error: function () {
                                alert('失败');
                            },
                            dataType: 'json',
                        });


                            $(this).removeClass('glyphicon glyphicon-plus');
                            $(this).removeClass('jgz');
                            $(this).addClass('jgzz');
                            $(this).text('不关注');



                        break;
                    case '不关注':
                        $(this).addClass('glyphicon glyphicon-plus');
                        $(this).removeClass('jgzz');
                        $(this).addClass('jgz');
                        $(this).text('关注');
                        $.ajax({
                            url: '{{url('/home/user/txt/buguan')}}',
                            type: 'get',
                            data: {'zid': $b},
                            success: function (data) {
                                    alert('取消关注成功');
                            },
                            error: function () {
                                alert('失败');
                            },
                            dataType: 'json',
                        });
                        break;
                }
            })
        })
    </script>

    {{-- 订阅特效--}}
    <script>
    $(function () {
    $('.dy').click(function(){

    var $a=$(this).text();

    var $b=$(this).next().val();

    var $c=$('#user').text();
    if($c=='登录'){
    alert('请先登录');
    exit;
    }
        $(this).removeClass('glyphicon glyphicon-plus');
        $(this).removeClass('jgz');
        $(this).addClass('jgzz');
        $(this).text('不订阅');
    switch ($a) {
    case '订阅':

    $.ajax({
    url: '{{url('/home/user/txt/ding')}}',
    type: 'get',
    data: {'zid': $b},
    success: function (data) {
    alert('订阅成功');
    },
    error: function (xhr) {
        document.write(xhr.responseText);
    alert('失败');
    },
    dataType: 'json',
    });

    break;
    case '不订阅':
    $(this).addClass('glyphicon glyphicon-plus');
    $(this).removeClass('jgzz');
    $(this).addClass('jgz');
    $(this).text('订阅');
    $.ajax({
    url: '{{url('/home/user/txt/buding')}}',
    type: 'get',
    data: {'zid': $b},
    success: function (data) {
    alert('取消订阅成功');
    },
    error: function () {
    alert('失败');
    },
    dataType: 'json',
    });
    break;
    }
    })
    })
    </script>
@section('body')

    <!--顶导-->
    <div class="container top-nav">
        <ul>
            <li><a href="{{url('/')}}">关于我们</a></li>
            <li><a href="{{url('/')}}">客户端</a></li>
            <li><a href="{{url('/')}}">日报</a></li>
            <li><a href="{{url('/')}}">周边</a></li>
            <li><a href="{{url('/')}}">游戏中心</a></li>

        </ul>
        <div  class="top-right">
            @if(Auth::check())
                <a href={{url("/home/user/c-index")}}><div  class="glyphicon glyphicon-user" id="user">{{Auth::user()->name}}</div></a>
                <a href={{url("/home/user/loginout")}}><div class="glyphicon ">注销</div></a>
            @else
                <a href={{url("javascript:void(0)")}}><div  class="logintxt" id="user">登录</div></a>
                <a href={{url("javascript:void(0)")}}><div class="registtxt">注册</div></a>
            @endif
        </div>
    </div>
    <!--顶导-->
    <!--顶图-->
    <div class="top-img ">
        <div class=" top-img-2">
            <div  class="logo"><img src={{url("/images/logo.png")}} alt="" ></div>
        </div>
    </div>
    <!--顶图-->
    <!--中导航 JQ未添加-->
    <nav id='topnav' class="navbar navbar-inverse mid-nav" style="margin-bottom: 20px;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @foreach($sort as $k)

                    <a id='mid-a' class="navbar-brand" href="{{url($k->url)}}">{{$k->name}}</a>

                @endforeach
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <form class="navbar-form navbar-right" action="{{url('/home/user/nav')}}">
                    {{--<div class="form-group">--}}
                    <input name='search' type="text" placeholder="举个栗子" id='mid-input' class="form-control ">
                    {{--</div>--}}
                    <button type="submit" class="btn btn-success " id="mid-btn">搜索</button>
                </form>

            </div>
            <div id='top-ld' class="top-right">
                @if(Auth::check())
                    <a href={{url("/home/user/c-index")}}><div  class="glyphicon glyphicon-user">{{Auth::user()->name}}</div></a>
                    <a href={{url("/home/user/loginout")}}><div class="glyphicon ">注销</div></a>
                @else
                    <a href={{url("javascript:void(0)")}}><div  class="logintxt">登录</div></a>
                    <a href={{url("javascript:void(0)")}}><div class="registtxt">注册</div></a>
                @endif
            </div><!--/.navbar-collapse -->
        </div>
    </nav>
    <!--中导航-->
@section('mid')


        <!--中瀑布-->
        <div id="falls" class="container">
            <div id="fallsleft" class="falls-left">
                <div id="fallsleftc">
                    <img src={{url("/images/home-wnm.gif")}} alt="" width="128" height="106">
                    <ul>
                        <li><a id="iad"><span class="glyphicon glyphicon-cog"></span>制作器</a></li>
                        @foreach($zzq as $s)
                            <li><a href="{{url($s->url)}}"><span class="glyphicon glyphicon-cog"></span>{{$s->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="falls-midden" style="height: auto">
                {{--增加的添加素材模块           <<<<<<<<<<<<<<<<<<<<<--}}
                <div class="addComic" id="addComic">
                    <div class="Comic-title clearfix">
                        <div class="Comic-left " id="c-left"><span class="glyphicon glyphicon-film"></span>暴漫</div>
                        <div class="Comic-center" id="c-center"><span class="glyphicon glyphicon-picture"></span>趣图</div>
                        <div class="Comic-right" id="c-right"><span class="glyphicon glyphicon-pencil"></span>文字</div>
                    </div>

                    <div class="addcontent" id="addcontent">
                        <div class="content-left">
                            <a href={{url("/addcomic" )}}class="left-title" id="left-t">漫画上传</a>
                            <a href={{url("###")}} class="right-title" id="right-t">漫画制作</a>
                        </div>
                        <div class="content-right">
                            <p class="content-t" id="content-t">【漫画】</p>
                            <p class="content-c" id="content-c">只要细心观察，生活到处是梗！没有画工也能当漫画大神！</p>
                        </div>
                    </div>
                    <div class="addtxt" id="addtxt">
                        <form action='{{url('home/user/wen')}}' method="post">
                            {{csrf_field()}}
                        <textarea name='nr' class="conictxt" id="comictxt" cols="89" rows="4" placeholder="您的投稿经过审核才能发布，色情暴力、广告、政治相关的违规帖是不行的哦~"></textarea>

                        <div class="txt-bottom">
                            <span>频道：</span>
                            <select class="channel-c" id="channel-c" name="pd">
                                <option value ="volvo">暴走漫画</option>
                                <option value ="saab">GIF怪兽</option>
                                <option value="opel">神吐槽</option>
                                <option value="audi">脑残对话</option>
                            </select>
                        </form>
                            <button type="submit" id='fabu' class="btn btn-default cj-bu">发布</button>

                        </div>
                    </div>
                </div>

                <div class="falls-midden-top">
                    <div id="falls-mi-nav">
                        <form class="navbar-form navbar-right">
                            {{--<div class="form-group">--}}
                            频道检索: <input type="password" placeholder="请输入频道进行检索" id='mid-input' class="form-control ">
                            {{--</div>--}}
                            <button type="submit" class="btn btn-success " id="mid-btn">确定</button>
                        </form>
                    </div>
                </div>
            @foreach($comment as $k)
                {{--<div class="falls-midden-mid" style="height: 230px">--}}
                    {{--<div class="falls-midden-mid-tit">--}}
                        {{--<div class="tit-left"> <img src={{url($k->icon)}} alt="..." class="img-circle" width="55" height="55"></div>--}}
                        {{--<div class="falls-midden-mid-tit-bt"><div class="tit-left">{{$k->name}}</div><div id="bzji"><span class="glyphicon glyphicon-blackboard"></span>{{$k->txtb}}</div></div>--}}
                        {{--<form id="fgz">--}}
                        {{--<div class="falls-midden-mid-tit-btt">--}}
                            {{--@if(empty(Auth::id()))<div class="tit-left jgz gz" ><span class="glyphicon glyphicon-plus gg" id="gg" style="cursor: pointer;">关注</span></div>--}}
                            {{--@elseif(Auth::id())<div id="lid{{$k->userid}}" class="tit-left jgz gz" ><span class="glyphicon glyphicon-plus gg" id="gg{{$k->userid}}" style="cursor: pointer;">关注</span></div>--}}
                            {{--@else--}}
                                {{--<div class="tit-left jgz gz " ><span class="glyphicon glyphicon-plus gg" id="gg" style="cursor: pointer;">关注</span></div>@endif--}}


                                {{--<input id='hj' type="text" name='zid' value="{{$k->userid}}"><input id='hj' type="text" value="{{$k->name}}">--}}
                        {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="ganlist" id="txt" style="border: 1px solid #e0e0e0;height: 250px;margin-bottom: 10px;">
                    <div class="gantop">
                        <div class="topc-left">
                            <img class="img-circle" src="{{$k->icon}}" alt="zzz">
                        </div>
                        <div class="topc-center">
                            <span class="center-ll">{{$k->name}}</span>
                            @if(empty(Auth::id()))<div class="tit-left jgz gz" ><span class="glyphicon glyphicon-plus gg" id="gg" style="cursor: pointer;">关注</span></div>
                            @elseif(Auth::id())<div id="lid{{$k->userid}}" class="tit-left jgz gz" ><span class="glyphicon glyphicon-plus gg" id="gg{{$k->userid}}" style="cursor: pointer;">关注</span></div>
                            @else
                            <div class="tit-left jgz gz " ><span class="glyphicon glyphicon-plus gg" id="gg" style="cursor: pointer;">关注</span></div>@endif
                            <input id='hj' type="text" name='zid' value="{{$k->userid}}"><input id='hj' type="text" value="{{$k->name}}">
                        </div>
                        <div class="topc-right clearfix">
                            <div class="install clearfix">
                                <div class="inleft">aaa</div>
                                <lu id="inright" class="inright user0">文本 </lu>

                            </div>
                        </div>
                    </div>
                    <div class="topc-bottom">
                        <p class="topc-title"> {{$k->txtb}}</p>
                        <div class="pcimg" style="font-size: 10px;">{{$k->txtx}}</div>
                    </div>
                    <div class="reviewed">
                        <ul class="pull-left">
                            <li>
                                <a href="###"><i class="glyphicon glyphicon-globe"></i>分享</a>
                                <span><i class="glyphicon glyphicon-star"></i>收藏</span>
                            </li>
                        </ul>

                    </div>

                </div>
            @endforeach



            </div>

            <div class="falls-right">
                <div class="falls-right-tit">
                    <div class="tit-left channel">频道</div>
                    <div class="tit-right"><a href="{{url('/')}}">推荐</a> | <a href="{{url('/')}}">最佳</a></div>
                    <img src={{url("/images/line.png")}} alt="" class="tit-line">
                </div>
                <div class="falls-right-channel">
                    @foreach($ad as $v)
                    <div class="sjk">
                        <div class="tsjk">
                            <div class="itp">
                            <img src={{url("$v->img")}} class="tp">
                            </div>
                            <div class="itt">
                                <div class="ttt" id="txt"><a href="{{url('home/user/txt/yue/').'/'.$v->id}}">{{$v->nama}}</a></div>
                                <div class="tttt" id="txtt">{{$v->body}}</div>
                            </div>
                        </div>
                        <div id="rgz">
                            <form class="dd">
                            <div class="tit-left dy jgz" id="dyid{{$v->id}}"><span class="glyphicon glyphicon-plus" id="dy{{$v->id}}" style="cursor: pointer;">订阅</span></div><input  type="hidden" name='zid' value="{{$v->id}}" style="color:black">
                            </form>
                        </div>

                    </div>
                    @endforeach
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
                <a href="{{url('/')}}">暴走周边</a>
            </dd>
        </dl>
        <div class="bzmhapp">
            <p>暴走漫画app</p>
            <img src={{url("/images/bzmh.gif")}} alt="">
        </div>
        <div class="bzrbapp">
            <p>暴走日报app</p>
            <img src={{url("/images/bzrb.gif")}} alt="">
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











@endsection
