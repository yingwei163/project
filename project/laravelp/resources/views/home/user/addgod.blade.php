@extends('/home/user/c-index')
@section('head')
    @section('addcss')
        <link rel="stylesheet" href="{{url('/css/addgod.css')}}">
    @endsection
@section('mygod')
    <div class="add-god clearfix">
      <p class="godtitle">暴漫创建连载</p>
      <p class="goderror">申请连载至少要有2篇暴漫分类帖子</p>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action='{{url('/home/user/publish')}}' method="post" enctype="multipart/form-data">
            {{csrf_field()}}
        <label for="exampleInputEmail1">连载名称:</label>
        <input type="text" class="form-control space" id="exampleInputEmail1" name="title" placeholder="请输入3~80字符的连载名称">
        <label for="exampleInputEmail1 space">选择连载神作:</label>
        <ul class="myworks">
            @if(empty($worko))
              <li class="lired">暂无作品</li>
            @else
              @for($i=0;$i<count($worko);$i++)
                <li class="bimg">
                    <input type="checkbox" value="{{$worko[$i]['id']}}" name="bimgw[]"> {{$worko[$i]['bimgb']}}
                </li>
              @endfor
            @endif
        </ul>
        <p class="imgup">上传连载封面</p>
        <input class="fileup" name="cover" type="file">
        <div class="explain">
            <ul>
                <p>说明:</p>
              <li>
                  1.创建连载至少要有2篇暴走漫画风格帖子。
              </li>
              <li>
                  2.连载不可被其他用户订阅，累计10篇精选可联系编辑申请成为频道，频道可以被订阅。
              </li>
              <li>
                  3.所申请的暴走漫画，需前后情节具有连贯性，或人物设定一致。
              </li>
              <li>
                  4.连载名称、封面及用来申请系列的漫画名称不能涉及色情、政治、暴力、广告等网站违规用词。
              </li>
              <li>
                  5.连载所包含的暴走漫画不得直接盗用他人的作品。
              </li>
            </ul>
        </div>
            <p class="submm">
                <input type="submit" value="申请提交">
            </p>
    </div>
    </form>

@endsection
