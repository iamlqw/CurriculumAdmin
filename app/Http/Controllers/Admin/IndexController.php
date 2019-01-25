<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Information;
use App\Http\Model\Student;
use App\Http\Model\Teacher;
use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function teacherindex()
    {
//        $newnotice = false;
//        $newanswer = false;
//        $new = false;
        $user = session('user')['user_name'];
       return view('admin.teacher.teacherindex')->with('user',$user);
    }

    public function studentindex()
    {
        $user = session('user')['user_name'];
        return view('admin.student.studentindex')->with('user',$user);
    }

    public function teacherinfo()
    {
        $user = Teacher::find(session('user')['user_name']);
        $info = Information::all();
        return view('admin.Teacher.info',compact('user','info'));
    }

    public function create()
    {
        return view('admin.teacher.add');
    }

    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'information_name' => 'required',
            'information_value' => 'required',
        ];
        $massage = [
            'information_name.required'=>'信息名称不能为空',
            'information_value.required'=>'信息不能为空',
        ];
        $validator = Validator::make($input,$rules,$massage);
        if ($validator->passes()) {
            $re = Information::create($input);
            if ($re){
                return redirect('admin/teacherinfo');
            }else{
                return back()->with('errors','数据未知错误');
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    public function studentinfo()
    {
        $user = Student::find(session('user')['user_name']);
        $info = Information::all();
        return view('admin.Student.info',compact('user','info'));
    }

    public function pass()
    {
        if ($input = Input::all()) {
            $rules = [
                'password' => 'required|between:6,20|confirmed',
            ];
            $massage = [
              'password.required'=>'新密码不能为空',
              'password.between'=>'新密码必须在6-20位之间',
                'password.confirmed'=>'新密码和确认密码不一致',
            ];
            $validator = Validator::make($input,$rules,$massage);
        if ($validator->passes()) {
            $user = User::first();
            $_password = Crypt::decrypt($user->user_pass);
            if ($input['password_o']==$_password){
                $user->user_pass = Crypt::encrypt($input['password']);
                $user->update();
                return back()->with('errors','密码修改成功');
            }else{
                return back()->with('errors','原密码错误');
            }
        } else {
            return back()->withErrors($validator);
        }
        }else{
            return view('admin.pass');
        }
    }
}
