<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Notice;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NoticeController extends CommonController
{
    public function index()
    {
       $data = Notice::orderBy('nid','asc')->paginate(10);
//       dd($data);
        return view('admin.teacher.notice.list')->with('data',$data);
    }

    //get admin/notice/create
    public function create()
    {
        return view('admin.teacher.notice.add');
//        $data = (new Category)->tree();
//        return view('admin.article.add',compact('data'));
    }
    //post admin/notice
    public function store()
    {
        $input = Input::except('_token');
        $input['notice_time'] = time();

        $rules = [
            'notice_title' => 'required',
            'notice_content' => 'required'
        ];
        $massage = [
            'notice_title.required'=>'文章名称不能为空',
            'notice_content.required'=>'文章内容不能为空'
        ];
        $validator = Validator::make($input,$rules,$massage);
        if ($validator->passes()) {
            $re = Notice::create($input);
            if ($re){
                return redirect('admin/notice');
            }else{
                return back()->with('errors','数据未知错误');
            }
        } else {
            return back()->withErrors($validator);
        }
//        $re = Notice::create($input);
    }
//
//    public function edit($art_id)
//    {
//        $data = (new Category)->tree();
//        $field = Notice::find($art_id);
//        return view('admin.article.edit',compact('data','field'));
//    }
//
//    public function update($art_id)
//    {
//        $input = Input::except('_token','_method');
//        $re = Notice::where('art_id',$art_id)->update($input);
//        if($re){
//            return redirect("admin/article");
//        }else{
//            return back()->with('errors','数据未知错误');
//        }
//
//    }
//
//    public function destroy($art_id)
//    {
//        $re = Notice::where('art_id',$art_id)->delete($art_id);
//        if ($re){
//            $data = [
//                'status' => 0,
//                'msg' => '成功'
//            ];
//        }else{
//            $data = [
//                'status' => 1,
//                'msg' => '失败'
//            ];
//        }
//        return $data;
//    }
    //
}
