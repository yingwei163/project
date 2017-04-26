@extends('admin/index')
@section('leftbody');
				<div class="span9">
					<h1>
						新增友情链接
					</h1>

					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/link_add')}}" method="post">

						<fieldset>
							<legend>新友情链接</legend>
							<div class="control-group">
								<label class="control-label" for="input01" >友情链接</label>
								<div class="controls">
									{{csrf_field()}}
									<input type="text" class="input-xlarge" name="name" id="input01" placeholder="请输入友情链接名称" />
									<p>					@if (count($errors))
											{{$errors->first('route')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">友情链接路径</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="url" id="input01"  placeholder="请输入友情链接路径" />
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
