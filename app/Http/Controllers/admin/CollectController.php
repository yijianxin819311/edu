<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\admin\Collect;
/*
 * 收藏模块
 * */
class CollectController extends Controller
{
    public function index(Request $request){
        $u_name=$request->input(['u_name'])??'';
        $where=[];
        if(!empty($u_name)){
            $where=[
                ['lecturer_user.name','like',"{$u_name}%"]
            ];
        }
        $collect=Collect::index($where);

        return view('admin.collect.index_collect',['collect'=>$collect,'u_name'=>$u_name]);
    }
    public function list(Request $request){
        $c_id=$request->input(['c_id'])??'';
        $cou_name=$request->input(['cou_name'])??'';
        $where=[];
        if(!empty($cou_name)){
            $where=[
                ['collect_r.collect_id','=',$c_id],
                ['course.cou_name','like',"{$cou_name}%"]
            ];
        }else{
//            dd(3);
            $where=[
                ['collect_r.collect_id','=',$c_id],
            ];
        }
//        dump($c_id);
        $collect_r=Collect::list_index($where);
//        dd($collect_r);
        return view('admin.collect.list_collect',['collect_r'=>$collect_r,'c_id'=>$c_id,'cou_name'=>$cou_name]);
    }
}
