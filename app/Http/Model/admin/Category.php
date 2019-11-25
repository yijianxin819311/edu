<?php

namespace App\Http\Model\admin;

use DemeterChain\C;
use Illuminate\Database\Eloquent\Model;

/*
 * 课程分类
 * */
class Category extends Model
{
//    protected $connection="mysql";
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
//添加
    public static function create($data){
        $res=Category::insert($data);
        return 1;
 }
 //展示
    public static function index($where=[]){
        $re=Category::where(['is_del'=>0])->where($where)->paginate(5);//
        return $re;
    }
//无限极分类
   public static function getCateInfo($cateInfo,$pid,$level=1){
        static $info=[];
        foreach($cateInfo as $k=>$v){
            if($v['pid']==$pid){
                $v['level']=$level;
                $info[]=$v;
               Category::getCateInfo($cateInfo,$v['cate_id'],$level+1);
            }
        }
        return $info;
    }
    //查询一条
    public static function first($where=[]){
        $re=Category::where($where)->first();
        return $re;
    }
    //修改
    public static function update_first($where=[],$data=[]){
        $re=Category::where($where)->update($data);
        return $re;
  }
  //删除
  public static function del($where){
        $re=Category::where($where)->update(['is_del'=>1]);
        return $re;
  }
  public static function list($where=[]){
      $re=Category::where(['is_del'=>0])->where($where)->get();//
      return $re;
  }
}
