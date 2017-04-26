<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<meta charset="utf-8">
		<title>暴走漫画后台管理</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="{{url('/css/admin/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{url('/css/admin/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
		<link href="{{url('/css/admin/css/site.css')}}" rel="stylesheet">
		<link rel="stylesheet" href="{{url('/css/page.css')}}">
		@section('head')
			@endsection
	</head>
	<body>
		<div class="container">
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="#">Akira</a>
						<div class="nav-collapse">
							<ul class="nav">
								<li class="active">
									<a href="">Dashboard</a>
								</li>
								<li>
									<a href="">Account Settings</a>
								</li>
								<li>
									<a href="">Help</a>
								</li>
								<li class="dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown">Tours <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li>
											<a href="">Introduction Tour</a>
										</li>
										<li>
											<a href="">Project Organisation</a>
										</li>
										<li>
											<a href="">Task Assignment</a>
										</li>
										<li>
											<a href="">Access Permissions</a>
										</li>
										<li class="divider">
										</li>
										<li class="nav-header">
											Files
										</li>
										<li>
											<a href="">How to upload multiple files</a>
										</li>
										<li>
											<a href="">Using file version</a>
										</li>
									</ul>
								</li>
							</ul>
							<form class="navbar-search pull-left" action="">
								<input type="text" class="search-query span2" placeholder="Search" />
							</form>
							<ul class="nav pull-right">
								<li>
									{{ Session::get('name') }}
								</li>
								<li>
									<a href="{{url('/admin/loginout')}}">Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<div class="well" style="padding: 8px 0;">
						<ul class="nav nav-list">
							<li class="nav-header">
								角色访问策略
							</li>
							<li @yield('active')>
								<a href="{{url('/admin/user/attach_list')}}"><i class="icon-white icon-home"></i> 权限管理</a>
							</li>
							<li @yield('active1')>
								<a href="{{url('/admin/user/role_list')}}"><i class="icon-folder-open"></i> 角色管理</a>
							</li>
							<li @yield('active2')>
								<a href="{{url('/admin/user/power_list')}}"><i class="icon-check"></i>管理员管理</a>
							</li>
							<li>
							<li class="nav-header">
								视频管理
							</li>
							<li @yield('active3')>
								<a href="{{url('/admin/user/video_list')}}"><i class="icon-user"></i> 视频上传管理</a>
							</li>
							<li class="nav-header">
								标题管理
							</li>
							<li @yield('active8')>
								<a href="{{url('/admin/user/sort_list')}}"><i class="icon-white icon-home"></i> 标题管理</a>
							</li>
							<li class="nav-header">
								小纸条管理
							</li>
							<li @yield('active8')>
								<a href="{{url('/admin/user/paper_list')}}"><i class="icon-white icon-home"></i> 小纸条管理</a>
							</li>
							<li class="nav-header">
								反馈信息管理
							</li>
							<li @yield('active8')>
								<a href="{{url('/admin/user/feedback_list')}}"><i class="icon-white icon-home"></i> 反馈信息管理</a>
							</li>
							<li class="nav-header">
								作品审核管理
							</li>
							<li>
								<a href="{{url('/admin/user/bimg')}}"><i class="icon-info-sign"></i> 暴漫审核管理</a>
							</li>
							<li>
								<a href="{{url('/amdin/user/img')}}"><i class="icon-info-sign"></i> 趣图审核管理</a>
							</li>
							<li class="nav-header">
								排行管理
							</li>
							<li>
								<a href="{{url('/admin/user/works_hot')}}"><i class="icon-info-sign"></i> 热门管理</a>
							</li>
							<li>
								<a href="{{url('/admin/user/works_up')}}"><i class="icon-info-sign"></i> 最新管理</a>
							</li>
							<li class="nav-header">
								评论管理
							</li>
							<li>
								<a href="{{url('/admin/user/bimgtalks')}}"><i class="icon-info-sign"></i>暴漫评论</a>
							</li>
							<li>
								<a href="{{url('/admin/user/imgtalks')}}"><i class="icon-info-sign"></i>趣图评论</a>
							</li>
							<li class="nav-header">
								连载管理
							</li>
							<li>
								<a href="{{url('/admin/user/publishs')}}"><i class="icon-info-sign"></i>连载信息</a>
							</li>
							<li class="nav-header">
								订阅管理
							</li>
							<li @yield('active10')>
								<a href={{url("/admin/user/manager")}}><i class="icon-white icon-home"></i> 订阅管理</a>
								<a href={{url("/admin/user/managerdetails")}}><i class="icon-white icon-home"></i> 订阅详情</a>
							</li>
							<li class="nav-header">
								文字管理
							</li>
							<li @yield('active11')>
								<a href={{url("/admin/user/txt")}}><i class="icon-white icon-home"></i> 文字管理</a>
								<a href={{url("/admin/user/txtaudit")}}><i class="icon-white icon-home"></i> 文字审核</a>
								<a href={{url("/admin/user/txtauditgod")}}><i class="icon-white icon-home"></i> 文字通过</a>
								<a href={{url("/admin/user/txtauditon")}}><i class="icon-white icon-home"></i> 文字失败</a>
							</li>
							<li class="nav-header">
								友情链接
							</li>
							<li @yield('active12')>
								<a href={{url("/admin/link")}}><i class="icon-white icon-home"></i>友情链接管理</a>
							</li>
							<li class="nav-header">
								制作器管理
							</li>
							<li @yield('active13')>
								<a href={{url("/admin/user/zzq")}}><i class="icon-white icon-home"></i>制作器管理</a>
							</li>
							<li class="nav-header">
								轮播图管理
							</li>
							<li @yield('active14')>
								<a href={{url("/admin/user/lbt")}}><i class="icon-white icon-home"></i>轮播图管理</a>
							</li>
							<li class="nav-header">
								暴走漫画app管理
							</li>
							<li @yield('active15')>
								<a href={{url("/admin/user/bao")}}><i class="icon-white icon-home"></i>暴走漫画app管理</a>
							</li>
						</ul>
					</div>
				</div>
				@section('leftbody')
				<div class="span9">
					<h1>
						Dashboard
					</h1>
					<div class="hero-unit">
						<h1>
							Welcome!
						</h1>
						<p>
							To get the most out of Akira start with our 3 minute tour.
						</p>
						<p>
							<a href="" class="btn btn-primary btn-large">Start Tour</a> <a class="btn btn-large">No Thanks</a>
						</p>
					</div>

					@show
			</div>
		</div>
		<script src="{{url('/js/admin/js/jquery.min.js')}}"></script>
		<script src="{{url('/js/admin/js/bootstrap.min.js')}}"></script>
		<script src="{{url('/js/admin/js/site.js')}}"></script>
	   @yield('addjs')
	</body>
</html>