<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Student;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;

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
//批量上传页
    public function batchcreate()
    {
        $input=Input::except('_token');
        if($input!=null){
            //学生表上传
            $ext=$input['source']->getClientOriginalExtension();
            if($ext=='xlsx'||$ext=='xls'){
                $path = $input['source']->getRealPath();
                $filename = 'students.'.$ext;
                Storage::disk('public')->put($filename, file_get_contents($path));
            //excel读取
                if($ext=='xls'){
                    $filePath = 'storage/app/public/' . iconv('UTF-8', 'GBK', 'students') . '.xls';
                }else{
                    $filePath = 'storage/app/public/' . iconv('UTF-8', 'GBK', 'students') . '.xlsx';
                }
                $datas = [];
                Excel::load($filePath, function ($reader)use(&$datas) {
                    $datas = $reader->all()->toArray();
                });
            //入库
//                $errors = [];
//                $flag = true;
                foreach($datas[0] as $data){
                        //批量入库
                        $rules = [
                            'name' => 'required',
                            'sid' => 'required|digits:7',
                            'sex' => 'required',
                            'major' => 'required',
                            'class' => 'required',
                        ];
                        $massage = [
                            'name.required'=>'学生姓名不能为空!',
                            'sid.required'=>'学号不能为空!',
                            'sid.num'=>'学号必须为数字!',
                            'sex.required'=>'性别不能为空!',
                            'major.required'=>'专业不能为空!',
                            'class.required'=>'班级不能为空!',
                        ];
                        $validator = Validator::make($data,$rules,$massage);
                        if ($validator->passes()) {
                            if(Student::where('sid',$data['sid'])->get()->first()!=null){
//                                $errors[sid] = $data['sid'].'学号学生存在';
//                                $flag = flase;
//                                continue;
                                return back()->with('errors',$data['sid'].'学号学生存在');
                            }
                            $re = Student::create($data);
                            if ($re){
                                continue;
                            }else{
                                return back()->with('errors','数据未知错误');
                            }
                        } else {
                            return back()->withErrors($validator);
                        }
                }
//                if(flag==true){
                    return redirect('admin/list');
//                }else{
//                    return back()->withErrors($errors);
//                }
            }else{
                return back()->with('errors','文件格式不正确');
            }
        }else{
            return view('admin.teacher.list.batchadd');
        }
    }
    public function store()
    {
        $input = Input::except('_token');
            $rules = [
                'name' => 'required',
                'sid' => 'required|digits:7',
                'sex' => 'required',
                'major' => 'required',
                'class' => 'required',
            ];
            $massage = [
                'name.required'=>'学生姓名不能为空!',
                'sid.required'=>'学号不能为空!',
                'sid.digits'=>'学号规则不符!',
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
                    $insert=User::insert(['user_name'=>$input['sid'],'user_pass'=>Crypt::encrypt($input['sid']),'user_identity'=>'student']);
                    if($insert){
                        return redirect('admin/list');
                    }else{
                        return back()->with('errors','用户创建失败，该学生无法登陆，请删除该学生');
                    }
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
