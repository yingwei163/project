@extends('admin/index')
@section('leftbody');
<div class="span9">
	<h1>
		新增标题
	</h1>

	<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/sort_edit')}}/{{$re->id}}" method="post">

		<fieldset>
			<legend>新标题</legend>
			<div class="control-group">
				<label class="control-label" for="input01" >标题名称</label>
				<div class="controls">
					{{csrf_field()}}
					<input type="text" value='{{$re->name}}' class="input-xlarge" name="route" id="input01" placeholder="请输入标题名称" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="input01">标题路径</label>
				<div class="controls">
					<input type="text" value='{{$re->url}}' class="input-xlarge" name="name" id="input01"  placeholder="请输入标题路径" />

				</div>
			</div>

			<div class="form-actions">

				<button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary">
			</div>
		</fieldset>
	</form>
</div>
@endsection
