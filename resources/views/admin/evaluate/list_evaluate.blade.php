@extends('admin/common')

@section('title', '评论详情')

@section('body')
    <div class="container">&nbsp
        <h3 style="color:grey">评论详情：</h3><br>
        <h4><button id="button" class="btn btn-primary">返回</button></h4>&nbsp
        <table class="table table-hover">
            <tr>
                <th>序号</th>
                <th>用户名</th>
                <th>点赞个数</th>
                <th>回复内容</th>
                <th>回复时间</th>
                <th>操作</th>
            </tr>
            @foreach($list as $k => $v)
                <tr>
                    <td>{{$k+1}}</td>
                    <td>{{$v['name']}}</td>
                    <td>{{$v['e_num']}}</td>
                    <td width="120"> {{$v['e_desc']}}</td>
                    <td>{{date('Y-m-d H:i:s',$v['create_time'])}}</td>
                    <td>
                        <a href="{{url('admin/list_evaluate')}}?e_id={{$v['e_id']}}" class="btn btn-success">详情</a>&nbsp
                        <a href="{{url('admin/add_evaluate')}}?e_id={{$v['e_id']}}" class="btn btn-info">回复</a>&nbsp
                        <button id="del" e_id="{{$v['e_id']}}" class="btn btn-danger">删除</button>
                    </td>
                </tr>
            @endforeach
            <tr align="center">
{{--                <td colspan="8">{{ $evaluate->appends(['cou_id' => $cou_id ])->links() }}</td>--}}
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
    <script>
        $(function(){
            $('.btn-danger').click(function(){
                var _this=$(this);
                var e_id=_this.attr('e_id');
                $.get('del_evaluate',{e_id:e_id},function(res){
                    if(res == 1){
                        window.location.reload();
                    }else{
                        alert('删除失败，请重试');
                    }
                });
            });
        })

    </script>
@endsection
