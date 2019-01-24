@extends('layout.teacheradmin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; <a href="{{url('admin/experiment')}}">平时实验</a> &raquo; 查看成绩单
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
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">学生姓名</th>
                        <th class="tc">学号</th>
                        <th class="tc">性别</th>
                        <th class="tc">专业</th>
                        <th class="tc">班级</th>
                    @foreach($experiment as $v)
                        <th class="tc">{{$v->experiment_name}}成绩</th>
                    @endforeach

                    </tr>

                @foreach($student as $v)
                    <tr>
                        <td class="tc">
                            {{$v->name}}
                        </td>
                        <td class="tc">
                            {{$v->sid}}
                        </td>
                        <td class="tc">
                            {{$v->sex==0?'男':'女'}}
                        </td >
                        <td class="tc">
                            {{$v->major}}
                        </td>
                        <td class="tc">
                            {{$v->class}}
                        </td>
                        @for($i=0;$i<($experiment->count());$i++)
                            @foreach($mark as $w)
                                @if($w->student_id==$v->sid&&$experiment->get($i)->eid==$w->experiment_id)
                                    <td class="tc">{{$w->mark}}</td>
                                @endif
                            @endforeach
                        @endfor
                    </tr>
                @endforeach
                </table>

                {{--<div class="page_list">--}}
                    {{--{{$data->links()}}--}}
                {{--</div>--}}
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
        function delCate(sid) {
            layer.confirm('您确定要删除这个学生吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/list/')}}/"+sid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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
        function batchdel(){
            if($("input[name='row']:checked").size()==0){
                layer.confirm('未选择任何学生。')
            }else{
                layer.confirm('您确定要删除这些学生吗？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $("input[name='row']:checked").each(function() { // 遍历选中的checkbox
                        sid = $(this).attr('value');  // 获取checkbox所在行的顺序
                        $.post("{{url('admin/list/')}}/"+sid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                            if(data.status==0){
                                layer.msg(data.msg, {icon: 6});
                            }else{
                                layer.msg(data.msg, {icon: 5});
                            }
                        });
//            layer.msg('的确很重要', {icon: 1});
                    }, function(){});
                    location.reload();
                    // $("table#test_table").find("tr:eq("+n+")").remove();
                });
            }
        }
    </script>
@endsection