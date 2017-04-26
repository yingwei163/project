@extends('/admin/index')
@section('active8','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						轮播图页面
					</h1>
					[<a href="{{url('/admin/user/lbt_add')}}">新增轮播图</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									订阅图片
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
								<td><img src="/{{$v->img}}" alt="" style="width: 100px;height: 56.2px"></td>
								<td> <a href="{{url('/admin/user/lbt_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/user/lbt_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$sort->links()}}
				</div>
@endsection
