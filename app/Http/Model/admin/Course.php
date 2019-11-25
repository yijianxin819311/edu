<?php

namespace App\Http\Model\admin;

use Illuminate\Database\Eloquent\Model;
/*
 * 课程
 * */
class Course extends Model
{

    protected $table = 'course';
    protected $primaryKey = 'cou_id';
    public $timestamps = false;
    //添加
    public static function create($data){
        $re=Course::insert($data);
        return $re;
    }
    //分页
    public static function index($where=[],$wheres=[]){
        $re=Course::where(['course.is_del'=>0])
            ->where($where)
            ->orWhere($wheres)
            ->join('category','course.cate_id','=','category.cate_id')
            ->select('course.*','category.cate_name')
            ->paginate(4);
        return $re;
    }
    //修改
    public static function update_cou($where,$data){
        $re=Course::where($where)->update($data);
        return $re;
    }
//查询一条
    public static function first($where){
        $re=Course::where($where)->first();
        return $re;
    }
    //删除
    public static function del($where){
        $re=Course::where($where)->update(['is_del'=>1]);
        return $re;
    }
    //查询全部
    public static function list($where=[]){
        $re=Course::where(['is_del'=>0])->where($where)->get();
        return $re;
    }
}
