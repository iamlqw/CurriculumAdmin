<?php


namespace App\Http\Controllers;

use App\Http\Model\Experiment;
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
        $deldata = Experiment::where('eid',11)->get()->toArray();
        $re2=Storage::disk('uploads')->delete($deldata[0]['experiment_document']);
        dd($re2);
    }
}