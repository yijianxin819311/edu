<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Admin\Category;
use DB;

class ExamController extends Controller
{
    public function exam_add()
    {
        return view('/admin/info/exam_add');
    }
    public function exam_add_do(Request $request)
    {
        $data=$request->all();
        //dd($data);
        $res=DB::table('exam')->insert([
            'exam_title'=>$data['exam_title'],
            'exam_content'=>$data['exam_content'],
            'exam_time'=>time()
        ]);
       //dd($res);
        if($res){
            echo json_encode(['code' => 200, 'msg' => '添加成功'], JSON_UNESCAPED_UNICODE);
        }
    }
    public function exam_del(Request $request)
    {
        $exam_id=$request->all()['exam_id'];
        //dd($exam_id);
        $re=DB::table('exam')->select('is_del')->where(['exam_id'=>$exam_id])->first();
        if($re->is_del==1){
            $data=DB::table('exam')->where(['exam_id'=>$exam_id])->update(['is_del'=>2]);
        }
        if($data){
            echo json_encode(['code' => 200, 'msg' => '删除成功']);

        }
    }
    public function exam_list(Request $request)
    {
        $res=DB::table('exam')->where(['is_del'=>1])->get()->toArray();
        return view('/admin/info/exam_list',['res'=>$res]);
    }
    public function exam_edit(Request $request)
    {
        $exam_id=$request->input('exam_id');
        //dd($exam_id);
        $data=DB::table('exam')->where(['exam_id'=>$exam_id])->first();
        return view('/admin/info/exam_edit',['data'=>$data]);

    }
    public function exam_update(Request $request)
    {
        $data=$request->all();
//        dd($data);
        unset($data['_token']);
        //dd($data);
        $res=DB::table('exam')->where(['exam_id'=>$data['exam_id']])->update($data);
        //dd($res);
        if($res){
            return redirect('exam/exam_list');
        }else{
            echo "<script>alert('修改失败'),location.href='exam_list'</script>";
        }
    }
}
