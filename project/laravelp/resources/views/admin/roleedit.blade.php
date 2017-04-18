@extends('admin/index')
@section('leftbody')
				<div class="span9">
					<h1>
						修改权限操作
					</h1>
					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/role_edit')}}/{{$role->id}}" method="post">

						<fieldset>
							<legend>修改角色</legend>
							<div class="control-group">
								<label class="control-label" for="input01" >角色名</label>
								<div class="controls">
									{{csrf_field()}}
									<input type="text" class="input-xlarge" name="name" id="input01" placeholder="请输入角色名" value="{{$role->name}}"/>
								</div>
								<span style="margin-left: 130px;">@if(count($errors))
										{{$errors->first('name')}}
									@endif</span>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">角色描述</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="roletake" id="input01"  placeholder="请输入角色描述" value="{{$role->roletake}}"/>
								</div>
								<span style="margin-left: 130px;">@if(count($errors))
										{{$errors->first('roletake')}}
									@endif</span>
							</div>
							<div class="form-actions">

								<button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary">
							</div>
						</fieldset>
					</form>
				</div>
@endsection
