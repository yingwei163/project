@extends('admin/index')
@section('leftbody');
<div class="span9">
	<h1>
		修改制作器
	</h1>
@foreach($re as $k)
	<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/zzq_edit')}}/{{$k->id}}" method="post">

		<fieldset>
			<legend>修改制作器</legend>
			<div class="control-group">
				<label class="control-label" for="input01" >修改制作器名称</label>
				<div class="controls">
					{{csrf_field()}}
					<input type="text" value='{{$k->name}}' class="input-xlarge" name="name" id="input01"  />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="input01">修改制作器路径</label>
				<div class="controls">
					<input type="text" value='{{$k->url}}' class="input-xlarge" name="url" id="input01" />

				</div>
			</div>

			<div class="form-actions">

				<button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary">
			</div>
		</fieldset>
	</form>
</div>
	@endforeach
@endsection
