@extends('/admin/index')
@section('active8','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						友情链接页面
					</h1>
					[<a href="{{url('/admin/link_add')}}">新增友情链接</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									友情名字
								</th>
								<th>
									友情链接
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
								<td>{{$v->url}}</td>
								<td> <a href="{{url('admin/link_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/link_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$sort->links()}}
				</div>
@endsection
