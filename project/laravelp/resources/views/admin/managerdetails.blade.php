@extends('/admin/index')
@section('active8','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						订阅详情
					</h1>
					[<a href="{{url('/admin/user/managerdetails_add')}}">新增订阅详情</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									订阅ID
								</th>
								<th>
									订阅详情标题
								</th>
								<th>
									订阅主详情
								</th>
								<th>
									订阅详情图片
								</th>

								<th>
									操作
								</th>

							</tr>
						</thead>
						<tbody>

						@foreach($sort as $v)
							<tr>
								<td>{{$v->eid}}</td>
								<td>{{$v->tit}}</td>
								<td>{{$v->txt}}</td>
								<td><img src="/{{$v->eimg}}" alt="" style="width: 100px;height: 56.2px"></td>

								<td> <a href="{{url('/admin/user/managerdetails_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/user/managerdetails_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$sort->links()}}
				</div>
@endsection
