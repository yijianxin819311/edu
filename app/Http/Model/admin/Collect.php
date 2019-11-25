<?php

namespace App\Http\Model\admin;

use Illuminate\Database\Eloquent\Model;
use DB;
/*
 * 收藏夹
 * */
class Collect extends Model
{
    protected $connection="mysql";
    protected $table = 'collect';
    protected $primaryKey = 'collect_id';
    public $timestamps = false;
/*
 * 收藏展示
 * */
    public static function index($where=[]){
        $re=Collect::where($where)
            ->join('lecturer_user','lecturer_user.lecturer_user_id','collect.u_id')
            ->select('collect.*','lecturer_user.name')
            ->orderBy('collect.u_id')
            ->paginate(6);
        return $re;
    }
    /*
     * 展示详情
     * */
    public static function list_index($where=[]){
        $re=DB::connection('mysql')->table('collect_r')->where(['collect_r.is_del'=>0])
            ->where($where)
            ->join('course','course.cou_id','=','collect_r.cou_id')
//            ->join('lecturer_user','lecturer_user.lectrer_user_id','collect_r.u_id')
            ->select('collect_r.*','course.cou_name')
            ->paginate(5);
        return $re;
    }
}
