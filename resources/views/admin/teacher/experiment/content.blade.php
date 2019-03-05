@extends('layout.teacheradmin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; <a href="{{url('admin/experiment')}}">课程作业/实验</a> &raquo; 详情
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
                    <h3>{{$field->experiment_name}}</h3>
                </div>
                <div class="short_wrap">
                    <p>实验内容：{{$field->experiment_content}}</p>
                </div>
                <div class="short_wrap">
                    <p>实验资料：<a target="view_window" href="/storage/app/public/uploads/{{$field->experiment_document}}">查看</a></p>
                </div>
                <div class="short_wrap">
                    <p>提交人数：{{$data->count()}}</p>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">学号</th>
                        <th class="tc">姓名</th>
                        <th class="tc">提交文件</th>
                        <th class="tc">提交时间</th>
                        <th class="tc">得分</th>
                    </tr>

                @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            {{$v->student_id}}
                        </td>
                        <td class="tc">
                            {{$v->student_name}}
                        </td>
                        <td class="tc">
                            <a style="padding-left: 43%" href="{{url('admin/experiment/message/'.$v->id)}}">批改</a>
                        </td>
                        <td class="tc">
                            {{date("Y-m-d H:i",date($v->submit_time))}}
                        </td>
                        <td class="tc">
                            {{$v->mark}}
                        </td>
                    </tr>
                @endforeach
                </table>
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
            layer.confirm('您确定要删除这个实验吗？', {
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