@extends('/admin/index')
@section('active','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						权限管理页面
					</h1>
					[<a href="{{url('admin/user/attach_add')}}">新增权限</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									权限路由
								</th>
								<th>
									权限名称
								</th>
								<th>
									权限描述
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach($attach as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->route}}</td>
								<td>{{$v->name}}</td>
								<td>{{$v->routetake}}</td>
								<td> <a href="{{url('admin/user/attach_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/user/attach_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$attach->links()}}
				</div>
@endsection
