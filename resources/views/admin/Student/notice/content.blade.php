@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/studentinfo')}}">首页</a> &raquo; <a href="{{url('admin/studentnotice')}}">公告</a> &raquo; 原文
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="result_title">
                    <h3>原文</h3>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>
        <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
        <div class="result_wrap">
            <div class="result_content">
                <div class="index_about">
                    <h2 style="text-align:center;">{{$field->notice_title}}</h2>
                    <p style="text-align:center;width: 100%" class="dateview"><span class="d_time">发布时间：{{date("Y-m-d H:i",date($field->notice_time)) }}</span><span>编辑：{{$field->notice_editor}}</span><span>查看次数：2323</span></p>
                    <ul class="infos">
                        <p>{!! $field->notice_content !!}</p>
                    </ul>
                    <p class="nextinfo">
                        <p style="text-align: center">
                            <span style=""><a href="{{url('admin/studentnotice/content/'.(($field->nid)-1))}}">上一篇</a></span>
                            <span style=""><a href="{{url('admin/studentnotice/content/'.(($field->nid)+1))}}">下一篇</a></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

    <style>
        .result_content ul li span{
            foot-size:15px;
            padding: 6px 12px;
        }
    </style>
    <script>

    </script>
@endsection