<?php


namespace App\Http\Controllers;

use App\Http\Model\Data;
use App\Http\Model\Experiment;
use App\Http\Model\Mark;
use App\Http\Model\Student;
use App\Http\Model\Teacher;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller{
    public function index()
    {
//        $cellData = [
//            ['学号','姓名','年龄','成绩','名次'],
//            ['10001','林',19,100,1],
//            ['10001','林',19,100,1],
//            ['10001','林',19,100,1],
//            ['10001','林',19,100,1],
//            ['10001','林',19,100,1],
//        ];
//        Excel::create("学生成绩",function ($excel) use ($cellData){
//            $excel->sheet('score',function ($sheet) use ($cellData) {
//                $sheet->rows($cellData);
//            });
//        })->export('xls');
//        $pdo = DB::connection()->getpdo();
//        dd($pdo);
//        $pass = Crypt::encrypt('123456');
//        echo $pass;
//        $teacher = Teacher::all();
//        dd($teacher);
//        $student = Student::all();
//        dd($student);
//        dd(Experiment::all());
//        $re2 = Storage::disk('uploads')->delete('a.txt');
//        $deldata = Experiment::where('eid',11)->get()->toArray();
//        $re2=Storage::disk('uploads')->delete($deldata[0]['experiment_document']);
//        dd($re2);
//                $mark = Mark::all();
//        dd($mark);
//            $student = Student::all()->toArray();
//            $i=1;
//            foreach ($student as $v){
////                $input['id'] = $i;
//                $input['student_id'] = $v['sid'];
//                $input['experiment_id'] = 17;
//                $input['student_name'] = $v['name'];
//                $input['mark'] = rand(60,100);
//                $input['submit_time'] = time();
//                Mark::create($input);
//                $i++;
//            }
//        $data = Data::all();
//        dd($data);
//        $deldata = Data::where('did',1)->get()->toArray();
//        dd($deldata);
//        $delreport = Mark::where('experiment_id',17)->get();
//        foreach ($delreport as $v){
//            Storage::disk('uploads')->delete($v->document);
//        }
        User::insert(['user_name'=>1234567,'user_pass'=>Crypt::encrypt(1234567),'user_identity'=>'teacher']);

    }
}