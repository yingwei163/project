@extends('/admin/index')
@section('leftbody')
    <div class="span9">
        <h1>
            最新作品管理
        </h1>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>
                    作品ID
                </th>
                <th>
                    标题
                </th>
                <th>
                    内容
                </th>
                <th>
                    作品格式
                </th>
                <th>
                    作品制作时间
                </th>
                <th>
                    操作
                </th>
            </tr>
            </thead>
            @if($bimg==0 && $img==0 && $txt==0 && $video==0 )
                <tr>
                    <td colspan="8">暂无作品</td>
                </tr>
            @else
                @if($bimg!=0)
                   @for($i=0;$i<count($bimg);$i++)
                        <tr>
                            <td>{{$bimg[$i]['id']}}</td>
                            <td>{{$bimg[$i]['bimgb']}}</td>
                            <td><img class="bimg-x" src="{{url($bimg[$i]['bimgx'])}}" alt=""></td>
                            <td>暴漫</td>
                            <td>{{$bimg[$i]['bimgt']}}</td>
                            <td>
                                <button class="delhot" style="background-color:#cd0200;border-radius:6px;color:#f5f8fa;border:none;" value="{{$bimg[$i]['id']}}">删除</button>
                            </td>
                        </tr>
                   @endfor
                @endif
                @if($img!=0)
                    @for($i=0;$i<count($img);$i++)
                        <tr>
                            <td>{{$img[$i]['id']}}</td>
                            <td>{{$img[$i]['imgb']}}</td>
                            <td><img class="bimg-x" src="{{url($img[$i]['imgx'])}}" alt=""></td>
                            <td>趣图</td>
                            <td>{{$img[$i]['imgt']}}</td>
                            <td>
                                <button class="delhot" style="background-color:#cd0200;border-radius:6px;color:#f5f8fa;border:none;" value="{{$img[$i]['id']}}">删除</button>
                            </td>
                        </tr>
                    @endfor
                @endif
                @if($txt!=0)
                    @for($i=0;$i<count($txt);$i++)
                        <tr>
                            <td>{{$txt[$i]['id']}}</td>
                            <td>{{$txt[$i]['txtb']}}</td>
                            <td><img class="bimg-x" src="{{url($txt[$i]['txtx'])}}" alt=""></td>
                            <td>文字</td>
                            <td>{{$txt[$i]['txtt']}}</td>
                            <td>
                                <button class="delhot" style="background-color:#cd0200;border-radius:6px;color:#f5f8fa;border:none;" value="{{$txt[$i]['id']}}">删除</button>
                            </td>
                        </tr>
                    @endfor
                @endif
                {{--@if($video!=0)--}}
                    {{--@for($i=0;$i<count($video);$i++)--}}
                        {{--<tr>--}}
                            {{--<td>{{$video[$i]['id']}}</td>--}}
                            {{--<td>{{$video[$i]['videob']}}</td>--}}
                            {{--<td><video class="bimg-x" src="{{url($video[$i]['videox'])}}"  controls  loop></td>--}}
                            {{--<td>视频</td>--}}
                            {{--<td>{{$video[$i]['videot']}}</td>--}}
                            {{--<td>--}}
                                {{--<button class="delhot" style="background-color:#cd0200;border-radius:6px;color:#f5f8fa;border:none;" value="{{$video[$i]['id']}}">删除</button>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endfor--}}
                {{--@endif--}}
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
                    if($type=='暴漫'){
                        $url='{{url('/admin/user/delupbimg')}}'+'/'+$id;
                    }
                    if($type=='趣图'){
                        $url='{{url('/admin/user/delupbmg')}}'+'/'+$id;
                    }
                    if($type=='文字'){
                        $url='{{url('/admin/user/delupbtxt')}}'+'/'+$id;
                    }
                    {{--if($type=='视频'){--}}
                        {{--$url='{{url('/admin/user/delupbvideo')}}'+'/'+$id;--}}
                    {{--}--}}
                    $.ajax({
                        url:$url,
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
        });
    </script>
@endsection

