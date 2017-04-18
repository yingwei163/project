@extends('admin/index')
@section('leftbody')
				<div class="span9">
					<h1>
						新增角色操作
					</h1>

					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/role_add')}}" method="post">

						<fieldset>
							<legend>新角色</legend>
							<div class="control-group">
								<label class="control-label" for="input01" >角色名称</label>
								<div class="controls">
									{{csrf_field()}}
									<input type="text" class="input-xlarge" name="name" id="input01" placeholder="请输入角色名" />
									<p>					@if (count($errors))
											{{$errors->first('name')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">角色描述</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="roletake" id="input02"  placeholder="请输入角色描述" />
									<p>					@if (count($errors))
											{{$errors->first('roletake')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">给予权限</label>
								<div class="controls">
									@foreach($attach as $v)
									<input type="checkbox" value="{{$v->id}}" name="attach[]">{{$v->name}}
										@endforeach
										<p>					@if (count($errors))
											{{$errors->first('attach')}}
										@endif</p>
								</div>
							</div>
							<div class="form-actions">

								<button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary">
							</div>
						</fieldset>
					</form>
				</div>
@endsection
