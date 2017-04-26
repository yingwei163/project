@extends('admin/index')
@section('leftbody')
	<div class="span9">
		<h1>
			回应反馈操作
		</h1>
		<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/feedback_edit')}}/{{$re->id}}" method="post">

			<fieldset>
				<legend>回应反馈</legend>
				<div class="control-group">
					<label class="control-label" for="input01" >发送用户ID</label>
					<div class="controls">
						{{csrf_field()}}
						<input type="text" class="input-xlarge" name="userid" id="input01" readonly value="{{$re->userid}}"/>
						<input type="hidden" class="input-xlarge" name="userid" id="input01" value="{{$re->userid}}"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">标题</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="paperb" id="input01" readonly value="回应反馈"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">回应反馈内容</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="paperx" id="input01" placeholder="请输入修改内容" value=""/>
					</div>
					<span style="margin-left: 130px;">@if(count($errors))
							{{$errors->first('paperx')}}
						@endif</span>
				</div>
				<div class="form-actions">

					<button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary">
				</div>
			</fieldset>
		</form>
	</div>
	@endsection