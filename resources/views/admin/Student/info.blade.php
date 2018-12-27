@extends('layout.admin')
@section('content')
	<!--面包屑导航 开始-->
	<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i> <a href="{{url('admin/studentinfo')}}">首页</a> &raquo; 账号基本信息
	</div>
	<!--面包屑导航 结束-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>账号基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>姓名</label><span>{{$user['name']}}</span>
                </li>
                <li>
                    <label>性别</label><span>{{$user['sex']}}</span>
                </li>
                <li>
                    <label>学号</label><span>{{$user['sid']}}</span>
                </li>
                <li>
                    <label>专业</label><span>{{$user['major']}}</span>
                </li>
                <li>
                    <label>班级</label><span>{{$user['class']}}</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>联系老师</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>老师办公室：</label><span><a href="#">http://bbs.houdunwang.com</a></span>
                </li>
                <li>
                    <label>公共邮箱：</label><span><a href="#">http://bbs.houdunwang.com</a></span>
                </li>
                <li>
                    <label>课堂微信群：</label><span><a href="#"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png"></a></span>
                </li>
            </ul>
        </div>
    </div>
	<!--结果集列表组件 结束-->

@endsection