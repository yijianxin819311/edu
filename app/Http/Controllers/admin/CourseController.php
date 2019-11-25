<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Model\admin\Catalog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Model\admin\Category;
use App\Http\Model\admin\Lect;
use App\Http\Model\admin\Course;
/*
 * 课程管理模块
 * */
class CourseController extends Controller
{
    //课程分类视图
    public function add_category(Request $request){
        $data=Category::list(['pid'=>0])->toArray();
//        dd($data);
        $cate=Category::getCateInfo($data,0);
        return view('admin.course.add_category',['cate'=>$cate]);
    }
    //执行添加
    public function add_category_do(Request $request){
        $arr=$request->all();
        unset($arr['_token']);
        $res=Category::create($arr);
    if($res){
        return redirect('admin/add_category');
    }else{
        echo"<script>alert('添加失败,请重新添加');location.href='add_category';</script>";die;
    }

    }
    //课程列表
    public function index_category(Request $request){
        $cate_name=$request->input(['cate_name'])??'';
        $info=[];
        if(!empty($cate_name)){
            $name=$cate_name;
            $info=Category::index([['cate_name','like',"%{$cate_name}%"],['pid','=',0]]);
//            $cate['pid']=0;
        }else{
            $name='';
            $info=Category::index(['pid'=>0]);
        /*    foreach($data as $k=>$v){
                //一级菜单
                if($v['pid']==0) {
                    $info[] = $v;
                }
                    //二级菜单
                    foreach($data as $val){
                       if($val['pid']!=0){
                         if($v['cate_id']==$val['pid']){
                             $info[]=$val;
                         }
                       }
                    }
        }*/
        }
        return view('admin.course.index_category',['cate'=>$info,'cate_name'=>$name]);
    }
    /*
     * 查看详情
     * */
    public function list_category(Request $request){
        $cate_id=$request->input(['cate_id'])??'';
        $cate=Category::index(['pid'=>$cate_id]);
//        dd($cate);
        return view('admin.course.list_category',['cate'=>$cate,'cate_id'=>$cate_id]);
    }
    //编辑课程分类
    public function update_category(Request $request){
        $cate_id=$request->all();
        $list_cate=[];
        $cate=[];
        if($cate_id['cate_id'] != 0){

        $cate=Category::first(['cate_id'=>$cate_id['cate_id']]);
        if($cate['pid'] == 0){
            return view('admin.course.update_category_first',['cate'=>$cate]);
        }else{
            //讲师
            $lect=Lect::index();
         }
        }else{
            $cate['cate_id']=0;
            //讲师
            $lect=Lect::index();
            //课程分类
            $list_cate=Category::list([['pid','!=', 0]]);
        }
        return view('admin.course.update_category',['cate'=>$cate,'lect'=>$lect,'category'=>$list_cate]);
    }
    //ajax修改课程
    public function ajax_update(Request $request){
        $arr=$request->all();
        $data[$arr['fieid']]=$arr['value'];
        $res=Category::update_first(['cate_id'=>$arr['cate_id']],$data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //修改顶级分类
    public function update_category_first_do(Request $request){
        $arr=$request->all();
        unset($arr['_token']);
        $res=Category::update_first(['cate_id'=>$arr['cate_id']],$arr);
        if($res){
            return redirect('admin/index_category');
        }else{
            echo "<script>history.go(-1)</script>";
        }
    }
    //添加课程
    public function add_course(Request $request){
        $file = $request->file('img');
        if(empty($file)){
            echo"<script>alert('请上传图片');history.go(-1)</script>";die;
        }
        $arr=$request->all();
        unset($arr['img']);
        unset($arr['_token']);
        $lecturer_user_id = session('lecturer_user_id');
        if($lecturer_user_id == null){
            echo"<script>alert('请讲师登录');history.go(-1)</script>";die;
        }
        $arr['lecturer_user_id'] = $lecturer_user_id;
        $validatedData = $request->validate([
            'cate_id' => 'required',
            'cou_name' => 'required',
//            'Lect_id' => 'required',
            'cou_status' => 'required',
            'is_free' => 'required',
            'price' => 'required',
            'total_course_time' => 'required',
             'presentation' => 'required',
        ] ,['cou_name.required'=>'请填写课程名称',
//            'Lect_id.required'=>'请选择讲师',
            'cou_status.required'=>'请选择状态',
            'is_free.required'=>'请选择是否免费',
            'price.required'=>'价格不可为空',
            'total_course_time.required'=>'总课时不可为空',
            'presentation.required'=>'请填写课程介绍',
            'cate_id.required'=>'请选择课程分类',]);
        $time=date('Y-n-j');
        $path=$file->store('category/'.$time);
        $arr['img']=$path;
        $arr['create_time']=time();
        $res=Course::create($arr);
        if($res){
            return redirect('admin/index_course');
        }else{
            echo"<script>alert('提交失败，请重新提交');history.go(-1)</script>";die;
        }
    }

    //删除分类
    public function delete_category(Request $request){
        $cate_id=$request->input(['cate_id']);
        $count=Category::index(['pid'=>$cate_id])->count();
        if($count != 0){
            echo "<script>alert('该分类下有子类,请先删除子类');history.go(-1);</script>";die;
        }else{
            $res=Category::del(['cate_id'=>$cate_id]);
        }
        return redirect('admin/index_category');

    }
//课程列表
    public function index_course(Request $request){
        $data=$request->all()??'';
        $lecturer_user_id = session('lecturer_user_id');
        if($lecturer_user_id == null){
            echo"<script>alert('请讲师登录');history.go(-1)</script>";die;
        }
        $where[] = ['course.lecturer_user_id','=',$lecturer_user_id];
        $wheres = [];
        if(isset($data['is_free'])){
            $cou_name=$data['cou_name']??'';
            $is_free=$data['is_free']??'';
            $status=$data['cou_status']??'';

//      dump($cou_status);
            if(!empty($data['cou_name'])){
                $where=[
                    ['course.cou_name','like',"%{$data['cou_name']}%"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]
                ];
                $wheres=[
                    ['category.cate_name','like',"%{$data['cou_name']}%"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]
                ];
            }
            if(!empty($data['cou_name']) && $data['is_free']!=0 ){
                $where=[
                    ['course.is_free','=',"{$data['is_free']}"],
                    ['course.cou_name','like',"%{$data['cou_name']}%"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]

                ];
                $wheres=[
                    ['category.cate_name','like',"%{$data['cou_name']}%"],
                    ['course.is_free','=',"{$data['is_free']}"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]
                ];
            }elseif(!empty($data['cou_name']) && $data['cou_status']!=0){
                $where=[
                    ['course.cou_name','like',"%{$data['cou_name']}%"],
                    ['course.cou_status','=',"{$data['cou_status']}"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]
                ];
                $wheres=[
                    ['category.cate_name','like',"%{$data['cou_name']}%"],
                    ['course.cou_status','=',"{$data['cou_status']}"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]
                ];
            }elseif($data['is_free']!=0 && $data['cou_status']!=0){
                $where=[
                    ['course.is_free','=',"{$data['is_free']}"],
                    ['course.cou_status','=',"{$data['cou_status']}"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]
                ];
            }elseif($data['is_free']!=0 || $data['cou_status']!=0){
                $where=[
                    ['course.is_free','=',"{$data['is_free']}"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]
                ];
                $wheres=[
                    ['course.cou_status','=',"{$data['cou_status']}"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]
                ];
            }

            if($data['is_free']!=0 && $data['cou_status']!=0 && !empty($data['cou_name'])){
                $where=[
                    ['course.cou_name','like',"%{$data['cou_name']}%"],
                    ['course.is_free','=',"{$data['is_free']}"],
                    ['course.cou_status','=',"{$data['cou_status']}"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]
                ];
                $wheres=[
                    ['category.cate_name','like',"%{$data['cou_name']}%"],
                    ['course.is_free','=',"{$data['is_free']}"],
                    ['course.cou_status','=',"{$data['cou_status']}"],
                    ['course.lecturer_user_id','=',$lecturer_user_id]
                ];
            }
        }else{
            $cou_name='';$is_free='';$status='';
        }
        $course=Course::index($where,$wheres);
//            dd($course);
        $cou_status=['1'=>'未开始','2'=>'连载中','3'=>'已完结'];
        return view('admin.course.index_course',['course'=>$course,
            'cou_status'=>$cou_status,
            'url'=>env('APP_URL'),
            'cou_name'=>$cou_name,
            'is_free'=>$is_free,
            'status'=>$status
        ]);
    }
    //修改课程视图
    public function update_course(Request $request){
        $cou_id=$request->all()['cou_id']??'';
        $course=Course::first(['cou_id'=>$cou_id]);
        $category=Category::index([['pid' ,'!=', 0]]);
        $lect=Lect::index();
        //        dd($category);
        return view('admin.course.update_course',['course'=>$course,'category'=>$category,'lect'=>$lect,'url'=>env('APP_URL')]);
    }
    //修改课程
    public function update_course_do(Request $request){
        $arr=$request->all();
        unset($arr['_token']);
        unset($arr['img']);
        $lecturer_user_id = session('lecturer_user_id');
        if($lecturer_user_id == null){
            echo"<script>alert('请讲师登录');history.go(-1)</script>";die;
        }
        $arr['lecturer_user_id'] = $lecturer_user_id;
        $validatedData = $request->validate([
            'cate_id' => 'required',
            'cou_name' => 'required',
//            'Lect_id' => 'required',
            'cou_status' => 'required',
            'is_free' => 'required',
            'price' => 'required',
            'total_course_time' => 'required',
            'presentation' => 'required',
        ] ,['cou_name.required'=>'请填写课程名称',
//            'Lect_id.required'=>'请选择讲师',
            'cou_status.required'=>'请选择状态',
            'is_free.required'=>'请选择是否免费',
            'price.required'=>'价格不可为空',
            'total_course_time.required'=>'总课时不可为空',
            'presentation.required'=>'请填写课程介绍',
            'cate_id.required'=>'请选择课程分类',]);
        $file = $request->file('img');
        if(empty($file)){
            $course=Course::update_cou(['cou_id'=>$arr['cou_id']],$arr);
        }else{
            $time=date('Y-n-j');
            $path=$file->store('category/'.$time);
            $arr['img']=$path;
//            dd($arr[]);
            $course=Course::update_cou(['cou_id'=>$arr['cou_id']],$arr);
            if($course) {
                Storage::delete($request->input(['img']));
            }
        }
        if($course){

        return redirect("admin/index_course");
        }else{
            echo"<script>alert('修改失败，请重新提交');history.go(-1)</script>";die;
        }
    }
    //删除课程
    public function delete_course(Request $request){
        $cou_id=$request->input(['cou_id'])??'';
        $res=Course::del(['cou_id'=>$cou_id]);
        if($res){
            return redirect('admin/index_course');
        }else{
            echo"<script>alert('删除失败，请重新删除');history.go(-1)</script>";die;
        }
    }
}
