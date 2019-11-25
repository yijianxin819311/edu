@extends('admin/common')

@section('title', '收藏详情')

@section('body')
    <div class="container">&nbsp
        <h3 style="color: grey">收藏列表：</h3>&nbsp&nbsp
        <h4><button id="button" class="btn btn-primary">返回</button></h4>&nbsp
        <form class="form-inline" action="{{url('admin/list_collect')}}">
            <input type="hidden" name="c_id" value="{{$c_id}}">
            <div class="form-group">
                <label for="exampleInputName2">课程名称 ：</label>
                <input type="text" name="cou_name" value="{{$cou_name}}" class="form-control" id="exampleInputName2" placeholder="请输入用户名课程名">
            </div>&nbsp
            <button type="submit" class="btn btn-info">查询</button>
        </form>
        <table class="table table-hover">
            <tr class="active">
                <th>序号</th>
                <th>课程</th>
                <th>收藏时间</th>

            </tr>
            @foreach($collect_r as$k => $v)
                <tr class="info">
                    <td>{{$k+1}}</td>
                    <td>{{$v->cou_name}}</td>
                    <td>{{date('Y-m-d H:i:s',$v->create_time)}}</td>
{{--                    <td>--}}
{{--                        <a href="{{url('admin/del_catalog')}}?catalog_id={{$v['catalog_id']}}" class="btn btn-danger">删除</a>&nbsp--}}
{{--                        <a href="{{url('admin/list_collect')}}?c_id={{$v['collect_id']}}" class="btn btn-info">查看详情</a>--}}
{{--                    </td>--}}
                </tr>
            @endforeach
            <tr align="center">
                <td colspan="8">{{ $collect_r->appends(['c_id' => $c_id,'cou_name'=>$cou_name])->links() }}</td>
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
