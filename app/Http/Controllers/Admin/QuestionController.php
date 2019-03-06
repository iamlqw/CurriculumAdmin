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
       $data = Question::where('question_isanswer','已回答')->orderBy('question_time','dsc')->paginate(10000);

       $mydata = Question::where('question_sid',session('user')['user_name'])->orderBy('question_time','dsc')->paginate(10000);

       $kdata = Question::where('question_isimportant','已入库')->orderBy('question_time','dsc')->paginate(10000);

        Question::where('question_isread',0)->where('question_isanswer','已回答')->update(['question_isread'=>1]);

        return view('admin.student.question.list',compact('data','mydata','kdata'));
    }

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
        $input['question_isread'] = 0;
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
            return back()->withErrors($validator)->withInput();
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
