@extends('layout.teacheradmin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; <a href="{{url('admin/experiment')}}">平时实验</a> &raquo; <a href="{{url('admin/experiment/content/'.$document->experiment_id)}}">详情</a> &raquo; 批改
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>批改作业<br></h3>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    <form id="form" action="" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
    <div class="result_wrap">
            <table class="add_tab">
                <script type="text/javascript" src="{{asset('resources/org/media-master/jquery.media.js')}}"></script>
                <tbody>
                    <tr>
                        <td>
                            <a class="pdf" href="/storage/app/public/uploads/{{$document->document}}"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            得分：<input id="mark" type="text" class="form-control" name="mark">
                            @if($errors!=null)
                                <div class="mark">
                                    @if(is_object($errors))
                                        @foreach($errors->all() as $error)
                                            <p>{{$error}}</p>
                                        @endforeach
                                    @else
                                        <p>{{$errors}}</p>
                                    @endif
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="submit" type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
    </form>
    <script type="text/javascript">
        $(function() {
            $('.pdf').media({width:900, height:500});
        });
    </script>

@endsection