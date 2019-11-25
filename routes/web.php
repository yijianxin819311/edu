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


//-------------------------admin------------------------------------------------------------
/**************************************** 后台登录 *************************************/
//登录视图
Route::any('/admin/login','admin\LoginController@login');
Route::any('/admin/loginHandel','admin\LoginController@loginHandel');
Route::any('/admin/out_session','admin\LoginController@out_session');//退出登录

//后台框架
Route::get('/admin/common', function () {
    return view('/admin/common');
});
Route::group(['middleware' => ['login']], function () {

//个人中心
//讲师展示
Route::any('/admin/last/lecturerIndex','admin\LecturerController@lecturerIndex');
//讲师软删除
Route::any('/admin/last/del/{lect_id}','admin\LecturerController@del');
//编辑讲师视图
Route::any('/admin/lecturer/lectEdit','admin\LecturerController@lectEdit');
//编辑讲师
Route::any('/admin/lecturer/lectUpdate','admin\LecturerController@lectUpdate');
//作业试图
Route::any('/admin/last/jobAdd','admin\LecturerController@jobAdd');
//添加作业
Route::any('/admin/last/jobAddHandel','admin\LecturerController@jobAddHandel');
//作业展示
Route::any('/admin/last/jobIndex','admin\LecturerController@jobIndex');
//作业软删除
Route::any('/admin/last/delete/{job_id}','admin\LecturerController@delete');
//编辑作业视图
Route::any('/admin/job/edit','admin\LecturerController@edit');
//编辑作业
Route::any('/admin/job/update','admin\LecturerController@update');
//课程管理模块
//添加课程
Route::any('/admin/add_category', 'admin\CourseController@add_category');//添加分类视图
Route::post('/admin/add_category_do', 'admin\CourseController@add_category_do');//执行添加
Route::any('/admin/index_category', 'admin\CourseController@index_category');//展示分类
Route::any('/admin/list_category', 'admin\CourseController@list_category');//分类详情
Route::any('/admin/update_category', 'admin\CourseController@update_category');//修改分类视图
Route::post('/admin/ajax_update', 'admin\CourseController@ajax_update');//ajax修改分类
Route::any('/admin/delete_category', 'admin\CourseController@delete_category');//删除分类
Route::post('/admin/update_category_first_do', 'admin\CourseController@update_category_first_do');//修改一级分类
Route::post('/admin/add_course', 'admin\CourseController@add_course');//添加课程
Route::any('/admin/index_course', 'admin\CourseController@index_course');//展示课程
Route::any('/admin/update_course', 'admin\CourseController@update_course');//修改课程视图
Route::post('/admin/update_course_do', 'admin\CourseController@update_course_do');//执行修改
Route::get('/admin/delete_course', 'admin\CourseController@delete_course');//删除课程
//章节
Route::get('/admin/add_catalog', 'admin\CatalogController@add_catalog');//添加视图
Route::get('/admin/index_catalog', 'admin\CatalogController@index_catalog');//展示
Route::post('/admin/add_catalog_do', 'admin\CatalogController@add_catalog_do');//执行添加
Route::get('/admin/del_catalog', 'admin\CatalogController@del_catalog');//删除
Route::get('/admin/update_catalog', 'admin\CatalogController@update_catalog');//修改视图
Route::post('/admin/update_catalog_do', 'admin\CatalogController@update_catalog_do');//修改视图
//评论
Route::get('/admin/index_evaluate', 'admin\EvaluateController@index_evaluate');//评论视图
Route::get('/admin/del_evaluate', 'admin\EvaluateController@del_evaluate');//删除评论
Route::get('/admin/list_evaluate', 'admin\EvaluateController@list_evaluate');//评论详情
Route::get('/admin/add_evaluate', 'admin\EvaluateController@add_evaluate');//回复评论视图
Route::post('/admin/add_evaluate_do', 'admin\EvaluateController@add_evaluate_do');//回复评论

//笔记
Route::get('/admin/index_note', 'admin\NoteController@index');//笔记列表
Route::get('/admin/add_note', 'admin\NoteController@add');//添加笔记
Route::post('/admin/add_note_do', 'admin\NoteController@add_do');//添加笔记
Route::get('/admin/del_note', 'admin\NoteController@delete');//添加笔记
Route::get('/admin/update_note', 'admin\NoteController@update');//修改笔记
Route::post('/admin/update_note_do', 'admin\NoteController@update_do');//执行修改

//收藏
Route::get('/admin/index_collect', 'admin\CollectController@index');//收藏展示
Route::get('/admin/list_collect', 'admin\CollectController@list');//收藏详情
//资讯
Route::any('info/info_add','admin\InfoController@info_add');//资讯添加页面
Route::any('info/info_add_do','admin\InfoController@info_add_do');//资讯添加执行
Route::any('info/info_list','admin\InfoController@info_list');//资讯列表
Route::any('info/info_del','admin\InfoController@info_del');//资讯删除
Route::any('info/info_edit','admin\InfoController@info_edit');//资讯修改
Route::any('info/info_update','admin\InfoController@info_update');//资讯修改
//考试
Route::any('exam/exam_add','admin\ExamController@exam_add');//考试添加
Route::any('exam/exam_add_do','admin\ExamController@exam_add_do');//考试添加执行
Route::any('exam/exam_list','admin\ExamController@exam_list');//考试列表
Route::any('exam/exam_del','admin\ExamController@exam_del');//考试删除
Route::any('exam/exam_edit','admin\ExamController@exam_edit');//考试修改
Route::any('exam/exam_update','admin\ExamController@exam_update');//考试修改执行
//活动
Route::any('info/activity_add','admin\InfoController@activity_add');//活动添加页面
Route::any('info/activity_add_do','admin\InfoController@activity_add_do');//活动添加执行
Route::any('info/activity_list','admin\InfoController@activity_list');//活动列表
//题库
Route::any('info/bank','admin\InfoController@bank');//题库添加
Route::any('info/bank_add','admin\InfoController@bank_add');//题库添加执行
Route::any('info/bank_list','admin\InfoController@bank_list');//题库列表
Route::any('info/del','admin\InfoController@del');//题库删除
Route::any('info/bank_edit','admin\InfoController@bank_edit');//题库修改该视图
Route::any('info/bank_update','admin\InfoController@bank_update');//题库修改该
Route::any('info/bank_xiang','admin\InfoController@bank_xiang');//题库详情
Route::any('info/bank_xiang_edit','admin\InfoController@bank_xiang_edit');//题库详情修改视图
Route::any('info/bank_xiang_update','admin\InfoController@bank_xiang_update');//题库详情修改
//问答模块
Route::get('admin/index_questions','admin\QuestionsController@index');//问题展示
Route::get('admin/add_questions','admin\QuestionsController@add');//问题展示
Route::post('admin/add_questions_do','admin\QuestionsController@add_do');//问题展示
Route::get('admin/del_questions','admin\QuestionsController@del');//问题删除
Route::get('admin/update_questions','admin\QuestionsController@update');//修改视图
Route::post('admin/update_questions_do','admin\QuestionsController@update_do');//问题修改
//回答模块
Route::get('admin/index_response','admin\ResponseController@index');//回答展示
Route::get('admin/add_response','admin\ResponseController@add');//回答添加
Route::post('admin/add_response_do','admin\ResponseController@add_do');//回答添加
Route::get('admin/del_response','admin\ResponseController@delete');//删除

});


//---------------------------Index---------------------------------------------------------
