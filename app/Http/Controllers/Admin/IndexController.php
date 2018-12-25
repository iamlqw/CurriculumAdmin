<?php

namespace App\Http\Controllers\Admin;

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
        $user = session('user')['user_name'];
       return view('admin.teacher.teacherindex')->with('user',$user);
    }
    public function studentindex()
    {
        return view('admin..student.studentindex');
    }
    public function teacherinfo()
    {
        $user = Teacher::where('tid',session('user')['user_name'])->get()->toArray();
//        dd($user[0]);
        return view('admin.Teacher.info')->with('user',$user[0]);
    }
    public function studentinfo()
    {
        return view('admin.Student.info');
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
