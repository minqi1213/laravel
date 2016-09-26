<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('resources/views/cp/style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('resources/views/cp/style/font/css/font-awesome.min.css')}}">
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>SunnyTest</h1>
		<h2>欢迎使用众包管理平台</h2>
		<div class="form">
			@if(session('msg'))
				<p style="color:red">{{session('msg')}}</p>
			@endif
			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
					<input type="text" name="username" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="password" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('cp/code')}}" alt="" onclick="this.src='{{url('cp/code')}}?'+Math.random()">
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p class="to_register">还没有SunnyTest账号？<a href="#">快速注册</a></p>
			<p><a href={{url('')}}>返回首页</a> &copy; 2016 Powered by <a href="http://www.sunnytest.com" target="_blank">http://www.sunnytest.com</a></p>
		</div>
	</div>
</body>
</html>
