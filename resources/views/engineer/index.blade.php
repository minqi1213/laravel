<!DOCTYPE html>
<html lang="en">
<head>
	<title>工程师首页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('resources/views/engineer/style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('resources/views/engineer/style/font/css/font-awesome.min.css')}}">
	<script type="text/javascript" src="{{asset('resources/views/engineer/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/engineer/style/js/ch-ui.admin.js')}}"></script>
</head>
<body>
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">众包平台</div>
			<ul class="nav">
				<li><a href="{{url('engineer/index')}}" class="active">首页</a>
				</li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>用户名: {{session('name')}}
				</li>
				<li><a href="{{url('engineer/pass')}}" target="main">修改密码</a></li>
				<li><a href="{{url('engineer/quit')}}">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3><i class="fa fa-fw"></i>常用操作</h3>
                <ul class="sub_menu_1">
					<a href="{{url('engineer/info')}}" target="main"><i class="fa fa-fw"></i>用户指南</a></br>
					<a href="{{url('engineer/management')}}" target="main"><i class="fa fa-fw"></i>项目管理</a></br>
					<a href="{{url('engineer/case')}}" target="main"><i class="fa fa-fw"></i>case管理</a></br>
                    <a href="{{url('engineer/bug')}}" target="main"><i class="fa fa-fw"></i>bug管理</a></br>
					<a href="#" target="main"><i class="fa fa-fw"></i>账户管理</a></br>
					<li></li>
                    {{--<li><a href="{{url('engineer/mission')}}" target="main"><i class="fa fa-fw"></i>任务接取中心</a></li>--}}
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw"></i>过滤器</h3>
                <ul class="sub_menu_1">
                    <a href="#" target="main"><i class="fa fa-fw"></i>分配给我的case</a></br>
                    <a href="{{url('engineer/bug')}}?uid_tome={{session('userid')}}" target="main"><i class="fa fa-fw"></i>分配给我的问题</a></br>
					<a href="{{url('engineer/bug')}}?uid_mysub={{session('userid')}}" target="main"><i class="fa fa-fw"></i>我提交的问题</a></br>
					<a href="{{url('engineer/bug')}}" target="main"><i class="fa fa-fw"></i>所有问题</a></br>
					<li></li>
                </ul>
            </li>
			<li>
				<h3><i class="fa fa-fw"></i>过滤器列表</h3>
				<ul class="sub_menu_1">
					@foreach($data as $d)
						<a href="{{url('engineer/bug')}}?pid={{$d->pid}}" target="main"><i class="fa fa-fw"></i>{{$d->pname}} 的Bug列表</a></br>
					@endforeach
						<li></li>
				</ul>
			</li>
            {{--<li>--}}
            	{{--<h3><i class="fa fa-fw fa-thumb-tack"></i>工具导航</h3>--}}
                {{--<ul class="sub_menu">--}}
                    {{--<li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>图标调用</a></li>--}}
                    {{--<li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery手册</a></li>--}}
                    {{--<li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色板</a></li>--}}
                    {{--<li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他组件</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('engineer/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2016. Powered By <a href="http://www.sunnytest.com">http://www.sunnytest.com</a>.
	</div>
	<!--底部 结束-->
</body>
</html>
