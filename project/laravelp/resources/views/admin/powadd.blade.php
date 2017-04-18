@extends('admin/index')
@section('leftbody')
				<div class="span9">
					<h1>
						新增管理员用户操作
					</h1>
					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/power_add')}}" method="post">

						<fieldset>
							<legend>新管理员用户名</legend>
							<div class="control-group">

								<label class="control-label" for="input01" >姓名</label>
								<div class="controls">
									{{csrf_field()}}
									<input type="text" class="input-xlarge" name="name" id="input01" placeholder="请输入管理员名" />

								</div>
								<span style="margin-left: 130px;">@if(count($errors))
									{{$errors->first('name')}}
								@endif</span>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">密码</label>
								<div class="controls">
									<input type="password" class="input-xlarge" name="password" id="input01"  placeholder="请输入管理员密码" />
								</div>
								<span style="margin-left: 130px;">@if(count($errors))
										{{$errors->first('password')}}
									@endif</span>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">角色增加</label>
								<div class="controls">

										@foreach($role as $v)
											<input type="checkbox" name="role[]" value="{{$v->id}}">{{$v->name}}
											@endforeach

								</div>
								<span>@if(count($errors))
										{{$errors->first('role')}}
									@endif</span>
							</div>
							<div class="form-actions">

								<button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary">
							</div>
						</fieldset>
					</form>
				</div>
@endsection
