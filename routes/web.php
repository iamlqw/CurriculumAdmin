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
//Route::any('admin/login', 'Admin\LoginController@login');
//Route::get('admin/code', 'Admin\LoginController@code');
//Route::get('admin/index', 'Admin\IndexController@index');
//Route::get('admin/info', 'Admin\IndexController@info');
Route::group(['middleware'=>['web']],function (){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::any('admin/login', 'Admin\LoginController@login');
    Route::get('admin/code', 'Admin\LoginController@code');
    Route::get('/test', 'TestController@index');
});

Route::group(['middleware'=>['web','student.login'],'prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('studentindex', 'IndexController@studentindex');
    Route::get('studentinfo', 'IndexController@studentinfo');
    Route::get('studentquit', 'LoginController@quit');
    Route::any('studentpass', 'IndexController@pass');
//
//    Route::post('cate/changeorder', 'ListController@changeOrder');
//    Route::resource('category', 'ListController');
//
//    Route::resource('article', 'ArticleController');
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
Route::group(['middleware'=>['web','teacher.login'],'prefix'=>'admin','namespace'=>'Admin'],function () {
    Route::get('teacherindex', 'IndexController@teacherindex');
    Route::get('teacherinfo', 'IndexController@teacherinfo');
    Route::get('teacherquit', 'LoginController@quit');
    Route::any('teacherpass', 'IndexController@pass');
    Route::any('list/batchcreate', 'ListController@batchcreate');
    Route::resource('list', 'ListController');
});