@extends('/admin/index')
@section('active8','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						管理页面
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

							</tr>
						</thead>
						<tbody>
						@foreach($sort as $v)
							<tr>
								<td>{{$v->name}}</td>
								<td>{{$v->url}}</td>
								<td> <a href="{{url('admin/user/sort_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/user/sort_del')}}/{{$v->id}}">删除</a><a href="{{url('admin/user/sort_add')}}"> 增加</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$sort->links()}}
				</div>
@endsection
