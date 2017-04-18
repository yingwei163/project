@extends('admin/index')
@section('leftbody')
				<div class="span9">
					<h1>
						新增权限操作
					</h1>

					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/attach_add')}}" method="post">

						<fieldset>
							<legend>新权限</legend>
							<div class="control-group">
								<label class="control-label" for="input01" >路由名称</label>
								<div class="controls">
									{{csrf_field()}}
									<input type="text" class="input-xlarge" name="route" id="input01" placeholder="请输入路由名" />
									<p>					@if (count($errors))
											{{$errors->first('route')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">权限名称</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="name" id="input01"  placeholder="请输入权限名称" />
									<p>					@if (count($errors))
											{{$errors->first('name')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">权限描述</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="routetake" id="input01"  placeholder="请输入权限描述" />
									<p>				@if (count($errors))
										{{$errors->first('routetake')}}
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
