@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/studentinfo')}}">首页</a> &raquo; 课程作业/实验
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <div>
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>实验</legend>
                </fieldset>
            </div>
            <!--快捷导航 结束-->
        </div>
        <div class="layui-collapse">
            @foreach($data as $v)
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">
                    {{$v['experiment_name']}}({{$v['submit']}})&nbsp;
                    @if($v['submit']=='已提交')
                        <a id="submit" href="/storage/app/public/uploads/{{$v['document']}}" target="view_window">查看</a>
                    @endif
                    @if($v['experiment_isread']==0)
                        <span class="layui-badge-dot"></span>
                    @endif
                </h2>
                <div class="layui-colla-content layui-show">
                    实验要求：{{$v['experiment_content']}}<br>
                    截止日期：{{date("Y-m-d H:i",date($v['experiment_endtime']))}}<br>
                    @if($v['submit']!='已过期')
                        <a id="submit" target="view_window" href="/storage/app/public/uploads/{{$v['experiment_document']}}">实验文件</a>
                        <a id="submit" href="{{url('admin/homework/submit/'.$v['eid'])}}">提交作业</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!--搜索结果页面 列表 结束-->

    <style>
        .result_content ul li span{
            foot-size:15px;
            padding: 6px 12px;
        }
        #submit {
            color: blue;
        }
    </style>
    <script>
    </script>
@endsection