@extends('admin/common')
@section('body')
    <div class="container">
        <br><br><br>
        <h3 style="color: grey">作业列表 ：</h3>&nbsp&nbsp <br>
        <button id="button" class="btn btn-primary">返回</button>&nbsp
        <a href="{{url('admin/last/jobAdd')}}?catalog_id={{$catalog_id}}" class="btn btn-info">添加作业</a>&nbsp
        <br>
        <form action="{{url('admin/last/jobIndex')}}">
        搜索作业：<input type="text" name="job_name" value="{{$req}}">
        <input type="hidden" name="catalog_id" value="{{$catalog_id}}">
        <button>搜索</button>
    </form>
    <table class="table table-hover">
        <tr>
            <td>ID</td>
            <td>课下作业</td>
            <td>创建时间</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
            <tr>
                <td>{{$v->job_id}}</td>
                <td>{{$v->job_name}}</td>
                <td>{{date('Y-m-d',$v->create_time)}}</td>
                <td>
                    <a href="{{url('/admin/job/edit')}}?job_id={{$v->job_id}}" class='btn btn-danger'>编辑</a>
                    <a href="javascript:void(0);"  class='btn btn-danger del' value="{{$v->job_id}}">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    <script src="/admin/js/jquery.min.js"></script>
    <script>
        $(function() {
            /**
             *软删除
             **/
            $('.del').click(function () {
                $(this).parent().parent().remove();
                var job_id = $(this).attr('value');
                $.ajax({
                    url: '/admin/last/delete/' + job_id,
                    type: 'get',
                    dataType: 'json',
                    success: function (res) {
                        if (res.code == 1) {
                            alert(res.msg);
                        } else {
                            alert(res.msg);
                        }
                    }
                });
            })
        });
    </script>
    {{ $data->appends(['job_name' => $req,'catalog_id'=>$catalog_id])->links() }}
    <script>
        $('#button').click(function(){
            window.history.go(-1);
        })
    </script>
@endsection
