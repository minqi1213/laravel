<!DOCTYPE html>
<html lang="en">
<head>
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
			<ul>
				<li><a href="{{url('cp/index')}}" class="active">首页</a></li>
				{{--<li><a href="#">管理页</a></li>--}}
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>用户名: {{session('name')}}
				</li>
				<li><a href="{{url('cp/pass')}}" target="main">修改密码</a></li>
				<li><a href="{{url('cp/quit')}}">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>常用操作</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('cp/bug')}}" target="main"><i class="fa fa-fw"></i>bug管理</a></li>
                    <li><a href="{{url('cp/mission')}}" target="main"><i class="fa fa-fw"></i>任务发布中心</a></li>
                </ul>
            </li>
            {{--<li>--}}
            	{{--<h3><i class="fa fa-fw fa-cog"></i>系统设置</h3>--}}
                {{--<ul class="sub_menu">--}}
                    {{--<li><a href="#" target="main"><i class="fa fa-fw fa-cubes"></i>网站配置</a></li>--}}
                    {{--<li><a href="#" target="main"><i class="fa fa-fw fa-database"></i>备份还原</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
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
		<iframe src="{{url('cp/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2016. Powered By <a href="http://www.sunnytest.com">http://www.sunnytest.com</a>.
	</div>
	<!--底部 结束-->
</body>
</html>
