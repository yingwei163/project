@extends('/home/user/c-index')
@section('addgodjs')
  <script>
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
  </script>
@endsection
@section('left')
@endsection
@section('mygod')
    {{--{{var_dump($bimg)}}--}}
    {{--{{var_dump($img)}}--}}
    {{--{{var_dump($txt)}}--}}
    @if($bimg==0 && $img==0 && $txt==0)
        <div class="user-nodata">
            <p class="user-flaunt">没有神作可炫耀了~</p>
        </div>
    @else
            @if($bimg!=0)
                @for($i=0;$i<count($bimg);$i++)
                    <div class="ganlist"  id="img{{$bimg[$i]['id']}}">
                        <div class="gantop">
                            <div class="topc-left">
                                <img class="img-circle" src="{{url($userinfo->icon)}}" alt="zzz">
                            </div>
                            <div class="topc-center">
                                <span class="center-ll">{{$user->name}}</span>
                                <span class="rorgin"><span class="glyphicon glyphicon-facetime-video">&nbsp;</span>频道</span>
                            </div>
                            <div class="topc-right clearfix">
                                <div class="install clearfix">
                                    <div class="inleft">暴漫</div>
                                    <lu id="inright" class="inright user0">编辑频道
                                        <input class="img-value" type="hidden" value="{{$bimg[$i]['id']}}">
                                        <li class="inlif img-inlif">删除</li>
                                        <li class="inlin img-inlin">编辑频道</li>
                                    </lu>

                                </div>
                            </div>
                        </div>
                        <div class="topc-bottom">
                            <p class="topc-title">{{$bimg[$i]['bimgb']}}</p>
                            <img class="pcimg" style="width:498px;" src="{{url($bimg[$i]['bimgx'])}}" alt="">
                        </div>

                    </div>
                @endfor
                {{--因为是以个人资料中的神作数量来做总的if判断，以防数据丢失神作数据没有被更改的情况发生--}}
            @endif
            @if($img!=0)
                @for($i=0;$i<count($img);$i++)
                    <div class="ganlist"  id="img{{$img[$i]['id']}}">
                        <div class="gantop">
                            <div class="topc-left">
                                <img class="img-circle" src="{{url($userinfo->icon)}}" alt="zzz">
                            </div>
                            <div class="topc-center">
                                <span class="center-ll">{{$user->name}}</span>
                                <span class="rorgin"><span class="glyphicon glyphicon-facetime-video">&nbsp;</span>频道</span>
                            </div>
                            <div class="topc-right clearfix">
                                <div class="install clearfix">
                                    <div class="inleft">趣图</div>
                                    <lu id="inright" class="inright user0">编辑频道
                                        <input class="img-value" type="hidden" value="{{$bimg[$i]['id']}}">
                                        <li class="inlif img-inlif">删除</li>
                                        <li class="inlin img-inlin">编辑频道</li>
                                    </lu>

                                </div>
                            </div>
                        </div>
                        <div class="topc-bottom">
                            <p class="topc-title">{{$img[$i]['imgb']}}</p>
                            <img class="pcimg" style="width:498px;" src="{{url($img[$i]['imgx'])}}" alt="">
                        </div>

                    </div>
                @endfor
                {{--因为是以个人资料中的神作数量来做总的if判断，以防数据丢失神作数据没有被更改的情况发生--}}
            @endif
            @if($txt!=0)
                @for($i=0;$i<count($txt);$i++)
                    <div class="ganlist"  id="img{{$txt[$i]['id']}}">
                        <div class="gantop">
                            <div class="topc-left">
                                <img class="img-circle" src="{{url($userinfo->icon)}}" alt="zzz">
                            </div>
                            <div class="topc-center">
                                <span class="center-ll">{{$user->name}}</span>
                                <span class="rorgin"><span class="glyphicon glyphicon-facetime-video">&nbsp;</span>频道</span>
                            </div>
                            <div class="topc-right clearfix">
                                <div class="install clearfix">
                                    <div class="inleft">文字</div>
                                    <lu id="inright" class="inright user0">编辑频道
                                        <input class="img-value" type="hidden" value="{{$txt[$i]['id']}}">
                                        <li class="inlif img-inlif">删除</li>
                                        <li class="inlin img-inlin">编辑频道</li>
                                    </lu>

                                </div>
                            </div>
                        </div>
                        <div class="topc-bottom">
                            <p class="topc-title">{{$txt[$i]['txtb']}}</p>
                            <div class="pcimg">{{$txt[$i]['txtx']}}</div>
                        </div>

                    </div>
                @endfor
                {{--因为是以个人资料中的神作数量来做总的if判断，以防数据丢失神作数据没有被更改的情况发生--}}
            @endif

    @endif
@endsection
@section('right')
@endsection