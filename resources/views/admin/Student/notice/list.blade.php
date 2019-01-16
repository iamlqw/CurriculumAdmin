@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/studentinfo')}}">首页</a> &raquo; 公告
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <!--快捷导航 开始-->
        <div class="result_content">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>公告</legend>
            </fieldset>
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <article>
                    {{--<link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">--}}
                    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
                    <div>
                        @foreach($data as $v)
                            <div class="result_wrap">
                                <h3>{{$v->notice_title}}</h3>
                                <br>
                                <ul>
                                    <p>{!! $v->notice_description !!}</p>
                                    <a href="{{url('admin/studentnotice/content/'.$v->nid)}}" class="readmore">原文>></a>
                                 </ul>
                                <p style="width: 80%" class="dateview">
                                    <span>{{date("Y-m-d H:i",date($v->notice_time)) }}</span>
                                    <span>作者：{{$v->notice_editor}}</span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="page_list">
                        {{$data->links()}}
                    </div>
                </article>
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
        function delCate(nid) {
            layer.confirm('您确定要删除这条公告吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/notice/')}}/"+nid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                    if(data.status==0){
                        layer.msg(data.msg, {icon: 6});
                        location.reload();
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                });
//            layer.msg('的确很重要', {icon: 1});
            }, function(){

            });
        }
    </script>
@endsection