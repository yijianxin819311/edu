<?php

namespace App\Http\Model\admin;

use Illuminate\Database\Eloquent\Model;

/*
 * 回答
 * */
class Questions extends Model
{
    protected $connection = 'mysql';
    protected $table = 'questions';
    protected $primaryKey = 'q_id';
    public $timestamps = false;

    public static function index($where=[]){
        $re = Questions::where(['questions.is_del'=>0])
            ->where($where)
            ->join('lecturer_user','lecturer_user.lecturer_user_id','=','questions.u_id')
            ->select('lecturer_user.name','questions.*')
            ->paginate(5);
        return $re;
    }
    public static function add($data){
        $re = Questions::insert($data);
        return $re;
    }
    public static function first($where){
        $re = Questions::where($where)->first();
        return $re;
    }
    public static function update_q($where,$data){
        $re = Questions::where($where)->update($data);
        return $re;
    }
    public static function del($where){
        $re = Questions::where($where)->update(['is_del'=>1]);
        return $re;
    }

}
