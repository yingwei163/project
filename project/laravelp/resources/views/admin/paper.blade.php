@extends('/admin/index')
@section('active','class="active"')
@section('leftbody')
				<div class="span9">
					<h1>
						小纸条管理页面
					</h1>
					[<a href="{{url('admin/user/paper_add')}}">新增小纸条</a>]
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									ID
								</th>
								<th>
									发送目的ID
								</th>
								<th>
									发送内容
								</th>
								<th>
									发送标题
								</th>
								<th>
									发送时间
								</th>
								<th>
									发送人用户名
								</th>
								<th>
									发送人头像
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
						@foreach($paper as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->userid}}</td>
								<td>{{$v->paperx}}</td>
								<td>{{$v->paperb}}</td>
								<td>{{$v->papert}}</td>
								<td>{{$v->name}}</td>
								<td><img src="{{url($v->userimg)}}" width="50" alt=""></td>
								<td> <a href="{{url('admin/user/paper_edit')}}/{{$v->id}}">修改</a> <a href="{{url('admin/user/paper_del')}}/{{$v->id}}">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$paper->links()}}
				</div>
@endsection
