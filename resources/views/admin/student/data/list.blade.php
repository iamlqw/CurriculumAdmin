@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/studentinfo')}}">首页</a> &raquo; 教学课件
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
                    <legend>教学资料</legend>
                </fieldset>
            </div>
            <!--快捷导航 结束-->
        </div>
        <div class="layui-collapse">
            @foreach($data as $v)
                @if($v->data_father_id==0)
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">{{$v->data_chapter}}
                        <div style="float: right">
                            <a id="submit" target="view_window"href="/storage/app/public/uploads/{{$v->data_pdfpath}}">课件</a>
                            <a id="submit" href="{{url('admin/coursedata/video/'.$v->did)}}">视频</a>
                        </div>
                    </h2>
                    <div class="layui-colla-content layui-show">
                        @foreach($data as $w)
                            @if($w->data_father_id==$v->did)
                                <blockquote class="layui-elem-quote layui-quote-nm">
                                    {{$w->data_chapter}}
                                    <a id="submit" target="view_window" style="padding-left: 85%" href="/storage/app/public/uploads/{{$w['data_pdfpath']}}">课件</a>
                                    <a id="submit" href="{{url('admin/coursedata/video/'.$w->did)}}">视频</a>
                                </blockquote>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
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
        layui.use('element', function(){
            var element = layui.element;
        });
    </script>
@endsection