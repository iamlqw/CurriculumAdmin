<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Experiment;
use App\Http\Model\Mark;
use App\Http\Model\Notice;
use App\Http\Model\Category;
use App\Http\Model\Question;
use App\Http\Model\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeworkController extends CommonController
{
    //GET admin/answer
    public function index()
    {
       $data = Experiment::all()->toArray();
       $time = time();

           for($i=0;$i<count($data,0);$i++){
               $submit = Mark::where('experiment_id',$data[$i]['eid'])->where('student_id',session('user')['user_name'])->first();
               if($time<$data) {
                   if ($submit != null) {
                       $submit = $submit->toArray();
                       $re = Storage::disk('uploads')->exists($submit['document']);
                       if (count($submit, 0) != 0 && $re == true) {
                           $data[$i]['submit'] = '已提交';
                           $data[$i]['document'] = $submit['document'];
                       } else {
                           $data[$i]['submit'] = '未提交';
                       }
                   } else {
                       $data[$i]['submit'] = '未提交';
                   }
               } else {
                   $data[$i]['submit'] = '已过期';
               }
           }
        return view('admin.student.homework.list',compact('data'));
    }
// 提交作业
    public function submit($eid)
    {
        $input=Input::except('_token');
        $data = Experiment::all();
//
        if($input!=null) {
            if ($input['source']->isValid()) {
                $ext = $input['source']->getClientOriginalExtension();//文件后缀
                if ($ext == 'pdf') {
                    $experiment = Experiment::where('eid', $eid)->get()->toArray();//取出实验名
                    $student = Student::where('sid', session('user')['user_name'])->get()->toArray();
                    $newname = session('user')['user_name'] . $experiment[0]['experiment_name'] . '.' . $ext;//重组文件名
                    $path = $input['source']->move(base_path() . '/storage/app/public/uploads/experiment/experimentReport/', $newname);//写入
                    Mark::where('document', 'experiment/experimentReport/' . $newname)->delete();
                    $mark['document'] = 'experiment/experimentReport/' . $newname;
                    $mark['student_id'] = session('user')['user_name'];
                    $mark['experiment_id'] = $eid;
                    $mark['student_name'] = $student[0]['name'];
                    $mark['submit_time'] = time();
                    Mark::create($mark);
                    return redirect('admin/homework');
                } else {
                    return back()->with('errors', '请上传pdf形式文件');
                }
            } else {
                return back()->with('errors', '文件必须小于100M');
            }
        }else{
            return view('admin.student.homework.submit');
        }
    }

}
