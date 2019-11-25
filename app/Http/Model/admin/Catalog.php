<?php

namespace App\Http\Model\admin;

use Illuminate\Database\Eloquent\Model;

/*
 * 课程章节
 * */
class Catalog extends Model
{
    protected $table = 'catalog';
    protected $primaryKey = 'catalog_id';
    public $timestamps = false;

    /*
     * 添加
     * */
    public static function create($data){
        $re = Catalog::insert($data);
        return $re;
    }
    /*
     * 分页展示
     * */
    public static function index($where = [],$wheres = []){
        $re = Catalog::where('catalog.is_del',0)
            ->where($where)
            ->orwhere($wheres)
            ->join('course','course.cou_id','=','catalog.cou_id')
            ->select('catalog.*','course.cou_name')
            ->orderBy('course.cou_id')
            ->paginate(4);
        return $re;
    }
    /*
     * 删除
     * */
    public static function del($where){
        $re = Catalog::where($where)->update(['is_del' => 1]);
        return $re;
    }
    /*
     * 查询一条
     * */
    public static function first($where){
        $re = Catalog::where($where)->first();
        return $re;
    }
    /*
     * 修改
     * */
    public static function update_cata($where,$data){
        $re=Catalog::where($where)->update($data);
        return $re;
    }
}
