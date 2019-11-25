<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Model\Admin\Questions;
use App\Http\Model\Admin\Response;
/*
 * 问题模块
 * */
class QuestionsController extends Controller
{
        public function index(Request $request){
            $cou_id = $request->input(['cou_id'])??'';
            $questions = Questions::index(['questions.cou_id'=>$cou_id]);

            return view('admin.questions.index_questions',['questions'=>$questions,'cou_id'=>$cou_id]);
        }
        public function add(Request $request){
            $cou_id = $request->input(['cou_id']);

            return view('admin.questions.add_questions',['cou_id'=>$cou_id]);
        }
    public function add_do(Request $request){
        $arr = $request->all();
        $u_id = session('lecturer_user_id');
        if(empty($u_id)){
            echo"<script>alert('请登录后添加');history.go(-1)</script>";die;
        }
        $validatedData = $request->validate([
            'cou_id' => 'required',
            'q_title'=>'required',
            'q_content'=>'required',
        ] ,['cou_id.required'=>'请填返回后重新添加',
            'q_title.required'=>'请填写问题标题',
            'q_content.required'=>'请填写问题内容',
            ]);
            $arr['u_id'] = $u_id;
            $arr['q_time'] = time();
            unset($arr['_token']);
            $re = Questions::add($arr);
            if($re){
               return redirect("admin/index_questions?cou_id={$arr["cou_id"]}");
            }else{
                echo"<script>alert('添加失败，请重试');history.go(-1)</script>";die;
            }
    }
    public function del(Request $request){
            $q_id = $request->input(['q_id'])??'';
            DB::beginTransaction();
            Response::del(['q_id'=>$q_id]);
            $re = Questions::del(['q_id'=>$q_id]);
            if($re){
                DB::commit();
                echo 1;
            }else{
                echo 2;
                DB::rollBack();
        }
//            $response = Response::get(['q_id'=>$q_id])->toArray();
//            if(!empty($response)){
//
//            }
//            dd($response);
    }
    public function update(Request $request){
        $q_id = $request->input(['q_id']);
        $questions = Questions::first(['q_id'=>$q_id]);

        return view('admin.questions.update_questions',['questions'=>$questions]);
    }
    public function update_do(Request $request){
        $arr = $request->all();
        $u_id = session('lecturer_user_id');
        if(empty($u_id)){
            echo"<script>alert('请登录后修改');history.go(-1)</script>";die;
        }
        $validatedData = $request->validate([
            'q_id' => 'required',
            'q_title'=>'required',
            'q_content'=>'required',
        ] ,['q_id.required'=>'请填返回后重新添加',
            'q_title.required'=>'请填写问题标题',
            'q_content.required'=>'请填写问题内容',
        ]);

        $re = Questions::update_q(['q_id'=>$arr['q_id']],['q_title'=>$arr['q_title'],'q_content'=>$arr['q_content']]);
//       dd($re);
        if($re){
            return redirect("admin/index_questions?cou_id={$arr["cou_id"]}");
        }else{
            echo"<script>alert('修改失败，请重试');history.go(-1)</script>";die;
        }
}
}
