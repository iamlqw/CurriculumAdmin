<?php


namespace App\Http\Controllers;

use App\Http\Model\Student;
use App\Http\Model\Teacher;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Excel;

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
    }
}