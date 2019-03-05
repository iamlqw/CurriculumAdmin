@extends('layout.teacheradmin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; 公告
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
                    <h3>公告</h3>
                </div>
                <div class="short_wrap">
                    <a href="{{url('admin/notice/create')}}"><i class="fa fa-plus"></i>新建</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <article>
                    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
                    <div>
                        @foreach($data as $v)
                            <div class="result_wrap">
                                <h3>{{$v->notice_title}}</h3>
                                <br>
                                <ul>
                                    <p>{!! $v->notice_description !!}</p><br>
                                    <a href="#" onclick="delCate({{$v->nid}})"><i class="fa fa-recycle"></i>删除</a>
                                    <a href="{{url('admin/notice/content/'.$v->nid)}}" class="readmore">原文>></a>
                                </ul>
                                <p style="width: 100%" class="dateview">
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