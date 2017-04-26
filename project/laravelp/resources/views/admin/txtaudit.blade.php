@extends('/admin/index')
@section('active8','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						审核页面
					</h1>

					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									用户id
								</th>
								<th>
									文字详情
								</th>
								<th>
									文字频道
								</th>
								<th>
									用户名字
								</th>
								<th>
									用户头像
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
								<td>{{$v->userid}}</td>
								<td>{{$v->txtx}}</td>
								<td>{{$v->txtb}}</td>
								<td>{{$v->name}}</td>
								<td><img src="{{$v->icon}}" alt="" style="width: 100px;height: 50px"></td>

								<td> <a href="{{url('admin/user/txtaudit_edit')}}/{{$v->id}}">审核</a> <a href="{{url('admin/user/txt_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$sort->links()}}
				</div>
@endsection
