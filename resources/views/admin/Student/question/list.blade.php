@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/studentinfo')}}">首页</a> &raquo; 讨论区
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>讨论区</legend>
            </fieldset>
            <div class="short_wrap">
                <a href="{{url('admin/question/create')}}"><i class="fa fa-plus"></i>提问</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="layui-this">所有问题</li>
            <li>我的问题</li>
            <li>知识库</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
                <div>
                    @foreach($data as $v)
                        <blockquote class="layui-elem-quote layui-quote-nm">
                        <h3>{{$v->question_title}}</h3>
                        <ul>
                            <p>{!! $v->question_description !!}</p>
                            <a href="{{url('admin/question/content/'.$v->qid)}}" class="readmore">原文>></a>
                        </ul>
                        <p style="width: 15%" class="dateview"><span>{{date("Y-m-d H:i",date($v->question_time)) }}</span></p>
                        </blockquote>
                    @endforeach
                </div>
            </div>
            <div class="layui-tab-item">
                <div>
                @foreach($mydata as $v)
                    <blockquote class="layui-elem-quote layui-quote-nm">
                        <h3>{{$v->question_title}}</h3>
                        <ul>
                            <p>{!! $v->question_description !!}</p>
                            <a href="{{url('admin/question/content/'.$v->qid)}}" class="readmore">原文>></a>
                        </ul>
                        <p style="width: 15%" class="dateview"><span>{{date("Y-m-d H:i",date($v->question_time)) }}</span></p>
                    </blockquote>
                @endforeach
                </div>
            </div>
            <div class="layui-tab-item">
                <div>
                @foreach($kdata as $v)
                    <blockquote class="layui-elem-quote layui-quote-nm">
                        <h3>{{$v->question_title}}</h3>
                        <ul>
                            <p>{!! $v->question_description !!}</p>
                            <a href="{{url('admin/question/content/'.$v->qid)}}" class="readmore">原文>></a>
                        </ul>
                        <p style="width: 15%" class="dateview"><span>{{date("Y-m-d H:i",date($v->question_time)) }}</span></p>
                    </blockquote>
                @endforeach
                </div>
            </div>
        </div>

        <br>

        <div class="tips">
            <h3>讨论区注意事项</h3>
            <p>1、学生提问时需要标名问题题目和内容，提问后的问题会显示在我的问题栏中。</p>
            <p>2、老师在回答学生问题之后问题会在所有问题栏中显示出来。</p>
            <p>3、老师可以调出一些有价值的问题加入到知识库中，以便以后的学生进行参阅。</p>
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
        layui.use('element', function(){
            var element = layui.element;

        });
    </script>
@endsection