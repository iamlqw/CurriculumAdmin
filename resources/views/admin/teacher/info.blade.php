@extends('layout.teacheradmin')
@section('content')
	<!--面包屑导航 开始-->
	<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; 账号基本信息
	</div>
	<!--面包屑导航 结束-->
	
	<!--结果集标题与导航组件 开始-->
	{{--<div class="result_wrap">--}}

        {{--<div class="result_content">--}}
            {{--<div class="short_wrap">--}}
                {{--<a href="{{url('admin/list')}}"><i class="fa fa-plus"></i>学生信息</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!--结果集标题与导航组件 结束-->

	
    <div class="result_wrap">
        <div class="result_title">
            <h3>账号基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>姓名</label><span>{{$user->name}}</span>
                </li>
                <li>
                    <label>编号</label><span>{{$user->tid}}</span>
                </li>
                <li>
                    <label>职称</label><span>{{$user->title}}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="result_wrap">
        <div class="result_title">
            <h3>老师信息</h3>
            <div class="short_wrap">
                <a href="{{url('admin/teacherinfo/create')}}"><i class="fa fa-plus"></i>添加</a>
            </div>
        </div>
        <div class="result_content">
            <ul>
                @foreach($info as $v)
                <li>
                    <label>{{$v->information_name}}：</label><span>{{$v->information_value}}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
	<!--结果集列表组件 结束-->

@endsection