<?php

namespace App\Http\Model\admin;

use Illuminate\Database\Eloquent\Model;

/*
 * 回答模块
 * */
class Response extends Model
{
    protected $connection = 'mysql';
    protected $table = 'response';
    protected $primaryKey = 'r_id';
    public $timestamps = false;

    public static function index($where=[]){
        $re = Response::where(['response.is_del'=>0])
            ->where($where)
            ->join('lecturer_user','lecturer_user.lecturer_user_id','=','response.u_id')
            ->select('lecturer_user.name','response.*')
            ->paginate(5);
        return $re;
    }
    public static function add($data){
        //dd($data);
        $re = Response::insert($data);
        //dd($re);
        return $re;
    }
    public static function del($where){
        $re = Response::where($where)->update(['is_del'=>1]);
        return $re;
    }
    public static function get($where=[]){
        $re = Response::where($where)->get();
        return $re;
    }
}
