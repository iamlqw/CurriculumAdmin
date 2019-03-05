@extends('layout.teacheradmin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; 教学课件
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
                    <a href="{{url('admin/data/create')}}"><i class="fa fa-plus"></i>添加模块</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">资料对应模块</th>
                        <th class="tc">教学资料</th>
                        <th class="tc">教学视频</th>
                        <th class="tc">操作</th>
                    </tr>

                    @foreach($data as $v)
                        <tr>
                            <td class="tc">
                                {{$v->_data_chapter}}
                            </td>
                            <td class="tc">
                                @if($v->data_pdfpath!=null)
                                    <a style="padding-left: 40%" target="view_window" href="/storage/app/public/uploads/{{$v->data_pdfpath}}">查看</a>
                                @endif
                            </td>
                            <td class="tc">
                                @if($v->data_videopath!=null)
                                    <a style="padding-left: 40%" href="{{url('admin/data/video/'.$v->did)}}">查看</a>
                                @endif
                            </td>
                            <td>
                                <a style="padding-left: 35%" href="{{url('admin/data/'.$v->did.'/edit')}}">修改</a>
                                <a href="#" onclick="delCate({{$v->did}})">删除</a>
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
        function delCate(did) {
            layer.confirm('您确定要删除这个模块吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/data/')}}/"+did,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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