@extends('/home/user/c-marster')
@section('head')
    <link rel="stylesheet" href="{{url('/css/item_cj.css')}}">
    <link rel="stylesheet" href="{{url('/css/item_index.css')}}">
    <link rel="stylesheet" href="{{url('/css/paper.css')}}">
    <script src="{{url('/js/jquery-1.8.3.min.js')}}"></script>
    <script>

    </script>
@endsection
@section('add-god')
    @if(count($paper))
        @foreach($paper as $vpa)
            <div id='totaltwo' class="container">
                <h2>{{$vpa->paperb}}</h2>
                <div>
                    <div class="paper-left"><img src="{{url($vpa->userimg)}}" alt="" width="70"></div>
                    <div class="paper-left paper-txt">
                        <div class="paper-txtx">
                        {{$vpa->name}} 
                        @if($vpa->name=='超级管理员')
                        官方
                        @endif 
                        {{$vpa->papert}}
                        </div>
                        {{$vpa->paperx}}
                    </div>
                </div>
            </div>
        @endforeach
        @else
        <div class="user-nodata">
            <p class="user-flaunt">没有飞机可看了~</p>
        </div>
        @endif


    @endsection