@extends('bootmodel')
@section('head')
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/y-index.css">
    <link rel="stylesheet" href="/css/mygod.css">
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
                    if ($(document).width()>1480){
                        $('#fallsleftc').removeClass('fallsleftc');
                    }else if($(this).scrollTop() >= 480 ){
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
            $('#bodycolor').click(function(){
                window.location.replace("{{url('/')}}");
            })
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
                        if(data==0){
                            location.href = "{{url('/index/show/bodycolor')}}";
                        }else{
                            location.href ="{{url('/')}}";
                        }

                    },
                    error:function(xhr){
                        eval('var obj ='+xhr.responseText);
                        $('#luser').html(obj['name']);
                        $('#lpwd').html(obj['pwd']);
                    },
                    dataType:'json'
                });
            });
            $('.inright').click(function(){
                $(this).children().slideToggle(1);
            });
            $('.pcimg').each(function(index){       //$('.pcimg')代表是所有图片集  each相当与对集合遍历
                $wd=$(this).width();$wh=$(this).height();
                if($wd>$wh){
                    $gd=498;
                    $gh=$wh/$wd*498;
                    $(this).width($gd);
                    $(this).height($gh);
                }else{
                    $gh=498;
                    $gd=$wd/$wh*498;
                    $(this).width($gd);
                    $(this).height($gh);
                }
            });
            $('.topc-left>img').each(function(index){       //设置头像50px-50px
                $wd=$(this).width();$wh=$(this).height();
                $(this).width(50);
                $(this).height(50);
            });


            //点击弹出更多评论
            $('.message-header>p').click(function(){
                if($(this).html()=='更多评论<i class="glyphicon glyphicon-menu-down"></i>'){
                    $(this).html('收起评论<i class="glyphicon glyphicon-menu-up"></i>');
                }else{
                    $(this).html('更多评论<i class="glyphicon glyphicon-menu-down"></i>');
                }
                $(this).parent().next().slideToggle('hast');
            });
//          点击弹出更多评论
            $('.message').each(function(index){
                $(this).on('click',function(){
                    if($(this).parent().parent().parent().next().children().html()=='更多评论<i class="glyphicon glyphicon-menu-down"></i>'){
                        $(this).parent().parent().parent().next().children().html('收起评论<i class="glyphicon glyphicon-menu-up"></i>');
                    }else{
                        $(this).parent().parent().parent().next().children().html('更多评论<i class="glyphicon glyphicon-menu-down"></i>');
                    }
                    $(this).parent().parent().parent().next().next().slideToggle('hast');
//                    弹出评论区
                    //获取作品id
                    $works_id=$(this).prev().prev().prev().val();
                    //获取作品类型
                    $type=$(this).prev().prev().prev().attr("class");
                    //获取地址
                    $add=$(this).parent().parent().parent().next().next().children('.cj_button');
                    $bool=$add.next().attr('class'); //设置好评论区
                    if($bool){    //判断是否存在评论区【存在】点击代表收起评论区【不存在】就遍历
                        $bool.remove();
                    }else{
                        if($type=='bimg'){
                            $.ajax({
                                url:'/home/user/loadbimgtalks',
                                type:'post',
                                data:{'works_id':$works_id,'_token':'{{csrf_token()}}' },
                                success:function(data){
                                    if(data!=0){  //判断是否有数据
                                        for($i=0;$i<data.length;$i++){
                                            //评论区
                                            console.log(data);
                                            $talks="<div class='cj_talks'><div class='cj_content'><div class='cj_conleft'><img style='width:60px;height:60px;' src='"+data[$i][0]['icon']+"' alt='zzz'></div> <div class='cj_conright'> <div class='user_name'>"+data[$i][1]['name']+"</div> <div class='user_bb'>"+data[$i]['talk_txt']+"</div> <div class='date_xx'> <div class='date_l'>"+data[$i]['created_at']+"</div> <div class='date_r'> <span class='parise'><i class='glyphicon glyphicon-thumbs-up'></i><span>1</span></span> <span class='solid'><i class='glyphicon glyphicon-thumbs-down'></i><span>2</span></span> <span class='message'><i class='glyphicon glyphicon-comment'></i><span>3</span></span> </div> </div> </div> </div> </div>";
                                            $add.after($talks);
                                        }
                                    }

                                },
                                error:function(){
                                    alert('评论不见了！');
                                },
                            });
                        }else{
                            $.ajax({
                                url:'/home/user/loadimgtalks',
                                type:'post',
                                data:{'works_id':$works_id,'_token':'{{csrf_token()}}' },
                                success:function(data){
                                    if(data!=0){  //判断是否有数据
                                        for($i=0;$i<data.length;$i++){
                                            //评论区
                                            $talks="<div class='cj_talks'><div class='cj_content'><div class='cj_conleft'><img style='width:60px;height:60px;' src='"+data[$i][0]['icon']+"' alt='zzz'></div> <div class='cj_conright'> <div class='user_name'>"+data[$i][1]['name']+"</div> <div class='user_bb'>"+data[$i]['talk_txt']+"</div> <div class='date_xx'> <div class='date_l'>"+data[$i]['created_at']+"</div> <div class='date_r'> <span class='parise'><i class='glyphicon glyphicon-thumbs-up'></i><span>1</span></span> <span class='solid'><i class='glyphicon glyphicon-thumbs-down'></i><span>2</span></span> <span class='message'><i class='glyphicon glyphicon-comment'></i><span>3</span></span> </div> </div> </div> </div> </div>";
                                            $add.after($talks);
                                        }
                                    }

                                },
                                error:function(){
                                    alert('评论不见了！');
                                },
                            });
                        }
                    }


                })
            });
