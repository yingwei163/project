@extends('/home/user/c-index')
@section('addcss')
    <link rel="stylesheet" href="{{url('/css/mygod.css')}}">
@endsection
@section('addgodjs')
    <script>

        $(function(){
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
                    if($bool!=null){    //判断是否存在评论区【存在】点击代表收起评论区【不存在】就遍历
//                        alert($bool);
                        $(''+$bool+'').remove();
                    }else{
                        if($type=='bimg'){
                            $.ajax({
                                url:'{{url('/home/user/loadbimgtalks')}}',
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
                                url:'{{url('/home/user/loadimgtalks')}}',
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
                    url:'{{url('/home/user/bbgoddel/')}}'+'/'+$works_id,
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
                    url:'{{url('/home/user/iigoddel/')}}'+$works_id,
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
                            url:'{{url('/home/user/praise_bimg')}}'+'/'+$works_id,
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
                        url:'{{url('/home/user/praise_img/')}}'+'/'+$works_id,
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
                            url:'{{url('/home/user/rotten_bimg/')}}'+'/'+$works_id,
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
                            url:'{{url('/home/user/rotten_img/')}}'+'/'+$works_id,
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
                    $cj=$(this).parent().parent().parent().prev().prev().children('ul').children('li').children('.message').children('span');
                    $works_id=($(this).prev().val());
                    $type=$(this).prev().attr("class");  //判断是【暴漫评论】还是【趣图评论】
                    $datas=$(this).parent().parent().prev().children().val();
                    $content=$(this).parent().parent();
                    if($type=='bimg'){
                        //暴漫的评论
                          $.ajax({
                              url:'{{url('/home/user/bimgtalk')}}',
                              type:'post',
                              data:{'works_id':$works_id,'talktxt':$datas,'_token':'{{csrf_token()}}' },
                              success:function(data){
                                  if(data!=0){
                                      alert('评论成功!');
                                      $num=Number($cj.html())+1;
                                      $cj.html($num);
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
                            url:'{{url('/home/user/imgtalk')}}',
                            type:'post',
                            data:{'works_id':$works_id,'talktxt':$datas,'_token':'{{csrf_token()}}' },
                            success:function(data){
                                if(data!=0){
                                    alert('评论成功!');
                                    $num=Number($cj.html())+1;
                                    $cj.html($num);
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
        });

    </script>
@endsection
@section('mygod')
    @if($userinfo->clan)
    {{--当两个作品都没有时，出提示框--}}
    @if((empty($dataonex)) && (empty($datatowx)) )
        <div class="user-nodata">
            <p class="user-flaunt">没有神作可炫耀了~1</p>
        </div>
    @endif
    {{--遍历【暴漫】--}}
    @if(!empty($dataonex))
        @for($i=0;$i<count($dataonex);$i++)
        <div class="ganlist" id="bimg{{$dataonex[$i]['id']}}">
            <div class="gantop">
                    <div class="topc-left">
                        <img class="img-circle" src="{{url($userinfo->icon)}}" alt="zzz">
                    </div>
                    <div class="topc-center">
                        <span class="center-ll">{{Auth::user()->name}}</span>
                        <span class="rorgin"><span class="glyphicon glyphicon-facetime-video">&nbsp;</span>频道</span>
                    </div>
                    <div class="topc-right clearfix">
                        <div class="install clearfix">
                            <div class="inleft">aaa</div>
                            <lu id="inright" class="inright user0">编辑频道
                                <input class="bimg-value" type="hidden" value="{{$dataonex[$i]['id']}}">
                                <li class="inlif bimg-inlif">删除</li>
                                <li class="inlin bimg-inlin">编辑频道</li>
                            </lu>
                        </div>
                    </div>
                </div>
                <div class="topc-bottom">
                    <p class="topc-title">{{$dataonex[$i]['bimgb']}}</p>
                    <img class="pcimg" src="{{url($dataonex[$i]['bimgx'])}}" alt="" >
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
                            <input class="bimg" type="hidden" value="{{$dataonex[$i]['id']}}">
                            <span class="parise"><i class="glyphicon glyphicon-thumbs-up"></i><span>{{$dataonex[$i]['praises']}}</span></span>
                            <span class="solid"><i class="glyphicon glyphicon-thumbs-down"></i><span>{{$dataonex[$i]['rottens']}}</span></span>
                            <span class="message"><i class="glyphicon glyphicon-comment"></i><span>{{$dataonex[$i]['talks']}}</span></span>
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
                            <input class="bimg" type="hidden" value="{{$dataonex[$i]['id']}}">
                            <button class="cj_butt">发表</button>
                        </div>
                    </div>

                </div>
            </div>
        @endfor
        {{--因为是以个人资料中的神作数量来做总的if判断，以防数据丢失神作数据没有被更改的情况发生--}}
        {{--【趣图】--}}
    @endif
    @if(!empty($datatowx))
        @for($i=0;$i<count($datatowx);$i++)
            <div class="ganlist" id="img{{$datatowx[$i]['id']}}">
                <div class="gantop">
                    <div class="topc-left">
                        <img class="img-circle" src="{{url($userinfo->icon)}}" alt="zzz">
                    </div>
                    <div class="topc-center">
                        <span class="center-ll">{{Auth::user()->name}}</span>
                        <span class="rorgin"><span class="glyphicon glyphicon-facetime-video">&nbsp;</span>频道</span>
                    </div>
                    <div class="topc-right clearfix">
                        <div class="install clearfix">
                            <div class="inleft">aaa</div>
                            <lu id="inright" class="inright user0">编辑频道
                                <input class="img-value" type="hidden" value="{{$datatowx[$i]['id']}}"></input>
                                <li class="inlif img-inlif">删除</li>
                                <li class="inlin img-inlin">编辑频道</li>
                            </lu>

                        </div>
                    </div>
                </div>
                <div class="topc-bottom">
                    <p class="topc-title">{{$datatowx[$i]['imgb']}}</p>
                    <img class="pcimg" src="{{url($datatowx[$i]['imgx'])}}" alt="">
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
                            <input type="hidden" class="img" value="{{$datatowx[$i]['id']}}">
                            <span class="parise"><i class="glyphicon glyphicon-thumbs-up"></i><span>{{$dataonex[$i]['praises']}}</span></span>
                            <span class="solid"><i class="glyphicon glyphicon-thumbs-down"></i><span>{{$dataonex[$i]['rottens']}}</span></span>
                            <span class="message"><i class="glyphicon glyphicon-comment"></i><span>{{$dataonex[$i]['talks']}}</span></span>
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
                            <input class="img" type="hidden" value="{{$datatowx[$i]['id']}}">
                            <button class="cj_butt">发表</button>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
        {{--因为是以个人资料中的神作数量来做总的if判断，以防数据丢失神作数据没有被更改的情况发生--}}
    @endif
@else
<div class="user-nodata">
    <p class="user-flaunt">没有神作可炫耀了~3</p>
</div>
@endif
@endsection
