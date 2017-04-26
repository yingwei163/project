@extends('bootmodel')
@section('head')
    <link rel="stylesheet" href={{url("/css/index.css")}}>
    <link rel="stylesheet" href={{url("/css/y-index.css")}}>
    <script src={{url("/js/jquery-1.8.3.min.js")}}></script>
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
            $('.logintxt').click(function() {
                $('#bodyContent').show();
                $('#bodycolor').addClass('bodycolor');
                $('#bodycolor').click(function(){
                    $('#lname').html(null);
                    $('#lpwd').html(null);
                    $('#bodycolor').removeClass('bodycolor');
                    $('#bodyContent').hide();
                })
            });
            $('.registtxt').click(function() {
                $('#bodyContentr').show();
                $('#bodycolor').addClass('bodycolor');
                $('#codeup').attr('src','{{ url('/captcha') }}');
                $('#bodycolor').click(function(){
                    $('#nameer').html(null);
                    $('#emailer').html(null);
                    $('#pwder').html(null);
                    $('#repwder').html(null);
                    $('#coder').html(null);
                    $('form input').val(null);
                    $('#checkup').val(1);
                    $('#bodycolor').removeClass('bodycolor');
                    $('#bodyContentr').hide();
                })
            });

            $('#regist').click(function(){
                $('form').append('{{csrf_field()}}');
                $.ajax({
                    url:'{{url('/home/user/regist')}}',
                    type:'post',
                    data:$('#register').serialize(),
                    success:function(data){
                        location.href = "/index/show/bodycolor"
                    },
                    error:function(xhr){
                        document.write(xhr.responseText);
                        eval('var obj ='+xhr.responseText);
                        $('#nameer').html(obj['name']);
                        $('#emailer').html(obj['email']);
                        $('#pwder').html(obj['pwd']);
                        $('#repwder').html(obj['pwd_confirmation']);
                        $('#coder').html(obj['code']);
                        if (obj['save']){
                            alert(obj['save']);}
                    },
                    dataType:'json'
                });
            });
            $('#login').click(function(){
                $('form').append('{{csrf_field()}}');
                $.ajax({
                    url:'{{url('/home/user/login')}}',
                    type:'post',
                    data:$('#loginer').serialize(),
                    success:function(data){
                        location.href = "/index"

                    },
                    error:function(xhr){
                        document.write(xhr.responseText);
                        eval('var obj ='+xhr.responseText);
                        $('#luser').html(obj['name']);
                        $('#lpwd').html(obj['pwd']);
                    },
                    dataType:'json'
                });
            });

        })
    </script>
    {{-- 订阅特效--}}
    <script>
        $(document).ready(function() {
            $.ajax({

                url: '{{url('/home/user/txt/dinglod')}}',
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
                    document.write(xhr.responseText);
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
                    document.write(xhr.responseText);
                },
                dataType: 'json',
            });
        })
    </script>
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
                            url: '/home/user/txt/ding',
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
                            url: '/home/user/txt/buding',
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
                    exit;
                }

                switch ($a) {
                    case '关注':
                        $.ajax({
                            url: '/home/user/txt/ding',
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
                            url: '/home/user/txt/buding',
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
@endsection
@yield('heads')
@section('body')
@section('topdenv')
    <div id="bodyContent" class="container login" ><img src={{url("/images/dbz.png")}} alt="">
        <div class="sing">
            <div class="sing-left tit-left">
                <form action="" id="loginer">
                    用 户 名: <input name='name' type="text" class="singinput" placeholder="请输入用户名或邮箱" ><br>
                    <span id="luser" class="success"></span><br>
                    密 &nbsp;码 : <input name='pwd' type="password" class="singinput" placeholder="请输入密码" ><br>
                    <span id="lpwd" class="success"></span><br>

                </form><input id='login' type="submit" class="singbtn" value="登陆">
                &nbsp; &nbsp; &nbsp;&nbsp;其他方式登陆:<br>
                &nbsp; &nbsp; &nbsp;<img src={{url("/images/any.png")}} alt="" class="any">
                <img src={{url("/images/any.png")}} alt="" class="any">
                <img src={{url("/images/any.png")}} alt="" class="any">
                <img src={{url("/images/any.png")}} alt="" class="any">
            </div>
            <div class="sing-right tit-right">
                <div class="sing-right-top">
                    <p>用注册帐号登录后你可以发暴漫,还能跟其他小伙伴聊天发小纸条,有很多好处哦,关注你的偶像,亲~</p>
                    <img src={{url("/images/yao.png")}} alt="">
                </div>
                <div class="sing-right-bottom">
                    <p>什么?连暴漫帐号都没有?不怕吃亏?你TM在逗<br><a href="">立刻注册 ></a></p>
                    <img src={{url("/images/zdw.png")}} alt="">
                </div>
            </div>
        </div>
    </div>
    <div id="bodyContentr" class="container regist"><img src={{url("/images/dbz.png")}} alt="">
        <div class="sing">
            <div class="sing-re-left tit-left">
                <form id='register' action="" method="post">
                    {{csrf_field()}}
                    <span style="color:red">* </span>用 户 名: <input name="name" type="text" class="singinput" placeholder="请输入用户名" ><br>
                    <span id="nameer" class="success">
                    </span><br>
                    <span style="color:red">* </span>邮 &nbsp;箱 : <input name="email" type="email" class="singinput" placeholder="请输入邮箱" ><br>
                    <span id="emailer" class="success"></span><br>
                    <span style="color:red">* </span>设置密码: <input name="pwd" type="password" class="singinput" placeholder="请输入密码" ><br>
                    <span id="pwder" class="success"></span><br>
                    <span style="color:red">* </span>确认密码: <input name="pwd_confirmation" type="password" class="singinput" placeholder="请确认密码" ><br><span id="repwder" class="success"></span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="codeups" ><img id="codeup" src="{{ url('/captcha') }}" onclick="this.src='{{ url('/captcha') }}?r='+Math.random();" alt=""></span><br>
                    <span id="repwder" class="success"></span><br>
                    <span style="color:red">* </span>验 证 码: <input name="code" type="text" class="singinput" placeholder="请输入验证码" ><br>
                    <span id="coder" class="success"></span><br>
                    &nbsp; &nbsp;&nbsp;&nbsp;                               <input name="save" type="checkbox" id="checkup" checked value="1" >

                    <span class="success">我已阅读并接受《暴走漫画用户服务协议》</span><br>

                </form><input id='regist' type="submit" class="singbtn" value="注册">
                &nbsp; &nbsp; &nbsp;&nbsp;其他方式注册:<br>
                &nbsp; &nbsp; &nbsp;<img src={{url("/images/any.png")}} alt="" class="any">
                <img src={{url("/images/any.png")}} alt="" class="any">
                <img src={{url("/images/any.png")}} alt="" class="any">
                <img src={{url("/images/any.png")}} alt="" class="any">
            </div>
            <div class="sing-right tit-right">
                <div class="sing-right-top">
                    <p>用注册帐号登录后你可以发暴漫,还能跟其他小伙伴聊天发小纸条,有很多好处哦,关注你的偶像,亲~</p>
                    <img src={{url("/images/yao.png")}} alt="">
                </div>
                <div class="sing-right-bottom">
                    <p>什么?你有帐号还不赶快登录?不怕吃亏？你TM在逗我?<br><a href="">立刻登录 ></a></p>
                    <img src={{url("/images/zdw.png")}} alt="">
                </div>
            </div>
        </div>
    </div>
    <div id="bodycolor">


    </div>
    <!--顶导-->
    <div class="container top-nav">
        <ul>
            <li><a href={{url('/')}}>关于我们</a></li>
            <li><a href={{url('/')}}>客户端</a></li>
            <li><a href={{url('/')}}>日报</a></li>
            <li><a href={{url('/')}}>周边</a></li>
            <li><a href={{url('/')}}>游戏中心</a></li>
        </ul>
        <div  class="top-right">
            @if(Auth::check())
                <a href={{url("/home/user/c-index")}}><div  class="glyphicon glyphicon-user">{{Auth::user()->name}}</div></a>
                <a href={{url("/home/user/loginout")}}><div class="glyphicon ">注销</div></a>
            @else
                <a href="javascript:void(0)"><div  class="logintxt">登录</div></a>
                <a href="javascript:void(0)"><div class="registtxt">注册</div></a>
            @endif
        </div>
    </div>
    <!--顶导-->
    <!--顶图-->
    <div class="top-img ">
        <div class=" top-img-l">
            <div  class="logo"><img src={{url("/images/logo.png")}} alt="" ></div>
        </div>
    </div>
@show
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
            @foreach($sort as $k)

                <a id='mid-a' class="navbar-brand" href="{{url($k->url)}}">{{$k->name}}</a>

            @endforeach
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
            @if(Auth::check())
                <a href="/home/user/c-index"><div  class="glyphicon glyphicon-user">{{Auth::user()->name}}</div></a>
                <a href="/home/user/loginout"><div class="glyphicon ">注销</div></a>
            @else
                <a href="javascript:void(0)"><div  class="logintxt">登录</div></a>
                <a href="javascript:void(0)"><div class="registtxt">注册</div></a>
            @endif
        </div><!--/.navbar-collapse -->
    </div>
</nav>
<!--中导航-->
@section('mid')
    <!--中全部-->
    <!--中瀑布-->
    @foreach($advertsing as $k)

        <div id="subscription">

            <div id="subscriptiontitle"><h3>【{{$k->nama}}】</h3></div>
            <div id="subscription_ntroduce">
                <div id="subscription_img"><img src="{{url($k->img)}}" style="width: 130px;height: 100px" alt=""></div>
                <div id="subscription_txt">{{$k->ad}}</div>
            </div>
            <div id="ckepop">
                <span class="jiathis_txt">分享到：</span>
                <a class="jiathis_button_qzone">QQ空间</a>
                <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
                <a class="jiathis_counter_style"></a>
            </div>
            <script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>

        </div>
    @endforeach
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
                        <a href={{url("/home/user/addcomic")}} class="left-title" id="left-t">漫画上传</a>
                        <a href="{{url('###')}}" class="right-title" id="right-t">漫画制作</a>
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

                <div class="falls-hot"><a href="{{url('/')}}">热门<span class="glyphicon glyphicon-arrow-down"></span></a></div>
                <div class="falls-hott"><a href="{{url('/')}}">最新<span class="glyphicon glyphicon-arrow-down"></span></a></div>

                <div id="falls-mi-nav">
                    <form class="navbar-form navbar-right">
                        {{--<div class="form-group">--}}
                        频道检索: <input type="password" placeholder="请输入频道进行检索" id='mid-input' class="form-control ">
                        {{--</div>--}}
                        <button type="submit" class="btn btn-success " id="mid-btn">确定</button>
                    </form>

                </div>

            </div>

            @section('txt')
                @foreach($comment as $k)
                    <div class="falls-midden-mid" style="height: 230px">
                        <div class="falls-midden-mid-tit">
                            <div class="tit-left"> <img src="{{url($k->img)}}" alt="..." class="img-circle" width="55" height="55"></div>
                            <div class="falls-midden-mid-tit-bt"><div class="tit-left">{{$k->nama}}</div></div>
                            <form id="fgz">
                                <div class="falls-midden-mid-tit-btt">
                                    @if(empty(Auth::id()))<div class="tit-left jgz gz" ><span class="glyphicon glyphicon-plus gg" id="gg">关注</span></div>
                                    @elseif(Auth::id())<div id="lid{{$k->id}}" class="tit-left jgz gz" ><span class="glyphicon glyphicon-plus gg" id="gg{{$k->eid}}">关注</span></div>
                                    @else
                                        <div class="tit-left jgz gz" ><span class="glyphicon glyphicon-plus gg" id="gg">关注</span></div>@endif


                                    <input id='hj' type="text" name='zid' value="{{$k->eid}}"><input id='hj' type="text" value="{{$k->nama}}">

                                </div>
                            </form>
                        </div>
                        <div class="falls-midden-mid-con" style="height:200px">
                            <div class="falls-con-tit">

                                <div class="falls-con-img" id="details">
                                    <div style="font-size:10px">{{$k->txt}}</div>
                                </div>
                                <div class="eimg"><img src="{{url($k->eimg)}}" style="width: 100px;height: 100px" alt=""></div>

                                <hr>
                            </div>

                        </div>
                    </div>


                @endforeach
        </div>
        <div class="falls-right">
            <div class="falls-right-tit">
                <div class="tit-left channel">频道</div>
                <div class="tit-right"><a href="{{url('/')}}">推荐</a> | <a href="">最佳</a></div>
                <img src={{url("/images/line.png")}} alt="" class="tit-line">
            </div>
            <div class="falls-right-channel">
                @foreach($ad as $v)
                    <div class="sjk">
                        <div class="tsjk">
                            <div class="itp">
                                <img src={{url($v->img)}} class="tp">
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
@show
<div id="footer" class="footmar">
    <div class="footmar-top">
        <dl>

            <dt>友情链接</dt>
            <dd>
                @foreach($link as $k)
                    <a href="{{url($k->url)}}">{{$k->name}}</a> <br>

                @endforeach
            </dd>
        </dl>
        <dl>
            <dt>企业</dt>
            <dd>
                <a href={{url("/")}}>关于我们</a> <a href="">关于我们</a><br>
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