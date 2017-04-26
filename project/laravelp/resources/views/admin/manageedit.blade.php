@extends('admin/index')
@section('leftbody');
<div class="span9">
	<h1>
		修改订阅号
	</h1>
	@foreach($user as $k)

	<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/manager_edit')}}/{{$k->id}}" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>新增订阅标题</legend>
			<div class="control-group">
				<label class="control-label" for="input01" >订阅号名称</label>
				<div class="controls">
					{{csrf_field()}}
					<input type="text" class="input-xlarge" name="nama" id="input01" value="{{$k->nama}}" />
					<p>					@if (count($errors))
							{{$errors->first('route')}}
						@endif</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="input01">订阅小标题</label>
				<div class="controls">
					<input type="text" class="input-xlarge" name="body" id="input01" value="{{$k->body}}" />
					<p>					@if (count($errors))
							{{$errors->first('name')}}
						@endif</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="input01">订阅头像</label>
				<div class="controls">
					<input type="file" class="input-xlarge" name="img" id="input01"  placeholder="请输入订阅小标题" />
					<p>					@if (count($errors))
							{{$errors->first('name')}}
						@endif</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="input01">订阅主介绍</label>
				<div class="controls">
					<input type="text" class="input-xlarge" name="ad" id="input01"  value="{{$k->ad}}" />
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
