<?php

namespace App\Http\Model\admin;

use Illuminate\Database\Eloquent\Model;

/*
 * 讲师
 * */
class Lect extends Model
{
    protected $connection = 'mysql';
    protected $table = 'lect';
    protected $primaryKey = 'lect_id';
    public $timestamps = false;
//查询
    public static function index($where=[]){
        $re=Lect::where($where)->get();
        return $re;
    }
}
