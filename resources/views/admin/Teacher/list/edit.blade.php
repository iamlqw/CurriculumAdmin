@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; <a href="{{url('admin/list')}}">学生信息</a> &raquo; 修改学生信息
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>操作</h3>
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
        {{--<div class="result_content">--}}
            {{--<div class="short_wrap">--}}
                {{--<a href="{{url('admin/list/create')}}"><i class="fa fa-plus"></i>新增学生</a>--}}
                {{--<a href="#"><i class="fa fa-refresh"></i>批量导入</a>--}}
                {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
                {{--<a href="#"><i class="fa fa-refresh"></i>导出成绩单</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/list/'.$field->sid)}}" method="post">
                <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>学生姓名：</th>
                        <td>
                            <input type="text" class="sm" name="name" value="{{$field->name}}">
                        </td>
                    </tr>
                    <tr>
                        <th>学号：</th>
                        <td>
                            <input type="text" name="sid"  value="{{$field->sid}}">
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require">*</i>性别：</th>
                        <td>
                            <select name="sex">
                                <option value="">==请选择==</option>
                                <option value="0" @if($field->sex==0) selected @endif>男</option>
                                <option value="1" @if($field->sex==1) selected @endif>女</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>学院：</th>
                        <td>
                            <input type="text" name="major"  value="{{$field->major}}">
                        </td>
                    </tr>
                    <tr>
                        <th>班级：</th>
                        <td>
                            <input type="text" name="class"  value="{{$field->class}}">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

@endsection