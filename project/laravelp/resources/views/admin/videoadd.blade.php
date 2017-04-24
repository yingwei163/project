@extends('admin/index')
@section('leftbody')
				<div class="span9">
					<h1>
						上传操作
					</h1>

					<form id="edit-profile" class="form-horizontal" action="{{url('/admin/user/video_add')}}" method="post" enctype="multipart/form-data">

						<fieldset>
							<legend>新视频</legend>
							<div class="control-group">
								<label class="control-label" for="input01" >视频标题</label>
								<div class="controls">
									{{csrf_field()}}
									<input type="text" class="input-xlarge" name="videob" id="input01" placeholder="请输入视频标题" />
									<p>					@if (count($errors))
											{{$errors->first('videob')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">视频提交</label>
								<div class="controls">
									<input type="file" class="input-xlarge" name="videox" id="input01" />
									<p>					@if (count($errors))
											{{$errors->first('videox')}}
										@endif</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">视频图片提交</label>
								<div class="controls">
									<input type="file" class="input-xlarge" name="image" id="input01" />
									<p>					@if (count($errors))
											{{$errors->first('image')}}
										@endif</p>
								</div>
							</div>
							{{session('video')}}
							<div class="control-group">
								<label class="control-label" for="input01">是否为最热视频</label>
								<div class="controls">
									<table>
									<input type="radio" value="1" name="tovideo"> 最热
									<input type="radio" value="0" name="tovideo" checked> 普通
									</table>
									<p>		@if (count($errors))
											{{$errors->first('tovideo')}}
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
