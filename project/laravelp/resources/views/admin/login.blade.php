<!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Web 2.0 Login Form by Azmind.com</title>

	<!--- CSS --->
	<link rel="stylesheet" href="/css/admin/css/style.css" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="/js/admin/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="/js/admin/js/selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="/css/admin/css/fallback.css" /></noscript>
	<![endif]-->

	</head>

	<body>
		<div id="container">
			<form action="/admin/login" method="post">
				{{csrf_field()}}
				<div class="login">登录</div>
				<div class="username-text">用户名:@if (count($errors))
						{{$errors->first('name')}}
					@endif</div>
				<div class="password-text">密码:@if (count($errors))
						{{$errors->first('password')}}
					@endif</div>
				<div class="username-field">
					<input id='login' type="text" name="name" value="" placeholder="请输入用户名"/>
				</div>
				<div class="password-field">
					<input id='login' type="password" name="password" value="" placeholder="请输入密码"/>
				</div>
				<input type="checkbox" name="remember-me" id="remember-me" /><label for="remember-me">Remember me</label>
				<div class="forgot-usr-pwd">Forgot <a href="#">username</a> or <a href="#">password</a>?</div>
				<input type="submit" name="submit" value="GO" />
			</form>
		</div>
	</body>
</html>