//         【暴漫】作品删除操作
            $('.bimg-inlif').click(function(){
                $works_id=($(this).prev().val());
                $.ajax({
                    url:'/home/user/bbgoddel/'+$works_id,
                    type:'get',
                    success:function(data){
                        if(data==1){
                            if($('.ganlist').size()==1){
                                $nodata="<div class='user-nodata'><p class='user-flaunt'>没有神作可炫耀了~</p></div>";
                                $('#bimg'+$works_id).after($nodata);
                            }
                            $jia=($('#li_clan>span').html());
                            $('#li_clan>span').html(Number($jia)-1);
                            $('#bimg'+$works_id).slideUp('slow').removeClass('ganlist');
                        }else{
                            alert('失败！');
                        }
                    },
                    error:function(){
                        alert('冒失删除失败了!');
                    },

                })
            });
//         【趣图】作品删除操作
            $('.img-inlif').click(function(){
                $works_id=($(this).prev().val());
                $.ajax({
                    url:'/home/user/iigoddel/'+$works_id,
                    type:'get',
                    success:function(data){
                        if(data==1){
                            if($('.ganlist').size()==1){
                                $nodata="<div class='user-nodata'><p class='user-flaunt'>没有神作可炫耀了~</p></div>";
                                $('#bimg'+$works_id).after($nodata);
                            }
                            $jia=($('#li_clan>span').html());
                            $('#li_clan>span').html(Number($jia)-1);
                            $('#img'+$works_id).slideUp('slow').removeClass('ganlist');
                        }else{
                            alert('失败！');
                        }
                    },
                    error:function(){
                        alert('冒失删除失败了!');
                    },

                })

            });
            //暴漫和趣图的ajax更改点赞
            $('.parise').each(function(index){
                $(this).on('click',function(){
                    $cj=$(this).children('span');
                    $type=($(this).prev().attr('class'));
                    $works_id=($(this).prev().val());
                    if($type=='bimg'){
                        $.ajax({
                            url:'/home/user/praise_bimg/'+$works_id,
                            type:'get',
                            success:function(data){
                                if(data==1){
                                    $num=Number($cj.html())+1;
                                    $cj.html($num);
                                }else if(data==9){
                                    alert('只可评价一次');
                                }else{
                                    alert('点过赞！');
                                }
                            },
                            error:function(){
                                alert('点赞飞了!');
                            },

                        })
                    }else{
                        $.ajax({
                            url:'/home/user/praise_img/'+$works_id,
                            type:'get',
                            success:function(data){
                                console.log(data);
                                if(data==1){
                                    $num=Number($cj.html())+1;
                                    $cj.html($num);
                                }else if(data==9){
                                    alert('只可评价一次');
                                }else{
                                    alert('点过赞！');
                                }
                            },
                            error:function(){
                                alert('点赞飞了!');
                            },

                        })
                    }

                })
            });
            //暴漫和趣图的ajax更改差评
            $('.solid').each(function(index){
                $(this).on('click',function(){
                    $cj=$(this).children('span');
                    $type=($(this).prev().prev().attr('class'));
                    $works_id=($(this).prev().prev().val());
                    if($type=='bimg'){
                        $.ajax({
                            url:'/home/user/rotten_bimg/'+$works_id,
                            type:'get',
                            success:function(data){
                                if(data==1){
                                    $num=Number($cj.html())+1;
                                    $cj.html($num);
                                }else if(data==9){
                                    alert('只可评价一次');
                                }else{
                                    alert('给过差评！');
                                }
                            },
                            error:function(){
                                alert('差评飞了!');
                            },

                        })
                    }else{
                        $.ajax({
                            url:'/home/user/rotten_img/'+$works_id,
                            type:'get',
                            success:function(data){
                                console.log(data);
                                if(data==1){
                                    $num=Number($cj.html())+1;
                                    $cj.html($num);
                                }else if(data==9){
                                    alert('只可评价一次');
                                }else{
                                    alert('点过赞！');
                                }
                            },
                            error:function(){
                                alert('点赞飞了!');
                            },

                        })
                    }

                })
            });
            //暴漫评论
            $('.cj_butt').each(function(){
                $(this).on('click',function(){
                    $works_id=($(this).prev().val());
                    $type=$(this).prev().attr("class");  //判断是【暴漫评论】还是【趣图评论】
                    $datas=$(this).parent().parent().prev().children().val();
                    $content=$(this).parent().parent();
                    if($type=='bimg'){
                        //暴漫的评论
                        $.ajax({
                            url:'/home/user/bimgtalk',
                            type:'post',
                            data:{'works_id':$works_id,'talktxt':$datas,'_token':'{{csrf_token()}}' },
                            success:function(data){
                                if(data!=0){
                                    alert('评论成功!');
                                    console.log(data);
                                    $talks="<div class='cj_talks'><div class='cj_content'><div class='cj_conleft'><img style='width:60px;height:60px;' src='"+data['icon']+"' alt='zzz'></div> <div class='cj_conright'> <div class='user_name'>"+data['name']+"</div> <div class='user_bb'>"+data['talk_txt']+"</div> <div class='date_xx'> <div class='date_l'>"+data['created_at']['date']+"</div> <div class='date_r'> <span class='parise'><i class='glyphicon glyphicon-thumbs-up'></i><span>1</span></span> <span class='solid'><i class='glyphicon glyphicon-thumbs-down'></i><span>2</span></span> <span class='message'><i class='glyphicon glyphicon-comment'></i><span>3</span></span> </div> </div> </div> </div> </div>";
                                    $content.after($talks);
                                }else{
                                    alert('已评论!');
                                }
                            },
                            error:function(){
                                alert('评论飞到外太空了!');
                            },

                        });
                    }else{
                        //趣图的评论
                        $.ajax({
                            url:'/home/user/imgtalk',
                            type:'post',
                            data:{'works_id':$works_id,'talktxt':$datas,'_token':'{{csrf_token()}}' },
                            success:function(data){
                                if(data!=0){
                                    alert('评论成功!');
                                    $talks="<div class='cj_talks'><div class='cj_content'><div class='cj_conleft'><img style='width:60px;height:60px;' src='"+data['icon']+"' alt='zzz'></div> <div class='cj_conright'> <div class='user_name'>"+data['name']+"</div> <div class='user_bb'>"+data['talk_txt']+"</div> <div class='date_xx'> <div class='date_l'>"+data['created_at']['date']+"</div> <div class='date_r'> <span class='parise'><i class='glyphicon glyphicon-thumbs-up'></i><span>1</span></span> <span class='solid'><i class='glyphicon glyphicon-thumbs-down'></i><span>2</span></span> <span class='message'><i class='glyphicon glyphicon-comment'></i><span>3</span></span> </div> </div> </div> </div> </div>";
                                    $content.after($talks);
                                }else{
                                    alert('已评论!');
                                }
                            },
                            error:function(){
                                alert('评论飞到外太空了!');
                            },

                        });
                    }
//                    ------
                });
            });
        })
    </script>
