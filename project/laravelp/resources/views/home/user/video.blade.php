@extends('/master')
@section('head')
    <link rel="stylesheet" href="{{url('/css/index.css')}}">
    <link rel="stylesheet" href="{{url('/css/y-index.css')}}">
    <link rel="stylesheet" href="{{url('/css/video.css')}}">
    <script src="{{url('/js/jquery-1.8.3.min.js')}}"></script>

    <script>
    $('#svi').click(function(){
        alert('woca');
    })

    </script>
    @endsection
@section('mid')
    <div class="container v_mid">
        @foreach($hotvideo as $v)
        <div class="left">
            <div class="v_txt"><h4>{{$v->videob}}</h4></div>
            <a href="{{url('/home/user/video')}}/{{$v->videoid}}"><img id="v_img" src="{{url($v->images)}}" alt=""></a>
        </div>
        @endforeach
        <div class="bzxt">
        @foreach($re as $vs)
                <div class="left v_xt"  >
                    <div class="v_tc"></div>
                    <div class="vi_txt">{{$vs->videob}}</div>
                    <a href="{{url('/home/user/video')}}/{{$vs->videoid}}"><img class="v_xtt" src="{{url($vs->images)}}" alt="" id="svi"></a>
                </div>
            @endforeach
        </div>
    </div>
    @for($i=0;$i<3;$i++)
    <div class="container" id="v_vm">
        <div class="v_mtop">
            <div class="v_mtopn left">暴走事件第五季</div><div class="left v_mtopnt"> 新的环节，新的惊喜，王尼玛和暴走家族，带着万众瞩目的暴走大事件第五季正向你走来，请扶好挖掘机，系好安全带，你一整年的笑点已被我们承包。</div>
            @foreach($all as $vss)
            <div class="v_mtopv">
                <a href="{{url('/home/user/video')}}/{{$vss->videoid}}"><img id="v_imgv" src="{{url($vss->images)}}" alt=""></a>
                <div>{{$vss->videob}}</div>
            </div>
            @endforeach
        </div>
    </div>
    @endfor
    @endsection
