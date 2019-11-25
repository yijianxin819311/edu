<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use DemeterChain\C;
use Illuminate\Http\Request;
use  App\Http\Model\admin\Course;
use  App\Http\Model\admin\Catalog;
/*
 * 章节表
 * */
class CatalogController extends Controller
{
    //添加视图
    public function add_catalog(Request $request){
        //课程
        $cou_id = $request->input(['cou_id'])??'';
        $course = Course::first(['cou_id'=>$cou_id]);

        return view('admin/catalog/add_catalog',['course'=>$course,'cou_id'=>$cou_id]);
    }
    //添加
    public function add_catalog_do(Request $request){
       $arr=$request->all();
        $validatedData = $request->validate([
            'cou_id' => 'required',
            'catelog_name' => 'required',
            'catalog_head' => 'required',
            'is_free' => 'required',
            'catalog_describe' => 'required',
        ] ,['cou_id.required'=>'请选择课程',
            'catelog_name.required'=>'请填写章节名称',
            'catalog_head.required'=>'请填写标题',
            'is_free.required'=>'请选择是否免费',
            'catalog_describe.required'=>'请填写描述',
          ]);
      unset($arr['_token']);
      $re = Catalog::create($arr);
      if($re){
          return redirect("admin/index_catalog?cou_id={$arr['cou_id']}");
      }else{
          echo"<script>alert('添加失败，请重新添加');history.go(-1)</script>";die;
      }
    }
    //展示
    public function index_catalog(Request $request){
        $cou_id = $request->input(['cou_id'])??'';
        $arr = $request->all()??'';
        //搜索目录或章节
        $where=['catalog.cou_id'=>$cou_id];
        $wheres=[];
        if(!empty($arr['catelog_name'])){
            $where = [
                ['catalog.catalog_head','like',"{$arr['catelog_name']}%"],
                ['catalog.cou_id','=',$cou_id]
            ];
            $wheres = [
                ['catalog.catelog_name','like',"{$arr['catelog_name']}%"],
                ['catalog.cou_id','=',$cou_id]
            ];
        }
        $catalog = Catalog::index($where,$wheres);

        return view('admin/catalog/index_catalog',['catalog'=>$catalog,'cou_id'=>$cou_id,'catelog_name'=>$arr['catelog_name']??'']);
    }
    /*
     * 删除
     * */
    public function del_catalog(Request $request){
        $catalog_id=$request->input(['catalog_id']);
        $re = Catalog::del(['catalog_id'=>$catalog_id]);
        if($re){
            return redirect('admin/index_catalog');
        }else{
            echo"<script>alert('删除失败，请重试');history.go(-1)</script>";die;
        }
    }
    /*
     * 修改
     * */
    public function update_catalog(Request $request){
        $catalog_id = $request->input(['catalog_id']);
        $catalog = Catalog::first(['catalog_id' => $catalog_id]);
        $course = Course::list();
//        dd($course);
        return view('admin/catalog/update_catalog',['catalog' => $catalog,'course' => $course]);
    }
    public function update_catalog_do(Request $request){
        $arr=$request->all();
        $validatedData = $request->validate([
            'cou_id' => 'required',
            'catelog_name' => 'required',
            'catalog_head' => 'required',
            'is_free' => 'required',
            'catalog_describe' => 'required',
        ] ,['cou_id.required'=>'请选择课程',
            'catelog_name.required'=>'请填写章节名称',
            'catalog_head.required'=>'请填写标题',
            'is_free.required'=>'请选择是否免费',
            'catalog_describe.required'=>'请填写描述',
        ]);
        unset($arr['_token']);
        $re=Catalog::update_cata(['catalog_id'=>$arr['catalog_id']],$arr);
        if($re){
            return redirect('admin/index_catalog');
        }else{
            echo"<script>alert('修改失败，请重新修改');history.go(-1)</script>";die;
        }
    }
}
