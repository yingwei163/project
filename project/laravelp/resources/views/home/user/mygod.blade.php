@extends('\home\user\c-index')
@section('addcss')
    <link rel="stylesheet" href="/css/mygod.css">
@endsection
@section('addgodjs')
    <script>

        $(function(){
            $('.inright').click(function(){
                $(this).children().slideToggle(1);
             });
            $wd=$('.pcimg').width();
            $wh=$('.pcimg').height();
            if($wd>$wh){
                $gd=498;
                $gh=$wh/$wd*498;
                $('.pcimg').width($gd);
                $('.pcimg').height($gh);
            }else{
                $gh=498;
                $gd=$wd/$wh*498;
                $('.pcimg').width($gd);
                $('.pcimg').height($gh);
            }

            //点击弹出更多评论
            $('.message-header>p').click(function(){
                if($('.message-header>p').html()=='更多评论<i class="glyphicon glyphicon-menu-down"></i>'){
                    $('.message-header>p').html('收起评论<i class="glyphicon glyphicon-menu-up"></i>');
                }else{
                    $('.message-header>p').html('更多评论<i class="glyphicon glyphicon-menu-down"></i>');
                }
                $('.message-content').slideToggle('hast');
            });
            //判断是否有更多的评论 没有的话不给更多评论的提示
            if($('.message>i').eq(1).html()==0){
                $('.message-header>p').css('display','none');
            }else{
                $('.message-header>p').css('display','block');
            }
            //点击弹出更多评论
            $('.message').click(function(){
                if($('.message-header>p').html()=='更多评论<i class="glyphicon glyphicon-menu-down"></i>'){
                    $('.message-header>p').html('收起评论<i class="glyphicon glyphicon-menu-up"></i>');
                }else{
                    $('.message-header>p').html('更多评论<i class="glyphicon glyphicon-menu-down"></i>');
                }
                $('.message-content').slideToggle('hast');
            });
//         【暴漫】作品删除操作
            $('.bimg-inlif').click(function(){
                $works_id=($(this).prev().val());
                $.ajax({
                    url:'/home/user/bbgoddel/'+$works_id,
                    type:'get',
                    success:function(data){
                        if(data){
                            if($('.ganlist').size()==1){
                                $nodata="<div class='user-nodata'><p class='user-flaunt'>没有神作可炫耀了~</p></div>";
                                $('#bimg'+$works_id).after($nodata);
                            }
                            $('#bimg'+$works_id).slideUp('slow').removeClass('ganlist');
                        }else{
                          alert('失败！');
                        }
                    },
                    error:function(){
                        alert('删除失败了!');
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
                        if(data){
                            if($('.ganlist').size()==1){
                                $nodata="<div class='user-nodata'><p class='user-flaunt'>没有神作可炫耀了~</p></div>";
                                $('#img'+$works_id).after($nodata);
                            }
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

        });

    </script>
@endsection
@if(count($userinfo->clan))
@section('mygod')
        {{--遍历【暴漫】--}}
        @if(count($dataone))
        @foreach($dataone as $one)
            <div class="ganlist" id="bimg{{$one->id}}">
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
                                <input class="bimg-value" type="hidden" value="{{$one->id}}"></input>
                                <li class="inlif bimg-inlif">删除</li>
                                <li class="inlin bimg-inlin">编辑频道</li>
                            </lu>
                        </div>
                    </div>
                </div>
                <div class="topc-bottom">
                  <p class="topc-title">{{$one->bimgb}}</p>
                    <img class="pcimg" src="{{url($one->bimgx)}}" alt="" >
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
                          <span class="parise"><i class="glyphicon glyphicon-thumbs-up"></i><i>0</i></span>
                          <span class="solid"><i class="glyphicon glyphicon-thumbs-down"></i><i>0</i></span>
                          <span class="message"><i class="glyphicon glyphicon-comment"></i><i>0</i></span>
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
                            <button class="cj_butt">发表</button>
                        </div>
                    </div>
                </div>
           </div>
        @endforeach
        {{--因为是以个人资料中的神作数量来做总的if判断，以防数据丢失神作数据没有被更改的情况发生--}}
        {{--【趣图】--}}
        @elseif(count($datatow))
            @foreach($datatow as $tow)
                <div class="ganlist" id="img{{$tow->id}}">
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
                                    <input class="img-value" type="hidden" value="{{$tow->id}}"></input>
                                    <li class="inlif img-inlif">删除</li>
                                    <li class="inlin img-inlin">编辑频道</li>
                                </lu>

                            </div>
                        </div>
                    </div>
                    <div class="topc-bottom">
                        <p class="topc-title">{{$tow->imgb}}</p>
                        <img class="pcimg" src="{{url($tow->imgx)}}" alt="">
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
                                <span class="parise"><i class="glyphicon glyphicon-thumbs-up"></i><i>0</i></span>
                                <span class="solid"><i class="glyphicon glyphicon-thumbs-down"></i><i>0</i></span>
                                <span class="message"><i class="glyphicon glyphicon-comment"></i><i>0</i></span>
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
                                <button class="cj_butt">发表</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--因为是以个人资料中的神作数量来做总的if判断，以防数据丢失神作数据没有被更改的情况发生--}}
        @else
            <div class="user-nodata">
                <p class="user-flaunt">没有神作可炫耀了~</p>
            </div>
        @endif
    @endsection
@else
    <div class="user-nodata">
        <p class="user-flaunt">没有神作可炫耀了~</p>
    </div>
@endif