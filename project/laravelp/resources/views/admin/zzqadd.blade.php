@extends('admin/index')
@section('leftbody');
				<div class="span9">
					<h1>
						新增制作器
					</h1>

					<form id="edit-profile" class="form-horizontal" action="{{url('admin/user/zzq_add')}}" method="post">

						<fieldset>
							<legend>新制作器</legend>
							<div class="control-group">
								<label class="control-label" for="input01" >制作器名称</label>
								<div class="controls">
									{{csrf_field()}}
									<input type="text" class="input-xlarge" name="name" id="input01" placeholder="请输入制作器名称" />
									<p>					@if (count($errors))
											{{$errors->first('route')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">制作器路径</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="url" id="input01"  placeholder="请输入制作器路径" />
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
