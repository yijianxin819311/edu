@extends('admin/common')
@section('body')
    <br> <br> <br>
    <h4>
        <button id="button" class="btn btn-primary">返回</button>&nbsp
        <a href="{{url('info/bank')}}?cate_id={{$cate_id}}" class="btn btn-info">添加题库</a>
    </h4>&nbsp
<div class="table-responsive">
    <center>
        <h3>题库列表</h3>
    </center>

    <table class="table table-condensed" >
        <tr class="active">
            <td >问题ID</td>
            <td >问题</td>
            <td>问题类型</td>
            <td>操作</td>
        </tr>
        @foreach($res as $v)
            <tr >
                <td>{{$v->bank_id}}</td>
                <td >{{$v->problem}}</td>
                <td>
                    @if($v->type == 1)
                        单选题
                        @elseif($v->type == 2)
                        多选题
                        @elseif($v->type ==3)
                        判断题
                    @endif
                </td>
                <td>
                    <a href="{{url('info/bank_xiang')}}?bank_id={{$v->bank_id}}" class="btn btn-warning">正确答案</a>
                    <a class="btn sub btn-primary del" value="{{$v->bank_id}}" >删除</a>
                    <a href="{{url('info/bank_edit')}}?bank_id={{$v->bank_id}}" class="btn btn-warning">修改</a>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="8" align="center">{{ $res->links() }}</td>
        </tr>
    </table>

</div>
@endsection
<script src="/admin/js/jquery.min.js"></script>
@section('script')
    <script>
        $('#button').click(function(){
            window.history.go(-1);
        })
    </script>
    <script>
        $(function(){
            $('.del').click(function(){
                $(this).parent().parent().remove();
                var  bank_id=$(this).attr('value');
                $.ajax({
                    url:'del',
                    type:'get',
                    data:{bank_id:bank_id},
                    dataType:'json',
                    success:function(res){
                        if(res.code==1){
                            alert(res.msg);
                            window.location.reload();
                        }else{
                            alert(res.msg);
                        }
                    }
                })
                return false;
            })
        });
    </script>
@endsection
