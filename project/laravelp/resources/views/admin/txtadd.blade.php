@extends('admin/index')
@section('leftbody');
				<div class="span9">
					<h1>
						新增文字内容
					</h1>

					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/txt_add')}}" method="post">

						<fieldset>
							<legend>新文字</legend>
							<div class="control-group">
								<label class="control-label" for="input01" >用户名</label>
								<div class="controls">
									{{csrf_field()}}
									<input type="text" class="input-xlarge" name="userid" id="input01" placeholder="请输入用户ID" />
									<p>					@if (count($errors))
											{{$errors->first('route')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">文字内容</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="txtx" id="input01"  placeholder="请输入文字内容" />
									<p>					@if (count($errors))
											{{$errors->first('name')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">频道号</label>
								<div class="controls">
									<select name ="txtb">
										<option >神吐槽</option>
										<option >脑残对话</option>

									</select>
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