@endsection
@yield('heads')
@section('body')
    <!--顶导-->
    <div class="container top-nav">
        <div class="top-left">
            <ul >
                <li><a href="">关于我们</a></li>
                <li><a href="">客户端</a></li>
                <li><a href="">日报</a></li>
                <li><a href="">周边</a></li>
                <li><a href="">游戏中心</a></li>
            </ul></div>
        <div  class="top-right">
            @if(Auth::check())
                <a href="{{url('/home/user/c-index')}}"><div  class="glyphicon glyphicon-user">{{Auth::user()->name}}</div></a>
                <a href="{{url('/home/user/loginout')}}"><div class="glyphicon ">注销</div></a>
            @else
                <a href="javascript:void(0)"><div  class="logintxt">登录</div></a>
                <a href="javascript:void(0)"><div class="registtxt">注册</div></a>
            @endif
        </div>
    </div>
    <!--顶导-->
    <!--顶图-->
    <div class="mrt">
        <div class="top-img mrt">
            <div class=" top-img-l">
                <div  class="logo"><img src="{{url('/images/logo.png')}}" alt="" ></div>
            </div>
        </div></div>
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
                @section('shou')
                    @foreach($sort as $k)

                        <a id='mid-a' class="navbar-brand" href="{{url($k->url)}}">{{$k->name}}</a>

                    @endforeach
                @show
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
                    <a href="{{url('/home/user/c-index')}}"><div  class="glyphicon glyphicon-user">{{Auth::user()->name}}</div></a>
                    <a href="{{url('/home/user/loginout')}}"><div class="glyphicon ">注销</div></a>
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
    <div  id="midden">
        <!-- 中导图 -->
        <div class="container mid-row">
            <div class="row">
                <div class="col-md-4 mid-img remain">
                    <img id='big' src="{{url('/images/tit.jpg')}}" alt="">
                    <div class="mid-img-tit">
                        <span><a href="" class="mid-img-font">【淫荡的一天又开始啦】 谁淫荡啊，谁...</a></span>
                    </div>
                </div>
                <div class="col-md-4 mid-img">
                    <img src="{{url('/images/tit.jpg')}}" alt="">
                    <div class="mid-img-tit">
                        <span><a href="" class="mid-img-font">【淫荡的一天又开始啦】 谁淫荡啊，谁...</a></span>
                    </div>
                </div>
                <div class="col-md-4 mid-img">
                    <img src="{{url('/images/tit.jpg')}}" alt="">
                    <div class="mid-img-tit">
                        <span><a href="" class="mid-img-font">【淫荡的一天又开始啦】 谁淫荡啊，谁...</a></span>
                    </div>
                </div>
                <div class="col-md-4 mid-img">
                    <img src="{{url('/images/tit.jpg')}}" alt="">
                    <div class="mid-img-tit">
                        <span><a href="" class="mid-img-font">【淫荡的一天又开始啦】 谁淫荡啊，谁...</a></span>
                    </div>
                </div>
            </div>
        </div>
        <!--中导图-->
        <div class="container">
            <img class='mid-img-ggt' src="{{url('/images/ggt.jpg')}}" alt="">
        </div>
        <!--中瀑布-->
        <div id="falls" class="container">
            <div id="fallsleft" class="falls-left">
                <div id="fallsleftc">
                    <img src="{{url('/images/home-wnm.gif')}}" alt="" width="128" height="106">
                    <ul>
                        @if(Auth::check())
                            <li><a id="iad"><span class="glyphicon glyphicon-cog"></span>制作器</a></li>
                            <li><a href=""><span class="glyphicon glyphicon-cog"></span>全部频道</a></li>
                            <li><a href=""><span class="glyphicon glyphicon-cog"></span>全部作者</a></li>
                            <li><a href=""><span class="glyphicon glyphicon-cog"></span>订阅频道</a></li>
                            <li><a href=""><span class="glyphicon glyphicon-cog"></span>关注作者</a></li>
                        @else
                            <li><a href="{{url('/index/show/bodycolor')}}"><span class="glyphicon glyphicon-cog"></span>制作器</a></li>
                            <li><a href="{{url('/index/show/bodycolor')}}"><span class="glyphicon glyphicon-cog"></span>全部频道</a></li>
                            <li><a href="{{url('/index/show/bodycolor')}}"><span class="glyphicon glyphicon-cog"></span>全部作者</a></li>
                            <li><a href="{{url('/index/show/bodycolor')}}"><span class="glyphicon glyphicon-cog"></span>订阅频道</a></li>
                            <li><a href="{{url('/index/show/bodycolor')}}"><span class="glyphicon glyphicon-cog"></span>关注作者</a></li>
                        @endif
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
                            <a href="{{url('/home/user/addcomic')}}" class="left-title" id="left-t">漫画上传</a>
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
                    <div class="falls-hot"><a href="{{url('/home/user/works_hot')}}">热门<span class="glyphicon glyphicon-arrow-down"></span></a></div>
                    <div class="falls-hott"><a href="{{url('/home/user/works_up')}}">最新<span class="glyphicon glyphicon-arrow-down"></span></a></div>
                    <div id="falls-mi-nav">
                        <form class="navbar-form navbar-right" action="{{url('/home/user/nav')}}">
                            {{--<div class="form-group">--}}
                            频道检索: <input type="text" name="search" placeholder="请输入频道进行检索" id='mid-input' class="form-control ">
                            {{--</div>--}}
                            <button type="submit" class="btn btn-success " id="mid-btn">确定</button>
                        </form>
                    </div>
                </div>
                @if($imgxin)
                    @for($i=0;$i<count($imgxin);$i++)
                        <div class="ganlist" id="bimg{{$imgxin[$i]['id']}}">
                            <div class="gantop">
                                <div class="topc-left">
                                    <img class="img-circle" src="{{$imgxin[$i]['usericon']}}" alt="zzz">
                                </div>
                                <div class="topc-center">
                                    <span class="center-ll">{{$imgxin[$i]['username']}}</span>
                                    <span class="rorgin"><span class="glyphicon glyphicon-facetime-video">&nbsp;</span>频道</span>
                                </div>
                                <div class="topc-right clearfix">
                                    <div class="install clearfix">
                                        <div class="inleft">频道</div>
                                        <lu id="inright" class="inright user0">编辑频道
                                            <input class="img-value" type="hidden" value="{{$imgxin[$i]['id']}}">
                                            <li class="inlif img-inlif">删除</li>
                                            <li class="inlin img-inlin">编辑频道</li>
                                        </lu>

                                    </div>
                                </div>
                            </div>
                            <div class="topc-bottom">
                                <p class="topc-title">{{$imgxin[$i]['imgb']}}</p>
                                <img class="pcimg" src="{{url($imgxin[$i]['imgx'])}}" alt="zzz">
                            </div>
                            <div class="reviewed">
                                <ul class="pull-left">
                                    <li>
                                        <a href="###"><i class="glyphicon glyphicon-globe"></i>分享</a>
                                        <span><i class="glyphicon glyphicon-star"></i>收藏</span>
                                    </li>
                                </ul>
                                <ul class="pull-right">
                                    <li>
                                        <input type="hidden" class="bimg" value="{{$imgxin[$i]['id']}}">
                                        <span class="parise"><i class="glyphicon glyphicon-thumbs-up"></i><span>{{$imgxin[$i]['praises']}}</span></span>
                                        <span class="solid"><i class="glyphicon glyphicon-thumbs-down"></i><span>{{$imgxin[$i]['rottens']}}</span></span>
                                        <span class="message"><i class="glyphicon glyphicon-comment"></i><span>{{$imgxin[$i]['talks']}}</span></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="message-header">
                                <p >更多评论<i class="glyphicon glyphicon-menu-down"></i></p>
                            </div>
                            <div class="message-content">
                                <div class="cj_fbaio">
                                    发表评论
                                </div>
                                <form action="" class="cj_form">
                                    <textarea  name="" id="" cols="79" rows="5" style="resize:none;" placeholder="别憋着，来说两句~"></textarea>
                                </form>
                                <div class="cj_button">
                                    <span><i class="glyphicon glyphicon-picture"></i>表情</span>
                                    <div class="cj_bttp">
                                        <span>0/300</span>
                                        <input class="bimg" type="hidden" value="{{$imgxin[$i]['id']}}">
                                        <button class="cj_butt">发表</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @else
                    <div class="user-nodata">
                        <p class="user-flaunt">没有神作可以看了</p>
                    </div>
                @endif

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
                                    <img src={{url($v->img)}} class="tp">
                                </div>
                                <div class="itt">
                                    <div class="ttt" id="txt"><a href="{{url('home/user/txt/yue/').'/'.$v->id}}">{{$v->nama}}</a></div>
                                    <div class="tttt" id="txtt">{{$v->body}}</div>
                                </div>
                            </div>
                            <div id="rgz">
                                <form class="dd">
                                    <input  type="hidden" name='zid' value="{{$v->id}}" style="color:black">
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
<div id="footer" class="footmar container">
    <div class="footmar-top container">
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
            <img src="{{url('/images/bzmh.gif')}}" alt="">
        </div>
        <div class="bzrbapp">
            <p>暴走日报app</p>
            <img src="{{url('/images/bzrb.gif')}}" alt="">
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