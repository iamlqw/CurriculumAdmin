<?php


namespace App\Http\Controllers;

use App\Http\Model\Student;
use App\Http\Model\Teacher;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class TestController extends Controller{
    public function index()
    {
//        $pdo = DB::connection()->getpdo();
//        dd($pdo);
//        $pass = Crypt::encrypt('123456');
//        echo $pass;
//        $teacher = Teacher::all();
//        dd($teacher);
        $student = Student::all();
        dd($student);
    }
}