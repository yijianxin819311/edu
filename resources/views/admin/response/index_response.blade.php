@extends('admin/common')

@section('title', '回答列表')

@section('body')
    <div class="container">&nbsp
        <h3 style="color:grey">回答列表：</h3><br>
        <h4>
            <button id="button" class="btn btn-primary">返回</button>&nbsp
            <a href="{{url('admin/add_response')}}?q_id={{$q_id}}" class="btn btn-info">添加回答</a>
        </h4>&nbsp
        <table class="table table-hover">
            <tr>
                <th>序号</th>
                <th>回答用户</th>
                <th>回答内容</th>
                <th>回答时间</th>
                <th>操作</th>
            </tr>
            @foreach($response as $k => $v)
                <tr class="info">
                    <td>{{$k+1}}</td>
                    <td>{{$v['name']}}</td>
                    <td width="350">{{strip_tags($v['r_content'])}}</td>
                    <td>{{date('Y-m-d H:i:s',$v['r_time'])}}</td>
                    <td>
                        <button id="del" r_id="{{$v['r_id']}}" class="btn btn-danger">删除</button>
                    </td>
                </tr>
            @endforeach
            <tr align="center">
                <td colspan="8">
                    {{ $response->appends(['q_id' => $q_id])->links() }}
                </td>
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
                var r_id=_this.attr('r_id');
                $.get('del_response',{r_id:r_id},function(res){
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
