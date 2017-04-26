@extends('/admin/index')
@section('leftbody')
    <div class="span9">
        <h1>
            热门作品管理
        </h1>
        [<a href="{{url('admin/user/addhot')}}">新增热门</a>]
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>
                    ID
                </th>
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
            @if($result==0)
               <tr>
                   <td colspan="8">暂无作品</td>
               </tr>
            @else
                @for($i=0;$i<count($result);$i++)
                    @if($result[$i]['type']=='bimg')
                       <tr>
                        <td>{{$result[$i]['id']}}</td>
                        <td>{{$result[$i]['works_id']}}</td>
                        <td>{{$result[$i][0]['bimgb']}}</td>
                        <td><img class="bimg-x" src="{{url($result[$i][0]['bimgx'])}}" alt=""></td>
                        <td>
                            @if($result[$i]['type']=='bimg' ||$result[$i]['type']=='img' )
                                图片
                            @elseif($result[$i]['type']=='txt')
                                文本
                            @elseif($result[$i]['type']=='video')
                                视频
                            @endif
                        </td>
                        <td>{{$result[$i][0]['bimgt']}}</td>
                        <td>
                            <button class="delhot" style="background-color:#cd0200;border-radius:6px;color:#f5f8fa;border:none;" value="{{$result[$i]['id']}}">删除</button>
                        </td>
                    </tr>
                    @endif
                    @if($result[$i]['type']=='img')
                        <tr>
                            <td>{{$result[$i]['id']}}</td>
                            <td>{{$result[$i]['works_id']}}</td>
                            <td>{{$result[$i][0]['imgb']}}</td>
                            <td><img class="bimg-x" src="{{url($result[$i][0]['imgx'])}}" alt=""></td>
                            <td>
                                @if($result[$i]['type']=='bimg' ||$result[$i]['type']=='img' )
                                    图片
                                @elseif($result[$i]['type']=='txt')
                                    文本
                                @elseif($result[$i]['type']=='video')
                                    视频
                                @endif
                            </td>
                            <td>{{$result[$i][0]['imgt']}}</td>
                            <td>
                                <button class="delhot" style="background-color:#cd0200;border-radius:6px;color:#f5f8fa;border:none;" value="{{$result[$i]['id']}}">删除</button>
                            </td>
                        </tr>
                    @endif
                    @if($result[$i]['type']=='txt')
                        <tr>
                            <td>{{$result[$i]['id']}}</td>
                            <td>{{$result[$i]['works_id']}}</td>
                            <td>{{$result[$i][0]['txtb']}}</td>
                            <td><div>
                                    {{$result[$i][0]['txtx']}}
                                </div></td>
                            <td>
                                @if($result[$i]['type']=='bimg' ||$result[$i]['type']=='img' )
                                    图片
                                @elseif($result[$i]['type']=='txt')
                                    文本
                                @elseif($result[$i]['type']=='video')
                                    视频
                                @endif
                            </td>
                            <td>{{$result[$i][0]['txtt']}}</td>
                            <td>
                                <button class="delhot" style="background-color:#cd0200;border-radius:6px;color:#f5f8fa;border:none;" value="{{$result[$i]['id']}}">删除</button>
                            </td>
                        </tr>
                    @endif
                    @if($result[$i]['type']=='video')
                        <tr>
                            <td>{{$result[$i]['id']}}</td>
                            <td>{{$result[$i]['works_id']}}</td>
                            <td>{{$result[$i][0]['videob']}}</td>
                            <td>
                                <video src="{{url($result[$i][0]['videox'])}}" controls="controls" autoplay></video>
                            </td>
                            <td>
                                @if($result[$i]['type']=='bimg' ||$result[$i]['type']=='img' )
                                    图片
                                @elseif($result[$i]['type']=='txt')
                                    文本
                                @elseif($result[$i]['type']=='video')
                                    视频
                                @endif
                            </td>
                            <td>{{$result[$i][0]['videot']}}</td>
                            <td>
                                <button class="delhot" style="background-color:#cd0200;border-radius:6px;color:#f5f8fa;border:none;" value="{{$result[$i]['id']}}">删除</button>
                            </td>
                        </tr>
                    @endif
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
                    $.ajax({
                        url:'{{url('/admin/user/delhot/')}}'+'/'+$id,
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

