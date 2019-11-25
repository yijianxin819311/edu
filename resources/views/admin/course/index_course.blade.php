@extends('admin/common')

@section('title', '课程列表')

@section('body')
    <div class="container">&nbsp
        <h3 style="color:grey">课程列表：</h3><br>
        <h4><a href="{{url('admin/update_category')}}?cate_id=0" class="btn btn-primary">添加课程</a></h4>&nbsp
        <form class="form-inline" action="{{url('admin/index_course')}}">
            <div class="form-group">
                <label for="exampleInputName2" class="text-info">课程名称：</label>
                <input type="text" class="form-control" value="{{$cou_name}}" name="cou_name" id="exampleInputName2" placeholder="课程名称">
            </div>&nbsp
            <div class="form-group">
                <label for="exampleInputEmail2" class="text-info">是否免费：</label>
                <select class="form-control" name="is_free">
                    <option value="0" selected>是否免费</option>
                    <option value="1"{{$is_free==1?'selected':''}}>免费</option>
                    <option value="2" {{$is_free==2?'selected':''}}>收费</option>
                </select>
            </div>&nbsp
            <div class="form-group">
                <label for="exampleInputEmail2" class="text-info">课程状态：</label>
                <select class="form-control" name="cou_status">
                    <option value="0" selected>-- 状态 --</option>
                    <option value="1" {{$status==1?'selected':''}}>未开始</option>
                    <option value="2" {{$status==2?'selected':''}}>连载中</option>
                    <option value="3" {{$status==3?'selected':''}}>已完结</option>
                </select>
            </div>&nbsp&nbsp
            <button type="submit" class="btn btn-info">查询</button>
        </form>
        <table class="table table-hover">
            <tr>
                <th>序号</th>
                <th>课程名称</th>
                <th>课程分类</th>
                <th>是否收费</th>
                <th>原价</th>
                <th>课程状态</th>
                <th>总课时/分</th>
                <th>已学人数</th>
                <th>课程图片</th>
                <th>介绍</th>
                <th>操作</th>
            </tr>
            @foreach($course as $k => $v)
              <tr class="info">
                  <td>{{$k+1}}</td>
                  <td>{{$v['cou_name']}}</td>
                  <td>{{$v['cate_name']}}</td>
                  <td>{{$v['is_free']==1?'免费':'不免费'}}</td>
                  <td>{{$v['price']* 0.01}} ￥</td>
                  <td>{{$cou_status[$v['cou_status']]}}</td>
                  <td>{{$v['total_course_time']}}</td>
                  <td>{{$v['course_num']}}</td>
                  <td><img src="{{$url.'/storage/'.$v['img']}}" width="100" alt=""></td>
                  <td width="40">{{strip_tags($v['presentation'])}}</td>
                  <td width="200">
                      <a href="{{url('admin/delete_course')}}?cou_id={{$v['cou_id']}}" class="btn btn-danger">删除</a>&nbsp
                      <a href="{{url('admin/update_course')}}?cou_id={{$v['cou_id']}}" class="btn btn-warning">编辑</a>&nbsp
                      <a href="{{url('admin/index_catalog')}}?cou_id={{$v['cou_id']}}" class="btn btn-primary">章节</a>
                      <a href="{{url('admin/index_evaluate')}}?cou_id={{$v['cou_id']}}" class="btn btn-success">评论</a>&nbsp
                      <a href="{{url('admin/index_note')}}?cou_id={{$v['cou_id']}}" class="btn btn-info">笔记</a>&nbsp
                      <a href="{{url('admin/index_questions')}}?cou_id={{$v['cou_id']}}" class="btn btn-default">问答</a>
                  </td>
              </tr>
            @endforeach
            <tr align="center">
                <td colspan="8">
                    {{ $course->appends(['cou_name' => $cou_name,'is_free'=>$is_free,'cou_status'=>$status])->links() }}
                </td>
            </tr>
        </table>
    </div>

@endsection

@section('script')
    <script>
        $("tr[pid=0]").show();
        $(document).on('click','.show',function(){
            var a=$(this).text();
            var cate_id=$(this).parents('tr').attr('cate_id');
            if(a=='+'){
                if($("tr[pid='"+cate_id+"']").length>0){
                    $("tr[pid='"+cate_id+"']").show();
                    $(this).text('-');
                }

            }else{
                $("tr[pid='"+cate_id+"']").hide();
                $(this).text('+');
            }
            return false;
        });
    </script>
@endsection
