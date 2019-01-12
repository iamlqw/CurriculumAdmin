@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; <a href="{{url('admin/list')}}">学生信息</a> &raquo; 添加学生
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3><i class="fa fa-plus"></i>批量导入(请选择xlsx格式文件)</h3>
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
        </form>
    </div>
    <div class="tips">
        <h3>导入注意事项</h3>
        <p>1、导入文件必须为xls或xlsx格式。</p>
        <p>2、导入的信息必须存放在sheet1中。</p>
        <p>3、导入信息的第一行必须按sid、name、sex、major、class顺序进行排列。</p>
        <p>4、导入表中不能包含有重复或已存在学生信息，若出现会让出错处之后的信息导入失败。</p>
    </div>
@endsection