@extends('/admin/common')
@section('body')
<div class="table-responsive">
    <center>
        <h3>考试指导列表</h3>
    </center>

    <table class="table table-condensed" >
        <tr class="active">
            <td >考试指导编号</td>
            <td >考试指导标题</td>
            <td >考试指导内容</td>
            <td>操作</td>
        </tr>
        @foreach($res as $v)
            <tr class="active">
                <td >{{$v->exam_id}}</td>
                <td >{{$v->exam_title}}</td>
                <td >{{$v->exam_content}}</td>
                <td>
                    <a  class="btn sub btn-primary" exam_id={{$v->exam_id}} >删除</a>
                    <a  class="btn btn-warning" href="{{url('exam/exam_edit')}}?exam_id={{$v->exam_id}}">修改</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
@section('script')
    <script>
      $(function(){
          $('.sub').on('click',function(){
              var exam_id=$(this).attr('exam_id');
              var tr=$(this).parents('tr');
              $.ajax({
                  url:"exam_del",
                  dataType:"json",
                  data:{exam_id:exam_id},
                  success:function(res){
                      if(res.code==200){
                          tr.remove();
                          alert(res.msg);
                          location.href="/exam/exam_list";
                      }
                  }
              })
          })
      })
    </script>
@endsection
