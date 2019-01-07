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
                <div class="result_title">
                    <h3>讨论区</h3>
                </div>
                <div class="short_wrap">
                    <a href="{{url('admin/question/create')}}"><i class="fa fa-plus"></i>提问</a>
                    {{--<a href="{{url('admin/list/batchcreate')}}"><i class="fa fa-plus"></i>批量导入</a>--}}
                    {{--<a href="#" onclick="batchdel()"><i class="fa fa-recycle"></i>批量删除</a>--}}
                    {{--<a href="#"><i class="fa fa-refresh"></i>导出成绩单</a>--}}
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

    <div class="result_wrap">
        <ul class="tab_title">
            <li class="active">所有问题</li>
            <li>我的问题</li>
            <li>知识库</li>
        </ul>
        <div class="tab_content">
            <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
            <div>
                @foreach($data as $v)
                    <div class="tips">
                    <h3>{{$v->question_title}}</h3>
                    <ul>
                        <p>{!! $v->question_description !!}</p>
                        <a href="{{url('admin/studentnotice/content/'.$v->nid)}}" class="readmore">原文>></a>
                    </ul>
                    <p style="width: 15%" class="dateview"><span>{{date("Y-m-d H:i",date($v->question_time)) }}</span></p>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="tab_content">
            @foreach($mydata as $v)
                <div class="tips">
                    <h3>{{$v->question_title}}</h3>
                    <ul>
                        <p>{!! $v->question_description !!}</p>
                        <a href="{{url('admin/studentnotice/content/'.$v->nid)}}" class="readmore">原文>></a>
                    </ul>
                    <p style="width: 15%" class="dateview"><span>{{date("Y-m-d H:i",date($v->question_time)) }}</span></p>
                </div>
            @endforeach
        </div>
        <div class="tab_content">知识库</div>
        <br>

        <div class="tips">
            <h3>商品规格添加问题</h3>
            <p>1、规格分为通用规格和商品自定义规格，此处分析自定义规格</p>
            <p>2、添加尺寸：X XL XXL  颜色：红 黑（规格名称，规格属性）</p>
            <p>3、填充组合表，记录商品id</p>
            <p>4、点击提交 -> 添加商品表，返回goods_id -> 添加规格表，记录goods_id -> 添加属性值组合表，记录goods_id</p>
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
    {{--<script>--}}
        {{--function delCate(nid) {--}}
            {{--layer.confirm('您确定要删除这条公告吗？', {--}}
                {{--btn: ['确定','取消'] //按钮--}}
            {{--}, function(){--}}
                {{--$.post("{{url('admin/notice/')}}/"+nid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {--}}
                    {{--if(data.status==0){--}}
                        {{--layer.msg(data.msg, {icon: 6});--}}
                        {{--location.reload();--}}
                    {{--}else{--}}
                        {{--layer.msg(data.msg, {icon: 5});--}}
                    {{--}--}}
                {{--});--}}
{{--//            layer.msg('的确很重要', {icon: 1});--}}
            {{--}, function(){--}}

            {{--});--}}
        {{--}--}}
    {{--</script>--}}
@endsection