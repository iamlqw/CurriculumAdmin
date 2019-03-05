@extends('layout.teacheradmin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; 课程作业/实验
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
                    <h3>操作</h3>
                </div>
                <div class="short_wrap">
                    <a href="{{url('admin/experiment/create')}}"><i class="fa fa-plus"></i>新增实验</a>
                    <a href="{{url('admin/experiment/report')}}"><i class="fa fa-refresh"></i>查看成绩单</a>
                </div>

            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">第几次实验</th>
                        <th class="tc">实验要求</th>
                        <th class="tc">开始时间</th>
                        <th class="tc">截至日期</th>
                        <th class="tc">操作</th>
                    </tr>

                @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            {{$v->experiment_name}}
                        </td>
                        <td class="tc">
                            {{$v->experiment_content}}
                        </td>
                        <td class="tc">
                            {{date("Y-m-d H:i",date($v->experiment_starttime))}}
                        </td>
                        <td class="tc">
                            {{date("Y-m-d H:i",date($v->experiment_endtime))}}
                        </td>
                        <td class="tc">
                            <a style="width: 33%; text-align: right" href="{{url('admin/experiment/content/'.$v->eid)}}">详情</a>
                            <a style="width: 24%; text-align: center" href="{{url('admin/experiment/'.$v->eid.'/edit')}}">修改</a>
                            <a style="text-align: left" href="#" onclick="delCate({{$v->eid}})">删除</a>
                        </td>
                    </tr>
                @endforeach
                </table>

                <div class="page_list">
                    {{$data->links()}}
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
        function delCate(eid) {
            layer.confirm('您确定要删除这个学生吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/experiment/')}}/"+eid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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