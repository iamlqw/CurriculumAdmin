@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; 学生信息
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	{{--<div class="search_wrap">--}}
        {{--<form action="" method="post">--}}
            {{--<table class="search_tab">--}}
                {{--<tr>--}}
                    {{--<th width="120">选择分类:</th>--}}
                    {{--<td>--}}
                        {{--<select onchange="javascript:location.href=this.value;">--}}
                            {{--<option value="">全部</option>--}}
                            {{--<option value="http://www.baidu.com">百度</option>--}}
                            {{--<option value="http://www.sina.com">新浪</option>--}}
                        {{--</select>--}}
                    {{--</td>--}}
                    {{--<th width="70">关键字:</th>--}}
                    {{--<td><input type="text" name="keywords" placeholder="关键字"></td>--}}
                    {{--<td><input type="submit" name="sub" value="查询"></td>--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</form>--}}
    {{--</div>--}}
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
                    <a href="{{url('admin/list/create')}}"><i class="fa fa-plus"></i>新增学生</a>
                    <a href="{{url('admin/list/batchcreate')}}"><i class="fa fa-plus"></i>批量导入</a>
                    <a href="#" onclick="batchdel()"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>导出成绩单</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox" name="checkbox"></th>
                        <th class="tc">学生姓名</th>
                        <th class="tc">学号</th>
                        <th class="tc">性别</th>
                        <th>专业</th>
                        <th>班级</th>
                        <th>实验一成绩</th>
                        <th>实验二成绩</th>
                        <th>实验三成绩</th>
                        <th>实验四成绩</th>
                        <th>操作</th>
                    </tr>

                @foreach($data as $v)
                    <tr>
                        <td class="tc"><input type="checkbox" name="row" value="{{$v->sid}}"></td>
                        <td class="tc">
                            {{$v->name}}
                        </td>
                        <td class="tc">
                            {{$v->sid}}
                        </td>
                        <td class="tc">
                            {{$v->sex==0?'男':'女'}}
                        </td>
                        <td>
                            {{$v->major}}
                        </td>
                        <td>
                            {{$v->class}}
                        </td>
                        <td>2</td>
                        <td>admin</td>
                        <td>2014-03-15 21:11:01</td>
                        <td></td>
                        <td>
                            <a href="{{url('admin/list/'.$v->sid.'/edit')}}">修改</a>
                            <a href="#" onclick="delCate({{$v->sid}})">删除</a>
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
        // function selectAll(){
        //     if(this.checked){
        //         $("input[name='row']").prop("checked", true);
        //     }else{
        //         $("input[name='row']").prop("checked", false);
        //     }
        // }
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