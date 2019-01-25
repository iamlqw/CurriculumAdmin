@extends('layout.teacheradmin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; <a href="{{url('admin/experiment')}}">平时实验</a> &raquo; 修改实验
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3><i class="fa fa-plus"></i>修改实验<br></h3>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/experiment/'.$field->eid)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>第几次实验：</th>
                        <td>
                            <input type="text" class="sm" name="experiment_name" value="{{$field->experiment_name}}"><i class="fa fa-exclamation-circle yellow"></i>建议格式：实验一
                        </td>
                    </tr>
                    <tr>
                        <th>实验要求：</th>
                        <td>
                            <textarea name="experiment_content" id="" cols="30" rows="10">{{$field->experiment_content}}</textarea>
                            <i class="fa fa-exclamation-circle yellow"></i>简述实验内容
                        </td>
                    </tr>
                    <tr>
                        <th>实验截止日期：</th>
                        <td>
                            <input type="text" class="layui-input" id="endtime" name="experiment_endtime" value="{{date("Y-m-d",date($field->experiment_endtime))}}">
                            <script type="text/javascript" src="{{asset('resources/org/layer/laydate/laydate.js')}}"></script>
                            <script>
                                lay('#version').html('-v'+ laydate.v)
                                //执行一个laydate实例
                                laydate.render({
                                    elem: '#endtime' //指定元素
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <th>实验任务书：</th>
                        <td><label for=""><input id="fileChange" type="checkbox">是否需要修改？</label></td>
                        <td>
                            <input id="file" type="hidden" class="form-control" name="experiment_document" required>
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
    <script>
        $(function () {
            $('#fileChange').click(function () {
                if ($('#file').attr("type") == 'hidden') {
                    $('#file').attr("type", "file");
                } else {
                    $('#file').attr("type", "hidden");
                }
            })
        })
    </script>

@endsection