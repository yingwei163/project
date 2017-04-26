@extends('/home/user/c-index')
@section('addcss')
    <link rel="stylesheet" href="{{url('/css/talks.css')}}">
@endsection
@section('addgodjs')
    <script>
        $(function(){
            $('#top_left').css('border-bottom','6px solid #D30339');
            $('#top_right').css('border-bottom','');
            $('#mydui').css('display','none');
            $('#duimy').fadeToggle();
            $('#top_left').click(function(){
                $('#top_left').css('border-bottom','6px solid #D30339');
                $('#top_right').css('border-bottom','');
                $('#mydui').css('display','none');
                $('#duimy').fadeToggle();
            });

            $('#top_right').click(function(){
                $('#top_right').css('border-bottom','6px solid #D30339');
                $('#top_left').css('border-bottom','');
                $('#duimy').css('display','none');
                $('#mydui').fadeToggle();

            });


            $('.imgwh').each(function(index){       //$('.pcimg')代表是所有图片集  each相当与对集合遍历
                $wd=$(this).width();$wh=$(this).height();
                if($wd>$wh){
                    $gd=60;
                    $gh=$wh/$wd*60;
                    $(this).width($gd);
                    $(this).height($gh);
                }else{
                    $gh=60;
                    $gd=$wd/$wh*60;
                    $(this).width($gd);
                    $(this).height($gh);
                }
            });
        });
    </script>
@endsection
@section('mygod')
    <div class="ganlist">
        <div class="gantop">
            <div class="top_left" id="top_left" style="cursor: pointer;">收到的评论</div>
            <div class="top_right" id="top_right" style="cursor: pointer;">发出的评论</div>
        </div>
        <ul id="duimy" class="user_list clearfix">
{{-- three和tetra数据 表示别人对我的评价--}}
            @if($three==0 && $tetra==0)
                <li>未收到评论！</li>
            @else
                @if($three!=0)
                    @for($i=0;$i<count($three);$i++)
                        <li class="userli clearfix">
                            <div class="dateils">
                                <img class="imgwh" src="{{url($three[$i]['icon'])}}" alt="zzz">
                                <p class=''>{{$three[$i]['name']}}</p>
                                <p class=''>{{$three[$i]['created_at']}}</p>
                            </div>
                            <div class="xinxi">回复:{{$three[$i]['talk_txt']}}</div>
                        </li>
                    @endfor
                @endif
                @if($tetra!=0)
                    @for($i=0;$i<count($tetra);$i++)
                        <li class="userli clearfix">
                            <div class="dateils">
                                <img class="imgwh" src="{{url($tetra[$i]['icon'])}}" alt="zzz">
                                <p class=''>{{$tetra[$i]['name']}}</p>
                                <p class=''>{{$tetra[$i]['created_at']}}</p>
                            </div>
                            <div class="xinxi">回复:{{$tetra[$i]['talk_txt']}}</div>
                        </li>
                    @endfor
                @endif
            @endif
        </ul>
{{-- one和tow数据 表示自己评价别人 --}}
        <ul id="mydui" class="user_list clearfix">
            @if($one==0 && $tow==0)
                <li>未收到评论！</li>
            @else
                @if($one!=0)
                    @for($i=0;$i<count($one);$i++)
                        <li class="userli clearfix">
                            <div class="dateils">
                                <img class="imgwh" src="{{url($one[$i]['icon'])}}" alt="zzz">
                                <p class=''>{{$one[$i]['name']}}</p>
                                <p class=''>{{$one[$i]['created_at']}}</p>
                            </div>
                            <div class="xinxi">评论:{{$one[$i]['talk_txt']}}</div>
                        </li>
                    @endfor
                @endif
                @if($tow!=0)
                    @for($i=0;$i<count($tow);$i++)
                        <li class="userli clearfix">
                            <div class="dateils">
                                <img class="imgwh" src="{{url($tow[$i]['icon'])}}" alt="zzz">
                                <p class=''>{{$tow[$i]['name']}}</p>
                                <p class=''>{{$tow[$i]['created_at']}}</p>
                            </div>
                            <div class="xinxi">评论:{{$tow[$i]['talk_txt']}}</div>
                        </li>
                    @endfor
                @endif
            @endif
        </ul>
    </div>
@endsection





