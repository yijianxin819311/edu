@extends('admin/common')

@section('title', '问题列表')

@section('body')
    <div class="container">&nbsp
        <h3 style="color:grey">问题列表：</h3><br>
        <h4>
            <button id="button" class="btn btn-primary">返回</button>&nbsp
            <a href="{{url('admin/add_questions')}}?cou_id={{$cou_id}}" class="btn btn-info">添加问题</a>
        </h4>&nbsp
        <table class="table table-hover">
            <tr>
                <th>序号</th>
                <th>提问用户</th>
                <th>问题标题</th>
                <th>问题正文</th>
                <th>浏览量</th>
                <th>提问时间</th>
                <th>操作</th>
            </tr>
            @foreach($questions as $k => $v)
                <tr class="info">
                    <td>{{$k+1}}</td>
                    <td>{{$v['name']}}</td>
                    <td>{{$v['q_title']}}</td>
                    <td width="300">{{strip_tags($v['q_content'])}}</td>
                    <td>{{$v['q_browse']}}</td>
                    <td>{{date('Y-m-d H:i:s',$v['q_time'])}}</td>
                    <td>
                        <a href="{{url('admin/index_response')}}?q_id={{$v['q_id']}}" class="btn btn-success">查看回答</a>&nbsp
{{--                        <a href="{{url('admin/update_questions')}}?q_id={{$v['q_id']}}" class="btn btn-info">修改</a>&nbsp--}}
                        <button id="del" q_id="{{$v['q_id']}}" class="btn btn-danger">删除</button>
                    </td>
                </tr>
            @endforeach
            <tr align="center">
                <td colspan="8">
                    {{ $questions->appends(['cou_id' => $cou_id])->links() }}
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
                var q_id=_this.attr('q_id');
                $.get('del_questions',{q_id:q_id},function(res){
                    console.log(res);
                    if(res == 1){
                        //局部刷新
                        window.location.reload();
                    }else{
                        alert('删除失败，请重试');
                    }
                });
            });
        })

    </script>
@endsection
