<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Model\admin\Note;
use Illuminate\Http\Request;

/*
 * 笔记模块
 * */
class NoteController extends Controller
{
    /*
     * 展示
     * */
    public function index(Request $request){
        $cou_id = $request->input(['cou_id'])??'';
        $note = Note::index(['note.cou_id'=>$cou_id]);
//        dd($note);
        return view('admin.note.index_note',['note'=>$note,'cou_id'=>$cou_id]);
    }
    /*
     * 删除
     * */
    public function delete(Request $request){
        $note_id=$request->input(['note_id']);
        $re=Note::del(['note_id'=>$note_id]);
        if($re){
            echo 1;die;
        }else{
            echo 2;
        }
    }
    /*
     * 添加
     * */
    public function add(Request $request){
        $cou_id = $request->input(['cou_id'])??'';

        return view('admin.note.add_note',['cou_id'=>$cou_id]);
    }
    public function add_do(Request $request){
        $arr = $request->all()??'';
        $arr['lecturer_user_id'] = session('lecturer_user_id');
        $validatedData = $request->validate([
            'cou_id' => 'required',
            'note_desc' => 'required',
        ] ,['cou_id.required'=>'无法查询此课程，请返回重新添加',
            'note_desc.required'=>'请填写笔记内容',
            ]);
        $arr['create_time'] = time();
        unset($arr['_token']);
        $re = Note::add($arr);
        if($re){
            return redirect("admin/index_note?cou_id={$arr['cou_id']}");
        }else{
            echo "<script>alert('添加失败，请重新尝试');history.go(-1)</script>";die;
        }
    }
    /*
     * 修改
     * */
    public function update(Request $request){
        $note_id = $request->input(['note_id'])??'';
        $note = Note::first(['note_id'=>$note_id]);
        return view('admin.note.update_note',['note'=>$note]);
    }
    public function update_do(Request $request){
        $arr = $request->all()??'';
        $validatedData = $request->validate([
            'note_desc' => 'required',
        ] ,['note_desc.required'=>'请填写笔记内容',]);
        $re = Note::update_note(['note_id'=>$arr['note_id']],['note_desc'=>$arr['note_desc']]);
        if($re){
            return redirect("admin/index_note?cou_id={$arr['cou_id']}");
        }else{
            echo "<script>alert('修改失败，请重新尝试');history.go(-1)</script>";die;
        }
    }
}
