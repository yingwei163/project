@extends('admin/index')
@section('leftbody');
<div class="span9">
	<h1>
		修改订阅号
	</h1>
	@foreach($user as $k)

	<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/managerdetails_edit')}}/{{$k->id}}" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>修改订阅详情</legend>
			<div class="control-group">
				<label class="control-label" for="input01">订阅详情标题</label>
				<div class="controls">
					<input type="text" class="input-xlarge" name="tit" id="input01" value="{{$k->tit}}" />
					<p>					@if (count($errors))
							{{$errors->first('name')}}
						@endif</p>
				</div>
				{{csrf_field()}}
			</div>
			<div class="control-group">
				<label class="control-label" for="input01">订阅详情图片</label>
				<div class="controls">
					<input type="file" class="input-xlarge" name="eimg" id="input01"  placeholder="请输入订阅小标题" />
					<p>					@if (count($errors))
							{{$errors->first('name')}}
						@endif</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="input01">订阅详情主介绍</label>
				<div class="controls">
					<input type="text" class="input-xlarge" name="txt" id="input01"  value="{{$k->txt}}" />
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
