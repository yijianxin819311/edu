<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Model\admin\Response;
use Illuminate\Http\Request;

/*
 * 回答模块
 * */
class ResponseController extends Controller
{
    public function index(Request $request){
        $q_id = $request->input(['q_id'])??'';
        //dd($q_id);
        $response = Response::index();

        return view('admin.response.index_response',['response'=>$response,'q_id'=>$q_id]);
    }
    public function add(Request $request){
        $q_id = $request->input(['q_id'])??'';
        //dd($q_id);

        return view('admin.response.add_response',['q_id'=>$q_id]);
    }
    public function add_do(Request $request){
        //$q_id = $request->input(['q_id'])??'';
        $arr = $request->all()??'';
        //dd($arr);
        $u_id = session('lecturer_user_id');
        if(empty($u_id)){
            echo"<script>alert('请登录后添加');history.go(-1)</script>";die;
        }
        $validatedData = $request->validate([
            'q_id' => 'required',
            'r_content'=>'required',
        ] ,['q_id.required'=>'请填返回后重新添加',
            'r_content.required'=>'请填写问题内容',
        ]);
        $arr['u_id'] = $u_id;
        $arr['r_time'] = time();
        unset($arr['_token']);
        //dd($arr);
        $re = Response::insert(['q_id'=>$arr['q_id'],'u_id'=>$u_id,'r_content'=>$arr['r_content']]);
        //$re = Response::add($arr);
        dd($re);
        if($re){
            return redirect("admin/index_response?q_id={$arr['q_id']}");
        }else{
            echo"<script>alert('添加失败，请重新尝试');history.go(-1)</script>";die;
        }
    }
    public function delete(Request $request){
        $r_id = $request->input(['r_id'])??'';
        $re = Response::del(['r_id'=>$r_id]);
        if($re){
            echo 1;
        }else{
            echo 2;
        }
    }
}
