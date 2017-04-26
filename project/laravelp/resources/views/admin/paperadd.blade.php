@extends('admin/index')
@section('leftbody')
				<div class="span9">
					<h1>
						新增小纸条操作
					</h1>

					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/paper_add')}}" method="post">

						<fieldset>
							<legend>新权限</legend>
							<div class="control-group">
								<label class="control-label" for="input01" >小纸条标题</label>
								<div class="controls">
									{{csrf_field()}}
									<input type="text" class="input-xlarge" name="paperb" id="input01" placeholder="请输入标题名" />
									<p>					@if (count($errors))
											{{$errors->first('paperb')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">小纸条发送选择</label>
								<div class="controls">
									<input type="checkbox" class="inclassput-xlarge" value="0" name="userid" id="input01"  checked/>全发
								@foreach($re as $v)
									<input type="checkbox" class="input-xlarge" value="{{$v->id}}" name="userid[]" id="input01"/>{{$v->id}}
									@endforeach
									<p>					@if (count($errors))
											{{$errors->first('userid')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">小纸条内容</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="paperx" id="input01"  placeholder="请输入小纸条内容" />
									<p>				@if (count($errors))
										{{$errors->first('papert')}}
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
