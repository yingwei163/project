@extends('/admin/index')
@section('active8','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						制作器页面
					</h1>
					[<a href="{{url('admin/user/zzq_add')}}">新增制作器</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									制作器路径
								</th>
								<th>
									制作器名称
								</th>

							</tr>
						</thead>
						<tbody>
						@foreach($sort as $v)
							<tr>
								<td>{{$v->name}}</td>
								<td>{{$v->url}}</td>
								<td> <a href="{{url('admin/user/zz	q_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/user/zzq_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$sort->links()}}
				</div>
@endsection
