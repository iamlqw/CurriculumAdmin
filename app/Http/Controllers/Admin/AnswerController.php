<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Notice;
use App\Http\Model\Category;
use App\Http\Model\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AnswerController extends CommonController
{
    //GET admin/answer
    public function index()
    {
       $data = Question::where('question_isanswer','未回答')->orderBy('question_sid','asc')->paginate(5);

       $ansdata = Question::where('question_sid',session('user')['user_name'])->orderBy('question_sid','asc')->paginate(5);

       $kdata = Question::where('question_isimportant','已入库')->orderBy('question_sid','asc')->paginate(5);

        return view('admin.teacher.answer.list',compact('data','ansdata','kdata'));
    }

//
//get admin/answer/create
//    public function create()
//    {
//        return view('admin.student.question.add');
//    }
//post admin/answer
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
//GET /admin/answer/{photo}/edit
    public function edit($qid)
    {
        $field = Question::find($qid);
        return view('admin.Teacher.answer.edit',compact('field'));
    }
//PUT/PATCH admin/answer/{photo}
    public function update($qid)
    {
        $input = Input::except('_token','_method');
        $input['question_isanswer'] = '已回答';
        $rules = [
            'question_title' => 'required',
            'question_content' => 'required',
            'question_answer' => 'required'
        ];
        $massage = [
            'question_title.required'=>'标题不能为空',
            'question_content.required'=>'问题内容不能为空',
            'question_answer.required'=>'问题回答不能为空',
        ];
        $validator = Validator::make($input,$rules,$massage);
        if ($validator->passes()) {
            $re = Question::where('qid', $qid)->update($input);
            if ($re) {
                return redirect("admin/answer");
            } else {
                return back()->with('errors', '数据未知错误');
            }
        }
    }
//
    public function destroy($qid)
    {
        $re = Question::where('qid',$qid)->delete($qid);
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
//    //
    public function content($qid)
    {
        if ($qid<1){
            return back();
        }else{

            $field = Question::find($qid);
            if ($field){
                return view('admin.teacher.answer.content',compact('field'));
            }else{
                return back();
            }
        }
    }
    public function studentquestion($qid)
    {
        if ($qid<1){
            return back();
        }else{
            $field = question::find($qid);
            if ($field){
                return view('admin.student.question.content',compact('field'));
            }else{
                return back();
            }
        }
    }
}
