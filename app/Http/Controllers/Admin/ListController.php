<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Student;
use App\Http\Model\teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ListController extends CommonController
{
    //get.admin/list
    public function index()
    {
        $student = Student::all();
        return view('admin.teacher.list.list')->with('data',$student);
    }

//    public function changeOrder()
//    {
//        $input = Input::all();
//        $cate = teacher::find($input['cate_id']);
//        $cate->cate_order = $input['cate_order'];
//        $re = $cate->update();
//        if ($re){
//            $data = [
//                'status'=>0,
//                'msg'=>'成功',
//            ];
//        }else{
//            $data = [
//                'status'=>1,
//                'msg'=>'失败',
//            ];
//        }
//        return $data;
//
//    }
//
    public function create()
    {
        return view('admin.teacher.list.add');
    }
//
    public function store()
    {
        $input = Input::except('_token');
            $rules = [
                'name' => 'required',
                'sid' => 'required',
                'sex' => 'required',
                'major' => 'required',
                'class' => 'required',
            ];
            $massage = [
                'name.required'=>'学生姓名不能为空!',
                'sid.required'=>'学号不能为空!',
                'sex.required'=>'性别不能为空!',
                'major.required'=>'专业不能为空!',
                'class.required'=>'班级不能为空!',
            ];
            $validator = Validator::make($input,$rules,$massage);
            if ($validator->passes()) {
                if(Student::where('sid',$input['sid'])->get()->first()!=null){
                    return back()->with('errors','该学号学生存在');
                }
                $re = Student::create($input);
                if ($re){
                    return redirect('admin/list');
                }else{
                    return back()->with('errors','数据未知错误');
                }
            } else {
                return back()->withErrors($validator);
            }

    }

    public function edit($sid)
    {
        $field = Student::find($sid);
        return view('admin.teacher.list.edit',compact('field'));
    }
//
    public function update($sid)
    {
        $input = Input::except('_token','_method');
        $re = Student::where('sid',$sid)->update($input);
        if($re){
            return redirect("admin/list");
        }else{
            return back()->with('errors','数据未知错误');
        }
    }

    public function destroy($sid)
    {
        $re = Student::where('sid',$sid)->delete($sid);
        if ($re){
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
//
//    public function show()
//    {
//
//    }






    //
}
