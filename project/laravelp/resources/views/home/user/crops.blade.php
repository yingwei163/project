@extends('/home/user/c-index')
    @section('addgodjs')
       <script>
           $(function(){
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
           });
       </script>
    @endsection
@section('mygod')
    @if($result==0)
        <div class="user-nodata">
            <p class="user-flaunt">还没有添加连载~</p>
        </div>
    @else
        @for($i=0;$i<count($result);$i++)
            <div class="ganlist" id="bimg{{$result[$i]['id']}}">
                <div class="gantop">
                    <div class="topc-left">
                        <img class="img-circle" src="{{url($result[$i]['user_icon'])}}" alt="zzz">
                    </div>
                    <div class="topc-center">
                        <span class="center-ll">{{$result[$i]['user_name']}}</span>
                        <span class="rorgin"><span class="glyphicon glyphicon-facetime-video">&nbsp;</span>频道</span>
                    </div>
                    <div class="topc-right clearfix">
                        <div class="install clearfix">
                            <div class="inleft">收藏</div>
                            <lu id="inright" class="inright user0">编辑频道
                                <input class="bimg-value" type="hidden" value="{{$result[$i]['works_id']}}">
                                <li class="inlif bimg-inlif">删除</li>
                                <li class="inlin bimg-inlin">编辑频道</li>
                            </lu>
                        </div>
                    </div>
                </div>
                <div class="topc-bottom">
                    <p class="topc-title">{{$result[$i]['works_title']}}</p>
                    <img class="pcimg" src="{{url($result[$i]['works_icon'])}}" alt="zzz" >
                </div>
                <div class="reviewed">
                    <ul class="pull-left">
                        <li>
                            <a href="###"><i class="glyphicon glyphicon-globe"></i>分享</a>
                            <span style="color:#FF8B0D"><i class="glyphicon glyphicon-star"></i>收藏</span>
                        </li>
                    </ul>

                </div>

            </div>
        @endfor
    @endif
@endsection