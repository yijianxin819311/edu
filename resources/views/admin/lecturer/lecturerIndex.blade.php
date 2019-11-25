@extends('admin/common')
@section('body')
    <table class="table table-hover">
        <tr>
            <td>ID</td>
            <td>昵称</td>
            <td>个人简历</td>
            <td>授课风格</td>
            <td>操作</td>
        </tr>
            <tr>
                <td>{{$data->lect_id}}</td>
                <td>{{$data->lect_name}}</td>
                <td>{{$data->lect_resume}}</td>
                <td>{{$data->lect_style}}</td>
                <td>
                    <a href="{{url('/admin/lecturer/lectEdit')}}?lect_id={{$data->lect_id}}" class='btn btn-danger'>修改资料</a>

                </td>
            </tr>
    </table>
    <script src="/admin/js/jquery.min.js"></script>
    <script>
    $(function(){
        $('.del').click(function(){
            $(this).parent().parent().remove();
            var  lect_id=$(this).attr('value');
            $.ajax({
                url:'/admin/last/del/'+lect_id,
                type:'get',
                dataType:'json',
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                    }
                }
            });
    })
    });
    </script>
@endsection
