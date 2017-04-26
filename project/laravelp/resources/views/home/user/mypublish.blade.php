@extends('/home/user/c-index')
    @section('addcss')
        <link rel="stylesheet" href="{{url('/css/mygod.css')}}">
    @endsection
    @section('addgodjs')
        <script>
           $(function(){
               $('.listimg').each(function(index){       //$('.pcimg')代表是所有图片集  each相当与对集合遍历
                   $wd=$(this).width();$wh=$(this).height();
                   if($wd>$wh){
                       $gd=160;
                       $gh=$wh/$wd*160;
                       $(this).width($gd);
                       $(this).height($gh);
                   }else{
                       $gh=160;
                       $gd=$wd/$wh*160;
                       $(this).width($gd);
                       $(this).height($gh);
                   }
               });
               $('.imgmin').each(function(index){       //$('.pcimg')代表是所有图片集  each相当与对集合遍历
                   $wd=$(this).width();$wh=$(this).height();
                   if($wd>$wh){
                       $gd=80;
                       $gh=$wh/$wd*80;
                       $(this).width($gd);
                       $(this).height($gh);
                   }else{
                       $gh=80;
                       $gd=$wd/$wh*80;
                       $(this).width($gd);
                       $(this).height($gh);
                   }
               });
           });
        </script>
    @endsection
@section('mygod')
    @if(empty($publishs))
        <div class="user-nodata">
           <p class="user-flaunt">还没有添加连载~</p>
        </div>
    @else
        @for($i=0;$i<count($publishs);$i++)
                <div class="list">
                    <div class="list_left">
                        <img class="listimg" src="{{url($publishs[$i]['cover'])}}" alt="zzz">
                    </div>
                    <div class="list_right">
                        标题：<p class="ttp">{{$publishs[$i]['title']}}</p>
                        漫画数：<span class="num">{{$num=count($img=explode(',',rtrim($publishs[$i]['icons'],',')))}}</span>
                    </div>
                    <div class="content">
                        @for($i=0;$i<$num;$i++)
                            <img class="imgmin" src="{{url($img[$i])}}" alt="zzz">
                        @endfor
                    </div>
                </div>
        @endfor
    @endif
@endsection
