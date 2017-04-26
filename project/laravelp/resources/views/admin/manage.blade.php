@extends('/admin/index')
@section('active8','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						订阅页面
					</h1>
					[<a href="{{url('/admin/user/manager_add')}}">新增订阅</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									订阅名字
								</th>
								<th>
									订阅主介绍
								</th>
								<th>
									订阅图片
								</th>
								<th>
									订阅小标题
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
								<td>{{$v->nama}}</td>
								<td>{{$v->ad}}</td>
								<td><img src="/{{$v->img}}" alt="" style="width: 100px;height: 56.2px"></td>
								<td>{{$v->body}}</td>
								<td> <a href="{{url('/admin/user/manager_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/user/manager_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$sort->links()}}
				</div>
@endsection
