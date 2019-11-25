<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Model\admin\Evaluate;
use App\Http\Model\admin\Category;
use Illuminate\Http\Request;
use DB;
/*
 * 评论模块
 * */
class EvaluateController extends Controller
{
    /*
     * 评论
     * */
    public function index_evaluate(Request $request){
        $cou_id = $request->input(['cou_id'])??'';
        $evaluate = Evaluate::index([['cou_id','=',$cou_id],['pid','=',0]]);

        return view('admin.evaluate.index_evaluate',['evaluate'=>$evaluate,'cou_id'=>$cou_id]);
    }
    /*
     * 删除
     * */
    public function del_evaluate(Request $request){
        $e_id = $request->input(['e_id'])??'';
        DB::beginTransaction();
        Evaluate::del(['pid'=>$e_id]);
        Evaluate::del(['e_id'=>$e_id]);
        $re=DB::commit();
        if($re==null){
            echo 1;die;
        }else{
            echo 2;die;
        }
    }
    /*
     * 详情
     * */
    public function list_evaluate(Request $request){
        $e_id=$request->input(['e_id'])??'';

        $list=Evaluate::list(['pid'=>$e_id])->toArray();
//        dd($list);
//        $data=Evaluate::list_evaluate($list,$e_id);
//        dd($data);
        return view('admin.evaluate.list_evaluate',['list'=>$list,'e_id'=>$e_id]);

    }
    /*
     * 回复评论
     * */
    public function add_evaluate(Request $request){
        $e_id = $request->input(['e_id']);

        return view('admin.evaluate.add_evaluate',['e_id'=>$e_id]);
    }
    public function add_evaluate_do(Request $request){
        $arr = $request->all();
        $u_id=session('lecturer_user_id');
        $re = Evaluate::add([
            'cou_id'=>0,
            'u_id'=>$u_id,
            'e_desc'=>$arr['e_desc'],
            'create_time'=>time(),
            'pid'=>$arr['e_id'],
        ]);
        if($re){
            echo "<script>history.go(-2)</script>";die;
        }else{
            echo "<script>alert('评论失败，请重新尝试');history.go(-1)</script>";die;
        }
    }
}
