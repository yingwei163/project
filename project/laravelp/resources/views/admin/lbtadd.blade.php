@extends('admin/index')
@section('leftbody');
				<div class="span9">
					<h1>
						新增轮播图
					</h1>

					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/lbt_add')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
						<fieldset>
							<legend>新增轮播图</legend>

							<div class="control-group">
								<label class="control-label" for="input01">轮播图片</label>
								<div class="controls">
									<input type="file" class="input-xlarge" name="img" id="input01" />
									<p>					@if (count($errors))
											{{$errors->first('name')}}
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
