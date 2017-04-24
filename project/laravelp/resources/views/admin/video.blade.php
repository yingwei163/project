@extends('/admin/index')
@section('active3','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						视频上传管理页面
					</h1>
					[<a href="{{url('admin/user/video_add')}}">新增视频</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									视频发起人ID
								</th>
								<th>
									视频发起人名字
								</th>
								<th>
									视频图片
								</th>
								<th>
									视频地址
								</th>
								<th>
									视频标题
								</th>
								<th>
									视频上传时间
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach($video as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->userid}}</td>
								<td>{{$v->name}}</td>
								<td><img src="{{url($v->image)}}" alt=""></td>
								<td>{{$v->videox}}</td>
								<td>{{$v->videob}}</td>
								<td>{{$v->videot}}</td>
								<td><a href="{{url('admin/user/video_edit')}}/{{$v->id}}">修改最热</a> <a href="{{url('admin/user/video_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$video->links()}}
				</div>
@endsection
