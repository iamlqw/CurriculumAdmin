@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/studentinfo')}}">首页</a> &raquo; <a href="{{url('admin/homework')}}">讨论区</a> &raquo; 提交作业
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>提交作业</legend>
            </fieldset>
            @if($errors!=null)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input id="file" type="file" class="form-control" name="source" required>
            <button type="submit" class="btn btn-link">确定</button>
            <i class="fa fa-exclamation-circle yellow"></i>为便于老师在线批改，请将作业转化为pdf格式上传。
        </form>
    </div>

@endsection