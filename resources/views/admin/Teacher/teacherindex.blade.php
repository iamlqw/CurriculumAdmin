@extends('layout.teacheradmin')
@section('content')
	<script type="text/javascript" src="{{asset('resources/org/layui/layui.js')}}"></script>
	<link rel="stylesheet" href="{{asset('resources/org/layui/css/layui.css')}}">
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">教师后台管理模板</div>
			<ul>
				<li><a href="{{url('admin/teacherindex')}}" class="active">首页</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理员：{{$user}}</li>
				<li><a href="{{url('admin/teacherpass')}}" target="main">修改密码</a></li>
				<li><a href="{{url('admin/teacherquit')}}">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3>
					<a href="{{url('admin/notice')}}" target="main">
						<i class="fa fa-fw fa-list-ul"></i>公告墙
					</a>
				</h3>
            </li>
            <li>
				<h3>
					<a href="{{url('admin/data')}}" target="main">
						<i class="fa fa-fw fa-list-alt"></i>教学资料
					</a>
				</h3>
            </li>
            <li>
				<h3>
					<a href="{{url('admin/experiment')}}" target="main">
						<i class="fa fa-fw fa-clipboard"></i>平时实验
					</a>
				</h3>
            </li>
			<li>
				<h3>
					<a onclick="Question()" href="{{url('admin/answer')}}" target="main">
						<i class="fa fa-fw fa-thumb-tack"></i>讨论区
					</a>
					@if($newquestion!=0)
						<span id="question" class="layui-badge">{{$newquestion}}</span>
					@endif
				</h3>
            </li>
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('admin/teacherinfo')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
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
        function Question(){
            document.getElementById('question').style.display = "none";
        }
	</script>
@endsection
