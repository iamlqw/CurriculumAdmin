<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Notice;
use App\Http\Model\Category;
use App\Http\Model\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class QuestionController extends CommonController
{
    public function index()
    {
       $data = Question::orderBy('question_sid','asc')->paginate(5);

       $mydata = Question::where('question_sid',session('user')['user_name'])->orderBy('question_sid','asc')->paginate(5);
//       dd($data);
        return view('admin.student.question.list',compact('data','mydata'));
    }
//    public function studentindex()
//    {
//        $data = Notice::orderBy('nid','asc')->paginate(5)->with('data',$data);
////       dd($data);
//        return view('admin.student.notice.list')->with('data',$data);
//    }
//
//get admin/question/create
    public function create()
    {
        return view('admin.student.question.add');
    }
//post admin/question
    public function store()
    {
        $input = Input::except('_token');
        $input['question_time'] = time();
        $input['question_sid'] = session('user')['user_name'];
        $rules = [
            'question_title' => 'required',
            'question_content' => 'required'
        ];
        $massage = [
            'question_title.required'=>'标题不能为空',
            'question_content.required'=>'问题内容不能为空',
        ];
        $validator = Validator::make($input,$rules,$massage);
        if ($validator->passes()) {
            $re = Question::create($input);
            if ($re){
                return redirect('admin/question');
            }else{
                return back()->with('errors','数据未知错误');
            }
        } else {
            return back()->withErrors($validator);
        }
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
//    public function destroy($nid)
//    {
//        $re = Notice::where('nid',$nid)->delete($nid);
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
//    //
//    public function content($nid)
//    {
//        if ($nid<1){
//            return back();
//        }else{
//            $field = Notice::find($nid);
//            if ($field){
//                return view('admin.teacher.notice.content',compact('field'));
//            }else{
//                return back();
//            }
//        }
//    }
//    public function studentcontent($nid)
//    {
//        if ($nid<1){
//            return back();
//        }else{
//            $field = Notice::find($nid);
//            if ($field){
//                return view('admin.student.notice.content',compact('field'));
//            }else{
//                return back();
//            }
//        }
//    }
}
