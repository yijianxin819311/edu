@extends('/admin/common')
@section('body')
    <div class="container">&nbsp
<div class="table-responsive">
    <center>
    <h3>资讯列表</h3>
    </center>
    <form action="">
        标题：<input type="text" name="name" value="{{$name}}">
        <input type="submit" value="搜索">
    </form>
<table class="table table-condensed" >
    <tr class="active">
        <td >资讯编号</td>
        <td >资讯标题</td>
        <td >资讯内容</td>
        <td>操作</td>
    </tr>
    @foreach($res as $v)
    <tr class="active">
        <td >{{$v->infor_id}}</td>
        <td >{{$v->infor_title}}</td>
        <td >{{strip_tags($v->infor_content)}}</td>
        <td>
            <a  class="btn sub btn-primary" infor_id={{$v->infor_id}} >删除</a>
            <a  class="btn btn-warning" href="{{url('info/info_edit')}}?infor_id={{$v->infor_id}}">修改</a>
        </td>
    </tr>

    @endforeach

</table>
    <tr align="center">
        <td colspan="8" align="center">
    {{ $res->appends(['name'=>$name])->links()}}
        </td>
    </tr>
</div>
    </div>
@endsection
@section('script')
    <script>
     $(function(){
         $('.sub').on('click',function(){
             var infor_id=$(this).attr('infor_id');
             var tr=$(this).parents('tr');
             $.ajax({
                 url:"info_del",
                 dataType:"json",
                 data:{infor_id:infor_id},
                 success:function(res){
                     alert(res.msg);
                     if(res.code==200){
                         tr.remove();
                         window.location.reload();
                     }
                 }
             })
         })
     })
    </script>
@endsection
