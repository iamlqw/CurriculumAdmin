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
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
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
                    <label>姓名</label><span>李启巍</span>
                </li>
                <li>
                    <label>学号</label><span>7180282</span>
                </li>
                <li>
                    <label>专业</label><span>软件工程</span>
                </li>
                <li>
                    <label>班级</label><span>研信息专18-2</span>
                </li>
                <li>
                    <label>邮箱</label><span>821062763@qq.com</span>
                </li>
                <li>
                    <label>手机号码</label><span>18401644110</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>使用帮助</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>官方交流网站：</label><span><a href="#">http://bbs.houdunwang.com</a></span>
                </li>
                <li>
                    <label>官方交流QQ群：</label><span><a href="#"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png"></a></span>
                </li>
            </ul>
        </div>
    </div>
	<!--结果集列表组件 结束-->

@endsection