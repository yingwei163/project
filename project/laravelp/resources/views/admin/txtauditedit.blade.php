@extends('admin/index')
@section('leftbody');
<div class="span9">
	<h1>
		审核
	</h1>
	@foreach($re as $k)
	<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/txtaudit_edit')}}/{{$k->id}}" method="post">
		<fieldset>
			<legend>审核</legend>
			{{csrf_field()}}
			<div class="control-group">
				<label class="control-label" for="input01">审核号</label>
				<div class="controls">
					<select name ="txtb">
						<option value="1">审核过</option>
						<option value="2">审核不过</option>

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
				@endforeach
	</form>
</div>
@endsection
