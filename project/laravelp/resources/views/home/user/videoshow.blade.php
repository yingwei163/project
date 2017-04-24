@extends('master')
@section('head')
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/y-index.css">
    <link rel="stylesheet" href="/css/video.css">
    <script src="/js/jquery-1.8.3.min.js"></script>
    @endsection
@section('mid')
        <div class="container sucv">
            <div class="">
                <video src='{{url($re->videox)}}'   controls  loop  ></video>
            </div>
            <div>{{$re->videob}}</div>
            <div><a href="{{'/home/user/videoload'}}/{{$re->id}}">[下载当前视频]</a></div>
        </div>
    @endsection
