@extends('admin/common')

@section('title', '章节添加')

@section('body')
    <div class="container">&nbsp
        <h3 style="color: grey">章节列表：</h3>&nbsp&nbsp
        <h4>
            <button id="button" class="btn btn-info">返回</button>&nbsp
            <a href="{{url('admin/add_catalog')}}?cou_id={{$cou_id}}" class="btn btn-primary">添加章节</a>

        </h4>&nbsp
        <form class="form-inline" action="{{url('admin/index_catalog')}}">
            <input type="hidden" name="cou_id" value="{{$cou_id}}">
            <div class="form-group">
                <label for="exampleInputName2">标题 ：</label>
                <input type="text" name="catelog_name" value="{{$catelog_name}}" class="form-control" id="exampleInputName2" placeholder="请输入标题或章节名称">
            </div>&nbsp

            <button type="submit" class="btn btn-info">查询</button>
        </form>
        <table class="table table-hover">
            <tr class="active">
                <th>序号</th>
                <th>标题</th>
                <th>章节名称</th>
                <th>课程名称</th>
                <th>是否免费</th>
                <th>描述</th>
                <th>操作</th>
            </tr>
            @foreach($catalog as$k => $v)
            <tr class="info">
                <td>{{$k+1}}</td>
                <td>{{$v['catalog_head']}}</td>
                <td>{{$v['catelog_name']}}</td>
                <td>{{$v['cou_name']}}</td>
                <td>{{$v['is_free']==1?'免费':'收费'}}</td>
                <td width="400">{{strip_tags($v['catalog_describe'])}}</td>
                <td>
                    <a href="{{url('admin/last/jobIndex')}}?catalog_id={{$v['catalog_id']}}" class="btn btn-info">作业</a>&nbsp
                    <a href="{{url('admin/del_catalog')}}?catalog_id={{$v['catalog_id']}}" class="btn btn-danger">删除</a>&nbsp
                    <a href="{{url('admin/update_catalog')}}?catalog_id={{$v['catalog_id']}}" class="btn btn-warning">修改</a>
                </td>
            </tr>
             @endforeach
            <tr align="center">
                <td colspan="8">{{ $catalog->appends(['cou_id' => $cou_id,'catelog_name'=>$catelog_name])->links() }}</td>
            </tr>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $('#button').click(function(){
            window.history.go(-1);
        })
    </script>
@endsection
