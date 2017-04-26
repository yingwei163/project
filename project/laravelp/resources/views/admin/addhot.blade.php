@extends('/admin/index')
@section('leftbody')
    <div class="span9">
        <h1>
            新增热门操作
        </h1>

        <form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/hottrue')}}" method="post">

            <fieldset>
                <legend>新热门</legend>
                <div class="control-group">
                    <label class="control-label" for="input01" >路由名称</label>
                    <div class="controls">
                        {{csrf_field()}}
                         @if($rebimg)
                           @for($i=0;$i<count($rebimg);$i++)
                                @if($rebimg[$i]!='0')
                                     <label style="display:block;width:160px;border:1px solid #c0c0c0;padding:3px 10px;color:#cbb956;"><span width="120">{{$rebimg[$i]->bimgb}}</span> <input style="float:right" class="margin-left:20px;" type="checkbox" name="bimg[]" value="{{$rebimg[$i]->id}}"></label>
                                @endif
                           @endfor
                         @endif
                         @if($reimg)
                            @for($i=0;$i<count($reimg);$i++)
                                @if($rebimg[$i]!='0')
                                     <label style="display:block;width:160px;border:1px solid #c0c0c0;padding:3px 10px;color:#cbb956;"><span width="120">{{$reimg[$i]->imgb}}</span> <input class="margin-left:20px;" type="checkbox" name="img[]" value="{{$reimg[$i]->id}}"></label>
                                @endif
                            @endfor
                        @endif
                         @if($retxt)
                            @for($i=0;$i<count($retxt);$i++)
                                @if($retxt[$i]!='0')
                                     <label style="display:block;width:160px;border:1px solid #c0c0c0;padding:3px 10px;color:#cbb956;"><span width="120">{{$retxt[$i]->txtb}}</span> <input class="margin-left:20px;" type="checkbox" name="txt[]" value="{{$retxt[$i]->id}}"></label>
                                @endif
                            @endfor
                        @endif
                         @if($revideo)
                            @for($i=0;$i<count($revideo);$i++)
                                @if($revideo[$i]!='0')
                                     <label style="display:block;width:160px;border:1px solid #c0c0c0;padding:3px 10px;color:#cbb956;"><span width="120">{{$revideo[$i]->videob}}</span> <input class="margin-left:20px;" type="checkbox" name="video[]" value="{{$revideo[$i]->id}}"></label>
                                @endif
                            @endfor
                        @endif
                    </div>
                </div>

                <div class="form-actions">

                    <button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary">
                    &nbsp;<a href="/admin/user/works_hot"><<返回</a>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
