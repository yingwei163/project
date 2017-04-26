@extends('bootmodel')
@section('head')
    <link rel="stylesheet" href="{{url('/css/index.css')}}">
    <link rel="stylesheet" href="{{url('/css/y-index.css')}}">
    <link rel="stylesheet" href="{{url('/css/mygod.css')}}">
    <script src="{{url('/js/jquery-1.8.3.min.js')}}"></script>
        {{--//传剑--}}
    <script src="{{url('/yjs/jquery-2.1.4.min.js')}}"></script>
    <script src="{{url('/yjs/bootstrap.min.js')}}"></script>
    <script src="{{url('/yjs/bootstrap.js')}}"></script>

    <style>
        .zy-Slide section{ color: #FFFFFF; border-width: 1px; border-style: solid; }
    </style>
    {{--传剑--}}
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
                        $('#feedbacki').removeClass('feedback');
                        $('#daidumaps').hide();
                    }else if($(this).scrollTop() >= 480 ){
                        $('#fallsleftc').addClass('fallsleftc');
                    }else{
                        $('#fallsleftc').removeClass('fallsleftc');
                        $('#feedbacki').addClass('feedback');
                        $('#daidumaps').show();
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
            //反馈JQ=================================================================================
            $("#feedbacki").hover(
                function () {
                    $('#feedbacki').removeClass('feedback');
                    $('#feedbacki').addClass('feedbackm');
                },
                function () {
                    $('#feedbacki').removeClass('feedbackm');
                    $('#feedbacki').addClass('feedback');
                }
            );
            $('#feedbacki').click(function(){
                $('#bodycolorf').addClass('bodycolor');
                $('#feedbackf').show();
            })
            $('#bodycolorf').click(function(){
                $('#bodycolorf').removeClass('bodycolor');
                $('#feedbackf').hide();
            })
            $('#feedinfos').on('keypress', function(){
                var _length = $(this).val().length;
                var len=500-_length;
                if(len<0){
                    alert('字数超过500无法提交');
                }else{
                    $('#feednum').text(len);
                }
            });
            $('#feedup').click(function(){
                var _length = $('#feedinfos').val().length;
                if (_length>500 && _length==0){
                    alert('字数大于500或等于0,请先删除多余字符或添加字符');
                }else{
                    $('#feedbackff').append('{{csrf_field()}}');
                    $.ajax({
                        url:'{{url('/home/user/feedback')}}',
                        type:'post',
                        data:$('#feedbackff').serialize(),
                        success:function(data){
                            if (data==1){
                                alert('反馈意见提交成功');
                                $('#bodycolorf').removeClass('bodycolor');
                                $('#feedbackf').hide();
                            }
                        },
                        error:function(xhr){
//                            document.write(xhr.responseText);
                            alert('服务出错了请联系程序猿');
                        },
                        dataType:'json'
                    });
                }

            });
//收藏
            $('.crop').each(function(index){
                $(this).on('click',function(){
                    $type=$(this).prev().attr('class');
                    $works_id=$(this).prev().val();
                    $self=$(this);
                    $.ajax({
                        url:'{{url('/home/user/crop')}}',
                        type:'post',
                        data:{'_token':'{{csrf_token()}}','id':$works_id,'type':$type},
                        success:function(data){
                                if(data==1){
                                    $self.css({'color':"#FF8B0D"});
                                    alert('收藏成功!');
                                }else if(data==2){
                                    alert('已收藏!');
                                }

                        },
                        error:function(xhr){
                            alert('你鼠标的问题,我的代码不可能出错！');
                        },
                    });
                });
            });//收藏结束
        })
    </script>

@endsection
@yield('heads')
@section('body')

    <a href="javascript:;"><div id='feedbacki' class="feedback"></div></a>
    <div id="bodycolorf">
    </div>
    <div id="feedbackf" class="container feedbackd">
        <form method="post" id="feedbackff">
            <h5>请帮助我们进步</h5><br>
            平台选择 <select name="intel" id="intell">
                <option value="0">电脑</option>
                <option value="1">手机</option>
            </select><br>
            <textarea name="feedinfo" id="feedinfos" cols="30" rows="10"></textarea><br>
            <div class='top-right'>你还可以输入<span id="feednum">500</span>字<a href="javascript:void(0)" id="feedup" class="btn btn-success">提交</a></div>
        </form>
    </div>
    <div id="bodyContent" class="container login {{$show}}" ><img src="{{url('/images/dbz.png')}}" alt="">
        <div class="sing">
            <div class="sing-left tit-left">
                {{session('loginer')}}
                <form action="" id="loginer">
                    用 户 名: <input name='name' type="text" class="singinput" placeholder="请输入用户名或邮箱" ><br>
                    <span id="luser" class="success"></span><br>
                    密 &nbsp;码 : <input name='pwd' type="password" class="singinput" placeholder="请输入密码" ><br>
                    <span id="lpwd" class="success"></span><br>

                </form><input id='login' type="submit" class="singbtn" value="登陆">
                &nbsp; &nbsp; &nbsp;&nbsp;其他方式登陆:<br>
                &nbsp; &nbsp; &nbsp;<img src="{{url('/images/any.png')}}" alt="" class="any">
                <img src="{{url('/images/any.png')}}" alt="" class="any">
                <img src="{{url('/images/any.png')}}" alt="" class="any">
                <img src="{{url('/images/any.png')}}" alt="" class="any">
            </div>
            <div class="sing-right tit-right">
                <div class="sing-right-top">
                    <p>用注册帐号登录后你可以发暴漫,还能跟其他小伙伴聊天发小纸条,有很多好处哦,关注你的偶像,亲~</p>
                    <img src="{{url('/images/yao.png')}}" alt="">
                </div>
                <div class="sing-right-bottom">
                    <p>什么?连暴漫帐号都没有?不怕吃亏?你TM在逗<br><a href="">立刻注册 ></a></p>
                    <img src="{{url('/images/zdw.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div id="bodyContentr" class="container regist"><img src="{{url('/images/dbz.png')}}" alt="">
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
                &nbsp; &nbsp; &nbsp;<img src="{{url('/images/any.png')}}" alt="" class="any">
                <img src="{{url('/images/any.png')}}" alt="" class="any">
                <img src="{{url('/images/any.png')}}" alt="" class="any">
                <img src="{{url('/images/any.png')}}" alt="" class="any">
            </div>
            <div class="sing-right tit-right">
                <div class="sing-right-top">
                    <p>用注册帐号登录后你可以发暴漫,还能跟其他小伙伴聊天发小纸条,有很多好处哦,关注你的偶像,亲~</p>
                    <img src="{{url('/images/yao.png')}}" alt="">
                </div>
                <div class="sing-right-bottom">
                    <p>什么?你有帐号还不赶快登录?不怕吃亏？你TM在逗我?<br><a href="">立刻登录 ></a></p>
                    <img src="{{url('/images/zdw.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div id="bodycolor" class="{{$bodycolor}}">

 
    </div>
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
            <a href="{{url('/home/user/c-index')}}"><div  class="glyphicon glyphicon-user" id="shoucang">{{Auth::user()->name}}</div></a>
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
        {{--轮播图--}}
        <div id="carousel-example-generic" class="carousel slide lbtboxx" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->

            {{--                    @foreach($lbt as $k)--}}

            {{--@endforeach--}}
            <div class="carousel-inner" role="listbox" id="lbtbox">

                <div class="item active">
                    <img src="{{url($lbt[0]['img'])}}" id="lbt">
                </div>
                <div class="item">
                    <img src="{{url($lbt[1]['img'])}}" id="lbt">
                </div>
                <div class="item">
                    <img src="{{url($lbt[2]['img'])}}" id="lbt">
                </div>
            </div>


            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        {{--轮播图--}}

    </div>
    <!--中瀑布-->
    <div id="falls" class="container">
        <div id="fallsleft" class="falls-left">
            <div id="fallsleftc">
            <img src="{{url('/images/home-wnm.gif')}}" alt="" width="128" height="106">
            <ul>
                @if(Auth::check())
                    <li><a id="iad"><span class="glyphicon glyphicon-cog"></span>制作器</a></li>
                    @foreach($zzq as $z)
                        <li><a href={{url($z->url)}}><span class="glyphicon glyphicon-cog"></span>{{$z->name}}</a></li>
                    @endforeach
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
          {{--**--}}
            @if($bimgxin==0 && $imgxin==0 && $txtxin==0 && $videoxin==0)
                <div class="user-nodata">
                    <p class="user-flaunt">没有神作可以看了</p>
                </div>
            @else
                @if($videoxin)
                    @for($i=0;$i<1;$i++)
                        <div class="ganlist" id="video{{$videoxin[0]['id']}}">
                            <div class="gantop">
                                <div class="topc-left">
                                    <img class="img-circle" src="{{url('/images/offic.png')}}" alt="zzz">
                                </div>
                                <div class="topc-center">
                                    <span class="center-ll">{{$videoxin[0]['name']}}</span>
                                    <span class="rorgin" style="font-size:12px;width:100%;text-align:center;">{{$videoxin[0]['videot']}}</span>

                                </div>
                                <div class="topc-right clearfix">
                                    <div class="install clearfix">
                                        <div class="inleft">频道</div>
                                        <lu id="inright" class="inright user0">视频</lu>

                                    </div>
                                </div>
                            </div>
                            <div class="topc-bottom">
                                <p class="topc-title">{{$videoxin[0]['videob']}}</p>
                                <video src='{{url($videoxin[0]['videox'])}}'   controls  loop  ></video>
                                <div class="pcimg">

                                </div>
                            </div>
                            <div class="reviewed">
                                <ul class="pull-left">
                                    <li>
                                        <a href="###"><i class="glyphicon glyphicon-globe"></i>分享</a>
                                        <span class="crop"><i class="glyphicon glyphicon-star"></i>收藏</span>
                                    </li>
                                </ul>

                            </div>

                        </div>
                    @endfor
                @endif
                @if($bimgxin)
                    @for($i=0;$i<count($bimgxin);$i++)
                        <div class="ganlist" id="bimg{{$bimgxin[$i]['id']}}">
                            <div class="gantop">
                                <div class="topc-left">
                                    <a  class="topc-left" href="{{url('/home/user/youzone')}}/{{$bimgxin[$i]['userid']}}"><img class="img-circle" src="{{url($bimgxin[$i]['usericon'])}}" alt="zzz"></a>
                                </div>
                                <div class="topc-center">
                                    <span class="center-ll">{{$bimgxin[$i]['username']}}</span>
                                    <span class="rorgin" style="font-size:12px;width:100%;text-align:center;">{{$bimgxin[$i]['bimgt']}}</span>
                                </div>
                                <div class="topc-right clearfix">
                                    <div class="install clearfix">
                                        <div class="inleft">aaa</div>
                                        <lu id="inright" class="inright user0">暴漫</lu>

                                    </div>
                                </div>
                            </div>
                            <div class="topc-bottom">
                                <p class="topc-title">{{$bimgxin[$i]['bimgb']}}</p>
                                <img class="pcimg" src="{{$bimgxin[$i]['bimgx']}}" alt="zzz">
                            </div>
                            <div class="reviewed">
                                <ul class="pull-left">
                                    <li>
                                        <a href="###"><i class="glyphicon glyphicon-globe"></i>分享</a>
                                        <span class="crop"><i class="glyphicon glyphicon-star"></i>收藏</span>
                                    </li>
                                </ul>
                                <ul class="pull-right">
                                    <li>
                                        <input type="hidden" class="bimg" value="{{$bimgxin[$i]['id']}}">
                                        <span class="parise"><i class="glyphicon glyphicon-thumbs-up"></i><span>{{$bimgxin[$i]['praises']}}</span></span>
                                        <span class="solid"><i class="glyphicon glyphicon-thumbs-down"></i><span>{{$bimgxin[$i]['rottens']}}</span></span>
                                        <span class="message"><i class="glyphicon glyphicon-comment"></i><span>{{$bimgxin[$i]['talks']}}</span></span>
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
                                        <input class="bimg" type="hidden" value="{{$bimgxin[$i]['id']}}">
                                        <button class="cj_butt">发表</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif

                @if($imgxin)
                    @for($i=0;$i<count($imgxin);$i++)
                        <div class="ganlist" id="img{{$imgxin[$i]['id']}}">
                            <div class="gantop">
                                <div class="topc-left">
                                    <a  class="topc-left" href="{{url('/home/user/youzone')}}/{{$imgxin[$i]['userid']}}"><img class="img-circle" src="{{$imgxin[$i]['usericon']}}" alt="zzz"></a>
                                </div>
                                <div class="topc-center">
                                    <span class="center-ll">{{$imgxin[$i]['username']}}</span>
                                    <span class="rorgin" style="font-size:12px;width:100%;text-align:center;">{{$imgxin[$i]['imgt']}}</span>

                                </div>
                                <div class="topc-right clearfix">
                                    <div class="install clearfix">
                                        <div class="inleft">aaa</div>
                                        <lu id="inright" class="inright user0">趣图</lu>

                                    </div>
                                </div>
                            </div>
                            <div class="topc-bottom">
                                <p class="topc-title">{{$imgxin[$i]['imgb']}}</p>
                                <img class="pcimg" src="{{$imgxin[$i]['imgx']}}" alt="zzz">
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
                                        <input type="hidden" class="img" value="{{$imgxin[$i]['id']}}">
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
                                        <input class="img" type="hidden" value="{{$imgxin[$i]['id']}}">
                                        <button class="cj_butt">发表</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif

                @if($txtxin)
                    @for($i=0;$i<count($txtxin);$i++)
                        <div class="ganlist" id="txt{{$txtxin[$i]['id']}}">
                            <div class="gantop">
                                <div class="topc-left">
                                    <a  class="topc-left" href="{{url('/home/user/youzone')}}/{{$txtxin[$i]['userid']}}"><img class="img-circle" src="{{$txtxin[$i]['usericon']}}" alt="zzz"></a>
                                </div>
                                <div class="topc-center">
                                    <span class="center-ll">{{$txtxin[$i]['name']}}</span>
                                    {{--<span class="rorgin" style="font-size:12px;width:100%;text-align:center;">{{$txtxin[$i]['textt']}}</span>--}}

                                </div>
                                <div class="topc-right clearfix">
                                    <div class="install clearfix">
                                        <div class="inleft">aaa</div>
                                        <lu id="inright" class="inright user0">文本 </lu>

                                    </div>
                                </div>
                            </div>
                            <div class="topc-bottom">
                                <p class="topc-title"> {{$txtxin[$i]['txtb']}}</p>
                                <div class="pcimg" style="font-size: 10px;">{{$txtxin[$i]['txtx']}}</div>
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
                    @endfor
                @endif
            @endif
    </div>

    <!--中瀑布-->
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

    </div>
</div>


</div>
<!--中全部-->
@show
    <div id="footer" class="footmar container">
    <div class="footmar-top container">
        <dl>
            <dt>友情链接</dt>
                <dd>
                @foreach($link as $j)
                 <a href="{{$j->url}}">{{$j->name}}</a><br>



                @endforeach
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
        @foreach($bao as $v)
        <div class="bzmhapp">
            <p>{{$v->name}}</p>
            <img src={{url($v->img)}} alt="">
        </div>
        @endforeach

    </div>
        <div class="footmar-bot container">
            <p>友情链接：计算机信息网络国际联网安全保护管理办法（公安部令第33号）</p>

            <p>商务合作：hezuo@baozou.com</p>

            <p>西安摩摩信息技术有限公司 沪ICP备14004983号-15</p>

            <p>Beianicon 陕公网安备 61019002000313号</p>

            <p>由达观数据提供部分技术支持</p>
        </div>
    </div>
    </div>
@endsection