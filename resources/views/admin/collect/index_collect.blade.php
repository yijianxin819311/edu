@extends('admin/common')

@section('title', '收藏列表')

@section('body')
    <div class="container">&nbsp
        <h3 style="color: grey">收藏列表：</h3>&nbsp&nbsp
        <form class="form-inline" action="{{url('admin/index_collect')}}">
            <div class="form-group">
                <label for="exampleInputName2">用户名 ：</label>
                <input type="text" name="u_name" value="{{$u_name}}" class="form-control" id="exampleInputName2" placeholder="请输入用户名">
            </div>&nbsp
            <button type="submit" class="btn btn-info">查询</button>
        </form>
        <table class="table table-hover">
            <tr class="active">
                <th>序号</th>
                <th>用户名</th>
                <th>收藏夹名</th>
                <th>收藏数量</th>
                <th>操作</th>
            </tr>
            @foreach($collect as$k => $v)
                <tr class="info">
                    <td>{{$k+1}}</td>
                    <td>{{$v['name']}}</td>
                    <td>{{$v['collect_name']}}</td>
                    <td>{{$v['collect_num']}}</td>
                    <td>
{{--                        <a href="{{url('admin/del_catalog')}}?catalog_id={{$v['catalog_id']}}" class="btn btn-danger">删除</a>&nbsp--}}
                        <a href="{{url('admin/list_collect')}}?c_id={{$v['collect_id']}}" class="btn btn-info">查看详情</a>
                    </td>
                </tr>
            @endforeach
            <tr align="center">
                <td colspan="8">{{ $collect->appends(['u_name' => $u_name])->links() }}</td>
            </tr>
        </table>
    </div>
@endsection

@section('content')
    <p>This is my body content.</p>
@endsection
