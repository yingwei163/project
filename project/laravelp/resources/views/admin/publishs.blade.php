@extends('/admin/index')
@section('leftbody')
    <div class="span9">
        <h1>
            连载管理
        </h1>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    标题
                </th>
                <th>
                    封面
                </th>
                <th>
                    作品制作时间
                </th>
                <th>
                    页数
                </th>
                <th>
                    操作
                </th>
            </tr>
            </thead>
            @if($data=='0')
                <tr>
                    <td colspan="8">暂无作品</td>
                </tr>
            @else
                @for($i=0;$i<count($data);$i++)
                    <tr>
                        <td>{{$data[$i]['id']}}</td>
                        <td>{{$data[$i]['title']}}</td>
                        <td><img width="80" class="img-x" src="{{url($data[$i]['cover'])}}" alt="zzz"></td>
                        <td>暴漫</td>
                        <td>{{$data[$i]['created_at']}}</td>
                        <td>{{$num=count($data[$i]['names'])}}</td>
                        <td>
                            <button class="delhot" style="background-color:#cd0200;border-radius:6px;color:#f5f8fa;border:none;" value="{{$data[$i]['id']}}">删除</button>
                            <button class="xiala" style="background-color:#cd0200;border-radius:6px;color:#f5f8fa;border:none;" >详情</button>
                        </td>
                    </tr>
                    <tr class="imgss" style="display:none;">
                        @for($i=0;$i<$num;$i++)
                            <td><img width="80" src="{{url($data[$i]['icons'][$i])}}" alt="zzz"></td>
                        @endfor
                    </tr>
                @endfor
            @endif
        </table>
    </div>
@endsection
@section('addjs')
    <script>
        $(function(){
            //限制图片大小
            $('.bimg-x').each(function(index){
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

            //删除热门作品
            $('.delhot').each(function(index){
                $(this).on('click',function(){
                    $current=$(this).parent().parent();
                    $id=($(this).val());
                    $type=$(this).parent().prev().prev().html();
                    $.ajax({
                        url:'{{url('/admin/user/delpublish')}}'+'/'+$id,
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
                            alert('键盘坏了删不了！');
                        },

                    })
                });
            });
            $('.xiala').each(function(index){
               $(this).on('click',function(){
//                   alert($(this).parent().parent().next().attr('class'));
                   $(this).parent().parent().next().fadeToggle('slow');
               });
            });
        });
    </script>
@endsection

