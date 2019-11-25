<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Model\admin\Catalog;
use App\model\Lect;
use Illuminate\Http\Request;
use \DB;
use  Illuminate\Database\Eloquent\SoftDeletes;
class LecturerController extends Controller
{
    /**
    *展示讲师，个人简历，授课风格
    **/
    public function lecturerIndex(Request $request)
    {
        $lecturer_user_id=session('lecturer_user_id');
        $data=DB::table('lect')->where('lecturer_user_id',$lecturer_user_id)->first();
        return view('admin/lecturer/lecturerIndex',['data'=>$data]);
    }
    /**
    *讲师软删除
    **/
    public function del($lect_id)
    {
        $data=DB::table('lect')->where(['lect_id'=>$lect_id])->update([
            "is_del"=>0
        ]);
        if($data){
          return json_encode(['code'=>1,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'删除失败']);
        }
    }

    /**
    *编辑讲师修改试图
    **/
    public function lectEdit(Request $request)
    {
        $lect_id= $request->input('lect_id');
        $data=DB::table('lect')->where(['lect_id'=>$lect_id])->first();
        return view('/admin/lecturer/lectedit',['data'=>$data]);
    }

    /**
    *编辑讲师修改
    **/
    public function lectUpdate(Request $request)
    {
        $lect_id= $request->input('lect_id');
        $lect_resume=$request->input('lect_resume');
        $lect_style=$request->input('lect_style');
        $data=DB::table('lect')->where(['lect_id'=>$lect_id])->update([
            "lect_resume"=>$lect_resume,
            "lect_style"=>$lect_style,
        ]);
        if($data){
            echo "<script>alert('修改成功'),location.href='/admin/last/lecturerIndex'</script>";
        }else{
            echo "<script>alert('修改失败'),location.href='/admin/last/lecturerIndex'</script>";
        }
    }

    /*
    *添加作业试图
    * */
    public function jobAdd(Request $request)
    {
        $catalog_id=$request->input(['catalog_id']);

        return view('/admin/job/jobAdd',['catalog_id'=>$catalog_id]);
    }
    /*
    *添加作业
    * */
    public function jobAddHandel(Request $request)
    {
        $data=$request->all();
        $cou_id=Catalog::first(['catalog_id'=>$data['catalog_id']]);
        $res=DB::table('job')->insert([
            'cou_id'=>$cou_id['cou_id'],
            'catalog_id'=>$data['catalog_id'],
            'Job_name'=>$data['Job_name'],
            'Create_time'=>time(),
        ]);
        if($res){
            echo "<script>alert('添加成功'),location.href='/admin/last/jobIndex?catalog_id={$data['catalog_id']}'</script>";
        }else{
            echo "<script>alert('添加失败'),history.go(-1)</script>";
        }
    }
    /*
    *展示作业
    * */
    public function jobIndex(Request $request)
    {
        $catalog_id = $request->input(['catalog_id'])??'';
//        dd($catalog_id);
        $req=$request->input('job_name')??'';

        $data=DB::table('job')->where([['job_del','=',1],['catalog_id','=',$catalog_id]])->where('job_name','like','%'.$req.'%')->paginate(2);
        return view('admin/job/jobIndex',['data'=>$data,'catalog_id'=>$catalog_id,'req'=>$req]);
    }

    /*
    *作业软删除
    * */
    public function delete($job_id)
    {
        $data=DB::table('job')->where(['job_id'=>$job_id])->update([
            "job_del"=>0
        ]);
        if($data){
            return json_encode(['code'=>1,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'删除失败']);
        }
    }
    /*
   *编辑作业修改试图
   * */
    public function edit(Request $request)
    {
        $job_id= $request->input('job_id');
        $data=DB::table('job')->where(['job_id'=>$job_id])->first();
        return view('/admin/job/edit',['data'=>$data]);
    }
    /*
    *编辑作业修改
    * */
        public function update(Request $request)
    {
        $job_name= $request->input('job_name');
        $job_id= $request->input('job_id');
//        $catalog_id=$request->input(['catalog_id'])??'';
//        dd($catalog_id);
        $data=DB::table('job')->where(['job_id'=>$job_id])->update([
            "job_name"=>$job_name,
        ]);
        if($data){
            echo "<script>alert('修改成功,请刷新页面'),history.go(-2)</script>";
        }else{
            echo "<script>alert('修改失败'),location.href='/admin/last/jobIndex'</script>";
        }
    }
}
