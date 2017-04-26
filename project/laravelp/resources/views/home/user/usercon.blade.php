@extends('/home/user/c-marster')
@section('head')
    <link rel="stylesheet" href="{{url('/css/item_cj.css')}}">
    <link rel="stylesheet" href="{{url('/css/item_index.css')}}">
    <script src="{{url('/js/jquery-1.8.3.min.js')}}"></script>
    <script>
        $(function() {
            $('#codee').hide();
            $('#code').hide();
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
                        alert('修改成功');
                        location.href = "/home/user/usercon"
                    },
                    error:function(xhr){
                        eval('var obj ='+xhr.responseText);
                        $('#birer').html(obj['bir']);
                        $('#sexer').html(obj['sex']);
                        $('#addrer').html(obj['addr']);
                    },
                    dataType:'json'
                });
            });
    $('#upphone').click(function () {
        $('#phoneon').append('{{csrf_field()}}');
        $.ajax({
            url:'{{url('/home/user/upphone')}}',
            type:'post',
            data:$('#phoneon').serialize(),
            success:function(data){
                if (data==0){
                    $('#phoneer').html('手机号码不正确');
                }else{
                    $('#upphonee').hide();
                    $('#upphone').hide();
                    $('#codee').show();
                    $('#code').show();
                    $('#phoneer').html('验证码发送成功');
                }
//
            },
            error:function(xhr){
                eval('var obj ='+xhr.responseText);
                $('#phoneer').html(obj['br']);
            },
            dataType:'json'
        });
    })


            $('#code').click(function () {
                $('#codeon').append('{{csrf_field()}}');
                $.ajax({
                    url:'{{url('/home/user/upcode')}}',
                    type:'post',
                    data:$('#codeon').serialize(),
                    success:function(data){
                        if (data==0){
                            $('#phoneer').html('验证码不能为空');
                        }else if(data=2){
                            $('#phoneer').html('验证码错误');
                        }
                        $('#phoneer').html('成功验证');
                        $('#codee').hide();
                        $('#code').hide();
                        $('#showphone').append('<input disabled value={{$userinfo->phone}} type="text" class="form-control"  name="phone"><br><span>手机已经验证成功</span>');
//                        location.href = "/index/show/bodycolor"
                    },
                    error:function(xhr){
//                document.write(xhr.responseText);
//                eval('var obj ='+xhr.responseText);
//                $('#phoneer').html(obj['br']);
                    },
                    dataType:'json'
                });
            })






        })
    </script>
@endsection
@section('add-god')
    <div id='total' class="container">
        <h2>修改名字</h2>
        <div class="rename container">改名一次消 耗 500 尼玛币,你想好了么<p>新名字：</p>
            @if(count($errors))
                {{$errors->first('nameaj')}}
                @endif
            {{ Session::get('success') }}
            <form id='renamef' action="{{url('/home/user/ucnrename')}}" method="post">
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
            <form id='fileupf' action="{{url('/home/user/ucnrefile')}}" enctype="multipart/form-data" method="post">
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

                @if($userinfo->is_confirmed==1)
                    <input type="email" class="form-control"  name="email" value="{{$user->email}}" disabled><br>
                <span>邮箱已经验证成功</span>
                    @else
                    <input type="email" class="form-control"  name="email" value="{{$user->email}}"><br>
                    <input id='rename' type="submit" class="btn btn-warning" value="确认">
                @endif
            </form>
        </div>
        <h2>验证手机</h2>
        {{ Session::get('phoneer') }}
        <span id="phoneer"></span>
        <div id="showphone">

        </div>
        <div class="container rename">
            @if($userinfo->is_phone==1)
                <input disabled id='upphonee' value='{{$userinfo->phone}}' type="text" class="form-control"  name="phone"><br>
                <span>手机已经验证成功</span>
            @else
            <form id="phoneon" method="post">
                <input  id='upphonee' value='{{$userinfo->phone}}' type="text" class="form-control"  name="phone"><br>
            </form>
            <input id='upphone' type="submit" class="btn btn-warning" value="发送验证码">
            <form id="codeon" method="post">
                <input  id='codee' type="text" class="form-control"  name="codes">
            </form>
            <input id='code' type="submit" class="btn btn-warning" value="确认">
            @endif
        </div>
        <h2>基本信息修改</h2>
        {{ Session::get('successfo') }}
        <div class="container rename">
            <form  id="userinfoup" method="post">
            生日:<br>
            <input type="date" class="form-control"  name="bir" value="{{$userinfo->bir}}"><br>
                <span id="birer"></span><br>
            性别:<br>
            <select name="sex" id="sexup">
                <option value="0" <?= $userinfo->sex==0?'selected':'' ?> >男</option>
                <option value="1" <?= $userinfo->sex==1?'selected':'' ?> >女</option>
            </select><br>
                <span id="sexer"></span><br>
            地区:<br>
            <select  id="addrup">
            </select>
            <select  id="cityup">
            </select>
                <br>
                <span id="addrer"></span><br>
                <input type="hidden" name="addr" id="addr">
                <input type="hidden" name="addrr" id="addrr">
            </form>
        <button id='info' class="btn btn-warning">保存信息</button>
        </div>
    </div>

    @endsection