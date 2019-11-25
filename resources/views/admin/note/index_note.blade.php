@extends('admin.common')

@section('title', '收藏详情')

@section('body')
    <div class="container">&nbsp
        <h3 style="color: grey">笔记列表：</h3>&nbsp&nbsp
        <h4>
            <button id="button" class="btn btn-primary">返回</button>&nbsp
            <a href="{{url('admin/add_note')}}?cou_id={{$cou_id}}" class="btn btn-success">添加</a>
        </h4>

        <table class="table table-hover">
            <tr class="active">
                <th>序号</th>
                <th>讲师</th>
                <th>课程</th>
                <th>笔记内容</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            @foreach($note as$k => $v)
                <tr class="info">
                    <td>{{$k+1}}</td>
                    <td>{{$v['name']}}</td>
                    <td>{{$v['cou_name']}}</td>
                    <td>{{strip_tags($v['note_desc'])}}</td>
                    <td>{{date('Y-m-d H:i:s',$v->create_time)}}</td>
                    <td>
                       <button note_id="{{$v['note_id']}}" class="btn btn-danger">删除</button>&nbsp
                       <a href="{{url('admin/update_note')}}?note_id={{$v['note_id']}}" class="btn btn-info">修改</a>
                    </td>
                </tr>
            @endforeach
            <tr align="center">
                <td colspan="8">{{ $note->appends(['cou_id' => $cou_id])->links() }}</td>
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
                var note_id=_this.attr('note_id');
                $.get('del_note',{note_id:note_id},function(res){
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
