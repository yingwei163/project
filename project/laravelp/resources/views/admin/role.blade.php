@extends('/admin/index')
@section('active1','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						角色页面
					</h1>
					[<a href="{{url('admin/user/role_add')}}">新增角色</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									角色名称
								</th>
								<th>
									角色描述
								</th>
								<th>
									拥有权限
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach($roles as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->name}}</td>
								<td>{{$v->roletake}}</td>
								<td>{{$v->roles}}</td>
								<td> <a href="{{url('admin/user/role_assign')}}/{{$v->id}}">分配权限</a> <a href="{{url('admin/user/role_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/user/role_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$roles->links()}}
				</div>
@endsection
