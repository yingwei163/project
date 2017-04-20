@extends('home\user\c-marster')
@section('head')
    <link rel="stylesheet" href="/css/item_cj.css">
    <link rel="stylesheet" href="/css/item_index.css">
    <script src="/js/jquery-1.8.3.min.js"></script>
    <script>
        $(function() {
            $('#topnav').addClass('navbar-fixed-top');
            $('#navbar').css('left',-95);
            $('#top-ld').show();
            //1、载入页面完成后即对php请求数据添加省一级列表项
            $.ajax({
                url:'{{url('/home/user/addr/0')}}',
                type:'get',
                success:function(data){
                    //alert(data.length);
                    for (var i = 0;i < data.length; i++ ) {
                        $('#addrup').append("<option id='addup'  value='"+data[i].id+"'>"+data[i].name+"</option>");
                    };
                },
                error:function(xhr){
                    document.write(xhr.responseText);
                },
                dataType:'json',
                //同步，如果没有第一级的数据第二级触发时自动为0
                async:false
            });
            //2、当前三级出现change事件时触发ajax获取value当作upid寻找下一级数据
            $('#addrup,#city').change(function(){
                var $upid = $(this).val();
                $upidpath='/home/user/addr/'+$upid;
                //在外层用变量存储$(this);
                var $_this = $(this);
                //根据传入的upid为下一级select添加选项
                $.ajax({
                    url:$upidpath,
                    type:'get',
                    success:function(data){
                        //判断数据是否存在，如果没有隐藏下几级
                        if(!data){
                            $_this.nextAll('select').hide();
                            return;
                        }
                        //在添加新数据之前清空select
                        $_this.next('select').empty().show();

                        for (var i = 0;i < data.length; i++ ) {
                            $_this.next('select').append("<option id='addrup' value='"+data[i].id+"'>"+data[i].name+"</option>");
                        };
                        //添加完为下一级选中一下
                        $_this.next('select').trigger('change');
                    },
                    error:function(){
                        alert('失败！');
                    },
                    dataType:'json'
                });
            })

            $('#addrup').trigger('change');


            $('#info').click(function(){
                $('#addr').val($('#addrup option:selected').text());
                $('#addrr').val($('#cityup option:selected').text());
                $('form').append('{{csrf_field()}}');
                $.ajax({
                    url:'{{url('/home/user/userinfoup')}}',
                    type:'post',
                    data:$('#userinfoup').serialize(),
                    success:function(data){
//                        location.href = "/index/show/bodycolor"
                    },
                    error:function(xhr){
                        document.write(xhr.responseText);
                        eval('var obj ='+xhr.responseText);
                        $('#birer').html(obj['br']);
                        $('#sexer').html(obj['sex']);
                        $('#addrer').html(obj['addr']);
                    },
                    dataType:'json'
                });
            });









        })
    </script>
@endsection
@section('add-god')
    <div id='total' class="container">
        <h2>修改名字</h2>
        <div class="rename container">改名一次消耗500尼玛币，你想好了么？<p>新名字：</p>
            @if(count($errors))
                {{$errors->first('nameaj')}}
                @endif
            {{ Session::get('success') }}
            <form id='renamef' action="/home/user/ucnrename" method="post">
                {{csrf_field()}}
            <input name='nameaj' type="text" placeholder="3-16位字符" class="form-control" >
                <input id='renamein' type="submit" class="btn btn-warning" value="确认">
            </form>
            </div>
        <h2>修改头像</h2>
        {{ Session::get('successf') }}
        <div class="container rename">
        <img src="{{url($userinfo->icon)}}"  height="50px" alt="" class="img-rounded">
            <label id='fileup' class="btn btn-warning" for="refile">上传文件</label>
            <form id='fileupf' action="/home/user/ucnrefile" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <input type="file" name='newfile' id="refile" style="position:absolute;clip:rect(0 0 0 0);">
                <input id='renewfile' type="submit" class="btn btn-warning" value="确认">
            </form>
        </div>
        <h2>验证邮箱</h2>
        @if (count($errors))
            {{$errors->first('email')}}
        @endif
        <div class="container rename">
            <form action="{{url('/home/user/email')}}" method='post'>
                {{csrf_field()}}
                <input type="email" class="form-control"  name="email" value="{{$user->email}}">
                @if($userinfo->is_confirmed==1)
                <span>邮箱已经验证成功</span>
                    @else
                    <input id='rename' type="submit" class="btn btn-warning" value="确认">
                @endif
            </form>
        </div>
        <h2>验证手机</h2>
        <div class="container rename">
            <form action="">
                <input type="phone" class="form-control"  name="phone">
                <input id='rename' type="submit" class="btn btn-warning" value="确认">
            </form>
        </div>
        <h2>基本信息修改</h2>
        {{ Session::get('successfo') }}
        <div class="container rename">
            <form action="" id="userinfoup">
            生日:<br>
            <input type="date" class="form-control"  name="bir" value="{{$userinfo->bir}}}"><br>
                <span id="#birer"></span><br>
            性别:<br>
            <select name="sex" id="sexup">
                <option value="0" <?php $userinfo->sex==0?'selected':'' ?>>男</option>
                <option value="1" <?php $userinfo->sex==1?'selected':'' ?>>女</option>
            </select><br>
                <span id="#sexer"></span><br>
            地区:<br>
            <select  id="addrup">
            </select>
            <select  id="cityup">
            </select>
                <br>
                <span id="#addrer"></span><br>
                <input type="hidden" name="addr" id="addr">
                <input type="hidden" name="addrr" id="addrr">
            </form>
        <button id='info' class="btn btn-warning">保存信息</button>
        </div>
    </div>

    @endsection