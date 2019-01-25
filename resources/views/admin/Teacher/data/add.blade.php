@extends('layout.teacheradmin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/teacherinfo')}}">首页</a> &raquo; <a href="{{url('admin/experiment')}}">平时实验</a> &raquo; 添加实验
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3><i class="fa fa-plus"></i>添加章节<br></h3>
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
        </div>
        {{--<div class="result_content">--}}
            {{--<div class="short_wrap">--}}
                {{--<a href="{{url('admin/list/create')}}"><i class="fa fa-plus"></i>新增学生</a>--}}
                {{--<a href="#"><i class="fa fa-refresh"></i>批量导入</a>--}}
                {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
                {{--<a href="#"><i class="fa fa-refresh"></i>导出成绩单</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/data')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>章节名称：</th>
                        <td>
                            <input type="text" class="sm" name="data_chapter">
                        </td>
                    </tr>
                    <tr>
                        <th width="120">所属章节名称：</th>
                        <td>
                            <select name="data_father_id">
                                <option value="0">==大章节==</option>
                                @foreach($data as $d)
                                    <option value="{{$d->did}}">{{$d->data_chapter}}</option>
                                @endforeach
                            </select>
                            <i class="fa fa-exclamation-circle yellow"></i>若大章节不用选择此框
                        </td>
                    </tr>
                    <tr>
                        <th>资料(可选)：</th>
                        <td>
                            <label for=""><input id="pdfChange" type="checkbox">课件（pdf）</label>
                            <label for=""><input id="videoChange" type="checkbox">视频（wmv、avi、mp4,视频必须小于100M）</label>
                        </td>
                    </tr>
                    <tr>
                        <th>选择文件：</th>
                        <td>
                            <input id="pdf" type="hidden" class="form-control" name="data_pdfpath" required>
                        </td>
                        <td>
                            <input id="video" type="hidden" class="form-control" name="data_videopath" required>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script>
        $(function () {
            $('#pdfChange').click(function () {
                if ($('#pdf').attr("type")=='hidden'){
                    $('#pdf').attr("type","file");
                }else{
                    $('#pdf').attr("type","hidden");
                }
            })
            $('#videoChange').click(function () {
                if ($('#video').attr("type")=='hidden'){
                    $('#video').attr("type","file");
                }else{
                    $('#video').attr("type","hidden");
                }
            })
            $('#video').change(function () {
                if($('#video')[0].files[0].size/(1024*1024)>100){
                    alert("文件必须小于100M!")
                    location.reload();
                }
            })
        })
    </script>

@endsection