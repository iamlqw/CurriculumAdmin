<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', 'TestController@index');


    Route::get('/', function () {
        return view('welcome');
    });
    Route::any('admin/login', 'Admin\LoginController@login');
    Route::get('admin/code', 'Admin\LoginController@code');
    Route::get('/test', 'TestController@index');

/**
 * 学生组
 */
Route::group(['middleware'=>['student.login'],'prefix'=>'admin','namespace'=>'Admin'],function (){
    //基本操作
    Route::get('studentindex', 'IndexController@studentindex');
    Route::get('studentinfo', 'IndexController@studentinfo');
    Route::get('studentquit', 'LoginController@quit');
    Route::any('studentpass', 'IndexController@pass');
    //公告
    Route::any('studentnotice', 'NoticeController@studentindex');
    Route::any('studentnotice/content/{nid}', 'NoticeController@studentcontent');
    //提问
    Route::resource('question', 'QuestionController');
    Route::any('question/content/{nid}', 'QuestionController@studentquestion');
//
//    Route::post('cate/changeorder', 'ListController@changeOrder');
//    Route::resource('category', 'ListController');
//
//    Route::resource('article', 'NoticeController');
//
//    Route::resource('links', 'LinksController');
//    Route::post('links/changeorder', 'LinksController@changeOrder');
//
//    Route::resource('navs', 'NavsController');
//    Route::post('navs/changeorder', 'navsController@changeOrder');
//
//    Route::resource('config', 'ConfigController');
//    Route::post('config/changeorder', 'ConfigController@changeOrder');
//    Route::post('config/changecontent', 'ConfigController@changeContent');
//
//    Route::any('upload', 'CommonController@upload');
});
/**
 * 教师组
 */
Route::group(['middleware'=>['teacher.login'],'prefix'=>'admin','namespace'=>'Admin'],function () {
    //基本操作
    Route::get('teacherindex', 'IndexController@teacherindex');
    Route::get('teacherinfo', 'IndexController@teacherinfo');
    Route::get('teacherquit', 'LoginController@quit');
    Route::any('teacherpass', 'IndexController@pass');
    //学生导入
    Route::any('list/batchcreate', 'ListController@batchcreate');
    Route::resource('list', 'ListController');
    //公告
    Route::any('notice/content/{nid}', 'NoticeController@content');
    Route::resource('notice', 'NoticeController');
    //回答问题
    Route::resource('answer', 'AnswerController');
    Route::any('answer/content/{qid}', 'AnswerController@content');
    Route::any('answer/intodatabase/{qid}', 'AnswerController@intodatabase');
    //实验
    Route::resource('experiment', 'ExperimentController');
});