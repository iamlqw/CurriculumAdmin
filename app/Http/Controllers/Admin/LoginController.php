<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    //登录
    public function login()
    {
        if($input = Input::all()){
            $code = new \Code;
            $_code = $code->get();
            if (strtoupper($input['code'])!=$_code){
                return back()->with('msg','验证码错误');
            }
            $user = User::first();
            if ($user->user_name!=$input['user_name']||Crypt::decrypt($user->user_pass)!=$input['user_pass']){
                return back()->with('msg','用户名或密码错误');
            }
            session(['user'=>$user]);
//            dd(session('user')->user_name);
            if (session('user')->user_identity=='student'){
                return redirect('admin/studentindex');
            }else{
                return redirect('admin/teacherindex');
            }
        }else{
            session(['user'=>null]);
            return view('admin.login');
        }
    }
    //退出
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }
    //验证码生成
    public function code()
    {
        $code = new \Code;
        $code->make();
    }
    //
}
