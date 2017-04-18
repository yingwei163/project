@extends('admin/index')
@section('leftbody')
				<div class="span9">
					<h1>
						新增管理员用户操作
					</h1>
					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/power_editp')}}" method="post">

						<fieldset>
							<legend>新管理员用户名</legend>
							<div class="control-group">
								<label class="control-label" for="input01" >管理员名</label>
								<div class="controls">
									{{csrf_field()}}
									<input type="text" class="input-xlarge" name="name" id="input01" placeholder="请输入管理员名" value="{{$power->name}}"/>
								</div>
								<span style="margin-left: 130px;">@if(count($errors))
										{{$errors->first('name')}}
									@endif</span>
							</div>
							<input type="hidden" name="id" value="{{$power->id}}">
							{{--<div class="control-group">--}}
								{{--<label class="control-label" for="input01">密码</label>--}}
								{{--<div class="controls">--}}
									{{--<input type="password" class="input-xlarge" name="password" id="input01"  placeholder="请输入管理员密码" />--}}
								{{--</div>--}}
							{{--</div>--}}
							<div class="form-actions">

								<button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary">
							</div>
						</fieldset>
					</form>
				</div>
@endsection
