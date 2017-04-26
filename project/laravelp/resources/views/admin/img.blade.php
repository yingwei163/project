@extends('admin/index')
@section('leftbody')
    <div class="span9">
        <h1>
            趣图漫画管理页面
        </h1>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    用户
                </th>
                <th>
                    审阅
                </th>
                <th>
                    是否通过
                </th>
                <th>
                    作品内容
                </th>
                <th>
                    作品标题
                </th>
                <th>
                    作品上传时间
                </th>
                <th>
                    操作
                </th>
            </tr>
            </thead>
            @if(count($result))
                @foreach($result as $res)
                    <tr>
                        <td>{{$res->id}}</td>
                        <td>{{$res->userid}}</td>
                        <td>{{$res->auditid}}</td>
                        <td>
                            @if($res->auditto==0)
                                未审核
                            @else
                                审核通过
                            @endif
                        </td>
                        <td><img class="img-x" src="{{url($res->imgx)}}" alt=""></td>
                        <td>{{$res->imgb}}</td>
                        <td>{{$res->imgt}}</td>
                        <td>
                            <p><a style="cursor:pointer;" class="imgtrue">通过</a></p>
                            <input type="hidden" value="{{$res->id}}">
                            <p><a style="cursor:pointer;" class="imgfalse">删除</a></p>
                        </td>
                    </tr>
                @endforeach
            @else
            <tr>
                   <td colspan="8" style="color:#FF3652">没有审核作品!</td>
            </tr>
            @endif

        </table>
        {{$result->links()}}
    </div>
@endsection
@section('addjs')
    <script>
        $(function(){
            //限制图片大小
            $('.img-x').each(function(index){
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
            //通过审核作品
            $('.imgtrue').each(function(index){
                $(this).on('click',function(){
                    $current=$(this).parent().parent().prev().prev().prev().prev();//找到显示审核的td为下面代码显示ajax
                    $work_id=$(this).parent().next().val();
                    $.ajax({
                        url:'/admin/user/imgtrue/'+$work_id,
                        type:'get',
                        success:function(data){
                            if(data==1){
                                alert('审核~~');
                                $current.html('审核通过');
                            }else if(data==2){
                                alert('已通过审核！')
                            }else{
                                $current.html('未审核');
                            }
                        },
                        error:function(){
                            alert('键盘坏了！');
                        },

                    })
                });
            });
            //删除审核作品
            $('.imgfalse').each(function(index){
                $(this).on('click',function(){
                    $current=$(this).parent().parent().parent();
                    $work_id=$(this).parent().prev().val();
                    $.ajax({
                        url:'/admin/user/imgfalse/'+$work_id,
                        type:'get',
                        success:function(data){
                            if(data){
                                alert('删除~~');
                                $current.remove();
                            }else{
                                alert('等级太低删不了！');
                            }
                        },
                        error:function(){
                            alert('键盘坏了！');
                        },

                    })
                });
            });
        });
    </script>
@endsection

