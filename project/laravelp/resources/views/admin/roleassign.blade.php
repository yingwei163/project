@extends('admin/index')
@section('leftbody')
				<div class="span9">
					<h1>
						修改权限操作
					</h1>

					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/role_assign')}}/{{$role->id}}" method="post">

						<fieldset>
							<legend>新权限</legend>
								{{csrf_field()}}
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
