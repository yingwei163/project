@extends('/master')
@section('head')
    <link rel="stylesheet" href="{{url('/css/item_cj.css')}}">
    <link rel="stylesheet" href="{{url('/css/item_index.css')}}">
    <link rel="stylesheet" href="{{url('/css/mygod.css')}}">
    @yield('addcss')
    <script src="/js/jquery-1.8.3.min.js"></script>
    <script>
        $(function() {
                $('#topnav').addClass('navbar-fixed-top');
                $('#navbar').css('left',-95);
                $('#top-ld').show();
                $('.godclick').click(function(){
                });
            //页面加载完之后自动触发一次加载神作事件！
            $('.godclick').trigger("click");
            $('.storyimg').each(function(index){       //$('.pcimg')代表是所有图片集  each相当与对集合遍历
                $wd=$(this).width();$wh=$(this).height();
                if($wd>$wh){
                    $gd=50;
                    $gh=$wh/$wd*50;
                    $(this).width($gd);
                    $(this).height($gh);
                }else{
                    $gh=50;
                    $gd=$wd/$wh*50;
                    $(this).width($gd);
                    $(this).height($gh);
                }
            });
            $('.story').click(function(){
                location.href='{{url('/home/user/mypublish')}}';
            });
        })
        //触发神作单击事件
    </script>
    @yield('addgodjs')
@endsection
@section('topdenv')

    @endsection
@section('mid')
<body class="body_cj ">
   <div class="header"></div>
   <div class="user_banner">
       <div class="protect_tag clearfix" style='background-image: url("{{asset('home/image/top_i.png')}}") '>
           <div class="circular">
               <img class="img-circle img-cj" src="{{url($userinfo->icon)}}" alt="zzz">
           </div>
           <div class="user_circular">
                <span class="userTitleName">{{Auth::user()->name}}</span>
           </div>
       </div>
       <div class="relation clearfix">
           <a href="">关注({{$userinfo->foll}})</a>
           <a href="">粉丝({{$userinfo->fan}})</a>
           <input class="input_text" type="text" placeholder="说点什么吧...">
           <ul class="user_list">
               <li class="user_li">
                       <span>{{$userinfo->clan}}</span>
                       <p>神作</p>
               </li>
               <li>
                       <span>{{$userinfo->cash}}</span>
                       <p>尼玛币</p>
               </li>
               <li>
                       <span>{{$userinfo->comm}}</span>
                       <p>总评论</p>
               </li>
               <li>
                       <span>{{$userinfo->total}}</span>
                       <p>总顶数</p>
               </li>
               <li>
                       <span>{{$userinfo->join}}</span>
                       <p>参与值</p>
               </li>
               <li>
                       <span>{{$userinfo->idea}}</span>
                       <p>创意值</p>
               </li>
           </ul>
       </div>
   </div>
   <div class="wrapper-cj">
       @section('left')
       <div class="wrapper-left">
          <ul class="wLeft-list  clearfix">
              <li>
                  <a href="{{url('/home/user/mygod')}}" class="godclick"><span class="glyphicon glyphicon-thumbs-up"></span> 我的神作</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-heart"></span> 关注神作</a>
              </li>
              <li>
                  <a href="{{url('/home/user/mytalks')}}"><span class="glyphicon glyphicon-comment"></span> 评论</a>
              </li>
              <li>
                  <a href="{{url('/home/user/paper')}}"><span class="glyphicon glyphicon-send"></span> 小纸条</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-user"></span> 关注/粉丝</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-star"></span> 我的收藏</a>
              </li>
              <li>
                  <a href="###"><span class="glyphicon glyphicon-refresh"></span> 订阅更新</a>
              </li>
              <li>
                  <a href="{{url('/home/user/usercon')}}"><span class="glyphicon glyphicon-cog"></span> 帐号设置</a>
              </li>
              <li>
                  <a href="{{url('/home/user/mypublish')}}"><span class="glyphicon glyphicon-picture"></span> 我的连载</a>
              </li>
          </ul>
       </div>
       @show
       <div class="wrapper-center">
           @section('mygod')
           <div class="user-nodata">
               <p class="user-flaunt">没有神作可炫耀了~</p>
           </div>
           @show
       </div>
      @section('right')
       <div class="wrapper-right">
           <div class="user_channel">
               <h4>我的频道</h4>
               <div class="right-body">
                  <p>暂无频道</p>
               </div>
           </div>
           <div class="user_channel">
               <h4>我的连载</h4>
               <div class="right-body">
                   @if(empty($publish))
                     <p>暂无连载</p>
                   @else
                     @for($i=0;$i<count($publish);$i++)
                         <div class="story">
                            <div class="story_left">
                                <img class="storyimg" src="{{url($publish[$i]['cover'])}}" alt="zzz">
                            </div>
                            <div class="story_right">
                                 {{$publish[$i]['title']}}
                            </div>
                         </div>
                     @endfor
                    {{$publish->links()}}
                   @endif
               </div>
               <div class="publish">
                   <a href="/home/user/addgod"><p><span class="glyphicon glyphicon-plus">创建连载</span></p></a>
               </div>
           </div>
           <div class="user_channel">
               <h4>我的勋章</h4>
               <div class="right-body">
                   <p>暂无勋章</p>
               </div>
           </div>
           <div class="user_channel">
               <h4>最近来访</h4>
               <div class="right-body">
                   <p>被遗忘很久了o(╯□╰)o</p>
               </div>
           </div>
       </div>
      @show
   </div>
@endsection