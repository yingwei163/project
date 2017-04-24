@extends('admin/index')
@section('leftbody')
				<div class="span9">
					<h1>
						修改最热
					</h1>
					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/video_edit')}}/{{$re->id}}" method="post">

						<fieldset>
							<legend>修改权限</legend>
									{{csrf_field()}}
							<div class="control-group">
								<label class="control-label" for="input01">是否最热</label>
								<div class="controls">
									<input type="radio" value="1" class="input-xlarge" name="tovideo" id="input01" />最热
									<input type="radio" value="0" class="input-xlarge" name="tovideo" id="input01" />普通
								</div>
								<span style="margin-left: 130px;">@if(count($errors))
										{{$errors->first('tovideo')}}
									@endif</span>

							</div>
							<div class="form-actions">

								<button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary">
							</div>
						</fieldset>
					</form>
				</div>
@endsection
