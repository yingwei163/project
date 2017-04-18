@extends('home/user/addcomic')
   @section('addjs')
       <script>
           $(function(){
               var $qw=$('#addimg').width();
               var $qh=$('#addimg').height();
               if($qw>$qh){
                   $hw=680;
                   $hh=$qh/$qw*680;
                   $('#addimg').width($hw);
                   $('#addimg').height($hh);
               }else{
                   $hh=850;
                   $hw=$qw/$qh*850;
                   $('#addimg').width($hw);
                   $('#addimg').height($hh);
               }
           });
       </script>
   @endsection
@section('header-xx') {{--取消多余头部--}}
@endsection
@section('file-xx')  {{--取消选择图片--}}
@endsection

@section('images')
    @if($channel==1)
        <img id="addimg"  src="{{url($result->bimgx)}}"  alt="zzz">
    @else
        <img id="addimg"  src="{{url($result->imgx)}}"  alt="zzz">
    @endif
@endsection

@section('zone-right')
    <div class="trueadd-desc clearfix" >
        <div class="ook">
            <span class="glyphicon glyphicon-ok-circle"> 提交成功！</span>
        </div>
        <div class="prompt clearfix ">
         <p >*你的神作已经提交，正<span style="color:red;">等待审核!</span></p>
        </div>
        <ul class="prompt-list clearfix">
            <li>
                <strong>标题:</strong>
                @if($channel==1)
                    <p>{{$result->bimgb}}</p>
                @else
                    <p>{{$result->imgb}}</p>
                @endif
            </li>
            <li>
                <strong>分类:</strong>
                <p>
                   @if($channel==1)
                      暴走漫画
                   @else
                      趣图
                   @endif
                </p>
            </li>
            <li>
                <strong>频道:</strong>
                <p>{{$channel}}</p>
            </li>
        </ul>
        <div class="selgod">
            <a class="addp" href="###">查看我的神作></a>
            <a class="return-index" href="{{url('/')}}"><<返回主页</a>
        </div>

    </div>
@endsection