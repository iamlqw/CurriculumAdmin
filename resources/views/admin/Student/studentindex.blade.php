@extends('layout.admin')
@section('content')
	<!--头部 开始-->
	<div class="top_box">
		<div class="layui-anim layui-anim-fadein">
			<div class="top_left">
				<div class="logo">学生后台管理模板</div>
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
				<h3><a href="{{url('admin/studentnotice')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>公告墙</a></h3>
			</li>
			<li>
				<h3><a href="add.blade.php" target="main"><i class="fa fa-fw fa-list-alt"></i>教学资料</a></h3>
			</li>
			<li>
				<h3><a href="{{url('admin/homework')}}" target="main"><i class="fa fa-fw fa-clipboard"></i>平时实验</a></h3>
			</li>
			<li>
				<h3><a href="{{url('admin/question')}}" target="main"><i class="fa fa-fw fa-thumb-tack"></i>讨论区</a></h3>
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
@endsection