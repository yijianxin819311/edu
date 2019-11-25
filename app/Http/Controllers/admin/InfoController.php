<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Model\Admin\Info;
class InfoController extends Controller
{
    public function info_add()
    {
        return view('/admin/info/info_add');
    }
    public function info_add_do(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $res=DB::table('information')->insert([
            'infor_title'=>$data['infor_title'],
            'infor_content'=>$data['infor_content'],
            'infor_time'=>time()
            ]);

       if($res){
           echo json_encode(['code'=>200,'msg'=>'添加成功']);
       }
    }
    public function info_list(Request $request)
    {
        $name=$request->input('name')??'';
        //var_dump($name);die;
        $where = [];
        if(isset($name)){
            $where[]=[
                'infor_title','like',"%$name%",
            ];
        }

        $res=DB::table('information')->where($where)->where(['is_del'=>1])->paginate(2);
        return view('/admin/info/info_list',['res'=>$res,'name'=>$name]);
    }
    public function info_del(Request $request)
    {
        $infor_id=$request->all()['infor_id'];
//        dd($infor_id);
        $re=DB::table('information')->select('is_del')->where(['infor_id'=>$infor_id])->first();
        if($re->is_del==1){
            $data=DB::table('information')->where(['infor_id'=>$infor_id])->update(['is_del'=>2]);
        }
        if($data){
            echo json_encode(['code' => 200, 'msg' => '删除成功']);die;
        }else{
            echo json_encode(['code' => 202, 'msg' => '删除失败']);die;
        }
    }
    public function info_edit(Request $request)
    {
        $infor_id=$request->all()['infor_id'];
        //dd($q_id);
        $data=DB::table('information')->where(['infor_id'=>$infor_id])->first();
        return view('/admin/info/info_edit',['data'=>$data]);
    }
    public function info_update(Request $request)
    {
        $data=$request->all();
        //dd($data);
        unset($data['_token']);
        //dd($data);
        $res=DB::table('information')->where(['infor_id'=>$data['infor_id']])->update($data);
        //dd($res);
        if($res){
            return redirect('info/info_list');
        }else{
            echo "<script>alert('修改失败'),location.href='info_list'</script>";
        }
    }
    public function activity_add()
    {
        return view('/admin/info/activity_add');
    }
    public function activity_add_do(Request $request)
    {
        $data=$request->all();
        //dd($data);
        $res=DB::table('activity')->insert([
            'act_title'=>$data['act_title'],
            'act_content'=>$data['act_content'],
            'act_time'=>time()
        ]);

        if($res){
            echo json_encode(['code'=>200,'msg'=>'添加成功']);
        }
    }
    public function activity_list(Request $request)
    {
        $name=$request->input('name')??'';
        //var_dump($name);die;
        $where=[];

        if(isset($name)){
            $where[]=[
                'act_title','like',"%$name%",
            ];
        }

        $res=DB::table('activity')->where($where)->paginate(2);
        return view('/admin/info/activity_list',['res'=>$res,'name'=>$name]);
    }
    //题库页面
    public function bank(Request $request)
    {
        $cate_id = $request->input(['cate_id']);
        //dd($cate_id);
        return view('/admin/info/bank',['cate_id'=>$cate_id]);
    }
    //题库添加执行
    public function bank_add(Request $request)
    {
        $req = $request->all();
        dd($req);
        if($req['type'] == 1){
            $tex=implode($req['tex'],'|');
            $pro_text=implode($req['pro_text'],'|');
            $data=DB::table('bank_problem')->insert([
                "pro_text"=> $pro_text,
                "tex"=>$tex,
                "problem"=>$req['problem'],
                "add_time"=>time(),
                "type"=>$req['type'],
                'cate_id'=>1
            ]);
        }elseif($req['type'] == 2){
            $pro_text='';
            foreach ($req['pro_text'] as $v){
                $pro_text.=$v.'|';
            }
            $tex='';
            foreach ($req['tex'] as $v){
                $tex.=$v.'|';
            }
            $data=DB::table('bank_problem')->insert([
                "pro_text"=> $pro_text,
                "tex"=>$tex,
                "problem"=>$req['problem'],
                "add_time"=>time(),
                 "type"=>$req['type'],
                'cate_id'=>1
            ]);
        }elseif($req['type'] == 3){
            $data=DB::table('bank_problem')->insert([
                "pro_text"=> $req['pro_text'],
                "problem"=>$req['problem'],
                "add_time"=>time(),
                "type"=>$req['type'],
                'cate_id'=>1
            ]);
        }
        if($data){
            return redirect("info/bank_list?cate_id={$req['cate_id']}");
        }else{
            echo "<script>alert('添加失败')</script>";
        }
    }
    public function bank_list(Request $request)
    {
        $cate_id=$request->input('cate_id')??'';
        $res=DB::table('bank_problem')->where([['is_del','=',1]])->paginate(5);
        return  view('/admin/info/bank_list',['res'=>$res,'cate_id'=>$cate_id]);
    }
    public function bank_xiang(Request $request)
    {
        $bank_id=$request->input('bank_id');
        $data=DB::table('bank_problem')->where('bank_id',$bank_id)->first();
        return  view('/admin/info/bank_xiang',['data'=>$data]);
    }
    public function bank_xiang_edit(Request $request)
    {
        $bank_id=$request->input('bank_id');
        $data=DB::table('bank_problem')->where('bank_id',$bank_id)->first();
        return  view('/admin/info/bank_xiang_edit',['data'=>$data]);
    }

    public function bank_xiang_update(Request $request)
    {
        $data=$request->all();
        $res=DB::table('bank_problem')->where(['bank_id'=>$data['bank_id']])->update([
            "pro_text"=>$data['pro_text'],
        ]);
        if($res){
            echo "<script>alert('修改成功,请刷新列表'),history.go(-2)</script>";
        }else{
            echo "<script>alert('修改失败'),location.href='bank_list'</script>";
        }
    }

    public function del(Request $request)
    {
        $bank_id=$request->input('bank_id')??'';
        $data=DB::table('bank_problem')->where(['bank_id'=>$bank_id])->update([
            "is_del"=>0,
        ]);
        if($data){
            return json_encode(['code'=>1,'msg'=>'删除成功']);
//            echo "<script>alert('删除成功'),location.href='bank_list'</script>";
        }else{
            return json_encode(['code'=>0,'msg'=>'删除失败']);
//            echo "<script>alert('修改失败'),location.href='bank_list'</script>";
        }
    }

    public function bank_edit(Request $request)
    {
        $bank_id=$request->input('bank_id');
        $data=DB::table('bank_problem')->where('bank_id',$bank_id)->first();
        return  view('/admin/info/bank_edit',['data'=>$data]);
    }

    public function bank_update(Request $request)
    {
        $data=$request->all();
        $res=DB::table('bank_problem')->where(['bank_id'=>$data['bank_id']])->update([
            "problem"=>$data['problem'],
        ]);
        if($res){
            echo "<script>alert('修改成功,请刷新列表'),history.go(-2)</script>";die;
        }else{
            echo "<script>alert('修改失败'),location.href='bank_list'</script>";
        }
    }
}
