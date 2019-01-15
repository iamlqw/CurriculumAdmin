@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; 讨论区
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
            </div>
            <!--快捷导航 结束-->
        </div>

    <div class="result_wrap">
        <ul class="tab_title">
            <li class="active">未回答</li>
            <li>已回答</li>
            <li>知识库</li>
        </ul>
        <div class="tab_content">
            <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
            <div>
                @foreach($data as $v)
                    <div class="tips">
                        <h3>{{$v->question_title}}</h3>
                        <ul>
                            <p>{!! $v->question_content !!}</p>
                            <a href="#" onclick="delCate({{$v->qid}})"><i class="fa fa-recycle"></i>删除</a>
                            <a href="{{url('admin/answer/'.$v->qid.'/edit')}}" class="readmore">回答>></a>
                        </ul>
                        <p style="width: 30%" class="dateview">
                            <span>{{date("Y-m-d H:i",date($v->question_time)) }}</span>
                            <span>提问者：{{$v->question_sid}}</span>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab_content">
            <div>
            @foreach($ansdata as $v)
                <div class="tips">
                    <h3>{{$v->question_title}}</h3>
                    <ul>
                        <p>{!! $v->question_content !!}</p>
                        <a href="#" onclick="delCate({{$v->qid}})"><i class="fa fa-recycle"></i>删除</a>
                        <a href="#" onclick="inDatabase({{$v->qid}})"><i class="fa fa-plus"></i>入库</a>
                        <a href="{{url('admin/answer/content/'.$v->qid)}}" class="readmore">原文>></a>
                    </ul>
                    <p style="width: 30%" class="dateview">
                        <span>{{date("Y-m-d H:i",date($v->question_time)) }}</span>
                        <span>提问者：{{$v->question_sid}}</span>
                    </p>
                </div>
            @endforeach
            </div>
        </div>
        <div class="tab_content">
            <div>
            @foreach($kdata as $v)
                <div class="tips">
                    <h3>{{$v->question_title}}</h3>
                    <ul>
                        <p>{!! $v->question_content !!}</p>
                        <a href="#" onclick="delCate({{$v->qid}})"><i class="fa fa-recycle"></i>删除</a>
                        <a href="{{url('admin/answer/content/'.$v->qid)}}" class="readmore">原文>></a>
                    </ul>
                    <p style="width: 30%" class="dateview">
                        <span>{{date("Y-m-d H:i",date($v->question_time)) }}</span>
                        <span>提问者：{{$v->question_sid}}</span>
                    </p>
                </div>
            @endforeach
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
        function delCate(qid) {
            layer.confirm('您确定要删除这个问题吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/answer/')}}/"+qid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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
        function inDatabase(qid){
            layer.confirm('您确定要这个问题入库吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/answer/intodatabase/')}}/"+qid,{'_token':"{{csrf_token()}}"},function (data) {
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