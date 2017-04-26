@extends('/admin/index')
@section('active','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						反馈管理页面
					</h1>
					{{--[<a href="{{url('admin/user/attach_add')}}">新增权限</a>]--}}
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									反馈用户
								</th>
								<th>
									反馈信息
								</th>
								<th>
									反馈时间
								</th>
								<th>
									反馈设备
								</th>
								<th>
									是否已回应此反馈
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach($re as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->userid}}</td>
								<td>{{$v->feedx}}</td>
								<td>{{$v->feedt}}</td>
								<td>{{$v->device}}</td>
								<td><?= $v->is_feedback=='0'?'未回答反馈':'已回答反馈';?></td>
								@if($v->is_feedback=='1')
									<td><a href="{{url('admin/user/feedback_del')}}/{{$v->id}}">删除</a></td>
								@else
								<td> <a href="{{url('admin/user/feedback_edit')}}/{{$v->id}}">回应反馈信息</a> <a href="{{url('admin/user/feedback_del')}}/{{$v->id}}">删除</a></td>
									@endif
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$re->links()}}
				</div>
@endsection
