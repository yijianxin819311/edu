<?php

namespace App\Http\Model\admin;

use Illuminate\Database\Eloquent\Model;

/*
 * 笔记模块
 * */
class Note extends Model
{
    protected $connection = 'mysql';
    protected $table = 'note';
    protected $primaryKey = 'note_id';
    public $timestamps = false;

    public static function index($where=[]){
        $re = Note::where(['note.is_del'=>0])
            ->where($where)
            ->join('lecturer_user','lecturer_user.lecturer_user_id','=','note.lecturer_user_id')
            ->join('course','course.cou_id','=','note.cou_id')
            ->select('note.*','lecturer_user.name','course.cou_name')
            ->paginate(6);
        return $re;
    }
    /*
     * 查询单条
     * */
    public static function first($where){
        $re = Note::where($where)->first();
        return $re;
    }
    /*
     * 删除
     * */
    public static function del($where){
        $re = Note::where($where)->update(['is_del'=>1]);
        return $re;
    }
    /*
     * 添加
     * */
    public static function add($data){
        $re = Note::insert($data);
        return $re;
    }
    /*
     * 修改
     * */
    public static function update_note($where,$data)
    {
        $re = Note::where($where)->update($data);
        return $re;
    }
}
