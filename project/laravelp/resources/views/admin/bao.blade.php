@extends('/admin/index')
@section('active8','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						暴漫app管理
					</h1>
					[<a href="{{url('/admin/user/bao_add')}}">新增app</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									暴漫app名字
								</th>
								<th>
									暴漫app图片
								</th>
								<th>
									操作
								</th>

							</tr>
						</thead>
						<tbody>

						@foreach($sort as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->name}}</td>
								<td><img src="/{{$v->img}}" alt="" style="width: 100px;height: 56.2px"></td>
								<td> <a href="{{url('/admin/user/bao_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/user/bao_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$sort->links()}}
				</div>
@endsection
