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
use function PHPSTORM_META\type;

class ExperimentController extends CommonController
{
    //GET admin/answer
    public function index()
    {
       $data = Experiment::orderBy('eid','asc')->paginate(5);
        return view('admin.teacher.experiment.list')->with('data',$data);
    }

//
//get admin/answer/create
    public function create()
    {
        return view('admin.teacher.experiment.add');
    }
//post admin/answer
    public function store()
    {
        $input = Input::except('_token','experiment_document');
        $input['experiment_starttime'] = time();
        $rules = [
            'experiment_name' => 'required',
            'experiment_content' => 'required',
            'experiment_endtime' => 'required',
        ];
        $massage = [
            'experiment_name.required'=>'实验题目不能为空',
            'experiment_content.required'=>'实验要求不能为空',
            'experiment_endtime'=>'实验截止日期不能为空',
        ];
        $validator = Validator::make($input,$rules,$massage);
        if ($validator->passes()) {
            $file = Input::file('experiment_document');
            if($file->isValid()){
                $ext = $file->getClientOriginalExtension();//文件后缀
                if($ext=='pdf'){
                    $newname = $input['experiment_name'].'.'.$ext;//重组文件名
                    $path = $file->move(base_path().'/storage/app/public/uploads/experiment/experimentName/',$newname);//写入
                    $input['experiment_document'] = 'experiment/experimentName/'.$newname;
                }else{
                    return back()->with('errors','请上传pdf形式文件');
                }
            }else{
                return back()->with('errors','文件必须小于100M');
            }
            $input['experiment_endtime'] = strtotime($input['experiment_endtime']);
            $re = Experiment::create($input);
            if ($re){
                return redirect('admin/experiment');
            }else{
                return back()->with('errors','数据未知错误');
            }
        } else {
            return back()->withErrors($validator);
        }
    }
//GET /admin/answer/{photo}/edit
    public function edit($eid)
    {
        $field = Experiment::find($eid);
        return view('admin.Teacher.experiment.edit',compact('field'));
    }
//PUT/PATCH admin/answer/{photo}
    public function update($eid)
    {
        $input = Input::except('_token','experiment_document','_method');
        $input['experiment_starttime'] = time();
        $rules = [
            'experiment_name' => 'required',
            'experiment_content' => 'required',
            'experiment_endtime' => 'required',
        ];
        $massage = [
            'experiment_name.required'=>'实验题目不能为空',
            'experiment_content.required'=>'实验要求不能为空',
            'experiment_endtime'=>'实验截止日期不能为空',
        ];
        $validator = Validator::make($input,$rules,$massage);
        if ($validator->passes()) {
            $file = Input::file('experiment_document');
            if($file){
                if ($file->isValid()) {
                    $ext = $file->getClientOriginalExtension();//文件后缀
                    if($ext=='pdf'){
                        $newname = $input['experiment_name'] . '.' . $ext;//重组文件名
                        $path = $file->move(base_path() .'/storage/app/public/uploads/experiment/experimentName/', $newname);//写入
                        $input['experiment_document'] = 'experiment/experimentName/'.$newname;
                    }else{
                        return back()->with('errors','请上传pdf形式文件');
                    }
                } else {
                    return back()->with('errors', '文件必须小于100M');
                }
            }
            $input['experiment_endtime'] = strtotime($input['experiment_endtime']);
            $re = Experiment::where('eid',$eid)->update($input);
            if ($re) {
                return redirect('admin/experiment');
            } else {
                return back()->with('errors', '数据未知错误');
            }
        }else {
            return back()->withErrors($validator);
        }
    }

    public function destroy($eid)
    {
        $deldata = Experiment::where('eid',$eid)->get()->toArray();
        $re2=Storage::disk('uploads')->delete($deldata[0]['experiment_document']);
        $re1 = Experiment::where('eid',$eid)->delete($eid);
        $delreport = Mark::where('experiment_id',$eid)->get();
        foreach ($delreport as $v){
            Storage::disk('uploads')->delete($v->document);
        }
        $re3 = Mark::where('experiment_id',$eid)->delete();
        if ($re1&&$re2&&$re3){
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
// 展示页
    public function content($eid)
    {
        $field = Experiment::find($eid);
        $data = Mark::where('experiment_id',$eid)->get();
        if ($field&&$data){
            return view('admin.teacher.experiment.content',compact('field','data'));
        }else{
            return back()->with('errors', '数据未知错误');
        }
    }

    public function report()
    {
        $experiment = Experiment::all();
        $mark = Mark::all();
        $student = Student::all();
        return view('admin.teacher.experiment.report',compact('experiment','mark','student'));
    }

    public function message($id)
    {
        $input = Input::except('_token');
        $document = Mark::find($id);
        if ($input == null){
            return view('admin.teacher.experiment.message', compact('document'));
        }else{
            if($input['mark']>=0&&$input['mark']<=100){
                Mark::where('id', $id)->update($input);
                return redirect('admin/experiment/content/' . $document->experiment_id);
            }else{
                return back()->with('errors', '分数必须在0-100之间');
            };
        }
    }
}
