@extends('layout.admin')
@section('content')
	<!--头部 开始-->
	<div class="top_box">
		<div class="layui-anim layui-anim-fadein">
			<div class="top_left">
				<div class="logo">课程管理平台</div>
				<ul>
					<li><a href="{{url('admin/studentindex')}}" class="active">首页</a></li>
				</ul>
			</div>
			<div class="top_right">
				<ul>
					<li>学生：{{$user}}</li>
					<li><a href="{{url('admin/studentpass')}}" target="main">修改密码</a></li>
					<li><a href="{{url('admin/studentquit')}}">退出</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<div class="layui-anim layui-anim-left">
		<ul>
			<li>
				<h3>
					<a onclick="Notice()" href="{{url('admin/studentnotice')}}" target="main">
						<i class="fa fa-fw fa-list-ul"></i>公告墙
					</a>
					@if($newnotice!=0)
						<span id="notice" class="layui-badge">{{$newnotice}}</span>
					@endif
				</h3>
			</li>
			<li>
				<h3>
					<a href="{{url('admin/coursedata')}}" target="main">
						<i class="fa fa-fw fa-list-alt"></i>教学资料
					</a>
				</h3>
			</li>
			<li>
				<h3>
					<a onclick="Experiment()" href="{{url('admin/homework')}}" target="main">
						<i class="fa fa-fw fa-clipboard"></i>平时实验
					</a>
					@if($newexp!=0)
						<span id="experiment" class="layui-badge">{{$newexp}}</span>
					@endif
				</h3>
			</li>
			<li>
				<h3>
					<a onclick="Answer()" href="{{url('admin/question')}}" target="main">
						<i class="fa fa-fw fa-thumb-tack"></i>讨论区
					</a>
					@if($newanswer!=0)
						<span id="answer" class="layui-badge">{{$newanswer}}</span>
					@endif
				</h3>
			</li>
		</ul>
		</div>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->

	<div class="main_box">
			<iframe src="{{url('admin/studentinfo')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2018. Powered By 北京林业大学.
	</div>
	<!--底部 结束-->
	<style>
		a:link {
			color: black;
			text-decoration:none;
		}
		a:visited {
			color: black;
			text-decoration:none;
		}
		a:hover {
			color: blue;
			text-decoration:none;
		}
	</style>
	<script>
		function Notice(){
            document.getElementById('notice').style.display = "none";
        }
		function Experiment(){
			document.getElementById('experiment').style.display = "none";
		}
        function Answer(){
            document.getElementById('answer').style.display = "none";
        }
	</script>
@endsection