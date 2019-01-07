@extends('layout.admin')
@section('content')
	<!--面包屑导航 开始-->
	<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; 账号基本信息
	</div>
	<!--面包屑导航 结束-->
	
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">

        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/list')}}"><i class="fa fa-plus"></i>学生信息</a>
                {{--<a href="#"><i class="fa fa-refresh"></i>批量导入</a>--}}
                {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
                {{--<a href="#"><i class="fa fa-refresh"></i>导出成绩单</a>--}}
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

	
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
                    <label>编号</label><span>{{$user['tid']}}</span>
                </li>
                <li>
                    <label>职称</label><span>{{$user['title']}}</span>
                </li>
                <li>
                    <label>邮箱</label><span>{{$user['email']}}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="result_wrap">
        <div class="result_title">
            <h3>老师信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>老师办公室：</label><span>{{$user['office']}}</span>
                </li>
                <li>
                    <label>公共邮箱：</label><span>{{$user['pubemail']}}</span>
                </li>
                <li>
                    <label>课堂微信群：</label><span>{{$user['wechat']}}</span>
                </li>
            </ul>
        </div>
    </div>
	<!--结果集列表组件 结束-->

@endsection