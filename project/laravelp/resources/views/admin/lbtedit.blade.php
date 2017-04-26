@extends('admin/index')
@section('leftbody');
<div class="span9">
	<h1>
		修改图片
	</h1>
	@foreach($user as $k)

	<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/lbt_edit')}}/{{$k->id}}" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>修改轮播图</legend>
			{{csrf_field()}}
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
				@endforeach
	</form>
</div>
@endsection
