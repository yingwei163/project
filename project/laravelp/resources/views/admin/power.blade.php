@extends('/admin/index')
@section('active2','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						管理员页面
					</h1>
					[<a href="{{url('admin/user/power_add')}}">新增管理员</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									用户名
								</th>
								<th>
									角色名称
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach($powers as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->name}}</td>
								<td>{{$v->powers}}</td>
								<td><a href="{{url('admin/user/power_assign')}}/{{$v->id}}">分配角色</a> <a href="{{url('admin/user/power_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/user/power_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>				
					{{$powers->links()}}
				</div>
@endsection
