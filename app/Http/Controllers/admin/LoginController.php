<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class LoginController extends Controller
{
    public function login()
    {
        return view('admin/login/login');
    }

    public function loginHandel(Request $request)
    {
        $u_email=$request->input('u_email');
        $u_pwd=$request->input('u_pwd');
        $data=DB::table('lecturer_user')->where(['name'=>$u_email])->where(['password'=>$u_pwd])->first();
        if(!$data){
            return json_encode(['code'=>2,'msg'=>'登陆失败,用户没有权限']);
        }
        if($data->status == 1){
            session(['user_name'=>$data->name]);
            session(['lecturer_user_id'=>$data->lecturer_user_id]);
            return json_encode(['code'=>1,'msg'=>'登陆成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'登陆失败,用户没有权限']);
        }
    }
    public function out_session(Request $request){
        $request->session()->forget(['user_name', 'lecturer_user_id']);
        return redirect('admin/login');
    }
}
