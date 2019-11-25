<?php

namespace App\Http\Model\admin;

use Illuminate\Database\Eloquent\Model;

/*
 * 评论表
 * */
class Evaluate extends Model
{
    protected $table = 'evaluate';
    protected $primaryKey = 'e_id';
    public $timestamps = false;

    public static function index($where=[]){
        $re=Evaluate::where(['is_del'=>0,'pid'=>0])->where($where)
            ->join('lecturer_user','lecturer_user.lecturer_user_id','=','evaluate.u_id')
            ->select('evaluate.*','lecturer_user.name','lecturer_user.status')
            ->paginate(5);
        return $re;
    }
    public static function del($where){
        $re=Evaluate::where($where)->update(['is_del'=>1]);
        return $re;
    }
    public static function list($where=[]){
        $re=Evaluate::where(['is_del'=>0])->where($where)
            ->join('lecturer_user','lecturer_user.lecturer_user_id','=','evaluate.u_id')
            ->select('evaluate.*','lecturer_user.name','lecturer_user.status')
            ->get();
        return $re;
    }
    /*
     * 详情
     * */
    public static function list_evaluate($Info,$pid,$level=1){
        static $info=[];
        foreach($Info as $k=>$v){
            if($v['pid']==$pid){
                $v['level']=$level;
                $info[]=$v;
                Evaluate::list_evaluate($Info,$v['e_id'],$level+1);
            }
        }
        return $info;
    }
    /*
     * 添加
     * */
    public static function add($data){
        $re=Evaluate::insert($data);
        return $re;
    }
}
