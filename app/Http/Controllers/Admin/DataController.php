<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Data;
use App\Http\Model\Student;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;

class DataController extends CommonController
{
    //get.admin/data
    public function index()
    {
        $data = (new Data)->tree();
        return view('admin.teacher.data.list',compact('data'));
    }

    public function studentindex()
    {
        $data = Data::all();
        return view('admin.student.data.list',compact('data'));
    }

//
    public function create()
    {
        $data = Data::where('data_father_id',0)->get();
        return view('admin.teacher.data.add',compact('data'));
    }

    public function store()
    {
        $input = Input::except('_token', 'data_pdfpath','data_videopath');
        $rules = [
            'data_chapter' => 'required',
            'data_father_id' => 'required',
        ];
        $massage = [
            'data_chapter.required' => '章节名称不能为空!',
            'data_father_id.required' => '父章节不能为空!',
        ];
        $validator = Validator::make($input, $rules, $massage);
        if ($validator->passes()) {
            $pdf = Input::file('data_pdfpath');
            if ($pdf!=null){
                if ($pdf->isValid()) {
                    $ext = $pdf->getClientOriginalExtension();//文件后缀
                    if ($ext == 'pdf') {
                        $newname = $input['data_chapter'] . '.' . $ext;//重组文件名
                        $pdf->move(base_path() . '/storage/app/public/uploads/data/pdf/', $newname);//写入
                        $input['data_pdfpath'] = 'data/pdf/' . $newname;
                    } else {
                        return back()->with('errors', '课件请上传pdf格式文件');
                    }
                }
            }
            $video = Input::file('data_videopath');
            if ($video!=null){
                if ($video->isValid()) {
                    $ext = $video->getClientOriginalExtension();//文件后缀
                    if ($ext == 'mp4') {
                        $newname = $input['data_chapter'] . '.' . $ext;//重组文件名
                        $video->move(base_path() . '/storage/app/public/uploads/data/video/', $newname);//写入
                        $input['data_videopath'] = 'data/video/' . $newname;
                    } else {
                        return back()->with('errors', '视频请上传mp4格式文件');
                    }
                }else{
                    return back()->with('errors', '文件必须小于100M');
                }
            }
            Data::create($input);
            return redirect('admin/data');
        } else {
            return back()->withErrors($validator);
        }
    }

    public function edit($did)
    {
        $field = Data::find($did);
        $data = Data::where('data_father_id',0)->get();
        return view('admin.teacher.data.edit',compact('field','data'));
    }
//
    public function update($did)
    {
        $input = Input::except('_token','_method','data_pdfpath','data_videopath');
        $rules = [
            'data_chapter' => 'required',
            'data_father_id' => 'required',
        ];
        $massage = [
            'data_chapter.required' => '章节名称不能为空!',
            'data_father_id.required' => '父章节不能为空!',
        ];
        $validator = Validator::make($input, $rules, $massage);
        if ($validator->passes()) {
            $pdf = Input::file('data_pdfpath');
            if ($pdf!=null){
                if ($pdf->isValid()) {
                    $ext = $pdf->getClientOriginalExtension();//文件后缀
                    if ($ext == 'pdf') {
                        $newname = $input['data_chapter'] . '.' . $ext;//重组文件名
                        $pdf->move(base_path() . '/storage/app/public/uploads/data/pdf/', $newname);//写入
                        $input['data_pdfpath'] = 'data/pdf/' . $newname;
                    } else {
                        return back()->with('errors', '请上传pdf格式文件');
                    }
                }
            }
            $video = Input::file('data_videopath');
            if ($video!=null){
                if ($video->isValid()) {
                    $ext = $video->getClientOriginalExtension();//文件后缀
                    if ($ext == 'mp4') {
                        $newname = $input['data_chapter'] . '.' . $ext;//重组文件名
                        $video->move(base_path() . '/storage/app/public/uploads/data/video/', $newname);//写入
                        $input['data_videopath'] = 'data/video/' . $newname;
                    } else {
                        return back()->with('errors', '请上传mp4格式文件');
                    }
                }else{
                    return back()->with('errors', '文件必须小于100M');
                }
            }
            Data::where('did',$did)->update($input);
            return redirect('admin/data');
        } else {
            return back()->withErrors($validator);
        }
    }

    public function destroy($did)
    {
        $deldata = Data::where('did',$did)->get()->toArray();
        $re1 = true;
        $re2 = true;
        if($deldata[0]['data_pdfpath']){
            $re1 = Storage::disk('uploads')->delete($deldata[0]['data_pdfpath']);
        }
        if($deldata[0]['data_videopath']){
            $re2 = Storage::disk('uploads')->delete($deldata[0]['data_videopath']);
        }
        $re3 = data::where('did',$did)->delete($did);
        if ($re1&&$re2&&$re3){
            $data = [
                'status' => 0,
                'msg' => '成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '失败'
            ];
        }
        return $data;
    }

    public function video($did)
    {
        $field = Data::find($did);
        return view('admin.teacher.data.video',compact('field'));
    }
}
